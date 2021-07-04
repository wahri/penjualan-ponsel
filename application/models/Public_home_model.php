<?php

class Public_home_model extends CI_Model
{
	private $db2;
    function __construct()
    {
		parent::__construct();
         //$this->db2 = $this->load->database('faktariau', TRUE);
    }

    //protected $table = 'my_image';
	
	//Ambil data
    public function get_menu($where = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }			
		return $this->db->get($table);
    }
	
	public function get($where = null, $table)
    {
        return $this->db->get_where($table, $where);
    }
	
	public function get_list($where = null, $limit = null, $offset = null, $order = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get($table, $limit, $offset);
    }
	
	public function get_cari($where = null, $cari= null, $limit = null, $offset = null, $order = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }
		if ($cari != null) {
            $this->db->like('judul_berita',$cari);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get($table, $limit, $offset);
    }
	
	public function get_one_list($where = null, $limit = null, $order = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get($table, $where, $limit);
    }
	
	public function get_iklan($where = null, $table)
    {
        $this->db->select(
					'my_iklan.nama_iklan, 
					 my_iklan.iklan_url, 
					 my_image.url as gambar_iklan');
		$this->db->from($table);
		$this->db->join('my_image', 'my_image.id = my_iklan.gambar_iklan');
		$this->db->where($where);
        return $this->db->get();
    }
	
	public function berita_jadwal($where = null, $limit = null, $offset = null, $group = null, $order = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }	
		if ($group != null) {
            $this->db->group_by($group);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
		$this->db->limit($limit, $offset);
        return $this->db->get($table);
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
	
	//Hitung dengan where
    function count_where_table($where = null, $table)
    {
        if ($where != null) {
            $this->db->where($where);
        }	
        return $this->db->count_all_results($table);
    }
	
	//Untuk mencari
    function berita_detail($where = null,$table)
    {
        $this->db->select(
							'my_berita.id, 
							 my_berita.judul_lead_berita, 
							 my_berita.judul_berita, 
							 my_berita.isi_berita, 
							 my_berita.format_berita, 
							 my_berita.gambar_berita, 
							 my_berita.ket_gambar,
							 my_berita.video_id, 
							 my_berita.url_berita, 
							 my_berita.real_viewer, 
							 my_berita.status_terbit, 
							 my_berita.tanggal_terbit, 
							 my_berita.update_time, 
							 my_berita_info.likers, 
							 my_berita_info.viewer,
							 my_berita_info.share, 
							 my_berita_info.rating_vote, 
							 my_berita_info.rating_value, 
							 my_berita_info.tag_data,
							 my_image.url as gambar,
							 users.first_name, 
							 users.last_name');
        $this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id', 'left');
		$this->db->join('users', 'users.id = my_berita.create_by', 'left');
		$this->db->join('my_image', 'my_image.id = my_berita.gambar_berita', 'left');
        $this->db->from($table);
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }
	
	//Untuk mencari
    function berita_kategori($where = null, $limit = null, $offset = null, $order = null, $table)
    {
        $this->db->select(
						'my_berita.id, 
						 my_berita.judul_berita,
						 my_berita.isi_berita,
						 my_berita.format_berita, 
						 my_berita.gambar_berita, 
						 my_berita.video_id,
						 my_berita.url_berita,
						 my_berita.tanggal_terbit,
						 my_berita_info.viewer,
						 my_berita_info.rating_vote,
						 my_berita_info.rating_value');
		$this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id');
		$this->db->join('my_berita_kategori', 'my_berita_kategori.berita_id = my_berita.id');
        $this->db->from($table);
		$this->db->limit($limit, $offset);

        if ($where != null) {
            $this->db->where($where);
        }
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get();
    }
	
	//Untuk berita terkait
    function berita_terkait($id, $title)
    {
		$this->db->where_not_in('id', $id);	
		$this->db->order_by('id', 'DESC');
		$view = $this->db->get_where('my_berita', array('status_terbit'=>'terbit'))->result_array();
		// batas threshold 40%
		$threshold = 10;
		// jumlah maksimum artikel terkait yg ditampilkan 3 buah
		$maksArtikel = 2;
		
        $array = array();
		foreach ($view as $data) {
			similar_text($title, $data['judul_lead_berita'] . $data['judul_berita'], $percent);
			if ($percent >= $threshold){
				if (count($array) <= $maksArtikel){
					$array[$data['id']] = $data;
				}
			}
        }
        return $array;
    }
	
	//Untuk berita terkait video
    function berita_terkait_video($id, $title)
    {
		$this->db->where_not_in('id', $id);	
		$this->db->order_by('id', 'DESC');
		$view = $this->db->get_where('my_berita', array('status_terbit'=>'terbit','format_berita'=>'video'))->result_array();
		// batas threshold 40%
		$threshold = 10;
		// jumlah maksimum artikel terkait yg ditampilkan 3 buah
		$maksArtikel = 4;
		
        $array = array();
		foreach ($view as $data) {
			similar_text($title, $data['judul_lead_berita'] . $data['judul_berita'], $percent);
			if ($percent >= $threshold){
				if (count($array) <= $maksArtikel){
					$array[$data['id']] = $data;
				}
			}
        }
        return $array;
    }
	
	//Untuk berita populer
    function berita_populer($where, $limit, $offset, $table)
    {
		$sekarang = date("Y-m-d H:i:s");
		$this->db->select(
							'my_berita.id,
							 my_berita.judul_berita, 
							 my_berita.format_berita, 
							 my_berita.gambar_berita, 
							 my_berita.video_id, 
							 my_berita.url_berita, 
							 my_berita.real_viewer, 
							 my_berita.tanggal_terbit, 
							 my_berita_info.viewer');
        $this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id', 'left');
		$this->db->where($where);
		$this->db->where('my_berita.tanggal_terbit BETWEEN "'. date("Y-m-d H:i:s", strtotime($sekarang."-14 Day")). '" and "'. date('Y-m-d H:i:s').'"');		
        $this->db->order_by('my_berita.real_viewer', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk berita widget tidak bergambar
    function berita_widget($where, $limit, $offset, $order, $table)
    {
		$this->db->select(
							'my_berita.id,
							 my_berita.judul_berita,
							 my_berita.url_berita,
							 my_berita.gambar_berita, 
							 my_berita.tanggal_terbit, 
							 my_berita_info.viewer,
							 my_berita_info.rating_vote,
							 my_berita_info.rating_value');
        $this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id', 'left');		
		$this->db->where($where);
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk berita widget tidak bergambar
    function berita_widget_list($where, $limit, $offset, $order, $table)
    {
		$this->db->select(
							'my_berita.id, 
							 my_berita.judul_lead_berita, 
							 my_berita.judul_berita, 
							 my_berita.isi_berita, 
							 my_berita.format_berita, 
							 my_berita.gambar_berita, 
							 my_berita.video_id, 
							 my_berita.url_berita, 
							 my_berita.tanggal_terbit,  
							 my_berita_info.viewer,
							 my_berita_info.rating_vote,
							 my_berita_info.rating_value');
        $this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id', 'left');		
		$this->db->where($where);
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk berita breaking news
    function berita_breaking($where, $limit, $offset, $order, $table)
    {
		$this->db->select('judul_berita, url_berita');
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by($order[0], $order[1]);
		return $this->db->get($table);
    }
	
	//Untuk berita terbaru
    function berita_terbaru($where, $limit, $offset, $order, $table)
    {
		$this->db->select(
							'my_berita.id,
							 my_berita.judul_berita, 
							 my_berita.format_berita, 
							 my_berita.gambar_berita, 
							 my_berita.video_id, 
							 my_berita.url_berita, 
							 my_berita.real_viewer, 
							 my_berita.tanggal_terbit, 
							 my_berita_info.viewer');
        $this->db->join('my_berita_info', 'my_berita_info.berita_id = my_berita.id', 'left');		
		$this->db->where($where);
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk mencari produk
    function search_produk($search = null, $where = null, $limit , $offset , $order, $table)
    {
		$this->db->select(
						    'my_produk.id,
							my_produk.nama_produk,
							my_produk.gambar_utama,
							my_produk.url_produk,
							my_produk.harga,
							my_produk.status,
							my_produk.merek,
							my_produk.deskripsi,
							my_produk.promo,
							my_produk.kondisi,
							my_merek.merek as nama_merek,
							my_produk_info.rating_vote,
							my_produk_info.rating_value
							');
        $this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id', 'left');	
		$this->db->join('my_merek', 'my_merek.id = my_produk.merek', 'left');
		if ($where != null) {
            $this->db->where($where);
        }
		if ($search != null) {
            $this->db->like($search);
        }
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	function search_produk_kategori($where = null, $limit , $offset , $order, $table)
    {
		$this->db->select(
						    'my_produk.id,
							my_produk.nama_produk,
							my_produk.gambar_utama,
							my_produk.url_produk,
							my_produk.harga,
							my_produk.status,
							my_produk.merek,
							my_produk.deskripsi,
							my_produk.promo,
							my_produk.kondisi,
							my_merek.merek as nama_merek,
							my_produk_info.rating_vote,
							my_produk_info.rating_value
							');
        $this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id', 'left');	
		$this->db->join('my_merek', 'my_merek.id = my_produk.merek', 'left');
		$this->db->join('my_produk_kategori', 'my_produk_kategori.produk_id = my_produk.id', 'left');
		if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk mencari produk
    function search_produk_detail($search = null, $categori = null, $merek = null, $kondisi = null, $etalase = null, $limit , $offset , $order, $table)
    {
		$this->db->select(
							'my_produk.id,
							my_produk.nama_produk,
							my_produk.gambar_utama,
							my_produk.url_produk,
							my_produk.harga,
							my_produk.status,
							my_produk.merek,
							my_produk.deskripsi,
							my_produk.tanggal,
							my_produk.promo,
							my_produk.kondisi,
							my_merek.merek as nama_merek,
							my_produk_info.rating_vote,
							my_produk_info.rating_value
							');
        $this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id', 'left');
		$this->db->join('my_merek', 'my_merek.id = my_produk.merek', 'left');
		
		
		if ($search != null) {
			foreach($search as $searc){
				$this->db->like('my_produk.nama_produk',$searc);
				break; 
			}
			foreach(array_slice($search, 1) as $searci){
				$this->db->or_like('my_produk.nama_produk',$searci);
				break; 
			}
        }
		if ($kondisi != null) {
			$this->db->where_in('my_produk.kondisi', $kondisi);
        }
		if ($merek != null) {
			$this->db->where_in('my_produk.merek', explode(',', $merek));
        }
		if ($categori != null) {
			$this->db->join('my_produk_kategori', 'my_produk_kategori.produk_id = my_produk.id', 'left');
			$this->db->where_in('my_produk_kategori.category_id', explode(',', $categori));
        }
		if ($etalase != null) {
			$this->db->where_in('my_produk.estalase', $etalase);
        }
		
        $this->db->order_by($order[0], $order[1]);
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
    }
	
	//Untuk mencari
    function produk_detail($where = null,$table)
    {
        $this->db->select(
							'my_produk.id, 
							 my_produk.nama_produk,
							 my_produk.gambar_utama,
							 my_produk.video_youtube,
							 my_produk.harga,
							 my_produk.url_produk,
							 my_produk.berat,
							 my_produk.status,
							 my_produk.estalase,
							 my_produk.merek,
							 my_produk.deskripsi,
							 my_produk.tanggal,
							 my_produk.real_viewer,
							 my_produk.promo,
							 my_produk.kondisi,
							 my_produk.type_produk,
							 my_produk.stok,
							 my_produk_info.viewer,
							 my_produk_info.likers,
							 my_produk_info.share,
							 my_produk_info.rating_vote,
							 my_produk_info.rating_value,
							 my_produk_info.tag_data,
							 my_produk_info.terjual');
        $this->db->join('my_produk_info', 'my_produk_info.produk_id = my_produk.id', 'left');
        $this->db->from($table);
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }
	
	//Untuk mencari portal produk
    function portal_produk_detail($where = null)
    {
        $this->db->select(
							'my_portal.portal,
							 my_portal.gambar,
							 my_produk_portal.id, 
							 my_produk_portal.url_portal');
        $this->db->join('my_portal', 'my_portal.id = my_produk_portal.portal_id');
        $this->db->from('my_produk_portal');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }
	
	//Untuk mencari ulasan produk
    function ulasan_produk_detail($where = null)
    {
        $this->db->select(
							'my_produk_ulasan.pesan,
							 my_produk_ulasan.rating,
							 my_produk_ulasan.tanggal,
							 my_pelanggan.pelanggan,
							 my_portal.portal,
							 my_portal.gambar');
        $this->db->join('my_pelanggan', 'my_pelanggan.id = my_produk_ulasan.pelanggan_id');
		$this->db->join('my_portal', 'my_portal.id = my_produk_ulasan.portal_id');
        $this->db->from('my_produk_ulasan');
        if ($where != null) {
            $this->db->where($where);
        }
		$this->db->order_by('my_produk_ulasan.tanggal', 'DESC');
        return $this->db->get();
    }
	
	function next_record($id, $where = null, $limit = null, $offset = null, $order = null , $table)
    {

		$this->db->where('id >', $id); 
		if ($where != null) {
            $this->db->where($where);
        }
		$this->db->limit($limit, $offset);
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get($table);
    }
	
	
    function previous_record($id, $where = null, $limit = null, $offset = null, $order = null, $table)
    {
        $this->db->where('id <', $id); 
		if ($where != null) {
            $this->db->where($where);
        }
		$this->db->limit($limit, $offset);
		if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get($table);
    }
	
	function kata_kunci($where = null)
    {
        $this->db->select('count(kata_kunci) as cnt');
		$this->db->select('kata_kunci');
		$this->db->group_by('kata_kunci');
		$this->db->having('cnt > 1');
		
		if ($where != null) {
            $this->db->where($where);
        }
		//$this->db->having(array('kata_kunci >' => 0));
		//$this->db->having("cnt > 0", null, false);
		//return $this->db->get('my_pencarian');
		
		//$this->db->select('kata_kunci');
		//$this->db->from('my_pencarian');
		//$this->db->group_by('slug');
		//$this->db->having('count(slug) > 1');
		//$where_clause = $this->db->get_compiled_select();

		return $this->db->get('my_pencarian');
		//$this->db->where('`id` IN ($where_clause)', NULL, FALSE); 
		
    }
	
}
