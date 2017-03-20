<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class member extends CI_Controller {

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
		$this->load->model("members_model","member");
	}

	public function index()
	{

		$headerInfo = array(
			'header' => 'MEMBER',
			'headerDes' => 'จัดการข้อมูลสมาชิก',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'MEMBER',
		);

		$memtype = $this->member->get_memtype();
		$data = $this->member->get_member();

		$var = array(
			'memtype' => $memtype,
			'data' => $data
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('member', $var);
		$this->load->view('footer');
	}

	public function memtypeAdd() {

		$member = $this->input->post("txtnewmemtype");
		$price = $this->input->post("txtnewmemtypeprice");





		$checkdata = $this->member->get_typeBymember($member);

		if (($member != "") && ($price != "")) {

			if (count($checkdata) == 0) {
					$var = array(
						'memtype' => $member,
						'priceperhour' => $price
					);
					$this->member->new_Memtype($var);

					redirect(base_url().'member');
			} else {
				redirect(base_url().'member');
			}

		} else {
			redirect(base_url().'member');
		}





	}

	public function controlmember() {

		$id = $this->input->post("txtid");

		$type = $this->input->post("memtype");
		$name = $this->input->post("txtmemname");
		$idcard = $this->input->post("txtmemidcard");
		$idemp = $this->input->post("txtmemidemp");
		$email = $this->input->post("txtmememail");
		$tel1 = $this->input->post("txtmemtel1");
		$tel2 = $this->input->post("txtmemtel2");


		if ($id == "") {


			$var = array(
				'memType' => $type,
				'memName' => $name,
				'memIdcard' => $idcard,
				'memIdemp' => $idemp,
				'memEmail' => $email,
				'memTel1' => $tel1,
				'memTel2' => $tel2
			);

			$this->member->new_Member($var);

			redirect(base_url().'member');


		} else {

			$var = array(
				'memType' => $type,
				'memName' => $name,
				'memIdcard' => $idcard,
				'memIdemp' => $idemp,
				'memEmail' => $email,
				'memTel1' => $tel1,
				'memTel2' => $tel2
			);

			$this->member->update_Member($var,$id);

			redirect(base_url().'member');
		}


	}

	public function loadmember() {
		$id = $this->input->post("id");

		$data = $this->member->load_Member($id);

		$var = "";
		if (count($data) > 0) {

			$var = array(
				'memID' => $data[0]["memID"],
				'memType' => $data[0]["memType"],
				'memName' => $data[0]["memName"],
				'memIdcard' => $data[0]["memIdcard"],
				'memIdemp' => $data[0]["memIdemp"],
				'memEmail' => $data[0]["memEmail"],
				'memTel1' => $data[0]["memTel1"],
				'memTel2' => $data[0]["memTel2"]
			);

		}

		echo json_encode( $var );



	}

	public function loadmembercar() {
		$id = $this->input->post("id");

		$data = $this->member->load_Membercar($id);

		$str = "";

		$str .= "<table class='table table-bordered table-striped'>";
		$str .= "	<thead>";
		$str .= "		<tr>";
		$str .= "		<th>ตำแหน่ง</th>";
		$str .= "		<th>ทะเบียน</th>";
		$str .= "		<th></th>";
		$str .= "	</thead>";
		$str .= "	<tbody>";

		for ($i=0;$i<count($data); $i++) {
			$str .= "<tr>";
			$str .= "	<td>".$data[$i]["parking"]."</td>";
			$str .= "	<td>".$data[$i]["carRegistration"]."</td>";

			$str .= "	<td><button type='button' class='btn btn-danger btn-xs' onclick=delparking('".$data[$i]["ID"]."','".$data[$i]["IDS"]."');><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> ลบ</button></td>";
			$str .= "</tr>";

		}

		$str .= "	</tbody>";
		$str .= "</table>";


		echo $str;

	}

	public function loadpark() {
		$id = $this->input->post("id");

		$data = $this->member->load_parking();

		$str = "";

		$str .= "<select id='selparking' name='selparking' class='form-control' >";
		$str .= "<option value=''></option>";
		for ($i=0;$i<count($data); $i++) {
			$str .= "<option value='".$data[$i]["ID"]."'>".$data[$i]["parking"]."</option>";
		}

		$str .= "</select>";

		echo $str;

	}

	public function saveregis() {

		$id = $this->input->post("id");
		$parking = $this->input->post("parking");
		$register = $this->input->post("register");
		$prov = $this->input->post("prov");
		$color = $this->input->post("color");


		$checkdata = $this->member->get_registerByregis($register);


			if (count($checkdata) == 0) {
					$var = array(
						'memberID' => $id,
						'carRegistration' => $register,
						'parkPosition' => $parking,
						'province' => $prov,
						'color' => $color,
					);
					$this->member->new_parking($var);

					if ($parking != "") {
						$var = array(
							'status' => '2'
						);

						$this->member->update_Park($parking,$var);
					}



					echo "บันทึกเสร็จสิ้น";
			} else {
				echo "ทะเบียนซ้ำกรุณาลองใหม่ !!";
			}


	}

	public function delregis() {
		$id = $this->input->post("id");
		$parking = $this->input->post("parking");


		$this->member->del_parking($id);

		$var = array(
			'status' => '1'
		);

		$this->member->update_Park($parking,$var);


	}

	public function loadtransaction() {
		$id = $this->input->post("id");

		$data = $this->member->get_transactionByID($id);

		$str = "";

		$str .= "<table id='datatabletransac' class='table table-bordered table-striped'>";
		$str .= "	<thead>";
		$str .= "		<tr>";
		$str .= "		<th>เข้า</th>";
		$str .= "		<th>ผู้บันทึกเข้า</th>";
		$str .= "		<th>ออก</th>";
		$str .= "		<th>ผู้บันทึกออก</th>";
		$str .= "		<th>เวลา (นาที)</th>";
		$str .= "		<th>ทะเบียน</th>";
		$str .= "		<th>ตำแหน่ง</th>";
		$str .= "		<th>ราคา</th>";
		$str .= "	</thead>";
		$str .= "	<tbody>";

		for ($i=0;$i<count($data); $i++) {
			$str .= "<tr>";
			$str .= "	<td>".$data[$i]["tranIN"]."</td>";
			$str .= "	<td>".$data[$i]["keymanIN"]."</td>";
			$str .= "	<td>".$data[$i]["tranOUT"]."</td>";
			$str .= "	<td>".$data[$i]["keymanOUT"]."</td>";
			$str .= "	<td>".$data[$i]["timepark"]."</td>";
			$str .= "	<td>".$data[$i]["carRegis"]."</td>";
			$str .= "	<td>".$data[$i]["parkPosition"]."</td>";
			$str .= "	<td>".$data[$i]["price"]."</td>";

			$str .= "</tr>";

		}

		$str .= "	</tbody>";
		$str .= "</table>";


		echo $str;


	}

	public function print_member($id)
	{

			$data = $this->member->get_memberCard($id);
			$var = array(
				'data' => $data
			);
			$this->load->view('membercard', $var);
	}






}
