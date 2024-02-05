<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class AddCustomers extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $state = [];
    public $isCreating = false;

    public $latitude;
    public $longitude;
    public $address;

    public $customerNameSearch;

    public $selectedRows = [];
    public $selectedPageRows = false;


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

    public function addressSelected($data)
    {
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
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
        $this->dispatchBrowserEvent('success', ['message' => 'Customer Profile Created Successfully.']);
    }
    public function render()
    {
        return view('livewire.admin.customers.add-customers');
    }
}
