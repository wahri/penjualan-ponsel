<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estalase extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_estalase_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Estalase';
		
		$data_table = $this->admin_estalase_model->get(null, array('id','desc'));
		$this->data['kategori_parent'] = $this->admin_estalase_model->get_list(null, 50, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_estalase_model->get(null,array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_estalase_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('kategori','Nama kategori','required');
        $this->form_validation->set_rules('deskripsi','Deskripsi Lengkap Kategori','required');
		
		$kategori = $this->input->post('kategori');
		$deskripsi = $this->input->post('deskripsi');
		
		if ($this->form_validation->run() == true) {
			$data = array(
                'estalase' => $kategori,
                'deskripsi' => $deskripsi
            );
            $this->admin_estalase_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/estalase', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['kategori'] = array(
                'name' => 'kategori',
                'id' => 'kategori',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('kategori', $kategori),
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
			
			$this->load->view('admin/estalase/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){

			$cek_data = $this->admin_estalase_model->get(array('id' => $id));
			if($cek_data->num_rows() > 0){
					
				$cat_data = $cek_data->row();
				$data_table = $this->admin_estalase_model->get(null, array('id','desc'));
				$this->data['title'] = "Sunting Estalase";
				$this->data['kategori_parent'] = $this->admin_estalase_model->get_list(null, 10, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_estalase_model->get(null,array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_estalase_model->get(null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				// validate form input
				$this->form_validation->set_rules('kategori','Nama kategori','required');
				$this->form_validation->set_rules('deskripsi','Deskripsi Lengkap Kategori','required');
			  
				if ($this->form_validation->run() == true) {
					$cat_id = $this->input->post('id_cat');
					$new_data = array(
						'estalase' => $this->input->post('kategori'),
						'deskripsi' => $this->input->post('deskripsi')
					);
					$this->admin_estalase_model->update(array('id' => $cat_id ), $new_data);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
					redirect('admin/estalase', 'refresh');
				}
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['kategori'] = array(
					'name' => 'kategori',
					'id' => 'kategori',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('kategori', $cat_data->estalase),
				);
				$this->data['deskripsi'] = array(
					'name' => 'deskripsi',
					'id' => 'deskripsi',
					'rows' => '3',
					'type' => 'textarea',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('deskripsi', $cat_data->deskripsi),
				);
				$this->data['id_cat'] = $cat_data->id;
				$this->load->view('admin/estalase/edit/index', $this->data);
			}			
	}
	
	//on
    public function delete($id = NULL)
    {

			//$this->admin_kategori_model->update_table(array('kategori_id' => $id), array('kategori_id' => 1), 'my_berita_kategori');
			$this->admin_estalase_model->delete(array('id' => $id));
			redirect('admin/estalase', 'refresh');
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_estalase_model->search(array('estalase' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/estalase/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['kategori_parent'] = $this->admin_estalase_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/estalase/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}