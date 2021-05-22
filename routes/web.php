<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\IncidentsTable;
use App\Http\Livewire\UsersTable;

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
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
     Route::get('/incidents', function () {
        return view('incidents');
    })->name('incidents');
     Route::get('/users', function () {
        return view('users');
    })->name('users');

    // Route::get('/incidents', IncidentsTable::class)->name('incidents');
    // Route::get('/users', UsersTable::class)->name('users');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/incidents', function () {
//     return view('incidents');
// })->name('incidents');

// Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
//     return view('users');
// })->name('users');