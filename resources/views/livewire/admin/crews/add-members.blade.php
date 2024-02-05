<div>
    <nav aria-label="breadcrumb m-0">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-users"></i> Crew</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Add User To Crew</li>
        </ol>
    </nav>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $crew->name }} ({{ $crew->members->count() }})
                                @if ($selectedRows)
                                    <button wire:click="addUserToCrew" class="btn btn-primary mx-3"><i
                                            class="fas fa-plus-circle"></i>
                                        Add To Crew</button>
                                @endif

                            </h4>

                            <div class="card-header-form">
                                <div class="row">
                                    <div>
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Filters
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <div class="form-group dropdown-item">
                                                    <label class="d-block">Admin | Agents</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" wire:model="filterByAdmin"
                                                            wire:click="filterByAdmin" type="checkbox"
                                                            id="defaultCheck3">
                                                        <label class="form-check-label" for="defaultCheck3">
                                                            Filter by Admin
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" wire:model="filterByAgent"
                                                            wire:click="filterByAgent" type="checkbox"
                                                            id="defaultCheck4">
                                                        <label class="form-check-label" for="defaultCheck4">
                                                            Filter by Agent
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <form>
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model="searchEmployeeId"
                                                    placeholder="Search">
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


                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="m-4 text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input wire:model="selectedPageRows" class="form-check-input"
                                                        type="checkbox" value="" id="defaultCheck1" />
                                                </div>

                                            </th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Department</th>
                                            <th>Job</th>
                                            <th>Status</th>
                                        </tr>
                                        @forelse ($users as $user)
                                            <tr>

                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input wire:model="selectedRows" class="form-check-input"
                                                            type="checkbox" value="{{ $user->employee_id }}"
                                                            id="defaultCheck1" />
                                                    </div>

                                                </td>
                                                <td>{{ $user->employee_id }}</td>
                                                <td class="align-middle">
                                                    <strong>
                                                        <a href="{{ route('user-profile', ['user_id' => $user->employee_id]) }}"
                                                            class="text-decoration-none text-dark">
                                                            {{ $user->firstname . ' ' . $user->lastname }}
                                                        </a>

                                                    </strong>

                                                </td>
                                                <td> {{ $user->email }}</td>
                                                <td>
                                                    @if ($user->image)
                                                        <img alt="image" src="{{ asset('storage/' . $user->image) }}"
                                                            class="rounded-circle" width="35" data-toggle="tooltip"
                                                            title="" data-original-title="Wildan Ahdian">
                                                    @else
                                                        <p>N/A</p>
                                                    @endif

                                                </td>

                                                <td>{{ $user->department }}</td>
                                                <td>{{ $user->job }}</td>
                                                <td>
                                                    <div
                                                        class="badge badge-{{ $user->status == 1 ? 'success' : 'danger' }}">
                                                        {{ $user->status == 1 ? 'Active' : 'Inactive' }}</div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="card-footer" style="border-top:solid rgb(220, 226, 233) 1px;">
                                    <div style="float:right;">
                                        {{ $users->links() }}
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
