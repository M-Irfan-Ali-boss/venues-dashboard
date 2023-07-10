<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VenueController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');

    Route::get('/dashboard/staff/create', function () {
        return Inertia::render('Staff/Create/CreateStaff');
    })->name('createStaff');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/staff', [StaffController::class, 'index'])->name('staff');
    Route::get('/dashboard/staff/edit/{staffId}', [StaffController::class, 'edit'])->name('editStaff');
    Route::get('/dashboard/staff/delete/{staffId}', [StaffController::class, 'destroy'])->name('deleteStaff');
    Route::get('/dashboard/venue', [VenueController::class, 'index'])->name('venue');
    Route::get('/dashboard/venue/create', [VenueController::class, 'createVenue'])->name('createVenue');
    Route::get('/dashboard/venue/edit/{venueId}', [VenueController::class, 'edit'])->name('editVenue');
    Route::get('/dashboard/venue/delete/{venueId}', [VenueController::class, 'destroy'])->name('deleteVenue');
});

require __DIR__.'/auth.php';