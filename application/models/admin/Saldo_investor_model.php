<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_investor_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 't_saldo_investor';
        $this->primary_key = 'id';  
        $this->protected = array('id');

        // $this->has_one['golongan'] = array('foreign_model'=>'Golongan_model','foreign_table'=>' uang_gedung','foreign_key'=>'id','local_key'=>'gedung_id');

		parent::__construct();
	}    
}
