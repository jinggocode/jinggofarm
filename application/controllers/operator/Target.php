<?php

/**
* 
*/
class Target extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump'));
		$this->load->model(array('target_model','pasar_model','target_model','jenispasar_model'));   
        $this->load->helper('utility');
	}

	public function index()
    {
        $filter = $this->session->userdata('filter_target'); 
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('per_page'));
        // dump($start);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'target/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'target/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'target/';
            $config['first_url'] = base_url() . 'target/';
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
  
		$data = $this->target_model   
			->with_jenispasar()
			->with_pasar()
            ->where($filter, 'like', '%')  
			->limit($config['per_page'],$offset=$start) 
			->get_all();   

    	$total_cari = $this->target_model
            ->where($filter, 'like', '%')
			->count_rows(); 
   	 	$config['total_rows'] = $this->target_model 
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
            'filter' => $this->session->userdata('filter_target'),
            'page' => $this->uri->segment(1), 
        );    

        $this->generateCsrf();  
		$this->render('target/index', $data);
    }       
    public function search()
    {
        $data = $this->input->post();
        $this->session->unset_userdata('filter_target');
        $this->session->set_userdata('filter_target', $data);
 
        $this->go('target/index');
    }
    public function refresh()
    {
        $this->session->unset_userdata(array('filter_target'));
        $this->go('target'); 
    } 

	public function add()
	{  
		$data['page'] = $this->uri->segment(1); 
		$data['jenis'] = $this->jenispasar_model->get_all();
		$data['pasar'] = $this->pasar_model->get_all();

        $this->generateCsrf();  
		$this->render('target/add', $data);
	}  
	public function save()
	{      
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|max_length[15]');  

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(1);
			$data['jenis'] = $this->jenispasar_model->get_all();
			$data['pasar'] = $this->pasar_model->get_all();
  
 			$this->generateCsrf();
 			$this->render('target/add', $data);
		} else { 
			$data = $this->input->post();      
	        $insert = $this->target_model->insert($data); 

	 		if ($insert === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("target"); 
	 		} else { 
	 			$this->message('Data berhasi di Simpan!', 'success');
	 			$this->go("target");  	 	
	 		} 	 
		}   
	}

	public function edit($id)
	{
		$data['page'] = $this->uri->segment(1); 

		$data['data'] = $this->target_model->get($id); 
		$data['jenis'] = $this->jenistarget_model->get_all();
		$data['kelas'] = $this->kelas_model->get_all();

        $this->generateCsrf();  
		$this->render('target/edit', $data);
	}  
	public function update()
	{ 
		$this->form_validation->set_rules('kode_jenis', 'Jenis target', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('kelas', 'Kelas target', 'trim|required');
		$this->form_validation->set_rules('kode_target', 'Kode target', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('kode_sk', 'Kode SK', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('koordinator', 'Koordinator', 'trim|required|max_length[50]'); 
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required|max_length[30]');
		
		$data = $this->input->post(); 

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2);

			$data['jenis'] = $this->jenistarget_model->get_all();
			$data['kelas'] = $this->kelas_model->get_all();
			$data['data'] = (object)$data; 

 			$this->generateCsrf();
 			$this->render('target/edit', $data);
		} else {       
			if (!empty($_FILES['denah']['tmp_name'])) {
	            $file_name   = $this->upload_foto();
	            $data['denah'] = $file_name;   
	        } 

	        $update = $this->target_model->update($data, $this->input->post('id')); 

	 		if ($update === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("target");  	 	 	
	 		} else { 
	 			$this->message('Data Berhasil di Ubah!', 'success');
	 			$this->go("target");  	 	 	
	 		} 	 
		}   
	}  

	public function delete($id)
	{
		$this->target_model->delete($id);
	 	
	 	$this->message('Data Berhasil di Hapus!', 'success');
	 	$this->go("target"); 
	}

    function upload_foto(){ 
        $set_name   = fileName(1, 'DNH','',8);
        $path       = $_FILES['denah']['name'];
        $extension  = ".".pathinfo($path, PATHINFO_EXTENSION); 

        $config['upload_path']          = './uploads/img/denah/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 9024; 
        $config['file_name']            = $set_name.$extension; 
        $this->load->library('upload', $config);
          // proses upload
        $upload = $this->upload->do_upload('denah');

        if ($upload == FALSE) { 
            dump('Gambar gagal diupload! Periksa gambar');
        }
 
        $upload = $this->upload->data();

        return $upload['file_name'];
    } 

}