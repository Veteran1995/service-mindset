<div>
    <div class="card">
        <div class="card-body">
            @livewire('loss-reduction.case-navigation-component')
          
            <hr>
            <div class="card bg-primary m-0 p-2">
                <h5 class="text-center">Manual Registration</h5>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="card-header bg-dark ">
                                <h4 style="text-align: center" class="text-white text-center">Loss Reduction Case Form</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-8 card">
                                <form wire:submit.prevent="addLossReduction">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="d-block">Customer Account Verified?</label>
                                            <div class="form-check">
                                                <select class="form-control" wire:model="customerAccountVerified">
                                                    <option value="">Choose Verification</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                @error('customerAccountVerified')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($customerAccountVerified === 'yes')
                                            <div class="row d-flex align-items-center">
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <label>Customer SPN</label>
                                                    <input type="number" class="form-control" wire:model="customerSPN">
                                                    @error('customerSPN')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
    
                                            <div class="col-lg-2">
                                                <!-- Floating section indicator -->
                                                <div class="container mt-5 text-center" wire:loading
                                                    wire:target="verifyCustomer">
                                                    <!-- Bootstrap Spinner -->
                                                    <div class="spinner-border text-dark" role="status">
    
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-block"
                                                    wire:click="verifyCustomer"><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <label>Meter Number</label>
                                                    <input type="number" class="form-control" wire:model="meterNumber">
                                                    @error('meterNumber')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
    
                                            <div class="col-lg-2">
                                                <!-- Floating section indicator -->
                                                <div class="container mt-5 text-center" wire:loading
                                                    wire:target="verifyMeter">
                                                    <!-- Bootstrap Spinner -->
                                                    <div class="spinner-border text-dark" role="status">
    
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-block"
                                                    wire:click="verifyMeter"><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" wire:model="fullname">
                                            @error('fullname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Geo Community</label>
                                            <input type="text" class="form-control" wire:model="geoCommunity">
                                            @error('geoCommunity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Geo Zone</label>
                                            <input type="text" class="form-control" wire:model="geoZone">
                                            @error('geoZone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endif
                                       
                                        @if ($customerAccountVerified === 'no')
                                            <div class="form-group">
                                            <label>Nearest Landmark</label>
                                            <input type="text" class="form-control"
                                                wire:model="nearestLandmark">
                                            @error('nearestLandmark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" wire:model="city">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" wire:model="address">
                                        </div>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Suspect Name</label>
                                            <input type="text" class="form-control"
                                                wire:model="suspectName">
                                            @error('suspectName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @endif
                                        @if ($customerAccountVerified)
                                        <div class="form-group">
                                            <label>Description of Suspected Activity</label>
                                            <textarea class="form-control" wire:model="descriptionOfSuspectedActivity"></textarea>
                                            @error('descriptionOfSuspectedActivity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endif
                                        </div>
                                    <div class="col-lg-6">
                                        @if ($customerAccountVerified)
                                            <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>P-Score #</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="pscoreNumber">
                                                    @error('pscoreNumber')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Impact KWH</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="impactKwh">
                                                    @error('impactKwh')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Frequency Score</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="frequencyScore">
                                                    @error('frequencyScore')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Reported Activity</label>
                                            <select class="form-control" wire:model="reportedActivity">
                                                <option value="">Select Reported Activity</option>
                                                <option value="Residential">Residential</option>
                                                <option value="Office">Office</option>
                                                <option value="Factory">Factory</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            @error('reportedActivity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Source of Detection</label>
                                            <select class="form-control" wire:model="sourceOfDetection">
                                                <option value="">Select Source of Detection</option>
                                                <option value="Internal Stakeholder">Internal Stakeholder</option>
                                                <option value="External Stakeholder">External Stakeholder</option>                                               
                                            </select>
                                            @error('sourceOfDetection')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Loss Reduction Case Type</label>
                                            <select class="form-control" wire:model="lossReductionCaseType">
                                                <option value="">Select Loss Reduction Case Type</option>
                                                @foreach ($caseType as $type)
                                                    <option value="{{ $type->case_id }}">{{ $type->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('lossReductionCaseType')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Reported By</label>
                                            <input type="text" class="form-control" wire:model="reportedBy">
                                        </div>
                                        @error('reportedBy')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" wire:model="contactNumber">
                                            @error('contactNumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                      
                                        {{-- <div class="form-group">
                                            <label>File</label>
                                            <input type="file" class="form-control" wire:model="file">
                                        </div> --}}
                                        
                                        @endif
                                        
                                    </div>
                                </div>
                                <div>
                                    @if ($customerAccountVerified)
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" class="custom-switch-input"
                                                wire:model="forwardForAssessment">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Forward For Assessment</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" class="custom-switch-input"
                                                wire:model="forwardForEngagement">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Forward For Engagement</span>
                                        </label>
                                    </div>
                                @endif


                                @if ($forwardForAssessment && $forwardForEngagement == false)
                                    <div class="card p-4">
                                        <div class="card-header bg-dark">
                                            <h6 class="text-white">Assign Task </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" wire:model="name"
                                                        id="name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" wire:model="description" id="description" rows="3"></textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="priority">Priority</label>
                                                    <select class="form-control" wire:model="priority"
                                                        id="priority">
                                                        <option value="processing">Low</option>
                                                        <option value="schedule">Average</option>
                                                        <option value="completed">High</option>
                                                    </select>
                                                    @error('priority')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="due_date">Due Date</label>
                                                    <input type="date" class="form-control" wire:model="dueDate"
                                                        id="due_date">
                                                    @error('dueDate')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="crewOrUserToggle">Select Crew or
                                                        User</label>
                                                    <label class="switch">
                                                        <input type="checkbox" wire:model="crewOrUserToggle"
                                                            id="crewOrUserToggle">
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    @if ($crewOrUserToggle)
                                                        <label for="crew">Select Crew</label>
                                                        <select class="form-control" wire:model="selectedCrew"
                                                            id="crew">
                                                            <option value="">Select Crew</option>
                                                            @foreach ($crews as $crew)
                                                                <option value="{{ $crew->id }}">
                                                                    {{ $crew->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('selectedCrew')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @else
                                                        <label for="user">Select User</label>
                                                        <select class="form-control" wire:model="selectedUser"
                                                            id="user">
                                                            <option value="">Select User</option>
                                                            @forelse ($users as $user)
                                                                <option value="{{ $user->employee_id }}">
                                                                    {{ $user->firstname . ' ' . $user->lastname }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('selectedUser')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif 
                                <!-- Floating section indicator -->
                                <div class="container mt-5 text-center" wire:loading="addLossReduction"
                                wire:target="addLossReduction">
                                <!-- Bootstrap Spinner -->
                                <div class="spinner-border text-dark" role="status">

                                </div>
                            </div>

                            @if ($customerAccountVerified)
                                <div class="card-footer text-right">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button class="btn btn-primary mr-1 btn-block" type="submit">Save</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <button wire:click.prevent="resetForm" class="btn btn-danger mr-1 btn-block">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            @endif   
                                </div>             
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-primary">
                                    <div class="card-header"><h4>GPS</h4></div>
                                    <div class="card-body m-0 p-0">
                                        @if ($customerAccountVerified)
                                        <div class="card m-1" wire:init="customerLocation">
                                                    <div class="row m-1">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Y-Cordinate</label>
                                                            <input type="text" disabled class="form-control"
                                                                wire:model="ycordinate">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>X-Cordinate</label>
                                                            <input type="text" disabled class="form-control"
                                                                wire:model="xcordinate">
                                                        </div>
                                                    </div>
                                                
                                                </div> 
                                                </div>
                                            
                                                <div id="customermap"
                                            style="width:100%; height:500px"></div>
                                        @endif 
                                        
                                    </div>
                                    
                                </div>
                            </div>
                          </div>
                            
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
