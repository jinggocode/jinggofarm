<?php

/**
*
*/
class Homepage extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->load->model(array('cattle_model'));
		$this->load->model(array('category_cattle_model'));
		$this->load->model(array('foto_ternak_model'));
	}

	public function index()
	{
		$data['ternak'] = $this->cattle_model
		      ->with_kategori()
		      ->with_foto()
		      ->limit(3)
		      ->order_by('sisa_unit', 'desc')
		      ->get_all();
		// $data['ternak'] = $this->foto_ternak_model->where('id_ternak')get();

		// dump($data);

		$this->render('home', $data);
	}

}
