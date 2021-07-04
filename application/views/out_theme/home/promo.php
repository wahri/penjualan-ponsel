<?php 
    if($produk_promo_count > 0){
    ?>
<div class="well well-small">
    <h4>Hot Promo <small class="pull-right"><?php if($produk_promo_count > 12){echo '12+ Promo produk'; }else{ echo $produk_promo_count.' Promo produk'; } ?></small></h4>
    <div class="row-fluid">
        <div id="featured" class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <ul class="thumbnails">
					<?php
						foreach($produk_promo_1 as $produk_promo_list_1){
					?>
						<li class="span3">
                            <div class="thumbnail">
                                <i class="tag"></i>
                                <a href="<?php echo base_url($produk_promo_list_1->url_produk); ?>">
									<img src="<?php echo base_url($this->costume->get_thumbnail($produk_promo_list_1->gambar_utama,'200x200')->row()->url); ?>" alt="">
								</a>
                                <div class="caption">
                                    <h5><?php echo $produk_promo_list_1->nama_produk; ?></h5>
									<p>Rp <?php echo get_harga($produk_promo_list_1->harga); ?></p>
                                </div>
                            </div>
                        </li>
					<?php
						}
					?>
                    </ul>
                </div>
				
				<?php if(!empty($produk_promo_2)){ ?>
				
                <div class="item">
                    <ul class="thumbnails">
					<?php
						foreach($produk_promo_2 as $produk_promo_list_2){
					?>
						<li class="span3">
                            <div class="thumbnail">
                                <i class="tag"></i>
                                <a href="<?php echo base_url($produk_promo_list_2->url_produk); ?>">
									<img src="<?php echo base_url($this->costume->get_thumbnail($produk_promo_list_2->gambar_utama,'200x200')->row()->url); ?>" alt="">
								</a>
                                <div class="caption">
                                    <h5><?php echo $produk_promo_list_2->nama_produk; ?></h5>
									<p>Rp <?php echo get_harga($produk_promo_list_2->harga); ?></p>
								</div>
                            </div>
                        </li>
					<?php
						}
					?>
                    </ul>
                </div>
				
				<?php }if(!empty($produk_promo_3)){ ?>
				
                <div class="item">
                    <ul class="thumbnails">
					<?php
						foreach($produk_promo_3 as $produk_promo_list_3){
					?>
						<li class="span3">
                            <div class="thumbnail">
                                <i class="tag"></i>
                                <a href="<?php echo base_url($produk_promo_list_3->url_produk); ?>">
									<img src="<?php echo base_url($this->costume->get_thumbnail($produk_promo_list_3->gambar_utama,'200x200')->row()->url); ?>" alt="">
								</a>
                                <div class="caption">
                                    <h5><?php echo $produk_promo_list_3->nama_produk; ?></h5>
									<p>Rp <?php echo get_harga($produk_promo_list_3->harga); ?></p>
								</div>
                            </div>
                        </li>
					<?php
						}
					?>
                    </ul>
                </div>
				
				<?php }if(!empty($produk_promo_4)){ ?>
				
                <div class="item">
                    <ul class="thumbnails">
					<?php
						foreach($produk_promo_4 as $produk_promo_list_4){
					?>
						<li class="span3">
                            <div class="thumbnail">
                                <i class="tag"></i>
                                <a href="<?php echo base_url($produk_promo_list_4->url_produk); ?>">
									<img src="<?php echo base_url($this->costume->get_thumbnail($produk_promo_list_4->gambar_utama,'200x200')->row()->url); ?>" alt="">
								</a>
                                <div class="caption">
                                    <h5><?php echo $produk_promo_list_4->nama_produk; ?></h5>
									<p>Rp <?php echo get_harga($produk_promo_list_4->harga); ?></p>
								</div>
                            </div>
                        </li>
					<?php
						}
					?>
                    </ul>
                </div>
				
				<?php } ?>
				
            </div>
            <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#featured" data-slide="next">›</a>
        </div>
    </div>
</div>
<?php 
    }
    ?>