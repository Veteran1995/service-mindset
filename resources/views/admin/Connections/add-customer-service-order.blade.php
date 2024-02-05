@extends('layouts.admin')

@section('content')
    <livewire:admin.connections.add-customer-service-order :customer_id="$customer_id" />
@endsection
