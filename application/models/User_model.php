<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function getUserLogin()
	{
		// Get data user from database according to user data who login now
		return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function getMenu()
	{
		// Get role_id according to user data login now
		$role_id = $this->session->userdata('role_id');

		// Get data menu from database according to role_id
		$this->db->select('user_menu.id, menu');
		$this->db->from('user_menu');
		$this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
		$this->db->order_by('user_access_menu.menu_id', 'ASC');
		$this->db->where('user_access_menu.role_id', $role_id);
		return $this->db->get()->result_array();
	}
}
