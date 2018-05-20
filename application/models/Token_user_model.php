<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Token_user_model extends MY_Model
{
	public function __construct()
	{
        $this->table = 'token_user';
        $this->primary_key = 'id';
        $this->protected = array('id');

		// $this->has_one['ternak'] = array('Cattle_model', 'id', 'id_ternak');
		parent::__construct();
	}
}
