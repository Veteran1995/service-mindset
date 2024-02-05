<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-users"></i> User</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> User List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalUsers }}
                            </h3>
                            <span class="text-muted">Total Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalAdminUsers }}
                            </h3>
                            <span class="text-muted">Administrators</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalAgentUsers }}
                            </h3>
                            <span class="text-muted">Agents</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-orange">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalActiveUsers }}
                            </h3>
                            <span class="text-muted">Active Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admin | Agents <button onclick="openUserModal()" class="btn btn-primary mx-3"><i
                                        class="fas fa-plus-circle"></i>
                                    Create New User</button></h4>

                            <div class="card-header-form">
                                <div class="row">
                                    <div>
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Filters
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <div class="form-group dropdown-item">
                                                    <label class="d-block">Admin | Agents</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" wire:model="filterByAdmin"
                                                            wire:click="filterByAdmin" type="checkbox"
                                                            id="defaultCheck3">
                                                        <label class="form-check-label" for="defaultCheck3">
                                                            Filter by Admin
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" wire:model="filterByAgent"
                                                            wire:click="filterByAgent" type="checkbox"
                                                            id="defaultCheck4">
                                                        <label class="form-check-label" for="defaultCheck4">
                                                            Filter by Agent
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model="searchEmployeeId"
                                                    placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                        @if ($selectedRows)
                            <div class="m-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Bulk Actions</button>
                                    <button type="button"
                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                        style="position: absolute; transform: translate3d(119px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" wire:click.prevent="deleteSelectedRow"
                                            href="#">Delete</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                            wire:click.prevent="OpenCrewModal">Add To Crew</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="m-4 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input wire:model="selectedPageRows" class="form-check-input"
                                                        type="checkbox" value="" id="defaultCheck1" />
                                                </div>

                                            </th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Department</th>
                                            <th>Job</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($users as $user)
                                            <tr>

                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input wire:model="selectedRows" class="form-check-input"
                                                            type="checkbox" value="{{ $user->employee_id }}"
                                                            id="defaultCheck1" />
                                                    </div>

                                                </td>
                                                <td>{{ $user->employee_id }}</td>
                                                <td class="align-middle">
                                                    <strong>
                                                        <a href="{{ route('user-profile', ['user_id' => $user->employee_id]) }}"
                                                            class="text-decoration-none text-dark">
                                                            {{ $user->firstname . ' ' . $user->lastname }}
                                                        </a>

                                                    </strong>

                                                </td>
                                                <td> {{ $user->email }}</td>
                                                <td>
                                                    @if ($user->image)
                                                        <img alt="image"
                                                            src="{{ asset('storage/' . $user->image) }}"
                                                            class="rounded-circle" width="35"
                                                            data-toggle="tooltip" title=""
                                                            data-original-title="Wildan Ahdian">
                                                    @else
                                                        <p>N/A</p>
                                                    @endif

                                                </td>

                                                <td>{{ $user->department }}</td>
                                                <td>{{ $user->job }}</td>
                                                <td>
                                                    <div
                                                        class="badge badge-{{ $user->status == 1 ? 'success' : 'danger' }}">
                                                        {{ $user->status == 1 ? 'Active' : 'Inactive' }}</div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="userModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Add New User</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addUserToCrewModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Add User To Crew</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addUserToCrew'>
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12">

                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Crews</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" wire:model.defer='crewid'>
                                                <option value="">Select Crew</option>
                                                @if ($crews === null || $crews->isEmpty())
                                                    <option value="" disabled>No Users available
                                                    </option>
                                                @else
                                                    @foreach ($crews as $crew)
                                                        <option value="{{ $crew->id }}">
                                                            {{ $crew->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('crewid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <button type="submit" class="btn btn-primary btn-block"
                                    wire:loading.attr="disabled">
                                    <span wire:loading wire:target="addUserToCrew">Creating...</span>
                                    <span wire:loading.remove>Add To Crew</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
