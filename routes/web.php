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

/* Router Lupa Password */
Route::prefix("/password")->group(function() {
    Route::get("/request", 'PasswordController@request'); /* action get list of developers */

});

/* Router Profile */
Route::middleware('auth')->prefix("/profile")->group(function() {
    Route::get("/", 'ProfileController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/developer/edit/{id}")->group(function() {
      Route::get("/", 'ProfileController@editDeveloper'); /* action insert or add data to system*/
      Route::put("/", 'ProfileController@updateDeveloper'); /* action insert or add data to system*/
    });

    Route::middleware('auth')->prefix("/edit/{id}")->group(function() {
        Route::get("/", 'ProfileController@edit'); /* action get data by id */
        Route::put("/", 'ProfileController@update'); /* action edit data by id */
    });
});

/* Router Modal */
Route::middleware('auth')->prefix("/modal")->group(function() {
    Route::get("/reject", 'ModalController@reject'); /* action get list of developers */
});

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
    Route::get("/search", 'AreaController@search'); /* action get list of developers */
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
    Route::get("/search", 'CityController@search'); /* action get list of developers */

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
    Route::get("/search", 'SupplierController@search'); /* action get list of developers */

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
    Route::get("/search", 'DeliveryController@search'); /* action get list of developers */

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

/* Router Goods Condition */
Route::middleware('auth')->prefix("/goodscondition")->group(function() {
    Route::get("/", 'GoodsConditionController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'GoodsConditionController@add'); /* action insert or add data to system*/
      Route::post("/", 'GoodsConditionController@store'); /* action insert or add data to system*/
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
    Route::get("/select", 'BarangController@select'); /* action get list of developers */
    Route::get("/search", 'BarangController@search'); /* action get list of developers */

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
    Route::get("/search", 'ProjectController@search'); /* action get list of developers */

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
    Route::get("/list", 'ToolsController@list'); /* action get list of developers */
    Route::get("/select", 'ToolsController@selectData'); /* action get list of developers */
    Route::get("/updatecode", 'ToolsController@updateCode'); /* action get list of developers */
    Route::middleware('auth')->prefix("/search")->group(function() {
      Route::get("/", 'ToolsController@search'); /* action insert or add data to system*/
      Route::get("/mutasi", 'ToolsController@listMutasi'); /* action insert or add data to system*/
    });

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
    Route::get("/search", 'KaryawanController@search'); /* action get list of developers */

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

/* Router All HO Activities */
Route::middleware('auth')->prefix("/allhoactivities")->group(function() {
    Route::get("/", 'AllhoActivitiesController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'AllhoActivitiesController@add'); /* action insert or add data to system*/
      Route::post("/", 'AllhoActivitiesController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'AllhoActivitiesController@edit'); /* action get data by id */
        Route::get("/detail", 'AllhoActivitiesController@show'); /* action show data by id */
        Route::post("/cancel", 'AllhoActivitiesController@cancel'); /* action accept data by id */
        Route::put("/", 'AllhoActivitiesController@update'); /* action edit data by id */
        Route::delete("/", 'AllhoActivitiesController@destroy'); /* action delete data by id */
    });
});

/* Router All HO Activities */
Route::middleware('auth')->prefix("/allhoactivities")->group(function() {
    Route::get("/", 'AllhoActivitiesController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'AllhoActivitiesController@add'); /* action insert or add data to system*/
      Route::post("/", 'AllhoActivitiesController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'AllhoActivitiesController@edit'); /* action get data by id */
        Route::get("/detail", 'AllhoActivitiesController@show'); /* action show data by id */
        Route::put("/", 'AllhoActivitiesController@update'); /* action edit data by id */
        Route::delete("/", 'AllhoActivitiesController@destroy'); /* action delete data by id */
    });
});

/* Router Handover Submission */
Route::middleware('auth')->prefix("/handover")->group(function() {
    Route::get("/", 'HandoverController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'HandoverController@add'); /* action insert or add data to system*/
      Route::post("/", 'HandoverController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'HandoverController@edit'); /* action get data by id */
        Route::get("/detail", 'HandoverController@show'); /* action show data by id */
        Route::post("/cancel", 'HandoverController@cancel'); /* action accept data by id */
        Route::put("/", 'HandoverController@update'); /* action edit data by id */
        Route::delete("/", 'HandoverController@destroy'); /* action delete data by id */
    });
});

/* Router Handover Acceptance */
Route::middleware('auth')->prefix("/hoaccept")->group(function() {
    Route::get("/", 'HandoverAcceptanceController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'HandoverAcceptanceController@add'); /* action insert or add data to system*/
      Route::post("/", 'HandoverAcceptanceController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'HandoverAcceptanceController@edit'); /* action get data by id */
        Route::get("/detail", 'HandoverAcceptanceController@show'); /* action show data by id */
        Route::get("/accept", 'HandoverAcceptanceController@acc'); /* action accept data by id */
        Route::post("/reject", 'HandoverAcceptanceController@reject'); /* action accept data by id */
        Route::put("/", 'HandoverAcceptanceController@update'); /* action edit data by id */
        Route::delete("/", 'HandoverAcceptanceController@destroy'); /* action delete data by id */
    });
});

/* Router Alat Karyawan */
Route::middleware('auth')->prefix("/alatkaryawan")->group(function() {
    Route::get("/", 'AlatKaryawanController@index'); /* action get list of developers */
    Route::get("/renew", 'AlatKaryawanController@renew'); /* action get list of developers */
    Route::get("/print", 'AlatKaryawanController@print'); /* action get list of developers */

    Route::middleware('auth')->prefix("/export")->group(function() {
      Route::get("/excel", 'AlatKaryawanController@excel'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'AlatKaryawanController@edit'); /* action get data by id */
        Route::get("/detail", 'AlatKaryawanController@show'); /* action show data by id */
    });
});

/* Router Other Employee Tool */
Route::middleware('auth')->prefix("/otheremployeetools")->group(function() {
    Route::get("/", 'OtherEmployeeToolsController@index'); /* action get list of developers */
    Route::get("/renew", 'OtherEmployeeToolsController@renew'); /* action get list of developers */
    Route::get("/print", 'OtherEmployeeToolsController@print'); /* action get list of developers */

    Route::middleware('auth')->prefix("/export")->group(function() {
      Route::get("/excel", 'OtherEmployeeToolsController@excel'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'OtherEmployeeToolsController@edit'); /* action get data by id */
        Route::get("/detail", 'OtherEmployeeToolsController@show'); /* action show data by id */
    });
});

/* Router Request Tools */
Route::middleware('auth')->prefix("/requesttools")->group(function() {
    Route::get("/", 'RequestToolsController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'RequestToolsController@add'); /* action insert or add data to system*/
      Route::post("/", 'RequestToolsController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'RequestToolsController@edit'); /* action get data by id */
        Route::get("/detail", 'RequestToolsController@show'); /* action show data by id */
        Route::post("/cancel", 'RequestToolsController@cancel'); /* action cancel data by id */
        Route::get("/accept", 'RequestToolsController@acc'); /* action accept data by id */
        Route::post("/reject", 'RequestToolsController@reject'); /* action reject data by id */
        Route::put("/", 'RequestToolsController@update'); /* action edit data by id */
        Route::delete("/", 'RequestToolsController@destroy'); /* action delete data by id */
    });
});

/* Router Service */
Route::middleware('auth')->prefix("/service")->group(function() {
    Route::get("/", 'ServiceController@index'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'ServiceController@add'); /* action insert or add data to system*/
      Route::post("/", 'ServiceController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'ServiceController@edit'); /* action get data by id */
        Route::get("/detail", 'ServiceController@show'); /* action show data by id */
        Route::put("/", 'ServiceController@update'); /* action edit data by id */
        Route::delete("/", 'ServiceController@destroy'); /* action delete data by id */
    });
});

/* Router Report */
Route::middleware('auth')->prefix("/rephandover")->group(function() {
  Route::get("/", 'ReportHandoverController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportHandoverController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportHandoverController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportHandoverController@excel'); /* action get data by id */
  });
});

Route::middleware('auth')->prefix("/repreqtools")->group(function() {
  Route::get("/", 'ReportReqToolsController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportReqToolsController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportReqToolsController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportReqToolsController@excel'); /* action get data by id */
  });
});

Route::middleware('auth')->prefix("/repemployeetools")->group(function() {
  Route::get("/", 'ReportEmployeeToolsController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportEmployeeToolsController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportEmployeeToolsController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportEmployeeToolsController@excel'); /* action get data by id */
  });
});

Route::middleware('auth')->prefix("/repservice")->group(function() {
  Route::get("/", 'ReportServiceController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportServiceController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportServiceController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportServiceController@excel'); /* action get data by id */
  });
});

Route::middleware('auth')->prefix("/repstoktools")->group(function() {
  Route::get("/", 'ReportStokToolsController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportStokToolsController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportStokToolsController@print'); /* action get data by id */
  Route::get("/print", 'ReportStokToolsController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportStokToolsController@excel'); /* action get data by id */
      Route::get("/excel", 'ReportStokToolsController@excel'); /* action get data by id */
  });
});

Route::middleware('auth')->prefix("/repkaryawan")->group(function() {
  Route::get("/", 'ReportKaryawanController@index'); /* action insert or add data to system*/
  Route::post("/", 'ReportKaryawanController@index'); /* action insert or add data to system*/
  Route::post("/print", 'ReportKaryawanController@print'); /* action get data by id */
  Route::get("/print", 'ReportKaryawanController@print'); /* action get data by id */

  Route::prefix("/export")->group(function() {
      Route::post("/excel", 'ReportKaryawanController@excel'); /* action get data by id */
      Route::get("/excel", 'ReportKaryawanController@excel'); /* action get data by id */
  });
});

/* Router Email External */
Route::middleware('auth')->prefix("/emailexternal")->group(function() {
    Route::get("/", 'EmailExternalController@index'); /* action get list of developers */
    Route::get("/search", 'EmailExternalController@search'); /* action get list of developers */

    Route::middleware('auth')->prefix("/add")->group(function() {
      Route::get("/", 'EmailExternalController@add'); /* action insert or add data to system*/
      Route::post("/", 'EmailExternalController@store'); /* action insert or add data to system*/
    });

    Route::prefix("/{id}")->group(function() {
        Route::get("/", 'EmailExternalController@edit'); /* action get data by id */
        Route::get("/detail", 'EmailExternalController@show'); /* action show data by id */
        Route::put("/", 'EmailExternalController@update'); /* action edit data by id */
        Route::delete("/", 'EmailExternalController@destroy'); /* action delete data by id */
    });
});
