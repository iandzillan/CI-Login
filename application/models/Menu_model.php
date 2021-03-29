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

	public function getId($id)
	{
		// Select menu accroding selected id
		return $this->db->get_where('user_menu', ['id' => $id])->row_array();
	}

	public function update($id)
	{
		// Get data from input user
		$data = [
			'menu' => $this->input->post('menu')
		];
		// Select menu according selected id
		$this->db->where('id', $id);
		// Update data menu
		$this->db->update('user_menu', $data);
	}

	public function delete($id)
	{
		// Select menu according id
		$this->db->where('id', $id);
		// Delete menu
		$this->db->delete('user_menu');
	}
}
