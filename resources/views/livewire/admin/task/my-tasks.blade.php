<?php use Carbon\Carbon;
?>

<div>
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-tools"></i> Task</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Tasks List</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Total Tasks</h6>
                            <h4 class="font-weight-bold mb-0">{{ $tasks->count() }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-orange text-white">
                                <i class="fas fa-tools"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Completed</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalCompletedTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-green text-white">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 7.8%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Open</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalOpenTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-yellow text-white">
                                <i class="fas fa-lock-open"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 15%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body card-type-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-0">Closed</h6>
                            <h4 class="font-weight-bold mb-0">{{ $totalClosedTasks }}</h4>
                        </div>
                        <div class="col-auto">
                            <div class="card-circle l-bg-red text-white">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5.4%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="d-inline text-white">Tasks
                <span class="badge badge-primary badge-sm">{{ $myCrewTasks ? $myCrewTasks->count() : 0 }}</span>
            </h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-dark">View All</a>
            </div>
        </div>
        <div class="card-body">

            <ul class="list-unstyled list-unstyled-border">

                @forelse (Auth::user()->assignedTasks as $task)
                    <li class="media">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cbx-1">
                            <label class="custom-control-label" for="cbx-1"></label>
                        </div>
                        @if ($task->assignedTo->image)
                            <img alt="image" class="mr-3 rounded-circle" width="50"
                                src="{{ asset('storage/' . $task->assignedTo->image) }}">
                        @else
                            <img alt="image" class="mr-3 rounded-circle" width="50"
                                src="{{ asset('storage/images/male_avatar.png') }}">
                        @endif

                        <div class="media-body">
                            <div
                                class="badge badge-pill badge-{{ $task->status == 'Completed' ? 'success' : '' }}{{ $task->status == 'Open' ? 'danger' : '' }}{{ $task->status == 'Approved' ? 'warning' : '' }} mb-1 float-right">
                                {{ $task->status }}
                            </div>
                            <button onclick="openReportModal()" class="btn btn-primary btn-sm mx-2 mb-1 float-right">
                                Make Report
                            </button>
                            <h6 class="media-title"><a
                                    href="{{ route('single-task', ['task_id' => $task->id]) }}">{{ $task->name }}</a>
                            </h6>
                            <div class="text-small text-muted">
                                {{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}
                                <div class="bullet"></div>
                                {{ Carbon::parse($task->assign_date)->diffForHumans() }}
                            </div>
                        </div>
                    </li>
                @empty
                    {{-- <h6>No Task Available</h6> --}}
                @endforelse
                @if ($myCrewTasks != null)
                    @forelse ($myCrewTasks as $crewTask)
                        <li class="media">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="cbx-1">
                                <label class="custom-control-label" for="cbx-1"></label>
                            </div>
                            @if ($crewTask->assignedBy->image)
                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                    src="{{ asset('storage/' . $crewTask->assignedBy->image) }}">
                            @else
                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                    src="{{ asset('storage/images/male_avatar.png') }}">
                            @endif

                            <div class="media-body">
                                <div
                                    class="badge badge-pill badge-{{ $crewTask->status == 'Completed' ? 'success' : '' }}{{ $crewTask->status == 'Pending' ? 'danger' : '' }}{{ $crewTask->status == 'Approved' ? 'warning' : '' }} mb-1 float-right">
                                    {{ $crewTask->status }}
                                </div>
                                @if (Auth::user()->member->crew->supervisor_id == Auth::user()->employee_id && $crewTask->status == 'Pending')
                                    <button onclick="openReportModal()"
                                        class="btn btn-primary btn-sm mx-2 mb-1 float-right">
                                        Approve
                                    </button>
                                @endif
                                <button wire:click="addTaskComment({{ $crewTask->id }})"
                                    class="btn btn-primary btn-sm mx-2 mb-1 float-right">
                                    Comment
                                </button>


                                <h6 class="media-title"><a
                                        href="@if (!$task->loss_reduction_id) {{ route('single-task', ['task_id' => $task->id]) }}
                                        @else
                                            {{ route('los-reduction-case-detail', ['id' => $task->loss_reduction_id]) }} @endif">{{ $crewTask->name }}</a>
                                </h6>
                                <div class="text-small text-muted">
                                    {{ $crewTask->assignedBy->firstname . ' ' . $crewTask->assignedBy->lastname }}
                                    <div class="bullet"></div>
                                    {{ Carbon::parse($crewTask->assign_date)->diffForHumans() }}
                                </div>
                            </div>
                        </li>
                    @empty
                        <h6>No Task Available</h6>
                    @endforelse
                @endif

            </ul>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="taskCommentModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myLargeModalLabel">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addComment">
                        <div class="form-group">
                            <label>Add Comment</label>
                            <textarea type="text" class="form-control" wire:model.defer="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                <span wire:loading wire:target="addComment">Adding Comment...</span>
                                <span wire:loading.remove>Add Comment</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
