<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{
	public function __construct()
	{
		// Call __construct class from parent class
		Parent::__construct();
		// load submenu_model
		$this->load->model('Submenu_model');
		// Load user_model
		$this->load->model('User_model');
	}
	public function index()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Get data all sub menu
		$data['sub_menus'] = $this->Submenu_model->getSubmenu();
		// Get data menu from dropdownMenu in Submenu_model
		$data['menu_id'] = $this->Submenu_model->dropdownMenu();
		// Build page
		$data['title'] = 'Manage Sub Menu';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/submenu/index', $data);
		$this->load->view('templates/footer');
	}
}
