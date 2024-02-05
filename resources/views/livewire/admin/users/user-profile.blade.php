<div>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                @if ($user->image)
                                    <img alt="image" src="{{ asset('storage/' . $user->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/avatar.png') }}"
                                        class="rounded-circle author-box-picture">
                                @endif

                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#"> {{ $user->firstname . ' ' . $user->lastname }}</a>
                                </div>
                                <div class="author-box-job">{{ $user->job }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-2">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Employee ID
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $user->employee_id }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Email
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $user->email }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Department
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $user->department }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Job
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $user->job }}
                                    </span>
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6"> <button class="btn btn-danger btn-block">Delete
                                        Account</button></div>
                                @if ($user->status == 0)
                                    <div class="col-6 col-md-6 col-lg-6"> <button class="btn btn-danger btn-block"
                                            wire:click="activeAccount">Active
                                            Account</button></div>
                                @else
                                    <div class="col-6 col-md-6 col-lg-6"> <button class="btn btn-success btn-block"
                                            wire:click="deActiveAccount">Deactivate
                                            Account</button></div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="d-inline text-white">Tasks
                                <span
                                    class="badge badge-primary badge-sm">{{ $user->member && $user->member->crew->task ? $user->member->crew->task->count() : 0 }}</span>
                            </h4>
                            <div class="card-header-action">
                                <a href="" class="btn btn-dark">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @if ($user->member && $user->member->crew->task)
                                    @forelse ($user->member->crew->task as $task)
                                        <li class="media">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cbx-1">
                                                <label class="custom-control-label" for="cbx-1"></label>
                                            </div>
                                            @if ($task->assignedBy->image)
                                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                                    src="{{ asset('storage/' . $task->assignedBy->image) }}">
                                            @else
                                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                                    src="{{ asset('storage/images/male_avatar.png') }}">
                                            @endif

                                            <div class="media-body">
                                                <div
                                                    class="badge badge-pill badge-{{ $task->status == 'Completed' ? 'success' : '' }}{{ $task->status == 'Pending' ? 'danger' : '' }}{{ $task->status == 'Approved' ? 'warning' : '' }} mb-1 float-right">
                                                    {{ $task->status }}
                                                </div>
                                                <h6 class="media-title"><a href="#">{{ $task->name }}</a></h6>
                                                <div class="text-small text-muted">
                                                    {{ $task->assignedBy->firstname . ' ' . $task->assignedBy->lastname }}
                                                    <div class="bullet"></div>
                                                    <span class="text-primary">Now</span>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <h6>No Task Available</h6>
                                    @endforelse
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                            <div class="card-header-action">
                                <a href="{{ route('add-users') }}" class="btn btn-primary">
                                    Add New User
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='updateUser'>
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
                                                        wire:model.defer='state.password'
                                                        data-indicator="pwindicator">
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
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-block"
                                            wire:loading.attr="disabled">
                                            <span wire:loading wire:target="updateUser">Updating...</span>
                                            <span wire:loading.remove>Update</span>
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
</div>
