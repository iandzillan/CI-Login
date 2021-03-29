<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		// Call the parent class of construct
		Parent::__construct();
		// Load Menu_model
		$this->load->model('Menu_model');
		// Load User_model
		$this->load->model('User_model');
	}
	public function index()
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Get data menu from Menu_model
		$data['menus'] = $this->Menu_model->getAllMenu();
		// Build page
		$data['title'] = 'Manage Menu';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/menu/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function add()
	{
		// Set validation
		$this->form_validation->set_rules('menu', 'Menu', 'required', [
			'required' => 'New menu failed to add, please fill the field!'
		]);

		// Check Validation
		if ($this->form_validation->run() == false) {
			// If validation fail, show modal
			$data['modal_show'] = "$('#modal-fade').modal('show');";
			// Get data user from getUserLogin function in User_model
			$data['user'] = $this->User_model->getUserLogin();
			// Get data menu from getMenu function in User_model
			$data['sidebar_menus'] = $this->User_model->getMenu();
			// Get data menu from Menu_model
			$data['menus'] = $this->Menu_model->getAllMenu();
			// Build page
			$data['title'] = 'Manage Menu';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/menu/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			// If validation success, call addMenu() function from Menu_model
			$this->Menu_model->addMenu();
			// Give flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu successfully added!</div>');
			// Redirect to menu index
			redirect('menu');
		}
	}

	public function edit($id)
	{
		// Get data user from getUserLogin function in User_model
		$data['user'] = $this->User_model->getUserLogin();
		// Get data menu from getMenu function in User_model
		$data['sidebar_menus'] = $this->User_model->getMenu();
		// Get data menu by id
		$data['menu'] = $this->Menu_model->getId($id);
		// Build the page
		$data['title'] = 'Edit Menu';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/menu/edit', $data);
		$this->load->view('templates/footer');
	}

	public function update($id)
	{
		// Set validation
		$this->form_validation->set_rules('menu', 'Menu', 'required', [
			'required' => '%s field is required!'
		]);
		// Check validation
		if ($this->form_validation->run() == false) {
			// If validation fail, back to edit page
			return $this->edit($id);
		} else {
			// If validation success, run update function from Menu Model
			$this->Menu_model->update($id);
			// Set flash message
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu successfully updated!</div>');
			// Redirect to menu index
			redirect('menu');
		}
	}

	public function delete($id)
	{
		// Run delete function from Menu_model
		$this->Menu_model->delete($id);
		// Set flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu successfully deleted!</div>');
		// Redirect menu index
		redirect('menu');
	}
}
