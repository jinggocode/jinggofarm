<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 'users';
        $this->primary_key = 'id';  
        $this->protected = array('id');

        // $this->has_one['ternak'] = array('foreign_model'=>'Cattle_model','foreign_table'=>' t_ternak','foreign_key'=>'id','local_key'=>'id_ternak');
		parent::__construct();
	}    
}
