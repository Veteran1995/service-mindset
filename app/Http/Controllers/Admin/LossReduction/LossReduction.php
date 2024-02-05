<?php

namespace App\Http\Controllers\Admin\LossReduction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LossReduction extends Controller
{
    public function lossReduction()
    {
        return view('admin.LossReduction.lossReduction');
    }

    public function lossReductionCaseDetail($id)
    {
        return view('admin.LossReduction.loss-reduction-case-detail')->with('id', $id);
    }

    public function addlossReduction()
    {
        return view('admin.LossReduction.add-lost-reduction-case');
    }

    public function reportedCase()
    {
        return view('admin.LossReduction.reported-case');
    }

    public function registeredCase()
    {
        return view('admin.LossReduction.registered-case');
    }

    public function caseDashboard()
    {
        return view('admin.LossReduction.case-dashboard');
    }

    public function customerEngagement()
    {
        return view('admin.CustomerEngagement.customer-engagement');
    }

    public function OutboundEngagement()
    {
        return view('admin.CustomerEngagement.customers-outbound-engagement');
    }

    public function InboundEngagement()
    {
        return view('admin.CustomerEngagement.customers-inbound-engagement');
    }

    public function HotlineEngagement()
    {
        return view('admin.CustomerEngagement.customers-hotline-engagement');
    }

    public function EngagmentDashboard()
    {
        return view('admin.CustomerEngagement.customers-engagement-dashboard');
    }
}
