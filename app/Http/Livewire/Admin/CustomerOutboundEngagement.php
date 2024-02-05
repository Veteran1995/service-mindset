<?php

namespace App\Http\Livewire\Admin;

use App\Models\Crew;
use App\Models\LossReductionCase;
use App\Models\LossReductionCaseType;
use App\Models\LossReductionEngagementUserComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CustomerOutboundEngagement extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    // Livewire component properties with model binding
    public $source;
    public $energy_source_question;

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
    public $address;
    public $suspectName;

    public $filterBysourceOfDetection;
    public $filterByVerification;
    public $filterReportedActivity;
    public $filterByDate;
    public $endDate;
    public $startDate;

    public $casetypes;
    public $searchIgnore = false;

    protected $fetchAllCases; // Use a protected property

    public $customer;
    public $case_id;


    public $recordPerPage="";

    public $registerCaseId;


    public $anomaly_reported_type;
    public $anomaly_registered_type;
    public $energy_source;
    public $comment;


    protected $rules = [
        'anomaly_reported_type' => 'nullable|string',
        'anomaly_registered_type' => 'nullable|string',
        'energy_source' => 'nullable|string',
        'comment' => 'nullable|string',
    ];


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
        $this->fetchAllCases = LossReductionCase::where('engagement', 1)->paginate($this->recordPerPage);
    }

    public function viewCustomer(LossReductionCase $id)
    {
        $this->customer=$id;
        
        $this->dispatchBrowserEvent('viewCustomerModal');

    }

    public function searchCase(LossReductionCase $case)
    {
        $this->case_id=$case;

        // $this->fullname = $case->fullname;
        // $this->suspectName = $case->suspect_Name;
        // $this->geoCommunity = $case->geo_community;
        // $this->geoZone = $case->geo_zone;
        // $this->lossReductionCaseType = $case->case_type;
        // $this->contactNumber = $case->contact_number;
        // $this->address = $case->address;
        // $this->city = $case->city;

        $this->source = $case->source;
        $this->energy_source_question = $case->energy_source_question;
        $this->sourceOfDetection = $case->source_of_detection;
        $this->lossReductionCaseType = $case->case_type;
        $this->customerSPN = $case->customer_spn;
        $this->meterNumber = $case->meter_number;
        $this->fullname = $case->fullname;
        $this->geoCommunity = $case->geo_community;
        $this->geoZone = $case->geo_zone;
        $this->reportedActivity = $case->reported_activity;
        $this->nearestLandmark = $case->nearest_landmark;
        $this->street = $case->address;
        $this->city = $case->city;
        $this->descriptionOfSuspectedActivity = $case->description_of_suspected_activity;
        $this->reportedBy = $case->reported_by;
        $this->contactNumber = $case->contact_number;
        $this->file = $case->file;
        $this->recommendation = $case->recommendation;
        $this->address = $case->address;
        $this->suspectName = $case->suspect_name;

        $this->viewAllCases();
        

    }

    public function sendComment(LossReductionCase $case)
    {
        $this->case_id=$case;

        $this->fullname = $case->fullname;
        $this->suspectName = $case->suspect_name;
        $this->geoCommunity = $case->geo_community;
        $this->geoZone = $case->geo_zone;
        $this->lossReductionCaseType = $case->case_type;
        $this->contactNumber = $case->contact_number;
        

    }

    public function resetForm()
    {
        $this->reset();
    }

    public function addLossReductionComment()
    {
        $this->validate();

        // Insert the comment into the table
        LossReductionEngagementUserComment::create([
            'case_id' => $this->case_id->id,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
            'anomaly_reported_type' => $this->anomaly_reported_type,
            'anomaly_registered_type' => $this->anomaly_registered_type,
            'energy_source' => $this->energy_source,
        ]);

        // Update the case status to "scheduled"
        $this->case_id->update([
            'status' => 'scheduled',
        ]);

        // Clear the input field
        $this->reset();
        $this->dispatchBrowserEvent('success', ['message' => 'Comment Added Successfully']);

        // Optionally, you can emit an event or update the page as needed.
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

        $query->where('engagement', 1);

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
        
        return view('livewire.admin.customer-outbound-engagement',['fetchAllCases' => $fetchAllCases, 'caseType' => $this->casetypes, 'crews' => $crews, 'users' => $users]);
    }
}
