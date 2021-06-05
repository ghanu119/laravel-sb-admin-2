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
Route::post('select2/meta-keywords', '\App\Http\Controllers\HelperController@select2MetaKeywords')->name('select2.meta_keywords');
Route::post('select2/category', '\App\Http\Controllers\HelperController@select2Category')->name('select2.category');

Route::post('upload-media', 'UploadController@uploadMedia')->name('admin.upload_media');

Route::group(['middleware' => 'unauth'], function () {
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@doLogin')->name('admin.post_login');
    Route::get('forgot-password', 'LoginController@forgotPassword')->name('admin.forgot_password');
    Route::post('forgot-password', 'LoginController@sendResetPasswordLink')->name('admin.post_forgot_password');
    Route::get('reset-password/{token}', 'LoginController@showResetPassword')->name('admin.show_reset_password');
    Route::post('reset-password', 'LoginController@resetPassword')->name('admin.post_reset_passeword');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::redirect('/', 'admin/dashboard', 301)->name('admin.index');

    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    
    //Admin Profile
    Route::prefix('profile')->group( function(){
        
        $profileController = 'ProfileController@';

        Route::get('/', $profileController.'index')->name('admin.profile');
        Route::post('store', $profileController.'store')->name('admin.profile.post_data');
        Route::get('change-password', $profileController.'changePassword')->name('admin.profile.change_password');
        Route::post('change-password/update', $profileController.'updatePassword')->name('admin.profile.change_password.post_data');
        
    });

    //Parcel Type Route
    Route::prefix('parcel-type')->group( function(){
        
        $parcelTypeController = 'ParcelTypeController@';

        Route::get('/', $parcelTypeController.'index')->name('admin.parcel_type');
        Route::post('ajax-data', $parcelTypeController.'ajaxTableData')->name('admin.parcel_type.ajax_data');
        Route::get('create', $parcelTypeController.'create')->name('admin.parcel_type.create');
        Route::get('{parcelType}/edit', $parcelTypeController.'edit')->name('admin.parcel_type.edit');
        Route::post('store', $parcelTypeController.'store')->name('admin.parcel_type.post_data');
        Route::post('{parcelType}/change-status', $parcelTypeController.'changeStatus')->name('admin.parcel_type.change_status');
        Route::post('{parcelType}/delete', $parcelTypeController.'delete')->name('admin.parcel_type.delete');
    });

});
