<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_setting_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Setting Website';
		$setting_judul = $this->admin_setting_model->get(array('setting'=>'judul'))->row()->value;
		$setting_deskripsi = $this->admin_setting_model->get(array('setting'=>'deskripsi'))->row()->value;
		$setting_copyright = $this->admin_setting_model->get(array('setting'=>'copyright'))->row()->value;
		$setting_company = $this->admin_setting_model->get(array('setting'=>'company'))->row()->value;
		$setting_alamat = $this->admin_setting_model->get(array('setting'=>'alamat'))->row()->value;
		$setting_kontak = $this->admin_setting_model->get(array('setting'=>'kontak'))->row()->value;
		$setting_logo = $this->admin_setting_model->get(array('setting'=>'logo_site'))->row()->value;
		
		$this->form_validation->set_rules('judul','Nama judul','required');
        $this->form_validation->set_rules('deskripsi','deskripsi','required');
        $this->form_validation->set_rules('copyright','copyright','required');
		$this->form_validation->set_rules('company','company','required');
        $this->form_validation->set_rules('alamat','alamat','required');
		$this->form_validation->set_rules('kontak','kontak','required');
		
		if ($this->form_validation->run() == true) {
			
            $this->admin_setting_model->update(array('setting'=>'judul'),array('value'=>$this->input->post('judul')));
			$this->admin_setting_model->update(array('setting'=>'deskripsi'),array('value'=>$this->input->post('deskripsi')));
			$this->admin_setting_model->update(array('setting'=>'copyright'),array('value'=>$this->input->post('copyright')));
			$this->admin_setting_model->update(array('setting'=>'company'),array('value'=>$this->input->post('company')));
			$this->admin_setting_model->update(array('setting'=>'alamat'),array('value'=>$this->input->post('alamat')));
			$this->admin_setting_model->update(array('setting'=>'kontak'),array('value'=>$this->input->post('kontak')));
			$this->admin_setting_model->update(array('setting'=>'logo_site'),array('value'=>$this->input->post('id_fitur')));
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
            redirect('admin/setting', 'refresh');
			
		}
		
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		if(!empty($setting_logo)){
			$this->data['featuredimage'] = base_url($this->costume->get_original($setting_logo,'original')->row()->url);
		}else{
			$this->data['featuredimage'] = base_url('upload/system/logo_default.png');
		}
		
		$this->data['id_fitur'] = $setting_logo;
		$this->data['judul'] = array(
			'name' => 'judul',
			'id' => 'judul',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('judul', $setting_judul),
		);
		$this->data['deskripsi'] = array(
			'name' => 'deskripsi',
			'id' => 'deskripsi',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('deskripsi', $setting_deskripsi),
		);
		$this->data['copyright'] = array(
			'name' => 'copyright',
			'id' => 'copyright',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('copyright', $setting_copyright),
		);
		$this->data['company'] = array(
			'name' => 'company',
			'id' => 'company',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('company', $setting_company),
		);
		$this->data['alamat'] = array(
			'name' => 'alamat',
			'id' => 'alamat',
			'rows' => '3',
			'type' => 'textarea',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('alamat', $setting_alamat),
		);
		$this->data['kontak'] = array(
			'name' => 'kontak',
			'id' => 'kontak',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('kontak', $setting_kontak),
		);
		$this->load->view('admin/setting/index', $this->data);
		
    }

}