<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

/* 
Route::get('/', [UserController::class, 'index']);
Route::get('/create', [UserController::class, 'create']);
Route::post('store', [UserController::class, 'store'])->name(('users.store'));
 */

// Need for policy/custom middleware => only allow signed in user to edit its credentials
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('can:edit-user');
Route::get('users/login', [UserController::class, 'logInForm']);
Route::post('users/login', [UserController::class, 'login']);
Route::resource('users', UserController::class);
Route::get('', function () {
    echo auth()->user()->id .
        "<br>" . auth()->user()->firstName .
        "<br>" . auth()->user()->lastName;
});
