<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	//untuk mengetahui bulan bulan
	if ( ! function_exists('bulan'))
	{
		function bulan($bln)
		{
			switch ($bln)
			{
				case 1:
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
		}
	}
	 
	//format tanggal yyyy-mm-dd
	if ( ! function_exists('tgl_indo'))
	{
		function tgl_indo($tgl)
		{
			$ubah 		= gmdate($tgl, time()+60*60*8);
			$pecah 		= explode("-",$ubah);  //memecah variabel berdasarkan -
			$tanggal 	= $pecah[2];
			$bulan 		= bulan($pecah[1]);
			$tahun 		= $pecah[0];
			return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
		}
	}
	
	if( ! function_exists('dateDiff')){
		function dateDiff($date)
			{
			$mydate		= date("Y-m-d H:i:s");
			$theDiff		="";
			$datetime1 	= date_create($date);
			$datetime2 	= date_create($mydate);
			$interval 	= date_diff($datetime1, $datetime2);
			$min		= $interval->format('%i');
			$sec		= $interval->format('%s');
			$hour		= $interval->format('%h');
			$mon		= $interval->format('%m');
			$day		= $interval->format('%d');
			$year		= $interval->format('%y');
			  
			if($interval->format('%i%h%d%m%y')=="00000")
			  {
				return "> ".$sec." Detik";
			  } 

			else if($interval->format('%h%d%m%y')=="0000"){
			   return "> ".$min." Menit";
			   }

			else if($interval->format('%d%m%y')=="000"){
				if($hour > 2){
					return " Waktu Habis";
				}else{
					return "> ".$hour." Jam";
				}
			   }


			else if($interval->format('%m%y')=="00"){
			   return " Waktu Habis";
			   }

			else if($interval->format('%y')=="0"){
			   return " Waktu Habis";
			   }

			else{
			   return " Waktu Habis";
			   }
			}
		}

	//format tanggal timestamp
	if( ! function_exists('bln_indo_timestamp')){
	 
		function bln_indo_timestamp($tgl)
		{
			$inttime=$tgl; //mengubah format menjadi tanggal biasa
			$tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi
			 
			$tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
			$tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
			$tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
		 
			$tgl=$tglBarua[2];
			$bln=$tglBarua[1];
			$thn=$tglBarua[0];
		 
			$bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
			$ubahTanggal="$bln"; //hasil akhir tanggal
		 
			return $ubahTanggal;
		}
	}
	 
	//format tanggal timestamp
	if( ! function_exists('tgl_indo_timestamp')){
	 
		function tgl_indo_timestamp($tgl)
		{
			$inttime	= $tgl; //mengubah format menjadi tanggal biasa
			$tglBaru	= explode(" ",$inttime); //memecah berdasarkan spaasi
			 
			$tglBaru1	= $tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
			$tglBaru2	= $tglBaru[1]; //mendapatkan fotmat hh:ii:ss
			$tglBarua	= explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
		 
			$tgl		= $tglBarua[2];
			$bln		= $tglBarua[1];
			$thn 		= $tglBarua[0];
		 
			$bln		= bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
			$ubahTanggal= "$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal
		 
			return $ubahTanggal;
		}
	}
	
	//format durasi video
	if( ! function_exists('durasi_video')){
		function durasi_video($durasi)
		{
			$d 	= new DateInterval($durasi);
			return $d->format('%H:%i:%S');
		}
	}
	
	/*Get content excerpt*/
	if (!function_exists('get_content_excerpt')) {
		function get_content_excerpt($content, $length)
		{
			$title 		= (($content));
			$title 		= strip_tags($title);

			// cari last space
			$last_space = strlen($title);

			// Trim
			$content 	= substr($title, 0, $length);

			if($last_space > $length){
				$content .= '...';
			}
			return $content;
		}
	}
	
	/*harga*/
	if (!function_exists('get_harga')) {
		function get_harga($harga)
		{
			$rupiah 	= number_format($harga, 0, ".", ".");
			return $rupiah;
		}
	}