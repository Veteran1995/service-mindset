<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Admin\Meters\Meters;
use App\Models\Crew;
use App\Models\LossReductionCase;
use App\Models\LossReductionCaseType;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddLostReductionCase extends Component
{
    use WithFileUploads;
    // Livewire component properties with model binding
    public $customerAccountVerified = ''; // Default value is 'yes'

    public $sourceOfDetection;
    public $lossReductionCaseType;
    public $customerSPN;
    public $meterNumber;
    public $fullname;
    public $geoCommunity;
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
    public $pscoreNumber;
    public $impactKwh;
    public $frequencyScore;
    public $suspectName;

    public $customer;
    public $meter;

    public $xcordinate;
    public $ycordinate;

    public $latitude;
    public $longitude;
    public $address;

    public $showAddForm = true;
    public $showVerifiedEditForm = false;
    public $showUnVerifiedEditForm = false;

    public $unverifiedCustomer;
    public $verifiedCustomer;

    public $filterBysourceOfDetection;
    public $filterByVerification;
    public $filterReportedActivity;
    public $filterByDate;

    public $forwardForEngagement = false;
    public $forwardForAssessment = false;

    public $addTaskForm = false;
    public $addUnVerifiedCustomerTaskForm = false;

    public $casetypes;

    public $name;
    public $description;
    public $priority = "low";
    public $dueDate;
    public $selectedCrew;
    public $selectedUser;
    public $crewOrUserToggle = false; // Initialize with 'Crew' selected

    public $showModa2l = false;

    protected $listeners = ['addressSelected', 'placeSelected'];

    public function addressSelected($data)
    {
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }

    public function resetForm()
    {
        $this->customerAccountVerified = '';
        $this->sourceOfDetection = null;
        $this->lossReductionCaseType = null;
        $this->customerSPN = null;
        $this->meterNumber = null;
        $this->fullname = null;
        $this->geoCommunity = null;
        $this->geoZone = null;
        $this->reportedActivity = null;
        $this->nearestLandmark = null;
        $this->street = null;
        $this->city = null;
        $this->descriptionOfSuspectedActivity = null;
        $this->reportedBy = null;
        $this->contactNumber = null;
        $this->file = null;
        $this->recommendation = null;
        $this->pscoreNumber = null;
        $this->impactKwh = null;
        $this->frequencyScore = null;
        $this->suspectName = null;
    }

    public function showForm()
    {
        $this->dispatchBrowserEvent('showForm');
    }

    public function toggleForwardForAssessment()
    {
        $this->forwardForAssessment = !$this->forwardForAssessment;
    }

    public function toggleForwardForEngagement()
    {
        $this->forwardForEngagement = !$this->forwardForEngagement;
    }

    public function customerLocation()
    {
        if($this->customer)
        {
        
            $this->dispatchBrowserEvent('customerLocation', ['location' => $this->customer->location]);

        }elseif($this->meter){
            $this->dispatchBrowserEvent('customerLocation', ['location' => $this->meter->customer->location]);

        }else{
            $location = (object) [
                'latitude' => 0.0, // Default latitude value
                'longitude' => 0.0, // Default longitude value
            ];
            $this->dispatchBrowserEvent('customerLocation', ['location' => $location]);
        }
    }

    public function verifyCustomer()
    {
        $this->customer = Customer::where('cnumber', $this->customerSPN)->first();
        if ($this->customer) {
            $this->meterNumber = $this->customer->meter_number;
            $this->fullname = $this->customer->customer_name;
            $this->geoCommunity = $this->customer->geo_community;
            $this->geoZone = $this->customer->geo_zone;
            $this->xcordinate = $this->customer->gis_x_coordinates;
            $this->ycordinate=$this->customer->gis_y_coordinates;


            $this->dispatchBrowserEvent('customerLocation', ['location' => $this->customer->location]);

        } else {
            $this->dispatchBrowserEvent('warning', ['message' => 'Wrong Customer SPN.']);
        }
    }
    public function verifyMeter()
    {
        $this->meter = Meter::where('meter_serial_number', $this->meterNumber)->first();
        if ($this->meter) {
            $this->meterNumber = $this->meter->meter_serial_number;
            $this->fullname = $this->meter->customer->customer_name;
            $this->geoCommunity = $this->meter->customer->geo_community;
            $this->geoZone = $this->meter->customer->geo_zone;
            $this->customerSPN = $this->meter->customer->cnumber;
            $this->xcordinate = $this->meter->customer->gis_x_coordinates;
            $this->ycordinate=$this->meter->customer->gis_y_coordinates;

            $this->dispatchBrowserEvent('customerLocation', ['location' => $this->meter->customer->location]);
        } else {
            $this->dispatchBrowserEvent('warning', ['message' => 'Meter Not Found']);
        }
    }

    public function addLossReduction()
    {

        // Add your logic here based on the radio button selection
        if ($this->customerAccountVerified === 'yes') {
            // Handle the case when customer_account_verified is 'yes'
            $this->validate([
                'customerAccountVerified' => 'required',
                'sourceOfDetection' => 'required|max:255',
                'lossReductionCaseType' => 'required|max:255',
                'customerSPN' => 'required|max:255',
                'meterNumber' => 'required|max:255',
                'fullname' => 'required|max:255',
                'geoCommunity' => 'required|max:255',
                'geoZone' => 'required|max:255',
                'descriptionOfSuspectedActivity' => 'max:255',
                'reportedBy' => 'max:255',
                'contactNumber' => 'max:20',
                'recommendation' => 'max:255',
            ]);

            $imagePath = null;

            if ($this->file) {
                $imagePath = $this->file->store('public/images'); // Store the file
                $imagePath = str_replace('public/', '', $imagePath); // Update the path
            }
            // Add data to the database using Eloquent or your preferred method
            // Example Eloquent code:
            if ($this->forwardForEngagement === true) {
                $result = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'source_of_detection' => $this->sourceOfDetection,
                    'case_type' => $this->lossReductionCaseType,
                    'customer_spn' => $this->customerSPN,
                    'meter_number' => $this->meterNumber,
                    'fullname' => $this->fullname,
                    'geo_community' => $this->geoCommunity,
                    'geo_zone' => $this->geoZone,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'engagement' => 1,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                ]);


                if ($result) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully and Forwarded For Engagement.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            } elseif ($this->forwardForAssessment === true) {
                $result = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'source_of_detection' => $this->sourceOfDetection,
                    'case_type' => $this->lossReductionCaseType,
                    'customer_spn' => $this->customerSPN,
                    'meter_number' => $this->meterNumber,
                    'fullname' => $this->fullname,
                    'geo_community' => $this->geoCommunity,
                    'geo_zone' => $this->geoZone,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'assessment' => 1,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                ]);

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
                        'loss_reduction_id' => $result->id, // Replace with the actual service order ID
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
                        'loss_reduction_id' => $result->id, // Replace with the actual service order ID
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
                if ($result) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully and Forwarded For Assessment.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            } else {
                $result = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'source_of_detection' => $this->sourceOfDetection,
                    'case_type' => $this->lossReductionCaseType,
                    'customer_spn' => $this->customerSPN,
                    'meter_number' => $this->meterNumber,
                    'fullname' => $this->fullname,
                    'geo_community' => $this->geoCommunity,
                    'geo_zone' => $this->geoZone,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                    // ... add other fields ...
                ]);

                if ($result) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            }
        } else {
            // Handle the case when customer_account_verified is 'no'
            $this->validate([
                'customerAccountVerified' => 'required',
                'suspectName' => 'required',
                'reportedActivity' => 'required|max:255',
                'sourceOfDetection' => 'required|max:255',
                'nearestLandmark' => 'max:255',
                'lossReductionCaseType' => 'required|max:255',
                'address' => 'max:255',
                'city' => 'max:255',
                'descriptionOfSuspectedActivity' => 'max:255',
                'reportedBy' => 'max:255',
                'contactNumber' => 'max:20',
                'recommendation' => 'max:255',
            ]);

            $imagePath = null;

            if ($this->file) {
                $imagePath = $this->file->store('public/images'); // Store the file
                $imagePath = str_replace('public/', '', $imagePath); // Update the path
            }

            // Add data to the database using Eloquent or your preferred method
            // Example Eloquent code:

            if ($this->forwardForEngagement === true) {
                $add = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'reported_activity' => $this->reportedActivity,
                    'suspect_name' => $this->suspectName,
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'address' => $this->address,
                    'source_of_detection' => $this->sourceOfDetection,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'engagement' => 1,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                ]);
                if ($add) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully and Forwarded For Engagement.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            } elseif ($this->forwardForAssessment === true) {
                $add = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'reported_activity' => $this->reportedActivity,
                    'source_of_detection' => $this->sourceOfDetection,
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'address' => $this->address,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'assessment' => 1,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                ]);

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
                        'loss_reduction_id' => $add->id, // Replace with the actual service order ID
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
                        'loss_reduction_id' => $add->id, // Replace with the actual service order ID
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


                if ($add) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully and Forwarded For Assessment.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            } else {
                $add = LossReductionCase::create([
                    'customer_account_verified' => $this->customerAccountVerified,
                    'reported_activity' => $this->reportedActivity,
                    'source_of_detection' => $this->sourceOfDetection,
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'address' => $this->address,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'suspect_name' => $this->suspectName,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                    // ... add other fields ...
                ]);

                if ($add) {
                    $this->dispatchBrowserEvent('success', ['message' => 'Reported Successfully.']);
                } else {
                    $this->dispatchBrowserEvent('warning', ['message' => 'Error.']);
                }
            }
        }

        // Reset the form fields
        $this->reset();
    }


    // Fetching All Records and Adding Search and Filters
    public function getCasesProperty()
    {
        $query = LossReductionCase::select('*');

        if ($this->filterByVerification) {
            $query->where('customer_account_verified', $this->filterByVerification);
        }

        if ($this->filterReportedActivity) {
            $query->where('reported_activity', $this->filterReportedActivity);
        }

        if ($this->filterBysourceOfDetection) {
            $query->where('source_of_detection', $this->filterBysourceOfDetection);
        }

        if ($this->filterByDate) {
            $query->whereDate('updated_at', $this->filterByDate);
        }

        return $query->latest()->paginate(8);
    }


    public function showAddForm()
    {
        $this->showAddForm = true;
        $this->showUnVerifiedEditForm = false;
        $this->showVerifiedEditForm = false;
    }

    public function editUnVerifiedLossReduction()
    {
        // Validate the form fields
        $this->validate([
            'reportedActivity' => 'required|max:255',
            'nearestLandmark' => 'max:255',
            'address' => 'max:255',
            'city' => 'max:255',
            'stateProvinceLocation' => 'max:255',
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
                    'address' => $this->address,
                    'city' => $this->city,
                    'state_province_location' => $this->stateProvinceLocation,
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
                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);
                // Reset the form fields
                $this->reset();

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
            'stateProvince' => 'max:255',
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
                    'state_province' => $this->stateProvince,
                    'postal_code' => $this->postalCode,
                ]);

                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);
                // Reset the form fields
                $this->reset();

                // You can also display a success message here if needed.
            }
        }
    }

    public function showAddTaskForm()
    {
        $this->addTaskForm = true;
    }

    public function showAddUnverifiedCustomerTaskForm()
    {
        $this->addUnVerifiedCustomerTaskForm = true;
    }
    public function closeUnverifiedCustomerForm()
    {
        $this->addUnVerifiedCustomerTaskForm = false;
    }

    public function closeForm()
    {
        $this->addTaskForm = false;
    }

    public function closeCase()
    {
        // Update the case status to "scheduled"
        $this->verifiedCustomer->update([
            'status' => 'scheduled',
        ]);
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
                'loss_reduction_id' => $this->verifiedCustomer->id, // Replace with the actual service order ID
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


    public function render()
    {
        $this->casetypes = LossReductionCaseType::all();
        $cases =   $this->cases;
        $crews = Crew::all();
        $users = User::all();

        $this->customerLocation();
        return view('livewire.admin.add-lost-reduction-case', ['cases' => $cases, 'caseType' => $this->casetypes, 'crews' => $crews, 'users' => $users,]);
    }
}
