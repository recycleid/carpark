<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class park extends CI_Controller {

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
		$this->load->model("parks_model","parks");
	}

	public function index()
	{

		$headerInfo = array(
			'header' => 'ที่จอดรถ',
			'headerDes' => 'จัดการข้อมูลที่จอดรถ',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'PARK',
		);

		$zone = $this->parks->get_zone();
		$park = $this->parks->get_park();

		$var = array(
			'zone' => $zone,
			'park' => $park,
		);




		$this->load->view('header', $headerInfo);
		$this->load->view('park', $var);
		$this->load->view('footer');
	}

	public function zoneadd() {

		$zone = $this->input->post("txtnewzone");

		


		$checkdata = $this->parks->get_zoneByzone($zone);

		if (count($checkdata) == 0) {
				$var = array(
					'zone' => $zone
				);
				$this->parks->new_Zone($var);

				redirect(base_url().'park');
		} else {
			redirect(base_url().'park');
		}



	}

	public function parkadd() {

		$zone = $this->input->post("zone");
		$numpark = $this->input->post("numpark");

		
		if ($numpark > 0) {
			$checkdata = $this->parks->getparkByzone($zone);

			$maxpark = 0;

			if (count($checkdata) > 0) {
				$maxpark = $checkdata[0]["number"];
			}

			$this->parks->new_Park($zone,$maxpark,$numpark);

			redirect(base_url().'park');

		} else {
			redirect(base_url().'park');
		}


	}

	public function changeState() {

		$id = $this->input->get("id");
		$state = $this->input->get("state");

		if ($id != "") {

			$this->parks->edit_park($id,$state);
			
		}
		



	}


}
