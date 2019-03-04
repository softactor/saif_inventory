<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductsModel
 *
 * @author Tanveer Qureshee
 */
namespace App\Models\Products;
use Illuminate\Database\Eloquent\Model;

class ProductsModel  extends Model {
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','item_id','code','unit_name','created_by','updated_by','deleted_at','created_at','updated_at'];
}
