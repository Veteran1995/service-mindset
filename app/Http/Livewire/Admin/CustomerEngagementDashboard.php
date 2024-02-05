<?php

namespace App\Http\Livewire\Admin;

use App\Models\LossReductionCase;
use Livewire\Component;

class CustomerEngagementDashboard extends Component
{

    public function render()
    {
        $cases = LossReductionCase::all();
        return view('livewire.admin.customer-engagement-dashboard', ['cases'=>$cases]);
    }
}
