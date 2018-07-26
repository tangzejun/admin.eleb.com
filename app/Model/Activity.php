<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //设置权限
    protected $fillable = ['title','content','start_time','end_time'];
}
