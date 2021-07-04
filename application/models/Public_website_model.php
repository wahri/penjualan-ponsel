<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_website_model extends MY_Model
{
    public function __construct()
    {

        parent::__construct();
    }
	public $table = 'my_website';
    //protected $table = 'my_website';
	
	public function get($where = null)
    {
        return $this->db->get_where($this->table, $where);
    }
}