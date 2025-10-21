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

Route::get('/compose-new-message', [EmailController::Class, 'composeNewMessage'])->name('compose-new-message');
Route::get('/inbox', [EmailController::Class, 'inbox'])->name('inbox');
Route::post('/api/emails', [EmailController::Class, 'sendEmail'])->name('send-mail');
require __DIR__.'/settings.php';
