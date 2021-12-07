@extends('app.master')
@section('title', 'Ubah Barang')
@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Ubah Barang</h6>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="table-resposive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>kode</th>
                                    <th>nama</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>masukan jumlah barang</th>
                                    <th>pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($m_barang as $p)
                                    <tr>
                                        <form action="{{ route('editbarang') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $p->kode }}
                                                <input type="hidden" name="barang_id" value="{{ $p->id }}">
                                                <input type="hidden" name="kode" value="{{ $p->kode }}">
                                                <input type="hidden" name="id" value="{{ $t_sales_det->id }}">
                                            </td>
                                            <td>
                                                {{ $p->nama }}
                                                <input type="hidden" name="nama" value="{{ $p->nama }}">
                                            </td>
                                            <td>
                                                {{ $p->harga }}
                                                <input type="hidden" name="harga" value="{{ $p->harga }}">
                                            </td>
                                            <td>
                                                {{ $p->diskon }}%
                                                <input type="hidden" name="diskon" value="{{ $p->diskon }}">
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah_barang" class="form-control w-25" required>
                                            </td>
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-info">Ubah</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>kode</td>
                                    <td>nama</td>
                                    <td>Harga</td>
                                    <td>diskon</td>
                                    <td>jumlah barang</td>
                                    <td>pilih</td>
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