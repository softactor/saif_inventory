<?php

namespace App\Http\Controllers\Backend\ProductReceive;
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
class ProductReceiveController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
//        $plantEquipments     = ItemsModel::all();
        return new ViewResponse('backend.product_receive.index', compact('plantEquipments'));
    }
    
    public function create(){
        $receiveCode   = $this->generateReceivecode();        
        return new ViewResponse('backend.product_receive.create', compact('receiveCode'));
    }
    
    public function generateReceivecode(){
        
        $rendomnumber   =   rand(10, 200);
        return 'RCV-'.$rendomnumber;
    }
    public function store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "name"                  => "required"
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            echo 'Validation Error!';
            exit;
        }
        
        // Duplicate check:
        $hasAlreadyData = ItemsModel::where('name', $request->name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return redirect(route('admin.product_receive.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'name'  => $request->name,
            'created_by'        => access()->user()->id,
        ];

        $create_response = ItemsModel::create($createData);
        return new RedirectResponse(route('admin.product_receive.index'), ['flash_success' => trans('alerts.backend.product_receive.created')]);
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
        $all    =   $request->all();          
        $productsData   =    [
            'receive_date'  => $request->receive_date,
            'receive_no'    => $request->receive_no,
            'item_id'       => $request->item_id,
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
        $products       =   $users = DB::table('temp_product_receive_data')->where('receive_no', $request->receive_no)->get();
        $details_data   =   View::make('backend.partial.process_product_receive_table', compact('products'));
        $feedback_data  =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }
}
