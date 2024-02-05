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

    <div class="card">
        <div class="card-body">
            <div class="row d-flex align-items-center justify-content-between d-inline m-2">
                <div>
                    <a href="{{ route('add-lost-reduction') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Register Case
                    </a>
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
                        <option value="In the Field">In the Field</option>
                        <option value="NULL">N/A</option>
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


            <hr>
            <div class="row">
                {{-- <div class="col-lg-3">

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
                                        <li class="media" style="cursor: pointer"
                                            onmouseover="this.style.backgroundColor='grey';this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent';this.style.color='black';">
                                            <img alt="image" src="{{ asset('storage/images/verified.jpg') }}"
                                                class="mr-3 user-img-radious-style user-list-img">
                                            <div class="media-body" style="background-color: transparent;">
                                                <div class="d-flex justify-content-between align-items-center pr-3"
                                                    wire:click="verifiedCustomer({{ $case->id }})">
                                                    <div class="mt-0 font-weight-bold">{{ $case->fullname }}</div>
                                                    <div
                                                        class="badge badge-{{ $case->status === 'pending' ? 'warning' : 'success' }}">
                                                        {{ $case->status }}
                                                    </div>
                                                </div>
                                                <div class="text-small">
                                                    {{ $case->city || $case->street ? $case->city . ' ' . $case->street : 'N/A' }}
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($case->customer_account_verified === 'no')
                                        <li class="media" style="cursor: pointer"
                                            onmouseover="this.style.backgroundColor='grey';this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent';this.style.color='black';">
                                            <img alt="image" src="{{ asset('storage/images/unverified.jpg') }}"
                                                class="mr-3 user-img-radious-style user-list-img">
                                            <div class="media-body">
                                                <div class="d-flex justify-content-between align-items-center pr-3"
                                                    wire:click="unverifiedCustomer({{ $case->id }})">
                                                    <div class="mt-0 font-weight-bold">{{ $case->reported_activity }}
                                                    </div>
                                                    <div
                                                        class="badge badge-{{ $case->status === 'pending' ? 'warning' : 'success' }}">
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


                </div> --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="text-white">Loss Reduction Case</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" @if ($searchIgnore === true) wire:ignore @endif>
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>Name</th>
                                        <th>Case Type</th>
                                        <th>Location</th>
                                        <th>Source of Detection</th>
                                        <th>Activity Reported</th>
                                        <th>Status</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($fetchAllCases ?? [] as $case)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('los-reduction-case-detail', ['id' => $case->id]) }}
                                                        ">{{ $case->fullname ? $case->fullname : 'Not Verified' }}</a>
                                                </td>
                                                <td>{{ $case->case_type ? $case->case_type : 'N/A' }}</td>
                                                <td>{{ $case->geo_community ? $case->geo_community : 'N/A' }}</td>
                                                <td>{{ $case->source_of_detection ? $case->source_of_detection : 'N/A' }}
                                                </td>
                                                <td>{{ $case->reported_activity ? $case->reported_activity : 'N/A' }}
                                                </td>
                                                <td>{{ $case->status ? $case->status : 'N/A' }}</td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                {{-- {{ $fetchAllCases ? $fetchAllCases->links() : null }} --}}
                            </div>


                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
    {{-- <div wire:ignore>
        <div class="modal fade bd-example-modal-lg" id="showForm" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                        <div class="container mt-5 text-center" wire:loading
                                            wire:target="verifyCustomer">
                                            <!-- Bootstrap Spinner -->
                                            <div class="spinner-border text-dark" role="status">

                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block"
                                            wire:click="verifyCustomer">Verify</button>
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
                                    <input type="checkbox" class="custom-switch-input"
                                        wire:model="forwardForAssessment">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Forward For Assessment</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" class="custom-switch-input"
                                        wire:model="forwardForEngagement">
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
                                                <label for="crewOrUserToggle">Select Crew or
                                                    User</label>
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
                                </div>

                            @endif


                            <!-- Floating section indicator -->
                            <div class="container mt-5 text-center" wire:loading="addLossReduction"
                                wire:target="addLossReduction">
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
    </div> --}}


</div>
