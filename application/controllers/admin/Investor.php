<?php

/**
*
*/
class Investor extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->_accessable = TRUE;
    $this->load->helper(array('dump','utility'));
    $this->load->model('admin/investor_model');
    $this->load->model('investor/transaction_model');

    // $this->load->helper('utility');
  }

  public function index()
  {
    $start = $this->uri->segment(4, 0);
    $config['base_url'] = base_url() . 'admin/investor/index/';

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

    $data = $this->investor_model
    ->where('group_id', '3')
    ->limit($config['per_page'],$offset=$start)
    ->order_by('created_at', 'DESC')
    ->get_all();
    $config['total_rows'] = $this->investor_model
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
    $this->render('admin/investor/index', $data);
  }
  public function search()
  {
    $search_data = $this->input->get();

    $data = $this->investor_model->search($search_data);

    $this->generateCsrf();
    $this->render('admin/investor/index', $data);
  }

  public function edit($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->investor_model->get($id);

    $this->generateCsrf();
    $this->render('admin/investor/edit', $data);
  }
  public function update()
  {
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('reenter_password', 'Konfirmasi Password', 'trim|matches[password]');

    $data = $this->input->post();

    if ($this->form_validation->run() == FALSE)
    {
      $data['page'] = $this->uri->segment(2);

      $data['data'] = (object)$data;

      $this->generateCsrf();
      $this->render('admin/investor/edit', $data);
    } else {
      if (! empty($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
      } else {
        unset($data['password']);
      }
      $data['ip_address'] = $this->input->ip_address();

      $update = $this->investor_model->update($data, $this->input->post('id'));

      if ($update === FALSE) {
        $this->message('Aksi Gagal', 'warning');

        $this->go("admin/investor");
      } else {
        $this->message('Data Berhasil di Ubah!', 'success');
        $this->go("admin/investor");
      }
    }
  }

  public function delete($id)
  {
    $this->investor_model->delete($id);

    $this->message('Data Berhasil di Hapus!', 'success');
    $this->go('admin/investor');
  }

  public function view($id)
  {
    $data['page'] = $this->uri->segment(2);

    $data['data'] = $this->investor_model->get($id);
    $data['investasi'] = $this->transaction_model
      ->with_ternak(array('with'=>array('relation'=>'kategori','fields'=>'nama')))
      ->where('id_user', $id)
      ->where('status', '3')
      ->get_all();

    $this->render('admin/investor/view', $data);
  }

  function upload_foto(){
    $set_name   = fileName(1, 'CAT','',8);
    $path       = $_FILES['foto']['name'];
    $extension  = ".".pathinfo($path, PATHINFO_EXTENSION);

    $config['upload_path']   = './uploads/investor/img/';
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
      <img src="'.base_url('uploads/investor/img/'.$value->nama_foto).'" alt="...">
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
      if(file_exists($file='./uploads/investor/img/coba/'.$nama_foto)){
        unlink($file);
      }
      $this->db->delete('t_foto_ternak',array('token'=>$token));

    }
    echo "{}";
    }
  }
