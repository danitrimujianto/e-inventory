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

/* Router User */
Route::middleware('auth')->prefix("/user")->group(function() {
    Route::get("/", 'UserController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'UserController@add'); /* action insert or add data to system*/
      Route::post("/", 'UserController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'UserController@edit'); /* action get data by id */
        Route::get("/detail", 'UserController@show'); /* action show data by id */
        Route::put("/", 'UserController@update'); /* action edit data by id */
        Route::delete("/", 'UserController@destroy'); /* action delete data by id */
    });
});

/* Router Tipe User */
Route::middleware('auth')->prefix("/tipeuser")->group(function() {
    Route::get("/", 'TipeUserController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'TipeUserController@add'); /* action insert or add data to system*/
      Route::post("/", 'TipeUserController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'TipeUserController@edit'); /* action get data by id */
        Route::get("/detail", 'TipeUserController@show'); /* action show data by id */
        Route::put("/", 'TipeUserController@update'); /* action edit data by id */
        Route::delete("/", 'TipeUserController@destroy'); /* action delete data by id */
    });
});

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

/* Router Position */
Route::middleware('auth')->prefix("/position")->group(function() {
    Route::get("/", 'PositionController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'PositionController@add'); /* action insert or add data to system*/
      Route::post("/", 'PositionController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'PositionController@edit'); /* action get data by id */
        Route::get("/detail", 'PositionController@show'); /* action show data by id */
        Route::put("/", 'PositionController@update'); /* action edit data by id */
        Route::delete("/", 'PositionController@destroy'); /* action delete data by id */
    });
});

/* Router Supplier */
Route::middleware('auth')->prefix("/supplier")->group(function() {
    Route::get("/", 'SupplierController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'SupplierController@add'); /* action insert or add data to system*/
      Route::post("/", 'SupplierController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'SupplierController@edit'); /* action get data by id */
        Route::get("/detail", 'SupplierController@show'); /* action show data by id */
        Route::put("/", 'SupplierController@update'); /* action edit data by id */
        Route::delete("/", 'SupplierController@destroy'); /* action delete data by id */
    });
});

/* Router Vendor */
Route::middleware('auth')->prefix("/vendor")->group(function() {
    Route::get("/", 'VendorController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'VendorController@add'); /* action insert or add data to system*/
      Route::post("/", 'VendorController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'VendorController@edit'); /* action get data by id */
        Route::get("/detail", 'VendorController@show'); /* action show data by id */
        Route::put("/", 'VendorController@update'); /* action edit data by id */
        Route::delete("/", 'VendorController@destroy'); /* action delete data by id */
    });
});

/* Router Delivery */
Route::middleware('auth')->prefix("/delivery")->group(function() {
    Route::get("/", 'DeliveryController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'DeliveryController@add'); /* action insert or add data to system*/
      Route::post("/", 'DeliveryController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'DeliveryController@edit'); /* action get data by id */
        Route::get("/detail", 'DeliveryController@show'); /* action show data by id */
        Route::put("/", 'DeliveryController@update'); /* action edit data by id */
        Route::delete("/", 'DeliveryController@destroy'); /* action delete data by id */
    });
});

/* Router Delivery */
Route::middleware('auth')->prefix("/goodscondition")->group(function() {
    Route::get("/", 'GoodsconditionController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'GoodsconditionController@add'); /* action insert or add data to system*/
      Route::post("/", 'GoodsconditionController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'GoodsConditionController@edit'); /* action get data by id */
        Route::get("/detail", 'GoodsConditionController@show'); /* action show data by id */
        Route::put("/", 'GoodsConditionController@update'); /* action edit data by id */
        Route::delete("/", 'GoodsConditionController@destroy'); /* action delete data by id */
    });
});

/* Router Division */
Route::middleware('auth')->prefix("/division")->group(function() {
    Route::get("/", 'DivisionController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'DivisionController@add'); /* action insert or add data to system*/
      Route::post("/", 'DivisionController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'DivisionController@edit'); /* action get data by id */
        Route::get("/detail", 'DivisionController@show'); /* action show data by id */
        Route::put("/", 'DivisionController@update'); /* action edit data by id */
        Route::delete("/", 'DivisionController@destroy'); /* action delete data by id */
    });
});

/* Router warehouse */
Route::middleware('auth')->prefix("/warehouse")->group(function() {
    Route::get("/", 'WarehouseController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'WarehouseController@add'); /* action insert or add data to system*/
      Route::post("/", 'WarehouseController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'WarehouseController@edit'); /* action get data by id */
        Route::get("/detail", 'WarehouseController@show'); /* action show data by id */
        Route::put("/", 'WarehouseController@update'); /* action edit data by id */
        Route::delete("/", 'WarehouseController@destroy'); /* action delete data by id */
    });
});

/* Router Barang */
Route::middleware('auth')->prefix("/barang")->group(function() {
    Route::get("/", 'BarangController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'BarangController@add'); /* action insert or add data to system*/
      Route::post("/", 'BarangController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'BarangController@edit'); /* action get data by id */
        Route::get("/detail", 'BarangController@show'); /* action show data by id */
        Route::put("/", 'BarangController@update'); /* action edit data by id */
        Route::delete("/", 'BarangController@destroy'); /* action delete data by id */
    });
});

/* Router project */
Route::middleware('auth')->prefix("/project")->group(function() {
    Route::get("/", 'ProjectController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'ProjectController@add'); /* action insert or add data to system*/
      Route::post("/", 'ProjectController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'ProjectController@edit'); /* action get data by id */
        Route::get("/detail", 'ProjectController@show'); /* action show data by id */
        Route::put("/", 'ProjectController@update'); /* action edit data by id */
        Route::delete("/", 'ProjectController@destroy'); /* action delete data by id */
    });
});

/* Router tools */
Route::middleware('auth')->prefix("/tools")->group(function() {
    Route::get("/", 'ToolsController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'ToolsController@add'); /* action insert or add data to system*/
      Route::post("/", 'ToolsController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'ToolsController@edit'); /* action get data by id */
        Route::get("/detail", 'ToolsController@show'); /* action show data by id */
        Route::put("/", 'ToolsController@update'); /* action edit data by id */
        Route::delete("/", 'ToolsController@destroy'); /* action delete data by id */
    });
});

/* Router karyawan */
Route::middleware('auth')->prefix("/karyawan")->group(function() {
    Route::get("/", 'KaryawanController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'KaryawanController@add'); /* action insert or add data to system*/
      Route::post("/", 'KaryawanController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'KaryawanController@edit'); /* action get data by id */
        Route::get("/detail", 'KaryawanController@show'); /* action show data by id */
        Route::put("/", 'KaryawanController@update'); /* action edit data by id */
        Route::delete("/", 'KaryawanController@destroy'); /* action delete data by id */
    });
});
