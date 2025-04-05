<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\HomeController;
use App\Livewire\Blog\PostForm;
use App\Livewire\Blog\PostManagement;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('frontend.index');
});

Route::get('/index', [HomeController::class, 'index'])->name('frontend.index');
Route::get('/course', [CourseController::class, 'courses'])->name('frontend.course');
Route::get('/blog', [BlogController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/{post}', [BlogController::class, 'post'])->name('frontend.post');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/admin/blog', PostManagement::class)->name('admin.blog');
Route::get('/admin/blog/form/{id?}', PostForm::class)->name('admin.blog.form');

require __DIR__ . '/auth.php';
