<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// route group admin
Route::prefix('admin')->group(function () {
    // login
    Route::get('/login', function () {
        return 'Admin Login';
    })->name('admin.login');


    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
    Route::get('/profile', function () {
        return 'Admin Profile';
    });
});

// route group user
Route::prefix('user')->group(function () {
    // login
    Route::get('/login', function () {
        return 'User Login';
    })->name('user.login');

    Route::get('/dashboard', function () {
        return 'User Dashboard';
    });
    Route::get('/profile', function () {
        return 'User Profile';
    });
});

// route group organization
Route::prefix('organization')->group(function () {
    // login
    Route::get('/login', function () {
        return 'Organization Login';
    })->name('organization.login');

    Route::get('/dashboard', function () {
        return 'Organization Dashboard';
    });
    Route::get('/profile', function () {
        return 'Organization Profile';
    });
});
