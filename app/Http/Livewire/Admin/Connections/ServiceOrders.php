<?php

namespace App\Http\Livewire\Admin\Connections;

use Livewire\WithPagination;
use App\Models\Meter;
use App\Models\ServiceOrder;
use Livewire\Component;

class ServiceOrders extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchSerialNumber;
    public $selectedRows = [];
    public $selectedPageRows = false;

    public $totalServiceOrders;
    public $totalAssignedOrders;
    public $totalUnassignedOrders;
    public $totalCompletedOrders;

    public function mount()
    {
        // Calling the static functions directly on the User model
        $this->totalServiceOrders = ServiceOrder::getTotalServiceOrders();
        $this->totalAssignedOrders = ServiceOrder::getTotalAssignedOrders();
        $this->totalUnassignedOrders = ServiceOrder::getTotalUnassignedOrders();
        $this->totalCompletedOrders = ServiceOrder::getTotalCompletedOrders();
    }

    // Fetching All Records and Adding Search and Filters
    public function getOrdersProperty()
    {
        return ServiceOrder::select('*')
            ->where('cnumber', 'like', '%' . $this->searchSerialNumber . '%')
            // ->where('role', 'like', '%' . $this->agent . '%')
            // ->where('role', 'like', '%' . $this->admin . '%')
            ->paginate(10);
    }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->orders->pluck('id')->map(function ($id) {
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

    public function viewOrder($service_order_id)
    {
        // Redirect to a specific route
        return redirect()->route('single-service-order', ['service_order_id' => $service_order_id]);
    }

    public function render()
    {
        $servicesOrders = $this->orders;
        return view('livewire.admin.connections.service-orders', ['servicesOrders' => $servicesOrders]);
    }
}
