<div>
    <div class="card">
        <div class="card-body">
            @livewire('loss-reduction.customer-engagement-navigation')

            <div class="mt-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon l-bg-purple">
                                <i class="fas fa-list"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="padding-20">
                                    <div class="text-right">
                                        <h3 class="font-light mb-0">
                                            <i class="ti-arrow-up text-success"></i> 0
                                        </h3>
                                        <span class="text-muted">Total Cases</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon l-bg-green">
                                <i class="fas fa-list"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="padding-20">
                                    <div class="text-right">
                                        <h3 class="font-light mb-0">
                                            <i class="ti-arrow-up text-success"></i> 0
                                        </h3>
                                        <span class="text-muted">Cases For Engagement</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row d-flex align-items-center justify-content-between d-inline m-1 ">
                    <div class="row d-flex align-items-center justify-content-between d-inline ml-1">
                        <select style="width: 300px" class="form-control mb-2" wire:model.defer="recordPerPage">
                            <option value="">Record Per Page</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <button wire:click='viewAllCases' class="btn btn-primary ml-2 mb-1">
                            <i class="fa fa-plus-circle"></i> View Cases
                        </button>

                    </div>
                    <div>
                        <button class="btn btn-warning" wire:click="filter"><i class="fa fa-filter"></i> Apply
                        </button>
                        <button class="btn btn-danger" wire:click="resetFilters"><i class="fa fa-window-close"></i>
                            Reset</button>
                    </div>
                </div>


                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="form-group" style="flex: 1; margin-right: 10px;">
                        <label class="text-white">Filter by Verification</label>
                        <select class="form-control" wire:model.defer="filterByVerification">
                            <option value="">Select Filter</option>
                            <option value="yes">Verified</option>
                            <option value="no">Unverified</option>

                        </select>
                    </div>

                    <div class="form-group" style="flex: 1; margin-right: 10px;">
                        <label class="text-white">Filter by Source of Destination</label>
                        <select class="form-control" wire:model.defer="filterBysourceOfDetection">
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
                        <label class="text-white">Filter by Reported Activity</label>
                        <select class="form-control" wire:model.defer="filterReportedActivity">
                            <option value="">Select Reported Activity</option>
                            <option value="Residential">Residential</option>
                            <option value="Office">Office</option>
                            <option value="Factory">Factory</option>
                        </select>
                    </div>
                    <!-- Your existing code -->

                    <div class="form-group" style="flex: 1;">
                        <label class="text-white">Filter by Reported Date Range</label>
                        <div class="input-daterange input-group">
                            <input type="date" class="form-control" wire:model.defer="startDate" />
                            <span class="input-group-addon">to</span>
                            <input type="date" class="form-control " wire:model.defer="endDate" />
                        </div>
                    </div>

                    <!-- Your existing code -->

                </div>


                <hr>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <div class="row d-flex align-items-center justify-content-between d-inline m-1 ">
                                    <h4 class="text-white">CASES</h4>
                                    <!-- Bootstrap Spinner -->
                                    <span wire:loading class="spinner-border text-white" role="status"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>ALL CASES</h4>
                                            </div>
                                            <div class="card-body" id="top-5-scroll" tabindex="2"
                                                style="height: 500px; overflow: hidden; outline: none;">
                                                <ul class="list-unstyled list-unstyled-border">
                                                    @forelse ($fetchAllCases ?? [] as $case)
                                                        <li class="media bg-primary rounded p-2">
                                                            <div class="media-body">
                                                                <div class="float-right">
                                                                    <div class="font-weight-600 text-small text-white"
                                                                        style="color: white">Date:
                                                                        {{ $case->created_at . '  ' }}</div>
                                                                </div>
                                                                <div class="float-right">
                                                                    <div
                                                                        class="font-weight-600  text-small p-3 text-white ">
                                                                        CASE ID: {{ $case->case_id }}</div>
                                                                </div>
                                                                <div class="media-title text-white">
                                                                    {{ $case->customer ? $case->customer->customer_name : $case->suspect_name }}
                                                                </div>
                                                                <div class="mt-1">
                                                                    <div class="budget-price">
                                                                        <div class="text-white pr-2">Contact: </div>
                                                                        <div class="text-white">
                                                                            {{ $case->contact_number }}</div>
                                                                    </div>
                                                                    <div class="budget-price">
                                                                        <div class="text-white pr-2">Location: </div>
                                                                        <div class="text-white">
                                                                            {{ $case->customer_account_verified ? $case->geo_zone . ', ' . $case->geo_community : $case->address }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="float-right">
                                                                    <div class="font-weight-600 text-small text-white"
                                                                        style="color: white"><button wire:click="searchCase({{$case->id}})"
                                                                            class="btn btn-success btn-sm">Engage</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        No Cases
                                                    @endforelse


                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">

                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Case Information</h4>
                                            </div>
                                            <div class="card-body">


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Fullname</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="fullname">
                                                            @error('fullname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Suspect Name</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="suspectName">
                                                            @error('suspectName')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Geo Community</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="geoCommunity">
                                                            @error('geoCommunity')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Geo Zone</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="geoZone">
                                                            @error('geoZone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6">


                                                        <div class="form-group">
                                                            <label>Loss Reduction Case Type</label>
                                                            <select class="form-control"
                                                                wire:model.defer="lossReductionCaseType">
                                                                <option value="">Select Loss Reduction Case Type
                                                                </option>
                                                                @foreach ($caseType as $type)
                                                                    <option value="{{ $type->case_id }}">
                                                                        {{ $type->type }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('lossReductionCaseType')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Contact Number</label>
                                                            <input type="number" class="form-control"
                                                                wire:model.defer="contactNumber">
                                                            @error('contactNumber')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="address">
                                                        </div>
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="city">
                                                        </div>
                                                    </div>
                                                </div>


                                                <hr>

                                                <form wire:submit.prevent="addLossReductionComment" wire:ignore>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Contact Established?</label>
                                                                <select class="form-control contact_registered"
                                                                   >
                                                                    <option value="">Select</option>

                                                                    <option value="Yes">Yes
                                                                    </option>
                                                                    <option value="No">No
                                                                    </option>
                                                                </select>
                                                                @error('lossReductionCaseType')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Anomaly Reported?</label>
                                                                <select class="form-control anomaly_reported">
                                                                    <option value="">Select</option>

                                                                    <option value="Yes">Yes
                                                                    </option>
                                                                    <option value="No">No
                                                                    </option>
                                                                </select>
                                                                @error('lossReductionCaseType')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group anomaly_report">
                                                                <label>Anomaly Type</label>
                                                                <input type="text"
                                                                    class="form-control reportedfocus"
                                                                    wire:model.defer="anomaly_reported_type">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Other Energy Source?</label>
                                                                <select class="form-control otherenergy"
                                                                    id="otherenergy"
                                                                    >
                                                                    <option value="">Select</option>

                                                                    <option value="Yes">Yes
                                                                    </option>
                                                                    <option value="No">No
                                                                    </option>
                                                                </select>
                                                                @error('energy_source_question')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label>Was Anomaly Registered?</label>
                                                                <select class="form-control anomaly_registered"
                                                                    >
                                                                    <option value="">Select</option>

                                                                    <option value="Yes">Yes
                                                                    </option>
                                                                    <option value="No">No
                                                                    </option>
                                                                </select>
                                                                @error('lossReductionCaseType')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group registered_type">
                                                                <label>Registered Type</label>
                                                                <input type="text"
                                                                    class="form-control registeredfocus"
                                                                    wire:model.defer="anomaly_registered_type">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2">
                                                        <div>
                                                            <div class="form-group source">
                                                                <label>State Source</label>
                                                                <input type="text" id="source"
                                                                    class="form-control sourcefocus"
                                                                    wire:model.defer="energy_source">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2">
                                                        <div>
                                                            <div class="form-group source">
                                                                <label>Comment</label>
                                                                <textarea type="text"
                                                                    class="form-control"
                                                                    wire:model.defer="comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <button class="btn btn-primary mr-1 btn-block"
                                                                type="submit"><i class="fa fa-save"></i>
                                                                Save</button>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <button wire:click.prevent="resetForm"
                                                                class="btn btn-danger mr-1 btn-block"><i
                                                                    class="fa fa-window-close"></i> Cancel</button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
