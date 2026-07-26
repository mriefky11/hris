@extends('layouts.dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h3>
                <p class="text-subtitle text-muted">
                    {{ isset($task) ? 'Update task' : 'Create new task' }}
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="">Tasks</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
                    @csrf
                    @if(isset($task))
                    @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter task title" value="{{ old('title', $task->title ?? '') }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input
                                type="datetime-local"
                                class="form-control @error('due_date') is-invalid @enderror"
                                id="due_date"
                                name="due_date"
                                value="{{ old('due_date', isset($task) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '') }}"
                                required>
                            @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="assigned_to" class="form-label">Assigned To</label>
                            <select class="form-select @error('assigned_to') is-invalid @enderror" name="assigned_to" required>
                                <option value="">Select an Employee</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('assigned_to', $task->assigned_to ?? '') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="">Select an Status</option>
                                <option value="todo" {{ old('status', $task->status ?? '') == 'todo' ? 'selected' : '' }}>Todo</option>
                                <option value="done" {{ old('status', $task->status ?? '') == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="pending" {{ old('status', $task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="on-progress" {{ old('status', $task->status ?? '') == 'on-progress' ? 'selected' : '' }}>On Progress</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" style="height: 150px">{{ old('description', $task->description ?? '') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"> {{ isset($task) ? 'Update Task' : 'Create Task' }}</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
                </form>
            </div>
        </div>

    </section>
</div>

@endsection