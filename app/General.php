<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{

    public function user(){
        return $this->belongsTo('app\User');
    }
    //

    protected $fillable = [
        'name', 'user_id','image','district',
        'latitude','longitude',
    ];
}
