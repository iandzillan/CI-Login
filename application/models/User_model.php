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

	public function update()
	{
		// Get login user
		$user = $this->getUserLogin();
		// Get name and image from input user
		$fullname = $this->input->post('name');
		$image = $_FILES['image']['name'];
		// Upload image configuration
		$config = [
			'upload_path' 	=> './assets/img/profile/',
			'allowed_types' => 'jpg|png',
			'max_size'		=> 2048
		];
		// Check the file upload is image or not
		if ($image) {
			// load library upload with the configuration
			$this->load->library('upload', $config);
			// Upload file to folder path
			if ($this->upload->do_upload('image')) {
				// if upload success, check name of image
				$old_image = $user['image'];
				if ($old_image != 'default.svg') {
					// Delete image from folder path
					unlink(FCPATH . 'assets/img/profile/' . $old_image);
				}
				$upload = $this->upload->data('file_name');
				$this->db->set('image', $upload);
			} else {
				// Give flash message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Image profile failed to changed!</div>');
				// Redirect to submenu index
				redirect('user');
			}
		}
		// Update the profile
		$this->db->set('name', $fullname);
		$this->db->where('email', $user['email']);
		$this->db->update('user');
	}

	public function changePassword()
	{
		// Get login user
		$user = $this->getUserLogin();
		// Get password from input user
		$cur_password = $this->input->post('password');
		// Get new password from input user
		$new_password = $this->input->post('password1');
		// Check is password match or not with user password
		if (password_verify($cur_password, $user['password'])) {
			// If password match, check is password same with new password or not
			if ($cur_password == $new_password) {
				// If current password same with new password, give the error message
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You can not entered new password with your old password!</div>');
				// Redirect to user/changepassword
				redirect('user/changepassword');
			} else {
				// If current password different with new password, store new password to satabase
				$fix_password = password_hash($new_password, PASSWORD_DEFAULT);
				// Update the password
				$this->db->set('password', $fix_password);
				$this->db->where('email', $user['email']);
				$this->db->update('user');
			}
		} else {
			// Give flash message
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You entered the wrong current password!</div>');
			// Redirect to user/changepassword
			redirect('user/changepassword');
		}
	}
}
