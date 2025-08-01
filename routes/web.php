<?php


use App\Http\Controllers\TrainingDashboardController;
use App\Http\Controllers\TrainingBlockController;
use App\Http\Controllers\TrainingSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Welcome page - shows MMA Training app info
Route::get('/', function () {
    return Inertia::render('welcome', [
        'auth' => [
            'user' => Auth::user(),
        ],
    ]);
})->name('home');

// Training Dashboard - main authenticated landing page
Route::get('/dashboard', [TrainingDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Training management routes (authenticated users only)
Route::middleware(['auth', 'verified'])->group(function () {
    // Training Blocks
    Route::resource('training-blocks', TrainingBlockController::class);
    
    // Training Sessions  
    Route::resource('training-sessions', TrainingSessionController::class);
    

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';