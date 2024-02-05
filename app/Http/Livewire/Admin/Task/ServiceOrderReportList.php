<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\ServiceOrderReport;
use Livewire\WithPagination;
use Livewire\Component;

class ServiceOrderReportList extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $reportNameSearch;
    public $pending;
    public $declined;
    public $approved;
    public $totalTasks;

    public $selectedRows = [];
    public $selectedPageRows = false;

    public function getReportsProperty()
    {
        return ServiceOrderReport::select('*')
            ->where('meter_readings', 'like', '%' . $this->reportNameSearch . '%')
            ->orWhere('created_at', 'like', '%' . $this->reportNameSearch . '%')
            ->orWhere('meter_id', 'like', '%' . $this->reportNameSearch . '%')->paginate(6);
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

    public function approveReading($reportId)
    {
        // Find the MeterReading model by ID
        $report = ServiceOrderReport::find($reportId);

        if ($report) {
            // Update the status to "approved"
            $report->status = 'approved';
            $report->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Approved Successfully.']);
        }
    }

    public function declineReading($reportId)
    {
        // Find the MeterReading model by ID
        $report = ServiceOrderReport::find($reportId);

        if ($report) {
            // Update the status to "approved"
            $report->status = 'declined';
            $report->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Reading Declined Successfully.']);
        }
    }
    public function render()
    {
        $reports = $this->reports;
        $this->approved = ServiceOrderReport::where('status', 'approved')->count();
        $this->totalTasks = ServiceOrderReport::count();
        $this->declined = ServiceOrderReport::where('status', 'declined')->count();
        $this->pending = ServiceOrderReport::where('status', 'pending')->count();
        return view('livewire.admin.task.service-order-report-list', [
            'reports' => $reports,
            'approved' => $this->approved,
            'declined' => $this->declined,
            'pending' => $this->pending,
            'totalTasks' => $this->totalTasks
        ]);
    }
}
