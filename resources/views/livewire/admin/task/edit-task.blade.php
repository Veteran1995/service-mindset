<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Task</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Edit | Reassign Task</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Task | Reassign Task</h4>
                            <div class="card-header-form">
                                <div class="row mr-3">
                                    <div class="mr-3">
                                        <a class="btn btn-primary" href="{{ route('customers') }}"><i
                                                class="fas fa-chevron-circle-left"></i> Back</a>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="card-body">

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
                                                    wire:model.defer="edit.name">
                                                @error('edit.name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="input-group">
                                                <textarea type="text" class="form-control" placeholder="Enter Description" wire:model.defer="edit.description"></textarea>
                                                @error('edit.description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                @error('edit.due_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                        ({{ $order->customer->customer_name }})
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('edit.service_order_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <select class="form-control" wire:model.defer="edit.priority">
                                                <option value="">Select Priority</option>
                                                <option value="Low">Low</option>
                                                <option value="Average">Average</option>
                                                <option value="High">High</option>
                                            </select>
                                            @error('edit.priority')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            <select class="form-control" wire:model.defer="edit.assigned_to_id"
                                                id="users">
                                                <option value="">Select Individual</option>
                                                @forelse ($users as $user)
                                                    <option value="{{ $user->employee_id }}">
                                                        {{ $user->firstname . ' ' . $user->lastname }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('edit.assigned_to_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="group" style="display: none;">
                                            <label>Select Crew</label>
                                            <select class="form-control" wire:model.defer="edit.crew_id" id="crew">
                                                <option value="">Select Crew</option>
                                                @forelse ($crews as $crew)
                                                    <option value="{{ $crew->id }}">
                                                        {{ $crew->name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('edit.crew_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"
                                        wire:loading.attr="disabled">
                                        <span wire:loading wire:target="editTask">Updating and Assigning...</span>
                                        <span wire:loading.remove>Edit and Assign</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
