<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lebel extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_label_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Add Label';
		
		$tanggal			= $this->input->post('tanggal');
		
		$gambar = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		
		if ($this->form_validation->run() == true) {
			$data = array(
                'caption' => $caption_name,
                'title' => $title_name,
				'description' => $description_name,
                'text_button' => $text_button,
				'link_button' => $link_button,
                'image' => $id_gambar
            );
            $this->admin_barner_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
			redirect('admin/barner', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['tanggal'] = array(
                'name' 		=> 'tanggal',
                'id' 		=> 'tanggal',
				'type' 		=> 'hidden',
                'value' 	=> $this->form_validation->set_value('tanggal', $tanggal),
            );
			$this->data['subtanggal'] = array(
                'name' 		=> 'subtanggal',
                'id' 		=> 'subtanggal',
				'type' 		=> 'text',
				'class' 	=> 'form-control input-sm',
				'disabled' 	=> 'true',
				'aria-describedby' => 'basic-addon2',
                'value' 	=> $this->form_validation->set_value('subtanggal', $tanggal),
            );

			$this->load->view('admin/lebel/index', $this->data);
		
		}
    }
	
	public function new_lebel()
    {
		$this->data['title'] = 'New Label';
		
		$this->form_validation->set_rules('part_code','part_code','required');
		
		$part_code 			= $this->input->post('part_code');
		$pcb_number 		= $this->input->post('pcb_number');
		$part_name 			= $this->input->post('part_name');
		$part_unit 			= $this->input->post('part_unit');
		$part_price 		= $this->input->post('part_price');
		
		if ($this->form_validation->run() == true) {
			$data = array(
                'part_code' 	=> $part_code,
                'pcb_number' 	=> $pcb_number,
				'part_name' 	=> $part_name,
                'part_unit' 	=> $part_unit,
				'part_price' 	=> $part_price
            );
            $this->admin_label_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
			redirect('admin/lebel', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['part_code'] = array(
                'name' 		=> 'part_code',
                'id' 		=> 'part_code',
				'type' 		=> 'text',
                'class' 	=> 'form-control',
				'required' 	=> 'true',
                'value' 	=> $this->form_validation->set_value('part_code', $part_code),
            );
			$this->data['pcb_number'] = array(
                'name' 		=> 'pcb_number',
                'id' 		=> 'pcb_number',
				'type' 		=> 'text',
                'class' 	=> 'form-control',
                'value' 	=> $this->form_validation->set_value('pcb_number', $pcb_number),
            );
			$this->data['part_name'] = array(
                'name' 		=> 'part_name',
                'id' 		=> 'part_name',
				'type' 		=> 'text',
                'class' 	=> 'form-control',
				'required' 	=> 'true',
                'value' 	=> $this->form_validation->set_value('part_name', $part_name),
            );
			$this->data['part_unit'] = array(
                'name' 		=> 'part_unit',
                'id' 		=> 'part_unit',
				'type' 		=> 'text',
                'class' 	=> 'form-control',
                'value' 	=> $this->form_validation->set_value('part_unit', $part_unit),
            );
			$this->data['part_price'] = array(
                'name' 		=> 'part_price',
                'id' 		=> 'part_price',
				'type' 		=> 'text',
                'class' 	=> 'form-control',
				'required' 	=> 'true',
                'value' 	=> $this->form_validation->set_value('part_price', $part_price),
            );

			$this->load->view('admin/lebel/add', $this->data);
		
		}
    }
	
	public function cetak($id = NULL, $tanggal = NULL, $jumlah = NULL)
    {
		$cek_data = $this->admin_label_model->get(array('idx' => $id));
		if($cek_data->num_rows() > 0)
		{
			$data_qr = $cek_data->row();
			$this->load->library('ciqrcode');
			$qr_image=rand().'.png';
			$params['data'] = $data_qr->part_code;
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] =FCPATH."upload/qr_image/".$qr_image;
			
			$this->data['part_code'] 	= $data_qr->part_code;
			$this->data['part_name'] 	= $data_qr->part_name;
			$this->data['part_date'] 	= $tanggal;
			$this->data['jumlah'] 		= $jumlah;
			
			if($this->ciqrcode->generate($params))
			{
				$this->data['img_url']=$qr_image;	
			}
			$this->load->view('admin/lebel/cetak', $this->data);
		}
		
    }
	
	function search_produk(){
      if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->admin_label_model->get_search_produk($q);
      }
    }

}