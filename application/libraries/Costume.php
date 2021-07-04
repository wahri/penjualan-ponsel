<?php
class Costume
{

    protected $google_config = null;
    protected $facebook_app_id = null;
    protected $facebook_app_secret = null;

    public function __construct()
    {
        $this->CI =& get_instance();
    }
	
	public function create_code_penjualan($id_user)
    {
        $this->CI->load->model('admin_penjualan_model');
		$jml 	= $this->CI->admin_penjualan_model->count_where(array('user_id' => $id_user));
		$t=time();
		$tr 	= $jml + 1;
		$data 	= 'INV/'.$t.'/'.$id_user.'/'.date("Y").'/'.date("m").date("d").'/'.$tr;
        return $data;
    }
	
	public function get_nama_produk($id)
    {
        $this->CI->load->model('admin_produk_model');
        $child = $this->CI->admin_produk_model->get(array('id' => $id));
        return $child;
    }
	
	public function get_produk($id)
    {
        $this->CI->load->model('admin_produk_model');
        $child = $this->CI->admin_produk_model->get(array('id' => $id))->row();
        return $child;
    }
	
	public function get_gambar_kurir($id, $size)
    {
        $this->CI->load->model('admin_kurir_model');
		$this->CI->load->model('all_image_model');
        $child = $this->CI->admin_kurir_model->get(array('id' => $id))->row()->gambar;
        return $this->CI->all_image_model->get(array('id' => $child, 'size' => $size));
    }
	
	
    /*Ambil data child category*/
    public function get_child_kategory($id_kategory)
    {
        $this->CI->load->model('admin_kategori_model');
        $child = $this->CI->admin_kategori_model->get(array('induk' => $id_kategory))->result();
        return $child;
    }
	
	/*Ambil data child kurir*/
    public function get_child_kurir($id_kategory)
    {
        $this->CI->load->model('admin_kurir_model');
        $child = $this->CI->admin_kurir_model->get(array('induk' => $id_kategory))->result();
        return $child;
    }
	
	/*Ambil data child category product*/
	public function get_child_kategory_product($id_kategory)
    {
        $this->CI->load->model('admin_kategori_produk_model');
        $child = $this->CI->admin_kategori_produk_model->get(array('induk' => $id_kategory))->result();
        return $child;
    }
	
	/*Ambil url portal*/
	public function get_url_portal_product($id_portal, $id_produk)
    {
        $this->CI->load->model('admin_produk_model');
        $child = $this->CI->admin_produk_model->get_table('my_produk_portal', array('produk_id'=>$id_produk, 'portal_id'=>$id_portal));
        return $child;
    }
	
	/*Ambil data child user*/
    public function get_child_user($id_user)
    {
        $this->CI->load->model('admin_user_model');
        $child = $this->CI->admin_user_model->get_list(array('users_groups.parent_id' => $id_user))->result();
        return $child;
    }
	
	/*Ambil data child menu*/
    public function get_child_menu($id_menu)
    {
        $this->CI->load->model('admin_menu_model');
        $child = $this->CI->admin_menu_model->get(array('parent_menu' => $id_menu), null)->result();
        return $child;
    }
	
	/*Ambil data child menu*/
    public function get_child_menu_array($id_menu)
    {
        $this->CI->load->model('admin_menu_model');
        $child = $this->CI->admin_menu_model->get(array('parent_menu' => $id_menu), null)->result_array();
        return $child;
    }
	
	 /*Ambil data tubnail*/
    public function get_thumbnail($id_image,$size)
    {
        $this->CI->load->model('all_image_model');
        return $this->CI->all_image_model->get(array('parent' => $id_image, 'size' => $size));
    }
	
	 /*Ambil data tubnail*/
    public function get_thumbnail_image($id_image,$size,$jenis)
    {
        $this->CI->load->model('all_image_model');
        return $this->CI->all_image_model->get(array('parent' => $id_image, 'size' => $size, 'jenis' => $jenis));
    }
	
	 /*Ambil data original image*/
    public function get_original($id_image,$size)
    {
        $this->CI->load->model('all_image_model');
        return $this->CI->all_image_model->get(array('id' => $id_image, 'size' => $size));
    }
	
	/*Ambil data username*/
	public function get_username($id)
    {
        $this->CI->load->model('admin_user_model');
		$user_name = $this->CI->admin_user_model->get(array('id' => $id))->row()->username;
        if (!empty($user_name))
        {
            return $user_name;
        }
        return null;
    }
	
	/*Ambil data kategori produk*/
	public function get_kategori_produk($id)
    {
        $this->CI->load->model('admin_produk_model');
		$child = $this->CI->admin_produk_model->get_produk_categori(array('my_produk_kategori.produk_id'=>$id))->result();
		return $child;
    }
	
	/*Ambil data kategori produk*/
	public function get_estalase_produk($id)
    {
        $this->CI->load->model('admin_produk_model');
		$child = $this->CI->admin_produk_model->get_produk_estalase(array('id'=>$id))->result();
		return $child;
    }
	
	/*Ambil jumlah data kategori produk*/
	public function get_jum_produk($c_names, $c_cat, $c_brand, $c_kond, $c_filt)
    {
        $this->CI->load->model('public_home_model');
		$child = $this->CI->public_home_model->search_produk_detail($c_names, $c_cat, $c_brand, $c_kond, $c_filt, null , null , array('my_produk.tanggal','desc'), 'my_produk')->num_rows();
		return $child;
    }
	
	/*Ambil data kategori berita*/
	public function get_kategori_berita($id)
    {
        $this->CI->load->model('admin_berita_model');
		$child = $this->CI->admin_berita_model->get_berita_categori(array('my_berita_kategori.berita_id'=>$id))->result();
		return $child;
    }
	
	/*Ambil data info berita*/
	public function get_info_berita($id,$row)
    {
        $this->CI->load->model('admin_berita_model');
		$child = $this->CI->admin_berita_model->get_table('my_berita_info', array('berita_id'=>$id))->row()->$row;
		return $child;
    }
	
	/*Ambil data rating berita*/
	public function get_rating_berita($id)
    {
        $this->CI->load->model('admin_berita_model');
		$child1 = $this->CI->admin_berita_model->get_table('my_berita_info', array('berita_id'=>$id))->row()->rating_value;
		$child2 = $this->CI->admin_berita_model->get_table('my_berita_info', array('berita_id'=>$id))->row()->rating_vote;
		return $child1 - $child2;
    }
	
	/*Ambil data rating berita*/
	public function get_rating_berita_votes($id)
    {
        $this->CI->load->model('admin_berita_model');
		$child = $this->CI->admin_berita_model->get_table('my_berita_info', array('berita_id'=>$id))->row()->rating_vote;
		return $child;
    }
	
	/*Ambil data rating berita*/
	public function get_rating_berita_values($id)
    {
        $this->CI->load->model('admin_berita_model');
		$child = $this->CI->admin_berita_model->get_table('my_berita_info', array('berita_id'=>$id))->row()->rating_value;
		return $child;
    }
	
	/*Ambil data kategori berita*/
	public function get_kategori_video($id)
    {
        $this->CI->load->model('admin_video_model');
		$child = $this->CI->admin_video_model->get_berita_categori(array('my_video_kategori.video_id'=>$id))->result();
		return $child;
    }
	
	/*Ambil data kategori berita*/
	public function get_child_tv($id)
    {
        $this->CI->load->model('admin_tv_model');
		$child = $this->CI->admin_tv_model->get(array('my_tv.tanggal'=>$id),array('my_tv.waktu','ASC'))->result();
		return $child;
    }
	
	/*Ambil data kelurahan*/
	public function get_regional($id,$table)
    {
        $this->CI->load->model('public_home_model');
		$child = $this->CI->public_home_model->get(array('id' => $id) , $table);
		return $child;
    }
	
	/*Buat gambar thumbnail*/
    public function create_image_thumbnail($data_image, $size, $id_parent, $type)
    {
        $this->CI->load->library('image_lib');

        $upload_data = $data_image;

        $last_name = $size['width'] . 'x' . $size['height'] . '.png';
        $thumb_name = $upload_data['raw_name'] . '_thumb_';
        $new_name = $upload_data['raw_name'].'_'.$last_name;
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $upload_data["full_path"];
        $image_config['create_thumb'] = false;
        $image_config['maintain_ratio'] = true;
        $image_config['new_image'] = $upload_data["file_path"] . $new_name;
        $image_config['quality'] = "100%";
        $image_config['width'] = $size['width'];
        $image_config['height'] = $size['height'];
        $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
        $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

        $this->CI->image_lib->initialize($image_config);

        if (!$this->CI->image_lib->resize()) { //Resize image
            echo $this->CI->image_lib->display_errors();
        }

        $image_config['image_library'] = 'gd2';
        $image_config['source_image'] = $upload_data["file_path"] . $new_name;
        $image_config['new_image'] = $upload_data["file_path"] . $new_name;
        $image_config['quality'] = "100%";
        $image_config['maintain_ratio'] = FALSE;
        $image_config['width'] = $size['width'];
        $image_config['height'] = $size['height'];
        $image_config['x_axis'] = '0';
        $image_config['y_axis'] = '0';

        $this->CI->image_lib->clear();
        $this->CI->image_lib->initialize($image_config);

        if (!$this->CI->image_lib->crop()) {
            echo $this->CI->image_lib->display_errors();
        }

        /*Masukkan data kedalam database*/
        $this->CI->load->model('all_image_model');
        if ($type != null) {
            $url_image = 'upload/images/' . $new_name;
        } else {
           $url_image = 'upload/images/' . $new_name;
        }
        $data = array(
            'title' => str_replace('_', ' ', $thumb_name),
            'url' => $url_image,
            'size' => $size['width'] . 'x' . $size['height'],
            'image_name' => $new_name,
			'jenis' => $type,
			'parent' => $id_parent
        );
        $this->CI->all_image_model->insert($data);
    }
	
	public function clean($string) {
	   $string1 	= str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
	   $string2 	= str_replace('  ', ' ', $string1); // Replaces all spaces with hyphens.
	   $string3 	= str_replace(' ', '-', $string2); // Replaces all spaces with hyphens.
	   $string 		= strtolower($string3);
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	
	public function clean_url($string) {
	   $string1 	= str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
	   $string2 	= str_replace('  ', ' ', $string1); // Replaces all spaces with hyphens.
	   $string3 	= str_replace(' ', '-', $string2); // Replaces all spaces with hyphens.
	   $string 		= strtolower($string3);
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	
	public function bintang($total) {
		if($total == 1){
			$bintang = '<i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>';
		}else if($total == 2){
			$bintang = '<i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>';
		}else if($total == 3){
			$bintang = '<i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>';
		}else if($total == 4){
			$bintang = '<i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i>';
		}else if($total == 5){
			$bintang = '<i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i><i class="spr-icon spr-icon-star" style=""></i>';
		}
		return $bintang;
	}
	
	public function searchArrayKeyVal($sKey, $id, $array) {
	   foreach ($array as $key => $val) {
		   if ($val[$sKey] == $id) {
			   return $key;
		   }
	   }
	   return false;
	}

}

    