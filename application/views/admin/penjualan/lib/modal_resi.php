<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Masukkan Resi Otomatis</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="foo">
          <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Nama Pembeli</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" id="m-nama" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Portal</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" id="m-portal" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Kurir</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" id="m-kurir" disabled>
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Resi Otomatis</label>
			<div class="col-sm-9">
			  <input type="text" class="form-control" id="m-resi">
			</div>
		  </div>
        </form>
      </div>
	  <input type="hidden" class="form-control" id="m-id">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary get-cetak">Cetak Alamat</button>
      </div>
    </div>
  </div>
</div>