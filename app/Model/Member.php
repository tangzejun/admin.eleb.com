<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //设置权限
    protected $fillable = ['username','password','tel','rememberToken','created_at','updated_at','coin'];
}
