<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}
}
