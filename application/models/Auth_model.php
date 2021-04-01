<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

	public function createAccount()
	{
		$data = [
			'name' => htmlspecialchars($this->input->post('fullname', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'image' => 'default.svg',
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 0,
			'date_created' => time()
		];

		$this->db->insert('user', $data);
	}

	public function userToken($token)
	{
		// Set data to store to database
		$data = [
			'email' => htmlspecialchars($this->input->post('email', true)),
			'token' => $token,
			'date_created' => time()
		];

		// insert data to table user_token
		$this->db->insert('user_token', $data);
	}

	public function verify()
	{
		// Get data email end token from url
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		// Check the email from url and database
		$check_email = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($check_email) {
			// If there is, Check the token from url and database
			$check_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($check_token) {
				// If there is, check the time of token
				if (time() - $check_token['date_created'] < (60 * 60 * 24)) {
					// If token still active, update is_active user to be 1
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					// After actived the email, delete the token
					$this->db->delete('user_token', ['email' => $email]);
				} else {
					// If already past 24 hour, token expired, delete the user
					$this->db->delete('user', ['email' => $email]);
					// Delete token
					$this->db->delete('user_token', ['email' => $email]);
					// Give error message
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Activation failed, url is expired!</div>');
					// Redirect to login page
					redirect('auth');
				}
			} else {
				// If not there, give error message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Activation failed, url is invalid!</div>');
				// Redirect to login page
				redirect('auth');
			}
		} else {
			// If not there, give error message
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Activation failed, email is invalid!</div>');
			// Redirect to login page
			redirect('auth');
		}
	}
}
