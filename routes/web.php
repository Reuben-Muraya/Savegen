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
    Route::resource('expenses', 'ExpensesController');
    
    //Project Status Update
    Route::put('/project/{id}/complete', 'ProjectsController@complete')->name('projects.complete');
    Route::put('/project/{id}/fail', 'ProjectsController@fail')->name('projects.fail');
    
    //Loan Status Update
    Route::put('/loan/{id}/pay', 'LoansController@pay')->name('loans.pay');
    Route::put('/loan/{id}/default', 'LoansController@default')->name('loans.default');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassword')->name('password.update');

    Route::get('paid/loans', 'LoansController@paid')->name('loans.paid');
    Route::get('defaulted/loans', 'LoansController@defaulted')->name('loans.defaulted');

    Route::get('completed/projects', 'ProjectsController@completed')->name('projects.completed');
    Route::get('failed/projects', 'ProjectsController@failed')->name('projects.failed');

});
