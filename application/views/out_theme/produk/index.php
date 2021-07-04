<?php $this->load->view('out_theme/lib/home_head'); ?>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<?php $this->load->view('out_theme/produk/content'); ?>
			
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	
	$(".add_to_cart").click(function(){
		var product_id = $(this).attr('product_id');
		var qty = $('.qty'+product_id).val();
		var total_harga = $("#total").val();
		
		if(qty == 0){
			//alert('Minumum quantity 1');
			//swal("Good job!", "You clicked the button!", "success")
			swal({
			  title: "maaf!!",
			  text: "jumlah produk belum Diisi",
			  type: "warning",
			  showCancelButton: false,
			  showConfirmButton: false,
			  timer: 3000
			});
			return false;
			
		} else {
			
			var dataString  = { product_id  : product_id , qty : qty };
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('store/add_keranjang'); ?>",
				data: dataString,
				dataType: "json",
				cache		: false,
				success: function(data){
					$("#update_cart").html(data.update_cart);
					swal({
						title: "Sukses!!",
						text: "Produk Berhasil ditambahkan. Silahkan cek keranjang belanja anda untuk proses pembayaran",
						type: "success",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Lihat Keranjang Belanja",
						closeOnConfirm: false,
						},
							function(){
								window.location.href = "<?php echo site_url('order'); ?>";
						}
					);
				} ,error: function(xhr, status, error) {
					//alert(status);
					swal({
					  title: "maaf!!",
					  text: status,
					  type: "warning",
					  showCancelButton: false,
					  showConfirmButton: false,
					  timer: 3000
					});
				},
			});
		}	
	});
	
});
</script>

<?php $this->load->view('out_theme/lib/home_footer_menu'); ?>
<?php $this->load->view('out_theme/lib/home_footer'); ?>