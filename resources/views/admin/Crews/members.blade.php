@extends('layouts.admin')

@section('content')
    <livewire:admin.crews.members :crew_id="$crew_id" />
@endsection
