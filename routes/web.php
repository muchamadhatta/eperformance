<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes();
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::group(['middleware' => ['auth_sso', 'access']], function () {

Route::get('/', function () {
    return view('eperformance');
})->name('eperformance');
Route::get('/setjen', function () {
    return view('setjen');
})->name('setjen');

Route::get('/set-session/{id_website}', function ($id_website, Request $request) {
    $request->session()->put('id_website', $id_website);
    return redirect('/setjenweb');
})->name('set.session');


});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
