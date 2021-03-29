<?php

class Submenu_model extends CI_Model
{
	public function getSubmenu()
	{
		$this->db->select('user_menu.menu, user_sub_menu.*');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
		$this->db->order_by('user_menu.id');
		return $this->db->get()->result_array();
	}

	public function dropdownMenu()
	{
		return  $this->db->get('user_menu')->result_array();
		// $value[''] = 'Choose';
		// foreach ($query as $option) {
		// 	$value[$option['id']] = $option['menu'];
		// }
		// return $value;
	}
}
