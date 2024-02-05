<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List of Customers </h4>

                <div class="card-header-form">
                    <div class="row">
                        <div class="mx-2">
                            <i class="fas fa-th-large" style="color: #1a4ca2;" onclick="toggleGrid()"></i>
                        </div>
                        <div class="mx-2">
                            <i class="fas fa-list" style="color: #1a4ca2;" onclick="toggleList()"></i>
                        </div>
                        <div>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model="customerNameSearch" placeholder="Search">
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
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(119px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" wire:click.prevent="deleteSelectedRow" href="#">Delete</a>
                        {{-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a> --}}
                    </div>
                </div>
            </div>
            @endif

            <div class="card-body p-0">
                <div class="table-responsive show" id="list">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th class="m-4 text-center">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input wire:model="selectedPageRows" class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                    </div>

                                </th>
                                <th>Contract #</th>
                                <th>Name</th>
                                <th>Account #</th>
                                <th>Gender</th>
                                <th>Geo Community</th>
                                <th>Geo Zone</th>
                                <th>Contract Status</th>
                            </tr>
                            @forelse ($customers as $customer)
                            <tr>

                                <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input wire:model="selectedRows" class="form-check-input" type="checkbox" value="{{ $customer->cnumber }}" id="defaultCheck1" />
                                    </div>

                                </td>
                                <td class="align-middle">
                                    <strong>
                                        <a href="{{ route('customer-profile', ['customer_id' => $customer->cnumber]) }}" class="text-decoration-none text-dark">
                                            {{ $customer->cnumber }}
                                        </a>

                                    </strong>

                                </td>
                                <td> {{ $customer->customer_name }}</td>
                                <td> {{ $customer->account_number }}</td>
                                {{-- <td>
                                                    @if ($customer->image)
                                                        <img alt="image"
                                                            src="{{ asset('storage/' . $customer->image) }}"
                                class="rounded-circle" width="35"
                                data-toggle="tooltip" title=""
                                data-original-title=" {{ $customer->firstname . ' ' . $customer->lastname }}">
                                @else
                                @if ($customer->gender == 'Male')
                                <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title=" {{ $customer->firstname . ' ' . $customer->lastname }}">
                                @else
                                <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title=" {{ $customer->firstname . ' ' . $customer->lastname }}">
                                @endif
                                @endif

                                </td> --}}

                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->geo_community }}</td>
                                <td>{{ $customer->geo_zone }}</td>
                                <td>
                                    <div class="badge badge-success">{{ $customer->contract_status }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse


                        </tbody>
                    </table>
                    <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                        <div style="float:right;">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>

                <div class="hide" id="grid">
                    <div class="row m-1 b-rounded">
                        @forelse ($customers as $customer)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <article class="article">
                                <div class="article-header">


                                    @if ($customer->image)
                                    <div class="article-image" data-background="{{ asset('storage/' . $customer->image) }}" style="background-image: url(&quot;{{ asset('storage/' . $customer->image) }}&quot;);">
                                    </div>
                                    @else
                                    @if ($customer->gender == 'Male')
                                    <div class="article-image" data-background="{{ asset('storage/images/male_avatar.png') }}" style="background-image: url(&quot;{{ asset('storage/images/male_avatar.png') }}&quot;);">
                                    </div>
                                    @else
                                    <div class="article-image" data-background="{{ asset('storage/images/female_avatar.png') }}" style="background-image: url(&quot;{{ asset('storage/images/female_avatar.png') }}&quot;);">
                                    </div>
                                    @endif
                                    @endif

                                    <div class="article-image" data-background="assets/img/blog/img08.png" style="background-image: url(&quot;assets/img/blog/img08.png&quot;);">
                                    </div>
                                    <div class="article-title">
                                        <h2><a href="#">{{ $customer->customer_name }}</a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="article-details">

                                    <div class="article-cta">
                                        <a href="#" class="btn btn-primary">View Profile</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div>
    <div class="card">
        <div class="card-body">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                <a href="{{ route('los-reduction') }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i> View Cases
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            @if ($showAddForm === true)
                            <h4 class="text-white">Loss Reduction Case Form</h4>
                            @elseif($showVerifiedEditForm === true && $verifiedCustomer)
                            <h4 class="text-white">{{ $verifiedCustomer->fullname }}</h4>
                            @elseif($showUnVerifiedEditForm === true && $unverifiedCustomer)
                            <h4 class="text-white">{{ $unverifiedCustomer->reported_activity }}</h4>
                            @endif
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="addLossReduction">
                                <div class="form-group">
                                    <label class="d-block">Customer Account Verified?</label>
                                    <div class="form-check">
                                        <select class="form-control" wire:model="customerAccountVerified">
                                            <option value="">Choose Verification</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('customerAccountVerified')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if ($customerAccountVerified === 'yes')
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label>Customer SPN</label>
                                            <input type="number" class="form-control" wire:model="customerSPN">
                                            @error('customerSPN')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <!-- Floating section indicator -->
                                        <div class="container mt-5 text-center" wire:loading wire:target="verifyCustomer">
                                            <!-- Bootstrap Spinner -->
                                            <div class="spinner-border text-dark" role="status">

                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block" wire:click="verifyCustomer">Verify</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Source of Detection</label>
                                            <select class="form-control" wire:model="sourceOfDetection">
                                                <option value="">Select Source of Detection</option>
                                                <option value="Field Request">Field Request</option>
                                                <option value="Analytics">Analytics</option>
                                                <option value="Complaints">Complaints</option>
                                                <option value="4700 Hotline">4700 Hotline</option>
                                            </select>
                                            @error('sourceOfDetection')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Loss Reduction Case Type</label>
                                            <select class="form-control" wire:model="lossReductionCaseType">
                                                <option value="">Select Loss Reduction Case Type</option>
                                                @foreach ($caseType as $type)
                                                <option value="{{ $type->case_id }}">{{ $type->type }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('lossReductionCaseType')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Meter Number</label>
                                            <input type="text" class="form-control" wire:model="meterNumber">
                                            @error('meterNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" wire:model="fullname">
                                            @error('fullname')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Geo Community</label>
                                            <input type="text" class="form-control" wire:model="geoCommunity">
                                            @error('geoCommunity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Geo Zone</label>
                                            <input type="text" class="form-control" wire:model="geoZone">
                                            @error('geoZone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                            @error('descriptionOfSuspectedActivity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Recommendation</label>
                                            <textarea class="form-control" wire:model="recommendation"></textarea>
                                            @error('recommendation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @elseif($customerAccountVerified === 'no')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
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
                                        <div class="form-group">
                                            <label>Loss Reduction Case Type</label>
                                            <select class="form-control" wire:model="lossReductionCaseType">
                                                <option value="">Select Loss Reduction Case Type</option>
                                                @foreach ($caseType as $type)
                                                <option value="{{ $type->case_id }}">{{ $type->type }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('lossReductionCaseType')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nearest Landmark</label>
                                            <input type="text" class="form-control" wire:model="nearestLandmark">
                                            @error('nearestLandmark')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" class="form-control" wire:model="street">
                                            @error('street')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" wire:model="city">
                                        </div>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                        </div>
                                        @error('descriptionOfSuspectedActivity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Recommendation</label>
                                            <textarea class="form-control" wire:model="recommendation"></textarea>
                                            @error('recommendation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" class="custom-switch-input" wire:model="forwardForAssessment">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Forward For Assessment</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" class="custom-switch-input" wire:model="forwardForEngagement">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Forward For Engagement</span>
                                    </label>
                                </div>

                                @if ($forwardForAssessment && $forwardForEngagement == false)
                                <div class="card p-4">
                                    <div class="card-header bg-dark">
                                        <h6 class="text-white">Assign Task </h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" wire:model="name" id="name">
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
                                                <input type="date" class="form-control" wire:model="dueDate" id="due_date">
                                                @error('dueDate')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="crewOrUserToggle">Select Crew or
                                                    User</label>
                                                <label class="switch">
                                                    <input type="checkbox" wire:model="crewOrUserToggle" id="crewOrUserToggle">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                @if ($crewOrUserToggle)
                                                <label for="crew">Select Crew</label>
                                                <select class="form-control" wire:model="selectedCrew" id="crew">
                                                    <option value="">Select Crew</option>
                                                    @foreach ($crews as $crew)
                                                    <option value="{{ $crew->id }}">
                                                        {{ $crew->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('selectedCrew')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @else
                                                <label for="user">Select User</label>
                                                <select class="form-control" wire:model="selectedUser" id="user">
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
                                </div>

                                @endif


                                <!-- Floating section indicator -->
                                <div class="container mt-5 text-center" wire:loading="addLossReduction" wire:target="addLossReduction">
                                    <!-- Bootstrap Spinner -->
                                    <div class="spinner-border text-dark" role="status">

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1 btn-block" type="submit">Submit</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>










<div>
    <div class="card">
        <div class="card-body">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                <button wire:click="showAddForm" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> Register Case
                                </button>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
            <hr>
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label>Filter by Verification</label>
                    <select class="form-control" wire:model="filterByVerification">
                        <option value="">Select Filter</option>
                        <option value="yes">Verified</option>
                        <option value="no">Unverified</option>

                    </select>
                </div>

                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label>Filter by Source of Destination</label>
                    <select class="form-control" wire:model="filterBysourceOfDetection">
                        <option value="">Select Source of Detection</option>
                        <option value="Field Request">Field Request</option>
                        <option value="Analytics">Analytics</option>
                        <option value="Complaints">Complaints</option>
                        <option value="4700 Hotline">4700 Hotline</option>
                    </select>
                </div>

                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label>Filter by Reported Activity</label>
                    <select class="form-control" wire:model="filterReportedActivity">
                        <option value="">Select Reported Activity</option>
                        <option value="Residential">Residential</option>
                        <option value="Office">Office</option>
                        <option value="Factory">Factory</option>
                    </select>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Filter by Reported Date</label>
                    <input type="text" class="form-control datepicker" wire:model="filterByDate">
                </div>
            </div>


            <hr>
            <div class="row">
                <div class="col-lg-3">

                    <div class="card">
                        <div class="card-header bg-primary d-flex justify-content-between align-items-center pr-3">

                            <h4 class="text-white">Cases</h4>
                            <a href="" class="text-white">See All</a>

                        </div>
                        <div class="m-3">
                            <input type="text" placeholder="Search Case" class="form-control">
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border user-list" id="message-list">
                                @forelse ($cases as $case)
                                @if ($case->customer_account_verified === 'yes')
                                <li class="media" style="cursor: pointer" onmouseover="this.style.backgroundColor='grey';this.style.color='white';" onmouseout="this.style.backgroundColor='transparent';this.style.color='black';">
                                    <img alt="image" src="{{ asset('storage/images/verified.jpg') }}" class="mr-3 user-img-radious-style user-list-img">
                                    <div class="media-body" style="background-color: transparent;">
                                        <div class="d-flex justify-content-between align-items-center pr-3" wire:click="verifiedCustomer({{ $case->id }})">
                                            <div class="mt-0 font-weight-bold">{{ $case->fullname }}</div>
                                            <div class="badge badge-{{ $case->status === 'pending' ? 'warning' : 'success' }}">
                                                {{ $case->status }}
                                            </div>
                                        </div>
                                        <div class="text-small">
                                            {{ $case->city || $case->street ? $case->city . ' ' . $case->street : 'N/A' }}
                                        </div>
                                    </div>
                                </li>
                                @elseif($case->customer_account_verified === 'no')
                                <li class="media" style="cursor: pointer" onmouseover="this.style.backgroundColor='grey';this.style.color='white';" onmouseout="this.style.backgroundColor='transparent';this.style.color='black';">
                                    <img alt="image" src="{{ asset('storage/images/unverified.jpg') }}" class="mr-3 user-img-radious-style user-list-img">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center pr-3" wire:click="unverifiedCustomer({{ $case->id }})">
                                            <div class="mt-0 font-weight-bold">{{ $case->reported_activity }}
                                            </div>
                                            <div class="badge badge-{{ $case->status === 'pending' ? 'warning' : 'success' }}">
                                                {{ $case->status }}
                                            </div>
                                        </div>
                                        <div class="text-small">
                                            {{ $case->city || $case->street ? $case->city . ' ' . $case->street : 'N/A' }}

                                        </div>
                                    </div>
                                </li>
                                @endif

                                @empty
                                @endforelse

                            </ul>
                        </div>
                    </div>


                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-dark">
                            @if ($showAddForm === true)
                            <h4 class="text-white">Loss Reduction Case Form</h4>
                            @elseif($showVerifiedEditForm === true && $verifiedCustomer)
                            <h4 class="text-white">{{ $verifiedCustomer->fullname }}</h4>
                            @elseif($showUnVerifiedEditForm === true && $unverifiedCustomer)
                            <h4 class="text-white">{{ $unverifiedCustomer->reported_activity }}</h4>
                            @endif
                        </div>
                        <div class="card-body">
                            @if ($showAddForm === true)
                            <form wire:submit.prevent="addLossReduction">
                                <div class="form-group">
                                    <label class="d-block">Customer Account Verified?</label>
                                    <div class="form-check">
                                        <select class="form-control" wire:model="customerAccountVerified">
                                            <option value="">Choose Verification</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('customerAccountVerified')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if ($customerAccountVerified === 'yes')
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <label>Customer SPN</label>
                                            <input type="number" class="form-control" wire:model="customerSPN">
                                            @error('customerSPN')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <!-- Floating section indicator -->
                                        <div class="container mt-5 text-center" wire:loading wire:target="verifyCustomer">
                                            <!-- Bootstrap Spinner -->
                                            <div class="spinner-border text-dark" role="status">

                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block" wire:click="verifyCustomer">Verify</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Source of Detection</label>
                                            <select class="form-control" wire:model="sourceOfDetection">
                                                <option value="">Select Source of Detection</option>
                                                <option value="Field Request">Field Request</option>
                                                <option value="Analytics">Analytics</option>
                                                <option value="Complaints">Complaints</option>
                                                <option value="4700 Hotline">4700 Hotline</option>
                                            </select>
                                            @error('sourceOfDetection')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Loss Reduction Case Type</label>
                                            <select class="form-control" wire:model="lossReductionCaseType">
                                                <option value="">Select Loss Reduction Case Type</option>
                                                @foreach ($caseType as $type)
                                                <option value="{{ $type->case_id }}">{{ $type->type }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('lossReductionCaseType')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Meter Number</label>
                                            <input type="text" class="form-control" wire:model="meterNumber">
                                            @error('meterNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" wire:model="fullname">
                                            @error('fullname')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Geo Community</label>
                                            <input type="text" class="form-control" wire:model="geoCommunity">
                                            @error('geoCommunity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Geo Zone</label>
                                            <input type="text" class="form-control" wire:model="geoZone">
                                            @error('geoZone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                            @error('descriptionOfSuspectedActivity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Recommendation</label>
                                            <textarea class="form-control" wire:model="recommendation"></textarea>
                                            @error('recommendation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @elseif($customerAccountVerified === 'no')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
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
                                        <div class="form-group">
                                            <label>Loss Reduction Case Type</label>
                                            <select class="form-control" wire:model="lossReductionCaseType">
                                                <option value="">Select Loss Reduction Case Type</option>
                                                @foreach ($caseType as $type)
                                                <option value="{{ $type->case_id }}">{{ $type->type }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('lossReductionCaseType')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nearest Landmark</label>
                                            <input type="text" class="form-control" wire:model="nearestLandmark">
                                            @error('nearestLandmark')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" class="form-control" wire:model="street">
                                            @error('street')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" wire:model="city">
                                        </div>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror


                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                        </div>
                                        @error('descriptionOfSuspectedActivity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Recommendation</label>
                                            <textarea class="form-control" wire:model="recommendation"></textarea>
                                            @error('recommendation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" class="custom-switch-input" wire:model="forwardForAssessment">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Forward For Assessment</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" class="custom-switch-input" wire:model="forwardForEngagement">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Forward For Engagement</span>
                                    </label>
                                </div>

                                @if ($forwardForAssessment && $forwardForEngagement == false)
                                <div class="card p-4">
                                    <div class="card-header bg-dark">
                                        <h6 class="text-white">Assign Task </h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" wire:model="name" id="name">
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
                                                <input type="date" class="form-control" wire:model="dueDate" id="due_date">
                                                @error('dueDate')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="crewOrUserToggle">Select Crew or
                                                    User</label>
                                                <label class="switch">
                                                    <input type="checkbox" wire:model="crewOrUserToggle" id="crewOrUserToggle">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                @if ($crewOrUserToggle)
                                                <label for="crew">Select Crew</label>
                                                <select class="form-control" wire:model="selectedCrew" id="crew">
                                                    <option value="">Select Crew</option>
                                                    @foreach ($crews as $crew)
                                                    <option value="{{ $crew->id }}">
                                                        {{ $crew->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('selectedCrew')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @else
                                                <label for="user">Select User</label>
                                                <select class="form-control" wire:model="selectedUser" id="user">
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
                                </div>

                                @endif


                                <!-- Floating section indicator -->
                                <div class="container mt-5 text-center" wire:loading="addLossReduction" wire:target="addLossReduction">
                                    <!-- Bootstrap Spinner -->
                                    <div class="spinner-border text-dark" role="status">

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1 btn-block" type="submit">Submit</button>
                                </div>
                            </form>
                            @endif


                            {{-- Verified Edit Form --}}
                            @if ($showVerifiedEditForm == true && $verifiedCustomer)
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
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
                                <div style="display: flex; justify-content: space-between; align-items: center; background-color: #3e3d3d; padding: 8px; border-radius: 4px;">
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                        <div style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                            <div style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                        <div style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                            <div style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                        <div style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                            <div style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <form wire:submit.prevent="editVerifiedLossReduction">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Source of Detection</label>
                                            <select class="form-control" wire:model="sourceOfDetection">
                                                <option value="">Select Source of Detection</option>
                                                <option value="Field Request">Field Request</option>
                                                <option value="Analytics">Analytics</option>
                                                <option value="Complaints">Complaints</option>
                                                <option value="4700 Hotline">4700 Hotline</option>
                                            </select>
                                            @error('sourceOfDetection')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Customer SPN</label>
                                            <input type="text" class="form-control" value="{{ $verifiedCustomer->customer_spn }}" wire:model="customerSPN">
                                            @error('customerSPN')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Meter Number</label>
                                            <input type="text" class="form-control" value="{{ $verifiedCustomer->meter_number }}" wire:model="meterNumber">
                                            @error('meterNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" value="{{ $verifiedCustomer->fullname }}" wire:model="fullname">
                                            @error('fullname')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Geo Community</label>
                                            <input type="text" class="form-control" wire:model="geoCommunity">
                                            @error('geoCommunity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Geo Zone</label>
                                            <input type="text" class="form-control" wire:model="geoZone">
                                            @error('geoZone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>State/Province</label>
                                            <input type="text" class="form-control" wire:model="stateProvince">
                                            @error('stateProvince')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" wire:model="postalCode">
                                            @error('postalCode')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1 btn-block" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                        @endif

                        {{-- UnVerified Edit Form --}}
                        @if ($showUnVerifiedEditForm === true)
                        <div>
                            <form wire:submit.prevent="editUnVerifiedLossReduction">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
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
                                        <div class="form-group">
                                            <label>Nearest Landmark</label>
                                            <input type="text" class="form-control" wire:model="nearestLandmark">
                                            @error('nearestLandmark')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Street</label>
                                            <input type="text" class="form-control" wire:model="street">
                                            @error('street')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" wire:model="city">
                                        </div>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>State/Province</label>
                                            <input type="text" class="form-control" wire:model="stateProvinceLocation">
                                        </div>
                                        @error('stateProvinceLocation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" wire:model="postalCodeLocation">
                                        </div>
                                        @error('postalCodeLocation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                        </div>
                                        @error('descriptionOfSuspectedActivity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Recommendation</label>
                                            <textarea class="form-control" wire:model="recommendation"></textarea>
                                            @error('recommendation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1 btn-block" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                        @endif

                        {{-- UnVerified Edit Form --}}
                        @if ($verifiedCustomer)
                        <div>
                            <div class="card-header">
                                <h4>Other Related Infomation</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Comments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Tasks</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                            <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                                role="tab" aria-controls="contact"
                                                aria-selected="false">Contact</a>
                                        </li> --}}
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                                        @if ($addTaskForm == false)

                                        @forelse ($verifiedCustomer->comments as $comment)
                                        <li class="media">
                                            <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('storage/images/male_avatar.png') }}">
                                            <div class="media-body">
                                                <div class="media-right">
                                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                                        <div class="text-warning" style="margin-right: 5px">
                                                            <button class="btn btn-success" wire:click="showAddTaskForm">Create
                                                                Task</button>
                                                        </div>
                                                        <div class="text-warning"><button wire:click="closeCase" class="btn btn-danger">Cancel</button>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="media-title mb-1">
                                                    {{ $comment->user->firstname . ' ' . $comment->user->lastname }}
                                                </div>
                                                <div class="text-time">{{ $comment->created_at }}</div>
                                                <div class="media-description text-muted">
                                                    {{ $comment->comment }}
                                                </div>
                                            </div>
                                        </li>
                                        <hr class="mb-1 p-0">
                                        @empty
                                        @endforelse
                                        @else
                                        <form wire:submit.prevent="addTask" class="p-3">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" wire:model="name" id="name">
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
                                                        <input type="date" class="form-control" wire:model="dueDate" id="due_date">
                                                        @error('dueDate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="crewOrUserToggle">Select Crew or
                                                            User</label>
                                                        <label class="switch">
                                                            <input type="checkbox" wire:model="crewOrUserToggle" id="crewOrUserToggle">
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        @if ($crewOrUserToggle)
                                                        <label for="crew">Select Crew</label>
                                                        <select class="form-control" wire:model="selectedCrew" id="crew">
                                                            <option value="">Select Crew</option>
                                                            @foreach ($crews as $crew)
                                                            <option value="{{ $crew->id }}">
                                                                {{ $crew->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('selectedCrew')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @else
                                                        <label for="user">Select User</label>
                                                        <select class="form-control" wire:model="selectedUser" id="user">
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
                                        <button class="btn btn-danger" wire:click="closeForm"><i class="fas fa-window-close"></i>
                                            Close
                                            Form</button>
                                        @endif


                                    </div>
                                    <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
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
                        @if ($unverifiedCustomer && !$verifiedCustomer)
                        <div>
                            <div class="card-header">
                                <h4>Other Related Infomation</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Tasks</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                            role="tab" aria-controls="contact"
                                            aria-selected="false">Contact</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6>Tasks <button wire:click="showAddUnverifiedCustomerTaskForm" class="btn btn-primary ml-3">Assign Task</button>
                                                </h6>
                                            </div>
                                            <div class="card-body">
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
                                                <hr>
                                                @if ($addUnVerifiedCustomerTaskForm == false)
                                                @else
                                                <form wire:submit.prevent="addTask" class="p-3">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" wire:model="name" id="name">
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
                                                                    <option value="schedule">Average
                                                                    </option>
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
                                                                <input type="date" class="form-control" wire:model="dueDate" id="due_date">
                                                                @error('dueDate')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="crewOrUserToggle">Select Crew
                                                                    or
                                                                    User</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" wire:model="crewOrUserToggle" id="crewOrUserToggle">
                                                                    <span class="slider"></span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group">
                                                                @if ($crewOrUserToggle)
                                                                <label for="crew">Select
                                                                    Crew</label>
                                                                <select class="form-control" wire:model="selectedCrew" id="crew">
                                                                    <option value="">Select Crew
                                                                    </option>
                                                                    @foreach ($crews as $crew)
                                                                    <option value="{{ $crew->id }}">
                                                                        {{ $crew->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('selectedCrew')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @else
                                                                <label for="user">Select
                                                                    User</label>
                                                                <select class="form-control" wire:model="selectedUser" id="user">
                                                                    <option value="">Select User
                                                                    </option>
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
                                                <button class="btn btn-danger" wire:click="closeUnverifiedCustomerForm"><i class="fas fa-window-close"></i>
                                                    Close
                                                    Form</button>
                                                @endif
                                            </div>
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

{{-- <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="1"
                            class="selectgroup-input-radio select-layout" checked>
                        <span class="selectgroup-button">Light</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="value" value="2"
                            class="selectgroup-input-radio select-layout">
                        <span class="selectgroup-button">Dark</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="1"
                            class="selectgroup-input select-sidebar">
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="icon-input" value="2"
                            class="selectgroup-input select-sidebar" checked>
                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                    <ul class="choose-theme list-unstyled mb-0">
                        <li title="white" class="active">
                            <div class="white"></div>
                        </li>
                        <li title="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li title="black">
                            <div class="black"></div>
                        </li>
                        <li title="purple">
                            <div class="purple"></div>
                        </li>
                        <li title="orange">
                            <div class="orange"></div>
                        </li>
                        <li title="green">
                            <div class="green"></div>
                        </li>
                        <li title="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                            id="mini_sidebar_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Mini Sidebar</span>
                    </label>
                </div>
            </div>
            <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                    <label class="m-b-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                            id="sticky_header_setting">
                        <span class="custom-switch-indicator"></span>
                        <span class="control-label p-l-10">Sticky Header</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                    <i class="fas fa-undo"></i> Restore Default
                </a>
            </div>
        </div>
    </div>
</div> --}}

</div>


/////////////////////////////////////////////////////////////////

<!-- Customer Engagement -->


@php
    use App\Models\LossReductionCase;
@endphp
<div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-purple">
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>{{ LossReductionCase::count() }}
                            </h3>
                            <span class="text-muted">Total</span>
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
                                <i class="ti-arrow-up text-success"></i>
                                {{ LossReductionCase::where('assessment', 1)->count() }}

                            </h3>
                            <span class="text-muted">Assessments</span>
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
                                <i class="ti-arrow-up text-success"></i>
                                {{ LossReductionCase::where('engagement', 1)->count() }}
                            </h3>
                            <span class="text-muted">Engagements
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-orange">
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>
                                {{ LossReductionCase::where('status', 'completed')->count() }}
                            </h3>
                            <span class="text-muted">Resolved Cases</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card p-3">
            <div class="row d-flex align-items-center justify-content-between d-inline m-2">
                <div>
                    <button wire:click='viewAllCases' class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> View Cases
                    </button>
                </div>
                <div wire:loading class="spinner-border text-danger mr-4" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div>
                    {{-- <div class="form-group" style="flex: 1; margin-right: 10px;">
                            <label>Record Per Page</label>
                            <select class="form-control" wire:model="recordPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div> --}}
                    <button class="btn btn-success" wire:click="filter"><i class="fa fa-filter"></i> Apply
                        Filters</button>
                    <button class="btn btn-danger" wire:click="resetFilters"><i class="fa fa-window-close"></i>
                        Reset Filters</button>
                </div>
            </div>

            <hr>
            <div style="display: flex; align-items: center; justify-content: space-between;">

                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label>Filter by Source of Destination</label>
                    <select class="form-control" wire:model="filterBysourceOfDetection">
                        <option value="">Select Source of Detection</option>
                        <option value="Field Request">Field Request</option>
                        <option value="Analytics">Analytics</option>
                        <option value="Complaints">Complaints</option>
                        <option value="4700 Hotline">4700 Hotline</option>
                    </select>
                </div>

                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label>Filter by Reported Activity</label>
                    <select class="form-control" wire:model="filterReportedActivity">
                        <option value="">Select Reported Activity</option>
                        <option value="Residential">Residential</option>
                        <option value="Office">Office</option>
                        <option value="Factory">Factory</option>
                    </select>
                </div>
                <!-- Your existing code -->

                <div class="form-group" style="flex: 1;">
                    <label>Filter by Reported Date Range</label>
                    <div class="input-daterange input-group">
                        <input type="date" class="form-control" wire:model="startDate" />
                        <span class="input-group-addon">to</span>
                        <input type="date" class="form-control " wire:model="endDate" />
                    </div>
                </div>

                <!-- Your existing code -->

            </div>
        </div>


        <div class="row">
            @if ($cases && $cases->count() != 0)
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-header bg-primary d-flex justify-content-between align-items-center pr-3">

                            <h4 class="text-white">Cases</h4>
                            <a href="" class="text-white">See All</a>

                        </div>
                        <div class="m-3">
                            <input type="text" placeholder="Search Case" wire:model='searchCase'
                                class="form-control">
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border user-list" id="message-list">
                                @forelse ($cases ?? [] as $case)
                                    @if ($case->customer_account_verified === 'yes')
                                        <li class="media">
                                            <img alt="image" src="{{ asset('storage/images/verified.jpg') }}"
                                                class="mr-3 user-img-radious-style user-list-img" style="width: 55px">
                                            <div class="media-body">
                                                <div class="d-flex justify-content-between align-items-center pr-3"
                                                    wire:click="verifiedCustomer({{ $case->id }})">
                                                    <div class="mt-0 font-weight-bold">{{ $case->fullname }}</div>
                                                    <div
                                                        class="badge badge-{{ $case->status === 'pending' ? 'warning' : 'success' }}">
                                                        {{ $case->status }}
                                                    </div>
                                                </div>
                                                <div class="text-small">{{ $case->geo_community }},
                                                    {{ $case->geo_zone }}
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                @empty
                                    <p>No Record Matches Selected Filters</p>
                                @endforelse

                            </ul>
                        </div>
                    </div>


                </div>
            @endif

            <div class="col-lg-{{ $cases && $cases->count() != 0 ? 8 : 12 }}">
                <div class="card">
                    <div class="card-header bg-dark">
                        @if ($showVerifiedEditForm === true && $verifiedCustomer)
                            <h4 class="text-white">{{ $verifiedCustomer->fullname }}</h4>
                        @endif
                    </div>
                    <div class="card-body">

                        {{-- Verified Edit Form --}}
                        @if ($showVerifiedEditForm == true && $verifiedCustomer)
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
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                        <div
                                            style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                            <div
                                                style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
                                        <div
                                            style="width: 33.33%; background-color: #fff; height: 100%; border-radius: 4px; position: relative;">
                                            <div
                                                style="width: 20px; height: 20px; background-color: #fff; border-radius: 50%; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="flex: 1; background-color: #007bff; height: 8px; border-radius: 4px;">
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card author-box card-primary">
                                        <div class="card-body">
                                            <div class="author-box-left">
                                                <img alt="image" src="{{ asset('storage/images/verified.jpg') }}"
                                                    class="rounded-circle author-box-picture">
                                                <div class="clearfix"></div>

                                            </div>
                                            <div class="author-box-details">
                                                <div class="author-box-name">
                                                    <a href="#">{{ $verifiedCustomer->fullname }}</a>
                                                </div>
                                                <div class="author-box-job">Customer Verified</div>
                                                <div class="author-box-description">

                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr class="bg-primary">
                                                            <th class="text-white">Case</th>
                                                            <th class="text-white">Information</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Source of Detection</td>
                                                            <td>{{ $verifiedCustomer->source_of_detection }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Customer SPN</td>
                                                            <td>{{ $verifiedCustomer->customer_spn }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Meter Number</td>
                                                            <td>{{ $verifiedCustomer->meter_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Geo Community</td>
                                                            <td>{{ $verifiedCustomer->geo_community }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Geo Zone</td>
                                                            <td>{{ $verifiedCustomer->geo_zone }}
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-heading">

                                            <div id="customermap" style="width: 100%; height: 250px;">
                                            </div>

                                        </div>
                                    </div>
                                    <form wire:submit.prevent="addLossReductionComment">
                                        <input type="hidden" wire:model="case_id">
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="userComment" style="min-height: 100px;"></textarea>
                                        </div>
                                        @error('userComment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1 btn-block"
                                                type="submit">Send</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                    </div>
                    @endif

                    {{-- Verified Edit Form --}}
                </div>

            </div>
        </div>


    </div>


    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1"
                                class="selectgroup-input-radio select-layout" checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2"
                                class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1"
                                class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2"
                                class="selectgroup-input select-sidebar" checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div wire:init="fetchLocation"></div>
</div>


<?php

namespace App\Http\Livewire\Admin;

use App\Models\LossReductionCase;
use App\Models\LossReductionEngagementUserComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerEngagement extends Component
{
    // Livewire component properties with model binding
    public $searchCase; // Default value is 'yes'

    public $sourceOfDetection;
    public $customerSPN;
    public $meterNumber;
    public $fullname;
    public $geoCommunity;
    public $geoZone;
    public $stateProvince;
    public $postalCode;
    public $reportedActivity;
    public $nearestLandmark;
    public $street;
    public $city;
    public $stateProvinceLocation;
    public $postalCodeLocation;
    public $descriptionOfSuspectedActivity;
    public $reportedBy;
    public $contactNumber;
    public $file;
    public $recommendation;

    public $showAddForm = true;
    public $showVerifiedEditForm = false;

    public $verifiedCustomer;

    public $userComment;

    public $filterBysourceOfDetection;
    public $filterByVerification;
    public $filterReportedActivity;
    public $filterByDate;
    public $endDate;
    public $startDate;



    public $searchIgnore = false;

    protected $cases; // Use a protected property


    public $location;
    public function fetchLocation()
    {
        $this->dispatchBrowserEvent('customerLocation', ['location' => $this->location]);
    }

    public function boot()
    {
        $this->fetchLocation();
    }

    public function verifiedCustomer(LossReductionCase $id)
    {
        $this->verifiedCustomer = $id;

        $this->sourceOfDetection = $this->verifiedCustomer->source_of_detection;
        $this->customerSPN = $this->verifiedCustomer->customer_spn;
        $this->meterNumber = $this->verifiedCustomer->meter_number;
        $this->fullname = $this->verifiedCustomer->fullname;
        $this->geoCommunity = $this->verifiedCustomer->geo_community;
        $this->geoZone = $this->verifiedCustomer->geo_zone;
        $this->stateProvince = $this->verifiedCustomer->state_province;
        $this->postalCode = $this->verifiedCustomer->postal_code;
        $this->showAddForm = false;
        $this->showVerifiedEditForm = true;

        $this->location = $this->verifiedCustomer;

        $this->fetchLocation();
    }

    public function addLossReductionComment()
    {
        $this->fetchLocation();
        $this->validate([
            'userComment' => 'required',
        ]);

        // Insert the comment into the table
        LossReductionEngagementUserComment::create([
            'case_id' => $this->verifiedCustomer->id,
            'user_id' => Auth::id(),
            'comment' => $this->userComment,
        ]);

        // Update the case status to "scheduled"
        $this->verifiedCustomer->update([
            'status' => 'scheduled',
        ]);

        // Clear the input field
        $this->userComment = '';
        $this->fetchLocation();
        $this->dispatchBrowserEvent('success', ['message' => 'Comment Added Successfully']);

        // Optionally, you can emit an event or update the page as needed.
    }

    public function viewAllCases()
    {
        // Use the `paginate` method to retrieve paginated data
        $this->cases = LossReductionCase::where('engagement', 1)->get();

        $this->fetchLocation();
    }

    public function resetFilters()
    {
        $this->filterBysourceOfDetection = null;
        $this->searchCase = null;
        $this->filterReportedActivity = null;
        $this->filterByDate = null;
        $this->endDate = null;
        $this->startDate = null;
    }

    public function filter()
    {
        $this->searchIgnore = true;
        $query = LossReductionCase::select('*');

        if ($this->searchCase) {
            $query->where('case_type', $this->searchCase);
        }

        if ($this->filterReportedActivity) {
            $query->where('reported_activity', $this->filterReportedActivity);
        }

        if ($this->filterBysourceOfDetection) {
            $query->where('source_of_detection', $this->filterBysourceOfDetection);
        }


        $query->where('engagement', 1);


        // Use a date range filter if both start and end dates are provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('updated_at', [$this->startDate, $this->endDate]);
        } elseif ($this->startDate) {
            // If only one date is provided, use the single date filter
            $query->whereDate('updated_at', $this->startDate);
        }

        // Check if any filters are applied
        $hasFilters = $this->filterByVerification || $this->filterReportedActivity || $this->filterBysourceOfDetection || $this->startDate || $this->endDate;
        $this->searchIgnore = false;

        if ($hasFilters) {
            // Paginate the result
            $this->cases = $query->latest()->paginate(8);

            // Check if there are any records
            if ($this->cases->count() === 0) {
                $this->dispatchBrowserEvent('info', ['message' => 'No Record Matches Selected Filters']);
            }
        } else {
            // No filters applied, you might want to handle this case accordingly
            // For example, you could show all records without pagination
            $this->dispatchBrowserEvent('info', ['message' => 'No Filter Selected']);
        }

        // Assign the result of the query to the cases property

    }

    // Fetching All Records and Adding Search and Filters
    // public function getCasesProperty()
    // {
    //     $query = LossReductionCase::select('*');

    //     if ($this->filterReportedActivity) {
    //         $query->where('reported_activity', $this->filterReportedActivity);
    //     }

    //     if ($this->filterBysourceOfDetection) {
    //         $query->where('source_of_detection', $this->filterBysourceOfDetection);
    //     }

    //     if ($this->filterByDate) {
    //         $query->whereDate('updated_at', $this->filterByDate);
    //     }

    //     $query->where('engagement', 1);
    //     $query->where('customer_account_verified', '=', 'yes');
    //     $query->where('status', '=', 'pending');

    //     return $query->latest()->paginate(8);
    // }


    public function showAddForm()
    {
        $this->showAddForm = true;
        $this->showVerifiedEditForm = false;
    }

    public function editUnVerifiedLossReduction()
    {
        // Validate the form fields
        $this->validate([
            'reportedActivity' => 'required|max:255',
            'nearestLandmark' => 'max:255',
            'street' => 'max:255',
            'city' => 'max:255',
            'stateProvinceLocation' => 'max:255',
            'postalCodeLocation' => 'max:255',
            'descriptionOfSuspectedActivity' => 'max:255',
            'reportedBy' => 'max:255',
            'contactNumber' => 'max:20',
            'file' => 'max:255',
            'recommendation' => 'max:255',
        ]);

        // Check if the verifiedCustomer exists and has an 'id'
        if ($this->unverifiedCustomer && $this->unverifiedCustomer->id) {
            // Find the LossReductionCase by 'id'
            $lossReduction = LossReductionCase::find($this->unverifiedCustomer->id);

            if ($lossReduction) {
                // Update the LossReductionCase fields
                $lossReduction->update([
                    'reported_activity' => $this->reportedActivity,
                    'nearest_landmark' => $this->nearestLandmark,
                    'street' => $this->street,
                    'city' => $this->city,
                    'state_province_location' => $this->stateProvinceLocation,
                    'postal_code_location' => $this->postalCodeLocation,
                    'description_of_suspected_activity' => $this->descriptionOfSuspectedActivity,
                    'reported_by' => $this->reportedBy,
                    'contact_number' => $this->contactNumber,
                    'recommendation' => $this->recommendation,
                ]);

                // Handle file upload if a new file is selected
                if ($this->file) {
                    $imagePath = $this->file->store('public/images');
                    $lossReduction->file = $imagePath;
                    $lossReduction->save();
                }
                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);
                // Reset the form fields
                $this->reset();

                // You can also display a success message here if needed.
            }
        }
    }

    public function editVerifiedLossReduction()
    {
        // Validate the form fields
        $this->validate([
            'sourceOfDetection' => 'required|max:255',
            'customerSPN' => 'max:255',
            'meterNumber' => 'max:255',
            'fullname' => 'max:255',
            'geoCommunity' => 'max:255',
            'geoZone' => 'max:255',
            'stateProvince' => 'max:255',
            'postalCode' => 'max:255',
        ]);

        // Check if the verifiedCustomer exists
        if ($this->verifiedCustomer) {
            // Find the LossReductionCase by 'id'
            $lossReduction = LossReductionCase::find($this->verifiedCustomer->id);

            if ($lossReduction) {
                // Update the LossReductionCase fields
                $lossReduction->update([
                    'source_of_detection' => $this->sourceOfDetection,
                    'customer_spn' => $this->customerSPN,
                    'meter_number' => $this->meterNumber,
                    'fullname' => $this->fullname,
                    'geo_community' => $this->geoCommunity,
                    'geo_zone' => $this->geoZone,
                    'state_province' => $this->stateProvince,
                    'postal_code' => $this->postalCode,
                ]);

                $this->dispatchBrowserEvent('success', ['message' => 'Case Edit Successfully.']);
                // Reset the form fields
                $this->reset();

                // You can also display a success message here if needed.
            }
        }
    }

    public function render()
    {
        $cases =   $this->cases;
        return view('livewire.admin.customer-engagement', ['cases' => $cases]);
    }
}

