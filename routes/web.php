<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->to('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('incidents')->group(function () {
        Route::get('/', function () {
            return view('incidents');
        })->name('incidents');
        Route::get('create', \App\Http\Livewire\Incident\CreateIncident::class);
        Route::get('/{incident}', \App\Http\Livewire\Incident\ShowIncident::class);
        Route::get('edit/{incident}', \App\Http\Livewire\Incident\EditIncident::class);
    });
    Route::prefix('investigations')->group(function () {
        Route::get('create/{incidentId}', \App\Http\Livewire\Incident\Investigation\CreateInvestigation::class);
        Route::get('edit/{investigation}', \App\Http\Livewire\Incident\Investigation\EditInvestigation::class);
    });
    Route::prefix('actions')->group(function () {
        Route::get('create/{incidentId}', \App\Http\Livewire\Incident\Action\CreateAction::class);
        Route::get('edit/{action}', \App\Http\Livewire\Incident\Action\EditAction::class);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', function () {
            return view('users');
        })->name('users');
        Route::get('create', \App\Http\Livewire\User\Createuser::class);
        Route::get('edit/{incident}', \App\Http\Livewire\User\EditUser::class);
    });
});