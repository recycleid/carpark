<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class priority extends CI_Controller {

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

		$headerInfo = array(
			'header' => 'ลำดับที่จอด',
			'headerDes' => 'จัดการลำดับการจัดที่จอด',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'priority',
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('priority');
		$this->load->view('footer');
	}


}
