@extends('layouts.dashboard')

@section('content')
<div class="page-heading">

    <div class="page-title mb-3">
        <h3>Task Detail</h3>
        <p class="text-muted">Detailed information about the task.</p>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $task->title }}</h4>
                        <small class="text-muted">Task ID: #{{ $task->id }}</small>
                    </div>

                    <span class="badge 
                        @if ($task->status == 'done') bg-success
                        @elseif ($task->status == 'pending') bg-warning text-dark
                        @elseif ($task->status == 'in-progress') bg-info
                        @else bg-secondary
                        @endif
                    ">
                        {{ strtoupper($task->status) }}
                    </span>
                </div>

                <hr>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Assigned To</label>
                        <p class="fw-bold">{{ $task->employee->fullname }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Due Date</label>
                        <p class="fw-bold">{{ $task->due_date_formatted }}</p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Description</label>
                        <p class="fw-bold">
                            {{ $task->description ?? 'No description provided.' }}
                        </p>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection