<?php

/**
*
*/
class Mycattle extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump','utility'));
		$this->root_view = "investor/";
		$this->load->model('investor/pemilikternak_model');
		$this->load->model('investor/user_model');
		$this->load->model('investor/cattle_model');
		$this->load->model('investor/reporter_model');
		$this->load->model('investor/finance_model');
		$this->load->helper('utility');
	}

	public function index()
	{
        $filter = $this->session->userdata('filter_mycattle');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('per_page'));

        // dump($start);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'investor/mycattle/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'investor/mycattle/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'investor/mycattle/';
            $config['first_url'] = base_url() . 'investor/mycattle/';
        }

		/*Class bootstrap pagination yang digunakan*/
		$config['first_link']       = 'Awal';
		$config['last_link']        = 'Akhir';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Sebelumnya';
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

        $config['per_page'] = 7;
        $config['page_query_string'] = TRUE;

        $user = $this->ion_auth->user()->row();

		$data = $this->pemilikternak_model
			->with_ternak('fields:nama,slug,status,kode_ternak', array('with'=>array('relation'=>'kategori','fields'=>'nama')))
            ->where($filter, 'like', '%')
			->limit($config['per_page'],$offset=$start)
			->order_by('created_at', 'DESC')
			->where('id_user', $user->id)
			->get_all();
		// dump($data);

    	$total_cari = $this->pemilikternak_model
            ->where($filter, 'like', '%')
			->count_rows();
   	 	$config['total_rows'] = $this->pemilikternak_model
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
            'page' => $this->uri->segment(2),
        );

        $this->generateCsrf();
		$this->render('investor/mycattle/index', $data);
	}

	public function view($id = NUlL, $slug)
	{
		if (empty($id)) {
			show_404();
		}

		$data = $this->pemilikternak_model
			->where('id_ternak',$id)
			->with_ternak(array('with'=>array('relation'=>'kategori','fields'=>'nama')))
			->get(); 

		$data_laporan_perkembangan = $this->reporter_model
			->where('id_ternak', $id)
			->order_by('created_at','desc')
			->get_all();
		$data_laporan_keuangan = $this->finance_model
			->where('id_ternak', $id)
			->order_by('created_at','desc')
			->get_all();

        $data = array(
        	'data' => $data,
        	'data_laporan_perkembangan' => $data_laporan_perkembangan,
        	'data_laporan_keuangan' => $data_laporan_keuangan,
            'page' => $this->uri->segment(2),
        );

		$this->render('investor/mycattle/view', $data);
	}

	function detail_perkembangan($id)
	{
		$data = $this->reporter_model->get($id);

    	$query = $this->db->get_where('t_foto_laporan', array('id_laporanternak' => $id));
		$foto  = $query->result();

		if ($data->jenis_laporan==="0") {
			$output = '<span class="badge badge-warning">Perkembangan Ternak</span>';
		} else if ($data->jenis_laporan==="1") {
			$output = '<span class="badge badge-primary">Penggunaan Dana</span>';
		} else if ($data->jenis_laporan=="2") {
			$output = '<span class="badge badge-info">Penjualan Hasil</span>';
		}

		$output .=
			'<h4>'.dateFormatBulan(3, $data->created_at).'</h4>
	        <p>'.$data->deskripsi.'</p>
	        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      			<div class="carousel-inner">';

        foreach ($foto as $value) {
        	$active = ($foto['0'] == $value)?'active':'';
    		$output .= '<div class="carousel-item '.$active.'">
                            <img class="d-block w-100" src="'.base_url('uploads/reporter/'.$value->nama_foto).'" alt="image">
                        </div>';
        }
        $output .=
	        '</div>
	          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	            <span class="sr-only">Previous</span>
	          </a>
	          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	            <span class="carousel-control-next-icon" aria-hidden="true"></span>
	            <span class="sr-only">Next</span>
	          </a>
	        </div>';
	    echo $output;
	}

}
