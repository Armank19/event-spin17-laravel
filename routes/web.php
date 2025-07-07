<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\SpinController;

// ---------------- Register Routes ----------------
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');

Route::get('/register-success', function () {
    $nama = session('nama');
    $id_karyawan = session('id_karyawan');
    return view('register-success', compact('nama', 'id_karyawan'));
})->name('register.success');

// ---------------- Dashboard Routes ----------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/statistik', [DashboardController::class, 'statistik'])->name('dashboard.statistik');
Route::get('/dashboard/participant', [DashboardController::class, 'participant'])->name('dashboard.participant');
Route::delete('/dashboard/participant/delete-selected', [DashboardController::class, 'deleteSelected'])->name('dashboard.participant.deleteSelected');
Route::post('/dashboard/participant/delete-selected', [DashboardController::class, 'deleteSelected'])->name('participant.deleteSelected');

// ---------------- Check-in Routes ----------------
Route::get('/checkin', [CheckinController::class, 'show'])->name('checkin');
Route::post('/checkin', [CheckinController::class, 'submit'])->name('checkin.submit');
Route::get('/checkin/success', [CheckinController::class, 'success'])->name('checkin.success');

// ---------------- Spin Routes ----------------
Route::get('/dashboard/spin', [SpinController::class, 'index'])->name('dashboard.spin');
Route::get('/dashboard/spin/perform', [SpinController::class, 'performSpin'])->name('spin.perform');
Route::post('/dashboard/spin/clear', [SpinController::class, 'clearHistory'])->name('spin.clear');


// ---------------- Layout Test Route (opsional) ----------------
Route::get('/layout', function () {
    return view('layout');
});
