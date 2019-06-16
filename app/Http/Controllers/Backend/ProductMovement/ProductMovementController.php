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
        
        $rendomnumber   =   getDefaultCategoryCode('inv_receive', 'mrr_no', '03d', '001');
        return 'RCV-'.$rendomnumber;
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
    public function process_product_receive_url(Request $request){
        $rules      = [
            'receive_date'  => 'required',
            'receive_no'    => 'required',
            'product_id'    => 'required',
            'part_no'       => 'required',
            'supplier_id'   => 'required',
            'quantity'      => 'required',
            'unit_price'    => 'required',
            'project_id'    => 'required',
        ];  
        $messages   = [
            'receive_date.required' => 'Receive Date is required!',
            'receive_no.required'   => 'Receive No required!',
            'product_id.required'   => 'Product is required!',
            'part_no.required'      => 'Part No is required!',
            'supplier_id.required'  => 'Supplier is required!',
            'quantity.required'     => 'Quantity is required!',
            'unit_price.required'   => 'Unit Price is required!',
            'project_id.required'   => 'Project is required!',
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
                'part_no'       => $request->part_no,
                'supplier_id'   => $request->supplier_id,
                'quantity'      => $request->quantity,
                'unit_price'    => $request->unit_price,
                'project_id'    => $request->project_id
            ];

            // check product is already in the receive form:
            $whereParam     =   [
                'receive_no'    =>  $request->receive_no,
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
            $product_receive_no     =   $request->receive_no;
            $products               =   DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
            $details_data           =   View::make('backend.partial.process_product_receive_table', compact('products', 'product_receive_no'));
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
        //get mrrno:
        $mrrno  =   getDefaultCategoryCode('inv_receive', 'mrr_no', '03d', '001');
        // Create a new validator instance
        $whereParam     =   [
            'receive_no'    =>  $request->receive_no
        ];
        $existingProduct    =   DB::table('temp_product_receive_data')->where($whereParam)->get();
        if(!$existingProduct->isEmpty()){
            $total_quantity =   0;
            $SubTotal       =   0;
            $grandTotal     =   0;
            foreach($existingProduct as $rcvProduct){
                
                $SubTotal               =   0;
                $SubTotal               =   $rcvProduct->quantity * $rcvProduct->unit_price;
                $grandTotal             =   $grandTotal+$SubTotal;
                $supplier_id            =   $rcvProduct->supplier_id;
                $receive_ware_hosue_id  =   $rcvProduct->project_id;
                $total_quantity         =   $total_quantity+$rcvProduct->quantity;
                $part_no                =   $rcvProduct->part_no;
                
                // make data for inv receive details table data
                $inv_receivedetail[]    =   [
                    'mrr_no'        =>    $mrrno,
                    'material_id'   =>    $rcvProduct->product_id,
                    'receive_qty'   =>    $rcvProduct->quantity,
                    'unit_price'    =>    $rcvProduct->unit_price,
                    'sl_no'         =>    '1',
                    'total_receive' =>    number_format((float)$SubTotal, 2, '.', ''),
                    'rd_serial_id'  =>    '1',
                    'part_no'  =>    $part_no,
                ];
                
                
                // make data for inv receive details table
                $inv_materialbalance[]    =   [
                    'mb_ref_id'             =>    $mrrno,
                    'mb_materialid'         =>    $rcvProduct->product_id,
                    'mb_date'               =>    (isset($request->mrr_date) && !empty($request->mrr_date) ? date('Y-m-d h:i:s', strtotime($request->mrr_date)) : date('Y-m-d h:i:s')),
                    'mbin_qty'              =>    $rcvProduct->quantity,
                    'mbin_val'              =>    $SubTotal,
                    'mbout_qty'             =>    0,
                    'mbout_val'             =>    0,
                    'mbprice'               =>    $rcvProduct->unit_price,
                    'mbtype'                =>    'Receive',
                    'mbserial'              =>    '1.1',//$receive_ware_hosue_id,
                    'mbunit_id'             =>    $receive_ware_hosue_id,//'1',
                    'mbserial_id'           =>    '0',//'1',
                    'jvno'                  =>    $mrrno,//$total_quantity,
                    'part_no'               =>    $part_no,
                ];
                
                
            }// end of foreach for all receieve temp table;
            
            // make data for inv_receive table
            $inv_receive    =   [
                'mrr_no'                =>    $mrrno,
                'mrr_date'              =>    (isset($request->mrr_date) && !empty($request->mrr_date) ? date('Y-m-d h:i:s', strtotime($request->mrr_date)) : date('Y-m-d h:i:s')),
                'purchase_id'           =>    getDefaultCategoryCode('inv_receive', 'purchase_id', '03d', '001'),
                'receive_acct_id'       =>    '5-11',
                'supplier_id'           =>    $supplier_id,
                'posted_tog'            =>    '1',
                'remarks'               =>    'test',//$request->remarks,
                'receive_type'          =>    'Receive',
                'receive_ware_hosue_id' =>    $receive_ware_hosue_id,
                'receive_unit_id'       =>    $receive_ware_hosue_id,
                'chk_year_end'          =>    '1',
                'receive_total'         =>    number_format((float)$grandTotal, 2, '.', ''),
                'no_of_material'        =>    $total_quantity,
                'jv_no'                 =>    $mrrno,
                'part_no'               =>    $part_no,
            ];
        }
        // Begin Transaction
        DB::beginTransaction();
        try{
            $status =   'success';
            // insert into:inv_receive
            DB::table('inv_receive')->insert($inv_receive);
            // insert into:inv_receivedetail
            DB::table('inv_receivedetail')->insert($inv_receivedetail);
            // insert into:inv_materialbalance
            DB::table('inv_materialbalance')->insert($inv_materialbalance);

            // Commit Transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }
        $feedback_data          =   [
            'status'            =>  $status,
            'redirect_route'    =>  route('admin.product_receive.create'),
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
