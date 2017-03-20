<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class memberType extends CI_Controller {

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

		$data = $this->member->get_memtype();

		$var = array(
			'data' => $data
		);

		$headerInfo = array(
			'header' => 'Member',
			'headerDes' => 'จัดการข้อมูลประเภทสมาชิก',
			'fBredcum' => 'หน้าแรก',
			'lBredcum' => 'memberType',
		);


		$this->load->view('header', $headerInfo);
		$this->load->view('membertype', $var);
		$this->load->view('footer');
	}

	public function add()
	{
		$memtype = $this->input->post("txtmemberType");
		$H1 = $this->input->post("txth1");
		$H2 = $this->input->post("txth2");
		$H3 = $this->input->post("txth3");
		$H4 = $this->input->post("txth4");
		$H5 = $this->input->post("txth5");
		$H6 = $this->input->post("txth6");
		$H7 = $this->input->post("txth7");
		$H8 = $this->input->post("txth8");
		$Hmore = $this->input->post("txthmore8");

		$checker = $this->member->check_memtype($memtype);

		if (count($checker) == 0) {
			$var = array(
				'memtype' => $memtype,
				'H1' => $H1,
				'H2' => $H2,
				'H3' => $H3,
				'H4' => $H4,
				'H5' => $H5,
				'H6' => $H6,
				'H7' => $H7,
				'H8' => $H8,
				'Hmore' => $Hmore
			);
			$this->member->new_Memtype($var);
		}

		redirect(base_url().'memberType');
	}

	public function find_memtype()
	{
		$id = $this->input->post("id");

		$data = $this->member->check_memtypeByid($id);

		$var = array(
			'memtype' => $data[0]["memtype"],
			'H1' => $data[0]["H1"],
			'H2' => $data[0]["H2"],
			'H3' => $data[0]["H3"],
			'H4' => $data[0]["H4"],
			'H5' => $data[0]["H5"],
			'H6' => $data[0]["H6"],
			'H7' => $data[0]["H7"],
			'H8' => $data[0]["H8"],
			'Hmore' => $data[0]["Hmore"]
		);

		echo json_encode( $var );

	}

	public function edit()
	{
		$id = $this->input->post("editIDhid");
		$memtype = $this->input->post("edittxtmemberType");
		$H1 = $this->input->post("edittxth1");
		$H2 = $this->input->post("edittxth2");
		$H3 = $this->input->post("edittxth3");
		$H4 = $this->input->post("edittxth4");
		$H5 = $this->input->post("edittxth5");
		$H6 = $this->input->post("edittxth6");
		$H7 = $this->input->post("edittxth7");
		$H8 = $this->input->post("edittxth8");
		$Hmore = $this->input->post("edittxthmore8");

		$checker = $this->member->check_memtypeBytypeid($memtype,$id);

		if (count($checker) == 0) {
			$var = array(
				'memtype' => $memtype,
				'H1' => $H1,
				'H2' => $H2,
				'H3' => $H3,
				'H4' => $H4,
				'H5' => $H5,
				'H6' => $H6,
				'H7' => $H7,
				'H8' => $H8,
				'Hmore' => $Hmore
			);
			$this->member->edit_Memtype($var,$id);
		}
		redirect(base_url().'memberType');
	}

	public function find_priority()
	{
		$id = $this->input->post("id");

		$data = $this->member->get_priority($id);

		$str = "<center><table class='table table-bordered' style='width:50%;'>
			<tr>
				<th align='center'></th>
				<th align='center'>zone</th>
				<th align='center'></th>
			</tr>";

		for ($i=0; $i<count($data); $i++) {
				$str .= "<tr>";

				if ($i==0) {
					$str .= "<td></td>";
				} else {
					$str .= "<td align='center'><a style='cursor:pointer;color:blue' onclick=promotepriority('".$data[$i]["zone"]."','".$data[$i]["memtypeID"]."','".$data[$i]["priority"]."')><span class='glyphicon glyphicon-upload' aria-hidden='true'></span></a></td>";
				}
				$str .= "<td align='center'>".$data[$i]["zone"]."</td>";
				$str .= "<td align='center'><a style='cursor:pointer;color:red;' onclick=delpriority('".$data[$i]["zone"]."','".$data[$i]["memtypeID"]."')><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
				$str .= "</tr>";
		}

		$str .= "</table></center><BR>";

		echo $str;
	}

	public function find_zone()
	{
		$id = $this->input->post("id");

		$data = $this->member->get_zonePriority($id);

		$str = "<select class='form-control' id='selzone' name='selzone'>";

		for ($i=0; $i<count($data); $i++) {
				$str .= "<option value='".$data[$i]["zone"]."'>".$data[$i]["zone"]."</option>";
		}

		$str .= "</select>";

		echo $str;
	}

	public function new_priority()
	{
		$id = $this->input->post("id");
		$zone = $this->input->post("sel");
		$data = $this->member->get_zonePrioritynumber($id);
		$priority = $data[0]["p"]+1;

			$var = array(
				'zone' => $zone,
				'memtypeID' => $id,
				'priority' => $priority
			);
			$this->member->create_priority($var);


	}

	public function del_priority()
	{
		$id = $this->input->post("id");
		$zone = $this->input->post("sel");

		$this->member->bye_priority($id,$zone);
	}

	public function promote_priority()
	{
		$id = $this->input->post("id");
		$zone = $this->input->post("sel");
		$priority = $this->input->post("priority");

		$this->member->levelup_priority($id,$zone,$priority);
	}



}
