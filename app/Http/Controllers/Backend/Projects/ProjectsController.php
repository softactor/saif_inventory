<?php

namespace App\Http\Controllers\Backend\Projects;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\Projects\ProjectsModel;
use view;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class ProjectsController.
 */
class ProjectsController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
        $plantEquipments     = ProjectsModel::all();
        return new ViewResponse('backend.projects.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.projects.create');
    }
    public function store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "project_name"          => "required",
            "code"                  => "required",
            "address"               => "required",
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            echo 'Validation Error!';
            exit;
        }
        
        // Duplicate check:
        $hasAlreadyData = ProjectsModel::where('project_name', $request->project_name)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return redirect(route('admin.projects.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
        }
        
        $createData = [
            'project_name'  => $request->project_name,
            'code'          => $request->code,
            'address'       => $request->address,
            'created_by'    => access()->user()->id,
        ];

        $create_response = ProjectsModel::create($createData);
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.created')]);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  ProjectsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.projects.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = ProjectsModel::find($request->edit_id);
        $equipment->project_name        = $request->project_name;
        $equipment->code                = $request->code;
        $equipment->address             = $request->address;
        $equipment->save();
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.updated')]); 
    }
    
    public function delete($deleteId){
        $deletedRows = ProjectsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.projects.index'), ['flash_success' => trans('alerts.backend.projects.deleted')]);
    }
}