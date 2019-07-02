<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'place' => 'required',
    );

    public function getData(){
        return $this->id ;
    }
}
