<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware'=>'auth','namespace'=>'admin'], function () {

    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('users','UsersController');
    Route::resource('contributions', 'ContributionsController');
    Route::resource('loans', 'LoansController');
    Route::resource('projects', 'ProjectsController');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');

});
