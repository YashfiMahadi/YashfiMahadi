<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_customer extends Model
{
    protected $table = "m_customer";
    protected $fillable = ['kode', 'name', 'telp'];

    public function T_sales()
    {
        return $this->hasMany(T_sales::class, 'cust_id');
    }
}
