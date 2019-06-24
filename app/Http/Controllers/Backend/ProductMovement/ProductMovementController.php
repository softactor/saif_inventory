<?php

namespace App\Http\Controllers\Backend\ProductMovement;
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
class ProductMovementController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
//        $plantEquipments     = ItemsModel::all();
        return new ViewResponse('backend.product_movement.index', compact('plantEquipments'));
    }
    
    public function create(){
        $receiveCode   = $this->generateReceivecode();        
        return new ViewResponse('backend.product_movement.create', compact('receiveCode'));
    }
    
    public function generateReceivecode(){
        
        $rendomnumber   =   getDefaultCategoryCode('product_movement', 'id', '03d', '001');
        return 'P2PM-'.$rendomnumber;
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
    public function process_product_movement_url(Request $request){
        $rules      = [
            'receive_date'  => 'required',
            'receive_no'    => 'required',
            'product_id'    => 'required',
            'quantity'      => 'required',
        ];  
        $messages   = [
            'receive_date.required' => 'Receive Date is required!',
            'receive_no.required'   => 'Receive No required!',
            'product_id.required'   => 'Product is required!',
            'quantity.required'     => 'Quantity is required!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $feedback_data          =   [
                'status'            =>  'error',
                'data'              =>  $validator->errors()
            ];
        }else{          
            $productsData   =    [
                'receive_date'  => $request->receive_date,
                'receive_no'    => $request->receive_no,
                'product_id'    => $request->product_id,
                'quantity'      => $request->quantity,
                'project_id'    => $request->from_project_id,
                'project_to_id' => $request->to_project_id
            ];
            // check product is already in the receive form:
            $whereParam     =   [
                'receive_no'    =>  $request->receive_no,
                'product_id'    =>  $request->product_id,
            ];
            $existingProduct        =   DB::table('temp_product_receive_data')->where($whereParam)->first();
            if(isset($existingProduct) && !empty($existingProduct)){
                $updateQuantity     =   $existingProduct->quantity + $request->quantity;
                $updateData         =   [
                    'quantity'      =>  $updateQuantity,
                ];
                DB::table('temp_product_receive_data')
                ->where('id', $existingProduct->id)
                ->update($updateData);
            }else{            
                DB::table('temp_product_receive_data')->insert($productsData);
            }            
            // Now update the generated dom file 
            $product_receive_no     =   $request->receive_no;
            $products               =   DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
            $details_data           =   View::make('backend.partial.process_product_movement_table', compact('products', 'product_receive_no'));
            $feedback_data          =   [
                'status'            =>  'success',
                'data'              =>  $details_data->render()
            ];
        }
        echo json_encode($feedback_data);
    }
    public function store(Request $request) {
        $all    =   $request->all();
        $inv_receive        =   [];
        $receive_products   =   '';
        $status             =   'error';
        
        $whereParam     =   [
            'receive_no'    =>  $request->receive_no
        ];
        $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->get();
        if(!$existingProduct->isEmpty()){
            $total_quantity =   0;
            $SubTotal       =   0;
            $grandTotal     =   0;
            foreach($existingProduct as $rcvProduct){                
                // make data for inv receive details table
                $product_movement_details[]    =   [
                    'product_movement_id'   =>    $request->receive_no,
                    'product_id'            =>    $rcvProduct->product_id,
                    'quantity'              =>    $rcvProduct->quantity,                    
                    'created_by'            =>    1,
                    'created_at'            =>    0,
                ];
                
                $total_quantity = $total_quantity + $rcvProduct->quantity;
            }// end of foreach for all receieve temp table;
            
            // make data for inv_receive table
            $product_movement    =   [
                'entry_date'        =>    date('Y-m-d h:i:s'),
                'project_form'      =>    (isset($request->from_project_id) && !empty($request->from_project_id) ? $request->from_project_id : ''),
                'project_to'        =>    (isset($request->to_project_id) && !empty($request->to_project_id) ? $request->to_project_id : ''),
                'total_quantity'    =>    $total_quantity,
                'from_date'         =>    $request->mv_from_date,
                'to_date'           =>    $request->mv_to_date,
                'remarks'           =>    '',
                'movement_type'     =>    '1',
                'created_by'        =>    '1',//$request->remarks,
                'created_at'        =>    date('Y-m-d h:i:s'),
            ];
        }
        // Begin Transaction
        DB::beginTransaction();
        try{
            $status =   'success';
            // insert into:inv_receive
            DB::table('product_movement')->insert($product_movement);
            // insert into:inv_receivedetail
            DB::table('product_movement_details')->insert($product_movement_details);

            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
        $feedback_data          =   [
            'status'            =>  $status,
            'redirect_route'    =>  route('admin.product_movement.create'),
            'data'              =>  $receive_products
        ];
        echo json_encode($feedback_data);        
    }    
    public function process_product_receive_delete_url(Request $request){
        $products   =   '';
        $deletedRows = DB::table('temp_product_receive_data')->where('id', $request->delete_id)->delete();
        // Now update the generated dom file 
        $products_data           =   DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
        
        if(!$products_data->isEmpty()){
            $products = $products_data;
            $product_receive_no =   $request->receive_no;
            $details_data   =   View::make('backend.partial.process_product_receive_table', compact('products', 'product_receive_no'));
            $feedback_data  =   [
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
