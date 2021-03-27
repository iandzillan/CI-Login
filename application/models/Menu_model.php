<?php

class Menu_model extends CI_Model
{
	public function getAllMenu()
	{
		// Get all data menu from database
		return $this->db->get('user_menu')->result_array();
	}

	public function addMenu()
	{
		// Get data from input user
		$data = [
			'menu' => $this->input->post('menu')
		];

		// Store to database
		$this->db->insert('user_menu', $data);
	}
}
