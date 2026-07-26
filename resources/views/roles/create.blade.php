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
                <h3>{{ isset($role) ? 'Edit Roles' : 'Create Roles' }}</h3>
                <p class="text-subtitle text-muted">
                    {{ isset($role) ? 'Update Roles' : 'Create new Roles' }}
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item">{{ isset($role) ? 'Update' : 'Create' }}</li>
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
                <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
                    @csrf
                    @if(isset($role))
                    @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="HR" value="{{ old('title', $role->title ?? '') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="description" class="form-label">description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" style="height: 100px">{{ old('description', $role->description ?? '') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> {{ isset($role) ? 'Update Roles' : 'Create Roles' }}</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles List</a>
                </form>
            </div>
        </div>

    </section>
</div>

@endsection