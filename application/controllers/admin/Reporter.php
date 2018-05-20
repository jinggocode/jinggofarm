<?php

/**
 *
 */
class Reporter extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump', 'utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/reporter_model');
		$this->load->model('admin/cattle_model');
		$this->load->model('admin/finance_model');
		$this->load->model('admin/category_cattle_model');
		$this->load->model('admin/pemilikternak_model');
		$this->load->model('admin/saldo_investor_model');
		$this->load->model('admin/saldo_kt_model');
		$this->load->model('token_user_model');
		$this->slug_config($this->reporter_model->table, 'nama');
		// $this->load->helper('utility');
	}

	public function index()
	{
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/reporter/index/';

		/*Class bootstrap pagination yang digunakan*/
		$config['full_tag_open'] = "<ul class='pagination' style='position:relative; top:-25px;'>";
		$config['full_tag_close'] = "</ul>";
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

		$data = $this->cattle_model
			->with_kategori()
			->where('status', '2')
			->limit($config['per_page'], $offset = $start)
			->get_all();
		$config['total_rows'] = $this->cattle_model
			->where('status', '2')
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
		$this->render('admin/reporter/index', $data);
	}
	public function search()
	{
		$search_data = $this->input->get();

		$data = $this->reporter_model->search($search_data);

		$this->generateCsrf();
		$this->render('admin/reporter/index', $data);
	}

	public function add_grow_report($id)
	{
		$data['page'] = $this->uri->segment(2);
		$data['data'] = $this->cattle_model->get($id);
		// dump($data);

		$this->generateCsrf();
		$this->render('admin/reporter/grow/add', $data);
	}
	public function save_grow_report($id)
	{
		$this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[2]');

		if ($this->form_validation->run() == false) {
			$data['page'] = $this->uri->segment(2);
			$data['data'] = $this->cattle_model->get($id);

			$this->generateCsrf();
			// BENAKNE LINK RENDER
			$this->render('admin/reporter/grow/add', $data);
		} else {
			$data = $this->input->post(); 

			$ternak = $this->cattle_model->get($data['id_ternak']);
			$pemilik_ternak = $this->pemilikternak_model->where('id_ternak', $data['id_ternak'])->get_all();

			if (!empty($_FILES['foto']['name'])) {
				$foto_name = $this->upload_foto();
				$data['foto'] = $foto_name;
			}
			$insert = $this->reporter_model->insert($data);

			// memasukkan id ternak ke tabel foto
			$value['id_laporanternak'] = $insert;
			$this->db->where('id_laporanternak', null);
			$this->db->update('t_foto_laporan', $value);
 
			// kirim notifikasi 
			foreach ($pemilik_ternak as $key) {
				$token = $this->token_user_model->where('id_users', $key->id_user)->get_all();
				foreach ($token as $value) {
					$this->reporter_model->send_notif_grow($value->token, $ternak->id, $ternak->slug);
				}
			}

			if ($insert === false) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("admin/reporter");
			} else {
				$this->message('Data Perkembangan berhasi di Simpan!', 'success');
				// BENAKNE LINK REDIRECT E COYYY
				$this->go("admin/reporter/view/" . $id);
			}
		}
	}

	public function edit_grow_report($id)
	{
		$data['page'] = $this->uri->segment(2);
		$data['data'] = $this->reporter_model->with_ternak()->get($id);

		$this->generateCsrf();
		$this->render('admin/reporter/grow/edit', $data);
	}
	public function update_grow_report($id)
	{
		$this->form_validation->set_rules('jenis_laporan', 'Jenis Laporan', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
		$data = $this->input->post();

		if ($this->form_validation->run() == false) {
			$data['page'] = $this->uri->segment(2);

			$data['data'] = (object)$data;

			$this->generateCsrf();
			$this->render('admin/reporter/grow/edit/', $data);
		} else {
			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name = $this->upload_foto();
				$data['foto'] = $file_name;
			}

			$update = $this->reporter_model->update($data, $this->input->post('id'));

			// memasukkan id ternak ke tabel foto
			$value['id_laporanternak'] = $this->input->post('id');
			$this->db->where('id_laporanternak', null);
			$this->db->update('t_foto_laporan', $value);

			if ($update === false) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("admin/reporter");
			} else {
				$this->message('Data Berhasil di Ubah!', 'success');
				$this->go("admin/reporter/view/" . $this->input->post('id_ternak'));
			}
		}
	}

	public function add_financial_report($id)
	{
		$data['page'] = $this->uri->segment(2);
		$data['data'] = $this->cattle_model->get($id);
		// dump($data);

		$this->generateCsrf();
		$this->render('admin/reporter/financial/add', $data);
	}
	public function save_financial_report($id)
	{
		$this->form_validation->set_rules('jenis', 'Jenis Keuntungan', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|max_length[9]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[2]');

		if ($this->form_validation->run() == false) {
			$data['page'] = $this->uri->segment(2);
			$data['data'] = $this->cattle_model->get($id);

			$this->generateCsrf();
			// BENAKNE LINK RENDER
			$this->render('admin/reporter/financial/add', $data);
		} else {
			$data = $this->input->post();
			$ternak = $this->cattle_model->get($id);
			$pemilik_ternak = $this->pemilikternak_model->where('id_ternak', $id)->get_all();

			$jumlah_hari_ternak = jumlah_hari_ternak($ternak->tanggal_ternak);

			$is_operasional = $this->input->post('operasional');
			$profit_bersih = (int)str_replace(".", "", $this->input->post('jumlah'));
			$biaya_operasional = (int)$ternak->biaya_operasional;

			$bghasil_peternak = (int)$ternak->bghasil_peternak;
			$bghasil_investor = (int)$ternak->bghasil_investor;

			if ($is_operasional == '1') {
				$profit_bersih = $profit_bersih - $ternak->biaya_operasional;
			}

			if (!empty($_FILES['foto']['name'])) {
				$foto_name = $this->upload_foto();
				$data['foto'] = $foto_name;
			}
			$data['jumlah'] = $profit_bersih;
			$insert_keuangan = $this->finance_model->insert($data);

			if ($this->input->post('jenis') == '0') {
				$saldo_investor = ($profit_bersih / 100) * $bghasil_peternak;
				$saldo_peternak = ($profit_bersih / 100) * $bghasil_investor;

				$saldo_investor = $saldo_investor / $ternak->jumlah_unit;

				if ($jumlah_hari_ternak > 365) {
					$data_saldo['periode'] = '2';
				} else if ($jumlah_hari_ternak > 730) {
					$data_saldo['periode'] = '3';
				} else if ($jumlah_hari_ternak > 1095) {
					$data_saldo['periode'] = '4';
				} else if ($jumlah_hari_ternak > 1460) {
					$data_saldo['periode'] = '5';
				} else {
					$data_saldo['periode'] = '1';
				}

				// NEXT: MEMASUKKAN DATA KE MASING2 TABEL
				foreach ($pemilik_ternak as $value) {
					$data_saldo['id_user'] = $value->id_user;
					$data_saldo['id_lap_keuangan'] = $insert_keuangan;
					$data_saldo['nominal'] = $saldo_investor * $value->jumlah;
					$data_saldo['deskripsi'] = $this->input->post('deskripsi');

					$insert_saldo_investor = $this->saldo_investor_model->insert($data_saldo, $value->id);
				}

				$data_saldo_investor['id_lap_keuangan'] = $insert_keuangan;
				$data_saldo_investor['nominal'] = $saldo_peternak;
				$data_saldo_investor['deskripsi'] = $this->input->post('deskripsi');
				$insert_saldo_peternak = $this->saldo_kt_model->insert($data_saldo, $value->id);
			}

			// kirim notifikasi 
			foreach ($pemilik_ternak as $key) {
				$token = $this->token_user_model->where('id_users', $key->id_user)->get_all();
				foreach ($token as $value) {
					$this->reporter_model->send_notif_finance($value->token, $ternak->id, $ternak->slug);
				}
			}
			if ($insert_keuangan === false) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("admin/reporter");
			} else {
				$this->message('Data Keuangan berhasil di Simpan!', 'success');
				$this->go("admin/reporter/view/" . $id);
			}
		}
	}

	public function edit_finance_report($id)
	{
		$data['page'] = $this->uri->segment(2);
		$data['data'] = $this->finance_model->with_ternak()->get($id);

		$this->generateCsrf();
		$this->render('admin/reporter/financial/edit', $data);
	}
	public function update_finance_report($id)
	{
		$this->form_validation->set_rules('jenis', 'Jenis Keuntungan', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|max_length[9]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|min_length[2]');
		$data = $this->input->post();

		if ($this->form_validation->run() == false) {
			$data['page'] = $this->uri->segment(2);

			$data['data'] = (object)$data;

			$this->generateCsrf();
			$this->render('admin/reporter/financial/edit/', $data);
		} else {
			if (!empty($_FILES['foto']['tmp_name'])) {
				$file_name = $this->upload_foto();
				$data['foto'] = $file_name;
			}

			$data['jumlah'] = str_replace(".", "", $this->input->post('jumlah'));
			$update = $this->finance_model->update($data, $this->input->post('id'));

			if ($update === false) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("admin/reporter");
			} else {
				$this->message('Data Keuangan Berhasil di Ubah!', 'success');
				$this->go("admin/reporter/view/" . $this->input->post('id_ternak'));
			}
		}
	}

	public function delete_grow_report($id, $id_ternak)
	{
		$this->reporter_model->delete($id);

		$this->message('Data Perkembangan Ternak Berhasil di Hapus!', 'success');
		$this->go('admin/reporter/view/' . $id_ternak);
	}

	public function delete_finance_report($id, $id_ternak)
	{
		$this->finance_model->delete($id);

		$this->message('Data Keuangan Berhasil di Hapus!', 'success');
		$this->go('admin/reporter/view/' . $id_ternak);
	}

	public function view($id)
	{
		$data['data_ternak'] = $this->cattle_model->get($id);
		$data['data_perkembangan'] = $this->reporter_model
			->where('id_ternak', $id)
			->where('jenis_laporan', '0')
			->get_all();
		$data['jumlah_perkembangan'] = $this->reporter_model
			->where('id_ternak', $id)
			->count_rows();
		$data['data_keuangan'] = $this->finance_model
			->where('id_ternak', $id)
			->get_all();
		$data['jumlah_keuangan'] = $this->finance_model
			->where('id_ternak', $id)
			->count_rows();

		$this->generateCsrf();
		$data['page'] = $this->uri->segment(2);
		$this->render('admin/reporter/view', $data);
	}

	public function detail_perkembangan($id)
	{
		$data = $this->reporter_model->get($id);
		$query = $this->db->get_where('t_foto_laporan', array('id_laporanternak' => $id));
		$foto = $query->result();

		if ($data->jenis_laporan === "0") {
			$output = '<span class="label label-warning">Perkembangan Ternak</span>';
		} else if ($data->jenis_laporan === "1") {
			$output = '<span class="label label-primary">Penggunaan Dana</span>';
		} else if ($data->jenis_laporan == "2") {
			$output = '<span class="label label-info">Penjualan Hasil</span>';
		};

		$output .= '
		<h5>' . dateFormatBulan(3, $data->created_at) . ' </h5>
		<p>' . $data->deskripsi . '</p>
		<div class="block-content-full">
		<div id="animation-carousel" class="carousel slide remove-margin" data-ride="carousel" data-interval="1500">
		<!-- Wrapper for slides -->
		<div class="carousel-inner">';
		foreach ($foto as $value) {
			$active = ($foto['0'] == $value) ? 'active' : '';
			$output .= '<div class="item ' . $active . '">
			<img src="' . base_url('uploads/reporter/' . $value->nama_foto) . '" alt="image">
			</div>';
		}
		$output .= '</div>
		<!-- END Wrapper for slides -->

		<!-- Controls -->
		<a class="left carousel-control" href="#animation-carousel" data-slide="prev">
		<span><i class="fa fa-chevron-left"></i></span>
		</a>
		<a class="right carousel-control" href="#animation-carousel" data-slide="next">
		<span><i class="fa fa-chevron-right"></i></span>
		</a>
		<!-- END Controls -->
		</div>
		</div>';
		echo $output;
	}

	function upload_foto()
	{
		$set_name = fileName(1, 'LAP', '', 8);
		$path = $_FILES['foto']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/reporter/';
		$config['allowed_types'] = 'gif|jpg|png|ico|jpeg';
		$config['file_name'] = $set_name . $extension;
		$config['max_size'] = 9024;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$token = $this->input->post('token_foto');
			$nama = $this->upload->data('file_name');
			$this->db->insert('t_foto_laporan', array('nama_foto' => $nama, 'token' => $token));
		}
	}

	function list_foto($id)
	{
		$query = $this->db->get_where('t_foto_laporan', array('id_laporanternak' => $id));
		$data = $query->result();
		$output = '';
		foreach ($data as $value) {
			$output .=
				'<div class="col-sm-4 col-md-4" style="display: flex;">
			<div class="thumbnail">
			<img src="' . base_url('uploads/reporter/' . $value->nama_foto) . '" alt="...">
			<div class="caption" style="margin-bottom: 0px">
			<p align="right" style="margin-bottom: 0px"><a id="delete_foto" class="btn btn-warning" role="button" data-id="' . $value->token . '"><i class="fa fa-trash"></i> Hapus</a></p>
			</div>
			</div>
			</div> ';
		}
		echo $output;
	}

	function remove_foto()
	{
		//Ambil token foto
		$token = $this->input->post('token');
		$foto = $this->db->get_where('t_foto_laporan', array('token' => $token));

		if ($foto->num_rows() > 0) {
			$hasil = $foto->row();
			$nama_foto = $hasil->nama_foto;
			if (file_exists($file = './uploads/reporter/' . $nama_foto)) {
				unlink($file);
			}
			$this->db->delete('t_foto_laporan', array('token' => $token));

		}
		echo "{}";
	}
}
