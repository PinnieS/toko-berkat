{{-- faktur modal --}}
<div class="modal fade" id="fakturModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Transaksi Berhasil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('cetak-faktur') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="text" name="no_transaksi" hidden id="id_faktur">
                <p align="center">Transaksi Berhasil Silahkan Cetak Faktur</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"> <i class="fa fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>
</div>
</div>