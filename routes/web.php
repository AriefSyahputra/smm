<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@login')->name('login');

Route::post('/login', 'AuthController@authenticate')->name('authenticate');

Route::post('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    /** Route of Departement */
    Route::group(['prefix' => 'departement'], function () {

        Route::get('/', 'DepartementController@index')->name('departement');

        Route::get('/detail/{id}', 'DepartementController@detail');

        Route::post('/submit', 'DepartementController@submit');

        Route::post('/update', 'DepartementController@update');

        Route::get('/datatable', 'DepartementController@datatable');
    });

    /** Route of Employee */
    Route::group(['prefix' => 'employee'], function () {

        Route::get('/', 'EmployeeController@index')->name('employee');

        Route::get('/detail/{id}', 'EmployeeController@detail');

        Route::post('/submit', 'EmployeeController@submit');

        Route::post('/update', 'EmployeeController@update');

        Route::get('/data-departement', 'EmployeeController@dataDepartement');

        Route::get('/datatable', 'EmployeeController@datatable');
    });

    /** Route of Product */
    Route::group(['prefix' => 'product'], function () {

        Route::get('/', 'ProductController@index')->name('product');

        Route::get('/detail/{sku}', 'ProductController@detail');

        Route::post('/submit', 'ProductController@submit');

        Route::post('/update', 'ProductController@update');

        Route::get('/datatable', 'ProductController@datatable');

        Route::get('/datatable/history-purchase/{sku}', 'ProductController@datatableHistoryPurchase');

        Route::get('/datatable/history-order/{sku}', 'ProductController@datatableHistoryOrder');

        Route::get('/search', 'ProductController@search');
    });

    /** Route of Purchase */
    Route::group(['prefix' => 'purchase'], function () {

        Route::get('/', 'PurchaseController@index')->name('purchase');

        Route::get('/add', 'PurchaseController@add');

        Route::get('/detail/{purchase_no}', 'PurchaseController@detail');

        Route::post('/submit', 'PurchaseController@submit');

        Route::get('/datatable', 'PurchaseController@datatable');

        Route::get('/datatable/detail/product/{purchase_no}', 'PurchaseController@datatableDetailProduct');
    });

    /** Route of Order */
    Route::group(['prefix' => 'order'], function () {

        Route::get('/', 'OrderController@index')->name('order');

        Route::get('/add', 'OrderController@add');

        Route::get('/detail/{order_no}', 'OrderController@detail');

        Route::get('/search-nik', 'OrderController@searchNik');

        Route::post('/submit', 'OrderController@submit');

        Route::get('/datatable', 'OrderController@datatable');

        Route::get('/datatable/detail/product/{order_no}', 'OrderController@datatableDetailProduct');
    });

    /** Route of Profile */
    Route::group(['prefix' => 'my-profile'], function () {

        Route::get('/', 'ProfileController@index')->name('profile');

        Route::post('/change-password', 'ProfileController@changePassword');
    });
});
