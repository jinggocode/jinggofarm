<?php

/**
 * 
 */
class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump'));
		$this->load->model(array(''));
	}

	public function index()
	{
		// $data['investasi_berjalan'] = $this->cattle_model->where('status','2')->count_rows();
		// $data['investasi_selesai'] = $this->cattle_model->where('status','3')->count_rows();
		// $data['transaksi'] = $this->transaction_model->where('status','0')->count_rows();
		// $data['profit'] = $this->transaction_model->where('status','0')->count_rows();
		$this->render('admin/home');
	}

}