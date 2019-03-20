<?php

namespace App\Http\Controllers\Backend\Items;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\Items\ItemsModel;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
    public function index(){
        $plantEquipments     = ItemsModel::all();
        
        $childInfo = DB::table('inv_materialcategory as im')
            ->join('items as i', 'i.id', '=', 'im.category_id')
            ->select('im.*', 'i.name')
            ->orderBy('i.name', 'ASC')
            ->orderBy('im.material_sub_description', 'ASC')
            ->get();
        return new ViewResponse('backend.items.index', compact('plantEquipments', 'childInfo'));
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
            "category_id"               => "required",
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
        $hasAlreadyData = DB::table('inv_materialcategory')->where('category_id', $request->category_id)->where('material_sub_description', $request->material_sub_description)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $createData = [
            'category_id'               => $request->category_id,
            'material_sub_description'  => $request->material_sub_description,
        ];

        $create_response = DB::table('inv_materialcategory')->insert($createData);
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
    
    public function get_child_items_by_parent(Request $request){
        $childData = DB::table('inv_materialcategory')->where('category_id', $request->parent_id)->get();
        $details_data   =   View::make('backend.partial.get_child_items_by_parent', compact('childData'));
        $feedback_data  =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }
    
    public function inv_material_store(Request $request) {
        
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "category_id"           => "required",
            "material_sub_id"       => "required",
            "material_description"  => "required"
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Please fill all required fields',
            ];
            
        }
        
        // Duplicate check:         
        $hasAlreadyData = DB::table('inv_material')
                ->where('category_id', $request->category_id)
                ->where('material_id', $request->material_id)
                ->where('material_description', $request->material_description)
                ->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $createData = [
            'category_id'               => $request->category_id,
            'material_id'               => $request->material_id,
            'material_description'      => $request->material_sub_description,
        ];

        $create_response = DB::table('inv_material')->insert($createData);
        return $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully saved.',
            ];
    }
}