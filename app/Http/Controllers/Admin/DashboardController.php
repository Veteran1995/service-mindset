<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'agent') {
            return view('agent.dashboard');
        }

        // Handle other roles or unauthorized access
        abort(403);
    }
}
