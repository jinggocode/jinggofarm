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
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/cattle_model');     
        // $this->load->helper('utility');
	}

	public function index()
    {
        $filter = $this->session->userdata('filter_cattle'); 
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('per_page'));
        // dump($start);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'cattle/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cattle/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cattle/';
            $config['first_url'] = base_url() . 'cattle/';
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
  
		$data = $this->cattle_model   
            ->where($filter, 'like', '%')  
			->limit($config['per_page'],$offset=$start) 
			->get_all();   

    	$total_cari = $this->cattle_model
            ->where($filter, 'like', '%')
			->count_rows(); 
   	 	$config['total_rows'] = $this->cattle_model 
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
            'filter' => $this->session->userdata('filter_cattle'),
            'page' => $this->uri->segment(2), 
        );    

        $this->generateCsrf();  
		$this->render('admin/cattle/index', $data);
    }       
    public function search()
    {
        $data = $this->input->post();
        $this->session->unset_userdata('filter_cattle');
        $this->session->set_userdata('filter_cattle', $data);
 
        $this->go('admin/cattle');
    }
    public function refresh()
    {
        $this->session->unset_userdata(array('filter_cattle'));
        $this->go('admin/cattle'); 
    } 

	public function add()
	{  
		$data['page'] = $this->uri->segment(2);  

        $this->generateCsrf();  
		$this->render('admin/cattle/add', $data);
	}  
	public function save()
	{   
		$this->form_validation->set_rules('nama', 'Nama Ternak', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('jumlah_unit', 'Jumlah Pembagian Unit', 'trim|required|max_length[2]'); 
		$this->form_validation->set_rules('lama_periode', 'Lama Periode', 'trim|required|max_length[2]'); 
		$this->form_validation->set_rules('bghasil_peternak', 'Bagi Hasil Peternak', 'trim|required|max_length[4]');  
		$this->form_validation->set_rules('bghasil_investor', 'Bagi Hasil Investor', 'trim|required|max_length[4]');  

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2); 
  
 			$this->generateCsrf();
 			$this->render('admin/cattle/add', $data);
		} else { 
			$data = $this->input->post();      

			if (!empty($_FILES)) {
	            $file_name    = $this->upload();
	            $data['foto'] = $foto_name;    
	        }    

	        $insert = $this->cattle_model->insert($data); 

	 		if ($insert === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("admin/cattle"); 
	 		} else { 
	 			$this->message('Data berhasi di Simpan!', 'success');
	 			$this->go("admin/cattle");  	 	
	 		} 	 
		}   
	}

	public function edit($id)
	{
		$data['page'] = $this->uri->segment(1); 

		$data['data'] = $this->cattle_model->get($id); 
		$data['jenis'] = $this->jeniscattle_model->get_all();
		$data['kelas'] = $this->kelas_model->get_all();

        $this->generateCsrf();  
		$this->render('cattle/edit', $data);
	}  
	public function update()
	{ 
		$this->form_validation->set_rules('kode_jenis', 'Jenis cattle', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('kelas', 'Kelas cattle', 'trim|required');
		$this->form_validation->set_rules('kode_cattle', 'Kode cattle', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('kode_sk', 'Kode SK', 'trim|required|max_length[10]'); 
		$this->form_validation->set_rules('koordinator', 'Koordinator', 'trim|required|max_length[50]'); 
		$this->form_validation->set_rules('NIP', 'NIP', 'trim|required|max_length[30]');
		
		$data = $this->input->post(); 

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2);

			$data['jenis'] = $this->jeniscattle_model->get_all();
			$data['kelas'] = $this->kelas_model->get_all();
			$data['data'] = (object)$data; 

 			$this->generateCsrf();
 			$this->render('cattle/edit', $data);
		} else {       
			if (!empty($_FILES['denah']['tmp_name'])) {
	            $file_name   = $this->upload_foto();
	            $data['denah'] = $file_name;   
	        } 

	        $update = $this->cattle_model->update($data, $this->input->post('id')); 

	 		if ($update === FALSE) {  
	 			$this->message('Aksi Gagal', 'warning');

	 			$this->go("cattle");  	 	 	
	 		} else { 
	 			$this->message('Data Berhasil di Ubah!', 'success');
	 			$this->go("cattle");  	 	 	
	 		} 	 
		}   
	}  

	public function delete($id)
	{
		$this->cattle_model->delete($id);
	 	
	 	$this->message('Data Berhasil di Hapus!', 'success');
        $this->go('admin/cattle'); 
	}

    function upload(){ 

 		  
 		  $error = array();
	      $success = array();
			foreach($_FILES as $field_name => $file)
			{   
				if ($field_name == 'file') { 
	       			$set_name_fl   = fileName(1, 'FILE','',8);
	       			$path_fl       = $_FILES['file']['name'];
	        		$extension_fl  = ".".pathinfo($path_fl, PATHINFO_EXTENSION); 
	        		// dump($extension_fl);
			        $config['upload_path']          = './uploads/cattle/file/'; 
			        $config['max_size']             = 3024; 		
			        $config['file_name']            = $set_name_fl.$extension_fl; 
			        $this->load->library('upload', $config);
					$uploads = $this->upload->do_upload('file');
					$success2[] = $this->upload->data();
	      dump($success2);
				} else if ($field_name == 'foto') { 
				} 
			}

	      dump($success2);
        $upload = $this->upload->do_upload('foto');
        if ($upload == FALSE) { 
            dump('Gambar gagal diupload! Periksa gambar');
        }
 
        $upload = $this->upload->data();

        return $upload['file_name'];
    } 

    function upload_file(){ 
        $set_name   = fileName(1, 'FILE','',8); 
        $path       = $_FILES['file']['name'];
        $type       = pathinfo($path, PATHINFO_EXTENSION);
        $extension  = ".".pathinfo($path, PATHINFO_EXTENSION); 

        if ($type != "jpg") { 
	 		$this->message('File harus PDF!', 'danger');
	 		$this->go("admin/cattle");  
        } else { 
		    $config['upload_path']          = './uploads/cattle/file/'; 
		    $config['max_size']             = 10024; 
		    $config['file_name']            = $set_name.$extension;  
		    $this->load->library('upload', $config);

		    $uploads = $this->upload->do_upload('file'); 
		    if ($uploads == FALSE) { 
		    	$error = $this->upload->display_errors(); 
		    }

		    $uploads = $this->upload->data();
dump($uploads);
		    return $upload['file_name']; 
        }
    } 

}