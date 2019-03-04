<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'Suppliers'], function () {
    Route::get('suppliers/index', 'SuppliersController@index')->name('suppliers.index');
    Route::get('suppliers/create', 'SuppliersController@create')->name('suppliers.create');
    Route::get('suppliers/edit/{edit_id}', 'SuppliersController@edit');
    Route::post('suppliers/store', 'SuppliersController@store')->name('suppliers.store');
    Route::post('suppliers/update', 'SuppliersController@update')->name('suppliers.update');
    Route::get('suppliers/delete/{delete_id}', 'SuppliersController@delete');
});