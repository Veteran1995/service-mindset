@extends('layouts.admin')


@section('content')
    <div>
        <livewire:admin.customers.customer-profile :customer_id="$customer_id" />
    </div>
@endsection
