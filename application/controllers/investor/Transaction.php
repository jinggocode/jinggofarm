<?php

/**
* 
*/
class Transaction extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->root_view = "investor/";
		$this->load->model('investor/transaction_model');
		$this->load->helper('utility');
	}

	public function index()
	{ 
        $filter = $this->session->userdata('filter_transaction'); 
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('per_page'));

        // dump($start);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'investor/transaction/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'investor/transaction/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'investor/transaction/';
            $config['first_url'] = base_url() . 'investor/transaction/';
        }

		/*Class bootstrap pagination yang digunakan*/
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Sebelumnya';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

        $config['per_page'] = 7;
        $config['page_query_string'] = TRUE;

        $user = $this->ion_auth->user()->row();
  
		$data = $this->transaction_model   
            ->where($filter, 'like', '%')  
			->limit($config['per_page'],$offset=$start) 
			->with_ternak()
			->order_by('created_at', 'DESC')
			->where('id_user', $user->id)
			->get_all();   

    	$total_cari = $this->transaction_model
            ->where($filter, 'like', '%')
			->where('id_user', $user->id)
			->count_rows(); 
   	 	$config['total_rows'] = $this->transaction_model 
			->where('id_user', $user->id)
		    ->count_rows();  
          
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array( 
        	'data' => $data, 
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'total_cari' => $total_cari,
            'start' => $start, 
            'filter' => $this->session->userdata('filter_transaction'),
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();  
		$this->render('investor/transaction/index', $data);
	}

	public function view()
	{
		$this->render('investor/transaction/view');
	}

}