<?php

class Admin_produk_model extends CI_Model
{
    function __construct()
    {

    }

    protected $table = 'my_produk';
	
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
	
	public function get_produk_categori($where = null)
    {
        $this->db->select('my_category_produk.id as id, my_category_produk.category as category, my_category_produk.url_category as url');
		$this->db->join('my_produk_kategori', 'my_produk_kategori.category_id = my_category_produk.id');
		$this->db->from('my_category_produk');
		$this->db->where($where);
		return $this->db->get();
    }
	
	public function get_produk_estalase($where = null)
    {
        return $this->db->get_where('my_estalase', $where);
    }
	
    //Tambah Data
    function insert($data = null)
    {
        return $this->db->insert($this->table, $data);
    }
	
	//Tambah Data info
    function insert_table($data = null , $table)
    {
        return $this->db->insert($table, $data);
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
       if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->count_all_results($this->table);
    }
	
	//Hitung dengan where
    function count_where_table($where = null, $table)
    {
        $this->db->where($where);
        return $this->db->count_all_results($table);
    }
	
	//Ambil semua data bagi superadmin
    function get_produk($where = null, $limit = null, $offset = null, $order = null)
    {
        $this->db->select('my_produk.id, 
							my_produk.nama_produk, 
							my_produk.gambar_utama, 
							my_produk.harga,
							my_produk.status, 
							my_produk.estalase,
							my_produk.real_viewer, 
							my_produk.promo, 
							my_produk.kondisi,
							my_produk.create_by,
							my_produk.sku,
							my_produk.stok,
							my_produk_info.terjual,
							users.first_name, 
							users.last_name');
		
		
		$this->db->join('users', 'users.id = my_produk.create_by');
		$this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id');
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
        $this->db->select('my_produk.id, 
							my_produk.nama_produk, 
							my_produk.gambar_utama, 
							my_produk.harga,
							my_produk.status, 
							my_produk.estalase,
							my_produk.merek,
							my_produk.real_viewer, 
							my_produk.promo, 
							my_produk.kondisi,
							my_produk.create_by,
							my_produk.sku,
							my_produk.stok,
							my_produk_info.terjual,
							users.first_name, 
							users.last_name');
		
		$this->db->join('users', 'users.id = my_produk.create_by');
		$this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id');
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
        $this->db->select('my_produk.id, 
							my_produk.nama_produk, 
							my_produk.gambar_utama, 
							my_produk.harga,
							my_produk.status, 
							my_produk.estalase,
							my_produk.real_viewer, 
							my_produk.promo, 
							my_produk.kondisi,
							my_produk.create_by,
							my_produk_info.terjual,
							users.first_name, 
							users.last_name');
		
		$this->db->join('users', 'users.id = my_produk.create_by');
		$this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id');
		$this->db->join('my_produk_kategori', 'my_produk_kategori.produk_id = my_produk.id');
		$this->db->order_by('my_produk_kategori.id', 'desc');
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
