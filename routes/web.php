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
})->name('home');
Route::view('home','home');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/office/index', function () { return view('office.index'); })->name('office');
    Route::post('/office/create','App\Http\Controllers\OfficeController@create')->name('office.create');
    Route::get('/office','App\Http\Controllers\OfficeController@show')->name('show.office.create');
    Route::get('/office/access','App\Http\Controllers\OfficeController@showOffices')->name('show.offices');
    Route::get('/user/profile','App\Http\Controllers\UserController@showProfile')->name('show.user.profile');
    Route::post('/office/send/access/request/{id}','App\Http\Controllers\OfficeController@sendAccessRequest')->name('send.access.request');
    Route::post('/office/cancel/access/request/{id}','App\Http\Controllers\OfficeController@cancelAccessRequest')->name('cancel.access.request');

    Route::group(['prefix' => '/notifications'], function () {
        Route::get('/', 'App\Http\Controllers\HomeController@indexNotifications')->name('notifications.index');
        Route::post('/table', 'App\Http\Controllers\HomeController@tableNotifications')->name('notifications.table');
        Route::post('/read', 'App\Http\Controllers\HomeController@readNotifications')->name('notifications.read');
        Route::post('/mark/read', 'App\Http\Controllers\HomeController@markReadNotification')->name('notifications.read');

        Route::post('/load-more', 'App\Http\Controllers\HomeController@loadMoreNotifications')->name('notifications.load-more');

    });

Route::group(['middleware' => 'admin'], function () {
    Route::get('/office/edit','App\Http\Controllers\OfficeController@showEdit')->name('office.edit');
    Route::post('/office/delete','App\Http\Controllers\OfficeController@deleteOffice')->name('office.delete');

    Route::get('/office/workers','App\Http\Controllers\OfficeController@showAddWorkers')->name('office.workers');
    Route::post('/office/add/worker','App\Http\Controllers\OfficeController@addWorker')->name('add.worker');
    Route::post('/office/remove/worker/{id}','App\Http\Controllers\OfficeController@removeWorker')->name('remove.worker');

    Route::get('/office/access/requests','App\Http\Controllers\OfficeController@accessRequests')->name('office.access.requests');
    Route::post('/office/request/accept/{id}','App\Http\Controllers\OfficeController@acceptRequestfromUser')->name('accept.request.from.office');
    Route::post('/office/request/decline/{id}','App\Http\Controllers\OfficeController@declineRequestfromUser')->name('decline.request.from.office');

});
Route::group(['middleware' => 'worker'], function () {
Route::get('/calculator','App\Http\Controllers\CalculatorController@showcalculator')->name('calculator');
Route::post('/office/leave','App\Http\Controllers\OfficeController@leaveOffice')->name('office.leave');
Route::get('/office/home','App\Http\Controllers\OfficeController@showHome')->name('office.home');
Route::get('/office/home/directory','App\Http\Controllers\OfficeController@showDirectory')->name('office.directory');
Route::post('/office/client/natural/store','App\Http\Controllers\OfficeController@storeNatural')->name('natural.client.store');
Route::post('/office/client/legalentities/store','App\Http\Controllers\OfficeController@storeLegalEntities')->name('legalentities.client.store');
Route::post('/office/search/clients','App\Http\Controllers\OfficeController@searchClients');

});


});

Route::get('/office/accept/{email}/{office_id}','App\Http\Controllers\OfficeController@acceptRequestfromOffice')->name('accept.request');
