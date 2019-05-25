<?php
/*
 * Plant Equipment Management
 */
Route::group(['namespace'   =>   'Reports'], function () {
    Route::get('report/index', 'ReportsController@index')->name('reports.index');
    Route::get('report/stock-management', 'ReportsController@stock_management')->name('reports.stock-management');
    Route::post('report/get_issue_report_data', 'ReportsController@get_issue_report_data')->name('reports.get-issue-report-data');
    Route::get('report/get_plant_equipment_reports', 'ReportsController@get_plant_equipment_reports')->name('reports.get_plant_equipment_reports');
});
