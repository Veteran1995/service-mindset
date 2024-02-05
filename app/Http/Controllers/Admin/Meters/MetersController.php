<?php

namespace App\Http\Controllers\Admin\Meters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MetersController extends Controller
{
    public function meters()
    {
        return view('admin.Meters.meters');
    }

    public function meterDetail($meter_id)
    {
        return view('admin.Meters.meter-detail')->with('meter_id', $meter_id);
    }
}
