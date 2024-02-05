<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Customers extends Controller
{
    public function importCustomer()
    {
        return view('admin.Import.ImportCustomer');
    }
    public function importServiceOrder()
    {
        return view('admin.Import.ImportServiceOrders');
    }
    public function importMeter()
    {
        return view('admin.Import.ImportMeter');
    }
}
