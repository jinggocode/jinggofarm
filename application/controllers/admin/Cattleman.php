<?php

/**
*
*/
class Cattleman extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/cattleman_model');
		$this->load->model('admin/category_cattleman_model');
		// $this->load->helper('utility');
	}

	public function index()
	{
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/cattleman/index/';

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

		$data = $this->cattleman_model
		->with_kategori()
		->limit($config['per_page'],$offset=$start)
		->get_all();
		$config['total_rows'] = $this->cattleman_model
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
		$this->render('admin/cattleman/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->cattleman_model->search($search_data);

		$this->generateCsrf();
		$data['page'] = $this->uri->segment(2);
		$this->render('admin/cattleman/index', $data);
	}
	public function add()
	{
		$data['page'] = $this->uri->segment(2);
		$data['category'] = $this->category_cattleman_model->get_all();

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
			$data['category'] = $this->category_cattleman_model->get_all();

			$this->generateCsrf();
			$this->render('admin/cattleman/add', $data);
		} else {
			$data = $this->input->post();

			if (!empty($_FILES['foto']['tmp_name'])) {
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
		$data['category'] = $this->category_cattleman_model->get_all();

		$this->generateCsrf();
		$this->render('admin/cattleman/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama Peternak', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('umur', 'Umur', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('lama_pengalaman', 'Pengalaman', 'trim|required|max_length[2]');

		$data = $this->input->post();

		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->uri->segment(2);

			$data['data'] = (object)$data;
			$data['category'] = $this->category_cattleman_model->get_all();

			$this->generateCsrf();
			$this->render('admin/cattleman/edit', $data);
		} else {
			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name    = $this->upload_foto();
				$data['foto'] = $file_name;
			}

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
