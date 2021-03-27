<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		// Call __cunstruct funtion from parent class 
		Parent::__construct();
		// Load User_model
		$this->load->model('User_model');
	}

	public function index()
	{
		// Get data user login
		$data['user'] = $this->User_model->getUserLogin();
		// Build page
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}
}
