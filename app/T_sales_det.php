<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_sales_det extends Model
{
    protected $table = 't_sales_det';
    protected $fillable = ['barang_id', 'harga_bandrol', 'qyt', 'diskon_pct', 'diskon_nilai', 'harga_diskon', 'total'];

    public function M_barang()
    {
        return $this->belongsTo(M_barang::class, 'barang_id');
    }
}
