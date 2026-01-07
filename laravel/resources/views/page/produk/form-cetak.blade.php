{{-- tambah --}}
<div class="modal fade" id="cetakLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('cetak-laporan-produk') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Pilih Kategori</label>
                    <select name="id_kategori" class="form-control" id="">
                        <option value="0">All</option>
                       @foreach ($kategori as $data_k)
                        <option value="{{ $data_k->id_kategori }}">{{ $data_k->nama_kategori }}</option>
                       @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>
</div>
</div>