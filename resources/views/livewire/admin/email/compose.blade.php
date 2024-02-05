<div>
    <livewire:admin.email.email-analytics />
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body">

                            <livewire:admin.email.email-sidebar />

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="boxs mail_listing">
                            <div class="inbox-center table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="1">
                                                <div class="inbox-header">
                                                    Compose New Message
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="composeForm" wire:submit.prevent="sendEmail"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address"
                                                    wire:model.defer="receiver_email" class="form-control"
                                                    placeholder="TO">
                                                @error('receiver_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div id="email_list"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="subject" wire:model.defer="subject"
                                                    class="form-control" placeholder="Subject">
                                                @error('subject')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line" wire:ignore>
                                                <textarea id="body" wire:model.defer="content"></textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="compose-editor m-t-20">
                                            <div id="summernote"></div>
                                            <input type="file" class="default" multiple=""
                                                wire:model.defer="attachments">
                                            @error('attachments')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="col-12 col-md-12 col-lg-12 my-3">
                                                <button type="submit" class="btn btn-primary btn-block"
                                                    wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="sendEmail">Sending...</span>
                                                    <span wire:loading.remove>Send</span>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
