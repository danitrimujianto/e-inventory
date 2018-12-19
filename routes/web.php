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
Auth::routes();
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');

/* Router Area */
Route::middleware('auth')->prefix("/area")->group(function() {
    Route::get("/", 'AreaController@index'); /* action get list of developers */
    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'AreaController@add'); /* action insert or add data to system*/
      Route::post("/", 'AreaController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'AreaController@edit'); /* action get data by id */
        Route::get("/detail", 'AreaController@show'); /* action show data by id */
        Route::put("/", 'AreaController@update'); /* action edit data by id */
        Route::delete("/", 'AreaController@destroy'); /* action delete data by id */
    });
});

/* Router City */
Route::middleware('auth')->prefix("/city")->group(function() {
    Route::get("/", 'CityController@index'); /* action get list of developers */
    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'CityController@add'); /* action insert or add data to system*/
      Route::post("/", 'CityController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'CityController@edit'); /* action get data by id */
        Route::get("/detail", 'CityController@show'); /* action show data by id */
        Route::put("/", 'CityController@update'); /* action edit data by id */
        Route::delete("/", 'CityController@destroy'); /* action delete data by id */
    });
});

/* Router Departemen */
Route::middleware('auth')->prefix("/departemen")->group(function() {
    Route::get("/", 'DepartemenController@index'); /* action get list of developers */
    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'DepartemenController@add'); /* action insert or add data to system*/
      Route::post("/", 'DepartemenController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'DepartemenController@edit'); /* action get data by id */
        Route::get("/detail", 'DepartemenController@show'); /* action show data by id */
        Route::put("/", 'DepartemenController@update'); /* action edit data by id */
        Route::delete("/", 'DepartemenController@destroy'); /* action delete data by id */
    });
});
