<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if ($this->session->userdata['user']['role'] != "SUPERADMIN") {
    header("location: ".base_url()."login");
}
?>



<div class="row">
  <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลผู้ใช้งานระบบ</h3>



              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"  data-toggle="modal" data-target="#myRegis"><i class="glyphicon glyphicon-plus"></i> สร้างผู้ใช้งานใหม่</button>
              </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>รหัส</th>
                  <th>E-mail</th>
                  <th>รหัสบัตรประชาชน</th>
                  <th>ชื่อ-นามสกุล</th>
                  <th>ชื่อเล่น</th>
                  <th>เบอร์โทรศัพท์</th>
                  <th>ระดับ</th>

                  <th class="no-sort">ควบคุม</th>
                </tr>
                </thead>
                <tbody>


                <?php
                    for ($i=0;$i<count($data); $i++) {
                ?>

                      <tr>
                          <td><?=$data[$i]["userID"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>ID" name="<?=$data[$i]["userID"];?>ID" value="<?=$data[$i]["userID"];?>"></td>
                          <td><?=$data[$i]["userEmail"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>Email" name="<?=$data[$i]["userID"];?>Email" value="<?=$data[$i]["userEmail"];?>"></td>
                          <td><?=$data[$i]["useridCard"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>idcard" name="<?=$data[$i]["userID"];?>idcard" value="<?=$data[$i]["useridCard"];?>"></td>
                          <td><?=$data[$i]["userName"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>username" name="<?=$data[$i]["userID"];?>username" value="<?=$data[$i]["userName"];?>"></td>
                          <td><?=$data[$i]["userNickname"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>userNickname" name="<?=$data[$i]["userID"];?>userNickname" value="<?=$data[$i]["userNickname"];?>"></td>
                          <td><?=$data[$i]["userTelephone"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>telephone" name="<?=$data[$i]["userID"];?>telephone" value="<?=$data[$i]["userTelephone"];?>"></td>
                          <td><?=$data[$i]["userRole"];?> <input type="hidden" id="<?=$data[$i]["userID"];?>role" name="<?=$data[$i]["userID"];?>role" value="<?=$data[$i]["userRole"];?>"></td>
                          <td align="right">
                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myEdit" data-uid="<?=$data[$i]["userID"];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> แก้ไข</button> 
                            <!--<button type="button" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="left" data-title="ต้องการลบจริงใช่หรือไม่?" href="<?=site_url('admin/delete/'.$data[$i]["userID"]);?>" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ลบ</button> -->
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
                <h4 class="modal-title">สร้างผู้ใช้งานใหม่</h4>
              </div>
              <?php echo form_open('admin/add');?>
              <div class="modal-body">

                  
                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Full name" id="txtfname" name="txtfname" required>
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Nick name" id="txtNname"  name="txtNname" required>
                      <span class="fa fa-user-circle form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="email" class="form-control" placeholder="Email" id="txtEmail" name="txtEmail" required>
                      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" placeholder="Retype password" id="confirm_password" name="confirm_password" required>
                      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Citizen ID" id="txtcid" name="txtcid" required maxlength="13">
                      <span class="fa fa-id-card-o form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Telephone" id="txttelephone" name="txttelephone" required>
                      <span class="fa fa-mobile form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <select  class="form-control" id="selrole"  name="selrole">
                          <option value="ADMIN">ADMIN</option>
                          <option value="OFFICIAL">OFFICIAL</option>
                          <option value="SECURITY">SECURITY</option>
                          <option value="SUPERADMIN">SUPERADMIN</option>
                      </select>
                    </div>

                  

                  
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




        <div class="modal" id="myEdit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">สร้างผู้ใช้งานใหม่</h4>
              </div>
              <?php echo form_open('admin/edit');?>
              <div class="modal-body"> 
                    <input type="hidden" id="editid" name="editid" value="">

                  
                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Full name" id="edittxtfname" name="edittxtfname" required>
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Nick name" id="edittxtNname"  name="edittxtNname" required>
                      <span class="fa fa-user-circle form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="email" class="form-control" placeholder="Email" id="edittxtEmail" name="edittxtEmail" required>
                      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" placeholder="Password" id="editpassword" name="editpassword" required>
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" placeholder="Retype password" id="editconfirm_password" name="editconfirm_password" required>
                      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Citizen ID" id="edittxtcid" name="edittxtcid" required maxlength="13">
                      <span class="fa fa-id-card-o form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control" placeholder="Telephone" id="edittxttelephone" name="edittxttelephone" required>
                      <span class="fa fa-mobile form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                      <select  class="form-control" id="editselrole"  name="editselrole">
                          <option value="ADMIN">ADMIN</option>
                          <option value="OFFICER">OFFICER</option>
                          <option value="SUPERADMIN">SUPERADMIN</option>
                      </select>
                    </div>

                  

                  
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
    modal.find('.modal-title').text('แก้ไขข้อมูลผู้ใช้ ')
    modal.find('#editid').val(recipient)
    modal.find('#edittxtfname').val(document.getElementById(recipient+"username").value)
    modal.find('#edittxtNname').val(document.getElementById(recipient+"userNickname").value)
    modal.find('#edittxtEmail').val(document.getElementById(recipient+"Email").value)
    modal.find('#edittxtcid').val(document.getElementById(recipient+"idcard").value)
    modal.find('#edittxttelephone').val(document.getElementById(recipient+"telephone").value)
    modal.find('#editselrole').val(document.getElementById(recipient+"role").value)
  })


</script>


<script type="text/javascript">
  var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;

  var editpassword = document.getElementById("editpassword")
  , editconfirm_password = document.getElementById("editconfirm_password");

  function editvalidatePassword(){
    if(editpassword.value != editconfirm_password.value) {
      editconfirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      editconfirm_password.setCustomValidity('');
    }
  }

  editpassword.onchange = editvalidatePassword;
  editconfirm_password.onkeyup = editvalidatePassword;



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

