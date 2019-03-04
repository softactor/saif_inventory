<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace' => 'PlantEquipment'], function () {
    Route::get('plant_and_equipment/index', 'PlantEquipmentController@index')->name('plantEquipment.index');
    Route::get('plant_and_equipment/create', 'PlantEquipmentController@create')->name('plantEquipment.create');
    Route::get('plant_and_equipment/edit/{edit_id}', 'PlantEquipmentController@edit');
    Route::post('plant_and_equipment/store', 'PlantEquipmentController@store')->name('plantEquipment.store');
    Route::post('plant_and_equipment/update', 'PlantEquipmentController@update')->name('plantEquipment.update');
    Route::get('plant_and_equipment/delete/{delete_id}', 'PlantEquipmentController@delete');
    Route::post('get_plant_equipment_reports', 'PlantEquipmentController@get_plant_equipment_reports')->name('plantEquipment.get_plant_equipment_reports');
});