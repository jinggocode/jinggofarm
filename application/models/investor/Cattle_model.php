<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cattle_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 't_ternak';
        $this->primary_key = 'id';  
        $this->protected = array('id');

		$this->has_one['foto'] = array('foreign_model'=>'Foto_ternak_model','foreign_table'=>'t_foto_ternak','foreign_key'=>'id_ternak','local_key'=>'id'); 
		$this->has_many['fotos'] = array('foreign_model'=>'Foto_ternak_model','foreign_table'=>'t_foto_ternak','foreign_key'=>'id_ternak','local_key'=>'id');
		$this->has_one['kategori'] = array('Category_cattle_model', 'id', 'id_kategori');   

        // $this->has_one['golongan'] = array('foreign_model'=>'Golongan_model','foreign_table'=>' uang_gedung','foreign_key'=>'id','local_key'=>'gedung_id');

		parent::__construct();
	}    

	public function kode_ternak()
	{ 
		$this->db->select('RIGHT(t_ternak.kode_ternak,3) as kode', FALSE);
		$this->db->order_by('kode_ternak','DESC');    
		$query = $this->db->get('t_ternak');      

		if($query->num_rows() <> 0) {             
		    $data = $query->row();      
		    $kode = intval($data->kode) + 1;     
		} else {          
		    $kode = 1;     
		}

		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
		$kodejadi = "TK-".$kodemax;  
		return $kodejadi;   
	}
}
