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
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-center">
                                @if ($task->user->image)
                                    <img alt="image" src="{{ asset('storage/' . $task->user->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/avatar.png') }}"
                                        class="rounded-circle author-box-picture">
                                @endif
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a
                                        href="{{ route('user-profile', ['user_id' => $task->user->employee_id]) }}">{{ $task->user->firstname . ' ' . $task->user->lastname }}</a>
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
                                        Technician Name
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->user->firstname . ' ' . $task->user->lastname }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Date Assigned
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->created_at }}
                                    </span>
                                </p>
                                {{-- <p class="clearfix">
                                    <span class="float-left">
                                        Date Due
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->created_at }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Assigned By
                                    </span>
                                    <span class="float-right text-muted">
                                        no Available
                                    </span>
                                </p> --}}
                                <p class="clearfix">
                                    <span class="float-left">
                                        Priority
                                    </span>
                                    <span
                                        class="float-right text-white badge badge-{{ $task->priority == 'Low' ? 'success' : '' }}{{ $task->priority == 'High' ? 'danger' : '' }}{{ $task->priority == 'Average' ? 'primary' : '' }}">
                                        {{ $task->priority }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Status
                                    </span>
                                    <span
                                        class="float-right text-white badge badge-{{ $task->status == 'Completed' ? 'success' : '' }}{{ $task->status == 'Pending' ? 'danger' : '' }}{{ $task->status == 'Approved' ? 'warning' : '' }}">
                                        {{ $task->status }}
                                    </span>
                                </p>

                            </div>
                            <div class="row">
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-warning mr-3 col"><i class="far fa-edit"></i> Reassign</a>
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-primary  col"><i class="fas fa-plus-circle"></i> Add Meters
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><a class="btn btn-primary" href="{{ route('meter-reading-list') }}">Itinerary</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tbody>
                                        <tr>
                                            <th>Meter No.</th>
                                            <th>Customer</th>
                                            <th>Access Description</th>
                                            <th>Street</th>
                                            <th>District</th>
                                            <th>Zone</th>
                                            <th>Community</th>

                                        </tr>
                                        @forelse ($task->meters as $meter)
                                            <tr>
                                                <td>
                                                    <a style="text-decoration: none"
                                                        href="{{ route('meter-detail', ['meter_id' => $meter->id]) }}">{{ $meter->meter->meter_serial_number }}</a>
                                                </td>
                                                <td>
                                                    <a style="text-decoration: none"
                                                        href="{{ route('customer-profile', ['customer_id' => $meter->meter->customer->cnumber]) }}">{{ $meter->meter->customer->customer_name }}</a>
                                                </td>
                                                <td>{{ $meter->meter->customer->building_description ? $meter->meter->customer->building_description : 'No Description' }}
                                                </td>
                                                <td>{{ $meter->meter->customer->street }}</td>
                                                <td>{{ $meter->meter->customer->geo_district }}</td>
                                                <td>{{ $meter->meter->customer->geo_zone }}</td>
                                                <td>{{ $meter->meter->customer->geo_community }}</td>
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


</div>
