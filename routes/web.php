<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/compose-new-message', [EmailController::class, 'composeNewMessage'])->name('compose-new-message');
    Route::get('/inbox', [EmailController::class, 'inbox'])->name('inbox');
    Route::post('/api/emails', [EmailController::class, 'sendEmail'])->name('send-mail');
});


require __DIR__.'/settings.php';
