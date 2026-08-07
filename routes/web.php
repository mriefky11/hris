<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.updateStatus');

    Route::middleware('admin')->group(function () {
        Route::resource('/employees', EmployeeController::class);
        Route::resource('/departments', DepartmentController::class);
        Route::resource('/roles', RoleController::class);

        Route::resource('/payrolls', PayrollController::class)->except(['index', 'show']);

        Route::patch('/leaves/{leave}/status', [LeaveController::class, 'updateStatus'])
            ->name('leaves.updateStatus');
        Route::patch('/overtimes/{overtime}/status', [OvertimeController::class, 'updateStatus'])
            ->name('overtimes.updateStatus');
    });

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/{id}', [AttendanceController::class, 'show'])->name('attendances.show');

    Route::middleware('employee')->group(function () {
        Route::post('/attendances/check-in', [AttendanceController::class, 'checkIn'])->name('attendances.checkin');
        Route::post('/attendances/check-out', [AttendanceController::class, 'checkOut'])->name('attendances.checkout');

        Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
        Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
        Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy');

        Route::get('/overtimes/create', [OvertimeController::class, 'create'])->name('overtimes.create');
        Route::post('/overtimes', [OvertimeController::class, 'store'])->name('overtimes.store');
        Route::delete('/overtimes/{overtime}', [OvertimeController::class, 'destroy'])->name('overtimes.destroy');
    });

    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/leaves/{leave}', [LeaveController::class, 'show'])->name('leaves.show');

    Route::get('/overtimes', [OvertimeController::class, 'index'])->name('overtimes.index');
    Route::get('/overtimes/{overtime}', [OvertimeController::class, 'show'])->name('overtimes.show');

    Route::get('/payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
    Route::get('/payrolls/{payroll}', [PayrollController::class, 'show'])->name('payrolls.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
