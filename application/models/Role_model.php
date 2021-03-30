<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
	public function getRole()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function add()
	{
		$data = [
			'role' => htmlspecialchars(ucfirst($this->input->post('role')))
		];

		$this->db->insert('user_role', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_role');
	}

	public function getRoleByid($id)
	{
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}

	public function getAllMenu()
	{
		return $this->db->get_where('user_menu', ['id !=' => 1])->result_array();
	}

	public function changeAccess()
	{
		// Get data menu_id and role_id from ajax
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		// Store data menu_id and role_id to array $data
		$data = [
			'menu_id' => $menu_id,
			'role_id' => $role_id,
		];
		// Query user_access_menu where match to $data
		$query = $this->db->get_where('user_access_menu', $data);
		// Check the total rows which get from $query
		if ($query->num_rows() < 1) {
			// If the total rows less than 1, insert the $data to database
			$this->db->insert('user_access_menu', $data);
		} else {
			// If the total rows greater that 1, delete the data
			$this->db->delete('user_access_menu', $data);
		}
	}
}
