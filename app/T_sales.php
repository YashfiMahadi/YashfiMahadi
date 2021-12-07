<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class T_sales extends Model
{
    protected $table = "t_sales";
    protected $fillable = ['kode', 'tgl', 'cust_id', 'status', 'jumlah_barang', 'subtotal', 'diskon', 'ongkir', 'total_bayar'];

    public function M_customer()
    {
        return $this->belongsTo(M_customer::class, 'cust_id');
    }
    public static function getId()
    {
        return $geId = DB::table('t_sales')->orderBy('id', 'DESC')->take(1)->get();
    }
}
