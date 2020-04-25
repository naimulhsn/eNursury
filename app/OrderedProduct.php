<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    public function order(){
        return $this->belongsTo('app\Order');
    }
    public function seller(){
        return $this->belongsTo('app\User','seller_id');
    }
    public function user(){
        return $this->belongsTo('app\User');
    }
    public function product(){
        return $this->belongsTo('app\Product');
    }
    protected $guarded = [
        'id',
    ];
}
