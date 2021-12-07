<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_barang extends Model
{
    protected $table = "m_barang";
    protected $fillable = ['kode', 'nama', 'harga', 'diskon'];

    public function T_sales_det()
    {
        return $this->hasMany(T_sales_det::class, 'barang_id');
    }
}
