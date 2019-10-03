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

Route::get('/', function () {
    return redirect('login');
});
// Login
Route::get('login', 'AdminLoginController@get_login')->name('login');
Route::post('post-login', 'AdminLoginController@postLogin')->name('postLogin');
Route::get('logout', 'AdminLoginController@logout')->name('logout');

Route::group(['middleware' => 'SessionLogin'], function() {
	// Dashboard
	Route::get('dashboard','DashboardController@view')->name('dashboard');
	Route::get('statistik','DashboardController@statistik')->name('statistik');

	// User Profile
	Route::get('profile','UserProfileController@getData')->name('user_profile');
	Route::post('save-profile','UserProfileController@save_Profile')->name('save_profile');

	// List Schedule
	Route::get('list-schedule','ListScheduleController@view')->name('list_schedule');
	Route::get('tampil-list','ListScheduleController@tampil_list')->name('tampil_list');

	// List Schedule ~ Schedule Cancel
	Route::post('schedule-cancel','ScheduleCancelationController@schedule_cancel')->name('schedule_cancel');

	// List Schedule ~ Change Driver and Truck
	Route::get('tampil-dt','DTChangeController@tampil_dt')->name('tampil_dt');
	Route::post('update-drvtrk','DTChangeController@update_drvtrk')->name('update_drvtrk');

	// PO & PO List Management
	Route::get('view-po','POController@view')->name('view_po');
	Route::get('get-receipt', 'POController@get_receipt')->name('get_receipt');
	Route::post('edit_po_line', 'POController@edit_sap')->name('edit_sap');

	// Master User
	Route::get('users','masterUserController@view')->name('users');
	Route::post('save-master-user','masterUserController@add_user')->name('add_user');
	Route::get('get-edit-user','masterUserController@get_edit')->name('get_edit');
	Route::post('save-edit-user','masterUserController@update_user')->name('update_user');
	Route::get('delete-user','masterUserController@delete_user')->name('delete_user');
    
});
