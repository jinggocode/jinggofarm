<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reporter_model extends MY_Model
{
	public function __construct()
	{
		$this->table = 't_laporanternak';
		$this->primary_key = 'id';
		$this->protected = array('id');

		$this->has_one['ternak'] = array('Cattle_model', 'id', 'id_ternak');

		parent::__construct();
	}

	public function search($search_data)
	{
		$start = $this->uri->segment(4, 0);
		$config['base_url'] = base_url() . 'admin/reporter/search/';
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

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

		if ($search_data['keyword'] == "") {
			$data = $this->cattle_model
			->with_kategori()
			->where('status', '2')
			->limit($config['per_page'],$offset=$start)
			->get_all();
			$config['total_rows'] = $this->cattle_model
			->count_rows();
		} else {
			$data = $this->cattle_model
			->with_kategori()
			->where('status', '2')
			->limit($config['per_page'],$offset=$start)
			->where('kode_ternak', 'like', $search_data['keyword'])
			->get_all();
			$config['total_rows'] = $this->cattle_model
			->where('kode_ternak', 'like', $search_data['keyword'])
			->count_rows();
		}

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'data' => $data,
			'search_data' => $search_data,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			'page' => $this->uri->segment(2),
		);
		return $data;
	}
	
	public function send_notif_grow($token, $id_ternak, $slug)
	{
		$data = array("to" => $token,
		              "notification" => array( "title" => "Laporan Perkembangan Ternak", "body" => "Lihat perkembangan terbaru ternak anda","icon" => "icon.png", "click_action" => site_url('investor/mycattle/view/'.$id_ternak.'/'.$slug)));
		$data_string = json_encode($data);

		$headers = array
		(
		     'Authorization: key=AAAALqE7FSc:APA91bFAwJKjXMOxvH2t15bBnmFK00hRosPb5UJGKhZwhg_i1LuaYBcdd8VY374FDgrMsuJMUIWwp6AiigBX0b8PK5-HnFBoIsqGYLKHiBhm0OJ3vdMPJwfstalBjC6mNhUS-Z9nM3Q6',
		     'Content-Type: application/json'
		);

		$ch = curl_init();

		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);

		$result = curl_exec($ch);

		curl_close ($ch);
	}
	
	public function send_notif_finance($token, $id_ternak, $slug)
	{
		$data = array("to" => $token,
		              "notification" => array( "title" => "Laporan Keuangan", "body" => "Segera cek laporan keuangan terbaru ternak anda","icon" => "icon.png","sound" => "/notif.mp3", "click_action" => site_url('investor/mycattle/view/'.$id_ternak.'/'.$slug)));
		$data_string = json_encode($data);

		$headers = array
		(
		     'Authorization: key=AAAALqE7FSc:APA91bFAwJKjXMOxvH2t15bBnmFK00hRosPb5UJGKhZwhg_i1LuaYBcdd8VY374FDgrMsuJMUIWwp6AiigBX0b8PK5-HnFBoIsqGYLKHiBhm0OJ3vdMPJwfstalBjC6mNhUS-Z9nM3Q6',
		     'Content-Type: application/json'
		);

		$ch = curl_init();

		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);

		$result = curl_exec($ch);

		curl_close ($ch);
	}
}
