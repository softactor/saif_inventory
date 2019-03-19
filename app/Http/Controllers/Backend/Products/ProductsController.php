<?php

namespace App\Http\Controllers\Backend\Products;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\Products\ProductsModel;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductsController
 *
 * @author Tanveer Qureshee
 */
class ProductsController extends Controller {
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
        $plantEquipments     = ProductsModel::all();
        return new ViewResponse('backend.products.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.products.create');
    }
    public function store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "name"                  => "required",
            "item_id"               => "required",
            "code"                  => "required",
            "unit_name"             => "required"
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            echo 'Validation Error!';
            exit;
        }
        
        // Duplicate check:
        $hasAlreadyData = ProductsModel::where('item_id', $request->item_id)->where('name', $request->name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return redirect(route('admin.products.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'name'      => $request->name,
            'item_id'   => $request->item_id,
            'code'      => $request->code,
            'unit_name' => $request->unit_name,
            'created_by'=> access()->user()->id,
        ];

        $create_response = ProductsModel::create($createData);
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => 'Data have been successfully created']);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ProductsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.products.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ProductsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->item_id     = $request->item_id;
        $equipment->code        = $request->code;
        $equipment->unit_name   = $request->unit_name;
        $equipment->save();
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => 'Data have updated successfully']); 
    }
    
    public function delete($deleteId){
        $deletedRows = ProductsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.products.index'), ['flash_success' => trans('alerts.backend.products.deleted')]);
    }
    
    public function get_product_by_item_id(Request $request){
        $products       =   ProductsModel::where('item_id', $request->item_id)->get();
        $details_data   =   View::make('backend.partial.get_product_by_item_id', compact('products'));
        $feedback_data  =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }
}
