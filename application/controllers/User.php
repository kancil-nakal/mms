<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        check_admin_level();
        $this->load->model('M_user');
    }
    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => $this->M_user->getUser()->result(),
        ];
        $this->template->load('partials/template', 'users/user_data', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'User | Add',
            'roles' => $this->db->get('roles')->result(),
        ];
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[admin_users.email]');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|matches[password1]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->load('partials/template', 'users/user_add', $data);
        } else {
            $this->M_user->addUser();
            $this->M_insert->log('added a users', 'primary');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Congratulations! User has been added successfully!
                    </div>');
                redirect('user');
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'User | Edit',
            'roles' => $this->db->get('roles')->result(),
            'user' => $this->M_user->getUserById($id)->row_array(),
        ];
        $password1 = $this->input->post('password1', true);
        // $password2 = $this->input->post('password2', true);
        $this->form_validation->set_rules('name', 'Name', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[admin_users.email]');
        if ($password1) {
            $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]');
        }
        if ($password1) {
            $this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|matches[password1]');
        }
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->load('partials/template', 'users/user_edit', $data);
        } else {
            $this->M_user->editUser();
            $this->M_insert->log('updated a users', 'warning');
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Congratulations! User has been updated successfully!
                    </div>');
                redirect('user');
            }
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('admin_users');
        $this->M_insert->log('deleted a users', 'danger');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Congratulations! User has been deleted successfully!
                </div>');
            redirect('user');
        }
    }
}
