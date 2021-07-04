<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require('./PhpOffice/vendor/autoload.php');
class Penjualan extends Kasir_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->library('pagination');
        $this->load->helper('fungsidate');
		$this->load->helper(array('url'));
        $this->load->model('admin_penjualan_model');
    }

    public function index()
    {
		$this->data['title'] = 'Semua Transaksi';

		//update data pesanan
		$data_pesanan					= $this->admin_penjualan_model->get_table('my_penjualan', array('status' => 'proses'))->result();
		foreach($data_pesanan as $list_pesanan){
			$pengurangan 				= strtotime($list_pesanan->tanggal) + 60*60*2;
			$sisa_waktu					= date("Y-m-d H:i:s",$pengurangan);
			$eks						= dateDiff($sisa_waktu);
			if($eks == " Waktu Habis"){
				$this->admin_penjualan_model->update(array('no_transaksi'=> $list_pesanan->no_transaksi), array('status'=>'batal'));
			}
		}
		
		$this->data['date_group'] 		= $this->admin_penjualan_model->get_date_group()->result();
		$this->data['jumlah_baru'] 		= $this->admin_penjualan_model->count_where(array("status"=>"proses"));
		$this->data['jumlah_selesai'] 	= $this->admin_penjualan_model->count_where(array("status"=>"selesai"));
		$this->data['jumlah_batal'] 	= $this->admin_penjualan_model->count_where(array("status"=>"batal"));
		$this->data['jumlah_semua']		= $this->admin_penjualan_model->count_all();
		
		//data pagging
		$config['per_page'] 			= 10;
		$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$proses_select 					= '';
		$tanggal_select					= '';
		$result_select					= '';
		$reset_filter					= '';
		$search_select					= '';
		
		//filter
		if (isset($_POST['filter_button'])) {
			if($this->input->post('proses') != ''){
				if($this->input->post('tanggal') != ''){
					$proses_select 			= $this->input->post('proses');
					$tanggal_select			= $this->input->post('tanggal');
					$reset_filter			= 1;
					$search_select 			= array ("my_penjualan.tanggal" => $tanggal_select);
					$result_select 			= array ("my_penjualan.status" => $proses_select);
					$this->session->set_userdata(array("tanggal_select"=> $tanggal_select , "proses_select"=> $proses_select));
				}else{
					$proses_select 			= $this->input->post('proses');
					$tanggal_select			= '';
					$reset_filter			= 1;
					$search_select 			= '';
					$result_select 			= array ("my_penjualan.status" => $proses_select );
					$this->session->set_userdata(array("proses_select"=> $proses_select));
					$this->session->unset_userdata('tanggal_select');
				}
			}else{
				if($this->input->post('tanggal') != ''){
					$proses_select 			= '';
					$tanggal_select			= $this->input->post('tanggal');
					$result_select 			= '';
					$search_select 			= array ("my_penjualan.tanggal" => $tanggal_select);
					$reset_filter			= 1;
					$this->session->set_userdata(array("tanggal_select"=> $tanggal_select));
					$this->session->unset_userdata('proses_select');
				}else{
					$proses_select 			= '';
					$tanggal_select			= '';
					$result_select 			= '';
					$reset_filter			= '';
					$search_select 			= '';
					$this->session->unset_userdata(array('tanggal_select','proses_select'));
				}
			}
			
		} else if (isset($_POST['cvs_button'])) {
			//cvs
			$stopik = $this->input->post('tanggal');
			$sproses = $this->input->post('proses');
			redirect('karir/penjualan/exportCSV/'.$sproses.'/'.$stopik);
		
		} else if (isset($_POST['reset_button'])) {
			//reset filter
			$proses_select 			= '';
			$tanggal_select			= '';
			$result_select 			= '';
			$reset_filter			= '';
			$this->session->unset_userdata(array('tanggal_select','proses_select'));
		} else {
			//normal
			if($this->session->userdata('proses_select') != NULL){
				if($this->session->userdata('tanggal_select') != NULL){
					$proses_select 			= $this->session->userdata('proses_select');
					$tanggal_select			= $this->session->userdata('tanggal_select');
					$reset_filter			= 1;
					$search_select 			= array ("my_penjualan.tanggal" => $tanggal_select);
					$result_select 			= array ("my_penjualan.status" => $proses_select);
				}else{
					$proses_select 			= $this->session->userdata('proses_select');
					$tanggal_select			= '';
					$reset_filter			= 1;
					$search_select 			= '';
					$result_select 			= array ("my_penjualan.status" => $proses_select );
				}
			}else{
				if($this->session->userdata('tanggal_select') != NULL){
					$proses_select 			= '';
					$reset_filter			= 1;
					$tanggal_select			= $this->session->userdata('tanggal_select');
					$search_select 			= array ("my_penjualan.tanggal" => $tanggal_select);
					$result_select 			= '';
				}else{
					$proses_select 			= '';
					$tanggal_select			= '';
					$result_select 			= '';
					$search_select 			= '';
					$reset_filter			= '';
				}
				
			}
		}
		
		$this->data['penjualan_baru'] 	= $this->admin_penjualan_model->search($search_select, $result_select, $config['per_page'], $pagging,  array('id','desc'))->result();
		$jumlah_data					= $this->admin_penjualan_model->count_like_where($search_select,$result_select);
		$this->data['proses_select'] 	= $proses_select;
		$this->data['tanggal_select'] 	= $tanggal_select;
		$this->data['reset_select'] 	= $reset_filter;
		
		$config['base_url'] 			= site_url('kasir/penjualan/index/');
		$config['full_tag_open'] 		= '<ul class="pagination">';
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
		$config['total_rows'] 			= $jumlah_data;
		
		$this->pagination->initialize($config);	
		$start									= (int)$this->uri->segment(4) +1;
		if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment(4) + $config['per_page'];
		}
		
		$this->data['result_count']				= "Showing ".$start." - ".$end." of ".$jumlah_data." Results";
				
		$this->load->view('kasir/penjualan/view/index', $this->data);
    }
	
	public function add($id = NULL){
		$cek_data = $this->admin_penjualan_model->get(array('id' => $id, 'status' => 'proses'));
		if($cek_data->num_rows() > 0){
			$inv 							= $cek_data->row();
			$this->data['inv']				= $inv;
			$this->data['title'] 			= 'Tansaksi Penjualan';
			
			$this->data['list_penjualan'] 	= $this->admin_penjualan_model->get_table('my_penjualan_item', array('no_transaksi'=> $inv->no_transaksi))->result();
			$this->data['pelanggan']		= $this->admin_penjualan_model->get_table('my_pelanggan', array('id'=> $inv->pelanggan_id))->row();	
			
			$this->form_validation->set_rules('input_pasword','Your Password','required');
			$input_pasword					= $this->input->post('input_pasword');
			
			if ($this->form_validation->run() === TRUE) {
				$id_hasben = $this->ion_auth->get_user_id();
				if ($this->ion_auth->hash_password_db($id_hasben, $input_pasword) == TRUE)
				{
					$produk			= $this->admin_penjualan_model->get_table('my_penjualan_item', array('no_transaksi'=> $inv->no_transaksi))->result();
					foreach($produk as $produk_list){
						$data_produk 		= $this->admin_penjualan_model->get_table('my_produk', array('id'=> $produk_list->produk_id))->row();
						$data_terjual 		= $this->admin_penjualan_model->get_table('my_produk_info', array('produk_id'=> $produk_list->produk_id))->row();
						$stok 				=  $data_produk->stok - $produk_list->kuantitas;
						$terjual 			=  $data_terjual->terjual + $produk_list->kuantitas;
						$this->admin_penjualan_model->update_table(array('id'=> $produk_list->produk_id), array('stok'=> $stok), 'my_produk');
						$this->admin_penjualan_model->update_table(array('produk_id'=> $produk_list->produk_id), array('terjual'=> $terjual), 'my_produk_info');
					}
					$data = array(
						'status'	=> 'selesai',
					);
					$this->admin_penjualan_model->update(array('id'=>$id), $data);
					$this->session->set_flashdata('success', 'Success !! Payment Approved Success');
					redirect('kasir/penjualan/view/'.$id, 'refresh');
				}else{
					$this->session->set_flashdata('success', 'Maaf !! Password yang anda masukkan tidak valid, mohon masukkan password yang benar');
					redirect('kasir/penjualan/add/'.$id, 'refresh');
				}	
			}else{
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
				$this->data['catatan'] = array(
					'name' => 'catatan',
					'id' => 'catatan',
					'rows' => '3',
					'type' => 'textarea',
					'class' => 'form-control input-sm',
					'value' => $this->form_validation->set_value('catatan', ''),
				);
				
				$this->load->view('kasir/penjualan/add/index', $this->data);
			}
		}else{
			$this->session->set_flashdata('success', 'Maaf data penjualan tidak ditemukan');
			redirect('kasir/penjualan', 'refresh');
		}
	}
	
	public function pesanan_baru()
    {
		$this->data['title'] = 'Pesanan Baru';

		//update data pesanan
		$data_pesanan					= $this->admin_penjualan_model->get_table('my_penjualan', array('status' => 'proses'))->result();
		foreach($data_pesanan as $list_pesanan){
			$pengurangan 				= strtotime($list_pesanan->tanggal) + 60*60*2;
			$sisa_waktu					= date("Y-m-d H:i:s",$pengurangan);
			$eks						= dateDiff($sisa_waktu);
			if($eks == " Waktu Habis"){
				$this->admin_penjualan_model->update(array('no_transaksi'=> $list_pesanan->no_transaksi), array('status'=>'batal'));
			}
		}
		
		$jumlah_data 					= $this->admin_penjualan_model->count_where(array("status"=>"proses"));
		$this->data['jumlah_baru'] 		= $jumlah_data;
		$this->data['jumlah_selesai'] 	= $this->admin_penjualan_model->count_where(array("status"=>"selesai"));
		$this->data['jumlah_batal'] 	= $this->admin_penjualan_model->count_where(array("status"=>"batal"));
		$this->data['jumlah_semua']		= $this->admin_penjualan_model->count_all();
		//data pagging
		$config['per_page'] 			= 10;
		$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->data['penjualan_baru'] 	= $this->admin_penjualan_model->search(null, array('status' => 'proses'), $config['per_page'], $pagging,  array('id','desc'))->result();
		
		
		$config['base_url'] 			= site_url('kasir/penjualan/pesanan_baru');
		$config['full_tag_open'] 		= '<ul class="pagination">';
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
		$config['total_rows'] 			= $jumlah_data;
		
		
		$this->pagination->initialize($config);	
					
		$start									= (int)$this->uri->segment(4) +1;
		if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment(4) + $config['per_page'];
		}
		
		$this->data['result_count']				= "Showing ".$start." - ".$end." of ".$jumlah_data." Results";
				
		$this->load->view('kasir/penjualan/pesanan_baru/index', $this->data);
    }
	
	public function pesanan_selesai()
    {
		$this->data['title'] = 'Transaksi Selesai';

		//update data pesanan
		$data_pesanan					= $this->admin_penjualan_model->get_table('my_penjualan', array('status' => 'proses'))->result();
		foreach($data_pesanan as $list_pesanan){
			$pengurangan 				= strtotime($list_pesanan->tanggal) + 60*60*2;
			$sisa_waktu					= date("Y-m-d H:i:s",$pengurangan);
			$eks						= dateDiff($sisa_waktu);
			if($eks == " Waktu Habis"){
				$this->admin_penjualan_model->update(array('no_transaksi'=> $list_pesanan->no_transaksi), array('status'=>'batal'));
			}
		}
		
		$this->data['jumlah_baru'] 		= $this->admin_penjualan_model->count_where(array("status"=>"proses"));
		$jumlah_data 					= $this->admin_penjualan_model->count_where(array("status"=>"selesai"));
		$this->data['jumlah_selesai'] 	= $jumlah_data;
		$this->data['jumlah_batal'] 	= $this->admin_penjualan_model->count_where(array("status"=>"batal"));
		$this->data['jumlah_semua']		= $this->admin_penjualan_model->count_all();
		
		//data pagging
		$config['per_page'] 			= 10;
		$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$this->data['penjualan_baru'] 	= $this->admin_penjualan_model->search(null, array('status' => 'selesai'), $config['per_page'], $pagging,  array('id','desc'))->result();
		
		$config['base_url'] 			= site_url('kasir/penjualan/pesanan_selesai');
		$config['full_tag_open'] 		= '<ul class="pagination">';
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
		$config['total_rows'] 			= $jumlah_data;
		
		
		$this->pagination->initialize($config);	
					
		$start									= (int)$this->uri->segment(4) +1;
		if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment(4) + $config['per_page'];
		}
		
		$this->data['result_count']				= "Showing ".$start." - ".$end." of ".$jumlah_data." Results";
				
		$this->load->view('kasir/penjualan/pesanan_selesai/index', $this->data);
    }
	
	public function pesanan_batal()
    {
		$this->data['title'] = 'Transaksi Batal';

		//update data pesanan
		$data_pesanan					= $this->admin_penjualan_model->get_table('my_penjualan', array('status' => 'proses'))->result();
		foreach($data_pesanan as $list_pesanan){
			$pengurangan 				= strtotime($list_pesanan->tanggal) + 60*60*2;
			$sisa_waktu					= date("Y-m-d H:i:s",$pengurangan);
			$eks						= dateDiff($sisa_waktu);
			if($eks == " Waktu Habis"){
				$this->admin_penjualan_model->update(array('no_transaksi'=> $list_pesanan->no_transaksi), array('status'=>'batal'));
			}
		}
		
		$this->data['jumlah_baru'] 		= $this->admin_penjualan_model->count_where(array("status"=>"proses"));
		$this->data['jumlah_selesai'] 	= $this->admin_penjualan_model->count_where(array("status"=>"selesai"));
		$jumlah_data 					= $this->admin_penjualan_model->count_where(array("status"=>"batal"));
		$this->data['jumlah_batal'] 	= $jumlah_data;
		$this->data['jumlah_semua']		= $this->admin_penjualan_model->count_all();
		
		//data pagging
		$config['per_page'] 			= 10;
		$pagging 						= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$this->data['penjualan_baru'] 	= $this->admin_penjualan_model->search(null, array('status' => 'batal'), $config['per_page'], $pagging,  array('id','desc'))->result();
		
		$config['base_url'] 			= site_url('kasir/penjualan/pesanan_batal');
		$config['full_tag_open'] 		= '<ul class="pagination">';
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
		$config['total_rows'] 			= $jumlah_data;
		
		$this->pagination->initialize($config);	
		$start									= (int)$this->uri->segment(4) +1;
		if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
			$end = $config['total_rows'];
		} else {
			$end = (int)$this->uri->segment(4) + $config['per_page'];
		}
		
		$this->data['result_count']				= "Showing ".$start." - ".$end." of ".$jumlah_data." Results";
				
		$this->load->view('kasir/penjualan/pesanan_batal/index', $this->data);
    }
	
	/*fungsi untuk menampilkan edit berita*/
	public function inv($id = NULL){
		$cek_data = $this->admin_penjualan_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			$inv = $cek_data->row();
			$this->data['title'] 			= 'Tansaksi Penjualan';
			$this->data['inv']				= $inv;
			$this->data['pelanggan']		= $this->admin_penjualan_model->get_table('my_pelanggan', array('id'=> $inv->pelanggan_id))->row();
			$this->data['produk']			= $this->admin_penjualan_model->get_table('my_penjualan_item', array('no_transaksi'=> $inv->no_transaksi))->result();
			$this->load->view('kasir/penjualan/view/inv', $this->data);
		}else{
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			redirect('kasir/penjualan', 'refresh');
		}
	}
	
	/*fungsi untuk menampilkan edit berita*/
	public function view($id = NULL){
		$cek_data = $this->admin_penjualan_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			$inv = $cek_data->row();
			$this->data['title'] 			= 'Tansaksi Penjualan';
			$this->data['inv']				= $inv;
			$this->data['pelanggan']		= $this->admin_penjualan_model->get_table('my_pelanggan', array('id'=> $inv->pelanggan_id))->row();
			$this->data['produk']			= $this->admin_penjualan_model->get_table('my_penjualan_item', array('no_transaksi'=> $inv->no_transaksi))->result();
			$this->load->view('kasir/penjualan/view/view', $this->data);
		
		}else{
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			redirect('kasir/penjualan', 'refresh');
		}
	}

	/*pencarian berita*/
    public function search()
    {
        $search_status = $this->input->post('status');
		if($search_status = 'all'){
			$search = $this->input->post('search');
			$this->data['penjualan_baru'] = $this->admin_penjualan_model->double_search(array('my_penjualan.no_transaksi'=> $search), array('my_pelanggan.pelanggan' => $search), null, $this->table_row, 0,  array('id','desc'))->result();
			$view = $this->load->view('kasir/penjualan/lib/list_baru', $this->data);
			return $view;
			
		}else {
			$search = $this->input->post('search');
			$this->data['penjualan_baru'] = $this->admin_penjualan_model->double_search(array('my_penjualan.no_transaksi'=> $search), array('my_pelanggan.pelanggan' => $search), array('my_penjualan.status' => $search_status), $this->table_row, 0,  array('id','desc'))->result();
			if($search_status = 'proses'){
				$view = $this->load->view('kasir/penjualan/pesanan_baru/list_baru', $this->data);
			}else if($search_status = 'selesai'){
				$view = $this->load->view('kasir/penjualan/pesanan_selesai/list_baru', $this->data);
			}else {
				$view = $this->load->view('kasir/penjualan/pesanan_batal/list_baru', $this->data);
			}
			return $view;
		}
    }
	
	/*pencarian artikel menggunakan tanggal*/
    public function search_by_date()
    {
        $search = $this->input->post('date');
        if ($search == 'all') {
			$this->data['penjualan_baru'] 		= $this->admin_penjualan_model->search(null, null, $this->table_row, 0,  array('id','desc'))->result();
		} else {
			$this->data['penjualan_baru'] 		= $this->admin_penjualan_model->search(array('my_penjualan.tanggal' => $search), null, $this->table_row, 0,  array('id','desc'))->result();
        }
        $view = $this->load->view('kasir/penjualan/lib/list_baru', $this->data);
        return $view;
    }
	
	/*Pencarian artikel berdasarkan kategori*/
    public function search_by_status()
    {
        $search = $this->input->post('category');
        if ($search == 'all') {
			$this->data['penjualan_parent'] = $this->admin_penjualan_model->search(null, null, $this->table_row, 0,  array('id','desc'))->result();
		} else {
			$this->data['penjualan_parent'] = $this->admin_penjualan_model->search(array('my_penjualan.status' => $search), null, $this->table_row, 0,  array('id','desc'))->result();
        }
        $view = $this->load->view('kasir/penjualan/lib/list_page', $this->data);
        return $view;
		
    }
	
	public function exportCSV($proses = null,$tanggal = null){ 
		
		$result_select 			= '';
		$search_select 			= '';
		$nama_select 			= '';
		if($proses != ''){
			if( $tanggal != ''){
				$search_select 			= array ("my_penjualan.tanggal" => date('Y-m', strtotime($tanggal)));
				$result_select 			= array ("my_penjualan.status" => $proses);
				$nama_select			= 'filter_by_status_dan_tanggal';
			}else{
				$result_select 			= array ("my_penjualan.status" => $proses);
				$nama_select			= 'filter_by_status';
			}
		}else{
			if($tanggal != ''){
				$search_select 			= array ("my_penjualan.tanggal" => date('Y-m', strtotime($tanggal)));
				$nama_select			= 'filter_by_tanggal';
			}else{
				$nama_select 			= '';
			}
		}
		
		$paper_parent =$this->admin_penjualan_model->search($search_select, $result_select, NULL, 0,  array('id','desc'))->result();
		
		$spreadsheet = new Spreadsheet();
		
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'INVOICE')
		->setCellValue('B1', 'TANGGAL')
		->setCellValue('C1', 'WAKTU')
		->setCellValue('D1', 'PELANGGAN')
		->setCellValue('E1', 'TELPON')
		->setCellValue('F1', 'STATUS')
		->setCellValue('G1', 'TOTAL BELANJA')
		->setCellValue('H1', 'CATATAN');
		
		$i=2;
		foreach ($paper_parent as $lists_paper) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $lists_paper->no_transaksi)
			->setCellValue('B'.$i, date('d-m-Y', strtotime($lists_paper->tanggal)))
			->setCellValue('C'.$i, date('H:i:s', strtotime($lists_paper->tanggal)))
			->setCellValue('D'.$i, $lists_paper->pelanggan)
			->setCellValue('E'.$i, $lists_paper->hp)
			->setCellValue('F'.$i, $lists_paper->status)
			->setCellValue('G'.$i, $lists_paper->total)
			->setCellValue('H'.$i, $lists_paper->catatan);
			$i++;
		}
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'LAPORAN PENJUALAN '.$nama_select.'_'.time(); 
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file
	
	}

}