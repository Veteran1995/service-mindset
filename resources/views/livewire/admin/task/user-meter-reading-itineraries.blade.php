<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item "><a href="#" class="text-white">Meter Reading</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">User Assigned Itineraries</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-center">
                                @if ($user->image)
                                    <img alt="image" src="{{ asset('storage/' . $user->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/avatar.png') }}"
                                        class="rounded-circle author-box-picture">
                                @endif
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a
                                        href="{{ route('user-profile', ['user_id' => $user->employee_id]) }}">{{ $user->firstname . ' ' . $user->lastname }}</a>
                                </div>
                                <div class="author-box-job">Technician</div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Task Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Skill Level:
                                    </span>
                                    <span class="float-right text-muted">

                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Total Acc. Read
                                    </span>
                                    <span class="float-right text-white badge badge-primary">
                                        {{ $tasks->where('status', 'completed')->count() }}
                                    </span>
                                </p>

                                <p class="clearfix">
                                    <span class="float-left">
                                        Total Acc. UnRead
                                    </span>
                                    <span class="float-right text-white badge badge-warning">
                                        {{ $tasks->where('status', '!=', 'completed')->count() }}
                                    </span>
                                </p>

                                <p class="clearfix">
                                    <span class="float-left">
                                        Average Reading Time:
                                    </span>
                                    <span class="float-right text-white badge badge-primary">

                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        # of Rejected Readings:
                                    </span>
                                    <span class="float-right text-white badge badge-warning">
                                        {{ $tasks->where('status', 'rejected')->count() }}
                                    </span>
                                </p>

                            </div>
                            {{-- <div class="row">
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-warning mr-3 col"><i class="far fa-edit"></i> Reassign</a>
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-primary  col"><i class="fas fa-plus-circle"></i> Add Meters
                                </a>
                            </div> --}}

                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><button class="btn btn-primary" wire:click="viewMeters">Itinerary</button></h4>
                            <div wire:loading class="spinner-border text-danger mr-4" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tbody>
                                        <tr>
                                            <th>Itinerary</th>
                                            <th>#s of Meters</th>
                                            <th>Reading Circle</th>
                                            <th>Reading Date</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Completion Date</th>

                                        </tr>
                                        @forelse ($tasks as $task)
                                            <tr wire:click="openUserItineraries({{ $task->id }})"
                                                style="cursor: pointer">
                                                <td>{{ $task->itinerary_no }}
                                                </td>
                                                <td>{{ $task->meters->count() }}</td>
                                                <td>{{ $task->reading_circle }}</td>
                                                <td>{{ $task->created_at }}</td>
                                                <td>
                                                    <div
                                                        class="badge badge-{{ $task->status == 'Completed' ? 'success' : '' }}{{ $task->status == 'Pending' ? 'danger' : '' }}{{ $task->status == 'Approved' ? 'warning' : '' }}{{ $task->status == 'Processed' ? 'primary' : '' }}">
                                                        {{ $task->status }}</div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="badge badge-{{ $task->priority == 'Low' ? 'success' : '' }}{{ $task->priority == 'High' ? 'danger' : '' }}{{ $task->priority == 'Average' ? 'primary' : '' }}">
                                                        {{ $task->priority }}</div>
                                                </td>
                                                <td>
                                                    {{ $task->completion_date }}
                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade bd-example-modal-lg" id="openUserItinerary" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Meters

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @if ($meters)
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>Meter #</th>
                                        <th>Service Type</th>
                                        <th>Phase</th>
                                        <th>Status</th>
                                        <th>Energy Readings</th>
                                        <th>Organization</th>
                                        <th>Geo Community</th>
                                        <th>Geo Zone</th>
                                        <th>Street</th>

                                    </tr>
                                    @forelse ($meters as $meter)
                                        <tr>
                                            <td>{{ $meter->meter->meter_serial_number }}</td>
                                            <td>{{ $meter->meter->service_type }}</td>
                                            <td>{{ $meter->meter->phase }}</td>
                                            <td>{{ $meter->meter->meter_status }}</td>
                                            <td>{{ $meter->meter->energy_type }}</td>
                                            <td>{{ $meter->meter->organization }}</td>
                                            <td>{{ $meter->meter->geo_community }}</td>
                                            <td>{{ $meter->meter->geo_zone }}</td>
                                            <td>{{ $meter->meter->street }}</td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="openItinerary" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Meters

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @if ($itineraries)
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>Meter #</th>
                                        <th>Service Type</th>
                                        <th>Phase</th>
                                        <th>Energy Readings</th>
                                        <th>Status</th>

                                    </tr>
                                    @forelse ($itineraries as $itinerary)
                                        @forelse ($itinerary->meters as $item)
                                            <tr>
                                                <td>{{ $item->meter->meter_serial_number }}</td>
                                                <td>{{ $item->meter->service_type }}</td>
                                                <td>{{ $item->meter->phase }}</td>
                                                <td>{{ $item->meter->energy_type }}</td>
                                                <td>{{ $item->meter->status }}</td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
