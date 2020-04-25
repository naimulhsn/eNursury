<?php

namespace app;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function products(){
        return $this->hasMany('app\Product');
    }
    public function ads(){
        return $this->hasMany('app\Ad');
    }
    public function orders(){
        return $this->hasMany('app\Order');
    }
    public function customer_order_products(){
        return $this->hasMany('app\OrderedProduct','seller_id');
    }
    public function orderedProducts(){
        return $this->hasMany('app\OrderedProduct');
    }
    public function cartProducts(){
        return $this->hasMany('app\CartProduct');
    }
    public function wishlists(){
        return $this->hasMany('app\Wishlist');
    }


    public function general(){
        return $this->hasOne('app\General');
    }
    public function seller(){
        return $this->hasOne('app\Seller');
    }
    



    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type','general_id','seller_id','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
