<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $state = [];
    public $isCreating = false;

    public $image;

    public $latitude;
    public $longitude;
    public $address;

    public $customerNameSearch;

    public $selectedRows = [];
    public $selectedPageRows = false;

    // Calling the static functions directly on the User model
    public $totalCustomers;
    public $totalMaleCustomers;
    public $totalFemaleCustomers;
    public $totalActiveCustomers;

    public $filterByGeoZone;
    public $filterByGeoCommunity;
    public $filterByServiceType;
    public $filterByMeterType;
    public $filterByCustomerType;
    public $filterByTariffClassification;
    public $filterByPhase;
    // public $startDate;
    // public $endDate;
    public $filteredCustomers = [];


    public function rules()
    {
        return [
            'state.email' => 'required|email',
            'state.firstname' => 'required',
            'state.lastname' => 'required',
            'state.phone' => 'required',
            'state.gender' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }

    protected $listeners = ['addressSelected', 'placeSelected'];

    public function placeSelected($data)
    {
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }
    // Fetching All Records and Adding Search and Filters
    // public function getCustomersProperty()
    // {
    //     return Customer::select('*')
    //         ->where('customer_name', 'like', '%' . $this->customerNameSearch . '%')
    //         ->orWhere('account_number', 'like', '%' . $this->customerNameSearch . '%')
    //         ->orWhere('cnumber', 'like', '%' . $this->customerNameSearch . '%')->paginate(10);
    // }

    public function clearFilters()
    {
        // Reset all filter properties to null or default values
        $this->filterByGeoZone = null;
        $this->filterByGeoCommunity = null;
        $this->filterByServiceType = null;
        $this->filterByMeterType = null;
        $this->filterByCustomerType = null;
        $this->filterByTariffClassification = null;
        $this->filterByPhase = null;

        // Optionally, you can also trigger the method that fetches data with the updated filters
        // $this->loadAllCustomers();
    }

    public function updatedselectedPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->customers->pluck('cnumber')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectedPageRows']);
        }
    }

    public function loadAllCustomers()
    {
        $query = Customer::select('*'); // Build your query here, similar to the getCasesProperty method

        // Apply the new filters
        if ($this->filterByGeoZone) {
            $query->where('geo_zone', $this->filterByGeoZone);
        }

        if ($this->filterByGeoCommunity) {
            $query->where('geo_community', $this->filterByGeoCommunity);
        }

        if ($this->filterByServiceType) {
            $query->where('service_type', $this->filterByServiceType);
        }

        if ($this->filterByMeterType) {
            $query->where('meter_type', $this->filterByMeterType);
        }

        if ($this->filterByCustomerType) {
            $query->where('customer_type', $this->filterByCustomerType);
        }

        if ($this->filterByTariffClassification) {
            $query->where('tariff_description', $this->filterByTariffClassification);
        }

        // Include the location relationship
        $query->with('location'); // Assuming 'location' is the name of your relationship

        // Get the query results as an array
        $this->filteredCustomers = $query->get()->toArray();

        $this->dispatchBrowserEvent('updateMarkers', ['customers' => $this->filteredCustomers]);
        $this->emit('updateMarkers', $this->filteredCustomers);
    }

    public function updateCustomer()
    {
        $validatedData = $this->validate();

        $this->isCreating = true; // Set the flag to indicate service order creation is in progress


        // Update the customer information
        Customer::create([
            'firstname' => $validatedData['state']['firstname'],
            'lastname' => $validatedData['state']['lastname'],
            'email' => $validatedData['state']['email'],
            'phone' => $validatedData['state']['phone'],
            'address' => $validatedData['address'],
            'longitude' => $validatedData['longitude'],
            'latitude' => $validatedData['latitude'],
            'gender' => $validatedData['state']['gender'],
        ]);

        // Update the meter information

        $this->isCreating = false; // Reset the flag after service order creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'Customer Profile Updated Successfully.']);
    }

    // DELETING RECORD AFTER CHECKING THE CHECKBOXES
    public function deleteSelectedRow()
    {
        if (Customer::whereIn('id', $this->selectedRows)->delete()) {
            $this->dispatchBrowserEvent('success', ['message' => 'Customer Record Deleted Successfully']);
        }
    }

    public function mount()
    {
        // Calling the static functions directly on the User model
        $this->totalCustomers = Customer::getTotalCustomers();
        $this->totalFemaleCustomers = Customer::getTotalFeMaleCustomer();
        $this->totalMaleCustomers = Customer::getTotalMaleCustomer();
        $this->totalActiveCustomers = Customer::getTotalActiveCustomers();
    }
    public function render()
    {
        $this->loadAllCustomers();
        $distinctPhase = Customer::distinct()->pluck('phase');
        $distinctGeoCommunity = Customer::distinct()->pluck('geo_community');
        $distinctGeoZone = Customer::distinct()->pluck('geo_zone');
        $distinctMeterModel = Customer::distinct()->pluck('meter_model');
        $distinctorganization = Customer::distinct()->pluck('organization');
        $distinctSerialNumber = Customer::distinct()->pluck('meter_number');
        $distinctServiceType = Customer::distinct()->pluck('service_type');
        $distinctMeterType = Customer::distinct()->pluck('meter_type');
        $distinctCustomerType = Customer::distinct()->pluck('customer_type');
        $distinctTariffClassification = Customer::distinct()->pluck('tariff_category');


        // $customers = $this->customers;
        return view('livewire.admin.customers.customers', [
            // 'customers' => $customers,
            'distinctGeoCommunity' => $distinctGeoCommunity,
            'distinctGeoZone' => $distinctGeoZone,
            'distinctMeterModel' => $distinctMeterModel,
            'distinctorganization' => $distinctorganization,
            'distinctSerialNumber' => $distinctSerialNumber,
            'distinctServiceType' => $distinctServiceType,
            'distinctMeterType' => $distinctMeterType,
            'distinctCustomerType' => $distinctCustomerType,
            'distinctTariffClassification' => $distinctTariffClassification,

            'distinctPhase' => $distinctPhase,
        ]);
    }
}
