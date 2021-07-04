<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barner extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_barner_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Barner';
		
		$data_table = $this->admin_barner_model->get(null, array('id','desc'));
		$this->data['kategori_parent'] = $this->admin_barner_model->get_list(null, 50, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_barner_model->get(null,array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_barner_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('caption_name','Caption','required');
		$this->form_validation->set_rules('description_name','Description','required');
		$this->form_validation->set_rules('title_name','Title','required');
		$this->form_validation->set_rules('text_button','text_button','required');
		$this->form_validation->set_rules('link_button','link_button','required');
        $this->form_validation->set_rules('image_fitur','image_fitur','required');
		
		$caption_name 		= $this->input->post('caption_name');
		$description_name 	= $this->input->post('description_name');
		$title_name 		= $this->input->post('title_name');
		$text_button 		= $this->input->post('text_button');
		$link_button 		= $this->input->post('link_button');
		
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
			$this->data['caption_name'] = array(
                'name' => 'caption_name',
                'id' => 'caption_name',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('caption_name', $caption_name),
            );
			$this->data['title_name'] = array(
                'name' => 'title_name',
                'id' => 'title_name',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('title_name', $title_name),
            );
			$this->data['text_button'] = array(
                'name' => 'text_button',
                'id' => 'text_button',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('text_button', $text_button),
            );
			$this->data['link_button'] = array(
                'name' => 'link_button',
                'id' => 'link_button',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('link_button', $link_button),
            );
			$this->data['description_name'] = array(
                'name' => 'description_name',
                'id' => 'description_name',
                'rows' => '3',
				'type' => 'textarea',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('description_name', $description_name),
            );
			$this->data['featuredimage'] = $gambar;
			$this->data['id_fitur'] = $id_gambar;
			$this->load->view('admin/barner/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){

			$cek_data = $this->admin_barner_model->get(array('id' => $id));
			if($cek_data->num_rows() > 0){
					
				$cat_data = $cek_data->row();
				$data_table = $this->admin_barner_model->get(null, array('id','desc'));
				$this->data['title'] = "Sunting Merek";
				$this->data['kategori_parent'] = $this->admin_barner_model->get_list(null, 10, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_barner_model->get(null,array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_barner_model->get(null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				// validate form input
				$this->form_validation->set_rules('caption_name','Caption','required');
				$this->form_validation->set_rules('description_name','Description','required');
				$this->form_validation->set_rules('title_name','Title','required');
				$this->form_validation->set_rules('text_button','text_button','required');
				$this->form_validation->set_rules('link_button','link_button','required');
				$this->form_validation->set_rules('image_fitur','image_fitur','required');
			  
				if ($this->form_validation->run() == true) {
					$cat_id = $this->input->post('id_cat');
					$new_data = array(
						'caption' 		=> $this->input->post('caption_name'),
						'title' 		=> $this->input->post('title_name'),
						'description' 	=> $this->input->post('description_name'),
						'text_button' 	=> $this->input->post('text_button'),
						'link_button' 	=> $this->input->post('link_button'),
						'image' 		=> $this->input->post('id_fitur')
					);
					$this->admin_barner_model->update(array('id' => $cat_id ), $new_data);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
					redirect('admin/barner', 'refresh');
				}
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['caption_name'] = array(
					'name' => 'caption_name',
					'id' => 'caption_name',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('caption_name', $cat_data->caption),
				);
				$this->data['title_name'] = array(
					'name' => 'title_name',
					'id' => 'title_name',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('title_name', $cat_data->title),
				);
				$this->data['text_button'] = array(
					'name' => 'text_button',
					'id' => 'text_button',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('text_button', $cat_data->text_button),
				);
				$this->data['link_button'] = array(
					'name' => 'link_button',
					'id' => 'link_button',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('link_button', $cat_data->link_button),
				);
				$this->data['description_name'] = array(
					'name' => 'description_name',
					'id' => 'description_name',
					'rows' => '3',
					'type' => 'textarea',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('description_name', $cat_data->description),
				);
				$this->data['featuredimage'] = base_url($this->costume->get_original($cat_data->image,'original')->row()->url);
				$this->data['id_fitur'] = $cat_data->image;
				
				$this->data['id_cat'] = $cat_data->id;
				$this->load->view('admin/barner/edit/index', $this->data);
			}			
	}
	
	//on
    public function delete($id = NULL)
    {

			//$this->admin_kategori_model->update_table(array('kategori_id' => $id), array('kategori_id' => 1), 'my_berita_kategori');
			$this->admin_barner_model->delete(array('id' => $id));
			redirect('admin/barner', 'refresh');
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_barner_model->search(array('title' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/barner/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['kategori_parent'] = $this->admin_barner_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/barner/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}