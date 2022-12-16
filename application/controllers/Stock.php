<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('M_material');
		$this->load->model('M_request');
	}


	public function material_stock()
	{
		$data = [
			'title' => 'Material Stock',
			'materials' => $this->M_material->getMaterialStock()->result(),
		];


		$this->template->load('partials/template', 'materials/material_stock', $data);
	}
}
