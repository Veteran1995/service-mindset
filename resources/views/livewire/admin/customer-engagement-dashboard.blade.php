<div>
    <div class="card">
        <div class="card-body">
            @livewire('loss-reduction.customer-engagement-navigation')

            <div class="mt-3">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                          <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="padding-20">
                            <div class="text-right">
                              <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{$cases->count()}}
                              </h3>
                              <span class="text-muted">Total Cases</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                        <div class="card-icon l-bg-green">
                          <i class="fas fa-list"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="padding-20">
                            <div class="text-right">
                              <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{$cases->where('engagement',1)->count()}}
                              </h3>
                              <span class="text-muted">Cases For Engagement</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                      <div class="card card-statistic-1">
                        <div class="card-icon l-bg-cyan">
                            <i class="fab fa-creative-commons-nd"></i>
                        </div>
                        <div class="card-wrap">
                          <div class="padding-20">
                            <div class="text-right">
                              <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> {{$cases->where('assessment',1)->count()}}
                              </h3>
                              <span class="text-muted">Cases For Assessment</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon l-bg-cyan">
                            <i class="fas fa-phone"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="padding-20">
                              <div class="text-right">
                                <h3 class="font-light mb-0">
                                  <i class="ti-arrow-up text-success"></i> {{$cases->where('source_of_detection','HOT4600')->count()}}
                                </h3>
                                <span class="text-muted">HotLine 4600</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
            
                </div>

                <h4>FULL DASHBOARD ANALYTICS COMING SOON</h4>
        </div>

    </div>
</div>
