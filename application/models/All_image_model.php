<?php

class All_image_model extends CI_Model
{

    protected $table = 'my_image';

   	//Ambil data
    public function get_where($where = null, $limit = null, $offset = null, $order = null)
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
	
	public function get($where = null, $order = null)
    {
        if ($order != null) {
            $this->db->order_by($order[0], $order[1]);
        }
        return $this->db->get_where($this->table, $where);
    }

    //Tambah Data
    function insert($data = null)
    {
        return $this->db->insert($this->table, $data);
    }

    //Update Data
    function update($where, $data)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $data);
    }

    //Delete Data
    function delete($where)
    {
        $this->db->where($where);
        return $this->db->delete($this->table);
    }

    //Ambil data gambar iklan
    function get_iklan($where = null, $limit = null, $offset = null, $order = null)
    {
        $this->db->select('my_image.*');
        if ($order != null) {
            $this->db->order_by($order['order_by'], $order['order']);
        }
        $images = $this->db->get_where($this->table, $where)->result_array();
        $array = array();
        foreach ($images as $image) {
            $array[$image['id']] = $image;
            $array[$image['id']]['thumbnails'] = $this->db->get_where('my_image', array('parent' => $image['id']))->result_array();
        }
        return $array;
    }


    //Ambil data image for modal
    public function get_list_modal($where = null, $limit = null, $offset = null)
    {
        $this->db->order_by('id', 'desc');
        $images = $this->db->get_where($this->table, $where, $limit, $offset)->result_array();

        $array = array();
        foreach ($images as $image) {
            $array[$image['id']] = $image;
            $array[$image['id']]['thumbnails'] = $this->db->get_where('my_image', array('parent' => $image['id']))->result_array();
            $array[$image['id']]['thumbnails']['original'] = $image;
        }
        return $array;
    }
   

    //Get detail image
    public function get_detail_image($where = null)
    {
        $this->db->order_by('id', 'desc');
        $image = $this->db->get_where($this->table, $where)->row_array();

        $array = array();
        $array = $image;
		$array['thumbnails'] = $this->db->get_where('my_image', array('parent' => $image['id']))->result_array();
        $array['thumbnails']['original'] = $image;

        return $array;
    }

    public function get_image_from_item_graph($image)
    {
        $item = $this->db->get_where('my_image', array('parent' => $image, 'size' => '200x200'))->row_array();
        return 'upload/image'.$item['image_name'];

    }

}