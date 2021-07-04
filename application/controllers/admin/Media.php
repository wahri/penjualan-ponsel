<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends Admin_Controller
{
	protected $table_row = 50;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_media_model');
		$this->load->model('all_image_model');
    }
	
	public function index()
    {
        $this->data['title'] = 'Pustaka Media';
		$this->data['list_image'] = $this->admin_media_model->get_where(array('size' => '100x90'), $this->table_row, 0, array('id','desc'))->result();
        $this->data['jumlah_semua'] = $this->admin_media_model->get(array('size' => '100x90'),array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_media_model->get(array('size' => '100x90'), array('id','desc'))->num_rows();
		
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->load->view('admin/media/add/index', $this->data);
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['list_image'] = $this->admin_media_model->search(array('title' => $search, 'size' => '100x90'), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/media/lib/list_image', $this->data);
        return $view;
    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['list_image'] = $this->admin_media_model->search(array('size' => '100x90'), $end, $start_limit, null, array('id','desc'))->result();
		$view = $this->load->view('admin/media/lib/list_image', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
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
				 
					$data = array(
                        'title_image' => str_replace('_', ' ', $data_image['raw_name']),
                        'url_image' => $data_image['file_name'],
                        'image_name' => $data_image['file_name'],
                    );
					echo json_encode($data);
			  }
		}
    }

}