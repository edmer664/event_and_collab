<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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
})->name('login');

Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role == 'student') {
        return redirect()->route('user.dashboard');
    } elseif (auth()->user()->role == 'organization') {
        return redirect()->route('organization.dashboard');
    }
    abort(404);
})->name('dashboard')
    ->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route group admin
Route::prefix('admin')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'adminLogin'])->name('admin.login')->middleware('guest');


    // authenticated routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', function () {
            return 'Admin Profile';
        });
    });
});

// route group user
Route::prefix('user')->group(function () {
    // login
    Route::get('/login', function () {
        return 'User Login';
    })->name('user.login')->middleware('guest');

    Route::group(['middleware' => ['auth', 'student']], function () {
        Route::get('/dashboard', function () {
            return 'User Dashboard';
        })->name('dashboard');
        Route::get('/profile', function () {
            return 'User Profile';
        });
    });
});

// route group organization
Route::prefix('organization')->group(function () {
    // login
    Route::get('/login', function () {
        return 'Organization Login';
    })->name('organization.login')->middleware('guest');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', function () {
            return 'Organization Dashboard';
        });
        Route::get('/profile', function () {
            return 'Organization Profile';
        });
    });
});

//auth
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
