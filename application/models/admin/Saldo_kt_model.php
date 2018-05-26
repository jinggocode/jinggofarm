<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_kt_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 't_saldo_kt';
        $this->primary_key = 'id';
        $this->protected = array('id');

        // $this->has_one['golongan'] = array('foreign_model'=>'Golongan_model','foreign_table'=>' uang_gedung','foreign_key'=>'id','local_key'=>'gedung_id');

		parent::__construct();
    }
    
    public function total_saldo()
    {
        $this->db->select_sum('nominal'); 
		$this->db->where('status', '0'); 
		$query = $this->db->get('t_saldo_kt');
        $result = $query->row();
        
        return $result;
    }
}
