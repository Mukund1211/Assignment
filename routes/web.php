<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BooksController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// login Authentication
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['AuthChack'])->group(function () {
    // login form
    Route::get('/', [LoginController::class, 'viewLoginForm'])->name('login_view')->middleware("throttle:5,2");

    // Book Routes
    Route::get('/books/get', [BooksController::class, 'getBooks'])->name('getBooks');
    Route::get('/books/list', [BooksController::class, 'showBooks'])->name('showBooks');

    // logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});