<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use http\Encoding\Stream\Enbrotli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use function Symfony\Component\String\b;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admincheck');
    }

    // User View
    function user(){
        $logged_user_id = Auth::id();
        $users = User::where('id', '!=', $logged_user_id)->orderBy('name')->Paginate(20);
        $total_user = User::count();
        return view('user', compact('users','total_user'));
    }

    // Insert User Role
    public function InsertUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => Password::min(8)
//                ->letters()
//                ->mixedCase()
//                ->numbers()
//                ->symbols()
//                ->uncompromised()

        ]);
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'User Role Created');

    }
}
