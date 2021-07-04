<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_kurir_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Kurir';

		$this->data['kategori_parent'] = $this->admin_kurir_model->get_list(array('induk'=>0), 50, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_kurir_model->get(array('induk'=>0),array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_kurir_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('kurir','Nama kurir','required');
        $this->form_validation->set_rules('induk','Induk Kategori','integer|required');
		
		$kurir = $this->input->post('kurir');
        $induk = $this->input->post('induk');
		$gambar = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		
		if ($this->form_validation->run() == true) {
			if(!empty($this->input->post('id_fitur'))){
				$image = $id_gambar;
			}else{
				$image = 0;
			}
			$data = array(
                'kurir' => 	$kurir,
                'induk' => 	$induk,
				'gambar'=>	$image,
            );
            $this->admin_kurir_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/kurir', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['kurir'] = array(
                'name' => 'kurir',
                'id' => 'kurir',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('kurir', $kurir),
            );
			$this->data['featuredimage'] = $gambar;
			$this->data['id_fitur'] = $id_gambar;
			$this->data['induk'] = 0;
			
			$this->load->view('admin/kurir/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){
			$cek_data = $this->admin_kurir_model->get(array('id' => $id));
			if($cek_data->num_rows() > 0){
					
				$cat_data = $cek_data->row();
				$data_table = $this->admin_kurir_model->get(null, array('id','desc'));
				$this->data['title'] = "Sunting Kurir";
				$this->data['kategori_parent'] = $this->admin_kurir_model->get_list(array('induk'=>0), 10, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_kurir_model->get(array('induk'=>0),array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_kurir_model->get(null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				// validate form input
				$this->form_validation->set_rules('kurir','Nama kurir','required');
				$this->form_validation->set_rules('induk','Induk Kategori','integer|required');
		
				if ($this->form_validation->run() == true) {
					$cat_id = $this->input->post('id_cat');
					$new_data = array(
						'kurir' => 	$this->input->post('kurir'),
						'induk' => 	$this->input->post('induk'),
						'gambar'=>	$this->input->post('id_fitur'),
					);
					$this->admin_kurir_model->update(array('id' => $cat_id ), $new_data);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
					redirect('admin/kurir', 'refresh');
				}
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['kurir'] = array(
					'name' => 'kurir',
					'id' => 'kurir',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('kurir', $cat_data->kurir),
				);
				if(!empty($cat_data->gambar)){
					$this->data['featuredimage'] = base_url($this->costume->get_original($cat_data->gambar,'original')->row()->url);
				}else{
					$this->data['featuredimage'] = "";
				}
				
				$this->data['id_fitur'] = $cat_data->gambar;
				$this->data['induk'] = $cat_data->induk;
				$this->data['id_cat'] = $cat_data->id;
				$this->load->view('admin/kurir/edit/index', $this->data);
						
			}
	}
	
	//on
    public function delete($id = NULL)
    {
		
		$induk = $this->admin_kurir_model->get(array('induk' => $id));
		if($induk->num_rows() > 0){
			$this->session->set_flashdata('success', 'Maaf!! anda harus menghapus cabang terlebuh dahulu');
			redirect('admin/kurir', 'refresh');
		}else{
			$this->admin_kurir_model->delete(array('id' => $id));
			redirect('admin/kurir', 'refresh');
		}
		
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_kurir_model->search(array('kurir' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/kurir/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['kategori_parent'] = $this->admin_kurir_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/kurir/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}