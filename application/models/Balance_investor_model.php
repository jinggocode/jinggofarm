<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Balance_investor_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 't_saldo_investor';
		$this->primary_key = 'id';
		$this->protected = array('id');

		// $this->has_one['foto'] = array('foreign_model'=>'Foto_ternak_model','foreign_table'=>'t_foto_ternak','foreign_key'=>'id_ternak','local_key'=>'id'); 
		// $this->has_many['fotos'] = array('foreign_model'=>'Foto_ternak_model','foreign_table'=>'t_foto_ternak','foreign_key'=>'id_ternak','local_key'=>'id');
		$this->has_one['user'] = array('User_model', 'id', 'id_user');
		$this->has_one['lap_keuangan'] = array('Finance_model', 'id', 'id_lap_keuangan');

		parent::__construct();
	}

	public function getJumlahSaldoAmbil($id_user)
	{
		$this->db->select_sum('nominal');
		$this->db->where('id_user', $id_user);
		$this->db->where('status_ambil', '1');
		$this->db->where('status_tarik', '0');
		$query = $this->db->get('t_saldo_investor');
		$result = $query->result();
		$saldo_bisa_diambil = $result[0]->nominal;
		$saldo_sudah_diambil = $this->getSaldoSudahdiTarik($id_user);
		$saldo = $saldo_bisa_diambil - $saldo_sudah_diambil;

		return $saldo;
	}

	public function getSaldoSudahdiTarik($id_user)
	{
		$this->db->select_sum('nominal');
		$this->db->where('id_user', $id_user);
		$this->db->where('status_tarik', '1');
		$query = $this->db->get('t_saldo_investor');
		$result = $query->result();

		return $result[0]->nominal;
	}

	public function getJumlahSaldoTahan($id_user)
	{
		$this->db->select_sum('nominal');
		$this->db->where('id_user', $id_user);
		$this->db->where('status_ambil', '0');
		$this->db->where('status', '0');
		$query = $this->db->get('t_saldo_investor');
		$result = $query->result();

		return $result[0]->nominal;
	}

	// public function cek_paket($id_ternak)
	// {
	// 	$data = $this->transaction_model->where('id_ternak', $id_ternak)->where('status', '0')->count_rows(); 
	// 	if ($data != 1 && $data != 0) {
	// 		dump('ada yang aneh bos!');
	// 	}
	// 	return $data;
	// } 

	// public function kode_ternak()
	// { 
	// 	$this->db->select('RIGHT(t_ternak.kode_ternak,3) as kode', FALSE);
	// 	$this->db->order_by('kode_ternak','DESC');    
	// 	$query = $this->db->get('t_ternak');      

	// 	if($query->num_rows() <> 0) {             
	// 	    $data = $query->row();      
	// 	    $kode = intval($data->kode) + 1;     
	// 	} else {          
	// 	    $kode = 1;     
	// 	}

	// 	$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
	// 	$kodejadi = "TK-".$kodemax;  
	// 	return $kodejadi;   
	// }
}
