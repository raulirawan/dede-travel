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


Route::prefix('admin')
// ->middleware(['auth','admin'])
->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');

    // CRUD CUSTOMER
    Route::get('customer', 'Admin\CustomerController@index')->name('admin.customer.index');
    Route::post('customer/create', 'Admin\CustomerController@store')->name('admin.customer.store');
    Route::post('customer/update/{id}', 'Admin\CustomerController@update')->name('admin.customer.update');
    Route::get('customer/delete/{id}', 'Admin\CustomerController@delete')->name('admin.customer.delete');


});
