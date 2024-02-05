@extends('layouts.admin')

@section('content')
    <livewire:admin.connections.view-single-service-order :service_order_id="$service_order_id" />
@endsection
