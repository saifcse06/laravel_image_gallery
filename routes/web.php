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
Route::post('upload-image','UploadImageController@storeImage')->name('upload-image');
Route::get('all-image','UploadImageController@allImage')->name('all-image');
Route::post('image-remove','UploadImageController@removeImage')->name('image-remove');
