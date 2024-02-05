<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="#" class="text-white">Crews</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Crew Members</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                @if ($crew->supervisor->image)
                                    <img alt="image" src="{{ asset('storage/' . $crew->supervisor->image) }}"
                                        class="rounded-circle author-box-picture">
                                @else
                                    <img alt="image" src="{{ asset('storage/images/avatar.png') }}"
                                        class="rounded-circle author-box-picture">
                                @endif

                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a
                                        href="{{ route('user-profile', ['user_id' => $crew->supervisor->employee_id]) }}">
                                        {{ $crew->supervisor->firstname . ' ' . $crew->supervisor->lastname }}</a>
                                </div>
                                <div class="author-box-job">Supervisor</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $crew->name }} ({{ $crew->members->count() }})</h4>
                            <div class="card-header-action">
                                <a href="{{ route('add-crew-members', ['crew_id' => $crew->id]) }}"
                                    class="btn btn-primary">
                                    Add New Members
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row m-1 b-rounded">
                                @if ($crew->members)
                                    @forelse ($crew->members as $member)
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
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
                                                <div class="article-details">

                                                    <div class="article-cta">
                                                        <a href="{{ route('user-profile', ['user_id' => $member->user->employee_id]) }}"
                                                            class="btn btn-primary btn-sm">Profile</a>
                                                        <button class="btn btn-danger btn-sm"
                                                            wire:click="removeMember({{ $member->user->employee_id }})">
                                                            Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @empty
                                        <p>No Members Found</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
