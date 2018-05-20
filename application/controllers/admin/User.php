<?php

/**
*
*/
class User extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->_accessable = TRUE;
    $this->load->helper(array('dump','utility'));
    $this->load->model('admin/user_model');
    $this->load->model('admin/transaction_model');

    // $this->load->helper('utility');
  }

  public function index()
  {
    $start = $this->uri->segment(4, 0);
    $config['base_url'] = base_url() . 'admin/user/index/';

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

    $data = $this->user_model
    ->where('group_id !=', '3')
    ->limit($config['per_page'],$offset=$start)
    ->order_by('created_at', 'DESC')
    ->get_all();
    $config['total_rows'] = $this->user_model
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
    $this->render('admin/user/index', $data);
  }
  public function search()
  {
    $search_data = $this->input->get();

    $data = $this->user_model->search($search_data);

    $this->generateCsrf();
    $this->render('admin/user/index', $data);
  }

  public function add()
  {
    $data['page'] = $this->uri->segment(2);

    $this->generateCsrf();
    $this->render('admin/user/add', $data);
  }
  public function save()
  {
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|is_unique[users.email]',
        array(
                'required'      => 'Harus di isi',
                'is_unique'     => 'Email '.$this->input->post('email').' sudah ada'
        ));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'trim|required|matches[password]');

    if ($this->form_validation->run() == FALSE)
    {
      $data['page'] = $this->uri->segment(2);

      $this->generateCsrf();
      $this->render('admin/user/add', $data);
    } else {
			$data = $this->input->post();

			$data['password'] 	= password_hash($data['password'], PASSWORD_BCRYPT);
			$data['ip_address'] = $this->input->ip_address();
			$data['group_id'] 	= '1';

			$insert = $this->user_model->insert($data);
      if ($insert === FALSE) {
        $this->message('Aksi Gagal', 'warning');

        $this->go("admin/user");
      } else {
        $this->message('Data berhasi di Simpan!', 'success');
        $this->go("admin/user");
      }
    }
  }

  public function edit($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->user_model->get($id);

    $this->generateCsrf();
    $this->render('admin/user/edit', $data);
  }
  public function update()
  {
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'trim|matches[password]');

    $data = $this->input->post();

    if ($this->form_validation->run() == FALSE)
    {
      $data['page'] = $this->uri->segment(2);

      $data['data'] = (object)$data;

      $this->generateCsrf();
      $this->render('admin/user/edit', $data);
    } else {
			$data 				= $this->input->post();

	        if (! empty($data['password'])) {
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			} else {
				unset($data['password']);
			}
			$data['ip_address'] = $this->input->ip_address();

			$update = $this->user_model->update($data, $this->input->post('id'));
      if ($update === FALSE) {
        $this->message('Aksi Gagal', 'warning');

        $this->go("admin/user");
      } else {
        $this->message('Data Berhasil di Ubah!', 'success');
        $this->go("admin/user");
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
    $update = $this->user_model->update($data, $this->input->post('id'));

    if ($update === FALSE) {
      $this->message('Aksi Gagal', 'warning');

      $this->go("admin/user");
    } else {
      $this->message('Status telah di Ubah!', 'success');
      $this->go("admin/user");
    }
  }

  public function delete($id)
  {
    $this->user_model->delete($id);

    $this->message('Data Berhasil di Hapus!', 'success');
    $this->go('admin/user');
  }

  public function view($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->user_model->get($id);
    $data['investasi'] = $this->transaction_model
      ->with_ternak(array('with'=>array('relation'=>'kategori','fields'=>'nama')))
      ->where('id_user', $id)
      ->get_all();

    $this->render('admin/user/view', $data);
  }
}
