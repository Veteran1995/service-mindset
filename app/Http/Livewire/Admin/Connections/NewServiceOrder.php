<?php

namespace App\Http\Livewire\Admin\Connections;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class NewServiceOrder extends Component
{


    use WithFileUploads;

    public $state = [];
    public $order = [];

    public $isCreating = false;

    public $address;
    public $lat;
    public $long;
    public $latitude;
    public $longitude;
    public $location;

    public $photo;

    public $customers;
    public $meters;

    protected $rules = [
        'state.firstname' => 'required',
        'state.lastname' => 'required',
        'state.email' => 'required|email|unique:customers,email',
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

    public function createOrder()
    {

        $validatedData = $this->validate([
            'order.ordertype' => 'required',
            'order.meter_id' => 'unique:service_orders,meter_id',
            'location' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'order.customer_id' => 'required',
        ]);


        $serviceOrder = new ServiceOrder();
        $serviceOrder->name = $this->order['ordertype'];
        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $serviceOrder->meter_id = $this->order['meter_id'];
        }

        $serviceOrder->customer_id = $this->order['customer_id'];
        $serviceOrder->location = $validatedData['location'];
        $serviceOrder->longitude = $validatedData['longitude'];
        $serviceOrder->latitude = $validatedData['latitude'];
        $serviceOrder->user_id = Auth::user()->employee_id;
        // Set other fields as needed


        $serviceOrder->save();

        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $meter = Meter::find($this->order['meter_id']); // Replace 1 with the actual meter_id
            // Update the customer_id on the meter
            $meter->customer_id = $this->order['customer_id'];
            $meter->save();
        }

        // Reset the form fields
        $this->reset(['order', 'location', 'longitude', 'latitude']);

        // Display success message or perform any other actions
        $this->dispatchBrowserEvent('success', ['message' => 'Service Order Created Successfully.']);
    }


    public function render()
    {
        $this->meters = Meter::all();
        $this->customers = Customer::all();
        return view('livewire.admin.connections.new-service-order');
    }
}
