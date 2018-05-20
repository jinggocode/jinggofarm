<?php

use phpDocumentor\Reflection\Types\This;

/**
*
*/
class Balance extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump', 'utility'));
		$this->load->model(array('balance_investor_model'));
		$this->load->model('investor/finance_model');
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();

		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'investor/balance/index/';

		/*Class bootstrap pagination yang digunakan*/
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
		$config['per_page'] = 10;

		$data = $this->balance_investor_model
		->where('id_user', $user->id)
		->where('status', '0')
		->with_lap_keuangan(array('with'=>array('relation'=>'ternak')))
		->limit($config['per_page'],$offset=$start)
		->order_by('created_at', 'DESC')
		->get_all();

		foreach ($data as $key) { 
			$jumlah_hari_ternak = jumlah_hari_ternak($key->lap_keuangan->ternak->tanggal_ternak); 
			if ($jumlah_hari_ternak > 365) {
				$value['status_ambil'] = '1';
				$this->balance_investor_model->update($value, array('id_lap_keuangan'=> $key->lap_keuangan->id));  
			} else if ($jumlah_hari_ternak > 730) {
				$value['status_ambil'] = '1';
				$this->balance_investor_model->update($value, array('id_lap_keuangan'=> $key->lap_keuangan->id));  
			} else if ($jumlah_hari_ternak > 1095) {
				$value['status_ambil'] = '1';
				$this->balance_investor_model->update($value, array('id_lap_keuangan'=> $key->lap_keuangan->id));  
			} else if ($jumlah_hari_ternak > 1460) {
				$value['status_ambil'] = '1';
				$this->balance_investor_model->update($value, array('id_lap_keuangan'=> $key->lap_keuangan->id));  
			}  
		}
		
		$config['total_rows'] = $this->balance_investor_model
		->where('id_user', $user->id)
		->count_rows();

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'data' => $data,
			'saldo_ambil' => $this->balance_investor_model->getJumlahSaldoAmbil($user->id),
			'saldo_tahan' => $this->balance_investor_model->getJumlahSaldoTahan($user->id),
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);

		$this->generateCsrf();
		$this->render('investor/balance/index', $data);
	}

	public function pull_history()
	{
		$user = $this->ion_auth->user()->row();

		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'investor/balance/index/';

		/*Class bootstrap pagination yang digunakan*/
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
		$config['per_page'] = 10;

		$data = $this->balance_investor_model
		->where('id_user', $user->id) 
		->where('status_tarik', '1')
		->limit($config['per_page'],$offset=$start)
		->order_by('created_at', 'DESC')
		->get_all(); 

		$config['total_rows'] = $this->balance_investor_model
		->where('id_user', $user->id)
		->count_rows();

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'data' => $data,
			'saldo_ambil' => $this->balance_investor_model->getJumlahSaldoAmbil($user->id),
			'saldo_tahan' => $this->balance_investor_model->getJumlahSaldoTahan($user->id),
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);

		$this->generateCsrf();
		$this->render('investor/balance/pull_history', $data);
	}

	public function pull()
	{
		$user = $this->ion_auth->user()->row();

		$data['id_user'] = $user->id;
		$data['deskripsi'] = 'Penarikan Saldo';
		$data['status_tarik'] = '1';
		$data['nominal'] = str_replace(".", "", $this->input->post('jumlah_tarik'));
		$data['status'] = '1';
		$this->balance_investor_model->insert($data);

		$this->message('Request penarikan dana berhasil!', 'success');
		$this->go('investor/balance/pull_history');
	}



	function detail_laporan($id)
	{
		$data = $this->finance_model
			->with_ternak('fields:nama', array('with'=>array('relation'=>'kategori','fields'=>'nama')))
      ->get($id);

		$output = '';
		$output .=
			'<b>'.dateFormatBulan(3, $data->created_at).'</b> <br>
			<h3>'.$data->ternak->kategori->nama.'</h3>';

		if ($data->jenis==="0") {
			$output .= '<span class="badge badge-primary">Penjualan Hasil</span>';
		} else if ($data->jenis==="1") {
			$output .= '<span class="badge badge-primary">Penggunaan Dana</span>';
		}

		$output .=
			'<p>'.$data->deskripsi.'</p>
			<span>Jumlah <strong>'.money($data->jumlah).'</strong></span>';

		echo $output;
	}

}
