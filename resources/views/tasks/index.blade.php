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
                        <li class="breadcrumb-item"><a href="">Tasks</a></li>
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
                                @if ($task->status == 'done')
                                <span class="badge bg-success">{{$task->status}}</span>
                                @elseif ($task->status == 'pending')
                                <span class="badge bg-warning">{{$task->status}}</span>
                                @elseif ($task->status == 'in-progress')
                                <span class="badge bg-info">{{$task->status}}</span>
                                @else
                                <span class="badge bg-secondary">{{$task->status}}</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="" class="btn btn-primary btn-sm">View</a><a href="" class="btn btn-warning btn-sm">Edit</a>
                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection