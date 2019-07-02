<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $guarded = array('id');

    public static $rules = array(
        'shop_id' => 'required',
        'product_id' => 'required',
    );

    public function getData(){
        return $this->shop_id ;
    }
}
