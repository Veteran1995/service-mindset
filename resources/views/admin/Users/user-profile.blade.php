@extends('layouts.admin')

@section('content')
    <livewire:admin.users.user-profile :user_id="$user_id" />
@endsection
