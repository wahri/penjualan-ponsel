<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->library('pagination');
        $this->load->model('admin_pelanggan_model');
    }

    public function index()
    {
		$this->data['title'] 					= 'Data Pelanggan';
		$config['per_page'] 					= 10;
		$pagging 								= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->data['kategori_parent'] 			= $this->admin_pelanggan_model->get_list(null, $config['per_page'], $pagging, array('id','desc'))->result();
		//$this->data['produk_parent'] 			= $this->admin_produk_model->get_produk($result_select, $config['per_page'], $pagging,  array('my_produk.id','desc'))->result();
		
		$jumlah_data 							= $this->admin_pelanggan_model->count_all();
		$config['base_url'] 					= site_url('admin/pelanggan/index/');
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
				
		$this->load->view('admin/pelanggan/view/index', $this->data);
    }
	
	
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_pelanggan_model->search(array('pelanggan' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/pelanggan/lib/search_table', $this->data);
        return $view;

    }
	
	
}