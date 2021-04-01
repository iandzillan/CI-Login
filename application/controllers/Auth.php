<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		Parent::__construct();
		// load Auth_model
		$this->load->model('Auth_model');
	}

	public function index()
	{
		// Check there is session or not
		if ($this->session->userdata('role_id') == 1) {
			redirect('admin');
		} else if ($this->session->userdata('role_id') == 2) {
			redirect('user');
		}
		// build page
		$data['title'] = 'Login | IDM';
		$this->load->view('auth/templates/header', $data);
		$this->load->view('auth/login');
		$this->load->view('auth/templates/footer');
	}

	public function register()
	{
		// Check there is session or not
		if ($this->session->userdata('role_id') == 1) {
			redirect('admin');
		} else if ($this->session->userdata('role_id') == 2) {
			redirect('user');
		}
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
			// Set token for verify email
			$token = base64_encode(random_bytes(32));
			// Call userToken function from Auth_model
			$this->Auth_model->userToken($token);
			// Run the send email function with argument token and which function for
			$this->_sendEmail($token, 'verify');
			// Set flashdata
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your account has been created, please check your email to activated your account!</div>');
			// Redirect to login page
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		// Load library email with the config
		$this->load->library('email');
		// Email configuration
		$config = [
			'protocol' 	=> 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'ithelpdesk.lbe@gmail.com',
			'smtp_pass' => 'Kazuma1234@',
			'smtp_port' => 465,
			'mailtype' 	=> 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n",
		];
		// initialize the cofig
		$this->email->initialize($config);
		// Set our email
		$this->email->from('ithelpdesk.lbe@gmail.com', 'IDM Web Programming');
		// Set the receiver email
		$this->email->to($this->input->post('email'));
		// Check the type of email
		if ($type == 'verify') {
			// If type email is verify, Set the link verification
			$data['verify'] = base_url('auth/verify?email=' . $this->input->post('email') . '&token=' . $token);
			// Get the template email
			$email_verify = $this->load->view('templates/email-verify', $data, true);
			//Set the subject
			$this->email->subject('User Activation');
			// Set the message
			$this->email->message($email_verify);
		}
		// Check is email sended or not
		if ($this->email->send()) {
			// If email successfully sended, return true
			return true;
		} else {
			// If email not send, print error debugger
			echo $this->email->print_debugger();
		}
	}

	public function verify()
	{
		// Run verify function from Auth_model()
		$this->Auth_model->verify();
		// Give message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been activated. Please Login!</div>');
		// Redirect to login page
		redirect('auth');
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
					// Check role of the user 
					if ($data['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}

					redirect('user');
				} else {
					// If password false, give the information
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your password is wrong!</div>');
					// Redirect to login page
					redirect('auth');
				}
			} else {
				// If email is not actived yet, give the information
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email is not activated yet, please check your email!</div>');
				// Redirect to login page
				redirect('auth');
			}
		} else {
			// If email is not registered yet, give the information
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email is not registered yet, please register your email!</div>');
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
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You are log out!</div>');
		// Redirect to login page
		redirect('auth');
	}

	public function block()
	{
		// Load User_model
		$this->load->model('User_model');
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();

		// Build page
		$data['title'] = 'Access Block';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('auth/block', $data);
		$this->load->view('templates/footer');
	}
}
