<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Foto_ternak_model extends MY_Model
{  
	public function __construct()
	{
        $this->table = 't_foto_ternak';
        $this->primary_key = 'id';  
        $this->protected = array('id'); 
 
		parent::__construct();
	}      
}
