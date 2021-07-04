<div class="modal-header" style="border-bottom: 0px;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Tambah Media</h4>
</div>
<div class="modal-body" style="padding-top:0px;">
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div>
                <ul class="nav nav-tabs">

                    <li class="active" id="tabMediaLibrary" role="presentation" aria-controls="tabMediaLibrary" role="tab" data-toggle="tab"><a href="<?php echo url_web('admin/images/image_library_list'); ?>" data-target="#media_library" data-toggle="tabajax" aria-expanded="false">Pustaka Media</a></li>
                    <li class="" id="tabUpload" role="presentation" aria-controls="tabUpload" role="tab" data-toggle="tab"><a href="#upload_media" data-toggle="tab" aria-expanded="true">Unggah
                            Berkas</a></li>
                </ul>
                <div class="tab-content" style="height: 350px; overflow-y: scroll;overflow-x: hidden;">

                    <div class="tab-pane active" role="tabpanel" id="media_library">
                        <?php $this->load->view('admin/images/content_media_library'); ?>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane " role="tabpanel" id="upload_media">
                        </br></br></br>
                        <div style="width: 50%;margin: 0 auto;padding: 10px;border: 1px solid #999;">
                            <form id="formUploadImage" class="form" action="<?php echo url_web('admin/images/upload_image/'); ?>" method="post" enctype="multipart/form-data">
                                <input type="file" name="image" id="btnUploadImage">
                            </form>
                        </div>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="form">
                <h2>Detil Gambar</h2>
                <a href="#" class="thumbnail">
                    <img id="imageDetailImage" src="<?php echo base_url('upload/system/blank_480_360.jpg'); ?>" alt="">
                </a>

                <div class="form-group form-group-sm">
                    <label class="control-label">Url Gambar</label>
                    <input id="urlDetailImage" type="text" class="form-control " placeholder="Url" value="" disabled>
                </div>

                <div class="form-group form-group-sm">
                    <label class="control-label">Judul Gambar</label>
                    <input id="titleDetailImage" type="text" class="form-control" placeholder="Title" value="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
    <button type="button" class="btn btn-primary btn-sm" id="btnInsertImage" data-href="<?php echo url_web('admin/images/detail_image'); ?>">Sisipkan Gambar</button>
</div>