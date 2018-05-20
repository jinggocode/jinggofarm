<?php

/**
* 
*/
class cattleman extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/cattleman_model');   
        // $this->load->helper('utility');
	}

	public function index()
    {
        $filter = $this->session->userdata('filter_cattleman'); 
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('per_page'));
        // dump($start);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'cattleman/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cattleman/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cattleman/';
            $config['first_url'] = base_url() . 'cattleman/';
        }

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
        $config['page_query_string'] = TRUE;
  
		$data = $this->cattleman_model   
            ->where($filter, 'like', '%')  
			->limit($config['per_page'],$offset=$start) 
			->get_all();   

    	$total_cari = $this->cattleman_model
            ->where($filter, 'like', '%')
			->count_rows(); 
   	 	$config['total_rows'] = $this->cattleman_model 
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
            'filter' => $this->session->userdata('filter_cattleman'),
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();  
		$this->render('admin/cattleman/index', $data);
    }       
    public function search()
    {
        $data = $this->input->post();
        $this->session->unset_userdata('filter_cattleman');
        $this->session->set_userdata('filter_cattleman', $data);
 
        $this->go('admin/cattleman');
    }
    public function refresh()
    {
        $this->session->unset_userdata(array('filter_cattleman'));
        $this->go('admin/cattleman'); 
    } 

	public function add()
	{  
		$data['page'] = $this->uri->segment(2);  

        $this->generateCsrf();  
		$this->render('admin/cattleman/add', $data);
	}  
	public function save()
	{   
		$this->form_validation->set_rules('nama', 'Nama Peternak', 'trim|required|max_length[50]'); 
		$this->form_validation->set_rules('umur', 'Umur', 'trim|required|max_length[2]'); 
		$this->form_validation->set_rules('lama_pengalaman', 'Pengalaman', 'trim|required|max_length[2]'); 

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2); 
  
 			$this->generateCsrf();
 			$this->render('admin/cattleman/add', $data);
		} else { 
			$data = $this->input->post();      

			if (!empty($_FILES)) {
	            $foto_name    = $this->upload_foto();
	            $data['foto'] = $foto_name;    
	        }     

	        $insert = $this->cattleman_model->insert($data); 

	 		if ($insert === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("admin/cattleman"); 
	 		} else { 
	 			$this->message('Data berhasi di Simpan!', 'success');
	 			$this->go("admin/cattleman");  	 	
	 		} 	 
		}   
	}

	public function edit($id)
	{
		$data['page'] = $this->uri->segment(2); 

		$data['data'] = $this->cattleman_model->get($id);   

        $this->generateCsrf();  
		$this->render('admin/cattleman/edit', $data);
	}  
	public function update()
	{ 
		$this->form_validation->set_rules('nama', 'Nama Ternak', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('jumlah_unit', 'Jumlah Pembagian Unit', 'trim|required|max_length[2]'); 
		$this->form_validation->set_rules('lama_periode', 'Lama Periode', 'trim|required|max_length[2]'); 
		$this->form_validation->set_rules('bghasil_peternak', 'Bagi Hasil Peternak', 'trim|required|max_length[4]');  
		$this->form_validation->set_rules('bghasil_investor', 'Bagi Hasil Investor', 'trim|required|max_length[4]');  
		
		$data = $this->input->post(); 

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2); 

			$data['data'] = (object)$data; 

 			$this->generateCsrf();
 			$this->render('admin/cattleman/edit', $data);
		} else {       
			if (!empty($_FILES['foto']['tmp_name'])) {
	            $file_name    = $this->upload_foto();
	            $data['foto'] = $file_name;   
	        } 

	        $data['slug'] = $this->slug->create_uri($data);  
	        $update = $this->cattleman_model->update($data, $this->input->post('id')); 

	 		if ($update === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("admin/cattleman");  	 	 	
	 		} else { 
	 			$this->message('Data Berhasil di Ubah!', 'success');
	 			$this->go("admin/cattleman");  	 	 	
	 		} 	 
		}   
	}  

	public function delete($id)
	{
		$this->cattleman_model->delete($id);
	 	
	 	$this->message('Data Berhasil di Hapus!', 'success');
        $this->go('admin/cattleman'); 
	}  

	public function view($id)
	{
		$data['page'] = $this->uri->segment(2); 

		$data['data'] = $this->cattleman_model->get($id);   

        $this->generateCsrf();  
		$this->render('admin/cattleman/view', $data);
	}  
    
    function upload_foto(){ 
        $set_name   = fileName(1, 'CAT','',8);
        $path       = $_FILES['foto']['name'];
        $extension  = ".".pathinfo($path, PATHINFO_EXTENSION); 

        $config['upload_path']          = './uploads/cattleman/img/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 9024; 
        $config['file_name']            = $set_name.$extension; 
        $this->load->library('upload', $config);
          // proses upload
        $upload = $this->upload->do_upload('foto');

        if ($upload == FALSE) { 
            dump('Gambar gagal diupload! Periksa gambar');
        }
 
        $upload = $this->upload->data(); 

        return $upload['file_name'];
    } 
}