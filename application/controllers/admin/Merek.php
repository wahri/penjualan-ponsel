<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merek extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_merek_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Merek';
		
		$data_table = $this->admin_merek_model->get(null, array('id','desc'));
		$this->data['kategori_parent'] = $this->admin_merek_model->get_list(null, 50, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_merek_model->get(null,array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_merek_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('merek','Merek','required');
        $this->form_validation->set_rules('image_fitur','image_fitur','required');
		
		$merek = $this->input->post('merek');
		$gambar = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		
		if ($this->form_validation->run() == true) {
			$data = array(
                'merek' => $merek,
                'gambar' => $id_gambar
            );
            $this->admin_merek_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
			redirect('admin/merek', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['merek'] = array(
                'name' => 'merek',
                'id' => 'merek',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('merek', $merek),
            );
			$this->data['featuredimage'] = $gambar;
			$this->data['id_fitur'] = $id_gambar;
			$this->load->view('admin/merek/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){

			$cek_data = $this->admin_merek_model->get(array('id' => $id));
			if($cek_data->num_rows() > 0){
					
				$cat_data = $cek_data->row();
				$data_table = $this->admin_merek_model->get(null, array('id','desc'));
				$this->data['title'] = "Sunting Merek";
				$this->data['kategori_parent'] = $this->admin_merek_model->get_list(null, 10, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_merek_model->get(null,array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_merek_model->get(null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				// validate form input
				$this->form_validation->set_rules('merek','merek','required');
				$this->form_validation->set_rules('image_fitur','image_fitur','required');
			  
				if ($this->form_validation->run() == true) {
					$cat_id = $this->input->post('id_cat');
					$new_data = array(
						'merek' => $this->input->post('merek'),
						'gambar' => $this->input->post('id_fitur')
					);
					$this->admin_merek_model->update(array('id' => $cat_id ), $new_data);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
					redirect('admin/merek', 'refresh');
				}
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['merek'] = array(
					'name' => 'merek',
					'id' => 'merek',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('merek', $cat_data->merek),
				);
				$this->data['featuredimage'] = base_url($this->costume->get_original($cat_data->gambar,'original')->row()->url);
				$this->data['id_fitur'] = $cat_data->gambar;
				
				$this->data['id_cat'] = $cat_data->id;
				$this->load->view('admin/merek/edit/index', $this->data);
			}			
	}
	
	//on
    public function delete($id = NULL)
    {

			//$this->admin_kategori_model->update_table(array('kategori_id' => $id), array('kategori_id' => 1), 'my_berita_kategori');
			$this->admin_merek_model->delete(array('id' => $id));
			redirect('admin/merek', 'refresh');
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_merek_model->search(array('merek' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/merek/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['kategori_parent'] = $this->admin_merek_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/merek/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}