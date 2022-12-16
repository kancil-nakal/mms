<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_insert extends CI_Model
{
    public function log($activity, $color)
    {
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'activity' => $activity,
            'color' => $color
        ];
        $this->db->insert('logs', $data);
    }
}
