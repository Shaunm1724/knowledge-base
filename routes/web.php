<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'chat')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware('auth')->group(function () {
    Route::get('add-document', [DocumentController::class, 'showAddDoc'])->name('document.add.page');
    Route::post('add-document', [DocumentController::class, 'addDoc'])->name('document.add');
    Route::get('chat', [DocumentController::class, 'chatPage'])->name('chat.page');
    Route::post('chat-request', [DocumentController::class, 'chatRequest'])->name('chat.request');
});

require __DIR__.'/auth.php';
