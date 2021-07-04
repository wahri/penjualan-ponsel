<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->helper('fungsidate');
		$this->load->library('pagination');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		
    }
	
	/*Modal untuk image gallery*/
    public function modal_image_library()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'older'));
        $this->load->view('admin/images/modal_image_library', $this->data);
    }
	
	/*Modal untuk fieture gallery*/
    public function modal_fiture_library()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'older'));
        $this->load->view('admin/images/modal_fiture_library', $this->data);
    }
	
	/*Data gambar untuk image library list*/
    public function image_library_list()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'older'));
        $this->load->view('admin/images/content_media_library', $this->data);
    }
	
	/*Data gambar untuk image library list*/
    public function fitur_library_list()
    {
        $this->data['images'] = $this->all_image_model->get_list_modal(array('size' => 'original', 'jenis' => 'older'));
        $this->load->view('admin/images/content_fieture_library', $this->data);
    }
	
	/*Fungsi untuk mengambil detail gambar*/
    public function detail_image()
    {
        $id = $this->input->post('id');
        $data_image = $this->all_image_model->get(array('id' => $id))->row_array();
		$data_image['url'] = base_url($data_image['url']);
		$data_image['id'] = $data_image['id'];
        echo json_encode($data_image);

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
                        'jenis' => 'older',
						'parent' => 0,
                    );
                    $this->all_image_model->insert($insert);
                    $id_image = $this->db->insert_id();
										
					/*Membuat image thumbnail*/
                    $size1 = array(
                        'width' => 100,
                        'height' => 90
                    );

                    $this->costume->create_image_thumbnail($data_image, $size1, $id_image, 'older');
					
					/*Membuat image thumbnail*/
                    $size2 = array(
                        'width' => 200,
                        'height' => 180
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size2, $id_image, 'older');
					
					/*Membuat image thumbnail*/
                    $size3 = array(
                        'width' => 363,
                        'height' => 139
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size3, $id_image, 'older');
					
					/*Membuat image thumbnail*/
                    $size4 = array(
                        'width' => 350,
                        'height' => 220
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size4, $id_image, 'older');
					
					/*Membuat image thumbnail*/
                    $size5 = array(
                        'width' => 480,
                        'height' => 360
                    );
					
					$this->costume->create_image_thumbnail($data_image, $size5, $id_image, 'older');
			  }
		}
    }
}