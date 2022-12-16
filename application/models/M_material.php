<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_material extends CI_Model
{
	public function getMaterial()
	{
		return $this->db->get('materials');
	}

	public function getKodeMaterial($kd_project)
	{
		$this->db->from('material_stock');
		$this->db->where('kd_project', $kd_project);
		// $this->db->where('kd_material', $kd_material);
		return $this->db->get();
	}
	public function getMaterialActive()
	{
		$this->db->from('materials');
		$this->db->where('is_active', 1);
		return $this->db->get();
	}

	public function addMaterial()
	{
		$data = [
			'kd_material' => $this->input->post('kd_material', true),
			'material_name' => $this->input->post('material_name', true),
			'unit' => $this->input->post('unit', true),
			'is_active' => $this->input->post('is_active', true),
			'desc' => $this->input->post('desc', true),
		];
		$this->db->insert('materials', $data);
	}
	public function editMaterial()
	{
		$data = [
			'material_name' => $this->input->post('material_name', true),
			'unit' => $this->input->post('unit', true),
			'desc' => $this->input->post('desc', true),
			'is_active' => $this->input->post('is_active', true),
			'updated_at' => date('Y-m-d H:i:s'),
		];
		$this->db->where('kd_material', $this->input->post('kd_material', true));
		$this->db->update('materials', $data);
	}

	public function materialStock($kd_project)
	{
		return $this->db->query("select * from material_stock ms inner join materials m on m.kd_material=ms.kd_material inner join projects p on p.kd_project=ms.kd_project where ms.kd_project='$kd_project' order by ms.created_at desc");
	}
	public function getMaterialStock()
	{
		return $this->db->query("select *, ms.created_at as created from material_stock ms inner join materials m on m.kd_material=ms.kd_material inner join projects p on p.kd_project=ms.kd_project order by ms.created_at desc");
	}
}
