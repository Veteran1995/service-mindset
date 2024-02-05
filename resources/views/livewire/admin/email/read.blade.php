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
                            <div class="inbox-body no-pad">
                                <section class="mail-list">
                                    <div class="mail-sender">
                                        <div class="mail-heading">
                                            <h5 class="vew-mail-header">
                                                <b>Subject: {{ $email->subject }}</b>
                                            </h5>
                                        </div>
                                        <hr>
                                        <div class="media">
                                            <a href="{{ route('user-profile', ['user_id' => $email->sender->employee_id]) }}"
                                                class="table-img m-r-15">
                                                <img alt="image"
                                                    src="{{ asset('storage/' . $email->sender->image) }}"
                                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                                    title=""
                                                    data-original-title=" {{ $email->sender->firstname . ' ' . $email->sender->lastname }}">
                                            </a>
                                            <div class="media-body">
                                                <span class="date pull-right">{{ $email->created_at }}</span>
                                                <h5 class="text-primary">
                                                    {{ $email->sender->firstname . ' ' . $email->sender->lastname }}
                                                </h5>
                                                <small class="text-muted">From: {{ $email->sender->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-mail p-t-20">
                                        {!! $email->body !!}
                                    </div>
                                    <div class="attachment-mail">
                                        @if ($email && $email->attachments->count() > 0)
                                            <p>
                                                <span>
                                                    <i class="fa fa-paperclip"></i> {{ $email->attachments->count() }}
                                                    attachments — </span>
                                                <a href="{{ route('emails.download-all-attachments', $email->id) }}">Download
                                                    all attachments</a>

                                            </p>
                                            <div class="row">
                                                @foreach ($email->attachments as $attachment)
                                                    @if ($attachment->type == 'jpg' || $attachment->type == 'png' || $attachment->type == 'jpeg')
                                                        <div class="col-md-2">
                                                            <a href="{{ asset('storage/' . $attachment->path) }}"
                                                                target="blank" data-lightbox="gallery">
                                                                <img class="img-thumbnail img-responsive"
                                                                    alt="{{ $attachment->filename }}"
                                                                    src="{{ asset('storage/' . $attachment->path) }}">
                                                            </a>
                                                            <a class="name" href="#">
                                                                {{ $attachment->filename }}
                                                                <span>20KB</span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <a href="{{ asset('storage/' . $attachment->path) }}">Download:
                                                                {{ $attachment->filename }}</a>
                                                        </div>
                                                        8
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                    <div class="replyBox m-t-20">
                                        <p class="p-b-20">click here to
                                            <a href="#">Reply</a> or
                                            <a href="#">Forward</a>
                                        </p>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
