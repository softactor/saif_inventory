<?php
namespace App\Http\Controllers\Backend\ProductChallan;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use view;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductChallanController
 *
 * @author Tanveer Qureshee
 */
class ProductChallanController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
//        $plantEquipments     = ItemsModel::all();
        return new ViewResponse('backend.product_challan.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.product_challan.create');
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
            return redirect(route('admin.product_challan.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'name'  => $request->name,
            'created_by'        => access()->user()->id,
        ];

        $create_response = ItemsModel::create($createData);
        return new RedirectResponse(route('admin.product_challan.index'), ['flash_success' => trans('alerts.backend.product_challan.created')]);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ItemsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.product_challan.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ItemsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->save();
        return new RedirectResponse(route('admin.product_challan.index'), ['flash_success' => trans('alerts.backend.product_challan.updated')]); 
    }
    
    public function delete($deleteId){
        $deletedRows = ItemsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.product_challan.index'), ['flash_success' => trans('alerts.backend.product_challan.deleted')]);
    }
}
