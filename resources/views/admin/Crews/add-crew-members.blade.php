@extends('layouts.admin')

@section('content')
    <livewire:admin.crews.add-members :crew_id="$crew_id" />
@endsection
