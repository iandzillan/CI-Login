<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
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
}
