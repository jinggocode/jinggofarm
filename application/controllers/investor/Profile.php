<?php

/**
*
*/
class Profile extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_accessable = TRUE;
		$this->load->helper(array('dump', 'utility'));
		$this->load->model(array('user_model'));
	}

	public function index()
	{
		$data['user'] = (object)$this->ion_auth->user()->row();

    $this->generateCsrf();
		$this->render('investor/profile/index', $data);
	}

	public function password()
	{
		$data['user'] = (object)$this->ion_auth->user()->row();

    $this->generateCsrf();
		$this->render('investor/profile/password', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim|required|min_length[2]|max_length[13]');
		$data = $this->input->post();

		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = (object)$data;

			$this->generateCsrf();
			$this->render('investor/profile/index', $data);
		} else {
			$update = $this->user_model->update($data, $this->input->post('id'));

			if ($update === FALSE) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("investor/profile");
			} else {
				$this->message('Data Profil Berhasil di Ubah!', 'success');
				$this->go("investor/profile");
			}
		}
	}

	public function change_password()
	{
		$this->form_validation->set_rules('password', 'Nama', 'trim|required|max_length[8]');
		$this->form_validation->set_rules('reenter_password', 'Nama', 'trim|required|max_length[8]|matches[password]');
		$data = $this->input->post();

		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = (object)$data;

			$this->generateCsrf();
			$this->render('investor/profile/password', $data);
		} else {
			$data['password'] 	= password_hash($data['password'], PASSWORD_BCRYPT);
			
			$update = $this->user_model->update($data, $this->input->post('id'));

			if ($update === FALSE) {
				$this->message('Aksi Gagal', 'warning');

				$this->go("investor/profile/password");
			} else {
				$this->message('Password Berhasil di Ubah!', 'success');
				$this->go("investor/profile/password");
			}
		}
	}

}
