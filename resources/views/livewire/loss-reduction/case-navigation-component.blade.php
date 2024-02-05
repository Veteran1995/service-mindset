<div>

            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                @if(url()->current() == route('case-dashboard'))
                                    <a href="{{ route('case-dashboard') }}" class="btn" style="background-color: white; color:black">
                                @else
                                    <a href="{{ route('case-dashboard') }}" class="btn btn-primary">
                                @endif
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Report Case
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  <a class="dropdown-item" href="{{route('add-lost-reduction')}}">Manaul Registration</a>
                                  <a class="dropdown-item" href="#">Consumption Variance</a>
                                </div>
                              </div>
                        </li>
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                @if(url()->current() == route('reported-case'))
                                    <a href="{{ route('reported-case') }}" class="btn" style="background-color: white; color:black">
                                @else
                                    <a href="{{ route('reported-case') }}" class="btn btn-primary">
                                @endif
                                    <i class="fas fa-eye"></i> View Reported Cases
                                </a>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <div class="dropdown d-inline mr-2">
                                @if(url()->current() == route('registerd-case'))
                                    <a href="{{ route('registerd-case') }}" class="btn" style="background-color: white; color:black">
                                @else
                                    <a href="{{ route('registerd-case') }}" class="btn btn-primary">
                                @endif
                                    <i class="fas fa-eye"></i> View Registered Cases
                                </a>
                            </div>
                        </li>
                        
                        
                    </ul>
                </div>
            </nav>
</div>
