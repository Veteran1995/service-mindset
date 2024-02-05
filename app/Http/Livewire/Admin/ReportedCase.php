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

class ReportedCase extends Component
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


    public $recordPerPage="";

    public $registerCaseId;


    public function resetFilters()
    {
        $this->filterBysourceOfDetection = null;
        $this->filterByVerification = null;
        $this->filterReportedActivity = null;
        $this->filterByDate = null;
        $this->endDate = null;
        $this->startDate = null;

        $this->recordPerPage = "";

    }

    public function registerModal(LossReductionCase $id)
    {
        $this->registerCaseId = $id;
        $this->dispatchBrowserEvent('showRegisterModal');

    }

    public function registerCase()
    {
        $this->registerCaseId->update(['registration_status'=>1]);
        $this->dispatchBrowserEvent('closeRegisterModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Case Registered Successfully.']);

    }


    public function viewAllCases()
    {
        // Use the `paginate` method to retrieve paginated data
        $this->fetchAllCases = LossReductionCase::where('reported', 1)->paginate($this->recordPerPage);
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

        $query->where('reported', 1);

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
        $this->fetchAllCases = $hasFilters ? $query->latest()->paginate($this->recordPerPage) : collect();
    }



    public function render()
    {
        $this->casetypes = LossReductionCaseType::all();
        $fetchAllCases =  $this->fetchAllCases;
        $crews = Crew::all();
        $users = User::all();
        return view('livewire.admin.reported-case', ['fetchAllCases' => $fetchAllCases, 'caseType' => $this->casetypes, 'crews' => $crews, 'users' => $users]);
    }
}
