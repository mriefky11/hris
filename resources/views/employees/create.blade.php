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
                <h3>{{ isset($employee) ? 'Edit employee' : 'Create employee' }}</h3>
                <p class="text-subtitle text-muted">
                    {{ isset($employee) ? 'Update employee' : 'Create new employee' }}
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops! Something went wrong.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
                    @csrf
                    @if(isset($employee))
                    @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="John Doe" value="{{ old('fullname', $employee->fullname ?? '') }}">
                            @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="email" class="form-label">email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="johndoe@gmail.com" value="{{ old('email', $employee->email ?? '') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input
                                type="date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date', isset($employee) ? ($employee->birth_date) : '') }}">
                            @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input
                                type="date"
                                class="form-control @error('hire_date') is-invalid @enderror"
                                id="hire_date"
                                name="hire_date"
                                value="{{ old('hire_date', isset($employee) ? ($employee->hire_date) : '') }}">
                            @error('hire_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-select @error('role_id') is-invalid @enderror" name="role_id">
                                <option value="">Select an Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $employee->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                    {{ $role->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select @error('department_id') is-invalid @enderror" name="department_id">
                                <option value="">Select an Department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="0812312313" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
                            @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" id="salary" placeholder="5000000" value="{{ old('salary', $employee->salary ?? '') }}">
                            @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" style="height: 100px">{{ old('address', $employee->address ?? '') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="">Select an Status</option>
                                <option value="active" {{ old('status', $employee->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $employee->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> {{ isset($employee) ? 'Update Employee' : 'Create Employee' }}</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employee List</a>
                </form>
            </div>
        </div>

    </section>
</div>

@endsection