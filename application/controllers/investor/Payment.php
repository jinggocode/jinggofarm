<?php

/**
 *
 */
class Payment extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = true;
		$this->load->helper(array('dump'));
		$this->root_view = "investor/";
		$this->load->model('investor/cattle_model');
		$this->load->model('investor/transaction_model');
		$this->load->helper('utility');
	}

	public function process()
	{
		// ambil data user
		$user = $this->ion_auth->user()->row();

		if (!$this->ion_auth->logged_in()) {
			$data = $this->input->post();

			$this->session->set_userdata('sesi_pengunjung', $data);

			$this->message('Lakukan Pendaftaran terlebih dahulu sebelum berinvestasi', 'warning');
			// redirect them to the login page
			redirect('auth/create_user', 'refresh');
		} else {
			$transaction_check = $this->transaction_model->where('id_user', $user->id)->where('status', '0')->count_rows();
			if ($transaction_check == 1) {
				$this->message('Anda masih mempunyai transaksi yang belum diselesaikan', 'warning');
				$this->go("investor/home");
			}

		}
		if ($this->session->has_userdata('sesi_pengunjung')) {
			// apakah ada data baru yang dimasukkan?
			if (!empty($this->input->post())) {
				$data = $this->input->post();
			} else {
				$data = $this->session->userdata('sesi_pengunjung');
			}
		} else {
			$data = $this->input->post();
			if (empty($data)) {
				redirect('investor/cattle', 'refresh');
			}
		}

		// ambil data ternak sesuai yg dipilih
		$ternak = $this->cattle_model->where('slug', $data['slug'])->get();
		$biaya_per_unit = $ternak->biaya / $ternak->jumlah_unit;

		$data['id_user'] = $user->id;
		$data['id_ternak'] = $ternak->id;
		$data['kode_transaksi'] = $this->transaction_model->kode_transaksi();
		$data['total'] = $biaya_per_unit * $data['unit'];
		$data['batas_bayar'] = setTimeToPay();
		unset($data['slug']);

		$insert = $this->transaction_model->insert($data);

		if ($insert === false) {
			$this->message('Aksi Gagal', 'warning');

			$this->go("investor/payment/view/" . $data['kode_transaksi']);
		} else {
			$this->message('Segera lakukan pembayaran!', 'success');
			$this->go("investor/payment/view/" . $data['kode_transaksi']);
		}
	}

	public function view($kode)
	{
		$data['data'] = $this->transaction_model
			->where('kode_transaksi', $kode)
			->with_ternak('fields:nama,slug,status', array('with' => array('relation' => 'kategori', 'fields' => 'nama')))
			->get();
		if ($data['data']->status == '1' || $data['data']->status == '3' || $data['data']->status == '4' || $data['data']->status == '5') {
			$this->render('investor/payment/detail', $data);
		} else {
			// melakukan pengecekan apakah transaksi masih aktif
			$checkTime = $this->transaction_model->checkTime($data['data']->batas_bayar, $kode);

			$this->render('investor/payment/index', $data);
		}
	}

	public function confirm($kode)
	{
		$data['data'] = $this->transaction_model
			->where('kode_transaksi', $kode)
			->with_ternak()
			->get();

		// melakukan pengecekan apakah transaksi masih aktif
		$checkTime = $this->transaction_model->checkTime($data['data']->batas_bayar, $kode);

		$this->generateCsrf();
		$this->render('investor/payment/confirm', $data);
	}

	public function cancel($kode)
	{
		// ambil data transaksi sesuai yg dipilih
		$transaction = $this->transaction_model->where('kode_transaksi', $kode)->get();
		$this->transaction_model->update(array('status' => '2'), $transaction->id);

		$this->message('Transaksi berhasil dibatalkan!', 'success');

		$this->go('investor/transaction');
	}

	public function kirim_bukti()
	{
		$data = $this->input->post();
		$transaksi = $this->transaction_model->where('kode_transaksi', $data['kode_transaksi'])->get();

		if (!empty($_FILES['bukti_transfer']['tmp_name'])) {
			$foto_name = $this->upload_foto();
			$data['bukti_transfer'] = $foto_name;
		}
		$data['status'] = '1';

		$update = $this->transaction_model->update($data, $transaksi->id);

		if ($update === false) {
			$this->message('Aksi Gagal', 'warning');

			$this->go("admin/cattle");
		} else {
			$this->message('Bukti Berhasil dikirim!', 'success');
			$this->go("investor/home");
		}
	}

	function upload_foto()
	{
		$set_name = fileName(1, 'TF', '', 8);
		$path = $_FILES['bukti_transfer']['name'];
		$extension = "." . pathinfo($path, PATHINFO_EXTENSION);

		$config['upload_path'] = './uploads/bukti-transfer';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 9024;
		$config['file_name'] = $set_name . $extension;

		$this->load->library('upload', $config);
		// proses upload
		$upload = $this->upload->do_upload('bukti_transfer');

		if ($upload == false) {
			$error = array('error' => $this->upload->display_errors());
			dump($error);
			dump('Gambar gagal diupload! Periksa gambar');
		}

		$upload = $this->upload->data();

		return $upload['file_name'];
	}

	public function checking_transaction()
	{
		$transaksi = $this->transaction_model->where('status', '0')->get_all();

		foreach ($transaksi as $value) {
			$this->transaction_model->checkTime($value->batas_bayar, $value->kode_transaksi);
		}
	}
}
