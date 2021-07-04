<?php

class Admin_berita_model extends CI_Model
{
    function __construct()
    {

    }

    protected $table = 'my_berita';
	
	public function get_list($where = null, $limit = null, $offset = null, $order = null)
    {
        if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get_where($this->table, $where, $limit, $offset);
    }
	
	//get date
    function get_date_group()
    {
        $this->db->select('create_time');
        $this->db->from($this->table);
        $this->db->group_by('DATE_FORMAT(create_time, "%m-%y")');
        return $this->db->get();
    }

    public function get($where = null)
    {
        return $this->db->get_where($this->table, $where);
    }
	
	public function get_table($table, $where = null)
    {
        return $this->db->get_where($table, $where);
    }
	
	public function get_berita_categori($where = null)
    {
        $this->db->select('my_kategori.id as id, my_kategori.kategori as kat, my_kategori.url_kategori as url');
		$this->db->join('my_berita_kategori', 'my_berita_kategori.kategori_id = my_kategori.id');
		$this->db->from('my_kategori');
		$this->db->where($where);
		return $this->db->get();
    }
	
    //Tambah Data
    function insert($data = null)
    {
        return $this->db->insert($this->table, $data);
    }
	
	//Tambah Data info
    function insert_info($data = null)
    {
        return $this->db->insert('my_berita_info', $data);
    }
	
	//Tambah Data kategori
    function insert_cat($data = null)
    {
        return $this->db->insert('my_berita_kategori', $data);
    }

    //Update Data
    function update($where, $data, $table)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    //Delete Data
    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete($this->table);
    }
	
	//Delete Data table
    function delete_table($where,$table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
	
	//Hitung semua row
    function count_all()
    {
        return $this->db->count_all_results($this->table);
    }
	
	//Hitung dengan where
    function count_where($where = null)
    {
        $this->db->where($where);
        return $this->db->count_all_results($this->table);
    }
	
	//Ambil semua data bagi superadmin
    function get_berita($where = null, $limit = null, $offset = null, $order = null)
    {
        //'my_berita.id, my_berita.judul_lead_berita, my_berita.judul_berita, my_berita.format_berita, my_berita.real_viewer, my_berita.status_terbit, my_berita.create_time, my_berita.create_by, my_berita_info.likers, my_berita_info.share, my_berita_info.rating_vote, my_berita_info.rating_value, my_berita_info.tag_data'
		$this->db->select('my_berita.id, my_berita.judul_lead_berita, my_berita.judul_berita, my_berita.format_berita, my_berita.real_viewer, my_berita.status_terbit, my_berita.create_time, my_berita_info.likers, my_berita_info.share, my_berita_info.rating_vote, my_berita_info.rating_value, my_berita_info.tag_data, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = my_berita.create_by');
		$this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id');
        $this->db->from($this->table);
        $this->db->limit($limit, $offset);
        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get();
    }
	
	//Untuk mencari
    function search($search = null, $where = null, $limit = null, $offset = null, $order = null)
    {
        $this->db->select('my_berita.id, my_berita.judul_lead_berita, my_berita.judul_berita, my_berita.format_berita, my_berita.real_viewer, my_berita.status_terbit, my_berita.create_time, my_berita_info.likers, my_berita_info.share, my_berita_info.rating_vote, my_berita_info.rating_value, my_berita_info.tag_data, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = my_berita.create_by');
		$this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id');
        $this->db->from($this->table);
		$this->db->limit($limit, $offset);

        if ($search != null) {
            $this->db->like($search);
        }
        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get();
    }
	
	//Untuk mencari dengan kategori
    function search_category($search = null, $where = null, $limit = null, $offset = null)
    {		
        
		$this->db->select('my_berita.id, my_berita.judul_lead_berita, my_berita.judul_berita, my_berita.format_berita, my_berita.real_viewer, my_berita.status_terbit, my_berita.create_time, my_berita_info.likers, my_berita_info.share, my_berita_info.rating_vote, my_berita_info.rating_value, my_berita_info.tag_data, users.first_name, users.last_name');
        $this->db->join('my_berita_kategori', 'my_berita_kategori.berita_id = my_berita.id');
		$this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id');
        $this->db->join('users', 'users.id = my_berita.create_by');
		$this->db->order_by('my_berita_kategori.id', 'desc');
        $this->db->from($this->table);
		$this->db->limit($limit, $offset);

        if ($where != null) {
            $this->db->where($where);
        }
		if ($search != null) {
            $this->db->like($search);
        }
		
		return $this->db->get();
	}

}
