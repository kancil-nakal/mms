<?php

class Fungsi
{
    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('M_user');
    }
    function user_login()
    {
        $email = $this->ci->session->userdata('email');
        $user_data = $this->ci->M_user->getUser($email)->row();
        // $user_data = $this->ci->db->get_where('admin_users', ['email' => $email])->row();
        return $user_data;
    }
}
