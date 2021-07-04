<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Store extends Public_Controller
{
	protected $table_row = 3;
	function __construct()
	{
		parent::__construct();
		$this->load->library('costume');
		$this->load->library('pagination');
		$this->load->helper(array('url', 'download', 'form', 'fungsidate'));
		$this->load->model('public_home_model');
		$this->load->model('public_website_model');
		$this->load->library('user_agent');
		$this->load->library('cart');
		$this->load->library('form_validation');
	}

	public function index()
	{
		//for mobile detect


		//for desktop detect
		$url = $this->uri->segment(1);

		$this->data['cart_session'] 		= $this->session->userdata('cart_session');
		$this->data['produk_brand'] 		= $this->public_home_model->get_list(null, 12, 0, array('id', 'desc'), 'my_merek')->result();
		$this->data['footer_menu'] 			= $this->public_home_model->get_menu(array('posisi_menu' => 4, 'parent_menu' => 0), 'my_menu')->result();
		$this->data['main_menu'] 			= $this->public_home_model->get_menu(array('posisi_menu' => 2, 'parent_menu' => 0), 'my_menu')->result();
		$this->data['sub_menu'] 			= $this->public_home_model->get_menu(array('posisi_menu' => 3, 'parent_menu' => 0), 'my_menu')->result();

		$this->data['categori_menu'] 		= $this->public_home_model->get_menu(array('posisi_menu' => 5, 'parent_menu' => 0), 'my_menu')->result();

		$this->data['produk_kategori'] 		= $this->public_home_model->get(array('induk' => 0), "my_category_produk")->result();

		$this->data['iklan_top_header'] 	= $this->public_home_model->get_iklan(array('posisi' => '1', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
		$this->data['iklan_post_sidebar_1'] = $this->public_home_model->get_iklan(array('posisi' => '16', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
		$this->data['iklan_post_sidebar_2'] = $this->public_home_model->get_iklan(array('posisi' => '17', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
		$this->data['iklan_post_sidebar_3'] = $this->public_home_model->get_iklan(array('posisi' => '18', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
		// data search
		$this->data['d_name'] 			= '';
		$this->data['d_cat'] 			= '';
		$this->data['d_brand'] 			= '';
		$this->data['d_filt'] 			= '';
		$this->data['d_kond'] 			= '';

		if ($url == 'page') {
			$slug = $url . '/' . $this->uri->segment(2);
			$page = $this->public_home_model->get(array('url_page' => $slug), "my_page");
			if ($page->num_rows() > 0) {
				$page_list 								= $page->row();
				$this->data['title'] 					= $page_list->judul_page;
				$this->data['image_og'] 				= base_url('upload/system/logo.png');
				$this->data['og_description'] 			= get_content_excerpt($page_list->content_page, 200);
				$this->data['berita_index'] 			= 'page';
				$this->data['url_berita'] 				= $page_list->url_page;
				$this->data['content'] 					= $page_list->content_page;
				$this->data['data_page'] 				= $page_list->content_page;
				$this->load->view('out_theme/halaman/index', $this->data);
			} else {
				//echo $slug;
				redirect('/');
			}
		} else if ($url == 'search_produk') {
			//data pagging
			$config['per_page'] 			= 10;
			$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$cari_produk 					= '';
			//if button submit
			if (isset($_POST['cari_button'])) {
				if ($this->input->post('names') != '') {
					$cari_produk 			= $this->input->post('names');
					$result_cari 			= array('my_produk.nama_produk' => $cari_produk);
					$this->session->set_userdata(array("pencarian" => $cari_produk));
					//insert data pencarian
					$this->public_home_model->insert_table(array('kata_kunci' => $cari_produk), 'my_pencarian');
				} else {
					$cari_produk 			= '';
					$result_cari 			= '';
					$this->session->unset_userdata('pencarian');
				}
			} else {
				if ($this->session->userdata('pencarian') != NULL) {
					$cari_produk 			= $this->session->userdata('pencarian');
					$result_cari 			= array('my_produk.nama_produk' => $cari_produk);
				} else {
					$cari_produk 			= '';
					$result_cari 			= '';
				}
			}

			//facebook
			$this->data['image_og'] = base_url('upload/system/logo.png');
			$this->data['og_description'] = $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;

			$this->data['title'] = 'Hasil Pencarian ' . $cari_produk;

			//pagging
			$load_data						= $this->public_home_model->search_produk($result_cari, null, $config['per_page'], $pagging, array('my_produk.tanggal', 'desc'), 'my_produk');
			$jumlah_data 					= $this->public_home_model->search_produk($result_cari, null, null, null, array('my_produk.tanggal', 'desc'), 'my_produk')->num_rows();
			$config['full_tag_open'] 		= '<ul>';
			$config['full_tag_close'] 		= '</ul>';
			$config['prev_link'] 			= '&lt;';
			$config['prev_tag_open'] 		= '<li>';
			$config['prev_tag_close'] 		= '</li>';
			$config['next_link'] 			= '&gt;';
			$config['next_tag_open'] 		= '<li>';
			$config['next_tag_close'] 		= '</li>';
			$config['cur_tag_open'] 		= '<li class="active"><a href="#">';
			$config['cur_tag_close'] 		= '</a></li>';
			$config['num_tag_open'] 		= '<li>';
			$config['num_tag_close'] 		= '</li>';
			$config['first_tag_open'] 		= '<li>';
			$config['first_tag_close'] 		= '</li>';
			$config['last_tag_open'] 		= '<li>';
			$config['last_tag_close'] 		= '</li>';
			$config['first_link'] 			= '&lt;&lt; Previous';
			$config['last_link'] 			= 'Next &gt;&gt;';
			$config['base_url'] 			= site_url('pencarian');
			$config['total_rows'] 			= $jumlah_data;
			$config['per_page'] 			= 12;
			$pagging 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->pagination->initialize($config);

			//load data
			$this->data['produk_list'] 		= $load_data->result();
			$this->data['jumlah_data'] 		= $jumlah_data;

			$start							= (int)$this->uri->segment(4) + 1;
			if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
				$end 						= $config['total_rows'];
			} else {
				$end 						= (int)$this->uri->segment(4) + $config['per_page'];
			}

			$this->data['result_count']		= "Showing " . $start . " - " . $end . " of " . $jumlah_data . " Results";
			$this->load->view('out_theme/pencarian/index', $this->data);
		}
		else if ($url == 'category') {
			$slug 								= $url . '/' . $this->uri->segment(2);
			$kategori 							= $this->public_home_model->get(array('url_category' => $slug), "my_category_produk");
			if ($kategori->num_rows() > 0) {
				//facebook
				$this->data['image_og'] 		= base_url('upload/system/logo.png');
				$this->data['og_description'] 	= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;

				$this->data['title'] 			= 'Kategori ' . $kategori->row()->category;
				$this->data['id'] 				= $kategori->row()->id;
				$this->data['berita_index'] 	= $slug;

				//pagging
				$config['per_page'] 			= 12;
				$pagging 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$jumlah_data 					= $this->public_home_model->search_produk_kategori(array('my_produk_kategori.category_id' => $kategori->row()->id), null, null, array('my_produk.tanggal', 'desc'), 'my_produk')->num_rows();
				$config['full_tag_open'] 		= '<ul>';
				$config['full_tag_close'] 		= '</ul>';
				$config['prev_link'] 			= '&lt;';
				$config['prev_tag_open'] 		= '<li>';
				$config['prev_tag_close'] 		= '</li>';
				$config['next_link'] 			= '&gt;';
				$config['next_tag_open'] 		= '<li>';
				$config['next_tag_close'] 		= '</li>';
				$config['cur_tag_open'] 		= '<li class="active"><a href="#">';
				$config['cur_tag_close'] 		= '</a></li>';
				$config['num_tag_open'] 		= '<li>';
				$config['num_tag_close'] 		= '</li>';
				$config['first_tag_open'] 		= '<li>';
				$config['first_tag_close'] 		= '</li>';
				$config['last_tag_open'] 		= '<li>';
				$config['last_tag_close'] 		= '</li>';
				$config['first_link'] 			= '&lt;&lt; Previous';
				$config['last_link'] 			= 'Next &gt;&gt;';
				$config['base_url'] 			= site_url($slug);
				$config['total_rows'] 			= $jumlah_data;

				$this->pagination->initialize($config);

				//load data
				$this->data['produk_list'] 		= $this->public_home_model->search_produk_kategori(array('my_produk_kategori.category_id' => $kategori->row()->id), $config['per_page'], $pagging, array('my_produk.tanggal', 'desc'), 'my_produk')->result();
				$this->data['jumlah_data'] 		= $jumlah_data;

				$start							= (int)$this->uri->segment(3) + 1;
				if ($this->uri->segment(3) + $config['per_page'] > $config['total_rows']) {
					$end = $config['total_rows'];
				} else {
					$end = (int)$this->uri->segment(3) + $config['per_page'];
				}
				$this->data['result_count']				= "Showing " . $start . " - " . $end . " of " . $jumlah_data . " Results";
				$this->load->view('out_theme/kategori/index', $this->data);
				//echo $pagging;
			} else {
				redirect('/');
				//echo $kategori->num_rows();
			}
		}
		else if ($url == 'produk') {
			$slug = $url . '/' . $this->uri->segment(2);
			$berita = $this->public_home_model->produk_detail(array('url_produk' => $slug), "my_produk");
			if ($berita->num_rows() > 0) {
				$berita_list 						= $berita->row();
				$this->data['title'] 				= $berita_list->nama_produk;
				$this->data['produk_id'] 			= $berita_list->id;
				$this->data['image_og'] 			= base_url($this->costume->get_original($berita_list->gambar_utama, 'original')->row()->url);
				$this->data['og_description'] 		= get_content_excerpt($berita_list->deskripsi, 200);

				$this->data['view_produk'] 			= $berita_list->viewer;
				$this->data['rating_produk'] 		= $berita_list->rating_vote;
				$this->data['value_rating_produk'] 	= $berita_list->rating_value;
				$this->data['tag_produk'] 			= $berita_list->tag_data;
				$this->data['share_produk'] 		= $berita_list->share;
				$this->data['like_produk'] 			= $berita_list->likers;
				$this->data['url_produk'] 			= $berita_list->url_produk;
				//add viewer count
				$real_viewer 						= $berita_list->real_viewer + 1;
				$info_viewer 						= $berita_list->viewer + 1;

				$this->public_home_model->update_table(array('id' => $berita_list->id), array('real_viewer' => $real_viewer), 'my_produk');
				$this->public_home_model->update_table(array('produk_id' => $berita_list->id), array('viewer' => $info_viewer), 'my_produk_info');

				//isi 
				$this->data['gambar_produk'] 		= $berita_list->gambar_utama;
				$this->data['status_produk'] 		= $berita_list->status;
				$this->data['video_produk'] 		= $berita_list->video_youtube;
				$this->data['berat_produk'] 		= $berita_list->berat;
				$this->data['kondisi_produk'] 		= $berita_list->kondisi;
				$this->data['terjual_produk'] 		= $berita_list->terjual;
				$this->data['lihat_produk'] 		= $berita_list->viewer;
				$this->data['harga_produk'] 		= $berita_list->harga;
				$this->data['deskripsi_produk'] 	= $berita_list->deskripsi;
				//merek
				if ($berita_list->merek == 0) {
					$this->data['merek_produk'] 	= 'No Brand';
				} else {
					$this->data['merek_produk'] 	= $this->public_home_model->get(array('id' => $berita_list->merek), 'my_merek')->row()->merek;
				}
				//Type
				$this->data['type_produk'] 			= $berita_list->type_produk;
				$this->data['stok_produk'] 			= $berita_list->stok;
				//portal
				$this->data['portal_produk'] 		= $this->public_home_model->portal_produk_detail(array('my_produk_portal.produk_id' => $berita_list->id))->result();
				$this->data['list_image'] 			= $this->public_home_model->get(array('produk_id' => $berita_list->id, 'status' => 0), 'my_produk_image')->result();
				$this->data['id'] 					= $berita_list->id;

				//fiture produk
				$this->data['produk_best_seller'] 	= $this->public_home_model->search_produk(null, null, 6, 0, array('my_produk.real_viewer', 'desc'), 'my_produk')->result();
				$this->data['produk_related'] 		= $this->public_home_model->search_produk(null, null, 6, 0, array('my_produk.tanggal', 'desc'), 'my_produk')->result();
				$this->data['produk_hot_deal'] 		= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 6, 0, array('my_produk.tanggal', 'desc'), 'my_produk')->result();

				$this->load->view('out_theme/produk/index', $this->data);
			} else {
				redirect('/');
			}
		}
		else if ($url == 'order') {

			$this->data['title'] = 'Total Pesanan';
			$this->data['image_og'] 				= base_url('upload/system/logo.png');
			$this->data['og_description'] 			= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
			$this->load->view('out_theme/order/index', $this->data);
		}
		else if ($url == 'order_out') {

			$this->data['title'] = 'Total Pesanan';
			$this->data['image_og'] 				= base_url('upload/system/logo.png');
			$this->data['og_description'] 			= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
			$this->data['portal'] 					= $this->public_home_model->get(null, 'my_portal')->result();
			$this->load->view('out_theme/order_out/index', $this->data);
		}
		else if ($url == 'check-out') {

			$this->data['title'] = 'Check Out Pesanan';
			$this->data['image_og'] 				= base_url('upload/system/logo.png');
			$this->data['og_description'] 			= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
			$this->data['provinsi_select']			= '';
			$this->data['kabupaten_select']			= '';
			$this->data['kecamatan_select']			= '';
			$this->data['kelurahan_select']			= '';
			$this->data['data_kabupaten']			= '';
			$this->data['data_provinsi'] 			= $this->public_home_model->get_list(null, null, null, array('id', 'desc'), 'provinsi')->result();
			$this->load->view('out_theme/check_out/index', $this->data);
		}
		else if ($url == 'invoice') {

			$slug = $this->uri->segment(2);
			$data_cek = $this->public_home_model->get(array('no_transaksi' => $slug, 'status' => 'proses'), 'my_penjualan');
			if ($data_cek->num_rows() > 0) {
				$this->data['title'] = 'Check Out Pesanan';
				$this->data['image_og'] 				= base_url('upload/system/logo.png');
				$this->data['og_description'] 			= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
				$this->data['data_transaksi'] 			= $this->public_home_model->get(array('no_transaksi' => $slug), 'my_penjualan')->row();
				$this->data['data_produk'] 				= $this->public_home_model->get(array('no_transaksi' => $slug), 'my_penjualan_item')->result();
				$this->load->view('out_theme/invoice/index', $this->data);
			} else {
				redirect('/');
			}
		}
		else if ($url == 'create_order') {
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('telpon', 'Telpon', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
			$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
			$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
			$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');

			if ($this->form_validation->run() === TRUE) {
				//CEK AREA PEKANBARU
				if ($this->input->post('kabupaten') == '1471') {
					//insert pelanggan
					$pelanggan_array = array(
						'pelanggan'		=> $this->input->post('nama_lengkap'),
						'alamat'		=> $this->input->post('alamat'),
						'kelurahan'		=> $this->input->post('kelurahan'),
						'kecamatan'		=> $this->input->post('kecamatan'),
						'kabupaten'		=> $this->input->post('kabupaten'),
						'propinsi'		=> $this->input->post('provinsi'),
						'hp'			=> $this->input->post('telpon')
					);
					$this->public_home_model->insert_table($pelanggan_array, 'my_pelanggan');
					$id_pelanggan = $this->db->insert_id();

					$invoice = time();
					$total = 0;

					//tambah penjualan items
					$cart_session = $this->session->userdata('cart_session');
					foreach ($cart_session as $cs => $value) {
						$rowss = $this->costume->get_produk($cs);
						$total += $rowss->harga * $value;
						$total_s = $rowss->harga * $value;

						$items_array = array(
							'no_transaksi'		=> $invoice,
							'produk_id'			=> $cs,
							'harga'				=> $rowss->harga,
							'kuantitas'			=> $value,
							'jumlah_harga'		=> $total_s
						);
						$this->public_home_model->insert_table($items_array, 'my_penjualan_item');
					}

					//genered QRcode
					$this->load->library('ciqrcode');
					$qr_image = rand() . '.png';
					$params['data'] = $invoice;
					$params['level'] = 'H';
					$params['size'] = 10;
					$params['savename'] = FCPATH . "upload/qr_image/" . $qr_image;

					if ($this->ciqrcode->generate($params)) {
						$this->data['img_url'] = $qr_image;
					}

					//tambah penjualan
					$penjualan_array = array(
						'no_transaksi' 		=> $invoice,
						'pelanggan_id' 		=> $id_pelanggan,
						'total' 			=> $total,
						'status' 			=> 'proses',
						'tanggal' 			=> date("Y-m-d H:i:s"),
						'qr_image' 			=> 'upload/qr_image/' . $qr_image
					);
					$this->public_home_model->insert_table($penjualan_array, 'my_penjualan');

					//delete sesion cart
					$this->session->unset_userdata('cart_session');

					redirect('invoice/' . $invoice, 'refresh');
				} else {
					redirect('order_out', 'refresh');
				}
			}
			echo 'gak ada';
		}
		else {
			$this->data['title'] = 'Home';

			$this->data['image_og'] 				= base_url('upload/system/logo.png');
			$this->data['og_description'] 			= $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
			$this->data['hot_deal'] 				= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 4, 0, array('my_produk.id', 'desc'), 'my_produk')->result();
			$this->data['produk_new_1'] 			= $this->public_home_model->search_produk(null, null, 2, 0, array('my_produk.tanggal', 'desc'), 'my_produk')->result();
			$this->data['produk_new_2'] 			= $this->public_home_model->search_produk(null, null, 2, 2, array('my_produk.tanggal', 'desc'), 'my_produk')->result();
			$this->data['produk_new_3'] 			= $this->public_home_model->search_produk(null, null, 2, 4, array('my_produk.tanggal', 'desc'), 'my_produk')->result();
			$this->data['produk_new_4'] 			= $this->public_home_model->search_produk(null, null, 2, 6, array('my_produk.tanggal', 'desc'), 'my_produk')->result();

			///--------------------------------------------------------------------
			$this->data['home_slider'] 				= $this->public_home_model->get_list(null, 4, 0, array('id', 'desc'), 'my_slider')->result();
			$this->data['produk_promo_count'] 		= $this->public_home_model->count_where_table(array('my_produk.promo' => 1), 'my_produk');
			$this->data['produk_promo_1'] 			= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 4, 0, array('my_produk.id', 'desc'), 'my_produk')->result();
			$this->data['produk_promo_2'] 			= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 4, 5, array('my_produk.id', 'desc'), 'my_produk')->result();
			$this->data['produk_promo_3'] 			= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 4, 9, array('my_produk.id', 'desc'), 'my_produk')->result();
			$this->data['produk_promo_4'] 			= $this->public_home_model->search_produk(null, array('my_produk.promo' => 1), 4, 13, array('my_produk.id', 'desc'), 'my_produk')->result();
			$this->data['latest_produk'] 			= $this->public_home_model->search_produk(null, null, 9, 0, array('my_produk.tanggal', 'desc'), 'my_produk')->result();

			//iklan
			$this->data['iklan_sidebar_kanan_1'] 	= $this->public_home_model->get_iklan(array('posisi' => '2', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kanan_2'] 	= $this->public_home_model->get_iklan(array('posisi' => '3', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kanan_3'] 	= $this->public_home_model->get_iklan(array('posisi' => '4', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kanan_4'] 	= $this->public_home_model->get_iklan(array('posisi' => '5', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kiri_1'] 	= $this->public_home_model->get_iklan(array('posisi' => '6', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kiri_2'] 	= $this->public_home_model->get_iklan(array('posisi' => '7', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kiri_3'] 	= $this->public_home_model->get_iklan(array('posisi' => '8', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_sidebar_kiri_4'] 	= $this->public_home_model->get_iklan(array('posisi' => '9', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_index_1'] 			= $this->public_home_model->get_iklan(array('posisi' => '10', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_index_2'] 			= $this->public_home_model->get_iklan(array('posisi' => '11', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_index_3'] 			= $this->public_home_model->get_iklan(array('posisi' => '12', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_index_4'] 			= $this->public_home_model->get_iklan(array('posisi' => '13', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();
			$this->data['iklan_index_5'] 			= $this->public_home_model->get_iklan(array('posisi' => '14', 'tampilan' => 'desktop', 'status' => '2'), 'my_iklan')->row();

			//$this->output->enable_profiler(TRUE);
			$this->load->view('out_theme/home/index', $this->data);
		}
	}

	public function add_keranjang()
	{

		$product_cart = array();

		if ($this->session->userdata('cart_session')) {

			$cart_session = $this->session->userdata('cart_session');

			foreach ($cart_session as $id => $val) {
				$product_cart[$id] = $val;
			}
		}

		if ($this->input->post('qty')) {
			$qty_add = $this->input->post('qty');
		} else {
			$qty_add = 1;
		}
		$product_cart[$this->input->post('product_id')] = $qty_add;

		$this->session->set_userdata('cart_session', $product_cart);

		$cart_session = $this->session->userdata('cart_session');

		$arr = array();
		$arr['update_cart'] = array_sum($cart_session);
		echo json_encode($arr);
	}

	public function delete_keranjang()
	{

		$product_cart = array();

		if ($this->session->userdata('cart_session')) {

			$cart_session = $this->session->userdata('cart_session');

			foreach ($cart_session as $id => $val) {
				if ($this->input->post('product_id') == $id) {
				} else {
					$product_cart[$id] = $val;
				}
			}
		}

		$this->session->set_userdata('cart_session', $product_cart);

		$cart_session = $this->session->userdata('cart_session');

		$arr = array();
		$arr['update_cart'] = array_sum($cart_session);
		echo json_encode($arr);
	}

	public function get_kab()
	{
		$search 						= $this->input->post('id');
		$this->data['kabupaten_select'] = $this->input->post('kab');
		$this->data['data_kabupaten']  	= $this->public_home_model->get_list(array('prov_id' => $search), null, null, array('id', 'desc'), 'kabupaten')->result();
		$kab 							= $this->load->view('out_theme/check_out/kab_select', $this->data, true);
		$data = array(
			'kab' => $kab
		);
		echo json_encode($data);
	}

	public function get_kec()
	{
		$search 						= $this->input->post('id');
		$this->data['kecamatan_select'] = $this->input->post('kec');
		$this->data['data_kecamatan']  	= $this->public_home_model->get_list(array('kab_id' => $search), null, null, array('id', 'desc'), 'kecamatan')->result();
		$kec 							= $this->load->view('out_theme/check_out/kec_select', $this->data, true);
		$data = array(
			'kec' => $kec
		);
		echo json_encode($data);
	}

	public function get_kel()
	{
		$search 						= $this->input->post('id');
		$this->data['kelurahan_select'] = $this->input->post('kel');
		$this->data['data_kelurahan']  	= $this->public_home_model->get_list(array('kec_id' => $search), null, null, array('id', 'desc'), 'kelurahan')->result();
		$kel 							= $this->load->view('out_theme/check_out/kel_select', $this->data, true);
		$data = array(
			'kel' => $kel
		);
		echo json_encode($data);
	}

	public function download_gambar($id)
	{
		$data_cek = $this->public_home_model->get(array('no_transaksi' => $id), 'my_penjualan');
		if ($data_cek->num_rows() > 0) {
			force_download(FCPATH . $data_cek->row()->qr_image, NULL);
		}
	}
}
