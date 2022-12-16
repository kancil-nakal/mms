<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_insert');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }

        $data = [
            'title' => 'Login'
        ];
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    public function _login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $user = $this->db->get_where('admin_users', ['email' => $email])->row_array();
        // var_dump($user);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id_user' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['id_role'],
                ];
                $this->session->set_userdata($data);
                $this->M_insert->log('login MMS', 'success');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    email or password incorrent!
                    </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    email or password incorrent!
                    </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $data = ['email', 'role'];
        $this->session->unset_userdata($data);
        redirect('auth');
    }
}
