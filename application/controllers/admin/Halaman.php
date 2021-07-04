<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->helper('fungsidate');
        $this->load->model('admin_halaman_model');
		$this->load->model('all_image_model');
    }

    public function index()
    {
		$this->data['title'] = 'Halaman';
		
		$data_table = $this->admin_halaman_model->get(null, array('id','desc'));
		$this->data['page_parent'] = $this->admin_halaman_model->get_list(null, 10, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_halaman_model->get(null,array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_halaman_model->get(null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->load->view('admin/halaman/view/index', $this->data);
		
    }
	
	public function add(){
		$this->data['title'] = 'Tambah Halaman';
		
		$this->form_validation->set_rules('judul','Judul Halaman','required');
        $this->form_validation->set_rules('content','Content Halaman','required');
		
		$judul = $this->input->post('judul');
        $content = $this->input->post('content');
		$status = $this->input->post('status');
		
		if ($this->form_validation->run() == true) {
			$new_judul = $this->costume->clean($judul);
			//cek jika url tersedia
			$cek_data = $this->admin_halaman_model->get(array('url_page' => $new_judul));
			if($cek_data->num_rows() > 0){	
				$url = $new_judul.'-'.$cek_data->num_rows();
			}else{
				$url = $new_judul;
			}
			//insert halaman
			$add = array(
				'judul_page' => $judul,
				'content_page' => $content,
				'url_page' => 'page/'.$url,
				'published_at' => date('Y-m-d H:i"s')
			);
			$this->admin_halaman_model->insert($add);
			redirect('admin/halaman', 'refresh');
		}
		
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['judul'] = array(
                'name' => 'judul',
                'id' => 'judul',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('judul', $judul),
            );
			$this->data['content'] = array(
                'name' => 'content',
                'id' => 'editor',
				'type' => 'textarea',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('content', $content),
            );
			$this->load->view('admin/halaman/add/index', $this->data);
		}		
	}
	
	public function edit($id = NULL){
		$cek_data = $this->admin_halaman_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
					
			$halaman = $cek_data->row();
			$this->data['title'] = "Sunting Halaman";
			$this->data['judul'] = array(
				'name' => 'judul',
				'id' => 'judul',
				'type' => 'text',
				'class' => 'form-control',
				'required' => 'true',
				'value' => $this->form_validation->set_value('judul', $halaman->judul_page),
			);
			$this->data['content'] = array(
                'name' => 'content',
                'id' => 'editor',
				'type' => 'textarea',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('content', $halaman->content_page),
            );
			$this->data['id_halaman'] = array(
                'name' => 'id_halaman',
                'id' => 'id_halaman',
				'type' => 'hidden',
                'value' => $this->form_validation->set_value('id_halaman', $halaman->id),
            );
			$this->load->view('admin/halaman/edit/index', $this->data);		
		}
		else{
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			redirect('admin/halaman', 'refresh');
		}
	}
	
	//on edit berita
	public function edit_halaman(){
		if (!empty($_POST)) {
			$this->form_validation->set_rules('judul','Judul Halaman','required');
			$this->form_validation->set_rules('content','Isi Halaman','required');
			
			$id		= 	$this->input->post('id_halaman');
			$judul	= 	$this->input->post('judul');
			$isi 	= 	$this->input->post('content');
			
			if ($this->form_validation->run() === TRUE) {
				$new_judul = $this->costume->clean($judul);
				$update_halaman = array(
					'judul_page'=> $judul,
					'content_page'=> $isi,
					'url_page' => 'page/'.$new_judul,
				);
				$this->admin_halaman_model->update(array('id'=>$id), $update_halaman);
				$this->session->set_flashdata('success', 'Berhasil Menambah Data');
				redirect('admin/halaman', 'refresh');	
			}
			else{
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['judul'] = array(
					'name' => 'judul',
					'id' => 'judul',
					'type' => 'text',
					'class' => 'form-control',
					'required' => 'true',
					'value' => $this->form_validation->set_value('judul', $judul),
				);
				$this->data['content'] = array(
					'name' => 'content',
					'id' => 'editor',
					'type' => 'textarea',
					'class' => 'form-control',
					'value' => $this->form_validation->set_value('content', $isi),
				);
				$this->data['id_halaman'] = array(
					'name' => 'id_halaman',
					'id' => 'id_halaman',
					'type' => 'hidden',
					'value' => $this->form_validation->set_value('id_halaman', $id),
				);
				$this->load->view('admin/halaman/edit/index', $this->data);
			}
		}
	}
	
	//on
    public function delete($id = NULL)
    {
		$this->admin_halaman_model->delete(array('id' => $id));
		$this->session->set_flashdata('success', 'data berhasil di ubah');
		redirect('admin/halaman', 'refresh');
    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['page_parent'] = $this->admin_halaman_model->search(null, $end, $start_limit, null, array('id','desc'))->result();
        $view = $this->load->view('admin/halaman/lib/list_page', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }
	
}