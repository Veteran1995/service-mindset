<?php

namespace App\Http\Livewire\Admin;

use App\Models\Crew;
use App\Models\Customer;
use App\Models\LossReductionCase;
use App\Models\Meter;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LossReductionCaseDetail extends Component
{
    use WithPagination;

    public $sourceOfDetection;
    public $lossReductionCaseType;
    public $customerSPN;
    public $meterNumber;
    public $fullname;
    public $postalCode;
    public $geoCommunity;
    public $stateProvinceLocation;
    public $postalCodeLocation;
    public $geoZone;
    public $reportedActivity;
    public $nearestLandmark;
    public $street;
    public $city;
    public $descriptionOfSuspectedActivity;
    public $reportedBy;
    public $contactNumber;
    public $file;
    public $recommendation;
    public $unverifiedCustomer;
    public $verifiedCustomer;

    public $crewOrUserToggle = false;
    public $comment;

    public $fieldsDisabled = true;

    public $name;
    public $description;
    public $priority = "low";
    public $dueDate;
    public $selectedCrew;
    public $selectedUser;

    public $latit;
    public $longit;

    public $taskComments;

    public $photo;

    // protected $rules = [
    //     'state.firstname' => 'required',
    //     'state.lastname' => 'required',
    //     'state.phone' => 'required',
    //     'state.gender' => 'required',
    //     'address' => 'required',
    //     'long' => 'required',
    //     'lat' => 'required',
    //     'state.meter_name' => 'required',
    //     'state.serial_number' => 'required',
    //     'state.seal_tag' => 'required',
    //     'location' => 'required',
    //     'longitude' => 'required',
    //     'latitude' => 'required',
    //     'comment' => 'required',
    //     // 'photo' => 'image|max:1024', // Adjust the file size limit as needed
    // ];


    // protected $listeners = ['placeSelected', 'addressSelected'];

    // public function placeSelected($data)
    // {
    //     $this->location = $data['address'];
    //     $this->latitude = $data['latitude'];
    //     $this->longitude = $data['longitude'];
    // }

    // public function addressSelected($data)
    // {
    //     $this->address = $data['address'];
    //     $this->lat = $data['latitude'];
    //     $this->long = $data['longitude'];
    // }



    // public function fetchLatitudeAndLongitude()
    // {

    //     $this->longit = $this->task->serviceOrder->longitude;
    //     $this->latit = $this->task->serviceOrder->latitude;
    //     $this->emit('latitudeAndLongitudeFetched', $this->latitude, $this->longitude);
    // }

    // public function showAllCommets()
    // {
    //     $this->dispatchBrowserEvent('openTaskCommentModal');
    // }

    public $location;
    public function fetchLocation()
    {
        $this->dispatchBrowserEvent('customerLocation', ['location' => $this->location]);
    }

    public function boot()
    {
        $this->fetchLocation();
    }

    public function toggleCrewOrUser()
    {
        $this->crewOrUserToggle = !$this->crewOrUserToggle;
    }

    public function addTask()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'dueDate' => 'required|date',
            'selectedCrew' => 'required_without:selectedUser',
            'selectedUser' => 'required_without:selectedCrew',
        ]);

        if (!empty($this->selectedCrew) && empty($this->selectedUser)) {
            // Create and save the task in the tasks table
            $task = Task::create([
                'name' => $this->name,
                'description' => $this->description,
                'priority' => $this->priority,
                'due_date' => $this->dueDate,
                'loss_reduction_id' => $this->unverifiedCustomer->id ? $this->unverifiedCustomer->id : $this->verifiedCustomer->id, // Replace with the actual service order ID
                'crew_id' => $this->selectedCrew,
                'assigned_by_id' =>  Auth::id(),
            ]);
            if ($task) {
                $this->dispatchBrowserEvent('success', ['message' => 'Assign to crew Successfully.']);
            }
        } elseif (empty($this->selectedCrew) && !empty($this->selectedUser)) {
            // Create and save the task in the tasks table
            $task = Task::create([
                'name' => $this->name,
                'description' => $this->description,
                'priority' => $this->priority,
                'due_date' => $this->dueDate,
                'loss_reduction_id' => $this->verifiedCustomer->id, // Replace with the actual service order ID
                'assigned_to_id' => $this->selectedUser,
                'assigned_by_id' =>  Auth::id(),
            ]);
            if ($task) {
                $this->dispatchBrowserEvent('success', ['message' => 'Assign to user Successfully.']);
            }
        } else {
            $this->dispatchBrowserEvent('warning', ['message' => 'You cannot assign to both Crew and User Simultaneously.']);
        }

        // Reset form fields
        $this->name = '';
        $this->description = '';
        $this->priority = 'processing';
        $this->dueDate = null;
        $this->selectedCrew = null;
        $this->selectedUser = null;

        // Additional logic or redirects as needed
    }

    public function enableFields()
    {
        $this->fieldsDisabled = !$this->fieldsDisabled;
        $this->fetchLocation();
    }



    public function editUnVerifiedLossReduction()
    {
        // Validate the form fields
        $this->validate([
            'reportedActivity' => 'required|max:255',
            'nearestLandmark' => 'max:255',
            'street' => 'max:255',
            'city' => 'max:255',
            // 'stateProvinceLocation' => 'max:255',
            'postalCodeLocation' => 'max:255',
            'descriptionOfSuspectedActivity' => 'max:255',
            'reportedBy' => 'max:255',
            'contactNumber' => 'max:20',
            'file' => 'max:255',
            'recommendation' => 'max:255',
        ]);

        // Check if the verifiedCustomer exists and has an 'id'
        if ($this->unverifiedCustomer && $this->unverifiedCustomer->id) {
            // Find the LossReductionCase by 'id'
            $lossReduction = LossReductionCase::find($this->unverifiedCustomer->id);

            if ($lossReduction) {
                // Update the LossReductionCase fields
                $lossReduction->update([
                    'reported_activity' => $this->reportedActivity,
                    'nearest_landmark' => $this->nearestLandmark,
                    'street' => $this->street,
                    'city' => $this->city,
                    // 'stateProvinceLocation' => $this->stateProvinceLocation,
                    'postal_code_location' => $this->postalCodeLocation,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'recommendation' => $this->recommendation,
                ]);

                // Handle file upload if a new file is selected
                if ($this->file) {
                    $imagePath = $this->file->store('public/images');
                    $lossReduction->file = $imagePath;
                    $lossReduction->save();
                }

                $this->fetchLocation();

                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);

                // Reset the form fields


                // You can also display a success message here if needed.
            }
        }
    }

    public function editVerifiedLossReduction()
    {
        // Validate the form fields
        $this->validate([
            'sourceOfDetection' => 'required|max:255',
            'customerSPN' => 'max:255',
            'meterNumber' => 'max:255',
            'fullname' => 'max:255',
            'geoCommunity' => 'max:255',
            'geoZone' => 'max:255',
            // 'state_province' => 'max:255',
            'postalCode' => 'max:255',
        ]);

        // Check if the verifiedCustomer exists
        if ($this->verifiedCustomer) {
            // Find the LossReductionCase by 'id'
            $lossReduction = LossReductionCase::find($this->verifiedCustomer->id);

            if ($lossReduction) {
                // Update the LossReductionCase fields
                $lossReduction->update([
                    'source_of_detection' => $this->sourceOfDetection,
                    'customer_spn' => $this->customerSPN,
                    'meter_number' => $this->meterNumber,
                    'fullname' => $this->fullname,
                    'geo_community' => $this->geoCommunity,
                    'geo_zone' => $this->geoZone,
                    // 'state_province' => $this->stateProvince,
                    'postal_code' => $this->postalCode,
                ]);

                $this->fetchLocation();
                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);
                // Reset the form fields


                // You can also display a success message here if needed.
            }
        }
    }

    public function mount(LossReductionCase $id)
    {
        if ($id->customer_account_verified === 'yes') {
            $this->verifiedCustomer = $id;
            $this->sourceOfDetection = $this->verifiedCustomer->source_of_detection;
            $this->customerSPN = $this->verifiedCustomer->customer_spn;
            $this->meterNumber = $this->verifiedCustomer->meter_number;
            $this->fullname = $this->verifiedCustomer->fullname;
            $this->geoCommunity = $this->verifiedCustomer->geo_community;
            $this->geoZone = $this->verifiedCustomer->geo_zone;
            $this->taskComments = TaskComment::orderBy('created_at', 'desc')->where('task_id', $this->verifiedCustomer->id)->get();
            $this->location = $this->verifiedCustomer->location;
        } else {
            $this->unverifiedCustomer = $id;
            $this->reportedActivity = $this->unverifiedCustomer->reported_activity;
            $this->nearestLandmark = $this->unverifiedCustomer->nearest_landmark;
            $this->street = $this->unverifiedCustomer->street;
            $this->city = $this->unverifiedCustomer->city;
            $this->descriptionOfSuspectedActivity = $this->unverifiedCustomer->description_of_suspected_activity;
            $this->reportedBy = $this->unverifiedCustomer->reported_by;
            $this->contactNumber = $this->unverifiedCustomer->contact_number;
            $this->recommendation = $this->unverifiedCustomer->recommendation;
            $this->location = $this->unverifiedCustomer;
        }
    }

    public function closeStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is in Process']);
        } else {
            $this->task->update(['status' => 'Closed']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Closed']);
        }
    }

    public function completeStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is in Process']);
        } else {
            $this->task->update(['status' => 'Completed']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Completed']);
        }
    }

    public function openStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is Already in Process']);
        } else {
            $this->task->update(['status' => 'Open']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Open']);
        }
    }

    public function render()
    {
        $crews = Crew::all();
        $users = User::all();
        return view('livewire.admin.loss-reduction-case-detail', ['crews' => $crews, 'users' => $users]);
    }
}
