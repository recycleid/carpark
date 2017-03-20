<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class carpark extends CI_Controller {

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

		$this->load->model("reports_model","reports");

		
	}

	public function index()
	{

		$headerInfo = array(
			'header' => 'หน้าแรก',
			'headerDes' => 'ข้อมูลทั่วไป',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'หน้าแรก',
		);

		$var = array(
			'incomeToday' => $this->reports->get_income(date("Y-m-d")),
			'incomeTodayD1' => $this->reports->get_income(date("Y-m-d", strtotime("-1 days"))),
			'incomeTodayD2' => $this->reports->get_income(date("Y-m-d", strtotime("-2 days"))),
			'incomeTodayD3' => $this->reports->get_income(date("Y-m-d", strtotime("-3 days"))),
			'incomeTodayD4' => $this->reports->get_income(date("Y-m-d", strtotime("-4 days"))),
			'incomeTodayD5' => $this->reports->get_income(date("Y-m-d", strtotime("-5 days"))),
			'incomeTodayD6' => $this->reports->get_income(date("Y-m-d", strtotime("-6 days"))),
			'incomeTodayD7' => $this->reports->get_income(date("Y-m-d", strtotime("-7 days"))),
			'parkempty' => $this->reports->get_parkStatus("1"),
			'parkUsed' => $this->reports->get_parkStatus("0"),
			'parkReserv' => $this->reports->get_parkStatus("2"),
			'parkList' => $this->reports->get_parklist(),
			'transacList' => $this->reports->get_transaction()
		);




		$this->load->view('header', $headerInfo);
		$this->load->view('homerun', $var);
		$this->load->view('footer');
	}


}
