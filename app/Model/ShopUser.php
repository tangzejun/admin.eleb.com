<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopUser extends Model
{
    //
    protected $fillable = ['name','email','password','rememberToken','status','shop_id','created_at]','updated_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }

}
