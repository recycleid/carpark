<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "ADMIN")) {
    header("location: ".base_url()."login");
}
?>

<link rel="stylesheet" href="plugins/iCheck/all.css">


<div class="row">
  <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สมาชิก</h3>



              <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mySearch"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>

              <button type="button" class="btn btn-box-tool" id="memberNew"  name="memberNew"><i class="glyphicon glyphicon-plus"></i> สร้างสมาชิกใหม่</button>
              </div>


            </div>

            <?php echo form_open('member/controlmember',array('class' => 'form-horizontal'));?>
            <div class="box-body">

            	<div class="row">

            		<div class="col-md-12">
            			<div class="form-group">
            				<label for="txtid" class="col-sm-2 control-label">Member ID</label>
            				<div class="col-sm-3">
            					<input type="text" class="form-control" id="txtid" name="txtid" placeholder="รหัสสมาชิก" readonly  data-toggle="modal" data-target="#mySearch">
            				</div>

            				<div class="col-sm-3">
            					<select class="form-control" id="memtype" name="memtype">
                        <?php for ($i=1;$i<count($memtype); $i++) { ?>
            						  <option value="<?=$memtype[$i]["ID"];?>"><?=$memtype[$i]["memtype"];?></option>
                        <?php } ?>
            					</select>
            				</div>

            				<div class="col-sm-2">
            					<button type="submit" class="btn btn-primary">บันทึก</button>
            				</div>
            			</div>
            			<HR>
            		</div>

            	</div>



            	<div class="row">


		        	<div class="col-md-12">

		        		<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="ชื่อ-นามสกุล" id="txtmemname"  name="txtmemname" required>
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">รหัสบัตรประชาชน</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="รหัสบัตรประชาชน 13 หลัก" id="txtmemidcard"  name="txtmemidcard" required maxlength="13">
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">รหัสพนักงาน</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="รหัสพนักงาน" id="txtmemidemp"  name="txtmemidemp">
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">E-mail</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="E-mail" id="txtmememail"  name="txtmememail">
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">เบอร์โทรศัพท์ 1</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="เบอร์โทรศัพท์ 1" id="txtmemtel1"  name="txtmemtel1">
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">เบอร์โทรศัพท์ 2</label>
            				<div class="col-sm-6">
            					<input type="text" class="form-control" placeholder="เบอร์โทรศัพท์ 2" id="txtmemtel2"  name="txtmemtel2">
            				</div>

                    <div class="col-sm-3">
                        <button type="button" class="btn btn-success" onclick="print_member();">บัตรสมาชิก</button>
            				</div>

            			</div>


		        	</div>

            	</div>



       		</div>
       		<?php echo form_close();?>






        </div>


  </div>




  <div class="col-md-4">


  			<div class="box box-danger">
            	<div class="box-header with-border">
              		<h3 class="box-title">ระบุที่จอดรถ</h3>
              	</div>

              	<form class="form-horizontal">
              	<div class="box-body">


              		<div class="row">

	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<label for="#" class="col-sm-4 control-label">ตำแหน่ง</label>
	            				<div class="col-sm-6" id="divparking" name="divparking">
	            					<h4>กรุณาเลือกสมาชิก</h4>
	            				</div>
	            			</div>

	            			<div class="form-group">
	            				<label for="#" class="col-sm-4 control-label">ทะเบียน</label>
	            				<div class="col-sm-6">
	            					<input type="text" class="form-control" placeholder="ทะเบียน" id="txtregister" name="txtregister" required>
	            				</div>
	            			</div>

                    <div class="form-group">
	            				<label for="#" class="col-sm-4 control-label">จังหวัด</label>
	            				<div class="col-sm-6">
	            					<select id='txtregisprov' name='txtregisprov' class='form-control' >
                          <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                          <option value="กระบี่">กระบี่ </option>
                          <option value="กาญจนบุรี">กาญจนบุรี </option>
                          <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                          <option value="กำแพงเพชร">กำแพงเพชร </option>
                          <option value="ขอนแก่น">ขอนแก่น</option>
                          <option value="จันทบุรี">จันทบุรี</option>
                          <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                          <option value="ชัยนาท">ชัยนาท </option>
                          <option value="ชัยภูมิ">ชัยภูมิ </option>
                          <option value="ชุมพร">ชุมพร </option>
                          <option value="ชลบุรี">ชลบุรี </option>
                          <option value="เชียงใหม่">เชียงใหม่ </option>
                          <option value="เชียงราย">เชียงราย </option>
                          <option value="ตรัง">ตรัง </option>
                          <option value="ตราด">ตราด </option>
                          <option value="ตาก">ตาก </option>
                          <option value="นครนายก">นครนายก </option>
                          <option value="นครปฐม">นครปฐม </option>
                          <option value="นครพนม">นครพนม </option>
                          <option value="นครราชสีมา">นครราชสีมา </option>
                          <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                          <option value="นครสวรรค์">นครสวรรค์ </option>
                          <option value="นราธิวาส">นราธิวาส </option>
                          <option value="น่าน">น่าน </option>
                          <option value="นนทบุรี">นนทบุรี </option>
                          <option value="บึงกาฬ">บึงกาฬ</option>
                          <option value="บุรีรัมย์">บุรีรัมย์</option>
                          <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                          <option value="ปทุมธานี">ปทุมธานี </option>
                          <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                          <option value="ปัตตานี">ปัตตานี </option>
                          <option value="พะเยา">พะเยา </option>
                          <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                          <option value="พังงา">พังงา </option>
                          <option value="พิจิตร">พิจิตร </option>
                          <option value="พิษณุโลก">พิษณุโลก </option>
                          <option value="เพชรบุรี">เพชรบุรี </option>
                          <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                          <option value="แพร่">แพร่ </option>
                          <option value="พัทลุง">พัทลุง </option>
                          <option value="ภูเก็ต">ภูเก็ต </option>
                          <option value="มหาสารคาม">มหาสารคาม </option>
                          <option value="มุกดาหาร">มุกดาหาร </option>
                          <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                          <option value="ยโสธร">ยโสธร </option>
                          <option value="ยะลา">ยะลา </option>
                          <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                          <option value="ระนอง">ระนอง </option>
                          <option value="ระยอง">ระยอง </option>
                          <option value="ราชบุรี">ราชบุรี</option>
                          <option value="ลพบุรี">ลพบุรี </option>
                          <option value="ลำปาง">ลำปาง </option>
                          <option value="ลำพูน">ลำพูน </option>
                          <option value="เลย">เลย </option>
                          <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                          <option value="สกลนคร">สกลนคร</option>
                          <option value="สงขลา">สงขลา </option>
                          <option value="สมุทรสาคร">สมุทรสาคร </option>
                          <option value="สมุทรปราการ">สมุทรปราการ </option>
                          <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                          <option value="สระแก้ว">สระแก้ว </option>
                          <option value="สระบุรี">สระบุรี </option>
                          <option value="สิงห์บุรี">สิงห์บุรี </option>
                          <option value="สุโขทัย">สุโขทัย </option>
                          <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                          <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                          <option value="สุรินทร์">สุรินทร์ </option>
                          <option value="สตูล">สตูล </option>
                          <option value="หนองคาย">หนองคาย </option>
                          <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                          <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                          <option value="อุดรธานี">อุดรธานี </option>
                          <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                          <option value="อุทัยธานี">อุทัยธานี </option>
                          <option value="อุบลราชธานี">อุบลราชธานี</option>
                          <option value="อ่างทอง">อ่างทอง </option>
                        </select>
	            				</div>
	            			</div>

                    <div class="form-group">
	            				<label for="#" class="col-sm-4 control-label">สี</label>
	            				<div class="col-sm-6">
	            					<input type="text" class="form-control" placeholder="สี" id="txtregiscolor" name="txtregiscolor" required>
	            				</div>
	            			</div>

	            			<div class="form-group">
	            				<label for="#" class="col-sm-2 control-label"></label>
	            				<div class="col-sm-5">

	            				</div>
	            				<div class="col-sm-3">
	            					<button type="button" class="btn btn-primary" id="btnparking" name="btnparking" disabled onclick="saveParking();">บันทึก</button>
	            				</div>
	            			</div>

                    <div id="parktable"  name="parktable">
	            			<table id="datatable1" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>ตำแหน่ง</th>
				                  <th>ทะเบียน</th>
				                  <th></th>
				                </tr>
				                </thead>
				                <tbody>



				                </tbody>
				            </table>
                    </div>

	            		</div>

	            	</div>



              	</div>
              	</form>






            </div>


  </div>



</div>


<div class="row">
  <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลการใช้งานที่จอดรถ</h3>



            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="transactable" name="transactable">
                <h4>กรุณาเลือกสมาชิก</h4>
              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </div>
</div>



<div class="modal" id="mySearch">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">ค้นหาสมาชิก</h4>
        </div>

        <div class="modal-body">
          <div class="row table-responsive">
          <div class="col-sm-12">

           <table id="datatablesearch" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>ชื่อ</th>
                  <th>E-mail</th>
                  <th>Tel 1</th>
                  <th>Tel 2</th>
                </tr>
                </thead>
                <tbody>

                <?php for ($i=0;$i<count($data);$i++) { ?>


                  <tr>
                    <td><button type="button" class="btn btn-info btn-xs"  data-dismiss="modal" onclick="load_member('<?=$data[$i]["memID"];?>');" ><span class="glyphicon glyphicon-pencil"></span></button> <?=$data[$i]["memID"];?></td>
                    <td><?=$data[$i]["memName"];?></td>
                    <td><?=$data[$i]["memEmail"];?></td>
                    <td><?=$data[$i]["memTel1"];?></td>
                    <td><?=$data[$i]["memTel2"];?></td>
                  </tr>

                <?php } ?>

                </tbody>

            </table>
          </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {

    //$('#datatable2').DataTable();

      $('#datatablesearch').DataTable();
      });

      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
      });






</script>

<script type="text/javascript" language="javascript">
function print_member(){
  var ID = $("#txtid").val();
  if (ID != "") {
    window.open("<?=site_url('member/print_member/');?>"+ID, '_blank');
  }
}

function load_member(ID){

      $.ajax( {
        url : '<?=site_url('member/loadmember');?>', // your ajax file
        type : 'post',
        data : 'id='+ID,
        success : function( resp ) {
          var member = jQuery.parseJSON( resp );
          $("#txtid").val(member.memID);
          $("#memtype").val(member.memType);
          $("#txtmemname").val(member.memName);
          $("#txtmemidcard").val(member.memIdcard);
          $("#txtmemidemp").val(member.memIdemp);
          $("#txtmememail").val(member.memEmail);
          $("#txtmemtel1").val(member.memTel1);
          $("#txtmemtel2").val(member.memTel2);

          load_membercar(ID);
        }
      });


};

function load_membercar(ID) {

        $.ajax( {
          url : '<?=site_url('member/loadpark');?>', // your ajax file
          type : 'post',
          success : function( resp ) {
            $("#divparking").html(resp);
            $("#txtregister").val("");
          }
        });

        $.ajax( {
          url : '<?=site_url('member/loadmembercar');?>', // your ajax file
          type : 'post',
          data : 'id='+ID,
          success : function( resp ) {
            $("#parktable").html(resp);
            $('#btnparking').removeAttr('disabled');
          }
        });

        $.ajax( {
          url : '<?=site_url('member/loadtransaction');?>', // your ajax file
          type : 'post',
          data : 'id='+ID,
          success : function( resp ) {
            $("#transactable").html(resp);
            $('#datatabletransac').DataTable();
          }
        });
}

function saveParking() {
    var ID;
    var parking;
    var register;
    var prov;
    var color;


    ID = $("#txtid").val();
    parking = $("#selparking").val();
    register = $("#txtregister").val();
    prov = $("#txtregisprov").val();
    color = $("#txtregiscolor").val();


        $.ajax( {
          url : '<?=site_url('member/saveregis');?>', // your ajax file
          type : 'post',
          data : 'id='+ID+'&parking='+parking+'&register='+register+'&prov='+prov+'&color='+color,
          success : function( resp ) {
            alert(resp);
            load_membercar(ID);
          }
        });



}

function delparking(ID,PARK) {
  var IDS;
  IDS = $("#txtid").val();


  $.ajax( {
          url : '<?=site_url('member/delregis');?>', // your ajax file
          type : 'post',
          data : 'id='+ID+'&parking='+PARK,
          success : function( resp ) {
            load_membercar(IDS);
          }
  });

}

$( "#memberNew" ).click(function() {
  $("#txtid").val("");
  $("#memtype").val("1");
  $("#txtmemname").val("");
  $("#txtmemidcard").val("");
  $("#txtmemidemp").val("");
  $("#txtmememail").val("");
  $("#txtmemtel1").val("");
  $("#txtmemtel2").val("");
  $('#btnparking').attr('disabled','disabled');
  $('#divparking').html("<h4>กรุณาเลือกสมาชิก</h4>");
  $('#transactable').html("<h4>กรุณาเลือกสมาชิก</h4>");
  $('#parktable').html("");
});


</script>
