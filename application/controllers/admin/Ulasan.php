<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->library('pagination');
		$this->load->helper('fungsidate');
        $this->load->model('admin_ulasan_model');
		$this->load->model('admin_produk_model');
		$this->load->model('admin_pelanggan_model');
		$this->load->model('admin_portal_model');
		$this->load->model('all_image_model');
    }

	/*fungsi untuk menampilkan edit berita*/
	public function tambah($id = NULL){
		$cek_data = $this->admin_produk_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			$this->data['title'] 		= 'Tambah Ulasan';
			$this->data['data_produk']	=	$cek_data->row();
			$this->data['data_portal']	=	$this->admin_portal_model->get_list(null, 50, 0, array('id','desc'))->result();
			$this->data['rating'] 		= 	0;
			$this->data['portal_id'] 	= 	'';
			$this->data['produk_id'] 	= 	$id;
			
			$this->data['pesan'] = array(
				'name' => 'pesan',
				'id' => 'pesan',
				'rows' => '3',
				'type' => 'textarea',
				'class' => 'form-control',
				'required' => 'true',
				'value' => $this->form_validation->set_value('pesan',''),
			);
			
			$this->load->view('admin/ulasan/add/index', $this->data);
		
		}else{
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			redirect('admin/produk', 'refresh');
		}
	}
	
	/*fungsi untuk post edit berita */
	public function tambah_ulasan(){
		if (!empty($_POST)) {
			$this->form_validation->set_rules('pelanggan','Nama Pelanggan','required');
			$this->form_validation->set_rules('portal','Isi Portal','required');
			$this->form_validation->set_rules('tanggal','Tanggal','required');
			$this->form_validation->set_rules('pesan','Pesan','required');
			$this->form_validation->set_rules('rating','Rating','required');
			
			$pelanggan		= 	$this->input->post('pelanggan');
			$portal			= 	$this->input->post('portal');
			$tanggal 		= 	$this->input->post('tanggal');
			$pesan 			= 	$this->input->post('pesan');
			$rating 		= 	$this->input->post('rating');
			$id		 		= 	$this->input->post('produk');
			
			if ($this->form_validation->run() === TRUE) {
				/*Update berita*/
				$update_berita = array(
					'produk_id'		=> $id,
					'pelanggan_id'	=> $pelanggan,
					'portal_id'		=> $portal,
					'pesan'			=> $pesan,
					'rating'		=> $rating,
					'tanggal'		=> $tanggal,
				);
				$this->admin_ulasan_model->insert($update_berita);
				//ambil data info produk
				$info = $this->admin_produk_model->get_table('my_produk_info', array('produk_id'=> $id))->row();
				$rating_vote	=	$info->rating_vote + 1;
				$rating_value	=	$info->rating_value + $rating;
				$terjual_value	=	$info->terjual + 1;
				$data_rating = array(
					'rating_vote'	=> $rating_vote,
					'rating_value'	=> $rating_value,
					'terjual'		=> $terjual_value,
				);
				$this->admin_ulasan_model->update_table(array('produk_id'=> $id), $data_rating, 'my_produk_info');
				$this->session->set_flashdata('success', 'Berhasil Menambah Data');
				redirect('admin/produk', 'refresh');	
				
			}else{
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				/*Untuk view form*/
				$this->data['title'] 		= 'Tambah Ulasan';
				$this->data['data_produk']	=	$this->admin_produk_model->get(array('id' => $id))->row();
				$this->data['data_portal']	=	$this->admin_portal_model->get_list(null, 50, 0, array('id','desc'))->result();
				$this->data['rating'] 		= 	$rating;
				$this->data['portal_id'] 	= 	$portal;
				$this->data['produk_id'] 	= 	$id;
				
				$this->data['pesan'] = array(
					'name' 		=> 'pesan',
					'id' 		=> 'pesan',
					'rows' 		=> '3',
					'type' 		=> 'textarea',
					'class' 	=> 'form-control',
					'required' 	=> 'true',
					'value' 	=> $this->form_validation->set_value('pesan',$pesan),
				);
				
				$this->load->view('admin/ulasan/add/index', $this->data);
			}
		}
	}
}