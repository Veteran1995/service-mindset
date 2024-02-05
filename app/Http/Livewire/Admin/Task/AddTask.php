<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Crew;
use App\Models\Task;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Meter;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddTask extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $meters;
    public $service_order_info;

    public $showForm = false;

    public $name;
    public $description;
    public $priority = "low";
    public $dueDate;
    public $selectedCrew;
    public $selectedUser;
    public $crewOrUserToggle = false; // Initialize with 'Crew' selected
    // public function addTasks()
    // {
    //     $validatedData = $this->validate([
    //         'state.task_name' => 'required',
    //         'state.description' => 'required',
    //         'assign_date' => 'required|date',
    //         'due_date' => 'required|date',
    //         'state.meter' => 'required',
    //         'state.priority' => 'required',
    //         'state.assignee' => 'required',
    //     ]);

    //     // Create the task record
    //     Task::create([
    //         'task_name' => $validatedData['state']['task_name'],
    //         'description' => $validatedData['state']['description'],
    //         'assign_date' => $validatedData['assign_date'],
    //         'due_date' => $validatedData['due_date'],
    //         'meter_assigned' => $validatedData['state']['meter'],
    //         'priority' => $validatedData['state']['priority'],
    //         'assignee' => $validatedData['state']['assignee'],
    //     ]);

    //     // Clear form fields
    //     $this->state = [
    //         'task_name' => '',
    //         'description' => '',
    //         'assign_date' => '',
    //         'due_date' => '',
    //         'meter' => '',
    //         'priority' => '',
    //         'assignee' => '',
    //     ];

    //     // Show success message or perform any additional actions
    //     session()->flash('message', 'Task assigned successfully.');
    // }

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
                'service_order_id' => $this->service_order_info->id, // Replace with the actual service order ID
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
                'service_order_id' => $this->service_order_info->id, // Replace with the actual service order ID
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

    public function openForm(ServiceOrder $id)
    {
        $this->service_order_info = $id;
        $this->showForm = true;
    }

    // Fetching All Records and Adding Search and Filters
    public function getOrdersProperty()
    {
        return ServiceOrder::select('*')
            // ->where('cnumber', 'like', '%' . $this->searchSerialNumber . '%')
            // ->where('role', 'like', '%' . $this->agent . '%')
            // ->where('role', 'like', '%' . $this->admin . '%')
            ->paginate(8);
    }

    public function mount()
    {
    }

    public function render()
    {
        $servicesOrders = $this->orders;
        $crews = Crew::all();
        $users = User::all();
        return view('livewire.admin.task.add-task', ['servicesOrders' => $servicesOrders, 'crews' => $crews, 'users' => $users]);
    }
}
