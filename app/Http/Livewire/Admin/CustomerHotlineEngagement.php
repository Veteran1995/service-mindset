<?php

namespace App\Http\Livewire\Admin;

use App\Models\LossReductionCase;
use App\Models\LossReductionCaseType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerHotlineEngagement extends Component
{
    public $latitude;
    public $longitude;
    public $address;

    public $sourceOfDetection;
    public $lossReductionCaseType;
    public $geoCommunity;
    public $reportedActivity;
    public $nearestLandmark;
    public $street;
    public $city;
    public $descriptionOfSuspectedActivity;
    public $reportedBy;
    public $contactNumber;
    public $recommendation;
    public $pscoreNumber;
    public $impactKwh;
    public $frequencyScore;
    public $suspectName;

    protected $listeners = ['placeSelected'];

    public function placeSelected($data)
    {
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }

    public function resetForm()
    {
        $this->sourceOfDetection = null;
        $this->lossReductionCaseType = null;
        $this->geoCommunity = null;
        $this->reportedActivity = null;
        $this->nearestLandmark = null;
        $this->street = null;
        $this->city = null;
        $this->descriptionOfSuspectedActivity = null;
        $this->reportedBy = null;
        $this->contactNumber = null;
        $this->recommendation = null;
        $this->pscoreNumber = null;
        $this->impactKwh = null;
        $this->frequencyScore = null;
        $this->suspectName = null;
    }

    public function addLossReduction()
    {

            $this->validate([
                'suspectName' => 'required',
                'reportedActivity' => 'required|max:255',
                'nearestLandmark' => 'max:255',
                'lossReductionCaseType' => 'required|max:255',
                'address' => 'max:255',
                'city' => 'max:255',
                'descriptionOfSuspectedActivity' => 'max:255',
                'reportedBy' => 'max:255',
                'contactNumber' => 'max:20',
                'recommendation' => 'max:255',
            ]);


                $add = LossReductionCase::create([
                    'reported_activity' => $this->reportedActivity,
                    'suspect_name' => $this->suspectName,
                    'nearest_landmark' => $this->nearestLandmark,
                    'case_type' => $this->lossReductionCaseType,
                    'address' => $this->address,
                    'source_of_detection' =>"HOT4600",
                    'city' => $this->city,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'recommendation' => $this->recommendation,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'engagement' => 1,
                    'reported' => 1,
                    'user_id' => Auth::id(), // Add the employee_id here
                ]);

                $this->reset();
                
                $this->dispatchBrowserEvent('success', ['message' => 'Added Successfully.']);
                // Reset the form fields
                
        
    }

    public function render()
    {
        $casetypes = LossReductionCaseType::all();
        return view('livewire.admin.customer-hotline-engagement', ['caseType'=>$casetypes]);
    }
}
