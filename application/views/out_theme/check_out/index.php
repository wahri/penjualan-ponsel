<?php $this->load->view('out_theme/lib/home_head'); ?>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<?php $this->load->view('out_theme/check_out/content'); ?>
			
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	
	//setting saat dapil povinsi di klik
		$('#provinsi').change(function() {
			var href = '<?php echo site_url('store/get_kab'); ?>';
			var prov = $(this).val();
			var kab  = '<?php echo $provinsi_select;?>';
			if(prov == ''){
				return false;
			}else{
				$.ajax({
					url: href,
					data: {
						id: prov, kab: kab
					},
					type: 'post',
					dataType: 'json',
					//dataType: 'html',
					cache: false,
					success: function (msg) {
						$('#kabupaten').html(msg.kab);
						$("#kabupaten").removeAttr('disabled');
						$('#kecamatan').html('<option value="">- Pilih Kecamatan -</option>');
						$("#kecamatan").prop("disabled", true);
						$('#kelurahan').html('<option value="">- Pilih Kelurahan -</option>');
						$("#kelurahan").prop("disabled", true);
					}
				});
			}
		});
		
	//setting saat dapil povinsi di klik
		$('#kabupaten').change(function() {
			var href = '<?php echo site_url('store/get_kec'); ?>';
			var kab = $(this).val();
			var kec  = '<?php echo $kabupaten_select;?>';
			if(kab == ''){
				return false;
			}else{
				$.ajax({
					url: href,
					data: {
						id: kab, kec: kec
					},
					type: 'post',
					dataType: 'json',
					//dataType: 'html',
					cache: false,
					success: function (msg) {
						$('#kecamatan').html(msg.kec);
						$("#kecamatan").removeAttr('disabled');
						$('#kelurahan').html('<option value="">- Pilih Kelurahan -</option>');
						$("#kelurahan").prop("disabled", true);
					}
				});
			}
		});
		
	//setting saat dapil povinsi di klik
		$('#kecamatan').change(function() {
			var href = '<?php echo site_url('store/get_kel'); ?>';
			var kec = $(this).val();
			var kel  = '<?php echo $kecamatan_select;?>';
			if(kec == ''){
				return false;
			}else{
				$.ajax({
					url: href,
					data: {
						id: kec, kel: kel
					},
					type: 'post',
					dataType: 'json',
					//dataType: 'html',
					cache: false,
					success: function (msg) {
						$('#kelurahan').html(msg.kel);
						$("#kelurahan").removeAttr('disabled');
					}
				});
			}
		});
		
	$('#myform').submit(function() {
		event.preventDefault();
		if($("#total").val() == 0){
			swal("Peringatan!", "Pesanan anda kosong, mohon tambahkan produk di keranjang belanja.", "warning");
			return false;
		}else{
		  swal({
			  title: "Confirmasi!!",
			  text: "Anda yakin untuk melanjutkan Pembelian?",
			  type: "info",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  showLoaderOnConfirm: true,
			}, function () {
				swal({
					  title				: "Peforma Tagihan Sedang di Buat!!",
					  text				: 'Mohon jangan menutup browser ini sampai proses selesai',
					  type				: "warning",
					  showCancelButton	: false,
					  showConfirmButton	: true,
					  timer				: 3000
					});
						
				$("#myform").submit();
			});
		}
	});
	
	$(".delete_cart").click(function(){
		
			var product_id 		= $(this).attr('product_id');
			var total 			= $("#total").val();
			
			var product_price 	= $("#product_price\\["+product_id+"\\]").val();
			var qty 			= $("#qty\\["+product_id+"\\]").val();
			
			var price_delete 	= product_price*qty;
			var new_total 		= eval(total - price_delete);
			var dataString  = { product_id  : product_id };
				
			swal({
				  title				: "Pengingat!!",
				  text				: "Apakah anda yakin menghapus pesanan anda?",
				  type				: "warning",
				  showCancelButton	: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText	: "Ya, Hapus pesanan!",
				  closeOnConfirm	: false
				},
				function(){
					$.ajax({
						type		: "POST",
						url			: "<?php echo site_url('store/delete_keranjang'); ?>",
						data		: dataString,
						dataType	: "json",
						cache		: false,
						success		: function(data){
	
							$("#tr"+product_id).remove();
							
							$('#total').val(new_total);
							$('#span_all_total').html("Rp" +new_total);
					
							if(new_total == 0){
								$('#tr_total').remove();
								$('#tb_checkout').append(' <td colspan="6" align="center">Cart empty</td>');
								$('.nex-button').hide();
							}
							swal("Deleted!", "Pesanan anda sukses dihapus.", "success");
							$("#update_cart").html(data.update_cart);
							$("#update_cart_2").html(data.update_cart +" item(s)");
				  
						} ,error: function(xhr, status, error) {
							//alert(status);
							swal("Error!", status, "error");
						},
					});
				});
			
		});
	
});
</script>

<?php $this->load->view('out_theme/lib/home_footer_menu'); ?>
<?php $this->load->view('out_theme/lib/home_footer'); ?>