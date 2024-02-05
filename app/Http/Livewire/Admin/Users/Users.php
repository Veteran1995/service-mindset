<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Crew;
use App\Models\CrewMember;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchEmployeeId;
    public $agent;
    public $admin;

    public $crewid;

    public $selectedRows = [];
    public $selectedPageRows = false;

    public $filterByAgent = false; // Property to hold the checkbox value
    public $filterByAdmin = false; // Property to hold the checkbox value

    // Calling the static functions directly on the User model
    public $totalUsers;
    public $totalAdminUsers;
    public $totalAgentUsers;
    public $totalActiveUsers;
    public $totalInactiveUsers;

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
                CrewMember::create(['crew_id' => $this->crewid, 'member_id' => $selected_id]);
                $this->dispatchBrowserEvent('closeCrewModal');
                $this->dispatchBrowserEvent('success', ['message' => 'User Added To Crew']);
            }
        }
    }

    // DELETING RECORD AFTER CHECKING THE CHECKBOXES
    public function deleteSelectedRow()
    {
        if (User::whereIn('employee_id', $this->selectedRows)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'User Record Deleted Successfully']);
        }
    }

    public function addUser()
    {

        $this->validate();

        $this->isCreating = true; // Set the flag to indicate user creation is in progress

        // Upload and store the image if provided
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        User::create([
            'email' => $this->state['email'],
            'role' => $this->state['role'],
            'password' => Hash::make($this->state['password']),
            'firstname' => $this->state['firstname'],
            'lastname' => $this->state['lastname'],
            'job' => $this->state['job'],
            'department' => $this->state['department'],
            'employee_id' => mt_rand(10000000, 99999999),
            'image' => $imagePath,
        ]);

        // Clear the form fields
        $this->state = [];

        $this->isCreating = false; // Reset the flag after user creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'User created successfully.']);
    }

    public function mount()
    {
        // Calling the static functions directly on the User model
        $this->totalUsers = User::getTotalUsers();
        $this->totalAdminUsers = User::getTotalAdminUsers();
        $this->totalAgentUsers = User::getTotalAgentUsers();
        $this->totalActiveUsers = User::getTotalActiveUsers();
        $this->totalInactiveUsers = User::getTotalInactiveUsers();
    }

    public function render()
    {
        $crews = Crew::all();
        $users = $this->users;
        return view('livewire.admin.users.users', ['users' => $users, 'crews' => $crews]);
    }
}
