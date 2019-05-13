<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlantEqipments
 *
 * @author Tanveer Qureshee
 */
namespace App\Models\PlantEquipments;
use Illuminate\Database\Eloquent\Model;

class PlantEqipmentsModel  extends Model {
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plant_and_equipment';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','equipment_type','date_form','date_to','name','eel_code','country_of_origin','capacity','make_by','model','year_of_manufac','present_location','present_condition','remarks','created_by','updated_by','deleted_at','created_at','updated_at'];
}
