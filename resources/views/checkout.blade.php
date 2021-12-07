@extends('app.master')
@section('title', 'Checkout transaksi')
@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Checkout transaksi</h6>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="{{ route('check') }}" method="POST">
                        @csrf
                        <div class="alert bg-info text-white">
                            Apakah anda yakin ingin menyimpannya
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                @foreach ($t_sales as $item)
                                <tr>
                                    <td>kode</td>
                                    <td>:</td>
                                    <td>{{ $item->kode }}</td>
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                </tr>
                                <tr>
                                    <td>tgl</td>
                                    <td>:</td>
                                    <td>{{ $item->tgl }}</td>
                                </tr>
                                <tr>
                                    <td>cust_id</td>
                                    <td>:</td>
                                    <td>{{ $item->M_customer->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Barang</td>
                                    <td>:</td>
                                    <td>{{ $item->jumlah_barang }}</td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($item->subtotal, 2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td>diskon</td>
                                    <td>:</td>
                                    <td>{{ number_format($item->diskon) }}%</td>
                                </tr>
                                <tr>
                                    <td>Ongkir</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($item->ongkir, 2,'.',',') }}</td>
                                </tr>
                                @php
                                    $diskon_nilai = ($item->diskon / 100) * $item->subtotal;
                                    $hargaakhir = $item->subtotal - $diskon_nilai;
                                    $total_bayar = $hargaakhir + $item->ongkir;
                                @endphp
                                <tr class=" font-weight-bold">
                                    <td>Total Bayar</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($total_bayar, 2,'.',',') }}</td>
                                    <input type="hidden" name="total" value="{{ $total_bayar }}">
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="/input/transaksi/{{ $item->id }}/batal" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection