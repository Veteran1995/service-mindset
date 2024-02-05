<?php

namespace App\Http\Livewire\Admin\Connections;

use App\Models\Customer;
use App\Models\Meter;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewSingleServiceOrder extends Component
{
    public $serviceOrder;
    public $state = [];
    public $order = [];
    public $isCreating = false;

    public $meters;
    public $latitude;
    public $longitude;
    public $location;

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
        // 'photo' => 'image|max:1024', // Adjust the file size limit as needed
    ];

    protected $listeners = ['placeSelected'];

    public function placeSelected($data)
    {
        $this->location = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }


    // public function addServiceOrder()
    // {
    //     $validatedData = $this->validate();

    //     $this->isCreating = true; // Set the flag to indicate service order creation is in progress

    //     // Find the customer by ID
    //     $customer = Customer::findOrFail($this->meter->customer->id);

    //     // Update the customer information
    //     $customer->update([
    //         'firstname' => $validatedData['state']['firstname'],
    //         'lastname' => $validatedData['state']['lastname'],
    //         'phone' => $validatedData['state']['phone'],
    //         'address' => $validatedData['address'],
    //         'longitude' => $validatedData['long'],
    //         'latitude' => $validatedData['lat'],
    //         'gender' => $validatedData['state']['gender'],
    //     ]);

    //     // Find the meter by ID
    //     $service = ServiceOrder::findOrFail($this->serviceOrder->id);

    //     // Update the meter information
    //     $service->update([
    //         'name' => $validatedData['state']['meter_name'],
    //         'serial_number' => $validatedData['state']['serial_number'],
    //         'seal_tag' => $validatedData['state']['seal_tag'],
    //         'location' => $validatedData['location'],
    //         'longitude' => $validatedData['longitude'],
    //         'latitude' => $validatedData['latitude'],
    //     ]);

    //     // Handle file upload
    //     if (isset($validatedData['photo'])) {
    //         $photoPath = $validatedData['photo']->store('photos');
    //         $service->photo = $photoPath;
    //         $service->save();
    //     }

    //     $this->mount($service);

    //     $this->isCreating = false; // Reset the flag after service order creation is complete

    //     // Dispatch a browser event
    //     $this->dispatchBrowserEvent('success', ['message' => 'Service Order updated successfully.']);
    // }

    public function updateOrder()
    {
        $validatedData = $this->validate([
            'order.ordertype' => 'required',
            'order.meter_id' => 'nullable|unique:service_orders,meter_id,' . $this->serviceOrder->id,
            'location' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);



        $serviceOrder = $this->serviceOrder;

        $serviceOrder->name = $this->order['ordertype'];

        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $serviceOrder->meter_id = $this->order['meter_id'];
        } else {
            $serviceOrder->meter_id = NULL;
        }

        $serviceOrder->location = $validatedData['location'];
        $serviceOrder->longitude = $validatedData['longitude'];
        $serviceOrder->latitude = $validatedData['latitude'];
        $serviceOrder->user_id = Auth::user()->employee_id;
        // Set other fields as needed

        $serviceOrder->save();

        if (isset($this->order['meter_id']) && $this->order['meter_id'] !== "") {
            $meter = Meter::find($this->order['meter_id']);
            if ($meter) {
                // Update the customer_id on the meter
                $meter->customer_id = $serviceOrder->customer_id;
                $meter->save();
            }
        }

        $this->mount($serviceOrder);

        // Display success message or perform any other actions
        $this->dispatchBrowserEvent('success', ['message' => 'Service Order Updated Successfully.']);
    }



    public function mount(ServiceOrder $service_order_id)
    {
        $this->serviceOrder = $service_order_id;

        $this->longitude = $service_order_id->longitude;
        $this->latitude = $service_order_id->latitude;
        $this->location = $service_order_id->location;

        $this->order['ordertype'] = $service_order_id->name;

        $this->state = $service_order_id->customer->toArray();
        if ($service_order_id->meter_id) {
            $this->order['meter_id'] = $service_order_id->meter_id;
        }
    }



    public function render()
    {

        $this->meters = Meter::all();
        return view('livewire.admin.connections.view-single-service-order', ['meters' => $this->meters]);
    }
}
