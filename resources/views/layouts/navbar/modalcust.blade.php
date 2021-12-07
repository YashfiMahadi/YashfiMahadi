<div class="modal fade" id="customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan pilih Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="160">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>pilih</th>
                        </tr>
                        @php $no=1 @endphp
                        @foreach ($m_customer as $b)
                        <tr>
                            <form action="{{ route('pilihcust') }}" method="post">
                                @csrf
                                <td>{{ $no++ }}</td>
                                <td>
                                    {{ $b->kode }}
                                    <input type="hidden" name="kode" value="{{ $auto_number }}">
                                </td>
                                <td>
                                    {{ $b->name }}
                                    <input type="hidden" name="name" value="{{ $b->id }}">
                                </td>
                                <td>
                                    {{ $b->telp }}
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success">pilih</button>
                                </td>
                            </form>
                        <tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>