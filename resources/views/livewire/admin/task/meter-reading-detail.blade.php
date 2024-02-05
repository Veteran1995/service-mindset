<div>

    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark" style="display:flex; justify-content: space-between; align-items:center">
            <div class="col-lg-6">
                <h6 style="color: white">Status: {{ strtoUpper($reading->status) }}</h6>
            </div>
            <div class="col-lg-6">
                @if ($reading->status == 'pending' || $reading->status == 'declined')
                    <button class="btn btn-sm btn-success mx-2" wire:click="approveReading"><i class="fa fa-edit"></i> Mark
                        Approved</button>
                @endif
                @if ($reading->status != 'declined')
                    <button class="btn btn-sm btn-danger mx-2" wire:click="declineReading"><i class="fa fa-edit"></i>Mark
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
                                                    <td>{{ $reading->meter->customer->organization }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer type</th>
                                                    <td>{{ $reading->meter->customer->customer_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Customer Balance</th>
                                                    <td>{{ $reading->meter->customer->customer_balance }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <td>{{ $reading->meter->customer->document_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <td>{{ $reading->meter->customer->account_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo County</th>
                                                    <td>{{ $reading->meter->customer->geo_county }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Community</th>
                                                    <td>{{ $reading->meter->customer->geo_community }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Zone</th>
                                                    <td>{{ $reading->meter->customer->geo_zone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Street</th>
                                                    <td>{{ $reading->meter->customer->street }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Building Description</th>
                                                    <td>{{ $reading->meter->customer->building_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Service Type</th>
                                                    <td>{{ $reading->meter->customer->service_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $reading->meter->customer->route }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Itinerary</th>
                                                    <td>{{ $reading->meter->itinerary }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Category</th>
                                                    <td>{{ $reading->meter->customer->tariff_category }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $reading->meter->route }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Description</th>
                                                    <td>{{ $reading->meter->customer->tariff_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Premise Type</th>
                                                    <td>{{ $reading->meter->customer->premise_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Status</th>
                                                    <td>{{ $reading->meter->customer->contract_status }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Number</th>
                                                    <td>{{ $reading->meter->customer->cnumber }}</td>
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
                                        @if ($reading->meter)
                                            <ul>
                                                <li>Meter Owner: <strong
                                                        class="mx-3">{{ $reading->meter->meter_owner }}</strong>
                                                </li>
                                                <li>Meter Model: <strong
                                                        class="mx-3">{{ $reading->meter->meter_model }}</strong>
                                                </li>
                                                <li>Meter Amperage: <strong
                                                        class="mx-3">{{ $reading->meter->amperage }}</strong>
                                                </li>
                                                <li>Meter Serial Number: <strong
                                                        class="mx-3">{{ $reading->meter->meter_serial_number }}</strong>
                                                </li>
                                                <li>Meter seal Tag: <strong
                                                        class="mx-3">{{ $reading->meter->meter_seal_tag }}</strong>
                                                </li>
                                                <li>Meter Make: <strong
                                                        class="mx-3">{{ $reading->meter->meter_make }}</strong>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary mb-3"
                                                onclick="fetchLongLat({{ $reading->meter->customer->location->latitude }},{{ $reading->meter->customer->location->longitude }}, 6.322549800000001, -10.8075428)">Fetch
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

                                @if ($reading->meter->customer->image)
                                    <img alt="image" src="{{ asset('storage/' . $customer->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    @if ($reading->meter->customer->gender == 'Male')
                                        <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                            class="rounded-circle author-box-picture">
                                    @elseif($reading->meter->customer->gender == 'Female')
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
                                        href="{{ route('customer-profile', ['customer_id' => $reading->meter->customer->cnumber]) }}">{{ $reading->meter->customer->customer_name }}</a>
                                </div>
                                <div class="author-box-job">Customer</div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Reading Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Reading
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $reading->readings }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Date Assigned
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $reading->assignment->created_at }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Reading Circle
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $reading->assignment->reading_circle }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Priority
                                    </span>
                                    <span
                                        class="float-right text-white badge badge-{{ $reading->priority == 'Low' ? 'success' : '' }}{{ $reading->priority == 'High' ? 'danger' : '' }}{{ $reading->priority == 'Average' ? 'primary' : '' }}">
                                        {{ $reading->assignment->priority }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Status
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $reading->status }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Energy Type
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $reading->assignment->energy_type }}
                                    </span>
                                </p>
                            </div>

                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $reading->assignment->user->firstname . ' ' . $reading->assignment->user->lastname }}
                            </h4>

                        </div>
                        <div class="card-body">
                            <div class="row">

                                @if ($reading->assignment->user)
                                    <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                        <article class="article">
                                            <div class="article-header">

                                                @if ($reading->assignment->user->image)
                                                    <div class="article-image"
                                                        data-background="{{ asset('storage/' . $reading->assignment->user->image) }}"
                                                        style="background-image: url(&quot;{{ asset('storage/' . $reading->assignment->user->image) }}&quot;);">
                                                    </div>
                                                @else
                                                    @if ($reading->assignment->user->gender == 'Male')
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
                                                            href="{{ route('user-profile', ['user_id' => $reading->assignment->user->employee_id]) }}">{{ $reading->assignment->user->firstname . ' ' . $reading->assignment->user->lastname }}</a>
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
    </section>
    <div wire:init="fetchLocation"></div>
</div>

{{-- <script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('executeJs', code => {
            eval(code); // Execute the JavaScript code received from the Livewire component
        });
    });

    document.addEventListener('livewire:update', function() {
        Livewire.hook('message.sent', (message, component) => {
            if (message.updateQueue.some(x => x.event === 'executeJs')) {
                eval(message.updateQueue.find(x => x.event === 'executeJs')
                    .data); // Execute JavaScript after Livewire update
            }
        });
    });
</script> --}}
