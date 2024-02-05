@extends('layouts.admin')

@section('content')
    <livewire:admin.task.reading-task-detail :task_id="$task_id" />
@endsection
