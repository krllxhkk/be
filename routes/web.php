<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TandartsController;
use App\Http\Controllers\AssistentController;
use App\Http\Controllers\MondhygienistController;
use App\Http\Controllers\PraktijkmanagementController;
use App\Http\Controllers\PatientController;  // <-- ДОБАВИТЬ!
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tandarts', TandartsController::class);
Route::resource('assistent', AssistentController::class);
Route::resource('mondhygienist', MondhygienistController::class);
// Route::resource('praktijkmanagement', PraktijkmanagementController::class);
Route::resource('patient', PatientController::class);  // <-- ДОБАВИТЬ!

// ИЛИ если не хочешь создавать PatientController, используй dashboard
// Route::resource('patient', PatientController::class);  // раскомментируй когда создашь

Route::get('/tandarts', [TandartsController::class, 'index'])
    ->name('tandarts.index')
    ->middleware(['auth', 'verified', 'role:tandarts,praktijkmanagement']);  // убрал пробел

Route::get('/patient', [PatientController::class, 'index'])
    ->name('patient.index')
    ->middleware(['auth', 'verified', 'role:patient,praktijkmanagement']);
    
Route::get('/assistent', [AssistentController::class, 'index'])
    ->name('assistent.index')
    ->middleware(['auth', 'verified', 'role:assistent,praktijkmanagement']);

Route::get('/mondhygienist', [MondhygienistController::class, 'index'])
    ->name('mondhygienist.index')
    ->middleware(['auth', 'verified', 'role:mondhygienist,praktijkmanagement']);

# Praktijkmanagement routes
    Route::get('/praktijkmanagement/userroles', [PraktijkmanagementController::class, 'manageUserroles'])
    ->name('praktijkmanagement.userroles')
    ->middleware(['auth', 'role:praktijkmanagement']);
    Route::resource('praktijkmanagement', PraktijkmanagementController::class);

//     Route::put('/praktijkmanagement/{id}/edit',[PraktijkmanagementController::class,'edit'])
//     ->name('praktijkmanagement.edit')
//     ->middleware(['auth','role:praktijkmanagement']);

// Route::delete('/praktijkmanagement/{id}',[PraktijkmanagementController::class,'destroy'])
//     ->name('praktijkmanagement.destroy')
//     ->middleware(['auth','role:praktijkmanagement']);

// Route::get('/praktijkmanagement/{id}',[PraktijkmanagementController::class,'show'])
//     ->name('praktijkmanagement.show')
//     ->middleware(['auth','role:praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  // <-- УДАЛИЛ ДУБЛИКАТ

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';