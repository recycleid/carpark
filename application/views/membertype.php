<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "ADMIN")) {
    header("location: ".base_url()."login");
}
?>



<div class="row">
  <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลประเภทสมาชิก</h3>



              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"  data-toggle="modal" data-target="#myRegis"><i class="glyphicon glyphicon-plus"></i> สร้างประเภทใหม่</button>
              </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ประเภท</th>
                  <th>H. 1</th>
                  <th>H. 2</th>
                  <th>H. 3</th>
                  <th>H. 4</th>
                  <th>H. 5</th>
                  <th>H. 6</th>
                  <th>H. 7</th>
                  <th>H. 8</th>
                  <th>ตั้งแต่ 9</th>

                  <th class="no-sort">ควบคุม</th>
                </tr>
                </thead>
                <tbody>


                <?php
                    for ($i=0;$i<count($data); $i++) {
                ?>

                      <tr>
                          <td><?=$data[$i]["memtype"];?></td>
                          <td><?=$data[$i]["H1"];?></td>
                          <td><?=$data[$i]["H2"];?></td>
                          <td><?=$data[$i]["H3"];?></td>
                          <td><?=$data[$i]["H4"];?></td>
                          <td><?=$data[$i]["H5"];?></td>
                          <td><?=$data[$i]["H6"];?></td>
                          <td><?=$data[$i]["H7"];?></td>
                          <td><?=$data[$i]["H8"];?></td>
                          <td><?=$data[$i]["Hmore"];?></td>

                          <td align="right">
                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myPriority" data-uid="<?=$data[$i]["ID"];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> ปรับโซน</button>
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myEdit" data-uid="<?=$data[$i]["ID"];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> แก้ไข</button>
                          </td>
                      </tr>

                <?php
                    }
                ?>

                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </div>
</div>




        <div class="modal" id="myRegis">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">สร้างประเภทใหม่</h4>
              </div>
              <?php echo form_open('memberType/add');?>
              <div class="modal-body">


                    <div class="col-md-12 form-group has-feedback">
                      <input type="text" class="form-control" placeholder="ชื่อประเภท" id="txtmemberType" name="txtmemberType" required>
                      <span class="glyphicon glyphicon-user form-control-feedback" style="margin-right:20px;"></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 1" id="txth1" name="txth1" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>1</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 2" id="txth2" name="txth2" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>2</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 3" id="txth3" name="txth3" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>3</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 4" id="txth4" name="txth4" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>4</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 5" id="txth5" name="txth5" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>5</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 6" id="txth6" name="txth6" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>6</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 7" id="txth7" name="txth7" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>7</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 8" id="txth8" name="txth8" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>8</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="> 8" id="txthmore8" name="txthmore8" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>>8</B></span>
                    </div>

                    <div class="clearfix"></div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">บันทึก</button>
              </div>
              <?php echo form_close();?>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



        <div class="modal" id="myPriority">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">กำหนดโซน</h4>
              </div>
              <div class="modal-body">
                    <input type="hidden"  id="Idpriority" name="Idpriority" required>

                        <div id="zonepriority" name="zonepriority">

                        </div>

                    <div class="col-md-8 form-group">
                      <div id="valzone" name="valzone">
                        <select class="form-control" id="selzone">


                        </select>
                      </div>

                    </div>

                    <div class="col-md-4">
                      <button type="button" class="btn col-md-6 btn-primary" onclick="newpriority();">+</button>
                    </div>

                    <div class="clearfix"></div>



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




        <div class="modal" id="myEdit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขประเภท</h4>
              </div>
              <?php echo form_open('memberType/edit');?>
              <div class="modal-body">

                    <input type="hidden"  id="editIDhid" name="editIDhid" required>
                    <div class="col-md-12 form-group has-feedback">
                      <input type="text" class="form-control" placeholder="ชื่อประเภท" id="edittxtmemberType" name="edittxtmemberType" required>
                      <span class="glyphicon glyphicon-user form-control-feedback" style="margin-right:20px;"></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 1" id="edittxth1" name="edittxth1" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>1</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 2" id="edittxth2" name="edittxth2" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>2</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 3" id="edittxth3" name="edittxth3" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>3</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 4" id="edittxth4" name="edittxth4" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>4</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 5" id="edittxth5" name="edittxth5" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>5</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 6" id="edittxth6" name="edittxth6" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>6</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 7" id="edittxth7" name="edittxth7" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>7</B></span>

                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="ชั่วโมงที่ 8" id="edittxth8" name="edittxth8" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>8</B></span>
                    </div>

                    <div class="col-md-4 form-group has-feedback">
                     <input type="number" class="form-control" placeholder="> 8" id="edittxthmore8" name="edittxthmore8" required>
                     <span class="form-control-feedback" style="margin-right:20px;"><B>>8</B></span>
                    </div>

                    <div class="clearfix"></div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">บันทึก</button>
              </div>
              <?php echo form_close();?>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->





<script type="text/javascript">
$('#myEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('uid') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('แก้ไขประเภท ')
    modal.find('#editIDhid').val(recipient)

              var formData = {
              id: recipient
              }


              $.ajax( {
    				          url : '<?=site_url('memberType/find_memtype');?>', // your ajax file
    				          type : 'post',
    				          data : formData,
    				          success : function( resp ) {
    				          	var editdata = jQuery.parseJSON( resp );
    				          	$("#edittxtmemberType").val(editdata.memtype);
    				          	$("#edittxth1").val(editdata.H1);
                        $("#edittxth2").val(editdata.H2);
                        $("#edittxth3").val(editdata.H3);
                        $("#edittxth4").val(editdata.H4);
                        $("#edittxth5").val(editdata.H5);
                        $("#edittxth6").val(editdata.H6);
                        $("#edittxth7").val(editdata.H7);
                        $("#edittxth8").val(editdata.H8);
                        $("#edittxthmore8").val(editdata.Hmore);

    				          }
    				    });
  })


  $('#myPriority').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('uid') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('แก้ไขประเภท ')
      modal.find('#Idpriority').val(recipient)

      call_loadzone(recipient);
    })

function call_loadzone(recipient) {
  var formData = {
    id: recipient
  }

  $.ajax( {
          url : '<?=site_url('memberType/find_priority');?>', // your ajax file
          type : 'post',
          data : formData,
          success : function( resp ) {
            $("#zonepriority").html(resp);
          }
  });

  $.ajax( {
          url : '<?=site_url('memberType/find_zone');?>', // your ajax file
          type : 'post',
          data : formData,
          success : function( resp ) {
            $("#valzone").html(resp);
          }
  });
}

</script>


<script type="text/javascript">

function newpriority()
{
  var formData = {
    id: $('#Idpriority').val(),
    sel: $('#selzone').val()
  }

  $.ajax( {
          url : '<?=site_url('memberType/new_priority');?>', // your ajax file
          type : 'post',
          data : formData,
          success : function( resp ) {
            call_loadzone($('#Idpriority').val());
          }
  });
}

function delpriority(zone,memtyid)
{

  var formData = {
    id: memtyid,
    sel: zone
  }

  $.ajax( {
          url : '<?=site_url('memberType/del_priority');?>', // your ajax file
          type : 'post',
          data : formData,
          success : function( resp ) {
            call_loadzone(memtyid);
          }
  });
}

function promotepriority(zone,memtyid,priority)
{
  var formData = {
    id: memtyid,
    sel: zone,
    priority: priority
  }

  $.ajax( {
          url : '<?=site_url('memberType/promote_priority');?>', // your ajax file
          type : 'post',
          data : formData,
          success : function( resp ) {
            call_loadzone(memtyid);
          }
  });
}

</script>


<!-- iCheck -->
<script src="<?php echo base_url() ;?>plugins/iCheck/icheck.min.js"></script>

<script src="plugins/Bootstrap-Confirmation-master/bootstrap-confirmation.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>





<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("#datatable1").DataTable();
  });
</script>



<script type="text/javascript">
  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    // other options
  });


</script>
