<?php

use App\Models\costum\dbCreate;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
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

Route::get('/', function () {
    return view('Home');
});

Route::get('/dbCreate', function () {
    $db = new dbCreate();
    echo $db->dbExists();
    // $db->dbMake(false);
    // return 'CREATED';
});

/**
 * Middleware Localization for Multiple languanges
 * Must register on Kernel
 */
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


Route::group(['middleware' => 'MyAuth'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::resource('/Students', StudentsController::class);
    Route::resource('/Departments', DepartmentsController::class);
    //     // Logout Routes
    Route::get('/logout', [LoginController::class, 'logout']);


    Route::get('/Dashboard', [DashboardController::class, 'index']);
});