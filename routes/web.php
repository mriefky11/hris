<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/tasks', TaskController::class);

Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');

Route::resource('/employees', EmployeeController::class);
Route::resource('/departments', DepartmentController::class);
Route::resource('/roles', RoleController::class);
Route::prefix('/attendances')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/{id}', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('attendances.checkin');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('attendances.checkout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
