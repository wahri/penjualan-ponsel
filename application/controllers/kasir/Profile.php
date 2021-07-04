<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Kasir_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('kasir_user_model');
    }

    public function index()
    {
		$cek_data = $this->kasir_user_model->get(array('id' => $this->ion_auth->get_user_id()));
		if($cek_data->num_rows() > 0){
			
			$this->form_validation->set_rules('first_name','Nama Awal','trim|required');
			$this->form_validation->set_rules('last_name','Nama Akhir','trim|required');
			$this->form_validation->set_rules('phone','Nomor Telpon','trim');
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','min_length[6]');
			$this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
			
			if($this->form_validation->run() === FALSE){
				if($user = $this->ion_auth->user((int) $this->ion_auth->get_user_id())->row())
				{
					$this->data['user'] = $user;
				}
				else
				{
					$this->session->set_flashdata('success', 'Maaf Anda tidak dapat edit data');
					redirect('kasir/profile', 'refresh');
				}
				$this->data['title'] = 'Profile';
				$this->load->view('kasir/profile/index', $this->data);
			}else{
				$user_id = $this->ion_auth->get_user_id();
				$new_data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone')
				);
				if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');

				$this->ion_auth->update($user_id, $new_data);
				$this->session->set_flashdata('success', 'Berhasil Merubah Data');
				redirect('kasir/profile/index', 'refresh');
			}
		}			
    }
}