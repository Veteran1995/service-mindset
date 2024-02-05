<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Potential Customer</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Potential Customer</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Potential Customer Information</h4>
                            <div class="card-header-form">
                                <div class="row mr-3">
                                    <div class="mr-3">
                                        <a class="btn btn-primary" href="{{ route('customers') }}">Potential
                                            Customers</a>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='updateCustomer'>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">

                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Firstname"
                                                                wire:model.defer='state.firstname'>
                                                        </div>
                                                        @error('state.firstname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Lastname</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-user"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Lastname"
                                                                wire:model.defer='state.lastname'>
                                                        </div>
                                                        @error('state.lastname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-envelope"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control email"
                                                                placeholder="Enter Email"
                                                                wire:model.defer='state.email'>
                                                        </div>
                                                        @error('state.email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone Number (LBR Format)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Enter Phone Number"
                                                                wire:model.defer='state.phone'>
                                                        </div>
                                                        @error('state.phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select class="form-control" wire:model.defer="state.gender">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    @error('state.gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-address-card"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" id="search_input"
                                                                wire:model.defer='address'>
                                                        </div>
                                                        @error('state.address')
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
                                                                id="longitude_field" wire:model.defer='longitude'>
                                                        </div>
                                                        @error('long')
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
                                                                id="latitude_field" wire:model.defer='latitude'>
                                                        </div>
                                                        @error('lat')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                    <div class="col-12 col-md-12 col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-block"
                                            wire:loading.attr="disabled">
                                            <span wire:loading wire:target="updateCustomer">Creating...</span>
                                            <span wire:loading.remove>Create</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <h1>Coming Soon</h1>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
