<?php

class admin_impor_model extends CI_Model
{
    function __construct()
    {

    }

    //protected $table = 'my_video';
	
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
        $this->db->select('my_kategori.id as id, my_kategori.kategori as kat');
		$this->db->join('my_video_kategori', 'my_video_kategori.kategori_id = my_kategori.id');
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
        return $this->db->insert('my_video_kategori', $data);
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
		$this->db->select('my_video.id, my_video.judul_video, my_video.id_youtube, my_video.fiture_youtube, my_video.durasi_video, my_video.published_at');
     
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
        $this->db->select('my_video.id, my_video.judul_video, my_video.id_youtube, my_video.fiture_youtube, my_video.durasi_video, my_video.published_at');
     
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
        
		$this->db->select('my_video.id, my_video.judul_video, my_video.id_youtube, my_video.fiture_youtube, my_video.durasi_video, my_video.published_at');
		$this->db->join('my_video_kategori', 'my_video_kategori.video_id = my_video.id');
		$this->db->order_by('my_video_kategori.id', 'desc');
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
