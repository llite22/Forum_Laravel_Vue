<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('sections', \App\Http\Controllers\SectionController::class);
    Route::resource('branches', \App\Http\Controllers\BranchController::class);
    Route::resource('themes', \App\Http\Controllers\ThemeController::class);
    Route::resource('messages', \App\Http\Controllers\MessageController::class);

    Route::get('sections/{section}/branches', [\App\Http\Controllers\SectionController::class, 'branchIndex']);
    Route::get('sections/{section}/branches_except/{branch}', [\App\Http\Controllers\SectionController::class, 'branchIndexExcept']);

    Route::get('branches/{branch}/theme/create', [\App\Http\Controllers\BranchController::class, 'themeCreate'])
        ->name('branches.theme.create');

    Route::post('messages/{message}/likes', [\App\Http\Controllers\MessageController::class, 'toggleLike'])
        ->name('messages.likes.toggle');

    Route::post('messages/{message}/complaints', [\App\Http\Controllers\MessageController::class, 'storeComplaint'])
        ->name('messages.complaints.store');

    Route::get('users/personal', [\App\Http\Controllers\UserController::class, 'personal'])
        ->name('users.personal');
    Route::patch('users/personal', [\App\Http\Controllers\UserController::class, 'update'])
        ->name('users.personal');

    Route::post('/images', [\App\Http\Controllers\ImageController::class, 'store']);

    Route::get('/admin', [\App\Http\Controllers\Admin\MainController::class, 'index'])
        ->name('admin.main.index');

    Route::get('/admin/complaints', [\App\Http\Controllers\Admin\ComplaintController::class, 'index'])
        ->name('admin.complaints.index');

    Route::patch('/admin/complaints/{complaint}', [\App\Http\Controllers\Admin\ComplaintController::class, 'update'])
        ->name('admin.complaints.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
