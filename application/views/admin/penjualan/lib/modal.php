<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Penjualan Produk</h4>
      </div>
      <div class="modal-body">
		<div class="alert alert-info" id="warning-alert">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>Error! </strong>
			Mohon Periksa Kembali Pilihan Anda.
		</div>
        <form class="form-horizontal" id="foo">
          <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Nama Produk</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" id="m-produk" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Harga Normal</label>
			<div class="col-sm-3">
			  <input type="number" class="form-control" id="m-normal-harga" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Harga Baru</label>
			<div class="col-sm-3">
			  <input type="number" class="form-control" id="m-harga-baru" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Pilih Harga</label>
			<div class="col-sm-9">
			  <div class="radio">
				  <label>
					<input type="radio" name="pilih-harga" value="lama">
					Harga Lama
				  </label>
				  <label>
					<input type="radio" name="pilih-harga" value="baru">
					Harga Baru
				  </label>
				</div>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Jumlah</label>
			<div class="col-sm-3">
			  <input type="number" class="form-control" id="m-jumlah">
			</div>
		  </div>
		  <input type="hidden" class="form-control" id="m-id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary add-item">Tambah Item</button>
      </div>
    </div>
  </div>
</div>