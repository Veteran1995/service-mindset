<?php

namespace App\Http\Controllers\Admin\WRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WRM extends Controller
{
    public function wrm()
    {
        return view('admin.Wrm.wrm');
    }
}
