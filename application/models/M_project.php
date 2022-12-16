<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_project extends CI_Model
{
    public function getProject($kd_project = null)
    {
        if (empty($kd_project)) {
            $query = $this->db->query('select * from projects p order by p.created_at desc');
        } else {
            $query = $this->db->query("select * from projects p where kd_project='$kd_project' order by p.created_at desc");
        }
        return $query;
    }
    public function addProject()
    {
        $today = date('ym');
        $rand = rand(10000, 99999);
        $kd_project = $this->input->post('kd_project', true);
        $data = [
            'kd_project' => $kd_project,
            'project_name' => $this->input->post('project_name', true),
            'start_date' => $this->input->post('start_date', true),
            'end_date' => $this->input->post('end_date', true),
            'area' => $this->input->post('area', true),
        ];
        // $req = [
        //     'id_request' => 'RQ' . $today . $rand,
        //     'kd_project' => $kd_project,
        // ];
        $this->db->insert('projects', $data);
        // $this->db->insert('requests', $req);
    }
}
