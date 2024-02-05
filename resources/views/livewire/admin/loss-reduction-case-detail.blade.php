<div>


    <section class="section">
        <div class="card-header ">
            <button class="btn btn-primary "wire:click="enableFields"><i class="fa fa-edit"></i> Edit</button>
            @if (!$fieldsDisabled)
                <button class="btn btn-success"
                    @if ($verifiedCustomer) wire:click='editVerifiedLossReduction'
                    @elseif($unverifiedCustomer)
                    wire:click='editUnVerifiedLossReduction' @endif><i
                        class="fa fa-edit"></i> Update</button>
            @endif
            <span wire:loading
                @if ($verifiedCustomer) wire:target='editVerifiedLossReduction'
            @elseif($unverifiedCustomer)
            wire:target='editUnVerifiedLossReduction' @endif>
                Updating...</span>
            <div wire:loading wire:target="enableFields" class="spinner-border text-warning ml-3" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about"
                                        role="tab" aria-selected="true">Loss Reduction Case</a>
                                </li>

                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel"
                                    aria-labelledby="home-tab2">

                                    @if ($verifiedCustomer)
                                        <div>
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
                                                <div class="text-white" style="flex: 1; text-align: center;">
                                                    Awaiting Approval
                                                </div>
                                                <div class="text-white" style="flex: 1; text-align: center;">
                                                    Processing
                                                </div>
                                                <div class="text-white" style="flex: 1; text-align: center;">
                                                    Completed
                                                </div>
                                            </div>
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
                                                <div
                                                    style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                                    <div
                                                        style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                        <div
                                                            style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                                    <div
                                                        style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                        <div
                                                            style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                                    <div
                                                        style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                        <div
                                                            style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <form wire:submit.prevent="editVerifiedLossReduction">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Reported Activity</label>
                                                        <select class="form-control" wire:model="reportedActivity">
                                                            <option value="">Select Reported Activity</option>
                                                            <option value="Residential">Residential</option>
                                                            <option value="Office">Office</option>
                                                            <option value="Factory">Factory</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        @error('reportedActivity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Nearest Landmark</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="nearestLandmark">
                                                        @error('nearestLandmark')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Street</label>
                                                        <input type="text" class="form-control" wire:model="street">
                                                        @error('street')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" wire:model="city">
                                                    </div>
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>State/Province</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="stateProvinceLocation">
                                                    </div>
                                                    @error('stateProvinceLocation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Contact Number</label>
                                                        <input type="number" class="form-control"
                                                            wire:model="contactNumber">
                                                        @error('contactNumber')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Recommendation</label>
                                                        <textarea class="form-control" wire:model="recommendation"></textarea>
                                                        @error('recommendation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Description of Suspected Activity</label>
                                                        <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                                    </div>
                                                    @error('descriptionOfSuspectedActivity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>Reported By</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="reportedBy">
                                                    </div>
                                                    @error('reportedBy')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div
                                                        class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                        <label>File</label>
                                                        <input type="file" class="form-control" wire:model="file">
                                                    </div>
                                                    <div class="card" id="customermap"
                                                        style="width:100%; height:430px"></div>


                                                </div>
                                            </div>

                                        </form>

                                </div>
                            @elseif ($unverifiedCustomer)
                                <div>
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
                                        <div class="text-white" style="flex: 1; text-align: center;">
                                            Awaiting Approval
                                        </div>
                                        <div class="text-white" style="flex: 1; text-align: center;">
                                            Processing
                                        </div>
                                        <div class="text-white" style="flex: 1; text-align: center;">
                                            Completed
                                        </div>
                                    </div>
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
                                        <div
                                            style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                            <div
                                                style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                <div
                                                    style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                            <div
                                                style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                <div
                                                    style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                            <div
                                                style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                                <div
                                                    style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <form wire:submit.prevent="editUnVerifiedLossReduction">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Reported Activity</label>
                                                <select class="form-control" wire:model="reportedActivity">
                                                    <option value="">Select Reported Activity</option>
                                                    <option value="Residential">Residential</option>
                                                    <option value="Office">Office</option>
                                                    <option value="Factory">Factory</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                @error('reportedActivity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Nearest Landmark</label>
                                                <input type="text" class="form-control"
                                                    wire:model="nearestLandmark">
                                                @error('nearestLandmark')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Street</label>
                                                <input type="text" class="form-control" wire:model="street">
                                                @error('street')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>City</label>
                                                <input type="text" class="form-control" wire:model="city">
                                            </div>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>State/Province</label>
                                                <input type="text" class="form-control"
                                                    wire:model="stateProvinceLocation">
                                            </div>
                                            @error('stateProvinceLocation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>File</label>
                                                <input type="file" class="form-control" wire:model="file">
                                            </div>
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Recommendation</label>
                                                <textarea class="form-control" wire:model="recommendation"></textarea>
                                                @error('recommendation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Description of Suspected Activity</label>
                                                <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                            </div>
                                            @error('descriptionOfSuspectedActivity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Reported By</label>
                                                <input type="text" class="form-control" wire:model="reportedBy">
                                            </div>
                                            @error('reportedBy')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div
                                                class="form-group @if ($fieldsDisabled) disabled-text @endif">
                                                <label>Contact Number</label>
                                                <input type="number" class="form-control"
                                                    wire:model="contactNumber">
                                                @error('contactNumber')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="card" id="customermap" style="width:100%; height:440px">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                @endif

                                <hr>
                                {{-- UnVerified Edit Form --}}


                                @if ($verifiedCustomer)
                                    <div>
                                        <div class="card-header">
                                            <h4>Other Related Infomation</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                                <li class="nav-item">
                                                    <a class="nav-link active" id="profile-tab2" data-toggle="tab"
                                                        href="#profile2" role="tab" aria-controls="profile"
                                                        aria-selected="false">Tasks</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="home-tab2" data-toggle="tab"
                                                        href="#home2" role="tab" aria-controls="home"
                                                        aria-selected="true">Comments</a>

                                            </ul>
                                            <div class="tab-content tab-bordered" id="myTab3Content">
                                                <div class="tab-pane fade show active" id="profile2" role="tabpanel"
                                                    aria-labelledby="profile-tab2">
                                                    <div class="table-responsive card">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Description</th>
                                                                    <th>Priority</th>
                                                                    <th>Assign To</th>
                                                                    <th>Assign By</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                @forelse ($verifiedCustomer->tasks as $task)
                                                                    <tr>
                                                                        <td>{{ $task->name }}</td>
                                                                        <td>{{ $task->description }}</td>
                                                                        <td>{{ $task->priority }}</td>
                                                                        <td>
                                                                            @if ($task->crewAssignedTo)
                                                                                {{ $task->crewAssignedTo->name }}
                                                                            @elseif($task->assignedTo)
                                                                                {{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}
                                                                            @endif

                                                                        </td>
                                                                        <td>{{ $task->assignedBy ? $task->assignedBy->firstname . ' ' . $task->assignedBy->lastname : 'ServiceMindset' }}
                                                                        </td>
                                                                        <td>{{ $task->status }}</td>
                                                                    </tr>
                                                                @empty
                                                                    <td>No Task Available</td>
                                                                @endforelse

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="card">
                                                        <div class="card-header bg-dark">
                                                            <h4 class="text-white">Assign Task</h4>
                                                        </div>
                                                        <form wire:submit.prevent="addTask" class="p-3">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group ">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" class="form-control"
                                                                            wire:model="name" id="name">
                                                                        @error('name')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="description">Description</label>
                                                                        <textarea class="form-control" wire:model="description" id="description" rows="3"></textarea>
                                                                        @error('description')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="priority">Priority</label>
                                                                        <select class="form-control"
                                                                            wire:model="priority" id="priority">
                                                                            <option value="processing">Low</option>
                                                                            <option value="schedule">Average</option>
                                                                            <option value="completed">High</option>
                                                                        </select>
                                                                        @error('priority')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group ">
                                                                        <label for="due_date">Due Date</label>
                                                                        <input type="date" class="form-control"
                                                                            wire:model="dueDate" id="due_date">
                                                                        @error('dueDate')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="crewOrUserToggle">Select Crew or
                                                                            User</label>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                                wire:model="crewOrUserToggle"
                                                                                id="crewOrUserToggle">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        @if ($crewOrUserToggle)
                                                                            <label for="crew">Select Crew</label>
                                                                            <select class="form-control"
                                                                                wire:model="selectedCrew"
                                                                                id="crew">
                                                                                <option value="">Select Crew
                                                                                </option>
                                                                                @foreach ($crews as $crew)
                                                                                    <option
                                                                                        value="{{ $crew->id }}">
                                                                                        {{ $crew->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('selectedCrew')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        @else
                                                                            <label for="user">Select User</label>
                                                                            <select class="form-control"
                                                                                wire:model="selectedUser"
                                                                                id="user">
                                                                                <option value="">Select User
                                                                                </option>
                                                                                @forelse ($users as $user)
                                                                                    <option
                                                                                        value="{{ $user->employee_id }}">
                                                                                        {{ $user->firstname . ' ' . $user->lastname }}
                                                                                    </option>
                                                                                @empty
                                                                                @endforelse
                                                                            </select>
                                                                            @error('selectedUser')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary btn-block">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="home2" role="tabpanel"
                                                    aria-labelledby="home-tab2">


                                                    @forelse ($verifiedCustomer->comments as $comment)
                                                        <li class="media">
                                                            <img alt="image" class="mr-3 rounded-circle"
                                                                width="70"
                                                                src="{{ asset('storage/images/male_avatar.png') }}">
                                                            <div class="media-body">
                                                                <div class="media-right">
                                                                    <div
                                                                        style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <div class="text-warning"
                                                                            style="margin-right: 5px">
                                                                            <button class="btn btn-success"
                                                                                wire:click="showAddTaskForm">Create
                                                                                Task</button>
                                                                        </div>
                                                                        <div class="text-warning"><button
                                                                                wire:click="closeCase"
                                                                                class="btn btn-danger">Cancel</button>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="media-title mb-1">
                                                                    {{ $comment->user->firstname . ' ' . $comment->user->lastname }}
                                                                </div>
                                                                <div class="text-time">{{ $comment->created_at }}
                                                                </div>
                                                                <div class="media-description text-muted">
                                                                    {{ $comment->comment }}
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr class="mb-1 p-0">
                                                    @empty
                                                        <p>No comments Available</p>
                                                    @endforelse





                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($unverifiedCustomer)
                                    <div>
                                        <div class="card-header">
                                            <h4>Other Related Infomation</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab2" data-toggle="tab"
                                                        href="#home2" role="tab" aria-controls="home"
                                                        aria-selected="true">Comments</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab2" data-toggle="tab"
                                                        href="#profile2" role="tab" aria-controls="profile"
                                                        aria-selected="false">Tasks</a>
                                                </li>
                                                {{-- <li class="nav-item">
                                            <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                                role="tab" aria-controls="contact"
                                                aria-selected="false">Contact</a>
                                        </li> --}}
                                            </ul>
                                            <div class="tab-content tab-bordered" id="myTab3Content">
                                                <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                                    aria-labelledby="home-tab2">


                                                    @forelse ($unverifiedCustomer->comments as $comment)
                                                        <li class="media">
                                                            <img alt="image" class="mr-3 rounded-circle"
                                                                width="70"
                                                                src="{{ asset('storage/images/male_avatar.png') }}">
                                                            <div class="media-body">
                                                                <div class="media-right">
                                                                    <div
                                                                        style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <div class="text-warning"
                                                                            style="margin-right: 5px">
                                                                            <button class="btn btn-success"
                                                                                wire:click="showAddTaskForm">Create
                                                                                Task</button>
                                                                        </div>
                                                                        <div class="text-warning"><button
                                                                                wire:click="closeCase"
                                                                                class="btn btn-danger">Cancel</button>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="media-title mb-1">
                                                                    {{ $comment->user->firstname . ' ' . $comment->user->lastname }}
                                                                </div>
                                                                <div class="text-time">{{ $comment->created_at }}
                                                                </div>
                                                                <div class="media-description text-muted">
                                                                    {{ $comment->comment }}
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <hr class="mb-1 p-0">2
                                                    @empty
                                                        <p>No comments Available</p>
                                                    @endforelse
                                                    <hr>
                                                    <div class="card-header bg-dark">
                                                        <h4 class="text-white">Assign Task</h4>
                                                    </div>
                                                    <form wire:submit.prevent="addTask" class="p-3">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        wire:model="name" id="name">
                                                                    @error('name')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control" wire:model="description" id="description" rows="3"></textarea>
                                                                    @error('description')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="priority">Priority</label>
                                                                    <select class="form-control" wire:model="priority"
                                                                        id="priority">
                                                                        <option value="processing">Low</option>
                                                                        <option value="schedule">Average</option>
                                                                        <option value="completed">High</option>
                                                                    </select>
                                                                    @error('priority')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="due_date">Due Date</label>
                                                                    <input type="date" class="form-control"
                                                                        wire:model="dueDate" id="due_date">
                                                                    @error('dueDate')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="crewOrUserToggle">Select Crew or
                                                                        User</label>
                                                                    <label class="switch">
                                                                        <input type="checkbox"
                                                                            wire:model="crewOrUserToggle"
                                                                            id="crewOrUserToggle">
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    @if ($crewOrUserToggle)
                                                                        <label for="crew">Select Crew</label>
                                                                        <select class="form-control"
                                                                            wire:model="selectedCrew" id="crew">
                                                                            <option value="">Select Crew
                                                                            </option>
                                                                            @foreach ($crews as $crew)
                                                                                <option value="{{ $crew->id }}">
                                                                                    {{ $crew->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('selectedCrew')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    @else
                                                                        <label for="user">Select User</label>
                                                                        <select class="form-control"
                                                                            wire:model="selectedUser" id="user">
                                                                            <option value="">Select User
                                                                            </option>
                                                                            @forelse ($users as $user)
                                                                                <option
                                                                                    value="{{ $user->employee_id }}">
                                                                                    {{ $user->firstname . ' ' . $user->lastname }}
                                                                                </option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                        @error('selectedUser')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Submit</button>
                                                    </form>




                                                </div>
                                                <div class="tab-pane fade" id="profile2" role="tabpanel"
                                                    aria-labelledby="profile-tab2">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Description</th>
                                                                    <th>Priority</th>
                                                                    <th>Assign To</th>
                                                                    <th>Assign By</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                @forelse ($unverifiedCustomer->tasks as $task)
                                                                    <tr>
                                                                        <td>{{ $task->name }}</td>
                                                                        <td>{{ $task->description }}</td>
                                                                        <td>{{ $task->priority }}</td>
                                                                        <td>
                                                                            @if ($task->crewAssignedTo)
                                                                                {{ $task->crewAssignedTo->name }}
                                                                            @elseif($task->assignedTo)
                                                                                {{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}
                                                                            @endif

                                                                        </td>
                                                                        <td>{{ $task->assignedBy ? $task->assignedBy->firstname . ' ' . $task->assignedBy->lastname : 'ServiceMindset' }}
                                                                        </td>
                                                                        <td>{{ $task->status }}</td>
                                                                    </tr>
                                                                @empty
                                                                    <td>No Task Available</td>
                                                                @endforelse

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="tab-pane fade" id="contact2" role="tabpanel"
                                            aria-labelledby="contact-tab2">
                                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin
                                            ligula massa,
                                            gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum,
                                            sem
                                            interdum
                                            molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor.
                                            Nam
                                            malesuada orci non
                                            ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum
                                            venenatis ultrices.
                                            Proin bibendum bibendum augue ut luctus.
                                        </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" id="taskCommentModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addComment">
                        <div class="form-group">
                            <label>Add Comment</label>
                            <textarea type="text" class="form-control" wire:model.defer="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                <span wire:loading wire:target="addComment">Adding Comment...</span>
                                <span wire:loading.remove>Add Comment</span>
                            </button>
                        </div>
                    </form>
                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder"
                        style="max-height:500px; overflow: scroll">
                        @if ($taskComments != null)
                            @foreach ($taskComments as $comment)
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70"
                                        src="{{ asset('storage/' . $comment->sender->image) }}">
                                    <div class="media-body">
                                        <div class="media-right">
                                            <div class="text-primary">Approved</div>
                                        </div>
                                        <div class="media-title mb-1">
                                            {{ $comment->sender->firstname . ' ' . $comment->sender->lastname }}
                                        </div>
                                        <div class="text-time">{{ $comment->created_at->diffForHumans() }}
                                        </div>
                                        <div class="media-description text-muted">
                                            {{ $comment->comment }}
                                        </div>
                                        <div class="media-links">
                                            <a href="#">View</a>

                                            @if ($comment->sender_id == auth()->user()->employee_id)
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#" class="text-danger">Trash</a>
                                            @endif

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>No Comments</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div wire:init="fetchLocation"></div>

    </div> --}}
</div>
</div>
