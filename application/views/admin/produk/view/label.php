<html>
<head>
<title>Label</title>
<style type="text/css">
	#page-wrap {
		width: 200px;
		font-family: open sans,arial;
        color:#000;
	}
	
.physical-detail-content {
   width: 200px;
   height: 100px;
   float:left;
   margin-bottom: 5px;
}

.physical-detail-content .detail-row:first-child {
    background-position: 115px 6px;
}

.physical-detail-content .detail-row {
    
}

.physical-detail-content .country {
    padding-right: 20px;
}

.physical-detail-content .msg {
    width: 195px;
	padding-left: 20px;
}

.physical-detail-content .msg span {
    line-height: 12px;
    font-size: 11px;
}

.physical-detail-content .country p {
    margin: 0px 0 0;
    font-size: 13px;
    line-height: 8px;
}

.physical-detail-content .msg p {
    margin: 2px 0 0;
    font-size: 10px;
    line-height: 12px;
}

.physical-detail-content .country span {
    line-height: 12px;
	font-size: 10px;
}

.physical-detail-content .font-light {
    color: #000;
}

.physical-detail-content .item {
    font-size: 12px;
    display: inline-block;
    padding: 0px 5px;
    vertical-align: top;
}

.printing{
	width: 130px;
	float: left;
}

.qrcode{
	    float: right;
}

@media print
{
    * {-webkit-print-color-adjust:exact;}
}

@page{
	size: 8.5in 11in;
	size: portrait;
	margin-top: 0;
	margin-right: auto;
	margin-left: auto;
}	
	
</style>
</head>
<body>
	<div id="page-wrap">
	<?php 
	//for ($x = 0; $x < $jumlah; $x++) {
	 
	?>  
		<div class="physical-detail-content">
			<div class="detail-row">
    			<div class="item country">
                    
                    <span class="font-light">SKU NUMBER <?php echo $sku; ?></span>
					<p><?php echo $code; ?></p>
					<span class="font-light"><?php echo $estalase; ?></span>
                </div>
				<div class="item msg">
					<div class="printing">
						<p>TYPE <?php echo $type; ?></p>
						<span class="font-light">BRAND: <?php echo $merek; ?></span>
						<p>
							<?php 
							if($grade == 'Bekas'){
								echo'Grade B';
							}else{
								echo'Grade A';
							}
							?></p>
					</div>
					<div class="qrcode">
						<img src="<?php echo base_url('upload/qr_image/'.$img_url); ?>" height="40px">
					</div>
				</div>
			</div>
		</div>
		<?php
		//	}
		?>
		



	</div>
</body>
</html>