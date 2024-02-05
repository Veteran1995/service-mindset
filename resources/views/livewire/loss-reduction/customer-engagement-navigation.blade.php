<div>

    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <div class="dropdown d-inline mr-2">
                        @if(url()->current() == route('customers-engagement-dashboard'))
                            <a href="{{ route('customers-engagement-dashboard') }}" class="btn" style="background-color: white; color:black">
                        @else
                            <a href="{{ route('customers-engagement-dashboard') }}" class="btn btn-primary">
                        @endif
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </div>
                </li>
                <li class="nav-item active">
                    <div class="dropdown d-inline mr-2">
                        @if(url()->current() == route('customers-hotline-engagement'))
                            <a href="{{ route('customers-hotline-engagement') }}" class="btn" style="background-color: white; color:black">
                        @else
                            <a href="{{ route('customers-hotline-engagement') }}" class="btn btn-primary">
                        @endif
                            <i class="fas fa-pen"></i> INBOUND ENGAGMENT: 4600
                        </a>
                    </div>
                </li>
                <li class="nav-item active">
                    <div class="dropdown d-inline mr-2">
                        @if(url()->current() == route('customers-engagement'))
                            <a href="{{ route('customers-engagement') }}" class="btn" style="background-color: white; color:black">
                        @else
                            <a href="{{ route('customers-engagement') }}" class="btn btn-primary">
                        @endif
                            <i class="fas fa-eye"></i> ALL CASES
                        </a>
                    </div>
                </li>
                <li class="nav-item active">
                    <div class="dropdown d-inline mr-2">
                        @if(url()->current() == route('customers-outbound-engagement'))
                            <a href="{{ route('customers-outbound-engagement') }}" class="btn" style="background-color: white; color:black">
                        @else
                            <a href="{{ route('customers-outbound-engagement') }}" class="btn btn-primary">
                        @endif
                            <i class="fas fa-eye"></i> OUTBOUND ENGAGEMENT
                        </a>
                    </div>
                </li>
                
                {{-- <li class="nav-item active">
                    <div class="dropdown d-inline mr-2">
                        @if(url()->current() == route('customers-outbound-engagement'))
                            <a href="{{ route('customers-outbound-engagement') }}" class="btn" style="background-color: white; color:black">
                        @else
                            <a href="{{ route('customers-outbound-engagement') }}" class="btn btn-primary">
                        @endif
                            <i class="fas fa-eye"></i> OUTBOUND ENGAGEMENT
                        </a>
                    </div>
                </li> --}}
            </ul>
        </div>
    </nav>

    <div class="card rounded-0">
        <center>
            @if(url()->current() == route('customers-inbound-engagement'))
                <h4 class="p-3">INBOUND ENGAGEMENT</h4>
            @elseif (url()->current() == route('customers-outbound-engagement'))
                <h4 class="p-3">OUTBOUND ENGAGEMENT</h4>
            @elseif (url()->current() == route('customers-outbound-engagement'))
                <h4 class="p-3">OUTBOUND ENGAGEMENT</h4>
            @elseif (url()->current() == route('customers-hotline-engagement'))
                <h4 class="p-3">HOTLINE ENGAGEMENT</h4>
            @elseif (url()->current() == route('customers-engagement-dashboard'))
                <h4 class="p-3">DASHBOARD</h4>
            @elseif (url()->current() == route('customers-engagement'))
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h4 class="p-3">ALL CASES</h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary">REGISTERED CASES</button>
                </div>
            </div>
            
                
            @endif
            
        </center>
    </div>
</div>

