<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\MeterReading;
use Livewire\Component;

class MeterReadingDetail extends Component
{
    public $reading;
    public $latitude;
    public $longitude;

    // public function getLocation()
    // {
    //     // Use Livewire's JavaScript helper to emit a custom event
    //     $script = "
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function(position) {
    //             var latitude = position.coords.latitude;
    //             var longitude = position.coords.longitude;

    //             // Update the Livewire properties
    //             @this.set('latitude', latitude);
    //             @this.set('longitude', longitude);

    //             // Emit the location data back to the view
    //             Livewire.emit('locationReceived', { latitude: latitude, longitude: longitude });
    //         });
    //     }
    // ";

    //     $this->emit('executeJs', $script);
    // }
    public $location;
    public function fetchLocation()
    {
        $this->dispatchBrowserEvent('customerLocation', ['location' => $this->location]);
    }

    public function approveReading()
    {
        // Find the MeterReading model by ID
        $reading = MeterReading::find($this->reading->id);

        if ($reading) {
            // Update the status to "approved"
            $reading->status = 'approved';
            $reading->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Approved Successfully.']);
        }
    }

    public function declineReading()
    {
        // Find the MeterReading model by ID
        $reading = MeterReading::find($this->reading->id);

        if ($reading) {
            // Update the status to "approved"
            $reading->status = 'declined';
            $reading->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Declined Successfully.']);
        }
    }


    public function mount(MeterReading $id)
    {
        $this->reading = $id;
        $this->location = $this->reading;
    }
    public function render()
    {
        return view('livewire.admin.task.meter-reading-detail');
    }
}
