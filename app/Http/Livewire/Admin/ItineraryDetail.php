<?php

namespace App\Http\Livewire\Admin;

use App\Models\AssigmentMeters;
use App\Models\MeterAssignment;
use App\Models\ItineraryComment;
use App\Models\ItineraryHistory;
use App\Models\MeterAssignmentDeclineComment;
use Livewire\Component;
use App\Models\Meter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItineraryDetail extends Component
{

    public $addMeterCommentId;
    public $addMeterDeclineCommentId;
    public $userMeterComment;
    public $userMeterDeclineComment;
    public $selectedItinerary;
    public $itineraryMeter;
    public $itineraryName;

    public $meterComments;
    public $reassignId;
    public $user;
    public $meter;
    public $meterSearchResults;

    public function mount(MeterAssignment $itinerary_id)
    {
        $this->itineraryMeter = $itinerary_id;
        $this->itineraryName = $itinerary_id;
    }

    public function loadChart()
    {
        $prepaidCount = 0;
        $postpaidCount = 0;

        foreach ($this->itineraryMeter->meters as $meter) {
            // Assuming $meter->meter->service_type is the correct property to access service_type
            $serviceType = $meter->meter->service_type;

            if ($serviceType === 'Prepaid') {
                $prepaidCount++;
            } elseif ($serviceType === 'Postpaid') {
                $postpaidCount++;
            }
        }

        $chartData = [
            ['Task', 'Count'],
            ['Prepaid', $prepaidCount],
            ['Postpaid', $postpaidCount],
        ];

        $this->dispatchBrowserEvent('updateChart', ['chartData' => $chartData]);
    }

    public function viewMeterComment(Meter $id)
    {
        $this->meterComments = $id->comments;
        $this->dispatchBrowserEvent('openMeterComment');
        $this->loadChart();
    }

    public function reassignMeter(AssigmentMeters $id)
    {
        $this->reassignId = $id;
        $this->dispatchBrowserEvent('closeItinerary');
        $this->dispatchBrowserEvent('openReassignMeter');
        $this->loadChart();
    }



    public function addMeterComment($id)
    {
        $this->addMeterCommentId = $id;
        $this->dispatchBrowserEvent('closeItinerary');
        $this->dispatchBrowserEvent('addMeterComment');

        $this->loadChart();
    }

    public function addMeterDeclineComment($id)
    {
        $this->addMeterDeclineCommentId = $id;
        $this->dispatchBrowserEvent('closeItinerary');
        $this->dispatchBrowserEvent('addMeterDeclineComment');

        $this->loadChart();
    }


    public function submitMeterComment()
    {
        if ($this->userMeterComment == "") {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Comment is Required!']);
        }

        MeterAssignmentDeclineComment::create([
            'meter_id' =>  $this->addMeterCommentId,
            'user_id' => Auth::id(),
            'type' => 'c',
            'comment' => $this->userMeterComment,
        ]);

        $this->userMeterComment = "";
        $this->dispatchBrowserEvent('closeAddMeterComment');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Submitted Successfully']);
    }

    public function submitMeterDeclineComment()
    {
        if ($this->userMeterDeclineComment == "") {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Comment is Required!']);
        }

        MeterAssignmentDeclineComment::create([
            'meter_id' =>  $this->addMeterDeclineCommentId,
            'user_id' => Auth::id(),
            'type' => 'd',
            'comment' => $this->userMeterDeclineComment,
        ]);

        $this->userMeterComment = "";
        $this->dispatchBrowserEvent('closeAddMeterComment');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Account Declined Successfully']);
    }

    public function reassign()
    {
        if ($this->selectedItinerary == "") {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Please Select An Itinerary']);
        }
        $this->reassignId->update([
            'assign_id' => $this->selectedItinerary,
        ]);

        ItineraryHistory::create([
            'itinerary_id' => $this->itineraryMeter->id,
            'user_id' => Auth::id(),
            'action' => 'Reassign',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' reassign a meter to another itinerary',
        ]);

        $this->selectedItinerary = "";

        $this->dispatchBrowserEvent('closeReassignMeter');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Assigned Successfully']);
    }

    public function reassignItinerary()
    {
        $this->dispatchBrowserEvent('openReassignItinerary');
        $this->loadChart();
    }
    public function unassign()
    {
        $this->dispatchBrowserEvent('openUnassignItinerary');
        $this->loadChart();
    }

    public function searchMeter()
    {

        $this->dispatchBrowserEvent('opensearchMeter');
        $this->loadChart();
    }

    public function searchMeterToAdd()
    {
        $this->dispatchBrowserEvent('closesearchMeter');

        $meter = Meter::where('meter_serial_number', $this->meter)->first();
        if ($meter) {
            if ($meter->assignment) {
                return  $this->dispatchBrowserEvent('warning', ['message' => 'This Meter is Already Assign to ' . $meter->assignment->itinerary_no]);
            } elseif ($meter->customer) {
                return $this->dispatchBrowserEvent('warning', ['message' => 'This Meter is connected to a customer']);
            } else {
                $this->meterSearchResults = $meter;
                $this->dispatchBrowserEvent('openMeterSearchResult');
            }
        } else {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Meter Not Found']);
        }
    }

    public function addMeter()
    {
        AssigmentMeters::create([
            'meter_id' => $this->meterSearchResults->id,
            'assign_id' => $this->itineraryMeter->id,
        ]);

        ItineraryHistory::create([
            'itinerary_id' => $this->itineraryMeter->id,
            'user_id' => Auth::id(),
            'action' => 'Added Meter',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' added a meter',
        ]);

        $this->dispatchBrowserEvent('closeMeterSearchResult');
        return $this->dispatchBrowserEvent('success', ['message' => 'Meter Added to Itinerary Successfully']);
    }

    public function removeUser()
    {

        $this->itineraryMeter->update([
            'user_id' => NULL,
        ]);

        ItineraryHistory::create([
            'itinerary_id' => $this->itineraryMeter->id,
            'user_id' => Auth::id(),
            'action' => 'Remove User',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' remove a user from the this itinerary',
        ]);

        $this->dispatchBrowserEvent('closeUnassignItinerary');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Unassign Successfully']);
    }

    public function submitReassignItinerary()
    {
        if ($this->user == "") {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Please Select A User']);
        }
        $this->itineraryMeter->update([
            'user_id' => $this->user,
        ]);

        ItineraryHistory::create([
            'itinerary_id' => $this->itineraryMeter->id,
            'user_id' => Auth::id(),
            'action' => 'Reassign',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' reassign a user to this itinerary',
        ]);

        $this->user = "";

        $this->dispatchBrowserEvent('closeUnassignItinerary');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Reassigned Successfully']);
    }

    public function remove()
    {
        $this->reassignId->delete();

        ItineraryHistory::create([
            'itinerary_id' => $this->itineraryMeter->id,
            'user_id' => Auth::id(),
            'action' => 'Remove Meter',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' remove a meter from the this itinerary',
        ]);

        $this->dispatchBrowserEvent('closeReassignMeter');
        $this->loadChart();
        $this->dispatchBrowserEvent('success', ['message' => 'Removed Successfully']);
    }

    public function render()
    {
        $itineraries = MeterAssignment::all();
        $users = User::all();
        return view('livewire.admin.itinerary-detail', ['itineraries' => $itineraries, 'users' => $users]);
    }
}
