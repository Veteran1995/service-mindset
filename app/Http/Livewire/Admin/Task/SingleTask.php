<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Customer;
use App\Models\Meter;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SingleTask extends Component
{
    use WithPagination;

    public $meter;
    public $task;
    public $state = [];
    public $isCreating = false;

    public $address;
    public $lat;
    public $long;
    public $latitude;
    public $longitude;
    public $location;

    public $comment;

    public $latit;
    public $longit;

    public $taskComments;

    public $photo;

    protected $rules = [
        'state.firstname' => 'required',
        'state.lastname' => 'required',
        'state.phone' => 'required',
        'state.gender' => 'required',
        'address' => 'required',
        'long' => 'required',
        'lat' => 'required',
        'state.meter_name' => 'required',
        'state.serial_number' => 'required',
        'state.seal_tag' => 'required',
        'location' => 'required',
        'longitude' => 'required',
        'latitude' => 'required',
        'comment' => 'required',
        // 'photo' => 'image|max:1024', // Adjust the file size limit as needed
    ];


    protected $listeners = ['placeSelected', 'addressSelected'];

    public function placeSelected($data)
    {
        $this->location = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }

    public function addressSelected($data)
    {
        $this->address = $data['address'];
        $this->lat = $data['latitude'];
        $this->long = $data['longitude'];
    }

    public function addServiceOrder()
    {
        $validatedData = $this->validate();

        $this->isCreating = true; // Set the flag to indicate service order creation is in progress

        // Find the customer by ID
        $customer = Customer::findOrFail($this->meter->customer->id);

        // Update the customer information
        $customer->update([
            'firstname' => $validatedData['state']['firstname'],
            'lastname' => $validatedData['state']['lastname'],
            'phone' => $validatedData['state']['phone'],
            'address' => $validatedData['address'],
            'longitude' => $validatedData['long'],
            'latitude' => $validatedData['lat'],
            'gender' => $validatedData['state']['gender'],
        ]);

        // Find the meter by ID
        $meter = Meter::findOrFail($this->meter->id);

        // Update the meter information
        $meter->update([
            'name' => $validatedData['state']['meter_name'],
            'serial_number' => $validatedData['state']['serial_number'],
            'seal_tag' => $validatedData['state']['seal_tag'],
            'location' => $validatedData['location'],
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude'],
        ]);

        // Handle file upload
        if (isset($validatedData['photo'])) {
            $photoPath = $validatedData['photo']->store('photos');
            $meter->photo = $photoPath;
            $meter->save();
        }

        $this->mount($meter);

        $this->isCreating = false; // Reset the flag after service order creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'Service Order updated successfully.']);
    }


    public function fetchLatitudeAndLongitude()
    {

        $this->longit = $this->task->serviceOrder->longitude;
        $this->latit = $this->task->serviceOrder->latitude;
        $this->emit('latitudeAndLongitudeFetched', $this->latitude, $this->longitude);
    }

    public function showAllCommets()
    {
        $this->dispatchBrowserEvent('openTaskCommentModal');
    }

    public function addComment()
    {
        if ($this->comment <> "") {
            TaskComment::create([
                'comment' => $this->comment,
                'sender_id' => auth()->user()->employee_id,
                'task_id' => $this->task->id,
            ]);

            // Reset the form field
            $this->reset('comment');

            $this->dispatchBrowserEvent('closeTaskCommentModal');

            // Show success message or perform any additional actions
            $this->dispatchBrowserEvent('success', ['message' => 'Comment Added Successfully']);
            $this->mount($this->task);
        } else {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'Comment Field is Required']);
        }
    }



    public function mount(Task $task_id)
    {
        $this->task = $task_id;

        // $this->longitude = $task_id->serviceOrder->longitude;
        // $this->latitude = $task_id->serviceOrder->latitude;
        // $this->address = $task_id->serviceOrder->customer->address;
        // $this->location = $task_id->serviceOrder->location;
        // $this->long = $task_id->serviceOrder->customer->longitude;
        // $this->lat = $task_id->serviceOrder->customer->latitude;

        $this->state = $task_id->serviceOrder->customer->toArray();
        $this->state['ordertype'] = $task_id->serviceOrder->id;
        $this->state['serial_number'] = $task_id->serial_number;
        $this->state['seal_tag'] = $task_id->seal_tag;

        $this->taskComments = TaskComment::orderBy('created_at', 'desc')->where('task_id', $this->task->id)->get();
    }

    public function closeStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is in Process']);
        } else {
            $this->task->update(['status' => 'Closed']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Closed']);
        }
    }

    public function completeStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is in Process']);
        } else {
            $this->task->update(['status' => 'Completed']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Completed']);
        }
    }

    public function openStatus()
    {
        if ($this->task->status == "Processing") {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'This Task is Already in Process']);
        } else {
            $this->task->update(['status' => 'Open']);
            $this->dispatchBrowserEvent('success', ['message' => 'Task Mark Open']);
        }
    }



    public function render()
    {
        return view('livewire.admin.task.single-task');
    }
}
