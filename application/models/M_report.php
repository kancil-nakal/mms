<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
	public function getReport($kd_project = null)
	{
		$query = $this->db->query("select ms.kd_project, p.project_name FROM material_stock ms, projects p WHERE ms.kd_project =p.kd_project GROUP BY ms.kd_project;");
		return $query;
	}
	public function detailReport()
	{
	}
}
