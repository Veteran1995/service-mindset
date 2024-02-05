<?php

namespace App\Http\Controllers\Admin\Connections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function serviceOrder()
    {
        return view('admin.Connections.service-orders');
    }

    public function newServiceOrder()
    {
        return view('admin.Connections.new-service-order');
    }

    public function singleServiceOrder($service_order_id)
    {
        return view('admin.Connections.single-service-order')->with('service_order_id', $service_order_id);;
    }

    public function addCustomerServiceOrder($customer_id)
    {
        return view('admin.Connections.add-customer-service-order')->with('customer_id', $customer_id);;
    }
}
