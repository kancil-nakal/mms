<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_report');
        $this->load->model('M_project');
        $this->load->model('M_request');
        $this->load->model('M_material');
        $this->load->library('Pdf_report');
    }

    public function index()
    {
        $data = [
            'title' => 'Reports',
            'reports' => $this->M_report->getReport()->result(),
        ];
        $this->template->load('partials/template', 'reports/report_data', $data);
    }

    public function detail_report($kd_project)
    {
        // $id_request = $this->M_request->getRequestReport($kd_project)->row();
        $data = [
            'title' => 'Report | Detail',
            'project' => $this->M_project->getProject($kd_project)->row(),
            'request_in' => $this->db->query("select * from requests where in_out = 'in' and kd_project='$kd_project'")->result(),
            'request_out' => $this->db->query("select * from requests where in_out = 'out' and kd_project='$kd_project'")->result(),
            'material_in' => $this->M_request->get_material_in_report($kd_project)->result(),
            'material_out' => $this->M_request->get_material_out_report($kd_project)->result(),
            'material_stock' => $this->M_material->materialStock($kd_project)->result(),
        ];
        $this->template->load('partials/template', 'reports/report_detail', $data);
    }


    public function request_export_in($id = null)
    {
        $data = [
            'request' => $this->M_request->getRequest($id)->row(),
            'material' => $this->M_request->get_material_in($id)->result(),
        ];
        // var_dump($data['request']);
        // die;
        $this->load->view('reports/request_export', $data);
    }

    public function request_export_out($id = null)
    {
        $data = [
            'request' => $this->M_request->getRequest($id)->row(),
            'material' => $this->M_request->get_material_out($id)->result(),
        ];
        // var_dump($data['material']);
        // die;
        $this->load->view('reports/request_export', $data);
    }
    public function material_export($kd_project = null)
    {
        $data = [
            'title' => 'Material Stock',
            'project' => $this->M_project->getProject($kd_project)->row(),
            'material_in' => $this->M_request->get_material_in_report($kd_project)->result(),
            'material_out' => $this->M_request->get_material_out_report($kd_project)->result(),
            'material_stock' => $this->M_material->materialStock($kd_project)->result(),
        ];
        $this->load->view('reports/material_export', $data);
    }
}
