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
Route::get('contact-api', function () {
    return view('contact-api');
});
Auth::routes(['verify' => true]);



// authenticated user routes
Route::group(['middleware' => ['auth']], function () {

    // verified user routes
    Route::group(['middleware'=>['verified']], function () {
        Route::get('/home', 'HomeController@index')->name('home');

        // sms routes
        Route::group(['prefix' => 'sms'], function () {
            Route::get('/compose', 'SmsController@compose')->name('compose-sms');
            Route::post('/save', 'SmsController@save')->name('save-message');
            Route::post('/send-composed', 'SmsController@sendComposed')->name('send-composed-message');
            Route::get('/sent', 'SmsController@sent')->name('sent-sms');
            Route::get('/draft', 'SmsController@draft')->name('draft');
            Route::get('/{slug}/edit', 'SmsController@edit')->name('edit-message');
            Route::post('/delete', 'SmsController@delete')->name('delete-message');
            Route::post('/schedule', 'SmsController@schedule')->name('shedule-message');
            Route::get('/scheduled', 'SmsController@scheduled')->name('scheduled-sms');
            Route::post('/delete-schedule', 'SmsController@deleteScheduled')->name('delete-schedule');
        });

         Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', 'ContactController@index')->name('contacts');
            Route::get('/create', 'ContactController@create')->name('create-contact');
            Route::post('/save', 'ContactController@save')->name('save-contact');
            Route::get('/{slug}', 'ContactController@detail')->name('contact-detail');
            Route::post('/edit-number', 'ContactController@editNumber')->name('edit-number');
            Route::post('/delete-number', 'ContactController@deleteNumber')->name('delete-number');
            Route::post('/rename', 'ContactController@rename')->name('rename-contact');
            Route::post('/add-numbers', 'ContactController@addNumbers')->name('add-numbers-to-contact');
            Route::post('/delete', 'ContactController@delete')->name('delete-contact');
            Route::post('/upload', 'ContactController@upload')->name('upload-contact');
            Route::post('/rename-column', 'ContactController@renamePhoneColumn')->name('rename-contact-column');
            Route::post('/rename-name-column', 'ContactController@renameNameColumn')->name('rename-name-column');
            Route::get('/skip-name-column/{slug}', 'ContactController@skipNameColumn')->name('skip-name-column');


        });

         // credit routes
        Route::group(['prefix' => 'credits'], function () {
            Route::get('/', 'CreditController@index')->name('credits');
            Route::get('/buy', 'CreditController@buy')->name('buy-unit');
        });

         // credit routes
        Route::group(['prefix' => 'payments'], function () {
            Route::post('/create', 'PaymentController@create')->name('create-payment');
            Route::post('/update', 'PaymentController@update')->name('update-payment');
        });
    });

    
});
// Route::group(['prefix' => 'sms', 'middleware' => ['auth', 'verified']], function () {
//     Route::get('/compose', 'SmsController@compose')->name('compose-sms');
// });
// email verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

