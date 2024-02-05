<div>
    <div class="card">
        <div class="card-body">
            @livewire('loss-reduction.customer-engagement-navigation')

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

             
            <div style="display: flex; align-items: center; justify-content: space-between;">
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
                                    <h4 class="text-white">CASES FOR ENGAGEMENT</h4>
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
                                        <th>Suspect Name</th>
                                        <th>Address</th>
                                        <th>Reported By</th>
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
                                                <td>{{$case->suspect_name?$case->suspect_name: 'N/A'}}</td>
                                                <td>{{$case->address}}</td>
                                                <td>{{$case->reported_by}}</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>{{ $case->case_type ? $case->case_type: 'N/A' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm"  wire:click.prevent="viewCustomer({{$case->id}})"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn {{$case->assessment==1?'disabled':''}} btn-{{$case->assessment==1?'secondary':'primary'}} btn-sm"  wire:click.prevent="sendComment({{$case->id}})"><i class="fa fa-comment"></i></a>
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


    <div class="modal fade" id="viewCustomer" wire:ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document" wire:ignore>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Customer Information</h5>
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>

                            @if ($customer)
                            <tr class="bg-primary">
                                <th class="text-white">Case</th>
                                <th class="text-white">Information</th>
                            </tr>
                            <tr>
                                <td>Source of Detection</td>
                                <td>{{ $customer?->source_of_detection }}</td>
                            </tr>
                            <tr>
                                <td>Customer SPN</td>
                                <td>{{ $customer?->customer_spn }}</td>
                            </tr>
                            <tr>
                                <td>Meter Number</td>
                                <td>{{ $customer?->meter_number }}</td>
                            </tr>
                            <tr>
                                <td>Geo Community</td>
                                <td>{{ $customer?->geo_community }}</td>
                            </tr>
                            <tr>
                                <td>Geo Zone</td>
                                <td>{{ $customer?->geo_zone }}
                                </td>
                            </tr>

                          @endif

                          @if ($customer && $customer->customer_account_verified === 'no')
                                 <tr class="bg-primary">
                                <th class="text-white">Case</th>
                                <th class="text-white">Information</th>
                            </tr>
                            <tr>
                                <td>Suspect Name</td>
                                <td>{{ $customer?->suspect_name }}</td>
                            </tr>
                            <tr>
                                <td>Customer SPN</td>
                                <td>{{ $customer?->customer_spn }}</td>
                            </tr>
                            <tr>
                                <td>Meter Number</td>
                                <td>{{ $customer?->meter_number }}</td>
                            </tr>
                            <tr>
                                <td>Geo Community</td>
                                <td>{{ $customer?->geo_community }}</td>
                            </tr>
                            <tr>
                                <td>Geo Zone</td>
                                <td>{{ $customer?->geo_zone }}
                                </td>
                            </tr>
                            @endif
                           


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div> 

      <div class="modal fade" id="addCommentModal" wire:ignore tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md" role="document" wire:ignore>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Write Comment</h5>
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
                <form>
                    <div class="form-group">
                        <textarea wire:model="comment" class="form-control"></textarea>
                      </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-success" wire:click="addLossReductionComment">Send</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div> 

</div>

