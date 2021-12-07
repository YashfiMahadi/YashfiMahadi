@extends('app.master')
@section('title', 'Input transaksi')
@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Input transaksi</h6>
            </div>
            <div class="card-body">
                <div class=" container-fluid">
                        <form action="{{ route('simpan') }}" method="POST">
                        @csrf
                        @if (session()->has('batal'))
                            <div class="alert bg-danger text-white">
                                {{ session()->get('batal') }}
                            </div>
                        @endif
                        <h6 class="font-weight-bold">Transaksi</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No</label>
                                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ $auto_number }}" readonly>
                                    @error('kode') <span class="text-danger font-weight-bold"> No harus di isi !!! </span> @enderror
                                </div>
                            </div>
                        </div>
                        <h6 class="font-weight-bold">Customer</h6>
                        <div class="row">
                            <div class="col-md-6">
                                @if (session()->has('pilih'))
                                    <div class="alert bg-success text-white">
                                        {{ session()->get('pilih') }}
                                    </div>
                                @elseif (session()->has('ubah'))
                                    <div class="alert bg-info text-white">
                                        {{ session()->get('ubah') }}
                                    </div>
                                @elseif (session()->has('hapusc'))
                                    <div class="alert bg-danger text-white">
                                        {{ session()->get('hapusc') }}
                                    </div>
                                @endif
                                @if ($id2 == 0)
                                <div class="form-group">
                                    <label for="">kode</label>
                                    <input type="text" name="cust_id" class="form-control" @error('cust_id') is-invalid @enderror readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" class="form-control" @error('name') is-invalid @enderror readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Telp</label>
                                    <input type="text" name="telp" class="form-control" @error('telp') is-invalid @enderror readonly>
                                    @error('telp') <span class="text-danger font-weight-bold"> Customer harus di isi silahkan Pilih Customer !!!</span> @enderror
                                </div>
                                <a class="btn btn-success" data-toggle="modal" data-target="#customer">Pilih Costumer</a>
                                @else
                                    @foreach ($t_sales as $s)
                                    <div class="form-group">
                                        <label for="">Kode</label>
                                        <input type="text" name="cust_id" class="form-control @error('cust_id') is-invalid @enderror" value="{{ $s->M_customer->kode }}" readonly>
                                        <input type="hidden" name="id" value="{{ $s->id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $s->M_customer->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telp</label>
                                        <input type="text" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ $s->M_customer->telp }}" readonly>
                                        @error('telp') <span class="text-danger font-weight-bold"> Customer harus di isi silahkan Pilih Customer !!! </span> @enderror
                                    </div>
                                    <a class="btn btn-info" data-toggle="modal" data-target="#customeru">Ganti Costumer</a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#customerh">Hapus Costumer</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg">
                                @if (session()->has('success'))
                                    <div class="alert bg-success text-white">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                @if (session()->has('ubahb'))
                                    <div class="alert bg-info text-white">
                                        {{ session()->get('ubahb') }}
                                    </div>
                                @endif
                                @if (session()->has('hapus'))
                                    <div class="alert bg-danger text-white">
                                        {{ session()->get('hapus') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="">
                                            <tr>
                                                <th rowspan="2" colspan="2" class=" text-center">
                                                    <a href="{{ route('tambahbarang') }}" class="btn btn-success">
                                                        Tambah
                                                    </a>
                                                </th>
                                                <th rowspan="2">no</th>
                                                <th rowspan="2">Kode barang</th>
                                                <th rowspan="2">Nama Barang</th>
                                                <th rowspan="2">Qty</th>
                                                <th rowspan="2">Harga Bandrol</th>
                                                <th colspan="2" class="text-center">Diskon</th>
                                                <th rowspan="2">Harga</th>
                                                <th rowspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <th>%</th>
                                                <th>(Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @forelse ($t_sales_det as $p)    
                                            <tr>
                                                <td>
                                                    <a href="/input/transaksi/{{ $p->id }}/ubah/barang" class="btn btn-info">
                                                        ubah
                                                    </a>
                                                </td>
                                                <td>
                                                    @include('layouts.navbar.modalbrgh')
                                                    <a class="btn btn-danger" data-toggle="modal" data-target="#hapusbrg-{{ $p->id }}">
                                                        hapus
                                                    </a>
                                                </td>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p->M_barang->kode }}</td>
                                                <td>{{ $p->M_barang->nama }}</td>
                                                <td>{{ $p->qyt }}</td>
                                                <td>{{ number_format($p->harga_bandrol, 2,'.',',') }}</td>
                                                <td>{{ number_format($p->diskon_pct) }}%</td>
                                                <td>{{ number_format($p->diskon_nilai, 2,'.',',') }}</td>
                                                <td>{{ number_format($p->harga_diskon, 2,'.',',') }}</td>
                                                <td>{{ number_format($p->total, 2,'.',',') }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" class="text-center">barang belum ditambahkan</td>
                                            </tr>
                                            @endforelse 
                                        </tbody>
                                    </table>
                                </div>
                                @if (isset($p))
                                    @php
                                        $subtotal = $p->sum('total');
                                        $jumlah_barang = $p->sum('qyt');
                                    @endphp
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                @else
                                    <input type="hidden" name="subtotal" value="">
                                    @error('subtotal') <span class="text-danger font-weight-bold"> Barang harus di isi silahkan tambahkan barang !!!</span> @enderror
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg font-weight-bold">
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-3">Sub Total</div>
                                        <div class="p-3">
                                        @if (isset($p))
                                            <input type="hidden" name="jumlah_barang" value="{{ $jumlah_barang }}">
                                            {{ number_format($p->sum('total'), 2,'.',',') }}
                                        @else
                                            -
                                        @endif
                                        </div>
                                    </div>  
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-3">Tanggal</div>
                                        <div class="p-3">
                                            <input type="date" name="tgl" class="form-control" value="{{ old('tgl') }}">
                                            @error('tgl') <span class="text-danger"> Tanggal harus di isi !!!</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-3">Diskon</div>
                                        <div class="p-2">
                                            <input type="number" name="diskon" class="form-control" placeholder="Boleh kosong" max="100" value="{{ old('diskon') }}">
                                        </div>
                                        <div class="pt-3">
                                            %
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-3">Ongkir</div>
                                        <div class="p-3">
                                            <input type="number" name="ongkir" class="form-control" placeholder="Boleh kosong" value="{{ old('ongkir') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-4">
                                <div class="row justify-content-between">
                                    <button class="btn btn-success">Simpan</button>
                                    @if (isset($s))
                                        <a href="/input/transaksi/{{ $s->id }}/batal" class="btn btn-secondary">Batal</a>
                                    @else
                                        <a href="#" class="btn btn-secondary">Batal</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    @include('layouts.navbar.modalcust')
                    @include('layouts.navbar.modalcustu')
                    @include('layouts.navbar.modalcusth')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection