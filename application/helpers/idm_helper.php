<?php

function is_logged_in()
{
	// Call library CI to use in this helper
	$idm = get_instance();
	// Check there is session or not
	if (!$idm->session->userdata('email')) {
		// If there is no session, redirect to login
		redirect('auth');
	} else {
		// If ther is session, get the role
		$role_id = $idm->session->userdata('role_id');
		// Get menu from url
		$menu = $idm->uri->segment(1);

		// Get menu id according ke url
		$query_menu = $idm->db->get_where('user_menu', ['menu' => $menu])->row_array();
		$menu_id = $query_menu['id'];

		// Match role_id with menu_id
		$user_access = $idm->db->get_where('user_access_menu', [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		]);

		// CHeck total the row rows from query $user_access
		if ($user_access->num_rows() < 1) {
			// If total of the rows less then 1, redirect to blocked view
			redirect('auth/block');
		}
	}
}

function check_access($role_id, $menu_id)
{
	// Call library CI to use in this helper
	$idm = get_instance();
	// Query to user_access_menu according $role_id and $menu_id
	$query = $idm->db->get_where('user_access_menu', [
		'role_id' => $role_id,
		'menu_id' => $menu_id
	]);
	// Check total the rows from query $query
	if ($query->num_rows() > 0) {
		// If total rows greater than 1, return checked
		return "checked='checked'";
	}
}
