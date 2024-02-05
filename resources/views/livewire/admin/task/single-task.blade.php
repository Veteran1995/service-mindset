<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark" style="display:flex; justify-content: space-between; align-items:center">
            <div class="col-lg-6">
                <h6 style="color: white">Status: {{ $task->status }}</h6>
            </div>
            <div class="col-lg-6">
                @if ($task->status != 'Closed')
                    <button class="btn btn-sm btn-danger mx-2" wire:click="closeStatus"><i class="fa fa-edit"></i> Mark
                        Closed</button>
                @endif
                @if ($task->status != 'Open')
                    <button class="btn btn-sm btn-primary" wire:click="openStatus"><i class="fa fa-edit"></i> Mark
                        Open</button>
                @endif
                @if ($task->status != 'Completed')
                    <button class="btn btn-sm btn-success mx-2" wire:click="completeStatus"><i
                            class="fa fa-edit"></i>Mark
                        Completed</button>
                @endif
            </div>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-center">

                                @if ($task->serviceOrder->customer->image)
                                    <img alt="image" src="{{ asset('storage/' . $customer->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    @if ($task->serviceOrder->customer->gender == 'Male')
                                        <img alt="image" src="{{ asset('storage/images/male_avatar.png') }}"
                                            class="rounded-circle author-box-picture">
                                    @elseif($task->serviceOrder->customer->gender == 'Female')
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
                                        href="{{ route('customer-profile', ['customer_id' => $task->serviceOrder->customer->cnumber]) }}">{{ $task->serviceOrder->customer->customer_name }}</a>
                                </div>
                                <div class="author-box-job">Customer</div>
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
                                        Name
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->name }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Date Assigned
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->assign_date }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Date Due
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->due_date }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Assigned By
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->assignedBy->firstname . ' ' . $task->assignedBy->lastname }}
                                    </span>
                                </p>
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
                                    <span class="float-right text-muted">
                                        {{ $task->status }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Description
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $task->description }}
                                    </span>
                                </p>
                            </div>
                            <div class="row">
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-warning mr-3 col"><i class="far fa-edit"></i> Edit Task</a>
                                <a href="{{ route('edit-task', ['task_id' => $task->id]) }}"
                                    class="btn btn-primary  col"><i class="fas fa-unlink"></i> Reassign
                                    Task</a>
                            </div>

                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $task->crewAssignedTo ? $task->crewAssignedTo->name . ' (' . $task->crewAssignedTo->members->count() . ')' : '' }}
                                {{ $task->assignedTo ? 'Assigned To: ' . $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname : '' }}
                            </h4>
                            @if ($task->crewAssignedTo)
                                <div class="card-header-action">
                                    <a href="{{ route('crew-members', ['crew_id' => $task->crew_id]) }}"
                                        class="btn btn-primary">
                                        View All
                                    </a>
                                </div>
                            @endif

                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($task->crewAssignedTo && $task->crewAssignedTo->members)
                                    {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <article class="article">
                                            <div class="article-header">

                                                @if ($task->crewAssignedTo->supervisor->image)
                                                    <div class="article-image"
                                                        data-background="{{ asset('storage/' . $task->crewAssignedTo->supervisor->image) }}"
                                                        style="background-image: url(&quot;{{ asset('storage/' . $task->crewAssignedTo->supervisor->image) }}&quot;);">
                                                    </div>
                                                @else
                                                    @if ($member->gender == 'Male')
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
                                                            href="{{ route('user-profile', ['user_id' => $task->crewAssignedTo->supervisor->employee_id]) }}">{{ $task->crewAssignedTo->supervisor->firstname . ' ' . $member->supervisor->lastname }}</a>
                                                    </h2>
                                                </div>
                                            </div>
                                            <div class="article-details">

                                                <div class="article-cta">
                                                    <a href="{{ route('user-profile', ['user_id' => $task->crewAssignedTo->supervisor->employee_id]) }}"
                                                        class="btn btn-primary btn-sm">Profile</a>
                                                    <button class="btn btn-danger btn-sm"
                                                        wire:click="removeMember({{ $task->crewAssignedTo->supervisor->employee_id }})">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </article>
                                    </div> --}}
                                    @forelse ($task->crewAssignedTo->members as $member)
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                            <article class="article">
                                                <div class="article-header">

                                                    @if ($member->user->image)
                                                        <div class="article-image"
                                                            data-background="{{ asset('storage/' . $member->user->image) }}"
                                                            style="background-image: url(&quot;{{ asset('storage/' . $member->user->image) }}&quot;);">
                                                        </div>
                                                    @else
                                                        @if ($member->gender == 'Male')
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

                                                    <div class="article-image"
                                                        data-background="assets/img/blog/img08.png"
                                                        style="background-image: url(&quot;assets/img/blog/img08.png&quot;);">
                                                    </div>
                                                    <div class="article-title">
                                                        <h2><a
                                                                href="{{ route('user-profile', ['user_id' => $member->user->employee_id]) }}">{{ $member->user->firstname . ' ' . $member->user->lastname }}</a>
                                                        </h2>
                                                    </div>
                                                </div>

                                            </article>
                                        </div>
                                    @empty
                                        <p>No Members Found</p>
                                    @endforelse
                                @endif
                                @if ($task->assignedTo)
                                    <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                        <article class="article">
                                            <div class="article-header">

                                                @if ($task->assignedTo->image)
                                                    <div class="article-image"
                                                        data-background="{{ asset('storage/' . $task->assignedTo->image) }}"
                                                        style="background-image: url(&quot;{{ asset('storage/' . $task->assignedTo->image) }}&quot;);">
                                                    </div>
                                                @else
                                                    @if ($task->assignedTo->gender == 'Male')
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
                                                            href="{{ route('user-profile', ['user_id' => $task->assignedTo->employee_id]) }}">{{ $task->assignedTo->firstname . ' ' . $task->assignedTo->lastname }}</a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                @endif
                            </div>

                        </div>
                    </div>
                </div>
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
                                                    <td>{{ $task->serviceOrder->customer->organization }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Customer type</th>
                                                    <td>{{ $task->serviceOrder->customer->customer_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Customer Balance</th>
                                                    <td>{{ $task->serviceOrder->customer->customer_balance }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <td>{{ $task->serviceOrder->customer->document_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Account Number</th>
                                                    <td>{{ $task->serviceOrder->customer->account_number }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo County</th>
                                                    <td>{{ $task->serviceOrder->customer->geo_county }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Community</th>
                                                    <td>{{ $task->serviceOrder->customer->geo_community }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Geo Zone</th>
                                                    <td>{{ $task->serviceOrder->customer->geo_zone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Street</th>
                                                    <td>{{ $task->serviceOrder->customer->street }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Building Description</th>
                                                    <td>{{ $task->serviceOrder->customer->building_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Service Type</th>
                                                    <td>{{ $task->serviceOrder->customer->service_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $task->serviceOrder->customer->route }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Itinerary</th>
                                                    <td>{{ $task->serviceOrder->itinerary }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Category</th>
                                                    <td>{{ $task->serviceOrder->customer->tariff_category }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Route</th>
                                                    <td>{{ $task->serviceOrder->route }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tariff Description</th>
                                                    <td>{{ $task->serviceOrder->customer->tariff_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Premise Type</th>
                                                    <td>{{ $task->serviceOrder->customer->premise_type }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Status</th>
                                                    <td>{{ $task->serviceOrder->customer->contract_status }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Contract Number</th>
                                                    <td>{{ $task->serviceOrder->customer->cnumber }}</td>
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
                                        @if ($task->serviceOrder && $task->serviceOrder->meter)
                                            <ul>
                                                <li>Meter Name: <strong
                                                        class="mx-3">{{ $task->serviceOrder->meter->name }}</strong>
                                                </li>
                                                <li>Meter Serial Number: <strong
                                                        class="mx-3">{{ $task->serviceOrder->meter->serial_number }}</strong>
                                                </li>
                                                <li>Meter seal Tag: <strong
                                                        class="mx-3">{{ $task->serviceOrder->meter->seal_tag }}</strong>
                                                </li>
                                                <li>Location: <strong
                                                        class="mx-3">{{ $task->serviceOrder->location }}</strong>
                                                </li>
                                                <li>Longitude:<strong
                                                        class="mx-3">{{ $task->serviceOrder->longitude }}</strong>
                                                </li>
                                                <li>Latitude: <strong
                                                        class="mx-3">{{ $task->serviceOrder->latitude }}</strong>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary mb-3"
                                                onclick="fetchLongLat({{ $task->serviceOrder->latitude }},{{ $task->serviceOrder->longitude }}, 6.322549800000001, -10.8075428)">Fetch
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Comments ({{ $taskComments->count() }})
                            </h4>
                            <div class="card-header-action">
                                <a href="" class="btn btn-primary" wire:click.prevent="showAllCommets">
                                    View All
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                @if ($taskComments != null)
                                    @foreach ($taskComments->take(2) as $comment)
                                        <li class="media">
                                            <img alt="image" class="mr-3 rounded-circle" width="70"
                                                src="{{ asset('storage/' . $comment->sender->image) }}">
                                            <div class="media-body">
                                                <div class="media-right">
                                                    <div class="text-primary">Approved</div>
                                                </div>
                                                <div class="media-title mb-1">
                                                    {{ $comment->sender->firstname . ' ' . $comment->sender->lastname }}
                                                </div>
                                                <div class="text-time">{{ $comment->created_at->diffForHumans() }}
                                                </div>
                                                <div class="media-description text-muted">
                                                    {{ $comment->comment }}
                                                </div>
                                                <div class="media-links">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <p>No Comments</p>
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="taskCommentModal" role="dialog" wire:ignore
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder"
                        style="max-height:500px; overflow: scroll">
                        @if ($taskComments != null)
                            @foreach ($taskComments as $comment)
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70"
                                        src="{{ asset('storage/' . $comment->sender->image) }}">
                                    <div class="media-body">
                                        <div class="media-right">
                                            <div class="text-primary">Approved</div>
                                        </div>
                                        <div class="media-title mb-1">
                                            {{ $comment->sender->firstname . ' ' . $comment->sender->lastname }}
                                        </div>
                                        <div class="text-time">{{ $comment->created_at->diffForHumans() }}
                                        </div>
                                        <div class="media-description text-muted">
                                            {{ $comment->comment }}
                                        </div>
                                        <div class="media-links">
                                            <a href="#">View</a>

                                            @if ($comment->sender_id == auth()->user()->employee_id)
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#" class="text-danger">Trash</a>
                                            @endif

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>No Comments</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
