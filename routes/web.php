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
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', 'ProfilController@index')->name('profile.index');
    Route::post('/profile', 'ProfilController@update')->name('profile.update');
    Route::post('/profile/ganti-password', 'ProfilController@updatePassword')->name('profile.update.password');

    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::get('/transaksi/detail/{transaksi_id}', 'TransaksiController@detail')->name('transaksi.detail');

    Route::post('/add/review/{transaksi_id}', 'TransaksiController@addReview')->name('transaksi.add.review');

});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');
        Route::post('dashboard/pilih/tour-guide/{transaksi_id}', 'Admin\DashboardController@pilihTourGuide')->name('admin.dashboard.pilih.tour-guide');

        // CRUD CUSTOMER
        Route::get('customer', 'Admin\CustomerController@index')->name('admin.customer.index');
        Route::post('customer/create', 'Admin\CustomerController@store')->name('admin.customer.store');
        Route::post('customer/update/{id}', 'Admin\CustomerController@update')->name('admin.customer.update');
        Route::get('customer/delete/{id}', 'Admin\CustomerController@delete')->name('admin.customer.delete');

        // CRUD MASTER PAKET TRAVEL
        Route::get('paket-travel', 'Admin\PaketTravelController@index')->name('admin.paket-travel.index');
        Route::post('paket-travel/create', 'Admin\PaketTravelController@store')->name('admin.paket-travel.store');
        Route::post('paket-travel/update/{id}', 'Admin\PaketTravelController@update')->name('admin.paket-travel.update');
        Route::get('paket-travel/delete/{id}', 'Admin\PaketTravelController@delete')->name('admin.paket-travel.delete');

        // TRAVEL
        Route::get('paket-travel/jadwal/{paket_travel_id}', 'Admin\TravelController@index')->name('admin.travel.index');
        Route::get('paket-travel/jadwal/create/{paket_travel_id}', 'Admin\TravelController@create')->name('admin.travel.create');
        Route::post('paket-travel/jadwal/store', 'Admin\TravelController@store')->name('admin.travel.store');
        Route::get('paket-travel/jadwal/edit/{travel_id}', 'Admin\TravelController@edit')->name('admin.travel.edit');
        Route::post('paket-travel/jadwal/update', 'Admin\TravelController@update')->name('admin.travel.update');
        Route::get('paket-travel/jadwal/delete/{travel_id}', 'Admin\TravelController@delete')->name('admin.travel.delete');

        Route::get('paket-travel/tiket/{travel_id}', 'Admin\TravelController@tiket')->name('admin.travel.tiket.index');
        Route::post('paket-travel/tiket/{travel_id}', 'Admin\TravelController@updateTiket')->name('admin.travel.tiket.update.index');


        Route::get('transaksi', 'Admin\TransaksiController@index')->name('admin.transaksi.index');
        Route::get('transaksi/detail/{id}', 'Admin\TransaksiController@detail')->name('admin.transaksi.detail');


        // CRUD TOUR GUIDE
        Route::get('tour-guide', 'Admin\TourGuideController@index')->name('admin.tour-guide.index');
        Route::post('tour-guide/create', 'Admin\TourGuideController@store')->name('admin.tour-guide.store');
        Route::post('tour-guide/update/{id}', 'Admin\TourGuideController@update')->name('admin.tour-guide.update');
        Route::get('tour-guide/delete/{id}', 'Admin\TourGuideController@delete')->name('admin.tour-guide.delete');
    });


Route::prefix('tour-guide')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('dashboard', 'TourGuide\DashboardController@index')->name('tour.guide.dashboard.index');
        Route::post('upload-bukti/{transaksi_id}', 'TourGuide\DashboardController@uploadBukti')->name('tour.guide.upload.bukti.index');
    });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
