<?php

namespace App\Http\Controllers\Admin\WRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskMaintenace extends Controller
{
    public function taskMaintenance()
    {
        return view('admin.Wrm.taskMaintenance');
    }
}
