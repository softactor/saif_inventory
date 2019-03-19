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
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Please fill all required fields',
            ];
            
        }
        
        // Duplicate check:
        $hasAlreadyData = ItemsModel::where('name', $request->name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
            echo json_encode($feedback);
        }
        
        $createData = [
            'name'  => $request->name,
            'created_by'        => access()->user()->id,
        ];

        $create_response = ItemsModel::create($createData);
        $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully saved.',
            ];
        echo json_encode($feedback);
    }
    public function child_store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "name"                      => "required",
            "material_sub_description"  => "required"
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Please fill all required fields',
            ];
            
        }
        
        // Duplicate check:
        $hasAlreadyData = ItemsModel::where('name', $request->name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $createData = [
            'name'  => $request->name,
            'created_by'        => access()->user()->id,
        ];

        $create_response = ItemsModel::create($createData);
        return $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully saved.',
            ];
    }

    public function edit(Request $request){        
        $datas   =   [
            'editData'  =>  ItemsModel::where('id', $request->item_id)->first()
        ];
        $feedbackData   =   [
            'message'   => 'Edit data information',
            'data'      =>  ItemsModel::where('id', $request->item_id)->first(),
            'status'    =>  'success'
        ];
//        return new ViewResponse('backend.items.edit',$datas);
        echo json_encode($feedbackData);
    }
    public function update(Request $request){
        $equipment                      = ItemsModel::find($request->edit_id);
        $equipment->name        = $request->name;
        $equipment->save();
        $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully updated.',
            ];
        echo json_encode($feedback);
    }
    
    public function delete($deleteId){
        $deletedRows = ItemsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => trans('alerts.backend.items.deleted')]);
    }
}