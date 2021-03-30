<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{
	public function getSubmenu()
	{
		$this->db->select('user_menu.menu, user_sub_menu.*');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
		$this->db->order_by('url', 'ASC');
		return $this->db->get()->result_array();
	}

	public function dropdownMenu()
	{
		return  $this->db->get('user_menu')->result_array();
	}

	public function add()
	{
		// Get data from input user
		$data = [
			'menu_id' => $this->input->post('menu_id'),
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active')
		];

		// Store data to database
		$this->db->insert('user_sub_menu', $data);
	}

	public function delete($id)
	{
		// Select sub menu according id
		$this->db->where('id', $id);
		// Delete sub menu
		$this->db->delete('user_sub_menu');
	}
}
