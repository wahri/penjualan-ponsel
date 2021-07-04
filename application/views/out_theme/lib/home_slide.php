<?php if(!empty($home_slider)){ ?>
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		
			<?php foreach($home_slider as $k_slide => $list_home_slider){ ?>
				<div class="item <?php if($k_slide == 0){echo "active"; } ?>">
					<div class="container">
						<a href="<?php echo $list_home_slider->link_button; ?>"><img style="width:100%" src="<?php echo base_url($this->costume->get_original($list_home_slider->image,'original')->row()->url); ?>" alt="<?php echo $list_home_slider->title; ?>"/></a>
						<div class="carousel-caption">
							<h4><?php echo $list_home_slider->title; ?>"/></h4>
							<p><?php echo $list_home_slider->description; ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div> 
</div>
<?php } ?>