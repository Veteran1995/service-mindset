<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-users"></i> User</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> User List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalCrews }}
                            </h3>
                            <span class="text-muted">Total Crews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalInactiveCrews }}
                            </h3>
                            <span class="text-muted">Inactive Crews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalActiveCrews }}
                            </h3>
                            <span class="text-muted">Active Crews</span>
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
                            <h4>Crews <button onclick="openCrewModal()" class="btn btn-primary mx-3"><i
                                        class="fas fa-plus-circle"></i>
                                    Create New Crew</button></h4>

                            <div class="card-header-form">
                                <div class="row">
                                    {{-- <div>
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
                                    </div> --}}
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model="searchCrewName"
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
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                        style="position: absolute; transform: translate3d(119px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" wire:click.prevent="deleteSelectedRow"
                                            href="#">Delete</a>
                                        {{-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a> --}}
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
                                            <th>Name</th>
                                            <th>Supervisor</th>
                                            <th>Members</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($crews as $crew)
                                            <tr>

                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input wire:model="selectedRows" class="form-check-input"
                                                            type="checkbox" value="{{ $crew->id }}"
                                                            id="defaultCheck1" />
                                                    </div>

                                                </td>
                                                <td><a href="{{ route('single-crew', ['crew_id' => $crew->id]) }}"
                                                        class="text-dark"
                                                        style="text-decoration: none">{{ $crew->name }}</a></td>
                                                <td><a href="{{ route('user-profile', ['user_id' => $crew->supervisor->employee_id]) }}"
                                                        class="text-dark"
                                                        style="text-decoration: none">{{ $crew->supervisor->firstname . ' ' . $crew->supervisor->lastname }}</a>
                                                </td>
                                                <td class="text-truncate">

                                                    <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                        @forelse ($crew->members()->take(5)->get() as $member)
                                                            <li class="team-member team-member-sm">
                                                                <a
                                                                    href="{{ route('user-profile', ['user_id' => $member->user->employee_id]) }}">
                                                                    <img class="rounded-circle"
                                                                        src="{{ asset('storage/' . $member->user->image) }}"
                                                                        alt="user" data-toggle="tooltip"
                                                                        title=""
                                                                        data-original-title="{{ $member->user->firstname . ' ' . $member->user->lastname }}">
                                                                </a>

                                                            </li>

                                                        @empty
                                                            No Members
                                                        @endforelse
                                                        @if ($crew->members->count() > 5)
                                                            <li class="avatar avatar-sm"><span
                                                                    class="badge badge-primary">+{{ $crew->members->count() - 5 }}</span>
                                                            </li>
                                                        @endif
                                                    </ul>


                                                </td>
                                                <td>
                                                    <div
                                                        class="badge badge-{{ $crew->status == 'Active' ? 'success' : 'danger' }}">
                                                        {{ $crew->status }}</div>
                                                </td>
                                                <td><a href="{{ route('add-crew-members', ['crew_id' => $crew->id]) }}"
                                                        class="btn btn-primary btn-sm mr-1"><i
                                                            class="fas fa-plus-circle"></i></a><a
                                                        href="{{ route('crew-members', ['crew_id' => $crew->id]) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center">No Crews Found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $crews->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="crewModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Add New Crews</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addCrew'>
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-file-signature"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" wire:model.defer='state.name'>
                                        </div>
                                        @error('state.supervisor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Supervisor</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <select class="form-control" wire:model.defer='state.supervisor'>
                                                <option value="">Select Supervisor</option>
                                                @if ($users === null || $users->isEmpty())
                                                    <option value="" disabled>No Users available
                                                    </option>
                                                @else
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->employee_id }}">
                                                            {{ $user->firstname . ' ' . $user->lastname }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('state.supervisor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <button type="submit" class="btn btn-primary btn-block"
                                    wire:loading.attr="disabled">
                                    <span wire:loading wire:target="addCrew">Creating...</span>
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
