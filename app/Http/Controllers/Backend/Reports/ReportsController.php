<?php
namespace App\Http\Controllers\Backend\Reports;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use DB;
use Illuminate\Support\Facades\View;

/**
 * Class PlantEquipmentController.
 */
class ReportsController extends Controller{
    public function index(){
        return new ViewResponse('backend.reports.plant_equipment_reports');
    }
    
    public function get_plant_equipment_reports(Request $request){
        return new ViewResponse('backend.reports.plant_equipment_reports');
    }    
    public function stock_management(){
        return new ViewResponse('backend.reports.stock_management_report');
    }
    public function get_issue_report_data(Request $request){
       $all =    $request->all();
       $formDate    =   $request->date_form;
       $toDate      =   $request->date_to;
       $material_ids = DB::table('inv_materialbalance')
                        ->select('mb_materialid')
                        ->where('mb_date', '>=', $formDate)
                        ->groupBy('mb_materialid')
                        ->get();
       if(!$material_ids->isEmpty()){
           $subParentsContainer =   [];
           $productContainer    =   [];
           $productContainerSub =   [];
           foreach($material_ids as $mid){
               $whereParam['where'] =   [
                   'mb_materialid'  =>  $mid->mb_materialid,
                   'mb_date_from'   =>  $formDate,
                   'mb_date_to'     =>  $toDate
               ];
               $productDetails      =   get_product_stock_by_material_id($whereParam);
               $productInformation  =   get_parent_and_subparent_by_material_id($mid->mb_materialid); // product information;
               $productDetails['product_name']  =   $productInformation->material_description;
               $productDetails['unit_name']     =   $productInformation->unit_name;
               $productContainerSub =   [
                   'parentName'     =>  $productInformation->name,      
                   'subParentName'  =>  $productInformation->material_sub_description      
                ];
               if(in_array($productInformation->sub_id, $subParentsContainer)){                   
                   $productContainer[$productInformation->sub_id]['parent_details']     =   $productContainerSub;
                   $productContainer[$productInformation->sub_id]['product_details'][]  =   $productDetails;
               }else{
                   array_push($subParentsContainer, $productInformation->sub_id);
                   $productContainer[$productInformation->sub_id]['parent_details']     =   $productContainerSub;
                   $productContainer[$productInformation->sub_id]['product_details'][]  =   $productDetails;
               }// end of else block  
           }// end of unique product id;
           
           // load report view page:
           $details_data    =   View::make('backend.reports.partial.stock_management_table_data', compact('productContainer'));
           
           $feedbackdata    =   [
               'status' => 'success',
               'data'   => $details_data->render(),
               'message'=> "Data found.",
           ];
           echo json_encode($feedbackdata);
       }else{
           echo 'No data found!';
       }       
    }
}