<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Customers</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Customers List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalCustomers }}
                            </h3>
                            <span class="text-muted">Total Customers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-orange">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $totalCustomers }}
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

                    {{-- <div class="card">
                        <div class="card-header">
                            <h4>Customers</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" wire:model="customerNameSearch" placeholder="Search Customer"
                                    class="form-control">
                            </div>
                            <ul class="list-unstyled list-unstyled-border user-list" id="message-list">
                                @forelse ($customers as $customer)
                                    <li class="media"
                                        onclick="showCustomerLocation({{ $customer->location->latitude }}, {{ $customer->location->longitude }})"
                                        onmouseover="highlightCustomer(this)" onmouseout="unhighlightCustomer(this)">
                                        @if ($customer->gender == 'Male')
                                            <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                                class="mr-3 user-img-radious-style user-list-img">
                                        @elseif($customer->gender == 'Female')
                                            <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}"
                                                class="mr-3 user-img-radious-style user-list-img">
                                        @else
                                            <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                                class="mr-3 user-img-radious-style user-list-img">
                                        @endif

                                        <div class="media-body">
                                            <div class="d-flex justify-content-between align-items-center pr-3">
                                                <div class="mt-0 font-weight-bold">{{ $customer->customer_name }}</div>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('customer-profile', ['customer_id' => $customer->cnumber]) }}"><span><i
                                                            class="fa fa-eye" style="font-size: 16px"></i></span>
                                                    Profile</a>
                                            </div>

                                            <div class="text-small">{{ $customer->geo_community }}</div>
                                        </div>
                                    </li>
                                @empty
                                @endforelse


                            </ul>
                        </div>
                        {{-- {{ $customers->links() }} --}}
                    {{-- </div>  --}}

                    <div class="card-body">
                        <span class="d-inline-block" data-toggle="popover" data-content="Disabled popover"
                            data-original-title="" title="" aria-describedby="popover616877">
                            <button class="btn btn-primary pe-none" type="button" disabled="">Disabled
                                button</button>
                        </span>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="card px-0">
                        <div class="card-header bg-dark">
                            <div style="display: flex; align-items: center; justify-content: space-between;">



                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label class="text-white">Geo Community</label>
                                    <select style="width: 150px" class="form-control" wire:model="filterByGeoCommunity">
                                        <option value="">Select Geo Community</option>
                                        @foreach ($distinctGeoCommunity as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label class="text-white">Service Type</label>
                                    <select style="width: 150px" class="form-control" wire:model="filterByServiceType">
                                        <option value="">Select Sevice Type</option>
                                        @foreach ($distinctServiceType as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label style="width: 150px" class="text-white">Meter Type</label>
                                    <select class="form-control" wire:model="filterByMeterType">
                                        <option value="">Select Meter Type</option>
                                        @foreach ($distinctMeterType as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label class="text-white">Customer Type</label>
                                    <select style="width: 150px" class="form-control" wire:model="filterByCustomerType">
                                        <option value="">Select Customer Type</option>
                                        @foreach ($distinctCustomerType as $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label class="text-white">Tarrif Classification</label>
                                    <select style="width: 150px" class="form-control"
                                        wire:model="filterByTariffClassification">
                                        <option value="">Select Tarrif Classification</option>
                                        @foreach ($distinctTariffClassification as $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="flex: 1; margin-right: 10px;">
                                    <label class="text-white">Phase</label>
                                    <select class="form-control" style="width: 150px" wire:model="filterByPhase">
                                        <option value="">Select Phase</option>
                                        @foreach ($distinctPhase as $value)
                                            <option>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mr-3"><button class="btn btn-primary" wire:click="loadAllCustomers"> <i
                                            class="fa fa-filter"></i> Filter</button>
                                </div>
                                <div><button class="btn btn-danger" wire:click="clearFilters"><i
                                            class="fa fa-window-close"></i> Clear Filters</button>
                                </div>
                                <!-- Your existing code -->
                                <h4 class="ml-4 text-white" wire:target='loadAllCustomers' wire:loading>Filtering...
                                </h4>
                                <h4 class="ml-4 text-white" wire:target='clearFilters' wire:loading>Clearing
                                    Filters...
                                </h4>
                            </div>
                            {{-- <button onclick="loadAllCustomersMap()" class="btn btn-primary">Refresh</button> --}}
                        </div>
                        <div class="card-body px-0" wire:ignore>
                            <div id="map" style="width: 100%; height: 750px;"></div>
                        </div>
                        {{-- <div class="card-body px-0" wire:ignore>
                            <div id="customerMap" style="width: 100%; height: 750px;"></div>
                        </div> --}}

                    </div>

                </div>
            </div>
            <div>

            </div>
        </div>
    </section>
    <input type="file" id="excelFileInput" accept=".xlsx, .xls" />
    <button id="importButton" onclick="clickMe">Import Excel</button>
</div>
