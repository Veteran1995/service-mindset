<?php

namespace App\Http\Livewire\Admin\Meters;

use App\Models\Meter;
use Livewire\Component;

class MeterDetail extends Component
{

    public function fetchLocation()
    {
        $this->dispatchBrowserEvent('customerLocation', ['location' => $this->meter->customer->location]);
    }

    public function mount($itinerary_id)
    {
    }
    public function render()
    {
        return view('livewire.admin.meters.meter-detail');
    }
}
