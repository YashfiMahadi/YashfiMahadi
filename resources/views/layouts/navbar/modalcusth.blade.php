<div class="modal fade" id="customerh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INFO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin Menghapusnya
            </div>
            <div class="modal-footer">
                <form action="{{ route('pilihcusth') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value=" @isset($s) {{ $s->id }} @endisset">
                    <button class="btn btn-danger" type="submit">
                        Hapus
                    </button>
                </form>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>