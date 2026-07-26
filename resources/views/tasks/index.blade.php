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
                <h3>Tasks</h3>
                <p class="text-subtitle text-muted">Manage tasks data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Tasks</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex ">
                    <a href="{{route('tasks.create')}}" class="btn btn-primary ms-auto mb-3">New Task</a>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $tasks as $task )
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{$task->employee->fullname}}</td>
                            <td>{{$task->due_date_formatted }}</td>
                            <td>
                                <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="form-select form-select-sm border-0 text-white fw-bold
                                            @if ($task->status == 'done') bg-success
                                            @elseif ($task->status == 'pending') bg-warning text-dark
                                            @elseif ($task->status == 'in-progress') bg-info
                                            @else bg-secondary
                                            @endif
                                            "
                                        style="width:auto; cursor:pointer;">
                                        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </form>
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="{{ $task->id }}"
                                    data-title="{{ $task->title }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="deleteForm">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Task</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <strong id="taskTitle"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.dataset.id;
                let title = this.dataset.title;

                let form = document.getElementById('deleteForm');
                form.action = `/tasks/${id}`;

                document.getElementById('taskTitle').innerText = title;
            });
        });
    });

    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('click', function() {

            let form = this.closest('form');
            let input = form.querySelector('.status-input');

            let current = input.value;

            let nextStatus = {
                'todo': 'pending',
                'pending': 'in-progress',
                'in-progress': 'done',
                'done': 'todo'
            };

            input.value = nextStatus[current];

            form.submit();
        });
    });
</script>

@endsection