<div>
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-tools"></i> Task</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Tasks List</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Total Tasks</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-orange text-white">
                                <i class="fas fa-tools"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Completed</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalCompletedTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-green text-white">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 7.8%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Open</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalOpenTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-yellow text-white">
                                <i class="fas fa-lock-open"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 15%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Closed</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalClosedTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-red text-white">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5.4%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row card m-1 p-2">
        <div>

            @if ($displayAllItineraries == true)
                <button class="btn btn-primary" wire:click="showAddItineraryForm"><i class="fas fa-pen"></i> Create
                    Itinerary</button>
            @endif
            @if ($displayAddingItineraryForm == true)
                <button class="btn btn-primary" wire:click="showAllItineraryForm"><i class="fas fa-eye"></i> View
                    Itineraries</button>
            @endif
            <div wire:loading class="spinner-border text-danger mr-4" role="status">
                <span class="sr-only">Loading...</span>
            </div>
           

        </div>
    </div>
    <div class="row {{ $displayAddingItineraryForm ? 'd-none' : '' }}">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Task
                        <a href="{{ route('meter-reading-list') }}" class="btn btn-warning mx-3"><i
                                class="fas fa-file"></i>
                        </a>
                        <button class="btn btn-primary" wire:click="generatePDF"><i class="fa fa-upload"></i>
                            Export</button>
                        <button class="btn btn-success"><i class="fa fa-download"></i> Import</button>
                    </h4>
                    <div class="card-header-form">
                        <div class="row">
                            <form>
                                <div class="input-group px-2">
                                    <input type="date" class="form-control" wire:model="searchByDate">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Task"
                                        wire:model="searchByName">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($selectedItineraryRows)
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
                                <a class="dropdown-item" wire:click.prevent="editSelectedMeter"
                                    href="#">Edit</a>

                            </div>
                        </div>
                        <span>Selected {{ count($selectedItineraryRows) }}
                            {{ Str::plural('Meter Reading Task', count($selectedItineraryRows)) }}</span>
                    </div>
                @endif
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="text-center">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                            <input input wire:model="selectedPageRows" type="checkbox"
                                                data-checkboxes="mygroup" data-checkbox-role="dad"
                                                class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Itinerary</th>
                                    <th>Circle</th>
                                    <th>#s of Meters</th>
                                    <th>Reader</th>
                                    <th>Reading Circle</th>
                                    <th>Reading Date</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Completion Date</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>

                                @forelse ($tasks as $task)
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input wire:model="selectedItineraryRows" type="checkbox"
                                                    data-checkboxes="mygroup" class="custom-control-input"
                                                    value="{{ $task->id }}" id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td style="cursor: pointer" wire:click="viewMeters({{ $task->id }})">
                                            {{ $task->itinerary_no }}</a>
                                        </td>
                                        <td>{{ $task->circle }}</td>
                                        <td>{{ $task->meters->count() }}</td>
                                        <td>
                                            @if ($task->user)
                                                <a
                                                    href="{{ route('user-meter-reading-itineraries', ['user_id' => $task->user->employee_id]) }}">{{ $task->user->firstname . ' ' . $task->user->lastname }}</a>
                                            @else
                                                N/A
                                            @endif

                                        </td>
                                        <td>{{ $task->reading_circle }}</td>
                                        <td>{{ $task->created_at }}</td>
                                        <td>
                                            <div
                                                class="badge badge-{{ $task->status == 'Completed' ? 'success' : '' }}{{ $task->status == 'Pending' ? 'danger' : '' }}{{ $task->status == 'Approved' ? 'warning' : '' }}">
                                                {{ $task->status }}</div>
                                        </td>
                                        <td>
                                            <div
                                                class="badge badge-{{ $task->priority == 'Low' ? 'success' : '' }}{{ $task->priority == 'High' ? 'danger' : '' }}{{ $task->priority == 'Average' ? 'primary' : '' }}">
                                                {{ $task->priority }}</div>
                                        </td>
                                        <td>
                                            {{ $task->completion_date }}
                                        </td>
                                        <td>
                                            @if ($task->comments->count() != 0)
                                                <button class="btn btn-sm btn-warning badge badge-primary"
                                                    wire:click="viewComment({{ $task->id }})">{{ $task->comments->count() }}
                                                    <i class="fa fa-eye"></i></button>
                                            @endif
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="addComment({{ $task->id }})"><i
                                                    class="fa fa-plus-circle"></i></button>
                                        </td>
                                        <td><a href="{{ route('itinerary-detail', ['itinerary_id' => $task->id]) }}"
                                                class="btn btn-outline-success">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row {{ $displayAddingItineraryForm ? '' : 'd-none' }}">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Meters</h4>

                    <div class="card-header-form">
                        <div class="row">
                            <div>
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model="searchSerialNumber"
                                            placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                                            <input wire:model="selectedMeterPageRows" class="form-check-input"
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
                                @if ($allmeters === null || $allmeters->isEmpty())
                                    <tr>
                                        <td>No Meters Found</td>
                                    </tr>
                                @else
                                    @foreach ($allmeters as $meter)
                                        <tr>

                                            <td class="p-0 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input wire:model="selectedRows" class="form-check-input"
                                                        type="checkbox" value="{{ $meter->id }}"
                                                        id="defaultCheck1" />
                                                </div>

                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('customer-profile', ['customer_id' => $meter->customer->cnumber]) }}">
                                                    {{ $meter->customer ? $meter->customer->cnumber : 'N/A' }}
                                                </a>

                                            </td>
                                            <td>
                                                <a href="{{ route('meter-detail', ['meter_id' => $meter->id]) }}">
                                                    {{ $meter->meter_serial_number }}
                                                </a>
                                            </td>

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
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="customerModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addTask">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Task Name"
                                            wire:model.defer="state.task_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                        </div>
                                        <textarea type="text" class="form-control" placeholder="Enter Description" wire:model.defer="state.description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Assign Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="datetime-local" class="form-control"
                                            wire:model.defer="state.assign_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="datetime-local" class="form-control"
                                            wire:model.defer="state.due_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Service Order Assigned</label>
                                    <select class="form-control" wire:model.defer="state.service_order_id">
                                        <option value="">Select Service Order</option>
                                        @forelse ($orders as $order)
                                            <option value="{{ $order->id }}">
                                                {{ $order->service_order_type }}
                                                ({{ $order->customer->customer_name }})
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="form-control" wire:model.defer="state.priority">
                                        <option value="">Select Priority</option>
                                        <option value="Low">Low</option>
                                        <option value="Average">Average</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Individual/Group</label>
                                    <select class="form-control" id="prioritySelect">
                                        <option value="">Select Individual/Group</option>
                                        <option value="Individual">Individual</option>
                                        <option value="Crew">Crew</option>
                                    </select>
                                </div>
                                <div class="form-group" id="individual" style="display: none;">
                                    <label>Select Individual</label>
                                    <select class="form-control" wire:model.defer="state.individual" id="users">
                                        <option value="">Select Individual</option>
                                        @forelse ($users as $user)
                                            <option value="{{ $user->employee_id }}">
                                                {{ $user->firstname . ' ' . $user->lastname }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group" id="group" style="display: none;">
                                    <label>Select Crew</label>
                                    <select class="form-control" wire:model.defer="state.crew" id="crew">
                                        <option value="">Select Crew</option>
                                        @forelse ($crews as $crew)
                                            <option value="{{ $crew->id }}">
                                                {{ $crew->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                <span wire:loading wire:target="addTask">Creating...</span>
                                <span wire:loading.remove>Create and Assign</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="openUserItinerary" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Meters

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            @if ($meters)
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tbody>
                                            <tr>
                                                <th>Meter #</th>
                                                <th>Service Type</th>
                                                <th>Phase</th>
                                                <th>Energy Readings</th>
                                                <th>Status</th>

                                            </tr>
                                            @forelse ($meters as $meter)
                                                <tr>
                                                    <td>{{ $meter->meter->meter_serial_number }}</td>
                                                    <td>{{ $meter->meter->service_type }}</td>
                                                    <td>{{ $meter->meter->phase }}</td>
                                                    <td>{{ $meter->meter->energy_type }}</td>
                                                    <td>{{ $meter->meter->status }}</td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-sm" id="comment" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">All Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($comments)
                        <div class="">
                            <div class="card-body">
                                @forelse ($comments as $comment)
                                    <div class="support-ticket media pb-1 mb-3">
                                        <img src="{{ asset('storage/images/avatar.png') }}" class="user-img mr-2"
                                            alt="">
                                        <div class="media-body ml-3">
                                            <p class="my-1">{{ $comment->comment }}</p>
                                            <small class="text-muted">Created by <span
                                                    class="font-weight-bold font-13">{{ $comment->user->firstname . ' ' . $comment->user->lastname }}</span>
                                                &nbsp;&nbsp; - {{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <hr>
                                @empty
                                @endforelse


                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" wire:ignore id="addComment" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" wire:ignore>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">Add Comment<div wire:loading
                            class="spinner-border text-danger mr-4" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitComment">
                        <div class="form-group">
                            <textarea class="form-control" wire:model="userComment" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Submit Comment</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

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
                                <option value="Both">Both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reading Date</label>
                            <input type="date" class="form-control" wire:model="reading_date">
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
