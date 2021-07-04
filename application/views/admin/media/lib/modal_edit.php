<!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Data Gambar</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<a href="#" class="thumbnail">
				  <img src="<?php echo base_url('upload/images/fakta.png') ?>" alt="...">
				</a>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-8">
				<form>
				  <div class="form-group">
					<label for="recipient-name" class="control-label">Image title</label>
					<input type="text" class="form-control" id="recipient-name">
				  </div>
				  <div class="form-group">
					<label for="message-text" class="control-label">Deskription:</label>
					<textarea class="form-control" id="message-text"></textarea>
				  </div>
				</form>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>