<?php $this->load->view('out_theme/lib/home_head'); ?>
<?php $this->load->view('out_theme/lib/home_menu'); ?>
<div id="mainBody">
	<div class="container">
		<div class="row">
		
			<!-- Sidebar ================================================== -->
				<?php $this->load->view('out_theme/lib/home_sidebar'); ?>
			<!-- Sidebar end=============================================== -->
			
			<div class="span9">	
		
				<?php $this->load->view('out_theme/order/content'); ?>
			
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	
	$(".add_to_cart").click(function(){
		var product_id 		= $(this).attr('product_id');
		var qty 			= $('.qty'+product_id).val();
		var total_harga 	= $("#total").val();
		
		if(qty == 0){
			//alert('Minumum quantity 1');
			//swal("Good job!", "You clicked the button!", "success")
			swal({
			  title				: "maaf!!",
			  text				: "jumlah produk belum Diisi",
			  type				: "warning",
			  showCancelButton	: false,
			  showConfirmButton	: false,
			  timer				: 3000
			});
			return false;
			
		} else {
			
			var dataString  = { product_id  : product_id , qty : qty };
			$.ajax({
				type		: "POST",
				url			: "<?php echo site_url('store/add_keranjang'); ?>",
				data		: dataString,
				dataType	: "json",
				cache		: false,
				success		: function(data){
					$("#update_cart").html(data.update_cart);
					swal({
						title				: "Sukses!!",
						text				: "Produk Berhasil ditambahkan. Silahkan cek keranjang belanja anda untuk proses pembayaran",
						type				: "success",
						showCancelButton	: true,
						confirmButtonClass	: "btn-danger",
						confirmButtonText	: "Ya, lanjut kepembayaran",
						closeOnConfirm		: false,
						},
							function(){
								swal("Deleted!", "Your imaginary file has been deleted.", "success");
						}
					);
				} ,error: function(xhr, status, error) {
					//alert(status);
					swal({
					  title				: "maaf!!",
					  text				: status,
					  type				: "warning",
					  showCancelButton	: false,
					  showConfirmButton	: false,
					  timer				: 3000
					});
				},
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