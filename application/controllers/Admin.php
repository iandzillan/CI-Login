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
		// Load Role_model
		$this->load->model('Role_model');
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

	public function role()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Get data role from getrole function in Role_model
		$data['roles'] = $this->Role_model->getRole();

		// Build page
		$data['title'] = 'Manage Role';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function addRole()
	{
		// Set the validation
		$this->form_validation->set_rules('role', 'role', 'required');
		// Check teh validation
		if ($this->form_validation->run() == false) {
			// If validation fail, show the modal
			$data['modal_show'] = "$('#modal-fade').modal('show')";
			// Get data user from getUserLogin function in User_model
			$data['user'] = $this->User_model->getUserLogin();
			// Get data menu from getMenu function in User_model
			$data['sidebar_menus'] = $this->User_model->getMenu();
			// Get data role from getrole function in Role_model
			$data['roles'] = $this->Role_model->getRole();

			// Build page
			$data['title'] = 'Manage Role';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer', $data);
		} else {
			// If validation success, call add method from Role_model
			$this->Role_model->add();
			// Give flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Role successfully added!</div>');
			// Redirect admin/role
			redirect('admin/role');
		}
	}

	public function deleteRole($id)
	{
		// Call delete function from Role_model
		$this->Role_model->delete($id);
		// Give flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role successfully deleted!</div>');
		// Redirect admin/role
		redirect('admin/role');
	}

	public function roleAccess($id)
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Get data role according id from getRoleById() function 
		$data['role'] = $this->Role_model->getRoleByid($id);
		// Get all data menu from getAllMenu() function
		$data['menus'] = $this->Role_model->getAllMenu();

		// Build page
		$data['title'] = 'Manage Role';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		// Class changeAccess() funtion from Role_model
		$this->Role_model->changeAccess();
		// Give flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role access successfully changed!</div>');
	}
}
