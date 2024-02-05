<?php

namespace App\Http\Livewire\Admin;

use App\Models\Crew;
use App\Models\LossReductionCase;
use App\Models\LossReductionCaseType;
use App\Models\Customer;
use App\Models\User;
use App\Models\Task;
use App\Notifications\RealTimeNotification;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class LossReduction extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
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

    public $showAddForm = true;
    public $showVerifiedEditForm = false;
    public $showUnVerifiedEditForm = false;

    public $unverifiedCustomer;
    public $verifiedCustomer;

    public $filterBysourceOfDetection;
    public $filterByVerification;
    public $filterReportedActivity;
    public $filterByDate;
    public $endDate;
    public $startDate;

    public $forwardForEngagement = false;
    public $forwardForAssessment = false;

    public $addTaskForm = false;
    public $addUnVerifiedCustomerTaskForm = false;

    public $casetypes;
    public $searchIgnore = false;

    protected $fetchAllCases; // Use a protected property


    public $name;
    public $description;
    public $priority = "low";
    public $dueDate;
    public $selectedCrew;
    public $selectedUser;
    public $crewOrUserToggle = false; // Initialize with 'Crew' selected

    public $showModal = false;

    public function showForm()
    {
        $this->dispatchBrowserEvent('showForm');
    }

    public function toggleForwardForAssessment()
    {
        $this->forwardForAssessment = !$this->forwardForAssessment;
    }

    public function resetFilters()
    {
        $this->filterBysourceOfDetection = null;
        $this->filterByVerification = null;
        $this->filterReportedActivity = null;
        $this->filterByDate = null;
        $this->endDate = null;
        $this->startDate = null;

        // Replace this with your actual User model instance
        $user = User::find(93654086);

        $someData = "Francis";

        // Trigger the event
        event(new NotificationEvent($someData));

        // Send the notification
        $user->notify(new RealTimeNotification($someData));
    }

    public function toggleForwardForEngagement()
    {
        $this->forwardForEngagement = !$this->forwardForEngagement;
    }

    public function verifyCustomer()
    {
        $customer = Customer::where('cnumber', $this->customerSPN)->first();
        if ($customer) {
            $this->meterNumber = $customer->meter_number;
            $this->fullname = $customer->customer_name;
            $this->geoCommunity = $customer->geo_community;
            $this->geoZone = $customer->geo_zone;
        } else {
            $this->dispatchBrowserEvent('warning', ['message' => 'Wrong Customer SPN.']);
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
                    'engagement' => 1,
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
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'assessment' => 1,
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
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
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
                'reportedActivity' => 'required|max:255',
                'nearestLandmark' => 'max:255',
                'lossReductionCaseType' => 'required|max:255',
                'street' => 'max:255',
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
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'street' => $this->street,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'engagement' => 1,
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
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'street' => $this->street,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
                    'assessment' => 1,
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
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'street' => $this->street,
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'file' => $imagePath,
                    'recommendation' => $this->recommendation,
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

    public function unverifiedCustomer(LossReductionCase $id)
    {
        $this->unverifiedCustomer = $id;
        $this->reportedActivity = $this->unverifiedCustomer->reported_activity;
        $this->nearestLandmark = $this->unverifiedCustomer->nearest_landmark;
        $this->street = $this->unverifiedCustomer->street;
        $this->city = $this->unverifiedCustomer->city;
        $this->descriptionOfSuspectedActivity = $this->unverifiedCustomer->description_of_suspected_activity;
        $this->reportedBy = $this->unverifiedCustomer->reported_by;
        $this->contactNumber = $this->unverifiedCustomer->contact_number;
        $this->recommendation = $this->unverifiedCustomer->recommendation;
        $this->showVerifiedEditForm = false;
        $this->showAddForm = false;
        $this->showUnVerifiedEditForm = true;
        $this->verifiedCustomer = "";
    }

    public function verifiedCustomer(LossReductionCase $id)
    {
        $this->verifiedCustomer = $id;
        $this->sourceOfDetection = $this->verifiedCustomer->source_of_detection;
        $this->customerSPN = $this->verifiedCustomer->customer_spn;
        $this->meterNumber = $this->verifiedCustomer->meter_number;
        $this->fullname = $this->verifiedCustomer->fullname;
        $this->geoCommunity = $this->verifiedCustomer->geo_community;
        $this->geoZone = $this->verifiedCustomer->geo_zone;
        $this->showAddForm = false;
        $this->showUnVerifiedEditForm = false;
        $this->showVerifiedEditForm = true;
        $this->unverifiedCustomer = "";
    }

    public function viewAllCases()
    {
        // Use the `paginate` method to retrieve paginated data
        $this->fetchAllCases = LossReductionCase::all();
    }

    // Fetching All Records and Adding Search and Filters
    public function filter()
    {
        $this->searchIgnore = true;
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

        // Use a date range filter if both start and end dates are provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('updated_at', [$this->startDate, $this->endDate]);
        } elseif ($this->startDate) {
            // If only one date is provided, use the single date filter
            $query->whereDate('updated_at', $this->startDate);
        }

        // Check if any filters are applied
        $hasFilters = $this->filterByVerification || $this->filterReportedActivity || $this->filterBysourceOfDetection || $this->startDate || $this->endDate;
        $this->searchIgnore = false;
        // Assign the result of the query to the fetchAllCases property
        $this->fetchAllCases = $hasFilters ? $query->latest()->paginate(8) : collect();
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
            'street' => 'max:255',
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
                    'street' => $this->street,
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
        $fetchAllCases =  $this->fetchAllCases;
        $crews = Crew::all();
        $users = User::all();
        return view('livewire.admin.loss-reduction', ['fetchAllCases' => $fetchAllCases, 'caseType' => $this->casetypes, 'crews' => $crews, 'users' => $users]);
    }
}
