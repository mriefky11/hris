@extends('layouts.dashboard')

@section('content')
<div class="page-heading">

    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Employee Detail</h3>
                <p class="text-muted">Detailed information about the employee.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $employee->fullname }}</h4>
                        <small class="text-muted">Employee ID: #{{ $employee->id }}</small>
                    </div>

                    <span class="badge {{ $employee->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ strtoupper($employee->status) }}
                    </span>
                </div>

                <hr>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Birth Date</label>
                        <p class="fw-bold">{{ $employee->birth_date }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Email</label>
                        <p class="fw-bold">{{ $employee->email }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Phone Number</label>
                        <p class="fw-bold">{{ $employee->phone_number }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Address</label>
                        <p class="fw-bold">{{ $employee->address }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Department</label>
                        <p class="fw-bold">{{ $employee->department->name }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Role</label>
                        <p class="fw-bold">{{ $employee->role->title }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Status</label>
                        <p class="fw-bold">{{ $employee->status }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Salary</label>
                        <p class="fw-bold">{{ $employee->salary }}</p>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                            Edit
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection