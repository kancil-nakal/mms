<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'logs' => $this->db->query("select *,TIMESTAMPDIFF(HOUR, date_time, current_timestamp) as inDay from logs l inner join admin_users au on au.id=l.id_user order by id_log desc limit 6;")->result(),
		];
		$this->template->load('partials/template', 'dashboard', $data);
	}
}
