<?php
use Carbon\Carbon;

?>
<div>
    <div class="card card-primary p-3">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header bg-success">
                        <h4 class="text-white">Itinerary / {{ $itineraryName?->itinerary_no }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="profile-widget-header">
                            <div class="profile-widget-items row justify-content-between">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Meters</div> 
                                    <div class="profile-widget-item-value">
                                        {{ $itineraryName?->meters->count() }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Circle</div>
                                    <div class="profile-widget-item-value">
                                        {{ $itineraryName?->circle }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Creation Date</div>
                                    <div class="profile-widget-item-value">
                                        {{ $itineraryName?->created_at }}</div>
                                </div>

                            </div>
                        </div> {{-- <div id="piechart_3d" style="width: 100%"></div> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Pie Chart/ Prepaid & PostPaid</h4>
                    </div>
                    <div class="card-body">
                        <div wire:init="loadChart" id="piechart_3d" style="width: 100%; height: 100px"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="text-white">Chart/Total Number of Energy</h4>
                    </div>
                    <div class="card-body">
                        {{-- <div id="piechart_3d" style="width: 100%"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3">
        <div class="row justify-content: space-between;
        align-items: center">
            <div class="col-lg-3">
                
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Assignment</button>
                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" wire:click.prevent="reassignItinerary" href="#">Reassign</a>
                        @if ($itineraryName->user)
                            <a class="dropdown-item" wire:click.prevent="unassign" href="#">Unassign</a>
                        @endif

                    </div>
                </div>
            </div>
            <button class="btn btn-primary" wire:click="searchMeter"><i class="fa fa-plus-circle"></i> Add
                Meter</button>
            <div wire:loading class="spinner-border text-danger mr-4" role="status">
                <span class="sr-only">Loading...</span>
            </div>
          <div class="col-lg-3">
            <a class="btn btn-primary text-white" href="{{route('meter-reading-tasks')}}"><i class="fas fa-arrow-left"></i>
                Go Back</a>
          </div>
        </div>
       
    </div>




    <div class="row">

        <div id="history" class="col-lg-3 ">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>comment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($itineraryMeter->histories === null || $itineraryMeter->histories->isEmpty())
                                    <td>No Logs</td>
                                @else
                                    @forelse ($itineraryMeter->histories as $history)
                                        <tr>
                                            <td>{{ $history->action }} </td>
                                            <td><a
                                                    href="{{ route('user-profile', ['user_id' => $history->user->employee_id]) }}">{{ $history->user->firstname . ' ' . $history->user->lastname }}</a>
                                            </td>
                                            <td><a tabindex="0" class="btn btn-danger" role="button"
                                                    data-toggle="popover" data-trigger="focus" title=""
                                                    data-content="{{ $history->comment }}"
                                                    data-original-title="Itinerary: {{ $history->itinerary->itinerary_no }}"><i
                                                        class="fa fa-comment"></i></a>
                                            </td>
                                            <td>{{ $history->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="itinerary" class="col-lg-9">
            @if ($itineraryMeter)
                <div class="table-responsive card">
                    <table class="table table-striped table-bordered table-md">
                        <tbody>
                            <tr class="bg-primary">
                                <th class="text-white"><i class="fa fa-list" id="toggleIcon"
                                        style="cursor: pointer;"></i></th>
                                <th class="text-white">Technician</th>
                                <th class="text-white">Meter #</th>
                                <th class="text-white">Service Type</th>
                                <th class="text-white">Phase</th>
                                <th class="text-white">KWH/Variance</th>
                                <th class="text-white">KVar/Variance</th>
                                <th class="text-white">Variance</th>
                                <th class="text-white">Days</th>
                                <th class="text-white">Period</th>
                                <th class="text-white">Anomaly Type</th>
                                <th class="text-white">Comment</th>
                                <th class="text-white">Status</th>
                                <th class="text-white">Action Taken</th>
                                <th class="text-white">Edit</th>

                            </tr>
                            @forelse ($itineraryMeter->meters as $meter)
                                <tr>
                                    <td></td>
                                    <td>{{ $itineraryMeter->user?->firstname . ' ' . $itineraryMeter->user?->lastname }}
                                    </td>
                                    <td>{{ $meter->meter->meter_serial_number }}</td>
                                    <td>{{ $meter->meter->service_type }}</td>
                                    <td>{{ $meter->meter->phase }}</td>
                                    <td>
                                        {{-- <span class="badge badge-success">
                                            A:
                                            {{ $meter->meter->readings?->where('energy_reading', 'active energy')->count() }}</span>
                                        <span class="badge badge-danger">
                                            R:
                                            {{ $meter->meter->readings?->where('energy_reading', 'reactive energy')->count() }}</span> --}}
                                        @php

                                            // Assuming $meter is an instance of your Meter model
                                            $readings = $meter->meter->readings()
                                                ->latest('created_at')
                                                ->limit(2)
                                                ->pluck('active_readings');

                                            if ($readings->count() >= 2) {
                                                $latestReading = $readings[0];
                                                $previousReading = $readings[1];

                                                $variance = $latestReading - $previousReading;

                                                echo '
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">' .
                                                    $variance .
                                                    '</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">KWH</button>
                                                </div>
                                                
                                                
                                                ';
                                                
                                            } elseif ($readings->count() >= 1) {
                                                echo 'Only one reading available. Cannot calculate variance.';
                                            } else {
                                                echo 'No readings available.';
                                            }

                                        @endphp
                                    </td>
                                    <td>
                                        {{-- <span class="badge badge-success">
                                            A:
                                            {{ $meter->meter->readings?->where('energy_reading', 'active energy')->count() }}</span>
                                        <span class="badge badge-danger">
                                            R:
                                            {{ $meter->meter->readings?->where('energy_reading', 'reactive energy')->count() }}</span> --}}
                                        @php

                                            // Assuming $meter is an instance of your Meter model
                                            $readings = $meter->meter->readings()
                                                ->latest('created_at')
                                                ->limit(2)
                                                ->pluck('reactive_readings');

                                            if ($readings->count() >= 2) {
                                                $latestReading = $readings[0];
                                                $previousReading = $readings[1];

                                                $variance = $latestReading - $previousReading;

                                                echo '
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">' .
                                                    $variance .
                                                    '</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">Kvar</button>
                                                </div>
                                                
                                                
                                                ';
                                                
                                            } elseif ($readings->count() >= 1) {
                                                echo 'Only one reading available. Cannot calculate variance.';
                                            } else {
                                                echo 'No readings available.';
                                            }

                                        @endphp
                                    </td>
                                    <td>


                                        @php

                                                $readings = $meter->meter->readings()
                                                ->latest('created_at')
                                                ->limit(2)
                                                ->pluck('active_readings');

                                            if ($readings->count() >= 2) {
                                                $latestReading = $readings[0];
                                                $previousReading = $readings[1];

                                                $variance = $latestReading - $previousReading;

                                                echo '
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">' .
                                                    $variance .
                                                    '</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">KWH</button>
                                                </div>
                                                
                                                
                                                ';
                                                
                                            } elseif ($readings->count() >= 1) {
                                                echo 'Only one reading available. Cannot calculate variance.';
                                            } else {
                                                echo '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">N/A</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">KWh</button>
                                                </div>';
                                            }


                                             $re_readings = $meter->meter->readings()
                                                ->latest('created_at')
                                                ->limit(2)
                                                ->pluck('reactive_readings');

                                            if ($re_readings->count() >= 2) {
                                                $re_latestReading = $re_readings[0];
                                                $re_previousReading = $re_readings[1];

                                                $re_variance = $re_latestReading - $re_previousReading;

                                                echo '
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">' .
                                                    $re_variance .
                                                    '</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">Kvar</button>
                                                </div>
                                                
                                                
                                                ';
                                                
                                            } elseif ($readings->count() >= 1) {
                                                echo 'Only one reading available. Cannot calculate variance.';
                                            } else {
                                                echo '
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" style="background-color: #b0b8b2;"
                                                        class="btn btn-primary">N/A</button>
                                                    <button type="button"
                                                        class="btn btn-primary bg-white text-dark">Kvar</button>
                                                </div>
                                                
                                                
                                                ';
                                            }

                                        @endphp

                                    </td>
                                    <td>
                                        @php

                                            $readings = $meter->meter
                                                ->readings()
                                                ->latest('created_at')
                                                ->limit(2)
                                                ->get();

                                            if ($readings->count() >= 2) {
                                                $latestReading = Carbon::parse($readings->first()->created_at);
                                                $secondLatestReading = Carbon::parse($readings->last()->created_at);

                                                $difference = $secondLatestReading->diffInDays($latestReading) . ' Days';

                                                echo $difference;
                                            } elseif ($readings->count() >= 1) {
                                                $latestReading = Carbon::parse($readings->first()->created_at);

                                                $difference = $latestReading->diffInDays($latestReading) . ' Days';

                                                echo $difference;
                                            } else {
                                                echo 'No Reading';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $itineraryMeter->reading_circle }}</td>

                                    <td>N/A</td>
                                    <td>
                                        @if ($meter->meter->comments->count() != 0)
                                            <button class="btn btn-sm btn-warning badge badge-primary"
                                                wire:click="viewMeterComment({{ $meter->meter->id }})">{{ $meter->meter->comments->count() }}
                                                <i class="fa fa-eye"></i></button>
                                        @endif
                                        <button class="btn btn-sm btn-primary"
                                            wire:click="addMeterComment({{ $meter->meter->id }})"><i
                                                class="fa fa-plus-circle"></i></button>
                                    </td>
                                    <td>{{ $itineraryMeter->status }}</td>
                                    <td>
                                        @if ($itineraryMeter->readings)
                                            <button class="btn btn-sm btn-success"><i
                                                    class="fa fa-check"></i></button>
                                            <button wire:click="addMeterDeclineComment({{ $meter->meter->id }})"
                                                class="btn btn-sm btn-danger"><i
                                                    class="fa fa-window-close"></i></button>
                                        @endif

                                    </td>
                                    <td><button wire:click="reassignMeter({{ $meter->id }})"
                                            class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="meterComment" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">All Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($meterComments)
                        <div class="">
                            <div class="card-body">
                                @forelse ($meterComments as $comment)
                                    <div class="support-ticket media pb-1 mb-3">
                                        <img src="{{ asset('storage/images/avatar.png') }}" class="user-img mr-2"
                                            alt="">
                                        <div class="media-body ml-3">
                                            <p class="my-1">{{ $comment->comment }}</p>
                                            <small class="text-muted">Created by <span
                                                    class="font-weight-bold font-13">{{ $comment->user->firstname . ' ' . $comment->user->lastname }}</span>
                                                &nbsp;&nbsp; - {{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <hr>
                                @empty
                                @endforelse


                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" wire:ignore id="addMeterComment" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">Add Comment<div wire:loading
                            class="spinner-border text-danger mr-4" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitMeterComment">
                        <div class="form-group">
                            <textarea class="form-control" wire:model="userMeterComment" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Submit Comment</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" wire:ignore id="addMeterDeclineComment" tabindex="-1"
        role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">Add Comment<div wire:loading
                            class="spinner-border text-danger mr-4" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitMeterDeclineComment">
                        <div class="form-group">
                            <textarea class="form-control" wire:model="userMeterDeclineComment" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Submit Comment</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" wire:ignore id="reassignMeter" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" wire:ignore>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">Reassign Account<div wire:loading
                            class="spinner-border text-danger mr-4" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Select Itinerary</label>
                    <form wire:submit.prevent="reassign">
                        <div class="form-group">
                            <select wire:model="selectedItinerary" class="form-control">
                                <option value="">Select Itinerary</option>
                                @foreach ($itineraries as $itinerary)
                                    <option value="{{ $itinerary->id }}">{{ $itinerary->itinerary_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Reassign</button>
                        </div>

                    </form>
                    <button wire:click="remove" class="btn btn-danger">Remove</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" wire:ignore id="reassignItinerary" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" wire:ignore>
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="mySmallModalLabel">Reassign to User<div wire:loading
                            class="spinner-border text-danger mr-4" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Select User</label>
                    <form wire:submit.prevent="submitReassignItinerary">
                        <div class="form-group">
                            <select wire:model="user" class="form-control">
                                <option value="">Select USER</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->employee_id }}">
                                        {{ $user->firstname . ' ' . $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Reassign</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unassignItinerary" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unassign Itinerary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Remove
                    <span
                        style="font-weight: bold">{{ $itineraryName->user?->firstname . ' ' . $itineraryName->user?->lastname }}</span>
                    from this Itinerary?
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" wire:click="removeUser">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore id="searchMeter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search Meter</h5>
                    <div wire:loading class="spinner-border text-danger mr-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input wire:model="meter" type="text" class="form-control">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" wire:click="searchMeterToAdd">Search</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="meterSearchResults" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search Meter Result</h5>
                    <div wire:loading class="spinner-border text-danger mr-4" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>SPN</th>
                                    <th>Serial Number</th>
                                    <th>Meter Type</th>
                                    <th>Meter Make</th>
                                    <th>Meter Model</th>
                                    <th>Phase</th>
                                    <th>Organization</th>
                                </tr>
                                @if ($meterSearchResults)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('meter-detail', ['meter_id' => $meterSearchResults->id]) }}">
                                                {{ $meterSearchResults->customer ? $meterSearchResults->customer->cnumber : 'N/A' }}
                                            </a>

                                        </td>
                                        <td>{{ $meterSearchResults->meter_serial_number }}</td>
                                        <td>{{ $meterSearchResults->meter_type }}</td>
                                        <td>{{ $meterSearchResults->meter_make }}</td>
                                        <td>{{ $meterSearchResults->meter_model }}</td>
                                        <td>{{ $meterSearchResults->phase }}</td>
                                        <td>{{ $meterSearchResults->organization }}</td>
                                    </tr>
                                @endif



                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" wire:click="addMeter">Add Meter</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
