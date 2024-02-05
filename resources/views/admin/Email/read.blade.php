@extends('layouts.admin')

@section('content')
    <livewire:admin.email.read :email_id="$email_id" />
@endsection
