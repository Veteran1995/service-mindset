<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.Users.users');
    }
    public function userProfile($user_id)
    {
        return view('admin.Users.user-profile')->with('user_id', $user_id);
    }
}
