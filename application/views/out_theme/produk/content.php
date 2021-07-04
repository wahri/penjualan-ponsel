<?php 
$cart_session = @$this->session->userdata('cart_session');
?>

<div class="span9">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
		<li><a href="<?php echo base_url('produk'); ?>">Products</a> <span class="divider">/</span></li>
		<li class="active">Product Details</li>
	</ul>
	<div class="row">
		<div id="gallery" class="span3">
			<a href="<?php echo base_url($this->costume->get_thumbnail($gambar_produk,'300x300')->row()->url); ?>" title="<?php echo $title; ?>">
			<img src="<?php echo base_url($this->costume->get_original($gambar_produk,'original')->row()->url); ?>" style="width:100%" class="produk" alt="<?php echo $title; ?>"/>
			</a>
			<div id="differentview" class="moreOptopm carousel slide">
				<div class="carousel-inner">
					<div class="item active">
					<?php
						foreach ($list_image as $k => $list_image_details){
							if($k <= 2){
								echo'<a href="'.base_url($this->costume->get_thumbnail($list_image_details->image_id,'300x300')->row()->url).'" > <img style="width:29%" src="'.base_url($this->costume->get_thumbnail($list_image_details->image_id,'300x300')->row()->url).'" /></a>';
							}
						}
					?>
					</div>
					<div class="item">
					<?php
						foreach ($list_image as $ks => $list_image_details_1){
							if ($ks > 3){
							echo'<a data-y="'.$ks.'" href="'.base_url($this->costume->get_thumbnail($list_image_details_1->image_id,'300x300')->row()->url).'" > <img style="width:29%" src="'.base_url($this->costume->get_thumbnail($list_image_details_1->image_id,'300x300')->row()->url).'" alt=""/></a>';
							}
						}
					?>
					</div>
				</div>
			</div>
			<p>
			<span><i class="icon-eye-open"></i> <?php echo $lihat_produk; ?> dilihat - </span>
			<span><i class="icon-truck"></i> <?php echo $terjual_produk; ?> terjual </span>
			</p>
		</div>
		
		<div class="span6">
			<h3><?php echo $title; ?></h3>
			<hr class="soft"/>
			<form class="form-horizontal qtyFrm">
				<div class="control-group">
					<label class="control-label"><span>Rp <?php echo get_harga($harga_produk); ?></span></label>
					<div class="controls">
						<div class="form-inline col-md-1 ">
						<input type="number" class="span1 qty<?php echo $id;?>" value="<?php echo @$cart_session[$row->product_id];?>" placeholder="Qty."/>
						<?php 
						if($stok_produk == 0){
							echo '<button type="button" class="btn btn-large btn-info pull-right disabled"> Stok Kosong</button>';
						}else{
							echo '<button type="button" class="btn btn-large btn-primary pull-right add_to_cart" product_id="'.$id.'"> Add to cart <i class=" icon-shopping-cart"></i></button>';
						}
						?>
						
						</div>
						
					</div>
				</div>
			</form>
			<hr class="soft"/>
			<h4>Informasi Produk</h4>
				<table class="table table-bordered">
					<tbody>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Brand: </td>
							<td class="techSpecTD2"><?php echo $merek_produk ; ?></td>
						</tr>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Type:</td>
							<td class="techSpecTD2"><?php echo $type_produk ; ?></td>
						</tr>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Stok Produk:</td>
							<td class="techSpecTD2"><?php echo $stok_produk; ?></td>
						</tr>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Kondisi:</td>
							<td class="techSpecTD2"><?php echo $kondisi_produk; ?></td>
						</tr>
					</tbody>
				</table>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
			<br class="clr"/>
			<a href="#" name="detail"></a>
			
			<?php if(!empty($video_produk)){ ?>
				<!-- video =============================================== -->
				<hr class="soft clr"/>
				<h4>Video Produk</h4>
				<iframe width="100%" height="300" src="https://www.youtube.com/embed/<?php echo $video_produk; ?>" allowFullScreen="allowFullScreen" frameBorder="0"></iframe>
				<br>
				<hr class="soft"/>
				<!-- video end =============================================== -->
			<?php } ?>
			
		</div>
		
		<div class="span9">
			<ul id="productDetail" class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab">Deskripsi Produk</a></li>
				<li><a href="#profile" data-toggle="tab">Produk Terbaru</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="home">
					<h4>Deskripsi Produk</h4>
					<hr class="soft"/>
					<?php echo $deskripsi_produk; ?>
				</div>
				<div class="tab-pane fade" id="profile">
					<div id="myTab" class="pull-right">
						<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
						<a href="#blockView" data-toggle="tab"><span class="btn btn-large"><i class="icon-th-large"></i></span></a>
					</div>
					<br class="clr"/>
					<hr class="soft"/>
					<?php if(!empty($produk_related)){ ?>
					<div class="tab-content">
						
						<div class="tab-pane" id="listView">
							<?php foreach($produk_related as $produk_related_list_view){ ?>
							
							<div class="row">
								<div class="span2">
									<img src="<?php echo base_url($this->costume->get_thumbnail($produk_related_list_view->gambar_utama,'200x200')->row()->url); ?>" alt=""/>
								</div>
								<div class="span4">
									<h5><?php echo $produk_related_list_view->nama_produk; ?> </h5>
									<p><?php echo get_content_excerpt($produk_related_list_view->deskripsi, 150); ?></p>
									<a class="btn btn-small pull-right" href="<?php echo base_url($produk_related_list_view->url_produk); ?>">Lihat Detail</a>
									<br class="clr"/>
								</div>
								<div class="span3 alignR">
									<form class="form-horizontal qtyFrm">
										<h3> Rp <?php echo get_harga($produk_related_list_view->harga); ?></h3>
										<br/>
										<div class="btn-group">
											<a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
											<a href="<?php echo base_url($produk_related_list_view->url_produk); ?>" class="btn btn-large"><i class="icon-zoom-in"></i></a>
										</div>
									</form>
								</div>
							</div>
							<hr class="soft"/>
							<?php } ?>
						</div>
						
						<div class="tab-pane active" id="blockView">
							<ul class="thumbnails">
							<?php foreach($produk_related as $produk_related_blok_view){ ?>
								<li class="span3">
									<div class="thumbnail">
										<a href="<?php echo base_url($produk_related_blok_view->url_produk); ?>"><img src="<?php echo base_url($this->costume->get_thumbnail($produk_related_blok_view->gambar_utama,'200x200')->row()->url); ?>" alt=""/></a>
										<div class="caption">
											<h5><?php echo get_content_excerpt($produk_related_blok_view->nama_produk, 70); ?></h5>
											<p>Rp <?php echo get_harga($produk_related_blok_view->harga); ?></p>
										</div>
									</div>
								</li>
							<?php } ?>
							</ul>
							<hr class="soft"/>
						</div>
					</div>
					<?php } ?>
					<br class="clr">
				</div>
			</div>
		</div>
	</div>
</div>
