<?php

namespace App\Http\Controllers\Admin\AIR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AIR extends Controller
{
    public function air()
    {
        return view('admin.Air.air');
    }
}
