<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

			// Load form helper library
		$this->load->helper('form');

		$this->load->helper('url');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model("users_model","users");

	}

	public function index()
	{

		$data = $this->users->get_Alluser();

		$var = array(
			'data' => $data
		);

		$headerInfo = array(
			'header' => 'ADMIN',
			'headerDes' => 'จัดการข้อมูลผู้ใช้',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'ADMIN',
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('admin', $var);
		$this->load->view('footer');
	}

	public function add() {

		$email = $this->input->post("txtEmail");

		


		$chkuser = $this->users->get_userByemail($email);

		if (count($chkuser) == 0) {
				$var = array(
					'userEmail' => $email,
					'userPassword' => $this->input->post("password"),
					'useridCard' => $this->input->post("txtcid"),
					'userName' => $this->input->post("txtfname"),
					'userNickname' => $this->input->post("txtNname"),
					'userTelephone' => $this->input->post("txtEmail"),
					'userRole' => $this->input->post("selrole")
				);
				$this->users->new_User($var);

				redirect(base_url().'admin');
		} else {
			redirect(base_url().'admin');
		}



	}

	public function edit() {

		$id = $this->input->post("editid");
		$email = $this->input->post("edittxtEmail");

		if (empty($id))
        {
            show_404();
        }


		$chkuser = $this->users->get_userByemailedit($email,$id);

		if (count($chkuser) == 0) {
				$var = array(
					'userEmail' => $email,
					'userPassword' => $this->input->post("editpassword"),
					'useridCard' => $this->input->post("edittxtcid"),
					'userName' => $this->input->post("edittxtfname"),
					'userNickname' => $this->input->post("edittxtNname"),
					'userTelephone' => $this->input->post("edittxttelephone"),
					'userRole' => $this->input->post("editselrole")
				);
				$this->users->edit_user($var,$id);

				redirect(base_url().'admin');
		} else {
			redirect(base_url().'admin');
		}



	}


	public function delete($id) {
        
        if (empty($id))
        {
            show_404();
        }

		$this->users->delete_user($id);
		redirect(base_url().'admin');

	}


}
