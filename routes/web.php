<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin|charge_projet'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}',[EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/events/{event}/validate', [EventController::class, 'validateEvent'])->name('events.validate');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/keywords', [KeywordController::class, 'index'])->name('keywords.index');
    Route::get('/keywords/create', [KeywordController::class, 'create'])->name('keywords.create');
    Route::post('/keywords', [KeywordController::class, 'store'])->name('keywords.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('/types', [TypeController::class, 'store'])->name('types.store');
    Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update');
    Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy');
});



