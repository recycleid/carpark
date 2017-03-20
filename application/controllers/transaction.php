<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaction extends CI_Controller {

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
		$this->load->model("transactions_model","transac");
	}

	public function index()
	{

		$headerInfo = array(
			'header' => 'รถเข้า-ออก',
			'headerDes' => 'คีย์รถเข้า-ออก',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'transaction',
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('transaction');
		$this->load->view('footer');
	}

	public function IN()
	{

		$headerInfo = array(
			'header' => 'รถเข้า',
			'headerDes' => 'คีย์รถเข้า',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'transaction',
		);



		$var = array(
			'state' => 'IN',
			'parkstate' => $this->transac->get_stateparking()
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('transaction', $var);
		$this->load->view('footer');
	}

	public function OUT()
	{

		$headerInfo = array(
			'header' => 'รถออก',
			'headerDes' => 'คีย์รถออก',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'transaction',
		);

		$var = array(
		'state' => 'OUT',
		'parkstate' => 'False'
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('transaction', $var);
		$this->load->view('footer');
	}

	public function controltransac() {

		$keyid = $this->session->userdata['user']['id'];

		$register = $this->input->post("register");
		//$memberid = $this->input->post("memberid");

		//$checkdata = $this->transac->get_transacByregis($register);

		//if (count($checkdata) == 0) {

			$based64Image=substr($_POST['inputdata'], strpos($_POST['inputdata'], ',')+1);

		    $image = imagecreatefromstring(base64_decode($based64Image));

		    $fileName='';
		    if($image != false)
		    {
		        $fileName='./image/transaction/'.time().'.png';
		        	if(!imagepng($image, $fileName))
		        	{
						//          fail;
		        	}
		    }
		    else
		    {
					//          fail;
		    }




			$checkmember = $this->transac->get_memberID($register);

			if (count($checkmember) > 0) {

				$memberid = $checkmember[0]["memberID"];
				$memtype = $checkmember[0]["memType"];
				$memdesc = $checkmember[0]["memDesc"];
			} else {
				$memberid = 0;
				$memtype = 0;
				$memdesc = "General";
			}

			$parkingID = $this->transac->get_emptyparking($register,$memtype);

			$tin = date("Y-m-d H:i:s");

			$var = array(
						'tranIN' => $tin,
						'keymanIN' => $keyid,
						'memID' => $memberid,
						'carRegis' => $register,
						'pathin' => $fileName,
						'parkPosition' => $parkingID
			);

			$this->transac->new_transaction($var);

			if ($memberid == 0) {
				$this->transac->update_park($parkingID,"0");
			}

			$parkingID = $this->transac->get_parkbyID($parkingID);

			$parkstate = $this->transac->get_stateparking();

			$var = array(
				'alert' => "",
				'timeIN' => $tin,
				'register' => $register,
				'parkPosition' => $parkingID,
				'parkstate' => $parkstate
			);

			$transac = $this->transac->get_transacByID($register,$tin);

			// printer
			//$this->printIn($register,$transac,$memdesc,$parkingID);


			echo json_encode( $var );


		/*} else {
			$var = array(
				'alert' => "มีทะเบียนนี้จอดอยู่",
				'timeIN' => "",
				'register' => "",
				'parkPosition' => ""
			);

			echo json_encode( $var );
		}*/



	}


	public function controltranOUT() {


		$keyid = $this->session->userdata['user']['id'];

		$TID = $this->input->post("register");
		//$memberid = $this->input->post("memberid");

		$checkdata = $this->transac->get_transacByTID($TID);

		if (count($checkdata) > 0) {
			$based64Image=substr($_POST['inputdata'], strpos($_POST['inputdata'], ',')+1);

		    $image = imagecreatefromstring(base64_decode($based64Image));

		    $fileName='';
		    if($image != false)
		    {
		        $fileName='./image/transaction/'.time().'.png';
		        	if(!imagepng($image, $fileName))
		        	{
						//          fail;
		        	}
		    }
		    else
		    {
					//          fail;
		    }


		    $transacID = $checkdata[0]["ID"];
				$register = $checkdata[0]["carRegis"];
		    $memberid = $checkdata[0]["memID"];
				if ($memberid == 0) {
					$membertype = "0";
				} else {
					$membertype = $checkdata[0]["memType"];
				}
		    $tin = $checkdata[0]["tranIN"];
		    $pathin = $checkdata[0]["pathin"];
		    $parkingIDP = $checkdata[0]["IDP"];
		    $parkingID = $checkdata[0]["parkPosition"];

			$tout = date("Y-m-d H:i:s");

			$parktime = $this->DateTimeDiff($tin,$tout);
			//$parktime = 0;

			$perhour = $this->transac->get_perhour($membertype);
			//$perhour = 20;

			$timeprice = ceil($parktime);
			$price = 0;
			$temp = $timeprice - 1;
			for ($i=1; $i<$timeprice; $i++) {
				if ($i > 8) {
					$price += 1 * $perhour[0]["Hmore"];
				} else {
					$price += 1 * $perhour[0]["H".$i];
				}
				$temp = $temp - 1;
			}

			//$price = $parktime;

			if ($this->input->post("p") == "1") {
				$price	= 0;
			}

			$var = array(
						'tranOUT' => $tout,
						'keymanOUT' => $keyid,
						'pathout' => $fileName,
						'timepark' => $parktime,
						'price' => $price
			);

			$this->transac->update_transaction($transacID,$var);

			if ($memberid == 0) {
				$this->transac->update_park($parkingIDP,"1");
			}

			$var = array(
				'alert' => "",
				'timeIN' => $tin,
				'pathin' => $pathin,
				'timeOUT' => $tout,
				'pathout' => $fileName,
				'price' => $price,
				'register' => $register,
				'parkPosition' => $parkingID
			);

			echo json_encode( $var );


		} else {
			$var = array(
				'alert' => "ไม่มีรถทะเบียนนี้ในที่จอด",
				'timeIN' => "",
				'pathin' => "",
				'timeOUT' => "",
				'pathout' => "",
				'price' => "",
				'register' => "",
				'parkPosition' => ""
			);

			echo json_encode( $var );
		}


	}

	function DateTimeDiff($strDateTime1,$strDateTime2)
	{
		return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 );
	}

	function printIn($regis,$transac,$type,$parking)
	{
		//$regis = "6038";
		//$transac = "1";
		//$type = "General";
		//$parking = "A1";

		try {
		  $this->load->library('ReceiptPrint');
		  $this->receiptprint->connect('Receipt');
		  $this->receiptprint->print_IN_receipt($regis,$transac,$type,$parking);
		} catch (Exception $e) {
		  echo $e->getMessage();
		  $this->receiptprint->close_after_exception();
		}
	}


}
