<?php

namespace App\Controllers;

class Home extends BaseController
{

	function __construct()
	{
		helper('form');
		$this->session = session();
		$this->db = db_connect();
	}

	public function index()
	{
		$data = $this->db->query('select * FROM kpi ORDER BY id DESC')->getResult();
		foreach ($data as $d) {
			$all_ = [
				'id'		=> $d->id,
				'bidang'	=> $d->bidang,
				'posisi'	=> $d->posisi,
				'kpi'		=> $this->db->query("select * FROM kpi AS a LEFT JOIN kpi_meta AS b ON a.id = b.id_kpi WHERE a.id = '" . $d->id . "' ORDER BY a.id DESC")->getResult()
			];
			$all_data[] = $all_;
		}

		$active = 'home';
		return view('apps/kpi', [
			'active' => $active,
			'data'	 => $all_data
		]);
		// echo '<pre>';
		// print_r($all_data);
	}
}
