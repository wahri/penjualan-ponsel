<?php foreach ($images as $image) { ?>
    <li>
        <input class="checkbox-item-image-list"
               data-id="<?php echo $image['id_image']; ?>"
               data-parent="<?php echo $image['id_image']; ?>"
               type="checkbox"
               name="input_radio_image_item"
               data-href="<?php echo url_web('item/detail_image');?>"
               id="check-<?php echo $image['id_image']; ?>"/>
        <label class="select_image"
               for="check-<?php echo $image['id_image']; ?>"><img
                src="<?php echo get_thumbnail($image['thumbnails'], '100x100'); ?>"
                alt="<?php echo $image['title']; ?>"/></label>
    </li>
<?php } ?>