<?php

/**
*
*/
class Home extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->load->model(array('cattle_model','investor/transaction_model','investor/pemilikternak_model','balance_investor_model', 'token_user_model'));
	}

	public function index()
	{
		// $checkTime = $this->transaction_model->checkTime($data['data']->batas_bayar, $kode);

		$user 			   = $this->ion_auth->user()->row();
		$data['nama_user'] = $user->first_name;
		// PR = dikasih paginasi
		$data['ternak']    = $this->cattle_model
		->with_kategori()
		->with_foto()
		->where('status', '0')
		->order_by('nama', 'DESC')
		->get_all();

		$transaction_check = $this->transaction_model
		->where('id_user', $user->id)
		->where('status', '0')
		->count_rows();
		if ($transaction_check == 1) {
			$data['transaksi'] = $this->transaction_model
			->where('id_user',$user->id)
			->where('status', '0')
			->with_ternak('fields:nama,slug,status', array('with'=>array('relation'=>'kategori','fields'=>'nama')))
			->get();
			$checkTime = $this->transaction_model->checkTime($data['transaksi']->batas_bayar, $data['transaksi']->kode_transaksi);
		}

		$data['jumlah_ternak'] = $this->pemilikternak_model->where('id_user', $user->id)->where('status', '0')->count_rows();


		$saldo_ambil = $this->balance_investor_model->getJumlahSaldoAmbil($user->id);
		$saldo_tahan = $this->balance_investor_model->getJumlahSaldoTahan($user->id);
		$data['saldo'] = $saldo_ambil + $saldo_tahan;
		// dump($data['jumlah_ternak']);

		$data['info_akun'] = $user->activate_akun;  

		$this->render('investor/home', $data);
	}
 
	public function store_token()
	{
		$user 			   = $this->ion_auth->user()->row();

		$data['id_users'] = $user->id;
		$data['token'] 		= $this->input->post('token');
		$this->token_user_model->insert($data);
	}

}
