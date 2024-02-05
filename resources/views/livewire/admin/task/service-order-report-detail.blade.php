<div>

    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark" style="display:flex; justify-content: space-between; align-items:center">
            <div class="col-lg-6">
                <h6 style="color: white">Status: {{ strtoUpper($report->status) }}</h6>
            </div>
            <div class="col-lg-6">
                @if ($report->status == 'pending' || $report->status == 'declined')
                    <button class="btn btn-sm btn-success mx-2" wire:click="approvereport"><i class="fa fa-edit"></i> Mark
                        Approved</button>
                @endif
                @if ($report->status != 'declined')
                    <button class="btn btn-sm btn-danger mx-2" wire:click="declinereport"><i class="fa fa-edit"></i>Mark
                        Decline</button>
                @endif
            </div>
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
                                        role="tab" aria-selected="true">Customer Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings"
                                        role="tab" aria-selected="false">Meter Information</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="tab-pane fade show active" id="about" role="tabpanel"
                                    aria-labelledby="home-tab2">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-md">
                                            <tbody>
                                                <tr>
                                                    <th>Organization</th>
                                                    <td>{{ $report->task->serviceOrder->customer->organization }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer type</th>
                                                    <td>{{ $report->task->serviceOrder->customer->customer_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Customer Balance</th>
                                                    <td>{{ $report->task->serviceOrder->customer->customer_balance }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <td>{{ $report->task->serviceOrder->customer->document_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <td>{{ $report->task->serviceOrder->customer->account_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo County</th>
                                                    <td>{{ $report->task->serviceOrder->customer->geo_county }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Community</th>
                                                    <td>{{ $report->task->serviceOrder->customer->geo_community }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Zone</th>
                                                    <td>{{ $report->task->serviceOrder->customer->geo_zone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Street</th>
                                                    <td>{{ $report->task->serviceOrder->customer->street }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Building Description</th>
                                                    <td>{{ $report->task->serviceOrder->customer->building_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Service Type</th>
                                                    <td>{{ $report->task->serviceOrder->customer->service_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $report->task->serviceOrder->customer->route }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Itinerary</th>
                                                    <td>{{ $report->task->serviceOrder->customer->metersitinerary }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Category</th>
                                                    <td>{{ $report->task->serviceOrder->customer->tariff_category }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $report->task->serviceOrder->customer->metersroute }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Description</th>
                                                    <td>{{ $report->task->serviceOrder->customer->tariff_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Premise Type</th>
                                                    <td>{{ $report->task->serviceOrder->customer->premise_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Status</th>
                                                    <td>{{ $report->task->serviceOrder->customer->contract_status }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Number</th>
                                                    <td>{{ $report->task->serviceOrder->customer->cnumber }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel"
                                    aria-labelledby="profile-tab2">
                                    <div class="card-header">
                                        <h4>Meter Information</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($report)
                                            <ul>
                                                <li>Meter Owner: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->meter_owner }}</strong>
                                                </li>
                                                <li>Meter Model: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->meter_model }}</strong>
                                                </li>
                                                <li>Meter Amperage: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->amperage }}</strong>
                                                </li>
                                                <li>Meter Serial Number: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->meter_serial_number }}</strong>
                                                </li>
                                                <li>Meter seal Tag: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->meter_seal_tag }}</strong>
                                                </li>
                                                <li>Meter Make: <strong
                                                        class="mx-3">{{ $report->task->serviceOrder->customer->meter_make }}</strong>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary mb-3"
                                                onclick="fetchLongLat({{ $report->task->serviceOrder->customer->location->latitude }},{{ $report->task->serviceOrder->customer->location->longitude }}, 6.322549800000001, -10.8075428)">Fetch
                                                Location on Map</button>


                                            <div wire:ignore id="map" style="width: 100%; height: 400px;"></div>
                                            <p id="distance"></p>
                                            <p id="duration"></p>
                                        @else
                                            <h3>No Meter Assigned to this Crew</h3>
                                        @endif


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

                                @if ($report->task->serviceOrder->customer->image)
                                    <img alt="image" src="{{ asset('storage/' . $customer->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    @if ($report->task->serviceOrder->customer->gender == 'Male')
                                        <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                            class="rounded-circle author-box-picture">
                                    @elseif($report->task->serviceOrder->customer->gender == 'Female')
                                        <img alt="image" src="{{ asset('storage/images/female_avatar.png') }}"
                                            class="rounded-circle author-box-picture">
                                    @else
                                        <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                            class="rounded-circle author-box-picture">
                                    @endif
                                @endif

                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a
                                        href="{{ route('customer-profile', ['customer_id' => $report->task->serviceOrder->customer->cnumber]) }}">{{ $report->task->serviceOrder->customer->customer_name }}</a>
                                </div>
                                <div class="author-box-job">Customer</div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Service Order Report Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Reading
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->meter_readings }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Date Assigned
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->task->created_at }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Energy
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->energy }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Priority
                                    </span>
                                    <span
                                        class="float-right text-white badge badge-{{ $report->priority == 'Low' ? 'success' : '' }}{{ $report->priority == 'High' ? 'danger' : '' }}{{ $report->priority == 'Average' ? 'primary' : '' }}">
                                        {{ $report->task->priority }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        meter Seal Number
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->seal_number }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Status
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->status }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Meter Installed
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $report->meter_id }}
                                    </span>
                                </p>
                            </div>

                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            @if ($report->task->crew_id != null)
                                <h4>{{ $report->task->crewAssignedTo->name }}
                                @else
                                    <h4>{{ $report->task->assignedTo->firstname . ' ' . $report->task->assignedTo->lastname }}
                            @endif
                            </h4>

                        </div>
                        <div class="card-body">
                            <div class="row">

                                @if ($report->task->assignedTo)
                                    <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                        <article class="article">
                                            <div class="article-header">

                                                @if ($report->task->assignedTo->image)
                                                    <div class="article-image"
                                                        data-background="{{ asset('storage/' . $report->task->assignedTo->image) }}"
                                                        style="background-image: url(&quot;{{ asset('storage/' . $report->task->assignedTo->image) }}&quot;);">
                                                    </div>
                                                @else
                                                    @if ($report->task->assignedTo->gender == 'Male')
                                                        <div class="article-image"
                                                            data-background="{{ asset('storage/images/male_avatar.png') }}"
                                                            style="background-image: url(&quot;{{ asset('storage/images/male_avatar.png') }}&quot;);">
                                                        </div>
                                                    @else
                                                        <div class="article-image"
                                                            data-background="{{ asset('storage/images/female_avatar.png') }}"
                                                            style="background-image: url(&quot;{{ asset('storage/images/female_avatar.png') }}&quot;);">
                                                        </div>
                                                    @endif
                                                @endif

                                                <div class="article-image" data-background="assets/img/blog/img08.png"
                                                    style="background-image: url(&quot;assets/img/blog/img08.png&quot;);">
                                                </div>
                                                <div class="article-title">
                                                    <h2><a
                                                            href="{{ route('user-profile', ['user_id' => $report->task->assignedTo->employee_id]) }}">{{ $report->task->assignedTo->firstname . ' ' . $report->task->assignedTo->lastname }}</a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            Location
                            </h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="customermap" style="width: 100%; height: 250px;">
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div wire:init="fetchLocation"></div>
</div>
</section>
</div>
