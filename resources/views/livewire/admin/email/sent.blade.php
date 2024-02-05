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
                                            <th class="text-center">
                                                <label class="form-check-label">
                                                    <input type="checkbox">
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </th>
                                            <th colspan="3">
                                                <div class="inbox-header">
                                                    <div class="mail-option">
                                                        <div class="email-btn-group m-l-15">
                                                            <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                                title="" data-toggle="tooltip"
                                                                data-original-title="back">
                                                                <i class="material-icons">keyboard_return</i>
                                                            </a>
                                                            <div class="p-r-20">|</div>
                                                            <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                                title="" data-toggle="tooltip"
                                                                data-original-title="Delete">
                                                                <i class="material-icons">delete</i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="hidden-xs" colspan="2">

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($emails as $email)
                                            <tr class="unread">
                                                <td class="tbl-checkbox">
                                                    <label class="form-check-label">
                                                        <input type="checkbox">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </td>
                                                <td class="hidden-xs">
                                                    <i class="material-icons">star_border</i>
                                                </td>
                                                <td class="max-texts">
                                                    <a
                                                        href="{{ route('user-profile', ['user_id' => $email->sender->employee_id]) }}">
                                                        {{ $email->sender->firstname . ' ' . $email->sender->lastname }}</a>

                                                </td>
                                                <td class="max-texts">
                                                    <a href="{{ route('read', ['email_id' => $email->id]) }}">
                                                        {{ $email->subject }}</a>
                                                </td>
                                                @if ($email && $email->attachments->count() > 0)
                                                    <td class="hidden-xs">

                                                        <i class="material-icons">attach_file</i>

                                                    </td>
                                                @endif
                                                <td class="text-right">{{ $email->created_at }} </td>
                                            </tr>

                                        @empty
                                            <td class="text-right"> MailBox is Empty </td>
                                        @endforelse


                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
