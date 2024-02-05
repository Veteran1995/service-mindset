<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Customers</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Add Customer Service Order</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">

                            @if ($customer->image)
                                <img alt="image" src="{{ asset('storage/' . $customer->image) }}"
                                    class="rounded-circle profile-widget-picture">
                            @else
                                @if ($customer->gender == 'Male')
                                    <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @endif
                            @endif

                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Meter</div>
                                    <div class="profile-widget-item-value"> {{ $customer->meters->count() }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Orders</div>
                                    <div class="profile-widget-item-value">{{ $customer->serviceOrders->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description pb-0">
                            <div class="profile-widget-name">{{ $customer->firstname . ' ' . $customer->lastname }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> Customer
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Gender
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->gender }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->address }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Longitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->longitude }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Latitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->latitude }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->phone }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->email }}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Creating Service Order For
                                <span style="font-style: italic"><i class="fas fa-arrow-alt-circle-right fa-lg"></i>
                                    {{ $customer->firstname . ' ' . $customer->lastname }}</span>
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('add-users') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> New Order
                                </a>
                                <button class="btn btn-dark btn-sm" onclick="openMeterModal()"><i
                                        class="fas fa-plus-circle"></i> Create
                                    Meter</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='createOrder'>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label>Service Order Type</label>
                                                        <select class="form-control" wire:model.defer="order.ordertype">
                                                            <option value="">Select Type</option>
                                                            <option value="New Connection">New Connection</option>
                                                            <option value="Engineering Visit">Engineering Visit</option>
                                                            <option value="Meter Replacement">Meter Replacement</option>
                                                        </select>
                                                        @error('order.ordertype')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Meter</label>
                                                        <select class="form-control" wire:model.defer="order.meter_id">
                                                            <option value="">Select Meter</option>
                                                            @if ($meters === null || $meters->isEmpty())
                                                                <option value="" disabled>No meters available
                                                                </option>
                                                            @else
                                                                @foreach ($meters as $meter)
                                                                    <option value="{{ $meter->id }}">
                                                                        {{ $meter->name . ' (' . $meter->serial_number . ')' }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('order.meter_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Location</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="location_input" wire:model='location'>
                                                        </div>
                                                        @error('state.location')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Longitude</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="longitude_input" wire:model.defer='longitude'>
                                                        </div>
                                                        @error('longitude')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Latitude</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                id="latitude_input" wire:model.defer='latitude'>
                                                        </div>
                                                        @error('latitude')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12">
                                        <button type="submit" class="btn btn-dark btn-block"
                                            wire:loading.attr="disabled">
                                            <span wire:loading wire:target="createOrder">Creating...</span>
                                            <span wire:loading.remove><i class="fas fa-plus-circle"></i> Create Service
                                                Order</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="meterModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Add New Meter</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addMeter' enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" wire:model.defer='state.name'
                                            placeholder="Meter NAME">
                                    </div>
                                    @error('state.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>Serial</label>
                                        <input type="text" class="form-control "
                                            wire:model.defer='state.serial_number' placeholder="Meter Serial Number">
                                    </div>
                                    @error('state.serial_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>Meter Seal Tag</label>
                                        <input type="text" class="form-control " wire:model.defer='state.seal_tag'
                                            placeholder="Meter Seal Tag">
                                    </div>
                                    @error('state.seal_tag')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label for="image">Meter Image (optional)</label>
                                        <input type="file" class="form-control-file" id="image"
                                            wire:model.defer="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <button type="submit" class="btn btn-primary btn-block"
                                    wire:loading.attr="disabled">
                                    <span wire:loading wire:target="addUser">Creating...</span>
                                    <span wire:loading.remove>Submit</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
