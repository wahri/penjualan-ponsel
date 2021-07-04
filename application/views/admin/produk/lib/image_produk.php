<?php if (!empty($images)) { ?>
    <?php $count_image = count($images);

    if ($count_image < 5) {
        $batas_pilih_image = 5 - $count_image;
    }
    ?>
    <?php foreach ($images as $image) { ?>
        <div class="col-sm-2 box-image-item text-center" id="box-image-item-<?php echo $image; ?>">
            <div class="thumbnail image-item-list">
                <img src="<?php echo base_url($this->costume->get_thumbnail($image, '100x100')->row()->url); ?>" alt="..." class="img-thumbnail  box-add-image-item">
                <div>
                    <span class="label label-info btn btn-set-main-image <?php echo ($image_thumb == $image ? 'disabled' : ''); ?>" data-id="<?php echo $image; ?>"><i class="fa fa-check-square"></i> fiture</span>
                    <span class="label label-danger btn btn-delete-image-item" data-box="box-image-item-<?php echo $image; ?>" data-id="<?php echo $image; ?>"><i class="fa fa-trash"></i> Hapus</span>
                </div>
                <input type="hidden" name="images[]" value="<?php echo $image; ?>">
            </div>
        </div>
    <?php } ?>

    <?php if ($batas_pilih_image <= 5) { ?>
        <div class="col-sm-2 btn-add-image-item-box text-center" style="<?php echo ($batas_pilih_image == 0 ? 'display:none;' : ''); ?>">
            <div class="thumbnail btn-add-image-item">
                <img src="<?php echo base_url('upload/system/add_image.jpg'); ?>" id="addImageItem-" alt="..." class="img-thumbnail  box-add-image-item" data-href="" href="<?php echo site_url('admin/produk/modal_fiture_library/' . $batas_pilih_image); ?>" data-toggle="modal" data-target="#modalAddMedia">
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="col-sm-2 btn-add-image-item-box text-center">
        <div class="thumbnail btn-add-image-item">
            <img src="<?php echo base_url('upload/system/add_image.jpg'); ?>" id="addImageItem-" alt="..." class="img-thumbnail  box-add-image-item" data-href="" href="<?php echo url_web('admin/produk/modal_fiture_library/5'); ?>" data-toggle="modal" data-target="#modalAddMedia">
        </div>
    </div>
<?php } ?>