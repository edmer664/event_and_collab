<?php

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

// route group admin
Route::prefix('admin')->group(function () {
    // login
    Route::get('/login', [AuthController::class,'adminLogin'])->name('admin.login');


    // authenticated routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard',[])->name('admin.dashboard');
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
    })->name('user.login');

    Route::group(['middleware' => 'auth'], function () {
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
    })->name('organization.login');

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
Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');