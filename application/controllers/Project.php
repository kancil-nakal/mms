<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_level();
        $this->load->model('M_project');
    }
    public function index()
    {
        $data = [
            'title' => 'Project',
            'projects' => $this->M_project->getProject()->result(),
        ];
        $this->template->load('partials/template', 'projects/project_data', $data);
    }
    public function add()
    {
        $year = integerToRoman(date('y'));
        $moon = integerToRoman(date('m'));
        $rand = rand(10000, 99999);
        $data = [
            'title' => 'Project | Add',
            'kd_project' => 'P-' . $year . '-' . $moon . '-' . $rand,
        ];

        $this->form_validation->set_rules('kd_project', 'Kode Project', 'trim|required|is_unique[projects.kd_project]');
        $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->load('partials/template', 'projects/project_add', $data);
        } else {

            $this->M_project->addProject();
            $this->M_insert->log('added a project', 'primary');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Congratulations! Project has been added successfully!
                    </div>');
                redirect('project');
            }
        }
    }
}
