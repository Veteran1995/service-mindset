@extends('layouts.admin')

@section('content')
    <livewire:admin.task.edit-task :task_id="$task_id" />
@endsection
