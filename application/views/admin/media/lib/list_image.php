		<?php 
		foreach ($list_image as $as_image) { 
		?>				
					<div class="col-md-55">
                        <div class="thumbnail">
                         <a class="edit-image" data-parent="<?php echo $as_image->parent; ?>">
                            <img style="width: 100%; display: block;" src="<?php echo base_url('upload/images/'.$as_image->image_name);?>" alt="<?php echo $as_image->title; ?>">
                         </a> 
                        </div>
                      </div>
        <?php } ?>