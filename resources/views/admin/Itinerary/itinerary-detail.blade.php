@extends('layouts.admin')


@section('content')
    <div>
        <livewire:admin.itinerary-detail :itinerary_id="$itinerary_id" />
    </div>
@endsection
