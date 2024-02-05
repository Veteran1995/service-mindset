<?php

namespace App\Http\Livewire\Admin\Customers;

use PHPCoord\CoordinateReferenceSystem\Projected;
use PHPCoord\CoordinateReferenceSystem\Geographic2D;
use PHPCoord\UnitOfMeasure\Angle\Degree;
use PHPCoord\UnitOfMeasure\Length\Metre;
use PHPCoord\UTMRef;
use PHPCoord\CoordinateConversion\UTMRefToLatLngConverter;
use PHPCoord\Datum\Datum;
use PHPCoord\Ellipsoid\GRS80;
use App\Models\Customer;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerProfile extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $customer;
    public $state = [];

    public $isCreating = false;
    public $image;

    public $latitude;
    public $longitude;
    public $address;

    public function rules()
    {
        return [
            'state.email' => 'required|email|unique:customers,email,' . $this->customer->id,
            'state.firstname' => 'required',
            'state.lastname' => 'required',
            'state.phone' => 'required',
            'state.gender' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }

    protected $listeners = ['addressSelected'];

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

    public function viewOrder($service_order_id)
    {
        // Redirect to a specific route
        return redirect()->route('single-service-order', ['service_order_id' => $service_order_id]);
    }

    public function mount(Customer $customer_id)
    {
        $this->customer = $customer_id;

        // // Replace these fixed values with actual UTM coordinates
        // $easting = 600000;
        // $northing = 500000;
        // $zone = 29;
        // $hemisphere = 'N'; // 'N' for Northern Hemisphere

        // // Create a UTM coordinate
        // $utmCoordinate = new UTMRef($easting, $northing, $zone, $hemisphere);

        // // Use the converter to get Lat/Long
        // $converter = new UTMRefToLatLngConverter();
        // $latLngCoordinate = $converter->convert($utmCoordinate);

        // // Retrieve the latitude and longitude values
        // $latitude = $latLngCoordinate->getLatitude()->getValue();
        // $longitude = $latLngCoordinate->getLongitude()->getValue();
    }

    public function render()
    {
        $serviceOrders = $this->customer->serviceOrders()->paginate(5);

        return view('livewire.admin.customers.customer-profile', ['serviceOrders' => $serviceOrders]);
    }
}
