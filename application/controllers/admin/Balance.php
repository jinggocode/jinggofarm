<?php

/**
 *
 */
class Balance extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->_accessable = true;
    $this->load->helper(array('dump', 'utility'));
    $this->load->model('admin/saldo_kt_model');

    // $this->load->helper('utility');
  }

  public function index()
  {
    $start = $this->uri->segment(4, 0);
    $config['base_url'] = base_url() . 'admin/balance/index/';

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

    $data = $this->saldo_kt_model
      ->limit($config['per_page'], $offset = $start)
      ->order_by('created_at', 'DESC')
      ->get_all();
    $config['total_rows'] = $this->saldo_kt_model
      ->count_rows();

    $total_saldo = $this->saldo_kt_model->total_saldo();

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'data' => $data,
      'total_saldo' => $total_saldo,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'page' => $this->uri->segment(2),
    );

    $this->generateCsrf();
    $this->render('admin/balance/index', $data);
  }
  public function search()
  {
    $search_data = $this->input->get();

    $data = $this->saldo_kt_model->search($search_data);

    $this->generateCsrf();
    $this->render('admin/balance/index', $data);
  }

  public function add()
  {
    $data['page'] = $this->uri->segment(2);

    $this->generateCsrf();
    $this->render('admin/balance/add', $data);
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
    $this->form_validation->set_rules('bghasil_balance', 'Bagi Hasil Investor', 'trim|required|max_length[4]');

    if ($this->form_validation->run() == false) {
      $data['page'] = $this->uri->segment(2);

      $this->generateCsrf();
      $this->render('admin/balance/add', $data);
    } else {
      $data = $this->input->post();

      if (!empty($_FILES['foto']['tmp_name'])) {
        $foto_name = $this->upload_foto();
        $data['foto'] = $foto_name;
      }
      $data['hak_akses'] = '1';

      $data['slug'] = $this->slug->create_uri($data);
      $data['kode_ternak'] = $this->saldo_kt_model->kode_ternak();
      $data['sisa_unit'] = $this->input->post('jumlah_unit');
      $data['biaya'] = str_replace(".", "", $this->input->post('biaya'));
      $data['biaya_operasional'] = str_replace(".", "", $this->input->post('biaya_operasional'));

      $insert = $this->saldo_kt_model->insert($data);

      // memasukkan id ternak ke tabel foto
      $value['id_ternak'] = $insert;
      $this->db->where('id_ternak', null);
      $this->db->update('t_foto_ternak', $value);

      if ($insert === false) {
        $this->message('Aksi Gagal', 'warning');

        $this->go("admin/balance");
      } else {
        $this->message('Data berhasi di Simpan!', 'success');
        $this->go("admin/balance");
      }
    }
  }

  public function edit($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->saldo_kt_model->get($id);

    $this->generateCsrf();
    $this->render('admin/balance/edit', $data);
  }
  public function update()
  {
    $this->form_validation->set_rules('first_name', 'Nama', 'trim|required|max_length[20]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[20]');
    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]');
    $this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|matches[password]');

    $data = $this->input->post();

    if ($this->form_validation->run() == false) {
      $data['page'] = $this->uri->segment(2);

      $data['data'] = (object)$data;

      $this->generateCsrf();
      $this->render('admin/balance/edit', $data);
    } else {
      if (!empty($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
      } else {
        unset($data['password']);
      }
      $data['ip_address'] = $this->input->ip_address();

      $update = $this->saldo_kt_model->update($data, $this->input->post('id'));

      if ($update === false) {
        $this->message('Aksi Gagal', 'warning');

        $this->go("admin/balance");
      } else {
        $this->message('Data Berhasil di Ubah!', 'success');
        $this->go("admin/balance");
      }
    }
  }

  public function ubah_status()
  {
    $data = $this->input->post();
    if ($this->input->post('status') == '2') {
      $tgl_now = date('Y-m-d');
      $data['tanggal_ternak'] = date('Y-m-d');
      $data['batas_periode'] = date('Y-m-d', strtotime('+4 years', strtotime($tgl1)));
    }
    $update = $this->saldo_kt_model->update($data, $this->input->post('id'));

    if ($update === false) {
      $this->message('Aksi Gagal', 'warning');

      $this->go("admin/balance");
    } else {
      $this->message('Status telah di Ubah!', 'success');
      $this->go("admin/balance");
    }
  }

  public function delete($id)
  {
    $this->saldo_kt_model->delete($id);

    $this->message('Data Berhasil di Hapus!', 'success');
    $this->go('admin/balance');
  }

  public function view($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->saldo_kt_model->get($id);
    $data['investasi'] = $this->transaction_model
      ->with_ternak(array('with' => array('relation' => 'kategori', 'fields' => 'nama')))
      ->where('id_user', $id)
      ->get_all();

    $this->render('admin/balance/view', $data);
  }
}
