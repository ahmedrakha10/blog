<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {

    //home
    Route::get('/home', 'HomeController@index')->name('home');


    //Users routes
    Route::get('/users/data', 'UserController@data')->name('users.data');
    Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
    Route::resource('users', 'UserController');

    //Categories routes
    Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
    Route::delete('/categories/bulk_delete', 'CategoryController@bulkDelete')->name('categories.bulk_delete');
    Route::resource('categories', 'CategoryController');

    //Articles routes
    Route::get('/articles/data', 'ArticleController@data')->name('articles.data');
    Route::delete('/articles/bulk_delete', 'ArticleController@bulkDelete')->name('articles.bulk_delete');
    Route::resource('articles', 'ArticleController');


});
