<?php

class User extends CI_Model
{

	public function createAccount()
	{
		$data = [
			'name' => htmlspecialchars($this->input->post('fullname', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'image' => 'default.svg',
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 1,
			'date_created' => time()
		];

		$this->db->insert('user', $data);
	}
}
