<?php

namespace App\Http\Controllers\Admin\AIR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StolenMeterIdentification extends Controller
{
    public function stolenMeterIdentification()
    {
        return view('admin.Air.stolen-meter-identification');
    }
}
