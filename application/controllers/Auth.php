<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		// load model user
		$this->load->model('User');
		// load library form_validation
		$this->load->library('form_validation');
	}

	public function index()
	{
		// build page
		$data['title'] = 'Login | IDM';
		$this->load->view('auth/templates/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/templates/footer');
	}

	public function register()
	{
		// build page
		$data['title'] = 'Registration | IDM';
		$this->load->view('auth/templates/header', $data);
		$this->load->view('auth/register');
		$this->load->view('auth/templates/footer');
	}

	public function saveAccount()
	{
		// Set validation
		$this->form_validation->set_rules('fullname', 'Fullname', 'required', [
			'required' => '%s field is required!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
			'required' => '%s field is required!',
			'valid_email' => '%s must be valid email!',
			'is_unique' => '%s is already registered!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password2]|min_length[3]', [
			'required' => '%s field is required!',
			'matches' => '%s does not match with repeat password field!',
			'min_length' => '%s must be at least 3 characters!'
		]);
		$this->form_validation->set_rules('password2', 'Repeat password', 'required|matches[password]', [
			'required' => '%s field is required!',
			'matches' => '%s does not match with password field!'
		]);

		// Check validation
		if ($this->form_validation->run() == false) {
			// If validation fail, back to register page
			return $this->register();
		} else {
			// If validation success, call createAccount function from User model to store data to database
			$this->User->createAccount();
			// Set flashdata
			$this->session->set_flashdata('success', 'created');
			// Redirect to login page
			redirect('auth');
		}
	}
}
