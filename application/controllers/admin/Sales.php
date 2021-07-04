<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_sales_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data Sales';
		$this->data['kategori_parent'] = $this->admin_sales_model->get_list(null, 50, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_sales_model->get(null,array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_sales_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('sales','Nama sales','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('hp','HP','required');
		
		$sales = $this->input->post('sales');
		$alamat = $this->input->post('alamat');
		$hp = $this->input->post('hp');
		
		if ($this->form_validation->run() == true) {
			$data = array(
                'sales' => $sales,
                'alamat' => $alamat,
				'hp' => $hp
            );
            $this->admin_sales_model->insert($data);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/sales', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['sales'] = array(
                'name' => 'sales',
                'id' => 'sales',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('sales', $sales),
            );
			$this->data['hp'] = array(
                'name' => 'hp',
                'id' => 'hp',
                'type' => 'number',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('hp', $hp),
            );
			$this->data['alamat'] = array(
                'name' => 'alamat',
                'id' => 'alamat',
                'rows' => '3',
				'type' => 'textarea',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('alamat', $alamat),
            );
			
			$this->load->view('admin/sales/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){

			$cek_data = $this->admin_sales_model->get(array('id' => $id));
			if($cek_data->num_rows() > 0){
					
				$cat_data = $cek_data->row();
				$data_table = $this->admin_sales_model->get(null, array('id','desc'));
				$this->data['title'] = "Sunting Sales";
				$this->data['kategori_parent'] = $this->admin_sales_model->get_list(null, 10, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_sales_model->get(null,array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_sales_model->get(null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				// validate form input
				$this->form_validation->set_rules('sales','Nama sales','required');
				$this->form_validation->set_rules('alamat','Alamat','required');
				$this->form_validation->set_rules('hp','HP','required');
			  
				if ($this->form_validation->run() == true) {
					$cat_id = $this->input->post('id_cat');
					$new_data = array(
						'sales' => $this->input->post('sales'),
						'alamat' => $this->input->post('alamat'),
						'hp' => $this->input->post('hp'),
					);
					$this->admin_sales_model->update(array('id' => $cat_id ), $new_data);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
					redirect('admin/sales', 'refresh');
				}
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['sales'] = array(
					'name' => 'sales',
					'id' => 'sales',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('sales', $cat_data->sales),
				);
				$this->data['hp'] = array(
					'name' => 'hp',
					'id' => 'hp',
					'type' => 'number',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('hp', $cat_data->hp),
				);
				$this->data['alamat'] = array(
					'name' => 'alamat',
					'id' => 'alamat',
					'rows' => '3',
					'type' => 'textarea',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('alamat', $cat_data->alamat),
				);
			
				$this->data['id_cat'] = $cat_data->id;
				$this->load->view('admin/sales/edit/index', $this->data);
			}			
	}
	
	//on
    public function delete($id = NULL)
    {

			$this->admin_sales_model->delete(array('id' => $id));
			redirect('admin/sales', 'refresh');
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['kategori_parent'] = $this->admin_sales_model->search(array('sales' => $search), $this->table_row, 0, null, array('id','desc'))->result();
        $view = $this->load->view('admin/sales/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['kategori_parent'] = $this->admin_sales_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/sales/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}