<?php

namespace App\Http\Livewire\Admin\Connections;

use App\Models\ServiceOrder;
use App\Models\Customer;
use App\Models\Meter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCustomerServiceOrder extends Component
{
    use WithFileUploads;

    public $customer;

    public $state = [
        'name' => '',
        'serial_number' => '',
        'seal_tag' => '',
    ];

    public $order = [];

    public $isCreating = false;
    public $image;

    public $latitude;
    public $longitude;
    public $location;

    public $meters;

    public $photoPath;

    protected $rules = [
        'state.name' => 'required',
        'state.serial_number' => 'required',
        'state.seal_tag' => 'required',
    ];

    protected $listeners = ['placeSelected'];

    public function placeSelected($data)
    {
        $this->location = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }

    public function createOrder()
    {

        $validatedData = $this->validate([
            'order.ordertype' => 'required',
            'order.meter_id' => 'unique:service_orders,meter_id',
            'location' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);



        $serviceOrder = new ServiceOrder();
        $serviceOrder->name = $this->order['ordertype'];
        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $serviceOrder->meter_id = $this->order['meter_id'];
        }

        $serviceOrder->customer_id = $this->customer->id;
        $serviceOrder->location = $validatedData['location'];
        $serviceOrder->longitude = $validatedData['longitude'];
        $serviceOrder->latitude = $validatedData['latitude'];
        $serviceOrder->user_id = Auth::user()->employee_id;
        // Set other fields as needed


        $serviceOrder->save();

        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $meter = Meter::find($this->order['meter_id']); // Replace 1 with the actual meter_id
            // Update the customer_id on the meter
            $meter->customer_id = $this->customer->id;
            $meter->save();
        }

        // Reset the form fields
        $this->reset(['order', 'location', 'longitude', 'latitude']);

        // Display success message or perform any other actions
        $this->dispatchBrowserEvent('success', ['message' => 'Service Order Created Successfully.']);
    }


    public function updateCustomer()
    {
        $validatedData = $this->validate();

        $this->isCreating = true; // Set the flag to indicate service order creation is in progress

        // Find the customer by ID
        $customer = Customer::findOrFail($this->customer->id);

        // Update the customer information
        $customer->update([
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

        $this->mount($customer);

        $this->isCreating = false; // Reset the flag after service order creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'Customer Profile Updated Successfully.']);
    }

    public function addMeter()
    {

        $validatedData = $this->validate();

        // Handle file upload
        if ($this->image) {
            $this->photoPath = $this->image->store('images', 'public');
            // $validatedData['photo'] = $photoPath;
        }

        // Create the meter record
        Meter::create([
            'name' => $this->state['name'],
            'serial_number' => $this->state['serial_number'],
            'seal_tag' => $this->state['seal_tag'],
            'photo' =>  $this->photoPath,
        ]);

        // Clear the form fields
        $this->reset(['state', 'image']);
        $this->dispatchBrowserEvent('success', ['message' => 'Meter Added Successfully.']);
    }

    public function mount(Customer $customer_id)
    {
        $this->customer = $customer_id;
    }

    public function render()
    {
        $this->meters = Meter::all();
        return view('livewire.admin.connections.add-customer-service-order');
    }
}
