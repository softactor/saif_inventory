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
        
        $subChildInfo = DB::table('inv_material as im')
            ->join('items as i', 'i.id', '=', 'im.material_id')
            ->join('inv_materialcategory as imc', 'imc.id', '=', 'im.material_sub_id')
            ->join('inv_item_unit as iiu', 'iiu.id', '=', 'im.qty_unit')
            ->select('im.*', 'i.name', 'imc.material_sub_description','iiu.unit_name')
            ->orderBy('im.material_description', 'ASC')
            ->orderBy('imc.material_sub_description', 'ASC')
            ->orderBy('i.name', 'ASC')
            ->get();
        return new ViewResponse('backend.items.index', compact('plantEquipments', 'childInfo', 'subChildInfo'));
    }
    
    /*
     * *************************************************************************
     * Category operation goes here:
     * *************************************************************************
     */
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
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => 'Data have successfully deleted.']);
    }    
    public function get_child_items_by_parent(Request $request){
        $details_data   =   $this->sub_material_by_category($request->parent_id);
        $feedback_data  =   [
            'status'            =>  'success',
            'data'              =>  $details_data->render()
        ];
        echo json_encode($feedback_data);
    }
    
    /*
     * *************************************************************************
     * sub mateial operation goes here:
     * *************************************************************************
     */
    
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
    // get edit data
    public function sub_material_edit(Request $request){
        $dataInfo       = DB::table('inv_materialcategory')->where('id', $request->sub_material_id)->first();
        $feedback_data  =   [
            'status'            =>  'success',
            'data'              =>  $dataInfo
        ];
        echo json_encode($feedback_data);
    }    
    //sub_material_update
    public function sub_material_update(Request $request){
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
        $hasAlreadyData = DB::table('inv_materialcategory')
                ->where('category_id', $request->category_id)
                ->where('material_sub_description', $request->material_sub_description)
                ->where('id', '!=' , $request->sub_item_edit_id)
                ->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $updateData = [
            'category_id'               => $request->category_id,
            'material_sub_description'  => $request->material_sub_description,
        ];

        $update_response = DB::table('inv_materialcategory')
                ->where('id', $request->sub_item_edit_id)
                ->update($updateData);
        return $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully updated.',
            ];
    } 
    // sub material deleted area
    public function sub_material_delete($deleteId){
        $deletedRows = DB::table('inv_materialcategory')
                ->where('id', $deleteId)
                ->delete();
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => 'Data have successfully deleted.']);
    }
    
    /*
     * *************************************************************************
     * mateial operation goes here:
     * *************************************************************************
     */
    public function inv_material_store(Request $request) {
        
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "material_id"           => "required",
            "material_sub_id"       => "required",
            "material_description"  => "required",
            "qty_unit"              => "required",
            "material_min_stock"    => "required"
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
                ->where('material_id', $request->material_id)
                ->where('material_sub_id', $request->material_sub_id)
                ->where('material_description', $request->material_description)
                ->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $createData = [
            'material_id'           => $request->material_id,
            'material_sub_id'       => $request->material_sub_id,
            'material_description'  => $request->material_description,
            'qty_unit'              => $request->qty_unit,
            'material_min_stock'    => $request->material_min_stock,
        ];

        $create_response = DB::table('inv_material')->insert($createData);
        return $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully saved.',
            ];
    }
    // get material edit data
    public function material_edit(Request $request){
        $dataInfo       =   DB::table('inv_material')->where('id', $request->id)->first();
        $details_data   =   $this->sub_material_by_category($dataInfo->material_id);
        $feedback_data  =   [
            'status'            =>  'success',
            'sub_material_data' =>  $details_data->render(),
            'data'              =>  $dataInfo
        ];
        echo json_encode($feedback_data);
    } 
    // material update area
    public function material_update(Request $request){
        
        
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "material_id"           => "required",
            "material_sub_id"       => "required",
            "material_description"  => "required",
            "qty_unit"              => "required",
            "material_min_stock"    => "required"
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
                ->where('material_id', $request->material_id)
                ->where('material_sub_id', $request->material_sub_id)
                ->where('material_description', $request->material_description)
                ->where('id', '!=' , $request->edit_id)
                ->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return $feedback   =   [
                'status'    =>  'error',
                'message'   =>  'Duplicate data found',
            ];
        }
        
        $updateData = [
            'material_id'           => $request->material_id,
            'material_sub_id'       => $request->material_sub_id,
            'material_description'  => $request->material_description,
            'qty_unit'              => $request->qty_unit,
            'material_min_stock'    => $request->material_min_stock,
        ];

        $update_response = DB::table('inv_material')
                ->where('id', $request->edit_id)
                ->update($updateData);
        return $feedback   =   [
                'status'        =>  'success',
                'redirect_url'  =>  route('admin.items.index'),
                'message'       =>  'Data have successfully saved.',
            ];
    }
    // material deleted area
    public function material_delete($deleteId){
        $deletedRows = DB::table('inv_material')
                ->where('id', $deleteId)
                ->delete();
        return new RedirectResponse(route('admin.items.index'), ['flash_success' => 'Data have successfully deleted.']);
    }
    public function sub_material_by_category($parent_id){
        $childData      =   DB::table('inv_materialcategory')->where('category_id', $parent_id)->get();
        $details_data   =   View::make('backend.partial.get_child_items_by_parent', compact('childData'));
        return $details_data;
        
    }
}