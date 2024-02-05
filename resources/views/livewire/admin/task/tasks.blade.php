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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Task Creations and Assignments <a href="{{ route('service-order-task-report') }}"
                            class="btn btn-success mx-3"><i class="fas fa-eye"></i>
                            View Report</a><a href="{{ route('add-tasks') }}" class="btn btn-primary mx-3"><i
                                class="fas fa-plus-circle"></i>
                            Add</a></h4>
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
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="text-center">
                                        <div class="custom-checkbox custom-checkbox-table custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                class="custom-control-input" id="checkbox-all">
                                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Task Name</th>
                                    <th>Assignee</th>
                                    <th>Assigned Date</th>
                                    <th>Due Date</th>
                                    <th>Task Status</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>

                                @forelse ($tasks as $task)
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="@if ($task->loss_reduction_id === null) {{ route('single-task', ['task_id' => $task->id]) }}
                                                @else
                                                    {{ route('los-reduction-case-detail', ['id' => $task->loss_reduction_id]) }} @endif"
                                                style="text-decoration: none; cursor: pointer; color: black">
                                                {{ $task->name }}
                                            </a>
                                        </td>

                                        <td class="text-truncate">
                                            @if ($task->crewAssignedTo)
                                                <i class="fas fa-users fa-lg" style="font-size: 30px;"
                                                    data-toggle="tooltip"
                                                    data-original-title="{{ $task->crewAssignedTo->name }}"></i>
                                            @else
                                                @if ($task->assignedTo->image)
                                                    <img alt="image"
                                                        src="{{ asset('storage/' . $task->assignedTo->image) }}"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title=""
                                                        data-original-title="{{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}">
                                                @else
                                                    <img alt="image"
                                                        src="{{ asset('storage/images/male_avatar.png') }}"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title=""
                                                        data-original-title="{{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}">
                                                @endif
                                            @endif

                                        </td>

                                        <td>{{ $task->assign_date }}</td>
                                        <td>{{ $task->due_date }}</td>

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
                                        <td><a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                                class="btn btn-outline-primary">Edit</a></td>
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

    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editTaskModal" role="dialog" wire:ignore
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
                    <form wire:submit.prevent="editTask">
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
                                            wire:model.defer="edit.task_name">
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
                                        <textarea type="text" class="form-control" placeholder="Enter Description" wire:model.defer="edit.description"></textarea>
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
                                            wire:model.defer="edit.due_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Service Order Assigned</label>
                                    <select class="form-control" wire:model.defer="edit.service_order_id">
                                        <option value="">Select Service Order</option>
                                        @forelse ($orders as $order)
                                            <option value="{{ $order->id }}">
                                                {{ $order->service_order_type }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="form-control" wire:model.defer="edit.priority">
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
                                    <select class="form-control" wire:model.defer="edit.individual" id="users">
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
                                    <select class="form-control" wire:model.defer="edit.crew" id="crew">
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
                                <span wire:loading wire:target="editTask">Creating...</span>
                                <span wire:loading.remove>Create and Assign</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
