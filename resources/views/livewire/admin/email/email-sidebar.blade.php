<div>
    <div id="mail-nav">
        <a href="{{ route('compose') }}" class="btn btn-danger waves-effect btn-compose m-b-15">COMPOSE</a>
        <ul class="" id="mail-folders">
            <li class="{{ Request::url() == route('inbox') ? 'active' : '' }}">
                <a href="{{ route('inbox') }}" title="Inbox">Inbox ({{ $totalMail }})
                </a>
            </li>
            <li class="{{ Request::url() == route('sent') ? 'active' : '' }}">
                <a href="{{ route('sent') }}" title="Sent">Sent ({{ $totalSent }})</a>
            </li>
            <li class="{{ Request::url() == route('message-read') ? 'active' : '' }}">
                <a href="{{ route('message-read') }}" title="Sent">Read({{ $read }})</a>
            </li>
            <li class="{{ Request::url() == route('unread') ? 'active' : '' }}">
                <a href="{{ route('unread') }}" title="Sent">UnRead({{ $unread }})</a>
            </li>
        </ul>
        <h6 class="b-b p-10 text-strong">Contacts</h6>
        <ul class="online-user mr-3" id="online-offline">
            @forelse ($contacts as $contact)
                <li><a href="{{ route('user-profile', ['user_id' => $contact->receiver->employee_id]) }}"> <img
                            alt="image" src="{{ asset('storage/' . $contact->receiver->image) }}"
                            class="rounded-circle" width="35" data-toggle="tooltip" title=""
                            data-original-title="{{ $contact->receiver->firstname . ' ' . $contact->receiver->lastname }}">
                        {{ $contact->receiver->firstname . ' ' . $contact->receiver->lastname }}
                    </a></li>
            @empty
                <p>You Have No Contacts</p>
            @endforelse

        </ul>

    </div>

</div>
