<?php

namespace App\Http\Livewire\Admin\Crews;

use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Crew;
use App\Models\CrewMember;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class AddMembers extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchEmployeeId;
    public $agent;
    public $admin;

    public $crew;


    public $selectedRows = [];
    public $selectedPageRows = false;

    public $filterByAgent = false; // Property to hold the checkbox value
    public $filterByAdmin = false; // Property to hold the checkbox value




    // Fetching All Records and Adding Search and Filters
    public function getUsersProperty()
    {
        return User::select('*')
            ->where('employee_id', 'like', '%' . $this->searchEmployeeId . '%')
            ->where('role', 'like', '%' . $this->agent . '%')
            ->where('role', 'like', '%' . $this->admin . '%')
            ->latest()->paginate(6);
    }

    // Filtering Records by Agent
    public function filterByAgent()
    {
        // Access the checkbox value using the $this->filterByAgent property
        if ($this->filterByAgent) {
            // Checkbox is checked
            // Perform the desired action
            $this->agent = "agent";
        } else {
            // Checkbox is unchecked
            // Perform the desired action
            $this->agent = "";
        }
    }

    // Filtering Records by Admin
    public function filterByAdmin()
    {
        // Access the checkbox value using the $this->filterByAgent property
        if ($this->filterByAdmin) {
            // Checkbox is checked
            // Perform the desired action
            $this->admin = "admin";
        } else {
            // Checkbox is unchecked
            // Perform the desired action
            $this->admin = "";
        }
    }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->users->pluck('employee_id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }

    public function OpenCrewModal()
    {

        $this->dispatchBrowserEvent('openCrewModal');
    }

    public function addUserToCrew()
    {

        foreach ($this->selectedRows as $key => $selected_id) {
            $check = CrewMember::where('member_id', $selected_id)->first();
            if ($check) {
                $this->dispatchBrowserEvent('toastWarning', ['message' => $check->user->firstname . ' ' . $check->user->lastname . ' Already Added to ' . $check->crew->name]);
            } else {
                CrewMember::create(['crew_id' => $this->crew->id, 'member_id' => $selected_id]);
                $this->dispatchBrowserEvent('closeCrewModal');
                $this->dispatchBrowserEvent('success', ['message' => 'User Added To Crew']);
            }
        }
    }


    public function mount(Crew $crew_id)
    {
        // Calling the static functions directly on the User model
        $this->crew = $crew_id;
    }

    public function render()
    {
        $crews = Crew::all();
        $users = $this->users;
        return view('livewire.admin.crews.add-members', ['users' => $users, 'crews' => $crews]);
    }
}
