<?php

/**
* 
*/
class Student extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE; 
		$this->load->model(array('student_model','golongan_model')); 
	}

	public function index()
	{
		$data['students'] = $this->student_model->with_golongan()->get_all(); 
		 
		$this->render('student/index', $data);
	}
 	
 	public function add(){
 		$this->generateCsrf();
 		$this->render('student/add');
 	}

 	public function save(){
 		$insert = $this->student_model->from_form()->insert();
 		$input  = $this->input->post(); 

 		if ($insert === FALSE) {
 			$data['student'] = $input;
 			$this->generateCsrf();

 			$this->message('Data Gagal di Inputkan', 'warning');

 			$this->render('student/add', $data);
 		} else {
 			$this->message('Berhasil di Simpan', 'success');
 			$this->go("student/index");
 		} 
 	}

 	public function arsip($id = NULL){
 		$this->student_model->delete($id);
 		$this->go("student/index");
 	}

 	public function edit($id = NULL){
		$data['student'] = $this->student_model->get($id);
		$data['golongan'] = $this->golongan_model->fields('id, golongan')->get_all();

 		$this->render('student/edit', $data); 
 	}

 	public function detail($id = NULL){
		// $data['student'] = $this->student_model->get($id);
		$data['student'] = $this->student_model->with_golongan()->get($id);
 		$this->render('student/detail', $data); 
 	}

 	public function update(){
 		$update = $this->user_model->from_form(NULL,NULL,array('id'))->update();  
 		$input  = $this->input->post(); 

 		if ($insert === FALSE) { 
 			$data['student'] = $this->student_model->get($id);
 			$this->generateCsrf();

 			$this->message('Data Gagal di Inputkan', 'warning');

 			$this->render('student/add', $data);
 		} else {
 			$this->message('Berhasil di Simpan', 'success');
 			$this->go("student/index");
 		} 
 	}

}