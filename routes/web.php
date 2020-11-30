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

// Main page
Route::resource('/','MainController');

// About us page
Route::get('/about', function () {
    return view('about.about');
});

// List of Tour packages
Route::get('/tour','TourController@index');

// Detail of Tour packages
Route::get('/tourDetail/{pIdx}', 'TourController@show');

// Booking tour packages
Route::post('/tourBook', 'TourController@tourBook')->middleware('auth');

// Save to DB about booking information
Route::post('/tourBookConfirm', 'TourController@tourBookConfirm')->middleware('auth');

// After save data, display booking information
Route::get('/tourBookThanks/{bookingCode}','TourController@tourBookThanks');

// List of Blog post
Route::get('/blog','BlogController@index');

// Save to DB about blog comment
Route::post('/blogComment','BlogController@storeComment');

// Detail of Blog post
Route::get('/blogDetail/{bIdx}', 'BlogController@show');

// Contact page
Route::get('/contact','UserController@contact');

// Save to DB about contact information
Route::post('/contact','UserController@storeContact');

// Call to display contact confirm page
Route::get('/contactConfirm','UserController@contactConfirm');

// My page > profile
Route::get('/profile','UserController@profile')->middleware('auth');

// My page > profile
Route::post('/profile','UserController@updateProfile')->middleware('auth');

// My page > My Booking
Route::get('/myBooking','UserController@myBooking')->middleware('auth');

// My page > My Booking Detail Information
Route::get('/myBookingDetail/{bookingCode}','UserController@myBookingDetail')->middleware('auth');

// My page > My Booking Cancel
Route::post('/myBookingCancel','UserController@myBookingCancel')->middleware('auth');

// My page > My Booking Edit
Route::post('/myBookingEdit','UserController@myBookingEdit')->middleware('auth');

// Admin Dashboard > Booking management
Route::get('/manageBooking','AdminController@manageBooking')->name('admin')->middleware('admin');

// Admin > Manage Booking Detail Information
Route::get('/manageBookingDetail/{bookingCode}','AdminController@manageBookingDetail')->name('admin')->middleware('admin');

// Admin > Manage Booking Detail Information
Route::post('/manageBookingCancel','AdminController@manageBookingCancel')->name('admin')->middleware('admin');

// Admin > Manage Booking Detail Information
Route::post('/manageBookingProcess','AdminController@manageBookingProcess')->name('admin')->middleware('admin');

// Admin > Manage Booking Detail Information
Route::post('/manageBookingConfirm','AdminController@manageBookingConfirm')->name('admin')->middleware('admin');

// Admin > Manage Booking Detail Information
Route::post('/manageBookingHold','AdminController@manageBookingHold')->name('admin')->middleware('admin');

// Admin Dashboard > Tour Packages management
Route::get('/manageTourPackages','AdminController@manageTourPackages')->name('admin')->middleware('admin');

// Admin Dashboard > Contact us management
Route::get('/manageContactUs','AdminController@manageContactUs')->name('admin')->middleware('admin');

// Admin Dashboard > Member management
Route::get('/manageMembers','AdminController@manageMembers')->name('admin')->middleware('admin');

// Authorization Routs
Auth::routes();

// Using for Mobile APP (COMP709 Class at Wintec)
Route::get('/jsonForApp/{param}','JsonController@index');
Route::get('/jsonForAppDetail/{param}/{idx}','JsonController@tourDetail');
Route::get('/jsonForAppLogin/{email}/{password}', 'JsonController@postLogin');
Route::get('/jsonForAppSignup/{firstname}/{lastname}/{email}/{password}', 'JsonController@postSignup');
Route::get('/jsonForAppProfile/{email}/{firstname}/{lastname}/{contactnumber}', 'JsonController@updateProfile');
Route::get('/jsonForAppPassword/{email}/{password}', 'JsonController@updatePassword');


