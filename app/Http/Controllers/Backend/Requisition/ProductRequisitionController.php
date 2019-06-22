<?php

namespace App\Http\Controllers\Backend\Requisition;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductReceiveController
 *
 * @author Tanveer Qureshee
 */
class ProductRequisitionController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ProductRequisitionController $request
     *
     * @return ViewResponse
     */
    public function index(){
        $requisition_data              =   DB::table('inv_requisition')->get();
        return new ViewResponse('backend.requisition.index', compact('requisition_data'));
    }
    
    public function create(){
        $receiveCode   = $this->generateRequisitioncode();        
        return new ViewResponse('backend.requisition.create', compact('receiveCode'));
    }    
    public function generateRequisitioncode(){
        
        $rendomnumber   =   getDefaultCategoryCode('inv_requisition', 'id', '03d', '001');
        return 'REQ-'.$rendomnumber;
    }
    public function product_receive_list(){
        $product_receive_list     = DB::table('inv_receive')->orderBy('mrr_date', 'DESC')->get();
        return new ViewResponse('backend.product_receive.product_receive_list', compact('product_receive_list'));
    }    
    public function product_receive_view(Request $request){
        $inv_receive            =   DB::table('inv_receive')->where('mrr_no', $request->mrr_no)->first();
        $products               =   DB::table('inv_receivedetail')->where('mrr_no', $request->mrr_no)->get();
        $details_data           =   View::make('backend.partial.product_receive_view', compact('products', 'inv_receive'));
        $feedback_data          =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }    
    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ItemsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.product_receive.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ItemsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->save();
        return new RedirectResponse(route('admin.product_receive.index'), ['flash_success' => trans('alerts.backend.product_receive.updated')]); 
    }    
    public function delete($deleteId){
        $deletedRows = ItemsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.product_receive.index'), ['flash_success' => trans('alerts.backend.product_receive.deleted')]);
    }    
    public function process_product_requisition_url(Request $request){
        $rules      = [
            'requisition_date'  => 'required',
            'requisition_id'    => 'required',
            'project_id'        => 'required',
            'product_id'        => 'required',
            'quantity'          => 'required',
        ];  
        $messages   = [
            'requisition_date.required' => 'Requisition Date is required!',
            'requisition_id.required'   => 'Requisition No required!',
            'product_id.required'       => 'Product is required!',
            'project_id.required'       => 'Project is required!',
            'quantity.required'         => 'Quantity is required!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $feedback_data          =   [
                'status'            =>  'error',
                'data'              =>  $validator->errors()
            ];
        }else{          
            $productsData   =    [
                'receive_date'      => $request->requisition_date,
                'receive_no'        => $request->requisition_id,
                'product_id'        => $request->product_id,
                'quantity'          => $request->quantity,
                'project_id'        => $request->project_id
            ];

            // check product is already in the receive form:
            $whereParam     =   [
                'receive_no'    =>  $request->requisition_id,
                'product_id'    =>  $request->product_id,
            ];
            $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->first();
            if(isset($existingProduct) && !empty($existingProduct)){
                $updateQuantity     =   $existingProduct->quantity + $request->quantity;
                $updateData     =   [
                    'quantity'    =>  $updateQuantity,
                ];
                DB::table('temp_product_receive_data')
                ->where('id', $existingProduct->id)
                ->update($updateData);
            }else{            
                DB::table('temp_product_receive_data')->insert($productsData);
            }            
            // Now update the generated dom file 
            $product_receive_no     =   $request->requisition_id;
            $products               =   DB::table('temp_product_receive_data')->where('receive_no', $request->requisition_id)->get();
            $details_data           =   View::make('backend.partial.process_product_requisiotion_table', compact('products', 'product_receive_no'));
            $feedback_data          =   [
                'status'            =>  'success',
                'data'              =>  $details_data->render()
            ];
        }
        echo json_encode($feedback_data);
    }
    public function store(Request $request) {
        $inv_receive        =   [];
        $receive_products   =   '';
        $status             =   'error';
        $receive_no         =   $request->receive_no;
        // Create a new validator instance
        $whereParam     =   [
            'receive_no'    =>  $receive_no
        ];
        $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->get();
        if(!$existingProduct->isEmpty()){
            $total_quantity =   0;
            foreach($existingProduct as $rcvProduct){
                $project_id             =   $rcvProduct->project_id;
                $total_quantity         =   $total_quantity+$rcvProduct->quantity;                
                // make data for inv requisition details table data
                $inv_receivedetail[]    =   [
                    'requisition_id'    =>    $receive_no,
                    'material_id'       =>    $rcvProduct->product_id,
                    'requisition_qty'   =>    $rcvProduct->quantity,
                    'sl_no'             =>    '1',
                ];               
                
            }// end of foreach for all requisition temp table;
            
            // make data for inv_requisition table
            $inv_receive    =   [
                'project_id'        =>    $project_id,
                'requisition_id'    =>    $receive_no,
                'requisition_date'  =>    (isset($request->requisition_date) && !empty($request->requisition_date) ? date('Y-m-d h:i:s', strtotime($request->requisition_date)) : date('Y-m-d h:i:s')),
                'remarks'           =>    $request->remarks,
                'no_of_material'    =>    '5-11',
            ];
        }
        // Begin Transaction
        DB::beginTransaction();
        try{
            $status =   'success';
            // insert into:inv_requisition
            $check  =   DB::table('inv_requisition')->insert($inv_receive);
            // insert into:inv_requisition_details
            DB::table('inv_requisition_details')->insert($inv_receivedetail);
            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
        $feedback_data          =   [
            'status'            =>  $status,
            'redirect_route'    =>  route('admin.product_requisition.create'),
            'data'              =>  $receive_products
        ];
        echo json_encode($feedback_data);        
    }    
    public function process_product_requisition_delete_url(Request $request){
        $products                   =   '';
        $deletedRows                = DB::table('temp_product_receive_data')->where('id', $request->delete_id)->delete();
        // Now update the generated dom file 
        $products_data              =   DB::table('temp_product_receive_data')->where('receive_no', $request->product_receive_no)->get();
        
        if(!$products_data->isEmpty()){
            $products = $products_data;
            $product_receive_no =   $request->receive_no;
            $details_data       =   View::make('backend.partial.process_product_requisiotion_table', compact('products', 'product_receive_no'));
            $feedback_data      =   [
                'status'            =>  'success',
                'data'              =>  $details_data->render()
            ];
            echo json_encode($feedback_data);
        }else{
            $feedback_data  =   [
                'status'            =>  'error',
                'data'              =>  ''
            ];
            echo json_encode($feedback_data);
        }
        
    }
    
    function getRequisitionDetailsByRequisitionId(Request $request){
        $products                   =   '';
        $reqRows                = DB::table('inv_requisition')->where('id', $request->requisition_id)->first();
        // Now update the generated dom file 
        $products_data              =   DB::table('inv_requisition_details')->where('requisition_id', $reqRows->requisition_id)->get();
        
        if(!$products_data->isEmpty()){
            $details_data       =   View::make('backend.partial.requisition_json_data', compact('products_data','reqRows'));
            $feedback_data      =   [
                'status'            =>  'success',
                'data'              =>  $details_data->render()
            ];
            echo json_encode($feedback_data);
        }else{
            $feedback_data  =   [
                'status'            =>  'error',
                'data'              =>  ''
            ];
            echo json_encode($feedback_data);
        }
    }
}
