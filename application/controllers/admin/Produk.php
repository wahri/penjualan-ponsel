<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends Admin_Controller
{
	protected $table_row = 10;
	protected $list_item_row = 32;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->library('pagination');
		$this->load->helper('fungsidate');
        $this->load->model('admin_produk_model');
		$this->load->model('admin_kategori_produk_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Produk';
		
		$this->data['kategori_parent'] 	= $this->admin_kategori_produk_model->get_list(array('induk'=>0), null, null, array('id','asc'))->result();
		$this->data['produk_parent'] 	= $this->admin_produk_model->get_produk(null, 10, 0,  array('my_produk.id','desc'))->result();
		$this->data['estalase_parent'] 	= $this->admin_produk_model->get_table('my_estalase', null)->result();
		$this->data['merek_parent'] 	= $this->admin_produk_model->get_table('my_merek', null)->result();
		
		$config['per_page'] 			= 10;
		$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$etalase_select 			= '';
		$katagori_select			= '';
		$result_select				= '';
		$reset_filter				= '';
		
		//filter
		if (isset($_POST['filter_button'])) {
			if($this->input->post('etalase_select') > 0){
				if($this->input->post('merek_select') > 0){
					$etalase_select 		= $this->input->post('etalase_select');
					$merek_select			= $this->input->post('merek_select');
					$reset_filter			= 1;
					$result_select 			= array ("estalase" => $etalase_select , "merek" => $merek_select);
					$this->session->set_userdata(array("etalase_select"=> $etalase_select , "merek_select"=> $merek_select));
				}else{
					$etalase_select 		= $this->input->post('etalase_select');
					$merek_select			= '';
					$reset_filter			= 1;
					$result_select 			= array ("estalase" => $etalase_select);
					$this->session->set_userdata(array("etalase_select"=> $etalase_select));
				}
			}else{
				if($this->input->post('merek_select') > 0){
					$etalase_select 		= '';
					$merek_select			= $this->input->post('merek_select');
					$reset_filter			= 1;
					$result_select 			= array ("merek" => $merek_select);
					$this->session->set_userdata(array("merek_select"=> $merek_select));
				}else{
					$etalase_select 		= '';
					$merek_select			= '';
					$result_select 			= '';
					$reset_filter			= '';
					$this->session->unset_userdata(array('etalase_select','merek_select'));
				}
			}
		
		} else if (isset($_POST['reset_button'])) {
			//reset filter
			$etalase_select 		= '';
			$merek_select			= '';
			$result_select 			= '';
			$reset_filter			= '';
			$this->session->unset_userdata(array('etalase_select','merek_select'));
		} else {
			//normal
			if($this->session->userdata('etalase_select') != NULL){
				if($this->session->userdata('merek_select') != NULL){
					$etalase_select 		= $this->session->userdata('etalase_select');
					$merek_select			= $this->session->userdata('merek_select');
					$reset_filter			= 1;
					$result_select 			= array ("estalase" => $etalase_select , "merek" => $merek_select);
				}else{
					$etalase_select 		= $this->session->userdata('etalase_select');
					$merek_select			= '';
					$reset_filter			= 1;
					$result_select 			= array ("estalase" => $etalase_select);
				}
			}else{
				if($this->session->userdata('merek_select') != NULL){
					$etalase_select 		= '';
					$reset_filter			= 1;
					$merek_select			= $this->session->userdata('merek_select');
					$result_select 			= array ("merek" => $merek_select);
				}else{
					$etalase_select 		= '';
					$merek_select			= '';
					$result_select 			= '';
					$reset_filter			= '';
				}
				
			}
		}
		
		$this->data['produk_parent'] 			= $this->admin_produk_model->get_produk($result_select, $config['per_page'], $pagging,  array('my_produk.id','desc'))->result();
		
		$jumlah_data 							= $this->admin_produk_model->count_where($result_select);
		$this->data['etalase_select'] 			= $etalase_select;
		$this->data['merek_select'] 			= $merek_select;
		$this->data['reset_select'] 			= $reset_filter;
		
		$config['base_url'] 					= site_url('admin/produk/index/');
		$config['full_tag_open'] 				= '<ul class="pagination">';
		$config['full_tag_close'] 				= '</ul>';
		$config['prev_link'] 					= '&lt;';
		$config['prev_tag_open'] 				= '<li>';
		$config['prev_tag_close'] 				= '</li>';
		$config['next_link'] 					= '&gt;';
		$config['next_tag_open'] 				= '<li>';
		$config['next_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 				= '</a></li>';
		$config['num_tag_open'] 				= '<li>';
		$config['num_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li>';
		$config['first_tag_close'] 				= '</li>';
		$config['last_tag_open'] 				= '<li>';
		$config['last_tag_close'] 				= '</li>';
		$config['first_link'] 					= '&lt;&lt; Previous';
		$config['last_link'] 					= 'Next &gt;&gt;';
		$config['total_rows'] 					= $jumlah_data;
		
		
		$this->pagination->initialize($config);	
					
		
		$start									= (int)$this->uri->segment(4) +1;
		if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment(4) + $config['per_page'];
		}
		
		$this->data['result_count']				= "Showing ".$start." - ".$end." of ".$jumlah_data." Results";
				
		$this->load->view('admin/produk/view/index', $this->data);
    }
	
	public function add(){
			$this->data['title'] 				= 'Tambah Produk';
			$this->data['kategori_parent'] 		= $this->admin_produk_model->get_table('my_category_produk', array('induk'=>0))->result();
			
			$this->data['kategori_parent_dua'] 	= "";
			$this->data['kategori_parent_tiga'] = "";
			
			$this->data['portal'] 				= $this->admin_produk_model->get_table('my_portal', null)->result();
			$this->data['merek'] 				= $this->admin_produk_model->get_table('my_merek', null)->result();
			$this->data['estalase'] 			= $this->admin_produk_model->get_table('my_estalase', null)->result();
			$this->data['rating_berita'] 		= 5;
			$this->data['status_produk'] 		= '';
			$this->data['kondisi_produk'] 		= '';
			$this->data['estalase_produk'] 		= '';
			
			$this->data['nama_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'nama_produk',
				'id' 			=> 'nama_produk',
				'type' 			=> 'text',
				'placeholder' 	=> 'nama_produk',
				'autofocus' 	=> 'autofocus',
				'value' 		=> $this->form_validation->set_value('nama_produk', ''),
			);
			$this->data['harga_produk'] = array(
				'class' 		=> 'form-control has-feedback-left',
				'name' 			=> 'harga_produk',
				'id' 			=> 'harga_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('harga_produk', ''),
			);
			$this->data['stok_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'stok_produk',
				'id' 			=> 'stok_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('stok_produk', ''),
			);
			$this->data['berat_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'berat_produk',
				'id' 			=> 'berat_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('berat_produk', ''),
			);
			$this->data['type_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'type_produk',
				'id' 			=> 'type_produk',
				'type' 			=> 'text',
				'value' 		=> $this->form_validation->set_value('type_produk', ''),
			);
			$this->data['editor'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'editor',
				'id' 			=> 'editor',
				'type' 			=> 'textarea',
				'value' 		=> $this->form_validation->set_value('editor', ''),
			);
			
			$this->data['id_video'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'id_video',
				'id' 			=> 'id_video',
				'type' 			=> 'text',
				'placeholder' 	=> 'ID Youtube',
				'value' 		=> $this->form_validation->set_value('id_video', ''),
			);
			
		$this->load->view('admin/produk/add/index', $this->data);
	}
	
	public function add_produk(){
		$this->data['title'] 			= 'Tambah Produk';
		$this->data['kategori_parent'] 	= $this->admin_produk_model->get_table('my_category_produk', array('induk'=>0))->result();	
		$this->data['merek'] 			= $this->admin_produk_model->get_table('my_merek', null)->result();
		$this->data['estalase'] 		= $this->admin_produk_model->get_table('my_estalase', null)->result();
		$portal 						= $this->admin_produk_model->get_table('my_portal', null)->result();
		$this->data['portal'] 			= $portal; 
		
		$this->form_validation->set_rules('nama_produk','Nama Produk','required');
		$this->form_validation->set_rules('kat1','Kategori','required');
		$this->form_validation->set_rules('harga_produk','Harga','required');
		$this->form_validation->set_rules('berat_produk','Berat','required');
		$this->form_validation->set_rules('status','Status Produk','required');
		$this->form_validation->set_rules('kondisi','Kondisi Produk','required');
		$this->form_validation->set_rules('estalase','Estalase Produk','required');
		$this->form_validation->set_rules('editor','Deskripsi Produk','required');
		$this->form_validation->set_rules('type_produk','Type Produk','required');
		$this->form_validation->set_rules('stok_produk','Stok Produk','required');
		
		$nama			= 	$this->input->post('nama_produk');
		$kategori	 	= 	$this->input->post('kat1');
		$image_thumb	= 	$this->input->post('image_thumb');
		$image 			= 	$this->input->post('images');
		$harga  		= 	$this->input->post('harga_produk');
		$berat			= 	$this->input->post('berat_produk');
		$status 		= 	$this->input->post('status');
		$kondisi	 	= 	$this->input->post('kondisi');
		$estalase 		= 	$this->input->post('estalase');
		$editor 		= 	$this->input->post('editor');
		$id_youtube		=	$this->input->post('id_video');
		$promo 			=	$this->input->post('promo');
		$kat2			=	$this->input->post('kat2');
		$kat3			=	$this->input->post('kat3');
		$merek			=	$this->input->post('merek');
		$code			=	$this->input->post('code_produk');
		$tipe			=	$this->input->post('type_produk');
		$stok			=	$this->input->post('stok_produk');
		
		if ($this->form_validation->run() === TRUE) {
			$new_url = $this->costume->clean($nama);
			//cek jika url tersedia
			$cek_data = $this->admin_produk_model->get(array('url_produk' => $new_url));
			if($cek_data->num_rows() > 0){	
				$url = $new_url.'-'.$cek_data->num_rows();
			}else{
				$url = $new_url;
			}
			if($this->input->post('image_thumb') == ''){
				$image_thumb	= 	$image[0];
			}else{
				$image_thumb	= 	$this->input->post('image_thumb');
			}
			/*Tambah produk*/
			$insert_produk = array(
				'sku'			=>	time(),
				'type_produk'	=>	$tipe,
				'nama_produk' 	=>	$nama, 
				'gambar_utama'	=>	$image_thumb , 
				'video_youtube' =>	$id_youtube, 
				'url_produk'	=> 'produk/'.$url,
				'harga' 		=>	$harga, 
				'berat' 		=>	$berat, 
				'status' 		=>	$status, 
				'estalase' 		=>	$estalase,
				'merek' 		=>	$merek,				
				'deskripsi' 	=>	$editor, 
				'tanggal' 		=>	date("Y-m-d H:i:s"),
				'real_viewer' 	=>	0, 
				'promo'			=>	$promo, 
				'kondisi' 		=>	$kondisi, 
				'stok' 			=>	$stok, 
				'create_time'	=>  date("Y-m-d H:i:s"), 
				'create_by' 	=> 	$this->ion_auth->get_user_id() ,
			);
			$this->admin_produk_model->insert($insert_produk);
            $id_produk = $this->db->insert_id();
			
			/*Tambbah info produk*/
			$insert_info = array(
				'produk_id'		=>	$id_produk,
				'viewer'		=>	0, 
				'likers'		=>	0, 
				'share'			=>	0, 
				'rating_vote'	=>	0, 
				'rating_value'	=>	0,  
				'terjual'		=>	0,
			);
			$this->admin_produk_model->insert_table($insert_info ,'my_produk_info');
			
			/*Tambbah kategori*/
			if (!empty($kategori)) {
				$this->admin_produk_model->insert_table(array('produk_id'=>$id_produk , 'category_id'=>$kategori), 'my_produk_kategori');
			}
			if (!empty($kat2)) {
				$this->admin_produk_model->insert_table(array('produk_id'=>$id_produk , 'category_id'=>$kat2), 'my_produk_kategori');
			}
			if (!empty($kat3)) {
				$this->admin_produk_model->insert_table(array('produk_id'=>$id_produk , 'category_id'=>$kat3), 'my_produk_kategori');
			}
			
			/*Tambbah image*/
			if (!empty($image)) {
				foreach($image as $images) {
					if ($image_thumb == $images) {
						$items_image = array(
							'produk_id' => $id_produk,
							'image_id' 	=> $images,
							'status' 	=> 1
						);
					} else {
						$items_image = array(
							'produk_id' => $id_produk,
							'image_id' 	=> $images,
							'status' 	=> 0
						);
					}
					$this->admin_produk_model->insert_table($items_image, 'my_produk_image');
				}
			}
			
			/*Tambbah portal*/
			
				foreach($portal as $jual){
					if(!empty($this->input->post($jual->portal))){
						$this->admin_produk_model->insert_table(array('produk_id'=>$id_produk , 'portal_id'=>$jual->id, 'url_portal'=> $this->input->post($jual->portal)), 'my_produk_portal');
					}
				}

			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
			redirect('admin/produk', 'refresh');	
			
		}else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			/*Untuk view form*/
			$this->data['kategori_parent_dua'] 	= $kat2;
			$this->data['kategori_parent_tiga'] = $kat3;
			$this->data['status_produk'] 		= $status;
			$this->data['kondisi_produk'] 		= $kondisi;
			$this->data['estalase_produk'] 		= $estalase;
			$this->data['images'] 				= $image;
			$this->data['image_thumb'] 			= $image_thumb;
			
			$this->data['nama_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'nama_produk',
				'id' 			=> 'nama_produk',
				'type' 			=> 'text',
				'placeholder' 	=> 'nama_produk',
				'autofocus' 	=> 'autofocus',
				'value' 		=> $this->form_validation->set_value('nama_produk', $nama),
			);
			$this->data['harga_produk'] = array(
				'class' 		=> 'form-control has-feedback-left',
				'name' 			=> 'harga_produk',
				'id' 			=> 'harga_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('harga_produk', $harga),
			);
			$this->data['berat_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'berat_produk',
				'id' 			=> 'berat_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('berat_produk', $berat),
			);
			
			$this->data['stok_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'stok_produk',
				'id' 			=> 'stok_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('stok_produk', $stok),
			);
			
			$this->data['type_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'type_produk',
				'id' 			=> 'type_produk',
				'type' 			=> 'text',
				'value' 		=> $this->form_validation->set_value('type_produk', $tipe),
			);	
			$this->data['editor'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'editor',
				'id' 			=> 'editor',
				'type' 			=> 'textarea',
				'value' 		=> $this->form_validation->set_value('editor', $editor),
			);
			
			$this->data['id_video'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'id_video',
				'id' 			=> 'id_video',
				'type' 			=> 'text',
				'placeholder' 	=> 'ID Youtube',
				'value' 		=> $this->form_validation->set_value('id_video', $id_youtube),
			);
			$this->load->view('admin/produk/add/index', $this->data);
		}
		
	}
	
	/*fungsi untuk menampilkan edit berita*/
	public function edit($id = NULL){
		$cek_data = $this->admin_produk_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			$this->data['title'] 				= 'Sunting Produk';
			$this->data['kategori_parent'] 		= $this->admin_produk_model->get_table('my_category_produk', array('induk'=>0))->result();
			
			$this->data['kategori_parent_dua'] 	= "";
			$this->data['kategori_parent_tiga'] = "";
			
			$this->data['portal'] 				= $this->admin_produk_model->get_table('my_portal', null)->result();
			$this->data['merek'] 				= $this->admin_produk_model->get_table('my_merek', null)->result();
			$this->data['estalase'] 			= $this->admin_produk_model->get_table('my_estalase', null)->result();
			
			$this->data['status_produk'] 		= '';
			$this->data['kondisi_produk'] 		= '';
			$this->data['estalase_produk'] 		= '';
			
			
			$produk 	= $cek_data->row();
			$kategori 	= $this->admin_produk_model->get_table('my_produk_kategori', array('produk_id'=>$id))->result();
			$info	 	= $this->admin_produk_model->get_table('my_produk_info', array('produk_id'=>$id))->result();
			$image	 	= $this->admin_produk_model->get_table('my_produk_image', array('produk_id'=>$id))->result();
			$portal	 	= $this->admin_produk_model->get_table('my_produk_portal', array('produk_id'=>$id))->result();
			
			$all_category = null;
			foreach($kategori as $data_kategori){
				$all_category[] = $data_kategori->category_id;
			}
			
			$all_image = null;
			foreach($image as $data_image){
				$all_image[] = $data_image->image_id;
			}
			
			$this->data['produk_id'] 		= $id;
			$this->data['catagory_select'] 	= $all_category;
			$this->data['merek_select'] 	= $produk->merek;
			$this->data['image_thumb'] 		= $produk->gambar_utama;
			$this->data['images'] 			= $all_image;
			$this->data['status_produk'] 	= $produk->status;
			$this->data['kondisi_produk'] 	= $produk->kondisi;
			$this->data['promo_produk'] 	= $produk->promo;
			$this->data['estalase_produk'] 	= $produk->estalase;
			$this->data['batas_pilih_image'] = 5;
			
			$this->data['nama_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'nama_produk',
				'id' 			=> 'nama_produk',
				'type' 			=> 'text',
				'placeholder' 	=> 'nama_produk',
				'autofocus' 	=> 'autofocus',
				'value' 		=> $this->form_validation->set_value('nama_produk', $produk->nama_produk),
			);
			$this->data['harga_produk'] = array(
				'class'			=> 'form-control has-feedback-left',
				'name' 			=> 'harga_produk',
				'id' 			=> 'harga_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('harga_produk', $produk->harga),
			);
			$this->data['berat_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'berat_produk',
				'id' 			=> 'berat_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('berat_produk', $produk->berat),
			);
			$this->data['stok_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'stok_produk',
				'id' 			=> 'stok_produk',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('stok_produk', $produk->stok),
			);
			$this->data['type_produk'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'type_produk',
				'id' 			=> 'type_produk',
				'type' 			=> 'text',
				'value' 		=> $this->form_validation->set_value('type_produk', $produk->type_produk),
			);
			$this->data['editor'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'editor',
				'id' 			=> 'editor',
				'type' 			=> 'textarea',
				'value' 		=> $this->form_validation->set_value('editor', $produk->deskripsi),
			);
			
			$this->data['id_video'] = array(
				'class' 		=> 'form-control',
				'name' 			=> 'id_video',
				'id' 			=> 'id_video',
				'type' 			=> 'text',
				'placeholder' 	=> 'ID Youtube',
				'value' 		=> $this->form_validation->set_value('id_video', $produk->video_youtube),
			);
			$this->load->view('admin/produk/edit/index', $this->data);
		
		}else{
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			redirect('admin/produk', 'refresh');
		}
	}
	
	/*fungsi untuk post edit berita */
	public function edit_produk(){
		if (!empty($_POST)) {
			$portal = $this->admin_produk_model->get_table('my_portal', null)->result();
			$this->data['portal'] = $portal; 
			$this->form_validation->set_rules('nama_produk','Nama Produk','required');
			$this->form_validation->set_rules('kat1','Kategori','required');
			$this->form_validation->set_rules('image_thumb','Gambar Utama','required');
			$this->form_validation->set_rules('harga_produk','Harga','required');
			$this->form_validation->set_rules('berat_produk','Berat','required');
			$this->form_validation->set_rules('status','Status Produk','required');
			$this->form_validation->set_rules('kondisi','Kondisi Produk','required');
			$this->form_validation->set_rules('estalase','Estalase Produk','required');
			$this->form_validation->set_rules('editor','Deskripsi Produk','required');
			$this->form_validation->set_rules('type_produk','Type Produk','required');
			$this->form_validation->set_rules('stok_produk','Stok Produk','required');
			
			$id				=	$this->input->post('produk_id');
			$nama			= 	$this->input->post('nama_produk');
			$kategori	 	= 	$this->input->post('kat1');
			$image_thumb	= 	$this->input->post('image_thumb');
			$image 			= 	$this->input->post('images');
			$harga  		= 	$this->input->post('harga_produk');
			$berat			= 	$this->input->post('berat_produk');
			$status 		= 	$this->input->post('status');
			$kondisi	 	= 	$this->input->post('kondisi');
			$estalase 		= 	$this->input->post('estalase');
			$editor 		= 	$this->input->post('editor');
			$id_youtube		=	$this->input->post('id_video');
			$promo 			=	$this->input->post('promo');
			$kat2			=	$this->input->post('kat2');
			$kat3			=	$this->input->post('kat3');
			$merek			=	$this->input->post('merek');
			$tipe			=	$this->input->post('type_produk');
			$stok			=	$this->input->post('stok_produk');
			
			if ($this->form_validation->run() === TRUE) {
				if($this->input->post('image_thumb') == ''){
					$image_thumb	= 	$image[1];
				}else{
					$image_thumb	= 	$this->input->post('image_thumb');
				}
				
				if(!empty($this->admin_produk_model->get(array('id' => $id))->row()->sku)){
					$insert_produk = array(
						'type_produk'	=>	$tipe,
						'nama_produk' 	=>	$nama, 
						'gambar_utama'	=>	$image_thumb , 
						'video_youtube' =>	$id_youtube, 
						'harga' 		=>	$harga, 
						'berat' 		=>	$berat, 
						'status' 		=>	$status, 
						'estalase' 		=>	$estalase,
						'merek' 		=>	$merek,				
						'deskripsi' 	=>	$editor,
						'promo'			=>	$promo, 
						'kondisi' 		=>	$kondisi,
						'stok' 			=>	$stok, 
					);
				}else{
					$insert_produk = array(
						'sku'			=>	time(),
						'type_produk'	=>	$tipe,
						'nama_produk' 	=>	$nama, 
						'gambar_utama'	=>	$image_thumb , 
						'video_youtube' =>	$id_youtube, 
						'harga' 		=>	$harga, 
						'berat' 		=>	$berat, 
						'status' 		=>	$status, 
						'estalase' 		=>	$estalase,
						'merek' 		=>	$merek,				
						'deskripsi' 	=>	$editor,
						'promo'			=>	$promo, 
						'kondisi' 		=>	$kondisi,
						'stok' 			=>	$stok, 
					);
				}
				$this->admin_produk_model->update(array('id'=>$id), $insert_produk, 'my_produk');
				
				/*Tambbah kategori*/
				$this->admin_produk_model->delete_table(array('produk_id'=>$id),'my_produk_kategori');
				if (!empty($kategori)) {
					$this->admin_produk_model->insert_table(array('produk_id'=>$id , 'category_id'=>$kategori), 'my_produk_kategori');
				}
				if (!empty($kat2)) {
					$this->admin_produk_model->insert_table(array('produk_id'=>$id , 'category_id'=>$kat2), 'my_produk_kategori');
				}
				if (!empty($kat3)) {
					$this->admin_produk_model->insert_table(array('produk_id'=>$id , 'category_id'=>$kat3), 'my_produk_kategori');
				}
				
				/*Tambbah image*/
				$this->admin_produk_model->delete_table(array('produk_id'=>$id),'my_produk_image');
				if (!empty($image)) {
					foreach($image as $images) {
						if ($image_thumb == $images) {
							$items_image = array(
								'produk_id' => $id,
								'image_id' 	=> $images,
								'status' 	=> 1
							);
						} else {
							$items_image = array(
								'produk_id' => $id,
								'image_id' 	=> $images,
								'status' 	=> 0
							);
						}
						$this->admin_produk_model->insert_table($items_image, 'my_produk_image');
					}
				}
				
				/*Tambbah portal*/
				$this->admin_produk_model->delete_table(array('produk_id'=>$id),'my_produk_portal');
				foreach($portal as $jual){
					if(!empty($this->input->post($jual->portal))){
						$this->admin_produk_model->insert_table(array('produk_id'=>$id , 'portal_id'=>$jual->id, 'url_portal'=> $this->input->post($jual->portal)), 'my_produk_portal');
					}
				}

				$this->session->set_flashdata('success', 'Berhasil Menambah Data');
				redirect('admin/produk', 'refresh');
				
			}else{
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				/*Untuk view form*/
				$this->data['title'] 				= 'Sunting Produk';
				$this->data['kategori_parent'] 		= $this->admin_produk_model->get_table('my_category_produk', array('induk'=>0))->result();	
				$this->data['merek'] 				= $this->admin_produk_model->get_table('my_merek', null)->result();
				$this->data['estalase'] 			= $this->admin_produk_model->get_table('my_estalase', null)->result();
				$this->data['kategori_parent_dua'] 	= $kat2;
				$this->data['kategori_parent_tiga'] = $kat3;
				$this->data['status_produk'] 		= $status;
				$this->data['kondisi_produk'] 		= $kondisi;
				$this->data['estalase_produk'] 		= $estalase;
				$this->data['images'] 				= $image;
				$this->data['image_thumb'] 			= $image_thumb;
				$this->data['produk_id'] 			= $id;
				
				$this->data['nama_produk'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'nama_produk',
					'id' 			=> 'nama_produk',
					'type'			=> 'text',
					'placeholder' 	=> 'nama_produk',
					'autofocus' 	=> 'autofocus',
					'value' 		=> $this->form_validation->set_value('nama_produk', $nama),
				);
				$this->data['harga_produk'] = array(
					'class' 		=> 'form-control has-feedback-left',
					'name' 			=> 'harga_produk',
					'id' 			=> 'harga_produk',
					'type'			=> 'number',
					'value' 		=> $this->form_validation->set_value('harga_produk', $harga),
				);
				$this->data['berat_produk'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'berat_produk',
					'id' 			=> 'berat_produk',
					'type' 			=> 'number',
					'value' 		=> $this->form_validation->set_value('berat_produk', $berat),
				);
				$this->data['code_produk'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'code_produk',
					'id' 			=> 'code_produk',
					'type' 			=> 'text',
					'value' 		=> $this->form_validation->set_value('code_produk', $code),
				);
				$this->data['type_produk'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'type_produk',
					'id' 			=> 'type_produk',
					'type' 			=> 'text',
					'value' 		=> $this->form_validation->set_value('type_produk', $tipe),
				);
				$this->data['stok_produk'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'stok_produk',
					'id' 			=> 'stok_produk',
					'type' 			=> 'number',
					'value' 		=> $this->form_validation->set_value('stok_produk', $stok),
				);				
				$this->data['editor'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'editor',
					'id' 			=> 'editor',
					'type' 			=> 'textarea',
					'value' 		=> $this->form_validation->set_value('editor', $editor),
				);
				
				$this->data['id_video'] = array(
					'class' 		=> 'form-control',
					'name' 			=> 'id_video',
					'id' 			=> 'id_video',
					'type' 			=> 'text',
					'placeholder' 	=> 'ID Youtube',
					'value' 		=> $this->form_validation->set_value('id_video', $id_youtube),
				);
				
				$this->load->view('admin/produk/edit/index', $this->data);
				
			}
		}
	}
	
	
	/*pencarian berita*/
    public function search()
    {
        $search 							= $this->input->post('search');
		$this->data['produk_parent'] 		= $this->admin_produk_model->search(array('nama_produk' => $search), null, $this->table_row, 0, array('my_produk.id','desc'))->result();
		$view 								= $this->load->view('admin/produk/lib/list_page', $this->data);
        return $view;
    }
	
	public function search_by_estalase(){
		$search 							= $this->input->post('category');
		if($search == "produk kosong"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, array('status' => 0), $this->table_row, 0, array('my_produk.id','desc'))->result();
		}else if($search == "produk order"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, array('status' => 3), $this->table_row, 0, array('my_produk.id','desc'))->result();
		}else if($search == "estalase"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, null, $this->table_row, 0, array('my_produk.id','desc'))->result();
		}else if($search == "all"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, null, $this->table_row, 0, array('my_produk.id','desc'))->result();
		}else if($search == "produk terjual"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, null, $this->table_row, 0, array('my_produk_info.terjual','desc'))->result();
		}else{
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, array('estalase' => $search), $this->table_row, 0, array('my_produk.id','desc'))->result();
		}
		$view = $this->load->view('admin/produk/lib/list_page', $this->data);
        return $view;
	}
	
	/*Pencarian artikel berdasarkan kategori*/
    public function search_by_category()
    {
        $search 							= $this->input->post('category');
        if ($search == 'all') {
            $this->data['produk_parent'] 	= $this->admin_produk_model->search(null, null, $this->table_row, 0, array('my_produk.id','desc'))->result();
        } else {
			$this->data['produk_parent'] 	= $this->admin_produk_model->search_category(null, array('my_produk_kategori.category_id' => $search), $this->table_row, 0)->result();
        }
        $view = $this->load->view('admin/produk/lib/list_page', $this->data);
        return $view;
    }
	
	public function search_by_merek(){
		$search 							= $this->input->post('category');
		if($search == "all"){
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, null, $this->table_row, 0, array('my_produk.id','desc'))->result();
		}else{
			$this->data['produk_parent'] 	= $this->admin_produk_model->search(null, array('merek' => $search), $this->table_row, 0, array('my_produk.id','desc'))->result();
		}
		$view = $this->load->view('admin/produk/lib/list_page', $this->data);
        return $view;
	}
	
	public function search_category(){
		$search 	= $this->input->post('category');
		$cat		= $this->admin_produk_model->get_table('my_category_produk', array('induk'=>$search))->result();
		if(!empty($cat)){
			echo '<option value="">-- Pilihan --</option>';
			foreach($cat as $cet){
				echo '<option value="'.$cet->id.'">'.$cet->category.'</option>';
			}
		}else{
			echo "";
		}
     
	}
	
	/*Pagination table*/
    public function page($status = null)
    {
        $start 							= intval($this->input->post('start'));
        $start_limit 					= ($start * $this->table_row) - $this->table_row;
        $end 							= $this->table_row;
		
		$this->data['produk_parent'] 	= $this->admin_produk_model->get_produk(null,  $end, $start_limit,  array('my_produk.id','desc'))->result();
		$view = $this->load->view('admin/produk/lib/list_page', $this->data, true);

        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );
		echo json_encode($data);
    }
	
	public function delete()
    {
        $id = $this->input->post('id');
		/*Update berita*/
		$update_berita = array(
			'status_terbit'=> 'hapus',
			'delete_time'=> date("Y-m-d H:i:s"),
			'delete_by'=> $this->ion_auth->get_user_id()
		);
		$this->admin_berita_model->update(array('id'=>$id), $update_berita, 'my_berita');
        return true;
    }
	
	/*Modal untuk image gallery*/
    public function modal_fiture_library($batas_pilih_image = null)
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'produk'),40,0);
		$this->data['batas_pilih_image'] = $batas_pilih_image;
        $this->load->view('admin/produk/lib/modal_fiture_library', $this->data);
    }
	
	/*Data gambar untuk image library list*/
    public function image_library_list()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'produk'),40,0);
        $this->load->view('admin/produk/lib/content_media_library', $this->data);
    }
	
	/*Data gambar untuk image library list*/
    public function fitur_library_list()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'produk'),40,0);
        $this->load->view('admin/produk/lib/content_fieture_library', $this->data);
    }
	
	/*Fungsi untuk mengambil detail gambar*/
    public function detail_image()
    {
        $id = $this->input->post('id');
        $data_image = $this->all_image_model->get(array('parent' => $id, 'size' => '100x100', 'jenis' => 'produk'))->row_array();
		$data_image['url'] = base_url($data_image['url']);
		$data_image['id'] = $id;
        echo json_encode($data_image);

    }
	
	/*Fungsi untuk cetak lebel */
    public function cetak_lebel($id = NULL)
    {
        $cek_data = $this->admin_produk_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			$produk 					= $cek_data->row();
			$this->data['title'] 		= 'Label Produk';
			$this->data['sku'] 			= $produk->sku;
			$this->data['code'] 		= $produk->code_produk;
			$this->data['type'] 		= $produk->type_produk;
			$this->data['grade'] 		= $produk->kondisi;
			$this->data['merek'] 		= $this->admin_produk_model->get_table('my_merek', array('id' => $produk->merek))->row()->merek;
			//$kategori =                 $this->admin_produk_model->get_table('my_estalase', array('id' => $produk->estalase))->row()->estalase;
			$this->data['estalase'] 	= $this->admin_produk_model->get_table('my_estalase', array('id' => $produk->estalase))->row()->estalase;
			
			$this->load->library('ciqrcode');
			$qr_image=rand().'.png';
			$params['data'] = $produk->sku;
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] =FCPATH."upload/qr_image/".$qr_image;
			
			if($this->ciqrcode->generate($params))
			{
				$this->data['img_url']=$qr_image;	
			}
			$this->load->view('admin/produk/view/label', $this->data);
			//echo $id;
			
		}
    }
	
	public function add_image_item()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');

		$this->data['images'] = $id;
		$this->data['image_thumb'] = '';
        $this->data['batas_pilih_image'] = 5;
        $this->data['type'] = $type;
        $view = $this->load->view('admin/produk/lib/image_produk', $this->data, true);
        $output = array(
            'type' => $type,
            'view' => $view
        );
        echo json_encode($output);
    }
	
	/*Fungsi untuk upload gambar*/
    public function upload_image()
    {
        if (!empty($_FILES)) {
			  
			  $image_name = $this->data['website_judul'];
			  $new_name = strtotime("now").'-'.$this->data['website_judul'].'-'.$_FILES['image']['name'];
			  $config['upload_path'] = './upload/images/';
			  $config['allowed_types'] = 'gif|jpg|jpeg|png';
			  $config['file_name'] = $new_name;
			 

			  $this->load->library('upload', $config);
			  
			  if(!$this->upload->do_upload('image')){
				  echo $this->upload->display_errors();
			  }else{
					$data_image = $this->upload->data();
					/*Memasukkan data image kedalam database*/
                    $insert = array(
                        'title' => str_replace('_', ' ', $data_image['raw_name']),
                        'url' => ('upload/images/'.$data_image['file_name']),
                        'size' => 'original',
                        'image_name' => $data_image['file_name'],
                        'jenis' => 'produk',
						'parent' => 0,
                    );
                    $this->all_image_model->insert($insert);
                    $id_image = $this->db->insert_id();
										
					/*Membuat image thumbnail*/
                    $size1 = array(
                        'width' => 100,
                        'height' => 100
                    );

                    $this->costume->create_image_thumbnail($data_image, $size1, $id_image, 'produk');
					
					/*Membuat image thumbnail*/
                    $size2 = array(
                        'width' => 200,
                        'height' => 200
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size2, $id_image, 'produk');
					
					/*Membuat image thumbnail*/
                    $size3 = array(
                        'width' => 300,
                        'height' => 300
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size3, $id_image, 'produk');
					
			  }
		}
    }

}