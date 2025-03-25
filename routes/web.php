<?php

use Inertia\Inertia;
use App\Models\Discussion;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\DiscussionShowController;

Route::get('/', ForumIndexController::class)->name('home');
Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
