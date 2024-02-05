<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"> <img alt="image" style="height: 60px;"
                    src="{{ asset('admin/assets/img/lec.jpg') }}" class="header-logo" />
                <span class="logo-name">ServiceMindset</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="{{ route('home') }}" class="nav-link"><i data-feather="monitor"></i><span>Insights</span></a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        class="fa fa-users"></i><span>Customers</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('add-customers') }}">Potential Customers</a></li>
                    <li><a class="nav-link" href="{{ route('customers') }}">All Customers</a></li>
                </ul>
            </li> --}}

            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        class="fa fa-bolt"></i><span>Meters</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('meters') }}">Meter List</a></li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a href="{{ route('my-tasks') }}" class="nav-link"><i class="fas fa-tasks"></i><span>My
                        Tasks</span></a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa fa-bolt"></i><span>S-O
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('service-order') }}">Service Order</a></li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a href="{{ route('community-engagement') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Community
                        Engagement</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('customers-engagement-dashboard') }}" class="nav-link"><i data-feather="user"></i><span>Customer
                        Engagement</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('case-dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Loss
                        Reduction</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('campaigns') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Campaigns</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa fa-list"></i><span>Work and
                        Resource Management</span></a>
                <ul class="dropdown-menu">
                    {{--                    <li><a class="nav-link" href="{{ route('new-service-order') }}">New Service Order</a></li> --}}
                    {{-- <li><a class="nav-link" href="{{ route('task-maintenance') }}">Task Maintenance</a></li> --}}
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><span>Task Maintenance</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="{{ route('new-connection-tasks') }}">Commercial Services</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('meter-reading-tasks') }}">Meter Reading</a></li>
                            <li><a class="nav-link" href="{{ route('service-inventory-management') }}">Network
                                    Services</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    {{--                    <li><a class="nav-link" href="{{ route('new-service-order') }}">New Service Order</a></li> --}}
                    <li><a class="nav-link" href="{{ route('service-inventory-management') }}">Service Inventory</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    {{--                    <li><a class="nav-link" href="{{ route('new-service-order') }}">New Service Order</a></li> --}}
                    <li><a class="nav-link" href="#">Scheduler</a>
                    </li>
                </ul>

            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa fa-list"></i><span>AI and
                        Recovery</span></a>
                <ul class="dropdown-menu">
                    {{--                    <li><a class="nav-link" href="{{ route('new-service-order') }}">New Service Order</a></li> --}}
                    <li><a class="nav-link" href="{{ route('stolen-meter-identification') }}">Stolen Meter
                            Identification</a></li>
                </ul>
            </li>
            <li class="menu-header">Settings</li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        class="fa fa-tools"></i><span>Configurations</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('system-settings') }}">System Settings</a></li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                class="fa fa-users"></i><span>Users</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="{{ route('add-users') }}">New Users</a></li>
                            <li><a class="nav-link" href="{{ route('users') }}">Users</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                class="fa fa-users"></i><span>Crews
                                Management</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="{{ route('crews') }}">Crews</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa fa-tools"></i><span>Service
                        Sync</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('export-import-customer') }}">Customers</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('export-import-service-orders') }}">Service Order</a></li>
                    <li><a class="nav-link" href="{{ route('export-import-meters') }}">Meters</a></li>
                    <li><a class="nav-link" href="#">Reading Sheet</a></li>
                    <li><a class="nav-link" href="{{ route('data-reconciliation') }}">Data Reconciliation</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="index.html" class="nav-link">
                    <i class="far fa-edit"></i><span>Logs</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
