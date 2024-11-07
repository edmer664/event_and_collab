<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentController;
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
        return redirect()->route('student.dashboard');
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
    Route::group(['middleware' => ['admin','auth']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/organizations', [AdminController::class, 'organizations'])->name('admin.organizations');
        Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
        Route::get('/profile', function () {
            return 'Admin Profile';
        });
    });
});

// route group student
Route::prefix('student')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'studentLogin'])->name('student.login')->middleware('guest');
    // register
    Route::get('/register', [AuthController::class, 'studentRegister'])->name('student.register')->middleware('guest');
    Route::post('/register', [AuthController::class, 'studentStore'])->name('student.store')->middleware('guest');

    Route::group(['middleware' => ['auth', 'student']], function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        Route::get('/profile', function () {
            return 'User Profile';
        });
        Route::get('/events', [StudentController::class, 'events'])
            ->name('student.events');
    });
});

// route group organization
Route::prefix('organization')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'organizationLogin'])->name('organization.login')->middleware('guest');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [OrganizationController::class, 'dashboard'])->name('organization.dashboard');
        Route::get('/profile', function () {
            return 'Organization Profile';
        });
    });
});

//auth
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
