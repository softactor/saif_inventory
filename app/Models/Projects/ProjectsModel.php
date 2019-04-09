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
namespace App\Models\Projects;
use Illuminate\Database\Eloquent\Model;

class ProjectsModel  extends Model {
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_name','code','address','created_by','updated_by','deleted_at','created_at','updated_at'];
}
