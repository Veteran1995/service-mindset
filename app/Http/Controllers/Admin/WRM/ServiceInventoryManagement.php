<?php

namespace App\Http\Controllers\Admin\WRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceInventoryManagement extends Controller
{
    public function serviceInventoryManagement()
    {
        return view('admin.Wrm.serviceInventoryManagement');
    } //
}
