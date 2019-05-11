<?php

namespace App\Http\Controllers\Backend\PlantEquipment;
use App\Http\Responses\ViewResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Models\PlantEquipments\PlantEqipmentsModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * Class PlantEquipmentController.
 */
class PlantEquipmentController extends Controller
{    

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index()
    {
        $plantEquipments     =      PlantEqipmentsModel::all();
        return new ViewResponse('backend.plantequipment.index', compact('plantEquipments'));
    }
    
    public function create(){
        return new ViewResponse('backend.plantequipment.create');
    }
    public function store(Request $request) {
        // Create a new validator instance
        $validator  =   Validator::make($request->all(), [
            "project_id"            => "required",
            "equipment_type"        => "required",
            "name"                  => "required",
            "eel_code"              => "required",
            "country_of_origin"     => "required",
            "make_by"               => "required",
            "capacity"              => "required",
            "model"                 => "required",
            "year_of_manufac"       => "required",
            "present_location"      => "required",
            "remarks"               => "required"
        ]);
        
        // Validation Fails:
        if ($validator->fails()) {
            return redirect('admin/plant_and_equipment/create')
                            ->withErrors($validator)
                            ->with('error', 'Validation fail!')
                            ->withInput();
        }
        
        // Duplicate check:
        $hasAlreadyData = PlantEqipmentsModel::where('eel_code', $request->eel_code)->where('model', $request->model)->first();
        if(isset($hasAlreadyData) && !empty($hasAlreadyData)){
            return redirect(route('admin.plantEquipment.create'))
                        ->withErrors('Duplicate data found')
                        ->withInput();
//            return new RedirectResponse(route('admin.plantEquipment.index'), ['flash_success' => trans('alerts.backend.plantequipment.created')]);
        }
        
        $createData = [
            'project_id'        => $request->project_id,
            'equipment_type'    => $request->equipment_type,
            'date_form'         => ((isset($request->from_date) && !empty($request->from_date)) ? date('Y-m-d', strtotime($request->from_date)) : null),
            'date_to'           => ((isset($request->to_date) && !empty($request->to_date)) ? date('Y-m-d', strtotime($request->to_date)) : null),
            'project_id'        => $request->project_id,
            'name'              => $request->name,
            'eel_code'          => $request->eel_code,
            'country_of_origin' => $request->country_of_origin,
            'make_by'           => $request->make_by,
            'capacity'          => $request->capacity,
            'model'             => $request->model,
            'year_of_manufac'   => $request->year_of_manufac,
            'present_location'  => $request->present_location,
            'remarks'           => $request->remarks,
            'created_by'        => access()->user()->id,
        ];

        $create_response = PlantEqipmentsModel::create($createData);
        return new RedirectResponse(route('admin.plantEquipment.index'), ['flash_success' => trans('alerts.backend.plantequipment.created')]);
    }

    public function edit($edit_id){
        $datas   =   [
            'editData'  =>  PlantEqipmentsModel::where('id', $edit_id)->first()
        ];
        return new ViewResponse('backend.plantequipment.edit',$datas);
    }
    public function update(Request $request){
        $equipment                      = PlantEqipmentsModel::find($request->edit_id);
        $equipment->project_id          = $request->project_id;
        $equipment->equipment_type      = $request->equipment_type;
        $equipment->date_form           = ((isset($request->from_date) && !empty($request->from_date)) ? date('Y-m-d', strtotime($request->from_date)) : $equipment->date_form);
        $equipment->date_to             = ((isset($request->to_date) && !empty($request->to_date)) ? date('Y-m-d', strtotime($request->to_date)) : $equipment->date_to);
        $equipment->name                = $request->name;
        $equipment->eel_code            = $request->eel_code;
        $equipment->country_of_origin   = $request->country_of_origin;
        $equipment->make_by             = $request->make_by;
        $equipment->capacity            = $request->capacity;
        $equipment->model               = $request->model;
        $equipment->year_of_manufac     = $request->year_of_manufac;
        $equipment->present_location    = $request->present_location;
        $equipment->remarks             = $request->remarks;
        $equipment->save();
        return new RedirectResponse(route('admin.plantEquipment.index'), ['flash_success' => trans('alerts.backend.plantequipment.updated')]); 
    }
    
    public function delete($deleteId){
        $deletedRows = PlantEqipmentsModel::where('id', $deleteId)->delete();
        return new RedirectResponse(route('admin.plantEquipment.index'), ['flash_success' => trans('alerts.backend.plantequipment.deleted')]);
    }
    
    public function get_plant_equipment_reports(Request $request){
//        $all    =   $request->all();
//        print '<pre>';
//        print_r($all);
//        print '</pre>';
//        exit;
        $list_data  =   [];
        // get all table data:
        $query      =     DB::table('plant_and_equipment as p');
        //where('protemp','=',2)->where('is_deleted','=',0)->where('quality_review_identity','=',0)

        if (isset($request->all) && !empty($request->all)) {
            $list_data = $query->select('pa.project_id')->get();
        } else {
            if (isset($request->name) && !empty($request->name)) {
                $query->where('p.name', 'like', '%' . $request->name . '%');
            }
            if (isset($request->from_date) && !empty($request->from_date)) {
//                $from_date      =   date("Y-m-d", strtotime($request->search_from_date));
                $query->where('pc.date_form', '>=', $request->from_date);
            }
            if (isset($request->to_date) && !empty($request->to_date)) {
//                $to_date      =   date("Y-m-d", strtotime($request->search_to_date));
                $query->where('pc.date_to', '<=', $request->to_date);
            }
            
            if (isset($request->project_id) && !empty($request->project_id)) {
                $query->where('p.project_id', '=', $request->project_id);
            }
            if (isset($request->equipment_type) && !empty($request->equipment_type)) {
                $query->where('p.equipment_type', '=', $request->equipment_type);
            }
            $plantEquipments = $query->select('p.*')->get();
        }
        if ($plantEquipments->isEmpty()) {
            $feedback_data  = [
                'status'    => 'error',
                'message'   => 'Data Not Found',
                'data'      => ''
            ];
        } else {
            $search_data    =       View::make('backend.reports.plant_equipment_result_table', compact('plantEquipments'));
            $feedback_data  = [
                'status'    => 'success',
                'message'   => 'Data Found',
                'data'      => $search_data->render()
            ];
        }
        echo json_encode($feedback_data);
        
    }
}
