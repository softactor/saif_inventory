<?php
/*
 * Product Receive Management
 */
Route::group(['namespace' => 'Requisition'], function () {
    Route::get('product_requisition/index', 'ProductRequisitionController@index')->name('product_requisition.index');
    Route::get('product_requisition/create', 'ProductRequisitionController@create')->name('product_requisition.create');
    Route::get('product_requisition/edit/{edit_id}', 'ProductRequisitionController@edit');
    Route::post('product_requisition/store', 'ProductRequisitionController@store')->name('product_requisition.store');
    Route::post('product_requisition/update', 'ProductRequisitionController@update')->name('product_requisition.update');
    Route::get('product_requisition/delete/{delete_id}', 'ProductRequisitionController@delete');
    Route::post('process_product_requisition_url', 'ProductRequisitionController@process_product_requisition_url')->name('product_requisition.process_product_requisition_url');
    Route::get('product_requisition_list', 'ProductRequisitionController@product_requisition_list')->name('product_requisition.product_requisition_list');
    Route::get('product_requisition_view', 'ProductRequisitionController@product_requisition_view')->name('product_requisition.view');
    Route::post('process_product_requisition_delete_url', 'ProductRequisitionController@process_product_requisition_delete_url')->name('product_requisition.process_product_requisition_delete_url');
});