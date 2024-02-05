<div>
    <nav class="navbar navbar-expand-lg main-navbar sticky" wire:ignore>
        <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar"
                        class="nav-link nav-link-lg
                            collapse-btn">
                        <i data-feather="align-justify"></i></a></li>
                <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                        <i data-feather="maximize"></i>
                    </a></li>
                <li>
                    <form class="form-inline mr-auto">
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                data-width="200">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                    class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
                    <span class="badge headerBadge1">
                        {{ $emails->count() }} </span> </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                    <div class="dropdown-header">
                        Messages
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-message">
                        @forelse ($emails as $email)
                            <a href="{{ route('read', ['email_id' => $email->id]) }}" class="dropdown-item"> <span
                                    class="dropdown-item-avatar
                                    text-white"> <img
                                        alt="image" src="{{ asset('storage/' . $email->sender->image) }}"
                                        class="rounded-circle">
                                </span> <span class="dropdown-item-desc"> <span
                                        class="message-user">{{ $email->sender->firstname . ' ' . $email->sender->lastname }}</span>
                                    <span class="time messege-text">{{ $email->subject }}</span>
                                    <span class="time">{{ $email->created_at }}</span>
                                </span>
                            </a>
                        @empty
                            <small class="time messege-text m-3">No Recent Messages</small>
                        @endforelse

                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="{{ route('inbox') }}">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                    class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                    <div class="dropdown-header">
                        Notifications
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread"> <span
                                class="dropdown-item-icon bg-primary text-white"> <i
                                    class="fas
                                        fa-code"></i>
                            </span> <span class="dropdown-item-desc"> Template update is
                                available now! <span class="time">2 Min
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span
                                class="dropdown-item-icon bg-info text-white"> <i
                                    class="far
                                        fa-user"></i>
                            </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                                    Sugiharto</b> are now friends <span class="time">10 Hours
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span
                                class="dropdown-item-icon bg-success text-white"> <i
                                    class="fas
                                        fa-check"></i>
                            </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                    Hours
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span
                                class="dropdown-item-icon bg-danger text-white"> <i
                                    class="fas fa-exclamation-triangle"></i>
                            </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                clean it! <span class="time">17 Hours Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span
                                class="dropdown-item-icon bg-info text-white"> <i
                                    class="fas
                                        fa-bell"></i>
                            </span> <span class="dropdown-item-desc"> Welcome to Otika
                                template! <span class="time">Yesterday</span>
                            </span>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li> --}}
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (Auth::check())
                        <img alt="{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}"
                            src="{{ asset(Auth::user()->image ? 'storage/' . Auth::user()->image : 'storage/images/avatar.png') }}"
                            class="user-img-radious-style">
                    @endif

                    <span class="d-sm-none d-lg-inline-block"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right pullDown">
                    <div class="dropdown-title">
                        @if (Auth::check())
                            <p>{{ Auth::user()->job }}</p>
                        @endif
                    </div>
                    <a href="{{ route('user-profile', ['user_id' => Auth::user()->employee_id]) }}"
                        class="dropdown-item has-icon"> <i class="far
                                fa-user"></i>
                        Profile
                    </a> <a href="{{ route('my-tasks') }}" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                        Tasks
                    </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </nav>

</div>
