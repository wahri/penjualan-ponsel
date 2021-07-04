<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{
	protected $table_row = 10;
	
    function __construct()
    {
        parent::__construct();
		$this->load->library('costume');
        $this->load->model('admin_user_model');
    }

    public function index()
    {
		$this->data['title'] = 'Data User';

		$this->data['user_parent'] = $this->admin_user_model->get_list(array('users_groups.parent_id'=>0), $this->table_row, 0, array('id','desc'))->result();
		$this->data['jumlah_semua'] = $this->admin_user_model->get_list(null, null, null, array('id','desc'))->num_rows();
		$this->data['jumlah_item'] = $this->admin_user_model->get_list(null, null, null, array('id','desc'))->num_rows();
		$this->data['status'] = '';
		/*Pagination table*/
        $this->data['jumlah_prev'] = 1;
        $this->data['jumlah_now'] = 1;
        $this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
        $this->data['btn_next'] = $this->data['jumlah_now'] + 1;
        $this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
        /*End Pagination table*/
		
		$this->form_validation->set_rules('first_name','Nama Awal','trim|required');
        $this->form_validation->set_rules('last_name','Nama Akhir','trim|required');
        $this->form_validation->set_rules('phone','Nomor Telpon','trim');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
        $this->form_validation->set_rules('groups','Jabatan','required|integer');
		
		
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
		$phone = $this->input->post('phone');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
        $password = $this->input->post('password');
        $groups = $this->input->post('groups');
		
		if ($this->form_validation->run() == true) {
			$groups_ids = array($groups);
			
            $additional_data = array(
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'company'    => "lecturer digital",
                'phone'      => $phone
            );
			$last_id = $this->ion_auth->register($username, $password, $email, $additional_data, $groups_ids);
			$this->admin_user_model->update_table(array('user_id'=>$last_id), array('parent_id'=>$this->ion_auth->get_user_id()), 'users_groups');
			$this->session->set_flashdata('success', 'Berhasil Menambah Data');
            redirect('admin/user', 'refresh');
		}
		else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('first_name', $first_name),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('last_name', $last_name),
            );
			$this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('phone', $phone),
            );
			$this->data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('username', $username),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('email', $email),
            );
			$this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('password', $password),
            );
			$this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
				'required' => 'true',
                'value' => $this->form_validation->set_value('password_confirm', $password),
            );
			$this->data['groups'] = $this->ion_auth->groups()->result();
			$this->load->view('admin/user/add/index', $this->data);
		
		}
    }
	
	public function edit($id = NULL){
		$cek_data = $this->admin_user_model->get(array('id' => $id));
		if($cek_data->num_rows() > 0){
			
			$this->form_validation->set_rules('first_name','Nama Awal','trim|required');
			$this->form_validation->set_rules('last_name','Nama Akhir','trim|required');
			$this->form_validation->set_rules('phone','Nomor Telpon','trim');
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','min_length[6]');
			$this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
			$this->form_validation->set_rules('groups[]','Groups','required|integer');
			
			if($this->form_validation->run() === FALSE){
				if($user = $this->ion_auth->user((int) $id)->row())
				{
					$this->data['user'] = $user;
				}
				else
				{
					$this->session->set_flashdata('success', 'Maaf Anda tidak dapat edit data');
					redirect('admin/user', 'refresh');
				}
				$this->data['title'] = 'Sunting User';
				$this->data['user_parent'] = $this->admin_user_model->get_list(array('users_groups.parent_id'=>0), $this->table_row, 0, array('id','desc'))->result();
				$this->data['jumlah_semua'] = $this->admin_user_model->get_list(null, null, null, array('id','desc'))->num_rows();
				$this->data['jumlah_item'] = $this->admin_user_model->get_list(null, null, null, array('id','desc'))->num_rows();
				$this->data['status'] = '';
				/*Pagination table*/
				$this->data['jumlah_prev'] = 1;
				$this->data['jumlah_now'] = 1;
				$this->data['jumlah_next'] = ceil($this->data['jumlah_semua'] / $this->table_row);
				$this->data['btn_next'] = $this->data['jumlah_now'] + 1;
				$this->data['btn_prev'] = $this->data['jumlah_now'] - 1;
				/*End Pagination table*/
				$this->data['groups'] = $this->ion_auth->groups()->result();
				$this->data['usergroups'] = array();
				if($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
				{
					foreach($usergroups as $group)
					{
						$this->data['usergroups'][] = $group->id;
					}
				}
				$this->load->view('admin/user/edit/index', $this->data);
			}else{
				$user_id = $id;
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

				//Update the groups user belongs to
				$groups = $this->input->post('groups');
				if (isset($groups) && !empty($groups))
				{
					$this->ion_auth->remove_from_group('', $user_id);
					foreach ($groups as $group)
					{
						$this->ion_auth->add_to_group($group, $user_id);
					}
				}
				$this->admin_user_model->update_table(array('user_id'=>$user_id), array('parent_id'=>$this->ion_auth->get_user_id()), 'users_groups');
				$this->session->set_flashdata('success', 'Berhasil Merubah Data');
				redirect('admin/user', 'refresh');
			}
		}				
			
	}
	
	//on
    public function delete($user_id = NULL)
    {
		if(is_null($user_id))
        {
            $this->session->set_flashdata('success', 'Maaf data tidak dapat dihapus');
			redirect('admin/user', 'refresh');
        }
        else{
			if($user_id == $this->ion_auth->get_user_id()){
				$this->session->set_flashdata('success', 'Maaf data tidak dapat dihapus');
				redirect('admin/user', 'refresh');
			}else{
				$this->session->set_flashdata('success', 'User Berhasil dihapus');
				$this->ion_auth->delete_user($user_id);
				redirect('admin/user', 'refresh');
			}
        }
    }
	
	public function set_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if($id == $this->ion_auth->get_user_id()){
			$this->session->set_flashdata('success', 'Maaf data tidak dapat diubah');
			$this->data['user_parent'] = $this->admin_user_model->search(null, $this->table_row, 0, null, array('users.id','desc'))->result();
			$view = $this->load->view('admin/user/lib/search_table', $this->data);
			return $view;
		}else{
			$new_data = array(
                'active' => $status
            );
			$this->ion_auth->update($id, $new_data);
			$this->data['user_parent'] = $this->admin_user_model->search(null, $this->table_row, 0, null, array('users.id','desc'))->result();
			$view = $this->load->view('admin/user/lib/search_table', $this->data);
			return $view;
		}
    }
	
	//on 
    public function search()
    {
        $search = $this->input->post('search');
        $this->data['user_parent'] = $this->admin_user_model->search(array('users.username' => $search), $this->table_row, 0, null, array('users.id','desc'))->result();
        $view = $this->load->view('admin/user/lib/search_table', $this->data);
        return $view;

    }
	
	//on
    public function page()
    {
        $start = intval($this->input->post('start'));
        $start_limit = ($start * $this->table_row) - $this->table_row;
        $end = $this->table_row;
		$this->data['user_parent'] = $this->admin_user_model->search(null, $end, $start_limit, null, array('users.id','desc'))->result();
        $view = $this->load->view('admin/user/lib/search_table', $this->data, true);
		
        $data = array(
            'btn_next' => $start + 1,
            'btn_prev' => $start - 1,
            'btn_now' => $start,
            'view' => $view
        );

        echo json_encode($data);
    }

}