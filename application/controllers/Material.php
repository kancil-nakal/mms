<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		check_admin_level();
		$this->load->model('M_material');
	}
	public function index()
	{
		$data = [
			'title' => 'Material',
			'materials' => $this->db->get('materials')->result(),
		];


		$this->template->load('partials/template', 'materials/material_data', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Material | Add',
		];
		$this->form_validation->set_rules('kd_material', 'Kode Material', 'trim|required|is_unique[materials.kd_material]');
		$this->form_validation->set_rules('material_name', 'Material Name', 'trim|required');
		$this->form_validation->set_rules('unit', 'Unit', 'required');
		// $this->form_validation->set_rules('is_active', 'is_active', 'required');
		if ($this->form_validation->run() == false) {
			$this->template->load('partials/template', 'materials/material_add', $data);
		} else {
			$this->M_material->addMaterial();
			$this->M_insert->log('added a materials', 'primary');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Congratulations! Material has been added successfully!
                    </div>');
				redirect('material');
			}
		}
	}

	public function edit($kode)
	{
		$data = [
			'title' => 'Material | Edit',
			'material' => $this->db->get_where('materials', ['kd_material' => $kode])->row_array(),
		];
		$this->form_validation->set_rules('material_name', 'Material Name', 'trim|required');
		$this->form_validation->set_rules('unit', 'Unit', 'required');
		$this->form_validation->set_rules('is_active', 'is_active', 'required');
		if ($this->form_validation->run() == false) {
			$this->template->load('partials/template', 'materials/material_edit', $data);
		} else {
			$this->M_material->editMaterial();
			$this->M_insert->log('updated a material', 'warning');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Congratulations! Material has been updated successfully!
                    </div>');
				redirect('material');
			}
		}
	}

	// public function material_stock()
	// {
	//     $data = [
	//         'title' => 'Material Stock',
	//         'materials' => $this->M_material->getMaterialStock()->result(),
	//     ];
	//     $this->template->load('partials/template', 'materials/material_stock', $data);
	// }
}
