<?php

/**
*
*/
class Groups extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model('admin/cattleman_model');
		$this->load->model('admin/category_cattleman_model');
	}

	public function view()
	{
		$data['pengelola'] = $this->cattleman_model->with_kategori()->get_all();

		$this->render('group/view', $data);
	}

}
