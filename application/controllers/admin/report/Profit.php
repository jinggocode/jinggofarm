<?php

/**
*
*/
class Profit extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/cattle_model');
		$this->load->model('admin/pemilikternak_model');
		$this->load->model('admin/user_model');
		$this->load->model('admin/category_cattle_model');
		$this->load->model('admin/report_model');

		// $this->load->helper('utility');
	}

	public function index()
	{
		if ($this->input->get('action') == "submit") {
			$start = $this->uri->segment(5, 0);
			$config['base_url'] = base_url() . 'admin/report/profit/index/';

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

			$data = $this->report_model
						->getDataReport($this->input->get('month'), $this->input->get('year'), $config['per_page'], $offset=$start);

			$config['total_rows'] = $this->report_model->getRowReport($this->input->get('month'), $this->input->get('year'));

			$total_profit = $this->report_model->getTotalProfit($this->input->get('month'), $this->input->get('year'));

			$this->load->library('pagination');
			$this->pagination->initialize($config);
			
			$data = array(
				'data' => $data,
				'total_profit' => $total_profit,
				'action' => $this->input->get('action'),
				'search_data' => $this->input->get(),
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				'page' => $this->uri->segment(2),
			);

			$this->generateCsrf();
			$this->render('admin/report/profit/index', $data);
		} else {
			$data['page'] 	= $this->uri->segment(2);
			$data['action'] = "";

			$this->generateCsrf();
			$this->render('admin/report/profit/index', $data);
		}

	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->cattle_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/cattle/index', $data);
	}

	public function add()
	{
		$data['page'] = $this->uri->segment(2);
		$data['category'] = $this->category_cattle_model->get_all();

		$this->generateCsrf();
		$this->render('admin/cattle/add', $data);
	}
	public function save()
	{
		$this->form_validation->set_rules('nama', 'Nama Ternak', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('biaya_operasional', 'Biaya Operasional', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('jumlah_unit', 'Jumlah Pembagian Unit', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('jumlah_sapi', 'Jumlah Sapi', 'trim|required|max_length[2]');
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

			if (!empty($_FILES['foto']['tmp_name'])) {
				$foto_name    = $this->upload_foto();
				$data['foto'] = $foto_name;
			}
			$data['hak_akses'] = '1';

			$data['slug'] 		 = $this->slug->create_uri($data);
			$data['kode_ternak'] = $this->cattle_model->kode_ternak();
			$data['sisa_unit'] 	 = $this->input->post('jumlah_unit');
			$data['biaya'] 		 = str_replace(".", "", $this->input->post('biaya'));
			$data['biaya_operasional'] = str_replace(".", "", $this->input->post('biaya_operasional'));

			$insert = $this->cattle_model->insert($data);

			// memasukkan id ternak ke tabel foto
			$value['id_ternak'] = $insert;
			$this->db->where('id_ternak', NULL);
			$this->db->update('t_foto_ternak', $value);

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
		$data['page'] = $this->uri->segment(2);

		$data['data'] = $this->cattle_model->get($id);
		$data['category'] = $this->category_cattle_model->get_all();

		$this->generateCsrf();
		$this->render('admin/cattle/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama Ternak', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('biaya_operasional', 'Biaya Operasional', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('jumlah_sapi', 'Jumlah Sapi', 'trim|required|max_length[2]');
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
			$this->render('admin/cattle/edit', $data);
		} else {
			$data['biaya'] 			   = str_replace(".", "", $this->input->post('biaya'));
			$data['biaya_operasional'] = str_replace(".", "", $this->input->post('biaya_operasional'));

			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name    = $this->upload_foto();
				$data['foto'] = $file_name;
			}

			$data['slug'] = $this->slug->create_uri($data);
			$update = $this->cattle_model->update($data, $this->input->post('id'));

			$value['id_ternak'] = $this->input->post('id');
			$this->db->where('id_ternak', NULL);
			$this->db->update('t_foto_ternak', $value);

			if ($update === FALSE) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("admin/cattle");
			} else {
				$this->message('Data Berhasil di Ubah!', 'success');
				$this->go("admin/cattle");
			}
		}
	}

	public function ubah_status()
	{
		$data = $this->input->post();
		if ($this->input->post('status') == '2') {
			$tgl_now = date('Y-m-d');
			$data['tanggal_ternak'] = date('Y-m-d');
			$data['batas_periode']  = date('Y-m-d', strtotime('+4 years', strtotime($tgl1)));
		}
		$update = $this->cattle_model->update($data, $this->input->post('id'));

		if ($update === FALSE) {
			$this->message('Aksi Gagal', 'warning');

			$this->go("admin/cattle");
		} else {
			$this->message('Status telah di Ubah!', 'success');
			$this->go("admin/cattle");
		}
	}

	public function delete($id)
	{
		$this->cattle_model->delete($id);

		$this->message('Data Berhasil di Hapus!', 'success');
		$this->go('admin/cattle');
	}

	public function view($id)
	{
		$data['page'] = $this->uri->segment(2);

		$data['data'] = $this->cattle_model->with_kategori()->get($id);
		$data['data_investor'] = $this->pemilikternak_model->where('id_ternak', $id)->with_user()->get_all();

		$query = $this->db->get_where('t_foto_ternak', array('id_ternak' => $id));
		$data['foto']  = $query->result();
		// dump($data['foto']['0']);
		// dump($data['data_investor']);

		$this->render('admin/cattle/view', $data);
	}

	function upload_foto(){
		$set_name   = fileName(1, 'CAT','',8);
		$path       = $_FILES['foto']['name'];
		$extension  = ".".pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path']   = './uploads/cattle/img/';
		$config['allowed_types'] = 'gif|jpg|png|ico|jpeg';
		$config['file_name']     = $set_name.$extension;
		$this->load->library('upload',$config);

		if($this->upload->do_upload('foto')){
			$token=$this->input->post('token_foto');
			$nama=$this->upload->data('file_name');
			$this->db->insert('t_foto_ternak',array('nama_foto'=>$nama,'token'=>$token));
		}
	}

	function list_foto($id)
	{
		$query = $this->db->get_where('t_foto_ternak', array('id_ternak' => $id));
		$data  = $query->result();
		$output ='';
		foreach ($data as $value) {
			$output .=
			'<div class="col-sm-12 col-md-4" style="display: flex;">
			<div class="thumbnail">
			<img src="'.base_url('uploads/cattle/img/'.$value->nama_foto).'" alt="...">
			<div class="caption" style="margin-bottom: 0px">
			<p align="right" style="margin-bottom: 0px"><a id="delete_foto" class="btn btn-warning" role="button" data-id="'.$value->token.'"><i class="fa fa-trash"></i> Hapus</a></p>
			</div>
			</div>
			</div> ';
		}
		echo $output;
	}

	function remove_foto(){
		//Ambil token foto
		$token = $this->input->post('token');
		$foto  = $this->db->get_where('t_foto_ternak',array('token'=>$token));

		if($foto->num_rows()>0){
			$hasil=$foto->row();
			$nama_foto=$hasil->nama_foto;
			if(file_exists($file='./uploads/cattle/img/coba/'.$nama_foto)){
				unlink($file);
			}
			$this->db->delete('t_foto_ternak',array('token'=>$token));

		}
		echo "{}";
		}
	}
