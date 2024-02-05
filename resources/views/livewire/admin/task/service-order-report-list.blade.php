<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Report</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Report List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                    <i class="fas fas fa-tasks"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>{{ $totalTasks }}
                            </h3>
                            <span class="text-muted">Total Sent Report</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-green">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i>{{ $approved }}
                            </h3>
                            <span class="text-muted">Approved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-cyan">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $pending }}
                            </h3>
                            <span class="text-muted">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon l-bg-red">
                    <i class="fas fa-window-close"></i>
                </div>
                <div class="card-wrap">
                    <div class="padding-20">
                        <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{ $declined }}
                            </h3>
                            <span class="text-muted">Declined</span>
                        </div>
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
                            <h4>List of Order Report </h4>

                            <div class="card-header-form">
                                <div class="row">
                                    <div class="mx-2">
                                        <i class="fas fa-th-large" style="color: #1a4ca2;" onclick="toggleGrid()"></i>
                                    </div>
                                    <div class="mx-2">
                                        <i class="fas fa-list" style="color: #1a4ca2;" onclick="toggleList()"></i>
                                    </div>
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    wire:model="readingNameSearch" placeholder="Search">
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
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
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
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="table-responsive show" id="list">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="m-4 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input wire:model="selectedPageRows" class="form-check-input"
                                                        type="checkbox" value="" id="defaultCheck1" />
                                                </div>

                                            </th>
                                            <th>Technician</th>
                                            <th>Readings</th>
                                            <th>Meter Installed SN</th>
                                            <th>Seal Number</th>
                                            <th>Energy</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Take Actions</th>
                                        </tr>
                                        @forelse ($reports as $report)
                                            <tr>

                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input wire:model="selectedRows" class="form-check-input"
                                                            type="checkbox" value="{{ $report->id }}"
                                                            id="defaultCheck1" />
                                                    </div>

                                                </td>
                                                <td class="align-middle">
                                                    <strong>
                                                        <a href="{{ route('service-order-task-report-detail', ['id' => $report->id]) }}"
                                                            class="text-decoration-none text-dark">
                                                            @if ($report->task->assignedTo != null)
                                                                {{ $report->task->assignedTo->firstname . ' ' . $report->task->assignedTo->lastname }}
                                                            @else
                                                                {{ $report->task->crewAssignedTo->name }}
                                                            @endif
                                                        </a>

                                                    </strong>

                                                </td>
                                                <td>{{ $report->meter_readings }}</td>
                                                <td>{{ $report->meter_id }}</td>
                                                <td>{{ $report->seal_number ? $report->seal_number : 'N/A' }}
                                                </td>
                                                <td>{{ $report->energy }}</td>
                                                <td>{{ $report->comment ? $report->comment : 'N/A' }}</td>
                                                <td>
                                                    @if ($report->status == 'declined')
                                                        <div class="badge badge-danger">
                                                            {{ strtolower($report->status) }}

                                                        </div>
                                                    @elseif($report->status == 'approved')
                                                        <div class="badge badge-success">
                                                            {{ strtolower($report->status) }}

                                                        </div>
                                                    @else
                                                        <div class="badge badge-warning">
                                                            {{ strtolower($report->status) }}

                                                        </div>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($report->status == 'pending' || $report->status == 'declined')
                                                        <button class="btn btn-sm btn-success"
                                                            wire:click="approveReading({{ $report->id }})"><i
                                                                class="fa fa-check"></i>
                                                            Aprove</button>
                                                    @endif
                                                    @if ($report->status != 'declined')
                                                        <button class="btn btn-sm btn-danger"
                                                            wire:click="declineReading({{ $report->id }})"><i
                                                                class="fa
                                                            fa-window-close"></i>
                                                            Decline</button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $reports->links() }}
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
