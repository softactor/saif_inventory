<?php

namespace App\Http\Controllers\Backend\Items;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\Items\ItemsModel;
use view;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class ProjectsController.
 */
class ItemsController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
        $plantEquipments     = ItemsModel::all();
        return new ViewResponse('backend.items.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.items.create');
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
            return redirect(route('admin.items.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'name'  => $request->name,
            'created_by'        => access()->user()->id,
        ];

        $create_response = ItemsModel::create($createData);
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => trans('alerts.backend.items.created')]);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ItemsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.items.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ItemsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->save();
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => trans('alerts.backend.items.updated')]); 
    }
    
    public function delete($deleteId){
        $deletedRows = ItemsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => trans('alerts.backend.items.deleted')]);
    }
}