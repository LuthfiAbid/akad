<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table='goods';
    protected $primaryKey = 'id_goods';
    protected $fillable = ['id_goods','goods_name'];
    //
}
