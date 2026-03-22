<?php

use App\Http\Controllers\CareGiverController;
use App\Http\Controllers\CaregiverListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElderController;
use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\NurseListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/firebase-users', [FirebaseController::class, 'getCaregivers']);

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    //Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'getUsers'])
        ->name('dashboard');


    //Elder routes
    Route::get('/elder', [ElderController::class, 'getElders'])
        ->name('elder');

    Route::get('/elder/{id}', [ElderController::class, 'elderInfo'])
        ->name('elderInfo');

    Route::get('/elder/{id}/edit', [ElderController::class, 'edit'])
        ->name('elder.edit');

    Route::put('/elder/{id}', [ElderController::class, 'update'])
        ->name('elder.update');

    Route::delete('/admin/elder/{id}', [ElderController::class, 'delete'])
        ->name('elder.delete');


    //Caregiver Routes
    Route::get('/care-giver', [CareGiverController::class, 'getCaregivers'])
        ->name('caregiver');

    Route::get('/care-giver/{id}', [CareGiverController::class, 'caregiverInfo'])
        ->name('caregiverInfo');

    Route::get('/care-giver/{id}/edit', [CareGiverController::class, 'edit'])
        ->name('caregiver.edit');

    Route::put('/care-giver/{id}', [CareGiverController::class, 'update'])
        ->name('caregiver.update');

    Route::delete(
        '/caregiver/{caregiverId}/prescription/{prescriptionId}',
        [CareGiverController::class, 'deleteRecord']
    )->name('caregiver.prescription.delete');

    Route::delete(
        '/caregiver/{caregiverId}/observation/{observationId}',
        [CareGiverController::class, 'deleteRecord']
    )->name('caregiver.observation.delete');


    //Nurse Routes
    Route::get('/nurse', [NurseController::class, 'getNurses'])
        ->name('nurse');

    Route::get('/nurse/{id}', [NurseController::class, 'nurseInfo'])
        ->name('nurseInfo');

    Route::get('/nurse/{id}/edit', [NurseController::class, 'edit'])
        ->name('nurse.edit');

    Route::put('/nurse/{id}', [NurseController::class, 'update'])
        ->name('nurse.update');
    Route::delete('/admin/nurse/{id}', [NurseController::class, 'delete'])
        ->name('nurse.delete');


    // Employee Lists

    // Nurse
    Route::get('/nurse-lists', [NurseListController::class, 'getNurseLists'])
        ->name('nurse-list');

    Route::post('/nurse-lists', [NurseListController::class, 'store'])
        ->name('nurse-list.store');

    Route::get('/nurse-lists/create', [NurseListController::class, 'create'])
        ->name('nurse-list.create');


    // Caregiver
    Route::get('/caregiver-lists', [CaregiverListController::class, 'getCaregiverLists'])
        ->name('caregiver-list');

    Route::post('/caregiver-lists', [CaregiverListController::class, 'store'])
        ->name('caregiver-list.store');

    Route::get('/caregiver-lists/create', [CaregiverListController::class, 'create'])
        ->name('caregiver-list.create');


    // Employee Request
    Route::get('/employee-request', [EmployeeRequestController::class, 'getEmployeeRequests'])
        ->name('employee-request');

    Route::post('/employee-request/{role}/{id}/approve', [EmployeeRequestController::class, 'approveEmployee'])
        ->name('employee-request.approve');

    Route::post('/employee-request/{role}/{id}/reject', [EmployeeRequestController::class, 'rejectEmployee'])
        ->name('employee-request.reject');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
