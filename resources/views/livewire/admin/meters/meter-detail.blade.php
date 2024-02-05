<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Customers</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Customer Profile</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Meter's Information</h4>
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
                                                            <td>{{ $meter->customer->organization }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Customer type</th>
                                                            <td>{{ $meter->customer->customer_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Customer Balance</th>
                                                            <td>{{ $meter->customer->customer_balance }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Geo County</th>
                                                            <td>{{ $meter->customer->geo_county }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Geo Community</th>
                                                            <td>{{ $meter->customer->geo_community }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Geo Zone</th>
                                                            <td>{{ $meter->customer->geo_zone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Street</th>
                                                            <td>{{ $meter->customer->street }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Building Description</th>
                                                            <td>{{ $meter->customer->building_description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Service Type</th>
                                                            <td>{{ $meter->customer->service_type }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th>Route</th>
                                                            <td>{{ $meter->customer->route }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Itinerary</th>
                                                            <td>{{ $meter->customer->itinerary }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <th>Tariff Category</th>
                                                            <td>{{ $meter->customer->tariff_category }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th>Route</th>
                                                            <td>{{ $meter->customer->route }}</td>
                                                        </tr> --}}
                                                        <tr>
                                                            <th>Tariff Description</th>
                                                            <td>{{ $meter->customer->tariff_description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Premise Type</th>
                                                            <td>{{ $meter->customer->premise_type }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contract Status</th>
                                                            <td>{{ $meter->customer->contract_status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contract Number</th>
                                                            <td>{{ $meter->customer->cnumber }}</td>
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

                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card profile-widget card-primary">
                        <div class="profile-widget-header">

                            @if ($meter->customer->image)
                                <img alt="image" src="{{ asset('storage/' . $meter->customer->image) }}"
                                    class="rounded-circle profile-widget-picture">
                            @else
                                @if ($meter->customer->gender == 'Male')
                                    <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @endif
                            @endif

                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Meters</div>
                                    <div class="profile-widget-item-value"> {{ $meter->customer->meters->count() }}
                                    </div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Service Orders</div>
                                    <div class="profile-widget-item-value">
                                        {{ $meter->customer->serviceOrders->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description pb-0">
                            <div class="profile-widget-name">
                                <a
                                    href="{{ route('customer-profile', ['customer_id' => $meter->customer->cnumber]) }}">
                                    {{ $meter->customer->customer_name }}
                                </a>
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> Customer
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Customer's Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Gender
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->gender }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->geo_community }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Longitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->gis_y_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Latitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->gis_x_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->customer_phone_one }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $meter->customer->email }}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Customer Location</h4>
                        </div>
                        <div wire:init='fetchLocation'></div>
                        <div class="card-body">

                            <div wire:ignore id="customermap" style="width: 100%; height: 200px;"></div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</div>
