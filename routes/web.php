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

Route::get('/', 'TourController@show_index')->name('home');
Route::get('/edit/{tour_id}','TourController@edit_index')->name('edit');
Route::get('/createtour','TourController@create_index')->name('create_tour');
Route::post('/createtour','TourController@create')->name('create_tour');
Route::post('/createtour/edit','TourController@edit')->name('edit_tour');
Route::get('/booking/{tour_id}','TBookingController@booking_index')->name('booking');
Route::get('/booking','TBookingController@viewbooking_index')->name('view_booking');
Route::post('/booking/setbooking','TBookingController@setbooking')->name('setbooking');
