<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        return view('admin.profile.index');
    }

    // Name Update
    function nameupdate(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);
        return back()->with('nameupdate', 'Your Name Updated Successfully');
    }

    // Password Update
    function passwordupdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required | confirmed',
            'password'=> Password::min(8)
//                ->letters()
//                ->mixedCase()
//                ->numbers()
//                ->symbols()
        ]);
        if (Hash::check($request->old_password, Auth::user()->password)){
          User::find(Auth::id())->update([
              'password'=>bcrypt($request->password),
          ]);
        } else {
            return back()->with('wrong_old_pass', 'Old Password Does Not Match!');
        }
        return back()->with('passwordupdate', 'Your Password Update!');
    }

    // Photo Update
    function photoupdate(Request $request){
        $request->validate([
            'photo'=>'image',
            'photo' => 'mimes:jpg,bmp,png',
            'photo' => 'file|max:1024',
        ]);

        $new_profile_photo = $request->photo;
        $extension = $new_profile_photo->getClientOriginalExtension();
        $photo_name = 'user-'.Auth::id().'_'.date('d-m-Y').'.'.$extension;

        if (Auth::user()->user_photo != 'default.jpg') {
            $path = public_path()."/uploads/users/".Auth::user()->user_photo;
            unlink($path);
        }

        Image::make($new_profile_photo)->save(base_path('public/uploads/users/'.$photo_name));
        User::find(Auth::id())->update([
            'user_photo'=>$photo_name,
        ]);
        return back()->with('imageupdate', 'Your Profile Photo Update');
    }

}
