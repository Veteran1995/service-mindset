<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Users</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Input System Information</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='addUser'>
                                <div class="row">

                                    <div class="col-12 col-md-6 col-lg-6">

                                        <div class="card-header">
                                            <h4>System Information</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label>Location</label>
                                                <div class="input-group">
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
                                                    <input type="text" class="form-control" id="latitude_input"
                                                        wire:model.defer='latitude'>
                                                </div>
                                                @error('latitude')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Profile Image (optional)</label>
                                                <input type="file" class="form-control-file" id="image"
                                                    wire:model.defer="image">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Profile Image (optional)</label>
                                                <input type="file" class="form-control-file" id="image"
                                                    wire:model.defer="image">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">

                                        <div class="card-header">
                                            <h4>System Description</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        wire:model.defer='name'>
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <textarea id="body"></textarea>
                                            <div class="col-12 col-md-12 col-lg-12 mt-3">
                                                <button type="submit" class="btn btn-primary btn-block"
                                                    wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="addUser">Creating...</span>
                                                    <span wire:loading.remove>Submit</span>
                                                </button>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>
