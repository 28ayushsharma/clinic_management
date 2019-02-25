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
    return view('login');
})->name('/');
Route::get('sign-up', function () {
    return view('sign-up');
})->name('sign-up');



Route::post('signup_save', 'UserController@save')->name('signup-save');
Route::post('login', 'UserController@login')->name('login');


Route::middleware(['admin'])->group(function (){
    Route::get('dashboard', 'UserController@index')->name('dashboard');
    Route::get('logout', 'UserController@logout')->name('logout');
    Route::post('user/upload-pic', 'UserController@uploadPic')->name('upload_pic');
    Route::post('user/save-user-data', 'UserController@saveUserData')->name('save_user_data');
    Route::post('user/user-experience', 'UserController@saveUserExperience')->name('save_user_experience');
    Route::post('user/user-experience-delete', 'UserController@deleteUserExperience')->name('delete_user_experience');
    Route::get('user/render-user-experience', 'UserController@renderUserExperience')->name('render_user_experience');


    Route::post('clinic/store', 'ClinicController@store')->name('clinic_store');
    Route::post('clinic/book-slot', 'ClinicController@bookSlot')->name('book-slot');
    Route::get('clinic/clinic-data', 'ClinicController@renderClinicData')->name('render_clinic');
    Route::post('clinic/delete-slot', 'ClinicController@deleteSlot')->name('delete_slot');

});