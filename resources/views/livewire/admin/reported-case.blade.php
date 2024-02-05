<div>
    <div class="card">
            @livewire('loss-reduction.case-navigation-component')

        <div class="card-body">

            <div class="row d-flex align-items-center justify-content-between d-inline m-1 ">
                <div class="row d-flex align-items-center justify-content-between d-inline ml-1">
                    <select style="width: 300px" class="form-control mb-2" wire:model="recordPerPage">
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

             
            <div style="display: flex; align-items: center; justify-content: space-between;" class="bg-primary p-1">
                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label class="text-white">Filter by Verification</label>
                    <select class="form-control" wire:model="filterByVerification">
                        <option value="">Select Filter</option>
                        <option value="yes">Verified</option>
                        <option value="no">Unverified</option>

                    </select>
                </div>

                <div class="form-group" style="flex: 1; margin-right: 10px;">
                    <label class="text-white">Filter by Source of Destination</label>
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
                    <label class="text-white">Filter by Reported Activity</label>
                    <select class="form-control" wire:model="filterReportedActivity">
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
                        <input type="date" class="form-control" wire:model="startDate" />
                        <span class="input-group-addon">to</span>
                        <input type="date" class="form-control " wire:model="endDate" />
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
                                    <h4 class="text-white">Reported Cases</h4>
                                        <!-- Bootstrap Spinner -->
                                    <span wire:loading class="spinner-border text-white" role="status"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" @if ($searchIgnore === true) wire:ignore @endif>
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>Case ID</th>
                                        <th>Customer</th>
                                        <th>Meter</th>
                                        <th>Phase</th>
                                        <th>Service Type</th>
                                        <th>Customer Type</th>
                                        <th>Activity</th>
                                        <th>Tariff Desc</th>
                                        <th>Geo Zone</th>
                                        <th>Geo Comm.</th>
                                        <th>Prior Vend Date</th>
                                        <th>Lastest Vend Date</th>
                                        <th>Avg Comp</th>
                                        <th>Comp %</th>
                                        <th>Impact</th>
                                        <th>Case Type</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($fetchAllCases ?? [] as $case)
                                            <tr>
                                                <td>{{$case->case_id}}</td>
                                                <td>
                                                    @if ($case->customer && $case->customer->cnumber)
                                                        <a
                                                        href="{{ route('customer-profile', ['customer_id' => $case->customer->cnumber? $case->customer->cnumber: $case->customer_spn]) }}
                                                        ">{{ $case->fullname ? $case->fullname : 'Not Verified' }}</a>
                                                    @else
                                                    {{ $case->fullname ? $case->fullname : 'Not Verified' }}
                                                    @endif
                                                
                                                </td>
                                                <td>
                                                    @if ($case->meter_number)
                                                        <a
                                                    href="{{ route('meter-detail', ['meter_id' =>  $case->meter_number ? $case->meter_number: 'N/A' ]) }}
                                                    "> {{ $case->meter_number ? $case->meter_number: 'N/A' }}</a>
                                                    @else
                                                    {{ $case->meter_number ? $case->meter_number: 'N/A' }}
                                                    @endif
                                                    
                                                </td>
                                                <td>{{ $case->meter ? $case->meter->phase : 'N/A' }}</td>
                                                <td>{{ $case->customer ? $case->customer->service_type : 'N/A' }}
                                                </td>
                                                <td>{{ $case->customer ? $case->customer->customer_type : 'N/A' }}
                                                </td>
                                                <td>{{ $case->reported_activity ? $case->reported_activity : 'N/A' }}</td>

                                                <td>{{ $case->customer ? $case->customer->tariff_category : 'N/A' }}</td>
                                                <td>{{ $case->customer ? $case->customer->geo_zone : 'N/A' }}</td>
                                                <td>{{ $case->customer ? $case->customer->geo_community : 'N/A' }}
                                                </td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>{{ $case->case_type ? $case->case_type: 'N/A' }}</td>
                                                <td>
                                                    <a href="#" class="btn {{$case->registration_status==1?'disabled':''}} btn-{{$case->registration_status==1?'secondary':'success'}} btn-sm"  wire:click.prevent="registerModal({{$case->id}})"><i class="fa fa-check"></i></a>
                                                </td>
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
    <div class="modal fade" id="registerModal" wire:ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document" wire:ignore>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation Dialog </h5>
              <div class="container mt-5 text-center" wire:loading
              wire:target="registerCase">
              <!-- Bootstrap Spinner -->
              <div class="spinner-border text-dark" role="status">

              </div>
          </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to perform this action?
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-success" wire:click="registerCase">Yes</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>    
    
</div>