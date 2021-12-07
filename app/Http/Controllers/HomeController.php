<?php

namespace App\Http\Controllers;

use App\Berita;
use App\M_barang;
use App\M_customer;
use Illuminate\Database\Eloquent\Model;
use App\T_sales;
use App\T_sales_det;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', [
            't_sales' => T_sales::where('status', 'success')->latest('updated_at')->get(),
        ]);
    }

    public function transaksi()
    {
        $salesdet = T_sales_det::latest('updated_at')->get();
        $mcustomer = M_customer::latest('updated_at')->get();
        $id = T_sales::getId();
        $id1 = T_sales::count();
        $id2 = T_sales::where('status', 'proses')->count();

        if ($id1 == 0) {
            $iddalam = 1;
            $no = $iddalam + 1;
            $table_no = 000 . $no;
            $tgl = substr(str_replace('-', '', Carbon::now()), 0, 6);

            $no = $tgl . $table_no;
            $auto = substr($no, 6);
            $auto2 = intval($auto) + 1;
            $auto_number = substr($no, 0, 6) . '-' . str_repeat(0, (3 - strlen($auto2))) . $auto;
        } else {
            foreach ($id as $val);
            $iddalam = $val->id;
            $no = $iddalam + 1;
            $table_no = 000 . $no;
            $tgl = substr(str_replace('-', '', Carbon::now()), 0, 6);

            $no = $tgl . $table_no;
            $auto = substr($no, 6);
            $auto2 = intval($auto) + 1;
            $auto_number = substr($no, 0, 6) . '-' . str_repeat(0, (3 - strlen($auto2))) . $auto;
        }

        return view('input', [
            't_sales_det' => $salesdet,
            't_sales' => T_sales::latest('updated_at')->limit(1)->where('status', 'proses')->get(),
            'm_customer' => $mcustomer,
        ], compact('auto_number', 'id2'));
    }
    public function pilihcust(Request $request)
    {
        $t_sales = new T_sales;

        $t_sales->kode = $request->kode;
        $t_sales->cust_id = $request->name;
        $t_sales->status = 'proses';

        $t_sales->save();

        return redirect(route('transaksi'))->with('pilih', 'Customer telah di pilih');
    }
    public function pilihcustu(Request $request)
    {
        $id = $request->id;

        $valid = [
            'kode' => $request->kode,
            'cust_id' => $request->name
        ];

        T_sales::findOrFail($id)->update($valid);

        return redirect(route('transaksi'))->with('ubah', 'Customer telah di Ubah');
    }

    public function pilihcusth(Request $request)
    {
        $id = $request->id;

        T_sales::findOrFail($id)->delete();

        return redirect(route('transaksi'))->with('hapusc', 'Customer telah di hapus');
    }
    public function tambah()
    {
        $barang = M_barang::latest('updated_at')->get();

        return view('tambahbrg', [
            'm_barang' => $barang,
        ]);
    }
    public function input(Request $request)
    {
        $diskon_nilai = ($request->diskon / 100) * $request->harga;
        $hargaakhir = $request->harga - $diskon_nilai;
        $total = $hargaakhir * $request->jumlah_barang;

        $tsalesdet = new T_sales_det;
        $tsalesdet->barang_id = $request->barang_id;
        $tsalesdet->harga_bandrol = $request->harga;
        $tsalesdet->qyt = $request->jumlah_barang;
        $tsalesdet->diskon_pct = $request->diskon;
        $tsalesdet->diskon_nilai = $diskon_nilai;
        $tsalesdet->harga_diskon = $hargaakhir;
        $tsalesdet->total = $total;
        $tsalesdet->save();

        return redirect(route('transaksi'))->with('success', 'Barang telah di tambahkan');
    }
    public function ubah(T_sales_det $t_sales_det)
    {
        $barang = M_barang::latest('updated_at')->get();

        return view('ubahbrg', [
            'm_barang' => $barang,
        ], compact('t_sales_det'));
    }
    public function edit(Request $request)
    {
        $diskon_nilai = ($request->diskon / 100) * $request->harga;
        $hargaakhir = $request->harga - $diskon_nilai;
        $total = $hargaakhir * $request->jumlah_barang;

        $id = $request->id;

        $valid = [
            'barang_id' => $request->barang_id,
            'harga_bandrol' => $request->harga,
            'qyt' => $request->jumlah_barang,
            'diskon_pct' => $request->diskon,
            'diskon_nilai' => $diskon_nilai,
            'harga_diskon' => $hargaakhir,
            'total' => $total,
        ];

        T_sales_det::findOrFail($id)->update($valid);

        return redirect(route('transaksi'))->with('ubahb', 'Barang telah di ubah');
    }
    public function hapus(T_sales_det $t_sales_det)
    {
        $t_sales_det->delete();

        return redirect(route('transaksi'))->with('hapus', 'Barang telah di hapus');
    }

    public function batal(T_sales $t_sales)
    {
        $t_sales->delete();

        T_sales_det::truncate();

        return redirect(route('transaksi'))->with('batal', 'Anda telah di membatalkan transaksi');
    }
    public function simpan(Request $request)
    {
        $this->validateRequest();
        $id = $request->id;

        $tsalesdet = [
            'tgl' => $request->tgl,
            'jumlah_barang' => $request->jumlah_barang,
            'subtotal' => $request->subtotal,
            'diskon' => $request->diskon,
            'ongkir' => $request->ongkir,
        ];

        T_sales::findOrFail($id)->update($tsalesdet);

        return redirect(route('checkout'));
    }
    public function checkout()
    {
        return view('checkout', [
            't_sales' => T_sales::latest('updated_at')->limit(1)->get(),
        ]);
    }
    public function check(Request $request)
    {
        $id = $request->id;

        $sales['status'] = 'success';
        $sales['total_bayar'] = $request->total;

        T_sales::findOrFail($id)->update($sales);;
        T_sales_det::truncate();

        return redirect(route('home'))->with('selesai', 'Anda telah menyimpan data transaksi');
    }
    public function validateRequest()
    {
        return request()->validate([
            'kode' => 'required',
            'cust_id' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'tgl' => 'required',
            'subtotal' => 'required',
            'diskon' => 'max:100',
            'jumlah_barang' => 'required',
        ]);
    }
}
