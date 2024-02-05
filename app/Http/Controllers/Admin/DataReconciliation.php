<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataReconciliation extends Controller
{
    public function dataReconciliation()
    {
        return view('admin.Settings.data-reconciliation');
    }
}
