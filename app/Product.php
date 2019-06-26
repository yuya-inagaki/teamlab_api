<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'image,' => 'required'
    );

    public function getData(){
        return $this->id ;
    }
}
