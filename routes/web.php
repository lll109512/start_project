<?php

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

Route::get('/', 'TourController@tourIndex')->name('home');
Route::get('/edit/{tour_id}','TourController@editIndex')->name('edit');
Route::get('/createtour','TourController@createIndex')->name('create_tour');
Route::post('/createtour','TourController@create')->name('create_tour');
Route::post('/createtour/edit','TourController@edit')->name('edit_tour');
Route::get('/booking/{tour_id}','TBookingController@bookingIndex')->name('booking');
Route::get('/booking','TBookingController@viewBookingIndex')->name('view_booking');
Route::get('/booking/edit/{booking_id}','TBookingController@editIndex')->name('edit_booking_home');
Route::post('/booking/edit','TBookingController@edit')->name('edit_booking');
Route::post('/booking/setbooking','TBookingController@setBooking')->name('setbooking');
