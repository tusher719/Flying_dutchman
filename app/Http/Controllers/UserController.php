<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function user(){
        $logged_user_id = Auth::id();
        $users = User::where('id', '!=', $logged_user_id)->orderBy('name')->Paginate(20);
        $total_user = User::count();
        return view('user', compact('users','total_user'));
    }
}
