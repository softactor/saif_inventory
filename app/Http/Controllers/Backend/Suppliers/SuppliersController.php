<?php

namespace App\Http\Controllers\Backend\Suppliers;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\Suppliers\SuppliersModel;
use view;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class SuppliersController.
 */
class SuppliersController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
        $plantEquipments     = SuppliersModel::all();
        return new ViewResponse('backend.suppliers.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.suppliers.create');
    }
    public function store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "name"                  => "required",
            "code"                  => "required",
            "address"               => "required",
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            echo 'Validation Error!';
            exit;
        }
        
        // Duplicate check:
        $hasAlreadyData = SuppliersModel::where('name', $request->name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return redirect(route('admin.suppliers.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'name'          => $request->name,
            'code'          => $request->code,
            'address'       => $request->address,
            'created_by'    => access()->user()->id,
        ];

        $create_response    = SuppliersModel::create($createData);
        return new RedirectResponse(route('admin.suppliers.index'), ['flash_success' => 'Data has successfully Added.']);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  SuppliersModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.suppliers.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = SuppliersModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->code        = $request->code;
        $equipment->address     = $request->address;
        $equipment->save();
        return new RedirectResponse(route('admin.suppliers.index'), ['flash_success' => 'Data have updated successfully']); 
    }
    
    public function delete($deleteId){
        $deletedRows = SuppliersModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.suppliers.index'), ['flash_success' => trans('alerts.backend.suppliers.deleted')]);
    }
}