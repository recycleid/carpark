<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct() {
		parent::__construct();

			// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model("users_model","users");
	}

	
	public function index()
	{
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('user', $sess_array);
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function user_registration_show() {
		$this->load->view('register');
	}

	public function user_login_process()
	{
		$this->form_validation->set_rules('txtEmail', 'Email', 'required');
		$this->form_validation->set_rules('txtPwd', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['users'])){
				redirect(base_url().'index');
				} else {
				$this->load->view('login');
			}
		} else {


			$email = $this->input->post('txtEmail');
			$pwd = $this->input->post('txtPwd');

			$sData = $this->users->get_user($email, $pwd);

			if (count($sData) > 0) {
				$session_data = array(
					'id' => $sData[0]["userID"],
					'name' => $sData[0]["userName"],
					'email' => $sData[0]["userEmail"],
					'role' => $sData[0]["userRole"],
				);

				$this->session->set_userdata('user', $session_data);
				redirect(base_url().'index');

			} else {
				$this->load->view('login');
			}


		}


	}
}
