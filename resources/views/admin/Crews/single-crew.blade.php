@extends('layouts.admin')

@section('content')
    <livewire:admin.crews.single-crew :crew_id="$crew_id" />
@endsection
