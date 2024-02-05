<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item "><a href="#" class="text-white">Connections</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">View Service Order</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="padding-20">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about"
                                        role="tab" aria-selected="true">Service Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings"
                                        role="tab" aria-selected="false">Logistics</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel"
                                    aria-labelledby="home-tab2">

                                    <form wire:submit.prevent='updateOrder'>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="card-body">

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-md">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Organization</th>
                                                                    <td>{{ $serviceOrder->customer->organization }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Customer type</th>
                                                                    <td>{{ $serviceOrder->customer->customer_type }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Customer Balance</th>
                                                                    <td>{{ $serviceOrder->customer->customer_balance }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Document Number</th>
                                                                    <td>{{ $serviceOrder->customer->document_number }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Account Number</th>
                                                                    <td>{{ $serviceOrder->customer->account_number }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Geo County</th>
                                                                    <td>{{ $serviceOrder->customer->geo_county }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Geo Community</th>
                                                                    <td>{{ $serviceOrder->customer->geo_community }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Geo Zone</th>
                                                                    <td>{{ $serviceOrder->customer->geo_zone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Street</th>
                                                                    <td>{{ $serviceOrder->customer->street }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Building Description</th>
                                                                    <td>{{ $serviceOrder->customer->building_description }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Service Type</th>
                                                                    <td>{{ $serviceOrder->customer->service_type }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Route</th>
                                                                    <td>{{ $serviceOrder->customer->route }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Itinerary</th>
                                                                    <td>{{ $serviceOrder->customer->itinerary }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tariff Category</th>
                                                                    <td>{{ $serviceOrder->customer->tariff_category }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Route</th>
                                                                    <td>{{ $serviceOrder->customer->route }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tariff Description</th>
                                                                    <td>{{ $serviceOrder->customer->tariff_description }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Premise Type</th>
                                                                    <td>{{ $serviceOrder->customer->premise_type }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Contract Status</th>
                                                                    <td>{{ $serviceOrder->customer->contract_status }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Contract Number</th>
                                                                    <td>{{ $serviceOrder->customer->cnumber }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel"
                                    aria-labelledby="profile-tab2">
                                    {{-- <div class="card-header">
                                        <h4>{{ $serviceOrder->meter ? 'Meter Information' : 'This Service Order Has No Meter Attached' }}
                                        </h4>
                                    </div> --}}
                                    <div class="card-body">
                                        {{-- <ul>
                                            @if ($serviceOrder->meter)
                                                <li>Meter Name: <strong
                                                        class="mx-3">{{ $serviceOrder->meter->name }}</strong>
                                                </li>
                                                <li>Meter Serial Number: <strong
                                                        class="mx-3">{{ $serviceOrder->meter->serial_number }}</strong>
                                                </li>
                                                <li>Meter seal Tag: <strong
                                                        class="mx-3">{{ $serviceOrder->meter->seal_tag }}</strong>
                                                </li>
                                                <li>Location: <strong
                                                        class="mx-3">{{ $serviceOrder->location }}</strong>
                                                </li>
                                                <li>Longitude:<strong
                                                        class="mx-3">{{ $serviceOrder->longitude }}</strong>
                                                </li>
                                                <li>Latitude: <strong
                                                        class="mx-3">{{ $serviceOrder->latitude }}</strong>
                                                </li>
                                            @endif

                                        </ul> --}}

                                        {{-- <button class="btn btn-primary mb-3"
                                            onclick="fetchLongLat({{ $serviceOrder->customer->gis_x_coordinates }},{{ $serviceOrder->customer->gis_y_coordinates }}, 6.322549800000001, -10.8075428)">Fetch
                                            Location on Map</button> --}}


                                        {{-- <div wire:ignore id="map" style="width: 100%; height: 400px;"></div> --}}
                                        <p id="distance"></p>
                                        <p id="duration"></p>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image"
                                    src="{{ $serviceOrder->customer->gender == 'Male' ? asset('admin/assets/img/male_avatar.png') : asset('admin/assets/img/female_avatar.png') }}"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a
                                        href="{{ route('customer-profile', ['customer_id' => $serviceOrder->customer->cnumber]) }}">{{ $serviceOrder->customer->customer_name }}</a>
                                </div>
                                <div class="author-box-job">Customer</div>
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
                                        {{ $serviceOrder->customer->gender }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $serviceOrder->customer->geo_community }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Longitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $serviceOrder->customer->gis_y_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Latitude
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $serviceOrder->customer->gis_x_coordinates }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $serviceOrder->customer->customer_phone_one }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $serviceOrder->customer->email }}
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>
