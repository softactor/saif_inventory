<?php
namespace App\Http\Controllers\Backend\Reports;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;

/**
 * Class PlantEquipmentController.
 */
class ReportsController extends Controller{
    public function index(){
        return new ViewResponse('backend.reports.plant_equipment_reports');
    }
    
    public function get_plant_equipment_reports(Request $request){
        $all    =   $request->all();
        print '<pre>';
        print_r($all);
        print '</pre>';
        exit;
        
    }
}