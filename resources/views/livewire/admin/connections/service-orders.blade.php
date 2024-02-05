<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Service Order Management</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Service Orders</li>
        </ol>
    </nav>
    <div class="row ">
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-green">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Total Orders</h4>
                        <h4>{{ $totalServiceOrders }}</h4>
                        <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                        <p class="mb-0 text-sm">
                            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cyan">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Completed Order</h4>
                        <h4>{{ $totalCompletedOrders }}</h4>
                        <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                        <p class="mb-0 text-sm">
                            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-purple">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-globe"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Assigned Orders</h4>
                        <h4>{{ $totalAssignedOrders }}</h4>
                        <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                        <p class="mb-0 text-sm">
                            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-orange">
                <div class="card-statistic-3">
                    <div class="card-icon card-icon-large"><i class="fa fa-money-bill-alt"></i></div>
                    <div class="card-content">
                        <h4 class="card-title">Unassigned Order</h4>
                        <h4>{{ $totalUnassignedOrders }}</h4>
                        <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                        <p class="mb-0 text-sm">
                            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Orders</h4>

                            <div class="card-header-form">
                                <div class="row">
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    wire:model="searchSerialNumber" placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary"><i
                                                            class="fas fa-search"></i></button>
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
                                    <button type="button"
                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                        style="position: absolute; transform: translate3d(119px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" wire:click.prevent="deleteSelectedRow"
                                            href="#">Delete</a>
                                        {{-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a> --}}
                                    </div>
                                </div>
                                <span>Selected {{ count($selectedRows) }}
                                    {{ Str::plural('Service Order', count($selectedRows)) }}</span>
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="m-4 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input wire:model="selectedPageRows" class="form-check-input"
                                                        type="checkbox" value="" id="defaultCheck1" />
                                                </div>

                                            </th>
                                            <th>SPN</th>
                                            <th>Name</th>
                                            <th>Geo Community</th>
                                            <th>Geo Zone</th>
                                            <th>Tariff</th>
                                            <th>Tariff Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($servicesOrders as $order)
                                            <tr style="cursor: pointer">

                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input wire:model="selectedRows" class="form-check-input"
                                                            type="checkbox" value="{{ $order->id }}"
                                                            id="defaultCheck1" />
                                                    </div>

                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('customer-profile', ['customer_id' => $order->cnumber]) }}">
                                                        {{ $order->cnumber }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->customer_name }}</td>
                                                <td>{{ $order->geo_community }}</td>
                                                <td>{{ $order->geo_zone }}</td>
                                                <td>{{ $order->tariff }}</td>
                                                <td>{{ $order->tariff_category }}</td>
                                                <td>
                                                    <div class="badge badge-success">{{ $order->contract_status }}
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('single-service-order', ['service_order_id' => $order->id]) }}"
                                                        class="btn btn-primary">Detail</a></td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $servicesOrders->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
