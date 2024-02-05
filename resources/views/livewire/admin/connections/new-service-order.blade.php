<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Connections</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Service Order</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <form wire:submit.prevent="createOrder" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Customer's Information</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Customer</label>
                                    <select class="form-control" wire:model.defer="order.customer_id">
                                        <option value="">Select Customer</option>
                                        @if ($customers === null || $customers->isEmpty())
                                            <option value="" disabled>No Customers available
                                            </option>
                                        @else
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->firstname . ' ' . $customer->lastname }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('order.customer_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Service Order Information</h4>
                            </div>
                            <div class="card-body">
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
                                    </div>
                                    @error('order.meter_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                        <label>Location</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-map-marker"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="location_input"
                                                wire:model='location'>
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
                                            <input type="text" class="form-control" id="longitude_input"
                                                wire:model.defer='longitude'>
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
                                            <input type="text" class="form-control" id="latitude_input"
                                                wire:model.defer='latitude'>
                                        </div>
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-block"
                                        wire:loading.attr="disabled">
                                        <span wire:loading wire:target="createOrder">Creating...</span>
                                        <span wire:loading.remove>Create</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
