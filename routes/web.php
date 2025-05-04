<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\DiscussionShowController;
use App\Http\Controllers\DiscussionStoreController;

Route::get('/', ForumIndexController::class)->name('home');
Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');

Route::post('/markdown', MarkdownController::class)->name('markdown');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/discussions', DiscussionStoreController::class)->name('discussions.store');
    Route::post('/discussions/{discussion}/posts', PostStoreController::class)->name('posts.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
