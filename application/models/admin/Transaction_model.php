<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 't_transaksi';
        $this->primary_key = 'id';  
        $this->protected = array('id');

        $this->has_one['ternak'] = array('foreign_model'=>'Cattle_model','foreign_table'=>' t_ternak','foreign_key'=>'id','local_key'=>'id_ternak');

		parent::__construct();
	}    

	public function GetJumlahPaket($id_ternak)
	{
	    $this->db->select_sum('jumlah');
	    $this->db->where('id_ternak', $id_ternak);  
		$query = $this->db->get('t_pemilik_ternak'); 

		return $query->result();
	}
}
