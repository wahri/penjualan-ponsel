<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_menu_model');
		$this->load->model('admin_halaman_model');
		$this->load->model('admin_kategori_model');
		$this->load->model('admin_kategori_produk_model');
		$this->load->model('all_image_model');
    }
	
	//fungsi menu atas
    public function index($id = NULL)
    {
		if($id == 1){
			$this->data['title'] = 'Data Menu Header';
		}else if($id == 2){
			$this->data['title'] = 'Data Main Menu';
		}else if($id == 3){
			$this->data['title'] = 'Data Sub Main Menu';
		}else if($id == 4){
			$this->data['title'] = 'Data Menu Footer';
		}else if($id == 5){
			$this->data['title'] = 'Data Menu Categories';
		}else{
			redirect('admin/menu/index/1', 'refresh');
		}
		
		$a = array(
					array('id' => 1,'mn_nama' => 'Data Menu Header'),
					array('id' => 2,'mn_nama' => 'Data Main Menu'),
					array('id' => 3,'mn_nama' => 'Data Sub Main Menu'),
					array('id' => 4,'mn_nama' => 'Data Menu Footer'),
					array('id' => 5,'mn_nama' => 'Data Menu Categories')
			);
		
		$data_table = $this->admin_menu_model->get(null, array('id','desc'));
		$this->data['menu_parent'] = $this->admin_menu_model->get_list(array('posisi_menu'=>$id,'parent_menu'=>0), null, null, array('id','asc'))->result();
		$this->data['halaman_parent'] = $this->admin_halaman_model->get_list(null, 10, 0, array('id','asc'))->result();
		$this->data['kategori_parent'] = $this->admin_kategori_model->get_list(array('induk'=>0), 50, 0, array('id','asc'))->result();
		$this->data['kategori_produk_parent'] = $this->admin_kategori_produk_model->get_list(array('induk'=>0), 50, 0, array('id','asc'))->result();
		$this->data['identity_menu'] = $id;
		$this->data['identity_link'] = $a;
		
		$this->form_validation->set_rules('nama_menu','Nama menu','required');
        $this->form_validation->set_rules('induk','Induk Menu','integer|required');
        $this->form_validation->set_rules('deskripsi','Deskripsi Lengkap Menu','required');
		
		$nama_menu = $this->input->post('nama_menu');
        $induk = $this->input->post('induk');
		$deskripsi = $this->input->post('deskripsi');
		$url = $this->input->post('url_costume');
		$image_fitur = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		
		if ($this->form_validation->run() == true) {
			$new_url = $this->costume->clean($nama_menu);
			$data = array(
                'nama_menu' => $nama_menu,
                'url_menu' => $url,
				'logo_menu' => $id_gambar,
				'posisi_menu' => $id,
				'parent_menu' => $induk,
                'deskripsi_menu' => $deskripsi
            );
            $this->admin_menu_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/menu/index/'.$id, 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['featuredimage'] = $image_fitur;
			$this->data['id_fitur'] = $id_gambar;
			$this->data['nama_menu'] = array(
                'name' => 'nama_menu',
                'id' => 'nama_menu',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('nama_menu', $nama_menu),
            );
			$this->data['deskripsi'] = array(
                'name' => 'deskripsi',
                'id' => 'deskripsi',
                'rows' => '3',
				'type' => 'textarea',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('deskripsi', $deskripsi),
            );
			$this->data['url_costume'] = array(
                'name' => 'url_costume',
                'id' => 'url_costume',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('url_costume', $url),
            );
			
			$this->load->view('admin/menu/view/index', $this->data);
		
		}
    }
	
    public function delete()
    {
        $id = $this->input->post('id');
		$this->admin_menu_model->delete(array('id'=>$id));
        return true;
    }

}