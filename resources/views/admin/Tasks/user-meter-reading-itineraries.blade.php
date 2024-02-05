@extends('layouts.admin')

@section('content')
    <livewire:admin.task.user-meter-reading-itineraries :user_id="$user_id" />
@endsection
