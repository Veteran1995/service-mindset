<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\MeterReading;
use Livewire\WithPagination;
use Livewire\Component;

class MeterReadingList extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $readingNameSearch;
    public $pending;
    public $declined;
    public $approved;
    public $totalTasks;

    public $selectedRows = [];
    public $selectedPageRows = false;

    public function getReadingsProperty()
    {
        return MeterReading::select('*')
            ->where('active_readings', 'like', '%' . $this->readingNameSearch . '%')
            ->orWhere('created_at', 'like', '%' . $this->readingNameSearch . '%')
            ->orWhere('anomaly', 'like', '%' . $this->readingNameSearch . '%')->paginate(6);
    }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->readings->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }

    public function approveReading($readingId)
    {
        // Find the MeterReading model by ID
        $reading = MeterReading::find($readingId);

        if ($reading) {
            // Update the status to "approved"
            $reading->status = 'approved';
            $reading->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Approved Successfully.']);
        }
    }

    public function declineReading($readingId)
    {
        // Find the MeterReading model by ID
        $reading = MeterReading::find($readingId);

        if ($reading) {
            // Update the status to "approved"
            $reading->status = 'declined';
            $reading->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Declined Successfully.']);
        }
    }

    public function render()
    {
        $readings = $this->readings;
        $this->approved = MeterReading::where('status', 'approved')->count();
        $this->totalTasks = MeterReading::count();
        $this->declined = MeterReading::where('status', 'declined')->count();
        $this->pending = MeterReading::where('status', 'pending')->count();
        return view('livewire.admin.task.meter-reading-list', [
            'readings' => $readings,
            'approved' => $this->approved,
            'declined' => $this->declined,
            'pending' => $this->pending,
            'totalTasks' => $this->totalTasks
        ]);
    }
}
