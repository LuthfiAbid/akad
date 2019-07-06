<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionAkad extends Model
{
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    protected $table='transaction';
    protected $primaryKey='id_transaction';
    protected $fillable=['status','id_admin'];
    //
}
