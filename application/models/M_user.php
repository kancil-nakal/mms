<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function getUser($email = null)
    {
        $this->db->select('*');
        $this->db->from('admin_users au');
        $this->db->join('roles r', 'r.id_role=au.id_role');
        if ($email != null) {
            $this->db->where('email', $email);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getUserById($id = null)
    {
        $this->db->select('*');
        $this->db->from('admin_users au');
        $this->db->join('roles r', 'r.id_role=au.id_role');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function addUser()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password1', true), PASSWORD_DEFAULT),
            'id_role' => $this->input->post('role'),
        ];
        $this->db->insert('admin_users', $data);
    }
    public function edituser()
    {
        $password = $this->input->post('password1', true);
        if ($password != null) {
            $data = [
                'name' => $this->input->post('name', true),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'id_role' => $this->input->post('role'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'name' => $this->input->post('name', true),
                'id_role' => $this->input->post('role'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->where('id', $this->input->post('id_user', true));
        $this->db->update('admin_users', $data);
    }
}
