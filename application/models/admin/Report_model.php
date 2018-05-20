<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends MY_Model
{
	public function getDataReport($month='', $year='', $limit='', $offset='')
	{
		$query  = $this->db->query("SELECT * FROM `t_saldo_kt` where month(`created_at`) =  '$month' AND year(`created_at`) =  '$year' AND status = '0' LIMIT $limit OFFSET $offset");

		return  $query->result();
	}

	public function getRowReport($month='', $year='')
	{
		$query  = $this->db->query("SELECT * FROM `t_saldo_kt` where month(`created_at`) =  '$month' AND year(`created_at`) =  '$year' AND status = '0'");

		return  $query->num_rows();
	}

	public function getTotalProfit($month='', $year='')
	{
		$query  = $this->db->query("SELECT sum(nominal) as total FROM `t_saldo_kt` where month(`created_at`) =  '$month' AND year(`created_at`) =  '$year' AND status = '0'");
// dump($query->result());
			return  $query->row();
	}
}
