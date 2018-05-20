<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 't_transaksi';
        $this->primary_key = 'id';  
        $this->protected = array('id');

		$this->has_one['ternak'] = array('Cattle_model', 'id', 'id_ternak'); 

		parent::__construct();
	}    

	public function kode_transaksi()
	{ 
		$this->db->select('RIGHT(t_transaksi.kode_transaksi,3) as kode', FALSE);
		$this->db->order_by('kode_transaksi','DESC');    
		$query = $this->db->get('t_transaksi');      

		if($query->num_rows() <> 0) {             
		    $data = $query->row();      
		    $kode = intval($data->kode) + 1;     
		} else {          
		    $kode = 1;     
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
		$kodejadi = "TR-".$kodemax;  
		return $kodejadi;   
	}

	public function checkTime($selesai, $kode)
	{
        date_default_timezone_set('Asia/jakarta');  
		$mulai=date("H:i:s"); 
		$tgl_mulai = date("Y-m-d");
		$tgl_akhir = date('Y-m-d', strtotime($selesai));    

		$mulai_time=(is_string($mulai)?strtotime($mulai):$mulai);// memaksa mebentuk format time untuk string
		$selesai_time=(is_string($selesai)?strtotime($selesai):$selesai);  

		$detik=$selesai_time-$mulai_time; //hitung selisih dalam detik
		if ($detik <= 60) {
		    $sisa_menit = 0;
		    $sisa_detik=$detik%1; //hitung sisa detik
		} else { 
		    $sisa_menit=floor($detik/60); //hitung menit
		    $sisa_detik=$detik%$sisa_menit; //hitung sisa detik
		}   

		// apakah hari ini 
		if (strtotime($tgl_mulai) != strtotime($tgl_akhir)) {	 
			// ambil data transaksi sesuai yg dipilih
			$transaction 	= $this->transaction_model->where('kode_transaksi', $kode)->get();
			// melakukan pengubahan status
			$this->transaction_model->update(array('status' => '2'), $transaction->id); 
		} else {
			if ($sisa_menit == 0 && $sisa_detik == 0) {  
				// ambil data transaksi sesuai yg dipilih
				$transaction 	= $this->transaction_model->where('kode_transaksi', $kode)->get();
				// melakukan pengubahan status
				$this->transaction_model->update(array('status' => '2'), $transaction->id); 
			} else {  
			} 
		}
	}
}
