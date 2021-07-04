<?php

class Admin_penjualan_model extends CI_Model
{
    function __construct()
    {

    }

    protected $table = 'my_penjualan';
	
	public function get($where = null, $order = null)
    {
        if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get_where($this->table, $where);
    }
	
	public function get_table($table, $where = null)
    {
        return $this->db->get_where($table, $where);
    }
	
	public function get_list($where = null, $limit = null, $offset = null, $order = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }			
        if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
		$this->db->limit($limit, $offset);
        return $this->db->get($this->table);
    }
	
	
	
    //Tambah Data
    function insert($data = null)
    {
        return $this->db->insert($this->table, $data);
    }
	
	//Tambah Data table
    function insert_table($data = null, $table)
    {
        return $this->db->insert($table, $data);
    }

    //Update Data
    function update($where, $data)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }
	
	//Update Data Table
    function update_table($where, $data, $table)
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
	
	//Delete Data
    function delete_table($where, $table)
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
    function count_where_search($where = null, $search = null)
    {
        if ($where != null) {
            $this->db->where($where);
        }
		if ($search != null) {
            $this->db->like($search);
        }		
        return $this->db->count_all_results($this->table);
    }
	
	//Hitung dengan where
    function count_like_where($like = null,$where = null)
    {
        if ($like != null) {
            $this->db->like($like);
        }
		if ($where != null) {
            $this->db->where($where);
        }			
        return $this->db->count_all_results($this->table);
    }
	
	//Hitung sum field
    function sum_where($field, $where = null, $table)
    {
        $this->db->select_sum($field);
		$this->db->from($table);
		if ($where != null) {
            $this->db->where($where);
        }			
        return $this->db->get();
    }
	
	//Untuk list
    function search($search = null, $where = null, $limit = null, $offset = null, $order = null)
    {
        $this->db->select('my_penjualan.id, 
							my_penjualan.no_transaksi,
							my_penjualan.total,
							my_penjualan.status,
							my_penjualan.tanggal,
							my_penjualan.qr_image,
							my_penjualan.catatan,
							my_pelanggan.pelanggan,
							my_pelanggan.hp');
        $this->db->join('my_pelanggan', 'my_pelanggan.id = my_penjualan.pelanggan_id');
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
	
	//Untuk list
    function double_search($search_one = null, $search_two = null, $where = null, $limit = null, $offset = null, $order = null)
    {
        $this->db->select('my_penjualan.id, 
							my_penjualan.no_transaksi,
							my_penjualan.total,
							my_penjualan.status,
							my_penjualan.tanggal,
							my_penjualan.qr_image,
							my_penjualan.catatan,
							my_pelanggan.pelanggan,
							my_pelanggan.hp');
        $this->db->join('my_pelanggan', 'my_pelanggan.id = my_penjualan.pelanggan_id');
        $this->db->from($this->table);
		$this->db->limit($limit, $offset);

        if ($search_one != null) {
            $this->db->or_like($search_one);
        }
		if ($search_two != null) {
            $this->db->or_like($search_two);
        }
        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get();
    }
	
	function get_search_pelanggan($q)
	{
		$this->db->like('pelanggan', $q);
		$this->db->or_like('hp',$q);
        $query = $this->db->get('my_pelanggan');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['pelanggan']).' Hp:'.$row['hp']);
            $new_row['pelanggan'] = htmlentities(stripslashes($row['pelanggan']));
            $new_row['alamat'] = htmlentities(stripslashes($row['alamat']));
			$new_row['kecamatan'] = htmlentities(stripslashes($row['kecamatan']));
			$new_row['kabupaten'] = htmlentities(stripslashes($row['kabupaten']));
			$new_row['propinsi'] = htmlentities(stripslashes($row['propinsi']));
			$new_row['hp'] = htmlentities(stripslashes($row['hp']));
			$new_row['kodepos'] = htmlentities(stripslashes($row['kodepos']));
			$new_row['id'] = htmlentities(stripslashes($row['id']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
	
	function get_search_produk($q){
        $this->db->select('my_produk.id, my_produk.nama_produk, my_produk.harga');
        $this->db->like('my_produk.nama_produk', $q);
        $query = $this->db->get('my_produk');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['nama_produk']));
            $new_row['produk'] = htmlentities(stripslashes($row['nama_produk']));
			$new_row['id'] = htmlentities(stripslashes($row['id']));
			$new_row['harga'] = htmlentities(stripslashes($row['harga']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
	
	//get date
    function get_date_group()
    {
        $this->db->select('tanggal');
        $this->db->from($this->table);
        $this->db->group_by('DATE_FORMAT(tanggal, "%m-%y")');
        return $this->db->get();
    }
	

}
