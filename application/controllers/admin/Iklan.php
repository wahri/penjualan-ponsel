<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iklan extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
		$this->load->helper('fungsidate');
		$this->load->library('pagination');
		$this->load->helper(array('url'));
        $this->load->model('admin_iklan_model');
		$this->load->model('admin_media_model');
		$this->load->model('all_image_model');
    }
	
	public function desktop($status = NULL , $posisi_iklan = NULL)
    {
        $this->data['title'] = 'Data Iklan Tampilan Desktop';
		if(!empty($status)&& !empty($posisi_iklan)){
			if($status == 'all' && $posisi_iklan == 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'desktop');
			}else if($status != 'all' && $posisi_iklan == 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = 'all';
				$where = array('tampilan'=>'desktop','status'=>$status);
				
			}else if($status == 'all' && $posisi_iklan != 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'desktop','posisi'=>$posisi_iklan);
			}else{
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'desktop','status'=>$status,'posisi'=>$posisi_iklan);
			}
		}else{
			$this->data['status'] = 'all';
			$this->data['posisi_iklan'] = 'all';
			$where = array('tampilan'=>'desktop');
		}
		
		//pagging
		$jumlah_data = $this->admin_iklan_model->get($where,array('akhir','desc'))->num_rows();
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="paginate_button previous" id="datatable-keytable_previous">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li class="paginate_button next" id="datatable-keytable_next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = '&lt;&lt; Previous';
		$config['last_link'] = 'Next &gt;&gt;';
		$config['base_url'] = url_web('admin/iklan/desktop/'.$this->data['status'].'/'.$this->data['posisi_iklan']);;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = $this->table_row;
		$pagging = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$this->pagination->initialize($config);	
		
		$this->data['jumlah_semua'] = $jumlah_data;
		$this->data['list_iklan_desktop'] = $this->admin_iklan_model->get_where($where, $config['per_page'], $pagging, array('akhir','desc'))->result();
        
        /*End Pagination table*/
		//posisi iklan
		$a = array(
				array('id' => 1,'iklan' => 'Iklan Top Header'),
				array('id' => 2,'iklan' => 'Iklan Sidebar Kanan 1'),
				array('id' => 3,'iklan' => 'Iklan Sidebar Kanan 2'),
				array('id' => 4,'iklan' => 'Iklan Sidebar Kanan 3'),
				array('id' => 5,'iklan' => 'Iklan Sidebar Kanan 4'),
				array('id' => 6,'iklan' => 'Iklan Sidebar Kiri 1'),
				array('id' => 7,'iklan' => 'Iklan Sidebar Kiri 2'),
				array('id' => 8,'iklan' => 'Iklan Sidebar Kiri 3'),
				array('id' => 9,'iklan' => 'Iklan Sidebar Kiri 4'),
				array('id' => 10,'iklan' => 'Iklan Index 1'),
				array('id' => 11,'iklan' => 'Iklan Index 2'),
				array('id' => 12,'iklan' => 'Iklan Index 3'),
				array('id' => 13,'iklan' => 'Iklan Index 4'),
				array('id' => 14,'iklan' => 'Iklan Index 5'),
				array('id' => 15,'iklan' => 'Iklan Index 6'),
				array('id' => 16,'iklan' => 'Iklan Post Sidebar 1'),
				array('id' => 17,'iklan' => 'Iklan Post Sidebar 2'),
				array('id' => 18,'iklan' => 'Iklan Post Sidebar 3'),
		);
		//keterangan status
		$b = array(
				array('id' => 1,'status' => 'Terjadwal'),
				array('id' => 2,'status' => 'Aktif'),
				array('id' => 3,'status' => 'Expired'),
				array('id' => 4,'status' => 'Batal')
		);
		$this->form_validation->set_rules('nama_iklan','Nama Iklan','required');
		$this->form_validation->set_rules('posisi','posisi Iklan','required');
		$this->form_validation->set_rules('id_fitur','Gambar Iklan','required');
		$this->form_validation->set_rules('tanggal-star','Tanggal Mulai Iklan','required');
		$this->form_validation->set_rules('tanggal-end','Tanggal Akhir Iklan','required');
		
		$image_fitur = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		$nama = $this->input->post('nama_iklan');
		$posisi = $this->input->post('posisi');
		$harga = $this->input->post('harga');
		$iklan_url = $this->input->post('iklan_url');
		$keterangan = $this->input->post('keterangan');
		
		if ($this->form_validation->run() === TRUE) {
			$current_date 	= strtotime(date("Y-m-d"));
			$rdate    		= strtotime($this->input->post('tanggal-star'));
			if($current_date == $rdate) {
				$status = 2;
			}else{
				$status = 1;
			}
			$insert_item = array(
				'nama_iklan'=> $nama,
				'posisi'=> $posisi,
				'tampilan'=> 'desktop',
				'harga_iklan'=> $harga,
				'gambar_iklan'=> $id_gambar,
				'mulai'=> $this->input->post('tanggal-star'),
				'akhir'=> $this->input->post('tanggal-end'),
				'keterangan'=> $keterangan,
				'status'=> $status,
				'iklan_url'=> $iklan_url
			);
			$this->admin_iklan_model->insert($insert_item);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/iklan/desktop/index', 'refresh');
		}
		
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['identity_link'] = $a;
		$this->data['status_link'] = $b;
		$this->data['posisi'] = $posisi;
		$this->data['featuredimage'] = $image_fitur;
		$this->data['id_fitur'] = $id_gambar;
		
		$this->data['nama_iklan'] = array(
			'name' => 'nama_iklan',
			'id' => 'nama_iklan',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('nama_iklan', $nama),
        );
		
		$this->data['keterangan'] = array(
			'name' => 'keterangan',
			'id' => 'keterangan',
			'rows' => '3',
			'type' => 'textarea',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('keterangan', $keterangan),
		);
			
		$this->data['harga'] = array(
			'name' => 'harga',
			'id' => 'harga',
			'type' => 'number',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('harga', $harga),
        );
		
		$this->data['iklan_url'] = array(
			'name' => 'iklan_url',
			'id' => 'iklan_url',
			'type' => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('iklan_url', $iklan_url),
        );
		
		$this->load->view('admin/iklan/desktop/index', $this->data);
    }
	
	public function mobile($status = NULL , $posisi_iklan = NULL)
    {
        $this->data['title'] = 'Data Iklan Tampilan Mobile';
		if(!empty($status)&& !empty($posisi_iklan)){
			if($status == 'all' && $posisi_iklan == 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'mobile');
			}else if($status != 'all' && $posisi_iklan == 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = 'all';
				$where = array('tampilan'=>'mobile','status'=>$status);
				
			}else if($status == 'all' && $posisi_iklan != 'all'){
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'mobile','posisi'=>$posisi_iklan);
			}else{
				$this->data['status'] = $status;
				$this->data['posisi_iklan'] = $posisi_iklan;
				$where = array('tampilan'=>'mobile','status'=>$status,'posisi'=>$posisi_iklan);
			}
		}else{
			$this->data['status'] = 'all';
			$this->data['posisi_iklan'] = 'all';
			$where = array('tampilan'=>'mobile');
		}
		
		//pagging
		$jumlah_data = $this->admin_iklan_model->get($where,array('akhir','desc'))->num_rows();
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="paginate_button previous" id="datatable-keytable_previous">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li class="paginate_button next" id="datatable-keytable_next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_link'] = '&lt;&lt; Previous';
		$config['last_link'] = 'Next &gt;&gt;';
		$config['base_url'] = url_web('admin/iklan/mobile/'.$this->data['status'].'/'.$this->data['posisi_iklan']);;
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = $this->table_row;
		$pagging = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$this->pagination->initialize($config);	
		
		$this->data['jumlah_semua'] = $jumlah_data;
		$this->data['list_iklan_desktop'] = $this->admin_iklan_model->get_where($where, $config['per_page'], $pagging, array('akhir','desc'))->result();
        
        /*End Pagination table*/
		//posisi iklan
		$a = array(
				array('id' => 19,'iklan' => 'Iklan mobile Header'),
				array('id' => 20,'iklan' => 'Iklan Mobile Index 1'),
				array('id' => 21,'iklan' => 'Iklan Mobile Index 2'),
				array('id' => 22,'iklan' => 'Iklan Mobile Index 3'),
				array('id' => 23,'iklan' => 'Iklan Mobile Index 4'),
				array('id' => 24,'iklan' => 'Iklan Mobile Index 5'),
				array('id' => 25,'iklan' => 'Iklan Mobile Index 6'),
				array('id' => 26,'iklan' => 'Iklan Mobile Index 7'),
				array('id' => 27,'iklan' => 'Iklan Mobile Index 8'),
				array('id' => 28,'iklan' => 'Iklan Mobile Index 9'),
				array('id' => 29,'iklan' => 'Iklan Mobile Index 10'),
				array('id' => 30,'iklan' => 'Iklan Post mobile 1'),
				array('id' => 31,'iklan' => 'Iklan Post mobile 2'),
		);
		//keterangan status
		$b = array(
				array('id' => 1,'status' => 'Terjadwal'),
				array('id' => 2,'status' => 'Aktif'),
				array('id' => 3,'status' => 'Expired'),
				array('id' => 4,'status' => 'Batal')
		);
		$this->form_validation->set_rules('nama_iklan','Nama Iklan','required');
		$this->form_validation->set_rules('posisi','posisi Iklan','required');
		$this->form_validation->set_rules('id_fitur','Gambar Iklan','required');
		$this->form_validation->set_rules('tanggal-star','Tanggal Mulai Iklan','required');
		$this->form_validation->set_rules('tanggal-end','Tanggal Akhir Iklan','required');
		
		$image_fitur = $this->input->post('image_fitur');
		$id_gambar = $this->input->post('id_fitur');
		$nama = $this->input->post('nama_iklan');
		$posisi = $this->input->post('posisi');
		$harga = $this->input->post('harga');
		$iklan_url = $this->input->post('iklan_url');
		$keterangan = $this->input->post('keterangan');
		
		if ($this->form_validation->run() === TRUE) {
			$current_date 	= strtotime(date("Y-m-d"));
			$rdate    		= strtotime($this->input->post('tanggal-star'));
			if($current_date == $rdate) {
				$status = 2;
			}else{
				$status = 1;
			}
			$insert_item = array(
				'nama_iklan'=> $nama,
				'posisi'=> $posisi,
				'tampilan'=> 'mobile',
				'harga_iklan'=> $harga,
				'gambar_iklan'=> $id_gambar,
				'mulai'=> $this->input->post('tanggal-star'),
				'akhir'=> $this->input->post('tanggal-end'),
				'keterangan'=> $keterangan,
				'status'=> $status,
				'iklan_url'=> $iklan_url
			);
			$this->admin_iklan_model->insert($insert_item);
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/iklan/mobile/index', 'refresh');
		}
		
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['identity_link'] = $a;
		$this->data['status_link'] = $b;
		$this->data['posisi'] = $posisi;
		$this->data['featuredimage'] = $image_fitur;
		$this->data['id_fitur'] = $id_gambar;
		
		$this->data['nama_iklan'] = array(
			'name' => 'nama_iklan',
			'id' => 'nama_iklan',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('nama_iklan', $nama),
        );
		
		$this->data['keterangan'] = array(
			'name' => 'keterangan',
			'id' => 'keterangan',
			'rows' => '3',
			'type' => 'textarea',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('keterangan', $keterangan),
		);
			
		$this->data['harga'] = array(
			'name' => 'harga',
			'id' => 'harga',
			'type' => 'number',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('harga', $harga),
        );
		
		$this->data['iklan_url'] = array(
			'name' => 'iklan_url',
			'id' => 'iklan_url',
			'type' => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('iklan_url', $iklan_url),
        );
		
		$this->load->view('admin/iklan/mobile/index', $this->data);
    }
	
	public function add(){
		$this->data['title'] = 'Tambah Iklan';
		
		$this->form_validation->set_rules('nama_iklan','Nama Iklan','required');
		$this->form_validation->set_rules('tampilan','Tampilan Iklan','required');
		$this->form_validation->set_rules('jenis','jenis Iklan','required');
		$this->form_validation->set_rules('posisi','posisi Iklan','required');
		
		$nama = $this->input->post('nama_iklan');
		$tampilan = $this->input->post('tampilan');
		$jenis = $this->input->post('jenis');
		$posisi = $this->input->post('posisi');
		$harga = $this->input->post('harga');
        
		if ($this->form_validation->run() === TRUE) {
			$current_date 	= strtotime(date("Y-m-d"));
			$rdate    		= strtotime($this->input->post('tanggal-star'));
			if( $current_date == $rdate ) {
				$status = 1;
			}else{
				$status = 0;
			}
			
			if($jenis == 'html'){
				$insert_item = array(
					'nama_iklan'=> $nama,
					'jenis_iklan'=> $jenis,
					'posisi'=> $posisi,
					'tampilan'=> $tampilan,
					'harga_iklan'=> $harga,
					'mulai'=> $this->input->post('tanggal-star'),
					'akhir'=> $this->input->post('tanggal-end'),
					'content'=> $this->input->post('html'),
					'status'=> $status
				);
				$this->admin_iklan_model->insert($insert_item);
				redirect('admin/iklan', 'refresh');	
			}else{
				if(!empty($_FILES['gambar']['name'])){
					$config['upload_path'] = './upload/images/';
					$config['allowed_types'] = 'gif|jpg|png';

					$this->load->library('upload', $config);
			  
					if(!$this->upload->do_upload('gambar')){
						echo $this->upload->display_errors();
					}else{
						$data_image = $this->upload->data();
						/*Memasukkan data image kedalam database my_image*/
						$insert = array(
							'title' => str_replace('_', ' ', $data_image['raw_name']),
							'url' => ('upload/images/'.$data_image['file_name']),
							'size' => 'original',
							'image_name' => $data_image['file_name'],
							'jenis' => 'iklan',
							'parent' => 0,
						);
						$this->admin_media_model->insert($insert);
						$id_image = $this->db->insert_id();
						$image_name = $this->data['website_name'];
					
						/*Membuat image thumbnail*/
						$size1 = array(
							'width' => 100,
							'height' => 100
						);

						$this->costume->create_image_thumbnail($data_image, $image_name, $size1, $id_image, 'iklan');
						
						/*Memasukkan data image kedalam database my_iklan*/
						$insert_item = array(
							'nama_iklan'=> $nama,
							'jenis_iklan'=> $jenis,
							'posisi'=> $posisi,
							'tampilan'=> $tampilan,
							'harga_iklan'=> $harga,
							'mulai'=> $this->input->post('tanggal-star'),
							'akhir'=> $this->input->post('tanggal-end'),
							'image_url'=> ('upload/images/'.$data_image['file_name']),
							'iklan_url'=> $this->input->post('url'),
							'status'=> $status
						);
						$this->admin_iklan_model->insert($insert_item);
						redirect('admin/iklan', 'refresh');	
					}
				}
			}
			
			
		}
		
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['nama_iklan'] = array(
			'name' => 'nama_iklan',
			'id' => 'nama_iklan',
			'type' => 'text',
			'class' => 'form-control',
			'required' => 'true',
			'value' => $this->form_validation->set_value('nama_iklan', $nama),
        );
		
		$this->data['harga'] = array(
			'name' => 'harga',
			'id' => 'harga',
			'type' => 'number',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('harga', $harga),
        );
		
		$this->load->view('admin/iklan/add/index', $this->data);
		
		
	}
	
	//fungsi cari tanggal tersedia
	public function search_tanggal()
    {
        $tampil = $this->input->post('s_tampil');
		$posisi = $this->input->post('s_posisi');
        $cek_data = $this->admin_iklan_model->get_where(array('posisi'=>$posisi,'tampilan'=>$tampil), 1, 0, array('akhir','desc'));
        if($cek_data->num_rows() > 0){
			$date = DateTime::createFromFormat('Y-m-d', $cek_data->row()->akhir);
			$date->modify('+1 day');
			$tanggal = $date->format('d-m-Y');
		}else{
			$tanggal = date("d-m-Y");
		}
        echo json_encode($tanggal);
    } 
	
	public function delete_()
    {
        $id = $this->input->post('id');
		$this->admin_iklan_model->delete(array('id'=>$id));
        return true;
    }

}