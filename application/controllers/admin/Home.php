<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->model('admin_penjualan_model');
		$this->load->model('public_home_model');
        $this->load->model('admin_user_model');
    }

    public function index()
    {
        $this->data['title'] 		= 'Dashboard';
		
		$tahun 						= date("Y");
		$arr 						= array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		$proses 					= array();
		$selesai 					= array();
		$batal 						= array();
		foreach($arr as $data_bulan){
			$bulan 					= $tahun.'-'.$data_bulan;
			$proses_data 			= $this->admin_penjualan_model->count_where_search(array('status'=> 'proses'), array('tanggal'=> date('Y-m', strtotime($bulan))));
			$selesai_data 			= $this->admin_penjualan_model->count_where_search(array('status'=> 'selesai'), array('tanggal'=> date('Y-m', strtotime($bulan))));
			$batal_data 			= $this->admin_penjualan_model->count_where_search(array('status'=> 'batal'), array('tanggal'=> date('Y-m', strtotime($bulan))));
			$proses[] 				= $proses_data;
			$selesai[] 				= $selesai_data;
			$batal[] 				= $batal_data;
		}
		
		$this->data['proses'] 		= $proses;
		$this->data['selesai'] 		= $selesai;
		$this->data['batal'] 		= $batal;
		
		$this->data['kata_kunci'] 	= $this->public_home_model->kata_kunci(null)->result();
		$this->load->view('admin/home/index', $this->data);
		//echo 'bekerja';
    }
	
    public function clear_cache()
    {
        $leave_files = array('.htaccess', 'index.html');
        $i = 0;
        foreach( glob(APPPATH.'cache/*') as $file ) {
            if(!in_array(basename($file), $leave_files))
            {
                unlink($file);
                $i++;
            }
        }
        $this->session->set_flashdata('message', $i.' files were deleted from the cache directory.');
        redirect('admin','refresh');
    }
}

