<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		// load model user
		$this->load->model('Auth_model');
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
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]|trim', [
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
			$this->register();
		} else {
			// If validation success, call createAccount function from User model to store data to database
			$this->Auth_model->createAccount();
			// Set flashdata
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your account has been created, please check your email to activated your account!</div>');
			// Redirect to login page
			redirect('auth');
		}
	}

	public function login()
	{
		// Set validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
			'required' => '%s field is required!',
			'valid_email' => '%s must be valid email!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required', [
			'required' => '%s field is required!'
		]);

		// Check validation
		if ($this->form_validation->run() == false) {
			// If validation fail, back to login page
			$this->index();
		} else {
			// If validation success, call _login function
			$this->_login();
			// Redirect to homepage
			echo 'berhasil login';
		}
	}

	private function _login()
	{
		// Get data from user input
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Get data from database according to the email from user
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// Check the email wheater in database
		if ($user) {
			// If the email is in database, check the email is active or not
			if ($user['is_active'] == 1) {
				// If email is already activated, check the password
				if (password_verify($password, $user['password'])) {
					// If password match, set up user data
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					// Store user data to session
					$this->session->set_userdata($data);
					// redirect to homepage user
					redirect('user');
				} else {
					// If password false, give the information
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your password is wrong!</div>');
					// Redirect to login page
					redirect('auth');
				}
			} else {
				// If email is not actived yet, give the information
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your email is not activated yet, please check your email!</div>');
				// Redirect to login page
				redirect('auth');
			}
		} else {
			// If email is not registered yet, give the information
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your email is not registered yet, please register your email!</div>');
			// Redirect to login page
			redirect('auth');
		}
	}

	public function logout()
	{
		// Unset active user session
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		// Give flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You are log out!</div>');
		// Redirect to login page
		redirect('auth');
	}
}
