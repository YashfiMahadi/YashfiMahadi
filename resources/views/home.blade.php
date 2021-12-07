@extends('app.master')
@section('title', 'Dashboard - Daftar Transaksi')
@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Daftar Transaksi</h6>
            </div>
            <div class="card-body">
                <div class=" container-fluid">
                    @if (session()->has('selesai'))
                        <div class="alert bg-success text-white">
                            {{ session()->get('selesai') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class=" bg-info text-white">
                                <tr>
                                    <th>no</th>
                                    <th>no Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Customer</th>
                                    <th>jumlah barang</th>
                                    <th>Sub Total</th>
                                    <th>Diskon</th>
                                    <th>Ongkir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($t_sales as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->kode }}</td>
                                    <td>{{ $p->tgl }}</td>
                                    <td>{{ $p->M_customer->name }}</td>
                                    <td>{{ $p->jumlah_barang }}</td>
                                    <td>{{ number_format($p->subtotal, 2,'.',',') }}</td>
                                    <td>{{ number_format($p->diskon) }}%</td>
                                    <td>{{ number_format($p->ongkir, 2,'.',',') }}</td>
                                    <td>{{ number_format($p->total_bayar, 2,'.',',') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Daftar Transaksi Tidak Ada
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="4" class=" text-center">Grand Total</td>
                                    <td>
                                        @if (isset($p))
                                            {{ number_format($p->sum('total_bayar'), 2,'.',',') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection