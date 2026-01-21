<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AdminController;

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

// Public Routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/location', 'location')->name('location');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy');
});

// Auth Routes
Route::middleware(['norobots'])->group(function () {
    Route::get('/emx-admin', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::prefix('admin')->middleware(['admin.auth', 'nocache', 'norobots'])->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/site-settings', 'siteSettings')->name('site-settings');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/services', 'services')->name('services');
    Route::get('/pages', 'pages')->name('pages');
    Route::get('/users', 'users')->name('users');
    Route::get('/reviews', 'reviews')->name('reviews');
    Route::get('/account', 'account')->name('account');

    // Individual Page Editors
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/home', 'pagesHome')->name('home');
        Route::get('/about', 'pagesAbout')->name('about');
        Route::get('/contact', 'pagesContact')->name('contact');
        Route::get('/location', 'pagesLocation')->name('location');
        Route::get('/privacy', 'pagesPrivacy')->name('privacy');
        Route::get('/services', 'pagesServices')->name('services');
        Route::get('/terms', 'pagesTerms')->name('terms');
    });
});
