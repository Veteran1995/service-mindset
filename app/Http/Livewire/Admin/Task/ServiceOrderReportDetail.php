<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\ServiceOrderReport;
use Livewire\Component;

class ServiceOrderReportDetail extends Component
{
    public $report;
    public $latitude;
    public $longitude;


    public $location;
    public function fetchLocation()
    {
        $this->dispatchBrowserEvent('customerLocation', ['location' => $this->location]);
    }
    public function approvereport()
    {
        // Find the ServiceOrderReport model by ID
        $report = ServiceOrderReport::find($this->report->id);

        if ($report) {
            // Update the status to "approved"
            $report->status = 'approved';
            $report->save();

            $this->dispatchBrowserEvent('success', ['message' => 'report Approved Successfully.']);
        }
    }

    public function declinereport()
    {
        // Find the ServiceOrderReport model by ID
        $report = ServiceOrderReport::find($this->report->id);

        if ($report) {
            // Update the status to "approved"
            $report->status = 'declined';
            $report->save();

            $this->dispatchBrowserEvent('success', ['message' => 'report Declined Successfully.']);
        }
    }


    public function mount(ServiceOrderReport $id)
    {
        $this->report = $id;
        $this->location = $this->report;
    }
    public function render()
    {
        return view('livewire.admin.task.service-order-report-detail');
    }
}
