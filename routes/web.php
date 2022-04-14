<?php

use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PasswordForgotController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('users', [UserController::class, 'home'])->middleware('auth');
Route::get('users/{user}', [UserController::class, 'show'])->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('/forgot-password', [PasswordForgotController::class, 'create'])->middleware('guest');
Route::post('/forgot-password', [PasswordForgotController::class, 'store'])->middleware('guest');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'store'])->middleware('guest');

Route::get('users/{user}/change-password', [PasswordChangeController::class, 'create'])->middleware('auth');
Route::post('users/{user}/change-password', [PasswordChangeController::class, 'store'])->middleware('auth');

Route::get('users/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth');
Route::patch('users/{user}/edit', [ProfileController::class, 'update'])->middleware('auth');

Route::get('users/{user}/upload-picture', [PictureController::class, 'create'])->middleware('auth');
Route::post('users/{id}/upload-picture', [PictureController::class, 'store'])->middleware('auth');

Route::post('users/{id}/upload-images', [ImageController::class, 'store'])->middleware('auth');
Route::post('users/{user}/delete-image/{userImage}', [ImageController::class, 'delete'])->middleware('auth');

Route::post('users/{user}/like', [MatchController::class, 'like'])->middleware('auth');
Route::post('users/{user}/dislike', [MatchController::class, 'dislike'])->middleware('auth');
Route::get('users/{user}/matches', [MatchController::class, 'index'])->middleware('auth');

Route::get('users/{user}/preferences', [PreferenceController::class, 'create'])->middleware('auth');
Route::post('users/{user}/preferences', [PreferenceController::class, 'store'])->middleware('auth');
Route::post('users/{user}/clear-preferences', [PreferenceController::class, 'clear'])->middleware('auth');

Route::get('users/{user}/description', [DescriptionController::class, 'create'])->middleware('auth');
Route::post('users/{user}/description', [DescriptionController::class, 'store'])->middleware('auth');


