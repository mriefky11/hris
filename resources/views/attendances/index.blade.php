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
                <h3>Attendance</h3>
                <p class="text-subtitle text-muted">Employee attendance history.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="d-flex mb-3">
                    @if(!$todayAttendance)
                    <form action="{{ url('/attendances/check-in') }}" method="POST" class="ms-auto">
                        @csrf
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">
                        <input type="hidden" name="photo" id="photo">
                        <button class="btn btn-success">Clock In</button>
                    </form>

                    @elseif(!$todayAttendance->check_out_time)
                    <form action="{{ url('/attendances/check-out') }}" method="POST" class="ms-auto">
                        @csrf
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">
                        <input type="hidden" name="photo" id="photo">
                        <button class="btn btn-warning">Clock Out</button>
                    </form>

                    @else
                    <button class="btn btn-secondary ms-auto" disabled>
                        Completed Today
                    </button>
                    @endif
                </div>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->employee->fullname }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>
                                {{ $attendance->check_in_time 
                                    ? \Carbon\Carbon::parse($attendance->check_in_time)->format('H:i') 
                                    : '-' 
                                }}
                            </td>
                            <td>
                                {{ $attendance->check_out_time 
                                    ? \Carbon\Carbon::parse($attendance->check_out_time)->format('H:i') 
                                    : '-' 
                                }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('attendances.show', $attendance->id) }}"
                                        class="btn btn-info btn-sm">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $attendances->links() }}

            </div>
        </div>
    </section>
</div>

<script>
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById('lat').value = position.coords.latitude;
        document.getElementById('lng').value = position.coords.longitude;
    });
</script>
@endsection