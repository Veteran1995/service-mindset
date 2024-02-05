<?php

namespace App\Http\Livewire\Admin\Crews;

use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Crew;
use App\Models\CrewMember;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Crews extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchEmployeeId;
    public $agent;
    public $admin;


    public $searchCrewName;
    public $viewMemberId;
    public $addMemberId;

    public $selectedRows = [];
    public $selectedPageRows = false;

    public $mSelectedRows = [];
    public $mSelectedPageRows = false;

    public $filterByAgent = false; // Property to hold the checkbox value
    public $filterByAdmin = false; // Property to hold the checkbox value

    // Calling the static functions directly on the User model
    public $totalCrews;
    public $totalActiveCrews;
    public $totalInactiveCrews;
    // public $totalActiveUsers;
    // public $totalInactiveUsers;

    public $state = [];
    public $isCreating = false;
    public $image;

    protected $rules = [
        'state.email' => 'required|email|unique:users,email',
        'state.role' => 'required',
        'state.password' => 'required|min:6|confirmed',
        'state.firstname' => 'required',
        'state.lastname' => 'required',
        'state.job' => 'required',
        'state.department' => 'required',
        'image' => 'nullable|image|max:4096',
    ];

    // Fetching All Crews Records and Adding Search and Filters
    public function getCrewsProperty()
    {
        return Crew::select('*')
            ->where('name', 'like', '%' . $this->searchCrewName . '%')
            // ->where('role', 'like', '%' . $this->agent . '%')
            // ->where('role', 'like', '%' . $this->admin . '%')
            ->latest()->paginate(6);
    }

    // Fetching All users Records and Adding Search and Filters
    // public function getUsersProperty()
    // {
    //     return User::select('*')
    //         ->where('firstname', 'like', '%' . $this->searchEmployeeId . '%')
    //         // ->orWhere('lastname', 'like', '%' . $this->searchEmployeeId . '%')
    //         ->latest()->paginate(6);
    // }

    public function viewMemberModal($id)
    {

        $this->viewMemberId = CrewMember::where('crew_id', $id)->get();

        $this->dispatchBrowserEvent('viewMemberModal');
    }

    // public function addMemberModal(Crew $id)
    // {
    //     $this->addMemberId = $id;
    //     $this->dispatchBrowserEvent('addMemberModal');
    // }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->crews->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }

    public function updatedmSelectedPageRows($value)
    {
        if ($value) {
            $this->mSelectedRows = $this->users->pluck('employee_id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['mSelectedRows', 'mSelectedPageRows']);
        }
    }

    // DELETING RECORD AFTER CHECKING THE CHECKBOXES
    public function deleteSelectedRow()
    {
        if (Crew::whereIn('id', $this->selectedRows)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'User Record Deleted Successfully']);
        }
    }

    public function addCrew()
    {
        $validatedData = $this->validate([
            'state.name' => 'required',
            'state.supervisor' => 'required',
        ]);

        $crew = Crew::create([
            'name' => $validatedData['state']['name'],
            'supervisor_id' => $validatedData['state']['supervisor'],
        ]);

        $crew->members()->create(['member_id' => $validatedData['state']['supervisor']]);

        // Reset the form fields
        $this->reset('state');

        // Display success message or perform any other actions
        $this->dispatchBrowserEvent('success', ['message' => 'Crew added successfully.']);
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


    public function mount()
    {
        // Calling the static functions directly on the User model
        $this->totalCrews = Crew::getTotalCrews();
        $this->totalActiveCrews = Crew::getTotalActiveCrews();
        $this->totalInactiveCrews = Crew::getTotalInactiveCrews();
        // $this->totalActiveUsers = User::getTotalActiveUsers();
        // $this->totalInactiveUsers = User::getTotalInactiveUsers();
    }

    public function render()
    {
        $users = User::all();
        $crews = $this->crews;
        return view('livewire.admin.crews.crews', ['crews' => $crews, 'users' => $users]);
    }
}
