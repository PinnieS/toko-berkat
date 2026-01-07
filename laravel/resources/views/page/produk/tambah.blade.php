 {{-- tambah --}}
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data">
                 @method('POST')
                 @csrf
                 <div class="modal-body">
                     
                    
                
                     <div class="form-group">
                         <label for="">Kode Barang</label>
                         <input type="text" class="form-control" name="kode_barang" placeholder="Masukan Kode Barang...">
                     </div>
                     <div class="form-group">
                         <label for="">Nama Barang</label>
                         <input type="text" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang...">
                     </div>
                     <div class="form-group">
                        <label for="">Satuan</label>
                        <select class="form-control" name="satuan">
                            <option value="Batang">Batang</option>
                            <option value="Lembar">Lembar</option>
                            <option value="Sak">Sak</option>
                            <option value="Kg">Kg</option>
                            <option value="Meter">Meter</option>
                            <option value="Roll">Roll</option>
                            <option value="Liter">Liter</option>
                            <option value="Kaleng">Kaleng</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Dus">Dus</option>
                            <option value="Pack">Pack</option>
                            <option value="Botol">Botol</option>
                            <option value="Karung">Karung</option>
                            <option value="Set">Set</option>
                            <option value="Galon">Galon</option>
                            <option value="Unit">Unit</option>
                            <option value="Kubik">Kubik</option>
                            <option value="Plastik">Plastik</option>
                        </select>
                    </div>
                     <div class="form-group">
                         <label for="">Stok</label>
                         <input type="number" class="form-control" name="stok" value="0" placeholder="Masukan Diskon Barang...">
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
