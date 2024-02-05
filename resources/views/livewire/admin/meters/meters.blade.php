<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-users"></i> Meter</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Meters List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-yellow">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalMeters }}
                            </h3>
                            <span class="text-muted">Total Meters</span>
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
                                <i class="ti-arrow-up text-success"></i> {{ $totalAssignedMeters }}
                            </h3>
                            <span class="text-muted">Assigned</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-red">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalUnassignedMeters }}
                            </h3>
                            <span class="text-muted">Unassinged</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>

        <div class="col-lg-12">
            <div class="card px-0">
                <div class="card-header bg-dark">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div class="form-group" style="flex: 1; margin-right: 10px;">
                            <label style="width: 150px" class="text-white">Meter Type</label>
                            <select class="form-control" wire:model="filterByMeterNumber">
                                <option value="">Select Meter Number</option>
                                @foreach ($distinctMeterNumber as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; margin-right: 10px;">
                            <label class="text-white">Meter Phase</label>
                            <select style="width: 150px" class="form-control" wire:model="filterByPhase">
                                <option value="">Select Phase</option>
                                @foreach ($distinctMeterPhase as $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; margin-right: 10px;">
                            <label class="text-white">Meter Make</label>
                            <select style="width: 150px" class="form-control" wire:model="filterByMeterMake">
                                <option value="">Select Meter Make</option>
                                @foreach ($distinctMeterMake as $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; margin-right: 10px;">
                            <label class="text-white">Organization</label>
                            <select class="form-control" style="width: 150px" wire:model="filterByOrganization">
                                <option value="">Select Organization</option>
                                @foreach ($distinctOrganization as $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mr-3"><button class="btn btn-primary" wire:click="getMetersProperty"> <i
                                    class="fa fa-filter"></i> Filter</button>
                        </div>
                        <div><button class="btn btn-danger" wire:click="clearFilters"><i class="fa fa-window-close"></i>
                                Clear Filters</button>
                        </div>
                        <!-- Your existing code -->
                        <h4 class="ml-4 text-white" wire:target='getMetersProperty' wire:loading>Filtering...
                        </h4>
                        <h4 class="ml-4 text-white" wire:target='clearFilters' wire:loading>Clearing
                            Filters...
                        </h4>
                    </div>
                    {{-- <button onclick="loadAllCustomersMap()" class="btn btn-primary">Refresh</button> --}}
                </div>

            </div>

        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Meters</h4>

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
                                                    <label class="d-block">Assigned | Unassigned</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" wire:model="filterByAssigned"
                                                            wire:click="filterByAssigned" type="checkbox"
                                                            id="defaultCheck3">
                                                        <label class="form-check-label" for="defaultCheck3">
                                                            Filter by Assigned
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            wire:model="filterByUnassigned"
                                                            wire:click="filterByUnassigned" type="checkbox"
                                                            id="defaultCheck4">
                                                        <label class="form-check-label" for="defaultCheck4">
                                                            Filter by Unassigned
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    wire:model="searchSerialNumber" placeholder="Search">
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
                                        <a class="dropdown-item" wire:click.prevent="assignSelectedMeter"
                                            href="#">Assign Selected</a>
                                        {{-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a> --}}
                                    </div>
                                </div>
                                <span>Selected {{ count($selectedRows) }}
                                    {{ Str::plural('Meter', count($selectedRows)) }}</span>
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
                                            <th>SPN</th>
                                            <th>Serial Number</th>
                                            <th>Meter Type</th>
                                            <th>Meter Make</th>
                                            <th>Meter Model</th>
                                            <th>Phase</th>
                                            <th>Organization</th>
                                        </tr>
                                        @if ($meters === null || $meters->isEmpty())
                                            <tr>
                                                <td>No Meters Found</td>
                                            </tr>
                                        @else
                                            @foreach ($meters as $meter)
                                                <tr>

                                                    <td class="p-0 text-center">
                                                        <div
                                                            class="custom-checkbox custom-checkbox-table custom-control">
                                                            <input wire:model="selectedRows" class="form-check-input"
                                                                type="checkbox" value="{{ $meter->id }}"
                                                                id="defaultCheck1" />
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('meter-detail', ['meter_id' => $meter->id]) }}">
                                                            {{ $meter->customer ? $meter->customer->cnumber : 'N/A' }}
                                                        </a>

                                                    </td>
                                                    <td>{{ $meter->meter_serial_number }}</td>
                                                    <td>{{ $meter->meter_type }}</td>
                                                    <td>{{ $meter->meter_make }}</td>
                                                    <td>{{ $meter->meter_model }}</td>
                                                    <td>{{ $meter->phase }}</td>
                                                    <td>{{ $meter->organization }}</td>
                                                </tr>
                                            @endforeach
                                        @endif



                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $meters->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="meterReadingModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Meter Reading Assignments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addReadingTask">
                        <div class="form-group">
                            <label>Select User</label>
                            <select class="form-control" wire:model="user_id">
                                <option value="">Select User</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->employee_id }}">
                                        {{ $user->firstname . ' ' . $user->lastname }}</option>

                                @empty
                                    <option value="">No User In Database</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reading Circle</label>
                            <select class="form-control" wire:model="reading_circle">
                                <option value="Weekly">Weekly</option>
                                <option value="Bi-Monthly">Bi-Monthly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Energy Type</label>
                            <select class="form-control" wire:model="energy_type">
                                <option value="Active">Active</option>
                                <option value="Reactive">Reactive</option>
                                <option value="Power Factor">Power Factor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Completionn Date</label>
                            <input type="date" class="form-control" wire:model="completion_date">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea type="text" class="form-control" wire:model="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                <span wire:loading wire:target="addReadingTask">Adding Task...</span>
                                <span wire:loading.remove>Assign Task</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
