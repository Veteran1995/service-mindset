<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Customers</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Customer Profile</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-danger">
                <div class="card-icon l-bg-purple">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $customer->meters->count() }}
                            </h3>
                            <span class="text-muted">Meters</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-primary">
                <div class="card-icon l-bg-green">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $customer->serviceOrders->count() }}
                            </h3>
                            <span class="text-muted">Service Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-success">
                <div class="card-icon l-bg-cyan">
                    <i class="far fa-check-square"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>
                                {{ $customer->serviceOrders->where('contract_status', 'Completed')->count() }}
                            </h3>
                            <span class="text-muted">Service Order Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-warning">
                <div class="card-icon l-bg-orange">
                    <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>
                                {{ $customer->serviceOrders->where('contract_status', 'Pending')->count() }}

                            </h3>
                            <span class="text-muted">Service Order Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card profile-widget card-primary">
                        <div class="profile-widget-header">

                            @if ($customer->image)
                                <img alt="image" src="{{ asset('storage/' . $customer->image) }}"
                                    class="rounded-circle profile-widget-picture">
                            @else
                                @if ($customer->gender == 'Male')
                                    <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @elseif($customer->gender == 'Female')
                                    <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @endif
                            @endif

                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Meters</div>
                                    <div class="profile-widget-item-value"> {{ $customer->meters->count() }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Service Orders</div>
                                    <div class="profile-widget-item-value">{{ $customer->serviceOrders->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description pb-0">
                            <div class="profile-widget-name">{{ $customer->customer_name }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> Customer
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Gender
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->gender }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->geo_community }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Longitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->gis_y_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Latitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->gis_x_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->customer_phone_one }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $customer->email }}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Meters ( {{ $customer->meters->count() }})</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Serial Number</th>
                                            <th>Phase</th>
                                            <th>Meter Make</th>
                                            <th>Model</th>
                                        </tr>
                                        @if ($customer->meters === null || $customer->meters->isEmpty())
                                            <tr>
                                                <td>No Meters Found</td>
                                            </tr>
                                        @else
                                            @foreach ($customer->meters as $meter)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('meter-detail', ['meter_id' => $meter->id]) }}">
                                                            {{ $meter->meter_serial_number }}
                                                        </a></td>
                                                    <td>{{ $meter->phase }}</td>
                                                    <td>{{ $meter->meter_make }}</td>
                                                    <td>{{ $meter->meter_model }}</td>
                                                </tr>
                                            @endforeach
                                        @endif



                                    </tbody>
                                </table>
                                {{-- <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $meters->links() }}
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Customer's Information</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='updateCustomer'>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">

                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-md">
                                                    <tbody>
                                                        <tr>
                                                            <th>Organization</th>
                                                            <td>{{ $customer->organization }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Customer type</th>
                                                            <td>{{ $customer->customer_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Customer Balance</th>
                                                            <td>{{ $customer->customer_balance }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Document Number</th>
                                                            <td>{{ $customer->document_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Account Number</th>
                                                            <td>{{ $customer->account_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Geo County</th>
                                                            <td>{{ $customer->geo_county }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Geo Community</th>
                                                            <td>{{ $customer->geo_community }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Geo Zone</th>
                                                            <td>{{ $customer->geo_zone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Street</th>
                                                            <td>{{ $customer->street }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Building Description</th>
                                                            <td>{{ $customer->building_description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Service Type</th>
                                                            <td>{{ $customer->service_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Route</th>
                                                            <td>{{ $customer->route }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Itinerary</th>
                                                            <td>{{ $customer->itinerary }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tariff Category</th>
                                                            <td>{{ $customer->tariff_category }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Route</th>
                                                            <td>{{ $customer->route }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tariff Description</th>
                                                            <td>{{ $customer->tariff_description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Premise Type</th>
                                                            <td>{{ $customer->premise_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contract Status</th>
                                                            <td>{{ $customer->contract_status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contract Number</th>
                                                            <td>{{ $customer->cnumber }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Service Orders ( {{ $serviceOrders->count() }})</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Service Type</th>
                                            <th>Service Order Status</th>
                                        </tr>
                                        @forelse ($customer->serviceOrders as $servicesOrder)
                                            <tr wire:click="viewOrder({{ $servicesOrder->id }})"
                                                style="cursor: pointer">

                                                <td> {{ $servicesOrder->service_order_type }}</td>
                                                <td>{{ $servicesOrder->service_order_status }}
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $serviceOrders->links() }}
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
