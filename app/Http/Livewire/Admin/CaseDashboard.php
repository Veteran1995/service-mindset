<?php

namespace App\Http\Livewire\Admin;

use App\Models\LossReductionCase;
use Livewire\Component;

class CaseDashboard extends Component
{
    public function render()
    {
        $cases = LossReductionCase::all();
        return view('livewire.admin.case-dashboard', ['cases'=>$cases]);
    }
}
