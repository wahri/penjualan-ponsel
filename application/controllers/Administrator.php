<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('postal');
		$this->load->library('rat');
    }

    public function index()
    {
		if ($this->ion_auth->logged_in()) {
            if ($this->ion_auth->is_admin()) {
				redirect('admin/home', $this->data,'refresh');
			} else if ($this->ion_auth->is_kasir()) {
				redirect('kasir/home', $this->data,'refresh');
			} else {
				echo "bukan apa apa";
			}
        } else {
			$this->data['title'] = 'Login Aministrator';
			$this->load->view('login', $this->data);
		}
		
    }

    public function login()
    {
        $this->data['page_title'] = 'Login';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('remember','Remember me','integer');
        $this->form_validation->set_rules('redirect_to','Redirect to','valid_url');
        if($this->form_validation->run()===TRUE)
        {
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                if ($this->ion_auth->is_admin()) {
					$this->rat->log('The user logged in');
					redirect('admin/home', $this->data,'refresh');
				} else if ($this->ion_auth->is_kasir()) {
					$this->rat->log('The user logged in');
					redirect('kasir/home', $this->data,'refresh');
                } else {
					echo "bukan apa apa";
                }
            }
            else
            {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('administrator', 'refresh');
            }
        }
		else{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('administrator', 'refresh');
		}
    }

    public function logout()
    {
        $this->load->library('rat');
        $this->rat->log('The user logged out');
        $this->ion_auth->logout();
        $this->postal->add($this->ion_auth->messages(),'error');
        redirect('administrator');
    }
}