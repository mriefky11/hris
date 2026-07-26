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
                <h3>Roles</h3>
                <p class="text-subtitle text-muted">Manage Roles data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex ">
                    <a href="{{route('roles.create')}}" class="btn btn-primary ms-auto mb-3">New Role</a>
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
                            <th>Description</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $roles as $role )
                        <tr>
                            <td>{{ $role->title }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="d-flex justify-content-end gap-2">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="{{ $role->id }}"
                                    data-title="{{ $role->title }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
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
                        <h5 class="modal-title">Delete role</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete this role <strong id="roleTitle"></strong>?</p>
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
                form.action = `/roles/${id}`;

                document.getElementById('roleTitle').innerText = title;
            });
        });
    });
</script>
@endsection