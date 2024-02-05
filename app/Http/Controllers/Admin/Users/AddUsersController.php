<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddUsersController extends Controller
{
    public function index()
    {
        return view('admin.Users.add-users');
    }
}
