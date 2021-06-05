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
Route::get('storage/image/{width}/{height}/{image_path}', 'Admin\UploadController@readMedia')->where('image_path', '.*')->name('admin.media.fetch');
Route::get('media/image/{image_path}', 'Admin\UploadController@readOriginalMedia')->where('image_path', '.*')->name('admin.media.original');

Route::get('/', function () {
    return view('admin.dashboard');
});
