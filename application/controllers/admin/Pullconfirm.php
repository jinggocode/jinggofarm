<?php

/**
* 
*/ 
class Pullconfirm extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility')); 
		$this->load->model('balance_investor_model');  
		$this->load->model('admin/pemilikternak_model');  
		$this->load->model('admin/user_model');   

        // $this->load->helper('utility');
	}

	public function index()
    {
        $start = $this->uri->segment(4, 0);  
		$config['base_url'] = base_url() . 'admin/pullconfirm/index/';

		/*Class bootstrap pagination yang digunakan*/
		$config['full_tag_open'] = "<ul class='pagination' style='position:relative; top:-25px;'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>"; 
        $config['per_page'] = 10;  
  
		$data = $this->balance_investor_model   	
			->with_user() 
			->where('status_tarik', '1')
			->where('status_terima', '0')
			->limit($config['per_page'],$offset=$start) 
			->order_by('created_at', 'DESC')
			->get_all();     
   	 	$config['total_rows'] = $this->balance_investor_model 
			->where('status_tarik', '1')
			->where('status_terima', '0')
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'data' => $data, 
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'], 
            'start' => $start,  
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();  
		$this->render('admin/pullconfirm/index', $data);
    }  

	public function history()
    {
        $start = $this->uri->segment(4, 0);  
		$config['base_url'] = base_url() . 'admin/pullconfirm/history/';

		/*Class bootstrap pagination yang digunakan*/
		$config['full_tag_open'] = "<ul class='pagination' style='position:relative; top:-25px;'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>"; 
        $config['per_page'] = 10;  
  
		$data = $this->balance_investor_model   	
			->with_user() 
			->where('status_tarik', '1')
			->where('status_terima', '1')
			->limit($config['per_page'],$offset=$start) 
			->order_by('created_at', 'DESC')
			->get_all();     
   	 	$config['total_rows'] = $this->balance_investor_model 
			->where('status_tarik', '1')
			->where('status_terima', '1')
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'data' => $data, 
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'], 
            'start' => $start,  
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();  
		$this->render('admin/pullconfirm/history', $data);
    }       
    public function search()
    { 
    	$search_data = $this->input->get();

        $data = $this->Balance_investor_model->search($search_data);
 
        $this->generateCsrf();  
		$this->render('admin/pullconfirm/index', $data);
    } 

	public function confirm($id)
	{   
		$data['status_terima'] = '1';
		$this->balance_investor_model->update($data, $id); 

		$this->message('Berhasil di Konfirmasi', 'success');
		$this->go("admin/pullconfirm/history");  	 	 
	}

	public function cancel($id)
	{   
		$data['status_terima'] = '0';
		$this->balance_investor_model->update($data, $id); 

		$this->message('Berhasil di Batalkan', 'success');
		$this->go("admin/pullconfirm");  	 	 
	} 
}