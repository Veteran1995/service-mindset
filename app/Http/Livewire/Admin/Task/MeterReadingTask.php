<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\AssigmentMeters;
use Livewire\Component;
use App\Models\Meter;
use App\Models\Task;
use App\Models\Crew;
use App\Models\MeterAssignment;
use App\Models\ItineraryComment;
use App\Models\ItineraryHistory;
use App\Models\MeterAssignmentDeclineComment;
use App\Models\ServiceOrder;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use PDF;

class MeterReadingTask extends Component
{
    public $users;
    public $meters;
    public $itineraryMeter;
    public $comments;
    public $meterComments;
    public $reassignId;
    public $userComment;
    public $userMeterComment;

    public $user_id;
    public $reading_circle = 'Weekly';
    public $energy_type = 'Active';
    public $completion_date;
    public $reading_date;
    public $comment;

    public $searchSerialNumber;

    public $addCommentId;
    public $addMeterCommentId;

    public $selectedItinerary;

    public $selectedRows = [];
    public $selectedMeterPageRows = false;

    public $selectedItineraryRows = [];
    public $selectedPageRows = false;

    public $totalTasks;
    public $totalUsersAssigned;
    public $totalTasksAssignedByUser;
    public $totalOpenTasks;
    public $totalClosedTasks;
    public $totalCompletedTasks;

    public $searchByDate;
    public $searchByName;

    public $itineraryName;

    public $displayAddingItineraryForm = false;
    public $displayAllItineraries = true;

    public $state = [
        'task_name' => '',
        'description' => '',
        'assign_date' => '',
        'due_date' => '',
        'service_order_id' => '',
        'priority' => '',
        'individual' => '',
        'crew' => '',
    ];

    public $edit = [];

    public function addTask()
    {

        $validatedData = $this->validate([
            'state.task_name' => 'required',
            'state.description' => 'required',
            'state.assign_date' => 'required',
            'state.due_date' => 'required',
            'state.service_order_id' => 'required',
            'state.priority' => 'required',
        ]);

        $checkServiceOrder = Task::where('service_order_id', $validatedData['state']['service_order_id'])->get();
        if ($checkServiceOrder->count() > 0) {
            $this->dispatchBrowserEvent('warning', ['message' => 'This Task is Already Assigned to Another Person or Crew']);
            return;
        }

        if (array_key_exists('crew', $this->state)) {
            if ($this->state['crew'] != "") {
                // Create the task record
                Task::create([
                    'name' => $validatedData['state']['task_name'],
                    'description' => $validatedData['state']['description'],
                    'assign_date' => $validatedData['state']['assign_date'],
                    'due_date' => $validatedData['state']['due_date'],
                    'service_order_id' => $validatedData['state']['service_order_id'],
                    'priority' => $validatedData['state']['priority'],
                    'crew_id' => $this->state['crew'],
                    'assigned_by_id' => Auth::user()->employee_id,
                ]);
                // Clear form fields
                $this->state = [
                    'task_name' => '',
                    'description' => '',
                    'assign_date' => '',
                    'due_date' => '',
                    'service_order_id' => '',
                    'priority' => '',
                    'assignee' => '',
                ];
                $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
                return;
            }
        }

        if (array_key_exists('individual', $this->state)) {
            if ($this->state['individual'] != "") {
                // Create the task record
                Task::create([
                    'name' => $validatedData['state']['task_name'],
                    'description' => $validatedData['state']['description'],
                    'assign_date' => $validatedData['state']['assign_date'],
                    'due_date' => $validatedData['state']['due_date'],
                    'service_order_id' => $validatedData['state']['service_order_id'],
                    'priority' => $validatedData['state']['priority'],
                    'assigned_to_id' => $this->state['individual'],
                    'assigned_by_id' => Auth::user()->employee_id,
                ]);
                // Clear form fields
                $this->state = [
                    'task_name' => '',
                    'description' => '',
                    'assign_date' => '',
                    'due_date' => '',
                    'service_order_id' => '',
                    'priority' => '',
                    'assignee' => '',
                ];
                $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
                return;
            }
        }

        if ($this->state['individual'] == "" && $this->state['crew'] == "") {

            $this->dispatchBrowserEvent('warning', ['message' => 'Please Select an Individual or Crew to Assign Task']);
        }
    }

    public function goBack()
    {
        // Your logic to navigate backward
        // For example:
        return back();
    }

    public function updatedselectedMeterPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->meter->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }


    public function generatePDF1()
    {
        $data = [
            'title' => 'Hello World',
            'content' => 'This is a sample PDF document.',
        ];

        $pdf = PDF::loadView('admin.Export.export-itinerary', $data);

        return $pdf->download('document.pdf');
    }

    public function generatePDF()
    {

        // dd($this->invoiceReceipt->studentPayment);

        ///PRINTING STUDENT Receipt Information
        $itineraries = MeterAssignment::all();

        $html = View::make('admin.Export.export-itinerary', [
            'itineraries' =>  $itineraries,
            'content' => 'This is a sample PDF document.',

        ])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = 'payment-receipt.pdf';
        $filepath = storage_path('app/public/' . $filename);

        // Save the PDF to a file
        file_put_contents($filepath, $dompdf->output());

        // Send the file to the user as a download
        return response()->download($filepath, $filename);
    }

    // Fetching All Records and Adding Search and Filters

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
            'reading_date' => $this->reading_date,
            'comment' => $this->comment,
        ]);

        if ($meterAssignment) {

            $error = [];
            // Loop through selectedRows and insert associated meter_id values
            foreach ($this->selectedRows as $meterId) {
                $meter = Meter::where('id', $meterId)->first();

                if ($meter) {
                    // Meter found, check its properties
                    if ($meter->assignment != NULL) {
                        $this->dispatchBrowserEvent('toastWarning', ['message' => 'Meter: ' . $meter->meter_serial_number . ' is Already Assign to an Itinerary']);
                    } elseif ($meter->customer == NULL) {
                        $this->dispatchBrowserEvent('toastWarning', ['message' => 'Meter: ' . $meter->meter_serial_number . 'This Meter is not connected to a customer']);
                    } else {
                        AssigmentMeters::create([
                            'assign_id' => $meterAssignment->id,
                            'meter_id' => $meterId,
                        ]);
                    }
                } else {
                    // Meter not found
                    return $this->dispatchBrowserEvent('toastWarning', ['message' => 'Meter with serial number ' . $meterId . ' not found.']);
                }
            }


            $this->dispatchBrowserEvent('success', ['message' => 'Itinerary Created Successfully.']);
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

    public function assignSelectedMeter()
    {
        $this->dispatchBrowserEvent('openReadingTaskModal');
    }

    public function showAddItineraryForm()
    {
        $this->displayAllItineraries = false;
        $this->displayAddingItineraryForm = true;
    }

    public function showAllItineraryForm()
    {
        $this->displayAddingItineraryForm = false;
        $this->displayAllItineraries = true;
    }

    public function getMeterProperty()
    {
        $query = Meter::query()
            ->where('meter_serial_number', 'like', '%' . $this->searchSerialNumber . '%');

        // Only paginate if filters are applied
        return $query->paginate(5);
    }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedItineraryRows = $this->tasks->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedItineraryRows', 'selectedPageRows']);
        }
    }


    public function viewMeters(MeterAssignment $id)
    {
        $this->meters = $id->meters;
        $this->itineraryName = $id;

        $prepaidCount = 0;
        $postpaidCount = 0;

        foreach ($this->meters as $meter) {
            // Assuming $meter->meter->service_type is the correct property to access service_type
            $serviceType = $meter->meter->service_type;

            if ($serviceType === 'Prepaid') {
                $prepaidCount++;
            } elseif ($serviceType === 'Postpaid') {
                $postpaidCount++;
            }
        }

        $chartData = [
            ['Task', 'Count'],
            ['Prepaid', $prepaidCount],
            ['Postpaid', $postpaidCount],
        ];

        $this->dispatchBrowserEvent('openUserItinerary');
        $this->dispatchBrowserEvent('chatUpdate', ['chartData' => $chartData]);
    }


    public function viewItineraryMeters(MeterAssignment $id)
    {
        $this->itineraryMeter = $id;
        $this->itineraryName = $id;

        $prepaidCount = 0;
        $postpaidCount = 0;

        foreach ($this->itineraryMeter->meters as $meter) {
            // Assuming $meter->meter->service_type is the correct property to access service_type
            $serviceType = $meter->meter->service_type;

            if ($serviceType === 'Prepaid') {
                $prepaidCount++;
            } elseif ($serviceType === 'Postpaid') {
                $postpaidCount++;
            }
        }

        $chartData = [
            ['Task', 'Count'],
            ['Prepaid', $prepaidCount],
            ['Postpaid', $postpaidCount],
        ];

        $this->dispatchBrowserEvent('openItinerary');
        $this->dispatchBrowserEvent('updateChart', ['chartData' => $chartData]);
    }

    public function viewComment(MeterAssignment $id)
    {
        $this->comments = $id->comments;
        $this->dispatchBrowserEvent('openComment');
    }


    public function addComment($id)
    {
        $this->addCommentId = $id;

        $this->dispatchBrowserEvent('addComment');
    }


    public function submitComment()
    {
        if ($this->userComment == "") {
            return $this->dispatchBrowserEvent('warning', ['message' => 'Comment is Required!']);
        }

        ItineraryComment::create([
            'itinerary_id' =>  $this->addCommentId,
            'user_id' => Auth::id(),
            'comment' => $this->userComment,
        ]);

        $this->dispatchBrowserEvent('closeAddComment');
        $this->dispatchBrowserEvent('success', ['message' => 'Submitted Successfully']);
    }


    // DELETING RECORD AFTER CHECKING THE CHECKBOXES
    public function deleteSelectedRow()
    {
        if (MeterAssignment::whereIn('id', $this->selectedItineraryRows)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'Meter Record Deleted Successfully']);
        }
    }


    public function mount()
    {
        // Calling the static function getTotalTasks()
        $this->totalTasks = Task::getTotalTasks();

        // Creating an instance of Task
        $task = new Task();

        // Calling the non-static functions on an instance of Task
        $this->totalUsersAssigned = $task->getTotalUsersAssigned();
        $this->totalTasksAssignedByUser = $task->getTotalTasksAssignedByUser();
        $this->totalOpenTasks = Task::getTotalTasksByStatus('open');
        $this->totalClosedTasks = Task::getTotalTasksByStatus('close');
        $this->totalCompletedTasks = Task::getTotalTasksByStatus('completed');
    }

    // Fetching All Records and Adding Search and Filters
    public function getTasksProperty()
    {
        return MeterAssignment::select('*')
            // ->where('user_id', 'like', '%' . $this->searchByName . '%')
            ->where('created_at', 'like', '%' . $this->searchByDate . '%')
            ->latest()->paginate(20);
    }

    public function render()
    {
        $this->users = User::all();
        $orders = ServiceOrder::all();
        $tasks =  $this->tasks;
        $crews = Crew::all();
        $itineraries = MeterAssignment::all();
        $meters = $this->meter;

        return view('livewire.admin.task.meter-reading-task', [
            'orders' => $orders,
            'users' => $this->users,
            'tasks' => $tasks,
            'crews' => $crews,
            'itineraries' => $itineraries,
            'allmeters' => $meters,
        ]);
    }
}
