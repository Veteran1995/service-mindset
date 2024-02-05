<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Customers</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Customers List</li>
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
                                <i class="ti-arrow-up text-success"></i> 0
                            </h3>
                            <span class="text-muted">Total Customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>0
                            </h3>
                            <span class="text-muted">Male</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> 0
                            </h3>
                            <span class="text-muted">Female</span>
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
                                <i class="ti-arrow-up text-success"></i> 0
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
                <div class="col-lg-3">

                    <div>
                        <div class="card">
                            <div class="body">
                                <div id="plist" class="people-list">
                                    <div class="chat-search">
                                        <input type="text" class="form-control" placeholder="Search...">
                                    </div>
                                    <div class="m-b-20">
                                        <div id="chat-scroll" tabindex="1" style="outline: none;">
                                            <ul class="chat-list list-unstyled m-b-0">
                                                @forelse ($servicesOrders as $order)
                                                    <li class="clearfix{{ $loop->first ? ' active' : '' }}"
                                                        wire:click="openForm({{ $order->id }})">
                                                        <img src="{{ asset('storage/images/workorder.jpg') }}"
                                                            alt="avatar">
                                                        <div class="about">
                                                            <div class="name">{{ $order->service_order_type }}</div>
                                                            <div class="status">
                                                                {{ $order->customer->customer_name }} -
                                                                {{ $order->geo_community }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                @endforelse



                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="card px-0">
                        <div class="card-header">
                            <h4>Task Form
                                {{ $service_order_info ? ' : ' . $service_order_info->service_order_type : '' }}
                            </h4>
                            {{-- <button onclick="loadAllCustomersMap()" class="btn btn-primary">Refresh</button> --}}
                        </div>
                        <div class="card-body px-0">
                            <div>
                                @if ($showForm)
                                    <form wire:submit.prevent="addTask" class="p-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" wire:model="name"
                                                        id="name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" wire:model="description" id="description" rows="3"></textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="priority">Priority</label>
                                                    <select class="form-control" wire:model="priority" id="priority">
                                                        <option value="processing">Low</option>
                                                        <option value="schedule">Average</option>
                                                        <option value="completed">High</option>
                                                    </select>
                                                    @error('priority')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="due_date">Due Date</label>
                                                    <input type="date" class="form-control" wire:model="dueDate"
                                                        id="due_date">
                                                    @error('dueDate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="crewOrUserToggle">Select Crew or User</label>
                                                    <label class="switch">
                                                        <input type="checkbox" wire:model="crewOrUserToggle"
                                                            id="crewOrUserToggle">
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    @if ($crewOrUserToggle)
                                                        <label for="crew">Select Crew</label>
                                                        <select class="form-control" wire:model="selectedCrew"
                                                            id="crew">
                                                            <option value="">Select Crew</option>
                                                            @foreach ($crews as $crew)
                                                                <option value="{{ $crew->id }}">
                                                                    {{ $crew->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('selectedCrew')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @else
                                                        <label for="user">Select User</label>
                                                        <select class="form-control" wire:model="selectedUser"
                                                            id="user">
                                                            <option value="">Select User</option>
                                                            @forelse ($users as $user)
                                                                <option value="{{ $user->employee_id }}">
                                                                    {{ $user->firstname . ' ' . $user->lastname }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('selectedUser')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </form>

                                @endif


                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <div>

            </div>
        </div>
    </section>
</div>
