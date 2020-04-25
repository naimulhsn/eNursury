<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    
    public function user(){
        return $this->belongsTo('app\User');
    }
    public function product(){
        return $this->belongsTo('app\Product');
    }


    protected $fillable = [
        'user_id','product_id','quantity',
    ];
}
