<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'HomeController@landing')->name('home');

    // ADMIN ROUTES
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::get('login', 'AuthController@loginForm')->name('login.form');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::post('login-submit', 'AuthController@login')->name('login.post');

        // ADMIN AUTH ROUTES

        Route::group(['middleware' => ['auth', 'admin']], function () {

            Route::get('/', function () {
                if (Auth::check()) {
                    return redirect(route('admin.blogs.index'));
                }
                return redirect(route('admin.login.form'));
            })->name('home');

            Route::resource('blogs', 'BlogController');

        });
    });
});
