<?php

namespace App\Http\Livewire\Admin\Meters;

use App\Models\AssigmentMeters;
use App\Models\ItineraryHistory;
use Livewire\WithFileUploads;
use App\Models\Meter;
use App\Models\MeterAssignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Meters extends Component
{
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchSerialNumber;
    public $isCreating = false;
    public $assigned;
    public $unassigned;
    public $image;
    public $selectedRows = [];
    public $selectedPageRows = false;

    // Livewire component properties
    public $filterByMeterNumber;
    public $filterByPhase;
    public $filterByMeterMake;
    public $filterByOrganization;


    public $user_id;
    public $reading_circle = 'Weekly';
    public $energy_type = 'Active';
    public $completion_date;
    public $comment;

    public $filterByAssigned = false; // Property to hold the checkbox value
    public $filterByUnassigned = false; // Property to hold the checkbox value

    public $photoPath;

    public $totalMeters;
    public $totalAssignedMeters;
    public $totalUnassignedMeters;

    public $state = [
        'name' => '',
        'serial_number' => '',
        'seal_tag' => '',
    ];

    protected $rules = [
        'state.name' => 'required',
        'state.serial_number' => 'required',
        'state.seal_tag' => 'required',
    ];

    public function mount()
    {
        // Calling the static functions directly on the User model
        $this->totalMeters = Meter::getTotalMeters();
        $this->totalAssignedMeters = Meter::getTotalAssignedMeters();
        $this->totalUnassignedMeters = Meter::getTotalUnassignedMeters();
    }

    // Filtering Records by Agent
    public function filterByUnassigned()
    {
        // Access the checkbox value using the $this->filterByAgent property
        if ($this->filterByUnassigned) {
            // Checkbox is checked
            // Perform the desired action
            $this->unassigned = 0;
        } else {
            // Checkbox is unchecked
            // Perform the desired action
            $this->unassigned = 1;
        }
    }

    // Filtering Records by Admin
    public function filterByAssigned()
    {
        // Access the checkbox value using the $this->filterByAgent property
        if ($this->filterByAssigned) {
            // Checkbox is checked
            // Perform the desired action
            $this->assigned = 1;
        } else {
            // Checkbox is unchecked
            // Perform the desired action
            $this->assigned = 0;
        }
    }

    // Fetching All Records and Adding Search and Filters
    public function getMetersProperty()
    {
        $query = Meter::query()
            ->where('meter_serial_number', 'like', '%' . $this->searchSerialNumber . '%');

        if ($this->filterByMeterMake) {
            $query->where('meter_make', 'like', '%' . $this->filterByMeterMake . '%');
        }

        if ($this->filterByOrganization) {
            $query->where('organization', 'like', '%' . $this->filterByOrganization . '%');
        }

        if ($this->filterByPhase) {
            $query->where('phase', 'like', '%' . $this->filterByPhase . '%');
        }

        if ($this->filterByMeterNumber) {
            $query->where('meter_serial_number', 'like', '%' . $this->filterByMeterNumber . '%');
        }

        // Log the generated SQL query
        \Log::info('SQL Query:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        // Only paginate if filters are applied
        return $query->paginate(8);
    }

    public function clearFilters()
    {
        $this->filterByMeterNumber = null;
        $this->filterByPhase = null;
        $this->filterByMeterMake = null;
        $this->filterByOrganization = null;

        // You can also add additional reset logic as needed

        // After resetting the filters, you may want to reload the data or perform any other necessary actions
        $this->getMetersProperty();
    }




    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->meters->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }

    // DELETING RECORD AFTER CHECKING THE CHECKBOXES
    public function deleteSelectedRow()
    {
        if (Meter::whereIn('id', $this->selectedRows)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'Meter Record Deleted Successfully']);
        }
    }

    public function addMeter()
    {

        $validatedData = $this->validate();
        $this->isCreating = true; // Set the flag to indicate user creation is in progress

        // Handle file upload
        if ($this->image) {
            $this->photoPath = $this->image->store('images', 'public');
            // $validatedData['photo'] = $photoPath;
        }

        // Create the meter record
        Meter::create([
            'name' => $this->state['name'],
            'serial_number' => $this->state['serial_number'],
            'seal_tag' => $this->state['seal_tag'],
            'photo' =>  $this->photoPath,
        ]);

        // Clear the form fields
        $this->reset(['state', 'image']);
        $this->isCreating = false; // Reset the flag after user creation is complete
        $this->dispatchBrowserEvent('success', ['message' => 'Meter Added Successfully.']);
    }

    public function assignSelectedMeter()
    {
        $this->dispatchBrowserEvent('openReadingTaskModal');
    }

    // public function addReadingTasks()
    // {
    //     $this->validate([
    //         'user_id' => 'required',
    //         'reading_circle' => 'required',
    //         'energy_type' => 'required',
    //     ]);

    //     // Create a new meter assignment
    //     $meterAssignment  = MeterAssignment::create([
    //         'user_id' => $this->user_id,
    //         'itinerary_no' => 'IT' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
    //         'reading_circle' => $this->reading_circle,
    //         'circle' => $this->reading_circle,
    //         'energy_type' => $this->energy_type,
    //         'completion_date' => $this->completion_date,
    //         'comment' => $this->comment,
    //     ]);

    //     if ($meterAssignment) {
    //         // Loop through selectedRows and insert associated meter_id values
    //         foreach ($this->selectedRows as $meterId) {
    //             AssigmentMeters::create([
    //                 'assign_id' => $meterAssignment->id,
    //                 'meter_id' => $meterId,
    //             ]);
    //         }

    //         $this->dispatchBrowserEvent('success', ['message' => 'Meter Assign Successfully for Reading.']);
    //         $this->dispatchBrowserEvent('closeReadingTaskModal');
    //     } else {
    //     }

    //     // Reset the form fields
    //     $this->reset(['user_id', 'reading_circle', 'energy_type']);
    // }

    public function addReadingTask()
    {
        $this->validate([
            'user_id' => 'required',
            'reading_circle' => 'required',
            'energy_type' => 'required',
        ]);

        // Determine cycle type and set the format accordingly
        $cycleType = $this->getCycleType(); // You need to implement this method based on your logic

        // Create a new meter assignment
        $meterAssignment = MeterAssignment::create([
            'user_id' => $this->user_id,
            'itinerary_no' => 'IT' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'reading_circle' => $this->reading_circle,
            'circle' => $this->generateItineraryNumber($cycleType),
            'energy_type' => $this->energy_type,
            'completion_date' => $this->completion_date,
            'comment' => $this->comment,
        ]);

        if ($meterAssignment) {
            // Loop through selectedRows and insert associated meter_id values
            foreach ($this->selectedRows as $meterId) {
                AssigmentMeters::create([
                    'assign_id' => $meterAssignment->id,
                    'meter_id' => $meterId,
                ]);
            }

            $this->dispatchBrowserEvent('success', ['message' => 'Meter Assign Successfully for Reading.']);
            $this->dispatchBrowserEvent('closeReadingTaskModal');
        } else {
            // Handle failure if needed
        }

        ItineraryHistory::create([
            'itinerary_id' => $meterAssignment->id,
            'user_id' => Auth::id(),
            'action' => 'Created',
            'comment' => Auth::user()->firstname . ' ' . Auth::user()->lastname . ' create an itinerary',
        ]);

        // Reset the form fields
        $this->reset(['user_id', 'reading_circle', 'energy_type']);
    }

    // Helper method to generate itinerary number based on cycle type
    private function generateItineraryNumber($cycleType)
    {
        $yearMonth = now()->format('Ym');
        $sequence = $this->getSequenceNumber($cycleType);

        if ($cycleType == 'M') {
            return "{$cycleType}-{$yearMonth}";
        } elseif ($cycleType == 'BM') {
            return "{$cycleType}-{$yearMonth}-{$sequence}";
        } else {
            return "{$cycleType}-{$yearMonth}-{$sequence}";
        }
    }

    // Helper method to determine the sequence number based on cycle type
    private function getSequenceNumber($cycleType)
    {
        // You need to implement the logic to get the sequence number based on cycle type
        // For example, if monthly, you may retrieve the next available sequence for the month

        // For demonstration purposes, using a constant value here
        return '01';
    }

    // Helper method to determine the cycle type based on your logic
    private function getCycleType()
    {
        // You need to implement the logic to determine the cycle type based on your requirements
        // It can be 'M' for monthly, 'BM' for bi-monthly, 'W' for weekly, etc.
        if ($this->reading_circle == 'Monthly') {
            return "M";
        } elseif ($this->reading_circle == 'Bi-Monthly') {
            return "BM";
        } else {
            return "W";
        }
    }


    public function render()
    {
        $distinctMeterPhase = Meter::distinct()->pluck('phase');
        $distinctGeoCommunity = Meter::distinct()->pluck('geo_community');
        $distinctGeoZone = Meter::distinct()->pluck('geo_zone');
        $distinctMeterModel = Meter::distinct()->pluck('meter_model');
        $distinctOrganization = Meter::distinct()->pluck('organization');
        $distinctMeterNumber = Meter::distinct()->pluck('meter_serial_number');
        $distinctMeterMake = Meter::distinct()->pluck('meter_make');

        // Use the correct property name
        $meters = $this->meters;

        $users = User::all();

        return view('livewire.admin.meters.meters', [
            'meters' => $meters,
            'users' => $users,
            'distinctGeoCommunity' => $distinctGeoCommunity,
            'distinctGeoZone' => $distinctGeoZone,
            'distinctMeterModel' => $distinctMeterModel,
            'distinctOrganization' => $distinctOrganization,
            'distinctMeterNumber' => $distinctMeterNumber,
            'distinctMeterPhase' => $distinctMeterPhase,
            'distinctMeterMake' => $distinctMeterMake,
        ]);
    }
}
