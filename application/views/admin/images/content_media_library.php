<div class="row">
    <div class="col-md-12">
        <ul class="list-image-media">
            <?php foreach ($images as $image) { ?>
                <li>
                    <input class="checkbox-image-list"
                           data-id="<?php echo $image['id']; ?>"
                           type="checkbox"
                           data-href="<?php echo url_web('admin/images/detail_image'); ?>"
                           id="check-<?php echo $image['id']; ?>"/>
                    <label class="select_image"
                           for="check-<?php echo $image['id']; ?>"><img
                            src="<?php echo base_url($this->costume->get_thumbnail_image($image['id'],'100x90','older')->row()->url); ?>"
                            alt="<?php echo $image['title']; ?>"/></label>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>