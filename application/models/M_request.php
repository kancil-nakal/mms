<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_request extends CI_Model
{

	public function getRequest($id = null)
	{
		$this->db->select('*, r.updated_at as finisedAt, r.created_at as createdAt, r.apply_at as applyAt');
		$this->db->from('requests r');
		$this->db->join('projects p', 'p.kd_project = r.kd_project');
		if ($id != null) {
			$this->db->where('r.id_Request', $id);
		}
		// $this->db->where('mw.id_request',);
		$query = $this->db->get();
		return $query;
	}
	public function getRequestReport($id = null)
	{
		// $query = $this->db->query("select * FROM requests r , projects p WHERE r.kd_project = p.kd_project AND r.kd_project ='$id';");
		$this->db->select('*, r.updated_at as finisedAt, r.created_at as createdAt, r.apply_at as applyAt');
		$this->db->from('requests r');
		$this->db->join('projects p', 'p.kd_project = r.kd_project');
		if ($id != null) {
			$this->db->where('r.kd_project', $id);
		}
		// $this->db->where('mw.id_request',);
		$query = $this->db->get();
		return $query;
	}
	public function get_whilst($params = null)
	{
		$this->db->select('*,mw.volume as volume_request');
		$this->db->from('material_whilst mw');
		$this->db->join('materials m', 'm.kd_material = mw.kd_material');
		$this->db->join('projects p', 'p.kd_project = mw.kd_project');
		if ($params != null) {
			$this->db->where('mw.kd_project', $params);
		}
		// $this->db->where('mw.id_request',);
		$query = $this->db->get();
		return $query;
	}

	public function get_whilst_material($params = null)
	{
		$this->db->select('*,mw.volume as volume_request');
		$this->db->from('material_whilst mw');
		$this->db->join('materials m', 'm.kd_material = mw.kd_material');
		$this->db->join('projects p', 'p.kd_project = mw.kd_project');
		if ($params != null) {
			$this->db->where($params);
		}
		// $this->db->where('mw.id_request',);
		$query = $this->db->get();
		return $query;
	}

	public function add_whilst_material()
	{
		$query = $this->db->query("SELECT MAX(id_mw) AS whilst_no FROM material_whilst");
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$whilst_no = ((int) $row->whilst_no) + 1;
		} else {
			$whilst_no = "1";
		}

		$data = [
			'id_mw' => $whilst_no,
			'kd_project' => $this->input->post('kd_project', true),
			'kd_material' => $this->input->post('kd_material', true),
			'volume' => $this->input->post('volume', true),
		];
		$this->db->insert('material_whilst', $data);
	}

	public function update_whilst_material()
	{
		$kd_material = $this->input->post('kd_material', true);
		$kd_project = $this->input->post('kd_project', true);
		$volume = $this->input->post('volume', true);
		$query = "UPDATE material_whilst SET 
                    volume = volume + '$volume' 
                    WHERE kd_material = '$kd_material' 
                    AND kd_project = '$kd_project'";
		$this->db->query($query);
	}

	public function del_whilst($kd_material = null, $kd_project = null)
	{
		if ($kd_material != null) {
			$this->db->where($kd_material);
		}
		if ($kd_project != null) {
			$this->db->where($kd_project);
		}
		$this->db->delete('material_whilst');
	}

	public function edit_whilst($post)
	{
		$params = array(
			'volume' => $post['volume'],
		);
		$this->db->where('kd_project', $post['kd_project']);
		$this->db->where('kd_material', $post['kd_material']);
		$this->db->update('material_whilst', $params);
	}

	public function add_request_in($post)
	{
		$today = date('ym');
		$rand = rand(10000, 99999);
		$id_request = 'RQ' . $today . $rand;
		$params = array(
			'id_request' => $id_request,
			'kd_project' => $post['kd_project'],
			'status' => 1,
			'in_out' => 'in',
			'user_request' => $this->session->userdata('name'),
		);
		$this->db->insert('requests', $params);
		return $id_request;
	}

	public function add_request_out($post)
	{
		$today = date('ym');
		$rand = rand(10000, 99999);
		$id_request = 'RQ' . $today . $rand;
		$params = array(
			'id_request' => $id_request,
			'kd_project' => $post['kd_project'],
			'status' => 1,
			'in_out' => 'out',
			'user_request' => $this->session->userdata('name'),
		);
		// var_dump($params);
		// die;
		$this->db->insert('requests', $params);
		return $id_request;
	}
	public function add_request_detail_in($params)
	{
		$this->db->insert_batch('request_detail_in', $params);
	}
	public function add_request_detail_out($params)
	{
		$this->db->insert_batch('request_detail_out', $params);
	}

	public function get_request_detail($id_request)
	{
		$query = $this->db->query("select * from requests r  where id_request='$id_request';");
		return $query;
	}
	public function get_material_in($id_request)
	{
		$query = $this->db->query("select * from request_detail_in rdi INNER JOIN materials m ON m.kd_material=rdi.kd_material where id_request='$id_request';");
		return $query;
	}
	public function get_material_in_report($kd_project)
	{
		$query = $this->db->query("select kd_project , m.kd_material, sum(volume) as volume, m.material_name , m.unit from request_detail_in rdi INNER JOIN materials m on rdi.kd_material = m.kd_material where kd_project='$kd_project'  GROUP BY kd_project, kd_material ;");
		return $query;
	}
	public function get_material_out($id_request)
	{
		$query = $this->db->query("select * from request_detail_out rdo INNER JOIN materials m ON m.kd_material=rdo.kd_material where id_request='$id_request';");
		return $query;
	}
	public function get_material_out_report($kd_project)
	{
		$query = $this->db->query("select kd_project , m.kd_material, sum(volume) as volume, m.material_name , m.unit from request_detail_out rdo INNER JOIN materials m on rdo.kd_material = m.kd_material where kd_project='$kd_project'  GROUP BY kd_project, kd_material ;");
		return $query;
	}

	public function get_material_stock($params = null)
	{
		$this->db->select('*,ms.volume');
		$this->db->from('material_stock ms');
		$this->db->join('materials m', 'm.kd_material = ms.kd_material');
		$this->db->join('projects p', 'p.kd_project = ms.kd_project');
		if ($params != null) {
			$this->db->where($params);
		}
		// $this->db->where('mw.id_request',);
		$query = $this->db->get();
		return $query;
	}


	public function update_request_status()
	{
		// $kd_project = $this->input->post('kd_project', TRUE);
		$id_request = $this->input->post('id_request', TRUE);
		$params = array(
			'status' => 3,
			'updated_at' => date('Y-m-d H:i:s'),
			'user_finish' => $this->session->userdata('name'),
		);
		$this->db->where('id_request', $id_request);
		$this->db->update('requests', $params);
	}

	public function update_request_detail_in()
	{
		// $kd_project = $this->input->post('kd_project', TRUE);
		$id_request = $this->input->post('id_request', TRUE);
		// $kd_material = $this->input->post('kd_material', TRUE);
		$params = array(
			'status' => 1,
		);
		$this->db->where('id_request', $id_request);
		// $this->db->where('kd_material', $kd_material);
		$this->db->update('request_detail_in', $params);
	}

	public function count_stock_in()
	{
	}

	public function update_request_detail_out()
	{
		$id_request = $this->input->post('id_request', TRUE);
		$params = array(
			'status' => 1,
		);
		$this->db->where('id_request', $id_request);
		$this->db->update('request_detail_out', $params);
	}

	public function add_material_stock($params)
	{
		$this->db->insert_batch('material_stock', $params);
	}

	public function update_material_stock()
	{
		$kd_material = $this->input->post('kd_material', true);
		$kd_project = $this->input->post('kd_project', true);
		$volume = $this->input->post('volume', true);
		$query = "UPDATE material_whilst SET 
                    volume = volume + '$volume' 
                    WHERE kd_material = '$kd_material' 
                    AND kd_project = '$kd_project'";
		$this->db->query($query);
	}
}
