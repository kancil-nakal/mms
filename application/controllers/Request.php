<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('M_material');
		$this->load->model('M_request');
	}

	public function index()
	{

		$data = [
			'title' => 'Request',
			'requests' => $this->db->query('select * from requests  order by created_at desc')->result(),

		];

		$this->template->load('partials/template', 'requests/request_data', $data);
	}
	public function in()
	{

		$data = [
			'title' => 'Request In',
			'requests' => $this->db->query("select * from requests where in_out = 'in' order by created_at desc")->result(),

		];
		$this->template->load('partials/template', 'requests/request_data', $data);
	}
	public function out()
	{

		$data = [
			'title' => 'Request Out',
			'requests' => $this->db->query("select * from requests where in_out = 'out' order by created_at desc")->result(),

		];
		$this->template->load('partials/template', 'requests/request_data', $data);
	}

	public function material_in($kd_project)
	{
		$today = date('ym');
		$rand = rand(10000, 99999);
		$request = $this->db->get_where('projects', ['kd_project' => $kd_project])->row_array();
		$data = [
			'title' => 'Request | Material In',
			'request' => $request,
			'materials' => $this->M_material->getMaterialActive()->result(),
			'whilst' => $this->M_request->get_whilst($request['kd_project']),
			'id_request' => 'RQ' . $today . $rand,
		];
		$this->template->load('partials/template', 'requests/request_material_in', $data);
	}

	public function material_out($kd_project)
	{
		$today = date('ym');
		$rand = rand(10000, 99999);
		$request = $this->db->get_where('projects', ['kd_project' => $kd_project])->row_array();
		$data = [
			'title' => 'Request | Material Out',
			'request' => $request,
			'materials' => $this->M_material->materialStock($kd_project)->result(),
			'id_request' => 'RQ' . $today . $rand,
		];
		$this->template->load('partials/template', 'requests/request_material_out', $data);
	}


	public function detail_in($id_request)
	{
		$request = $this->M_request->get_request_detail($id_request)->row_array();
		$data = [
			'title' => 'Request | Detail In',
			'request' => $request,
			'materials' => $this->M_request->get_material_in($id_request)->result(),
		];
		$this->template->load('partials/template', 'requests/request_detail', $data);
	}

	public function detail_out($id_request)
	{
		$request = $this->M_request->get_request_detail($id_request)->row_array();
		$data = [
			'title' => 'Request | Detail Out',
			'request' => $request,
			'materials' => $this->M_request->get_material_out($id_request)->result(),
		];
		$this->template->load('partials/template', 'requests/request_detail', $data);
	}

	public function process()
	{
		if (isset($_POST['add_material'])) {
			$kd_project = $this->input->post('kd_project');
			// $id_request = $this->input->post('id_request');
			$kd_material = $this->input->post('kd_material');
			$check_whlist = $this->M_request->get_whilst_material(['mw.kd_material' => $kd_material, 'mw.kd_project' => $kd_project]);
			if ($check_whlist->num_rows() > 0) {
				$this->M_request->update_whilst_material();
			} else {
				$this->M_request->add_whilst_material();
			}

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['edit_whilst'])) {
			$post = $this->input->post(null, TRUE);
			$this->M_request->edit_whilst($post);
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['reset_material'])) {
			$kd_project = $this->input->post('kd_project', true);
			$this->db->where('kd_project', $kd_project);
			$this->db->delete('material_whilst');
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
		if (isset($_POST['reset_material_out'])) {
			$kd_project = $this->input->post('kd_project', true);
			$this->db->where('kd_project', $kd_project);
			$this->db->delete('material_whilst');
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}


		if (isset($_POST['request_material_out'])) {
			$post = $this->input->post(null, TRUE);
			$id_request = $this->M_request->add_request_out($post);
			$kd_project = $this->input->post('kd_project');
			$jumlah = $this->input->post('jumlah');
			$kode = $this->input->post('kode');
			if (!empty($jumlah)) {
				for ($i = 0; $i < count($jumlah); $i++) {
					$row[] = [
						'id_request' => $id_request,
						'kd_material' => $kode[$i],
						'kd_project' => $kd_project,
						'volume' =>  $jumlah[$i],
						'id_user' => $this->session->userdata('id_user'),
					];
				}
				// print_r($row);
				// die;
				$this->M_request->add_request_detail_out($row);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                            Congratulations! Material has been updated successfully!
                        </div>');
					redirect('dashboard');
				}
			} else {
				redirect('request/' . $id_request . '/detail');
			}
		}
	}

	public function request_material()
	{
		if (isset($_POST['request_material_in'])) {
			$post = $this->input->post(null, TRUE);
			$id_request = $this->M_request->add_request_in($post);
			$kd_project = $this->input->post('kd_project');
			$whlist = $this->M_request->get_whilst()->result();
			$row = [];
			foreach ($whlist as $key => $data) {
				array_push(
					$row,
					[
						'id_request' => $id_request,
						'kd_material' => $data->kd_material,
						'kd_project' => $kd_project,
						'volume' => $data->volume,
						'id_user' => $this->session->userdata('id_user'),
					],
				);
			}
			$this->M_request->add_request_detail_in($row);
			$this->db->where('kd_project', $post['kd_project']);
			$this->db->delete('material_whilst');
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}



		if (isset($_POST['selesaikan_in'])) {
			$id_request = $this->input->post('id_request', TRUE);

			$material = $this->M_request->get_material_in($id_request)->result();
			$array = [];
			foreach ($material as $key => $dt) {
				$array = [
					'kd_project' => $dt->kd_project,
					'kd_material' => $dt->kd_material
				];
			}
			$check_material = $this->db->get_where('material_stock', $array);

			if ($check_material->num_rows() > 0) {
				$this->M_request->update_request_detail_in();
			} else {
				$row = [];
				foreach ($material as $key => $data) {

					array_push(
						$row,
						[
							'kd_project' => $data->kd_project,
							'kd_material' => $data->kd_material,
							'volume' => $data->volume,
						],
					);
				}
				$this->db->insert_batch('material_stock', $row);
			}

			$this->M_request->update_request_status();
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
			// redirect('request/' . $id_request . '/detail/in');
		}

		if (isset($_POST['selesaikan_out'])) {
			// $kd_project = $this->input->post('kd_project', TRUE);
			// $id_request = $this->input->post('id_request', TRUE);
			$this->M_request->update_request_detail_out();
			$this->M_request->update_request_status();
			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function whilst($kd_project)
	{
		// $request = $this->db->get_where('requests', ['kd_project' => $kd_project])->row_array();
		$data['whilst'] = $this->M_request->get_whilst($kd_project);
		$this->load->view('requests/whilst_material', $data);
	}

	public function del_whilst()
	{
		$kd_material = $this->input->post('kd_material');
		$kd_project = $this->input->post('kd_project');

		$this->M_request->del_whilst(['kd_material' => $kd_material], ['kd_project' => $kd_project]);

		if ($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}

	public function apply_request_in($id_request)
	{
		$data = [
			'status' => 2,
			'user_apply' => $this->session->userdata('name'),
			'apply_at' => date('Y-m-d H:i:s'),
		];
		$this->db->where('id_request', $id_request);
		$this->db->update('requests', $data);
		redirect('request/in/detail/' . $id_request);
	}
	public function apply_request_out($id_request)
	{
		$data = [
			'status' => 2,
			'user_apply' => $this->session->userdata('name'),
			'apply_at' => date('Y-m-d H:i:s'),
		];
		$this->db->where('id_request', $id_request);
		$this->db->update('requests', $data);
		redirect('request/out/detail/' . $id_request);
	}
}
