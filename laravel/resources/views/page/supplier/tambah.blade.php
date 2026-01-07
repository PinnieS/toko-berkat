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
             <form action="{{ url('supplier') }}" method="POST" enctype="multipart/form-data">
                 @method('POST')
                 @csrf
                 <div class="modal-body">
                     
                    
                
                     <div class="form-group">
                         <label for="">Nama Supplier</label>
                         <input type="text" class="form-control" name="nama_supplier" placeholder="Masukan Nama Supplier...">
                     </div>
                     <div class="form-group">
                         <label for="">Alamat Supplier</label>
                         <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat...">
                     </div>
                     <div class="form-group">
                         <label for="">Telepon Supplier</label>
                         <input type="text" class="form-control" name="telepon" placeholder="Masukan Telepon...">
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
