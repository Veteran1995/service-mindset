<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\AssigmentMeters;
use App\Models\MeterAssignment;
use App\Models\MeterReading;
use App\Models\User;
use Livewire\Component;

class UserMeterReadingItineraries extends Component
{
    public $tasks;
    public $latitude;
    public $longitude;
    public $user;

    public $meters;
    public $itineraries;

    public function openUserItineraries(MeterAssignment $id)
    {
        $this->meters = $id->meters;
        $this->dispatchBrowserEvent('openUserItinerary');
    }

    public function viewMeters()
    {
        $this->itineraries = MeterAssignment::where('user_id', $this->user->employee_id)->with('meters.meter')->get();

        $this->dispatchBrowserEvent('openItinerary');
    }

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


    public function mount(User $user_id)
    {
        $this->user = $user_id;
        $this->tasks = $user_id->meterAssignments;
    }

    public function render()
    {
        return view('livewire.admin.task.user-meter-reading-itineraries');
    }
}
