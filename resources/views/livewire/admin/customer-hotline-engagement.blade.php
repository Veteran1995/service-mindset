<div>
    <div class="card">
        <div class="card-body">
            @livewire('loss-reduction.customer-engagement-navigation')

            <form wire:submit.prevent="addLossReduction">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Suspect Name</label>
                            <input type="text" class="form-control"
                                wire:model.defer="suspectName">
                            @error('suspectName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nearest Landmark</label>
                            <input type="text" class="form-control"
                                wire:model.defer="nearestLandmark">
                            @error('nearestLandmark')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" wire:model.defer="city">
                        </div>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label>Reported By</label>
                            <input type="text" class="form-control" wire:model.defer="reportedBy">
                        </div>
                        @error('reportedBy')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="number" class="form-control" wire:model.defer="contactNumber">
                            @error('contactNumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                        </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>P-Score #</label>
                                    <input type="text" class="form-control"
                                        wire:model.defer="pscoreNumber">
                                    @error('pscoreNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Impact KWH</label>
                                    <input type="text" class="form-control"
                                        wire:model.defer="impactKwh">
                                    @error('impactKwh')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Frequency Score</label>
                                    <input type="text" class="form-control"
                                        wire:model.defer="frequencyScore">
                                    @error('frequencyScore')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Reported Activity</label>
                            <select class="form-control" wire:model.defer="reportedActivity">
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
                            <label>Loss Reduction Case Type</label>
                            <select class="form-control" wire:model.defer="lossReductionCaseType">
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
                            <label>Description of Suspected Activity</label>
                            <textarea class="form-control" wire:model.defer="descriptionOfSuspectedActivity"></textarea>
                            @error('descriptionOfSuspectedActivity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer" wire:ignore>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                              <label>Longitude</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-map-marker"></i>
                                  </div>
                                </div>
                                <input type="text" class="form-control" id="longitude_field">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label>Latitude</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fas fa-map-marker"></i>
                                  </div>
                                </div>
                                <input type="text" class="form-control" id="latitude_field">
                              </div>
                            </div>
                          </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" id="location_field">
                          </div>
                      </div>
                    </div>
                  </div>
                <div wire:ignore id="outboundmap" style="width: 100%; height:400px;"></div>
                    <div class="card-footer text-right">
                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn btn-primary mr-1 btn-block" type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                            <div class="col-lg-6">
                                <button wire:click.prevent="resetForm" class="btn btn-danger mr-1 btn-block"><i class="fa fa-window-close"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

    </div>
</div>

