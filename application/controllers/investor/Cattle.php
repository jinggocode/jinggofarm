<?php

/**
* 
*/
class Cattle extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array('cattle_model', 'estimate_model'));
		$this->load->model('investor/transaction_model');
		$this->load->helper('utility'); 
	}

	public function index()
	{
		$data['ternak']    = $this->cattle_model->get_all();

		$this->render('investor/cattle/index', $data);
	}
 
	public function view($id)
	{
		$data['data'] 			  = $this->cattle_model->with_kategori()->with_fotos()->get($id);
		$data['paket_dibeli']	  = $this->cattle_model->cek_paket($id);
		$data['perkiraan_profit'] = $this->estimate_model->get_all();
		$data['total_perkiraan']  = $this->estimate_model->totalPerkiraan();  	
		// $data['sisa_unit'] = $this->cattle_model->where('id_ternak', )

		$this->generateCsrf();
		$this->render('investor/cattle/view', $data);
	}

}