<html>
<head>
<title>Invoice</title>
<style type="text/css">
	#page-wrap {
		width: 370px;
		margin: 15px;
		font-family: open sans,arial;
        color:#000;
	}
	
.physical-detail-content {
    padding: 5px 0 10px;
}

.physical-detail-content .detail-row:first-child {
    background-position: 115px 6px;
}

.physical-detail-content .detail-row {
    display: block;
    padding: 0;
    background-image: url(<?php echo base_url('upload/system/siping.png'); ?>);
    background-repeat: no-repeat;
    background-position: 115px -406px;
    min-height: 39px;
    _height: 39px;
}

.physical-detail-content .country {
    width: 100px;
    text-align: right;
    padding-right: 20px;
}

.physical-detail-content .msg {
    width: 225px;
	padding-left: 20px;
}

.physical-detail-content .msg span {
    line-height: 12px;
    font-size: 12px;
}

.physical-detail-content .country p {
    margin: 5px 0 0;
    font-size: 12px;
    line-height: 8px;
}

.physical-detail-content .msg p {
    margin: 5px 0 0;
    font-size: 12px;
    line-height: 12px;
}

.physical-detail-content .country span {
    line-height: 12px;
	font-size: 11px;
}

.physical-detail-content .font-light {
    color: #000;
}

.physical-detail-content .item {
    font-size: 12px;
    display: inline-block;
    padding: 4px 5px;
    vertical-align: top;
}
.physical-detail-content .pengirim {
    font-size: 12px;
    display: inline-block;
    padding: 4px 5px;
    vertical-align: top;
	border-right: 1px solid;
    border-color: #060606;
}
.physical-detail-content .pengirim p {
    margin: 5px 0 0;
    font-size: 12px;
    line-height: 12px;
}
.physical-detail-content .logistik {
    font-size: 12px;
    display: inline-block;
    padding: 4px 5px;
    vertical-align: top;
}
.physical-detail-content .logistik p {
    margin: 5px 0 0;
    font-size: 12px;
    line-height: 12px;
}

.font-kode {
    margin: 20px 0 0;
    font-size: 50px;
    line-height: 12px;
}

.physical-detail-content .detail {
    border-bottom: 1px solid;
    border-color: #060606;
	vertical-align: top;
}
.physical-detail-content .qr {
    width: 70px;
	vertical-align: top;
	font-size: 12px;
    line-height: 12px;
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
		<div class="physical-detail-content">
			<div class="detail">
    			
				<div class="item logistik">
					<img src="<?php echo url_web('admin/penjualan/barcode/'.$resi); ?>" />
				</div>
				<div class="item logistik" style="border-left: 1px solid; border-color: #060606;">
					<span class="font-light">Preferred service on</span>
                    <p><?php echo $portal->portal; ?></p>
					<p class="font-light"><?php echo $kurir->kurir; ?></p>
					<p class="font-light">RESI OTOMATIS</p>
				</div>
				<div class="item qr">
					<img src="<?php echo base_url('upload/system/QRCODE.jpg'); ?>" width="70px" />
                </div>
			</div>
			<div class="detail">
    			<div class="item logistik">
					<p>PENGIRIM : <strong><?php echo $sales->sales; ?></strong></p>
					<p class="font-light">Telp.<?php echo $sales->hp; ?></p>
				</div>
			</div>
			<div class="detail">
    			<div class="item logistik">
					<p>PENERIMA : <strong><?php echo $pelanggan->pelanggan; ?></strong></p>
					<p class="font-light">Telp.<?php echo $pelanggan->hp; ?></p>
					<p class="font-light"><span><?php echo $pelanggan->alamat ?></span></p>
					<p class="font-light">Kec.<?php echo $pelanggan->kecamatan; ?> Kab/Kota.<?php echo $pelanggan->kabupaten; ?> Prov.<?php echo $pelanggan->propinsi; ?></p>
					<p class="font-light">Zip Kode: <?php echo $pelanggan->kodepos; ?></p>
				</div>
			</div>
			<div class="detail-row">
				<div class="item country">
					<p>Keterangan</p>
                    <span class="font-light">Description package</span>
				</div>
				<div class="item icon"></div>
				<div class="item msg">
					<p class="font-light">Spare Part TV</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>