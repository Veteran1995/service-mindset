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
                            <h4>Add User's Information</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='addUser'>
                                <div class="row">

                                    <div class="col-12 col-md-6 col-lg-6">

                                        <div class="card-header">
                                            <h4>Account Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control email"
                                                        wire:model.defer='state.email'>
                                                </div>
                                                @error('state.email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" wire:model.defer='state.role'>
                                                        <option value="admin">Admin</option>
                                                        <option value="agent">Agent</option>
                                                    </select>
                                                </div>
                                                @error('state.role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control pwstrength"
                                                        wire:model.defer='state.password' data-indicator="pwindicator">
                                                </div>
                                                @error('state.password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control pwstrength"
                                                        wire:model.defer='state.password_confirmation'
                                                        data-indicator="pwindicator">
                                                </div>
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">

                                        <div class="card-header">
                                            <h4>Profile Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control text"
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
                                                    <input type="text" class="form-control text"
                                                        wire:model.defer='state.lastname'>
                                                </div>
                                                @error('state.lastname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Job</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-tasks"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control text"
                                                        wire:model.defer='state.job'>
                                                </div>
                                                @error('state.job')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" wire:model.defer='state.department'>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Agent">Agent</option>
                                                    </select>
                                                </div>
                                                @error('state.department')
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
                                            <div class="col-12 col-md-12 col-lg-12">
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
