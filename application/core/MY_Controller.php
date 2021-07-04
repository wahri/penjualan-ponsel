<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('public_website_model');

		$this->data['website_judul'] = $this->public_website_model->get(array('setting' => 'judul'))->row()->value;
		$this->data['website_deskripsi'] = $this->public_website_model->get(array('setting' => 'deskripsi'))->row()->value;
		$this->data['website_copyright'] = $this->public_website_model->get(array('setting' => 'copyright'))->row()->value;
		$this->data['website_company'] = $this->public_website_model->get(array('setting' => 'company'))->row()->value;
		$this->data['website_alamat'] = $this->public_website_model->get(array('setting' => 'alamat'))->row()->value;
		$this->data['website_kontak'] = $this->public_website_model->get(array('setting' => 'kontak'))->row()->value;
		$this->data['website_logo'] = $this->public_website_model->get(array('setting' => 'logo_site'))->row()->value;
	}
}



class Public_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('banned_model');
		$ips = $this->banned_model->fields('ip')->set_cache('banned_ips', 3600)->get_all();
		$banned_ips = array();
		if (!empty($ips)) {
			foreach ($ips as $ip) {
				$banned_ips[] = $ip->ip;
			}
		}
		if (in_array($_SERVER['REMOTE_ADDR'], $banned_ips)) {
			echo 'You are banned from this site.';
			exit;
		}
	}
}

class Admin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('session', 'form_validation', 'ion_auth', 'postal', 'rat', 'costume'));
		$this->data['profile_user'] = $this->ion_auth->user()->row();

		if (!$this->ion_auth->logged_in()) {
			redirect('administrator', 'refresh');
		}
		if (!$this->ion_auth->is_admin()) {
			redirect('administrator/logout', 'refresh');
		}
	}
}

class Kasir_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('session', 'form_validation', 'ion_auth', 'postal', 'rat', 'costume'));
		$this->data['profile_user'] = $this->ion_auth->user()->row();

		if (!$this->ion_auth->logged_in()) {
			redirect('administrator', 'refresh');
		}
		if (!$this->ion_auth->is_kasir()) {
			redirect('administrator/logout', 'refresh');
		}
	}
}
