<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddCustomersController extends Controller
{
    public function index()
    {
        return view('admin.Customers.add-customer');
    }
}
