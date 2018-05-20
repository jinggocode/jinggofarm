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
		$this->load->helper(array('dump','utility'));
		$this->root_view = "admin/";
		$this->load->model('admin/cattle_model');
		$this->load->model('admin/transaction_model');
		$this->load->model('admin/pemilikternak_model');
		$this->slug_config($this->transaction_model->table, 'nama');
		// $this->load->helper('utility');
	}

	public function index()
	{
		$filter = $this->session->userdata('filter_transaction');
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('per_page'));
		// dump($start);
		if ($q <> '') {
			$config['base_url'] = base_url() . 'transaction/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'transaction/?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . 'transaction/';
			$config['first_url'] = base_url() . 'transaction/';
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

		$data = $this->transaction_model
		->where($filter, 'like', '%')
		->limit($config['per_page'],$offset=$start)
		->where('status', '1')
		->order_by('created_at', 'DESC')
		->get_all();

		$total_cari = $this->transaction_model
		->where($filter, 'like', '%')
		->count_rows();
		$config['total_rows'] = $this->transaction_model
		->where('status', '1')
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
		$this->render('admin/transaction/index', $data);
	}
	public function search()
	{
		$data = $this->input->post();
		$this->session->unset_userdata('filter_transaction');
		$this->session->set_userdata('filter_transaction', $data);

		$this->go('admin/transaction');
	}
	public function refresh()
	{
		$this->session->unset_userdata(array('filter_transaction'));
		$this->go('admin/transaction');
	}

	public function valid($id)
	{
		$transaksi = $this->transaction_model->get($id);
		$ternak    = $this->cattle_model->get($transaksi->id_ternak);

		// mengubah status pada data transaksi
		$data['status'] = '3';
		$update = $this->transaction_model->update($data, $id);

		// mengubah stok paket(unit) pada tabel ternak,
		$stok_unit['sisa_unit'] = ($ternak->sisa_unit-$transaksi->unit);
		$update_stok 		    = $this->cattle_model->update($stok_unit, $transaksi->id_ternak);
		// jika sisa unit 0, maka status ternak berubah
		if ($stok_unit['sisa_unit'] == 0) {
			// status ternak berubah
			$status_ternak['status'] = '1';
			$update_status_ternak = $this->cattle_model->update($status_ternak, $transaksi->id_ternak);
		}

		// memasukkan input data pemilik ternak pada t_pemilikternak
		$value['id_ternak'] = $transaksi->id_ternak;
		$value['id_user']   = $transaksi->id_user;
		$value['jumlah']    = $transaksi->unit;
		$insert = $this->pemilikternak_model->insert($value);

		if ($update === FALSE) {
			$this->message('Aksi Gagal', 'warning');
			$this->go("admin/transaction");
		} else {
			$this->message('Berhasil di validasi!', 'success');
			$this->go("admin/transaction");
		}
	}

	public function unvalid()
	{
		$data['status'] = $this->input->post('status');
		$update = $this->transaction_model->update($data, $this->input->post('id'));

		if ($update === FALSE) {
			$this->message('Aksi Gagal', 'warning');

			$this->go("admin/transaction");
		} else {
			$this->message('Berhasil di validasi!', 'success');
			$this->go("admin/transaction");
		}
	}

	public function unconfirm($id)
	{
		$data['status'] = '1';
		$update = $this->transaction_model->update($data, $id);

		if ($update === FALSE) {
			$this->message('Aksi Gagal', 'warning');

			$this->go("admin/transaction");
		} else {
			$this->message('Berhasil di Batalkan Validasinya', 'success');
			$this->go("admin/transaction");
		}
	}

	public function history()
	{
		$filter = $this->session->userdata('filter_history');
		$q = urldecode($this->input->get('q', TRUE));
		$start = intval($this->input->get('per_page'));
		// dump($start);
		if ($q <> '') {
			$config['base_url'] = base_url() . 'admin/transaction/history/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'admin/transaction/history/?q=' . urlencode($q);
		} else {
			$config['base_url'] = base_url() . 'admin/transaction/history/';
			$config['first_url'] = base_url() . 'admin/transaction/history/';
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

		$config['per_page'] = 4;
		$config['page_query_string'] = TRUE;

		$data = $this->transaction_model
		->where($filter, 'like', '%')
		->limit($config['per_page'],$offset=$start)
		->with_ternak(array('with'=>array('relation'=>'kategori','fields'=>'nama'))) 
		->order_by('created_at', 'DESC')
		->get_all();

		$total_cari = $this->transaction_model
		->where($filter, 'like', '%')
		->count_rows();
		$config['total_rows'] = $this->transaction_model
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
		$this->render('admin/transaction/history', $data);
	}
	public function search_history()
	{
		$data = $this->input->post();
		$this->session->unset_userdata('filter_history');
		$this->session->set_userdata('filter_history', $data);

		$this->go('admin/transaction/history');
	}
	public function refresh_history()
	{
		$this->session->unset_userdata(array('filter_history'));
		$this->go('admin/transaction/history');
	}

	public function view($id)
	{
		$data['page'] = $this->uri->segment(2);

		$data['data'] = $this->transaction_model->get($id);

		$this->generateCsrf();
		$this->render('admin/transaction/view', $data);
	}
}
