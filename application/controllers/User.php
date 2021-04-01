<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		// Call __cunstruct funtion from parent class 
		Parent::__construct();
		// Call is_logged_in helper from idm_helper to check session adn user role. This helper can be found in folder application/helpers
		is_logged_in();
		// Load User_model
		$this->load->model('User_model');
	}

	public function index()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Build page
		$data['title'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Build page
		$data['title'] = 'Edit Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update()
	{
		// Set the validation
		$this->form_validation->set_rules('name', 'name', 'required');
		// Check the validation
		if ($this->form_validation->run() == false) {
			// If validation fail, back to user/edit
			$this->edit();
		} else {
			// If validation success, run update function from User_model
			$this->User_model->update();
			// Give flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile successfully updated!</div>');
			// Redirect to user index
			redirect('user');
		}
	}

	public function changePassword()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Build page
		$data['title'] = 'Change Password';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/change-password', $data);
		$this->load->view('templates/footer');
	}

	public function updatePassword()
	{
		// Set validation
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('password1', 'new password', 'required|min_length[6]|matches[password2]');
		$this->form_validation->set_rules('password2', 'repeat password', 'required|matches[password1]');
		// Check validation
		if ($this->form_validation->run() == false) {
			$this->changePassword();
		} else {
			// If validation success, run changePassword function from User_model
			$this->User_model->changePassword();
			// Give flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your password successfully changed!</div>');
			// Redirect to user/changpassword
			redirect('user/changepassword');
		}
	}
}
