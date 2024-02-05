@extends('layouts.admin')


@section('content')
    <div>
        <livewire:admin.meters.meter-detail :meter_id="$meter_id" />
    </div>
@endsection
