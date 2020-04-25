<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function orderedProducts(){
        return $this->hasMany('app\OrderedProduct');
    }
    public function user(){
        return $this->belongsto('app\User');
    }

    protected $guarded = [
        'id',
    ];
}
