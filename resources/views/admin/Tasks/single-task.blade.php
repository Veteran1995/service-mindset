@extends('layouts.admin')

@section('content')
    <livewire:admin.task.single-task :task_id="$task_id" />
@endsection
