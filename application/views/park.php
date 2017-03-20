<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "ADMIN")) {
    header("location: ".base_url()."login");
}
?>

<style type="text/css">
  .no-sort::after { display: none!important; }
  .no-sort { pointer-events: none!important; cursor: default!important; }
</style>

<div class="row">
  <div class="col-md-12">
        <div class="box box-success">

            <!-- /.box-header -->
            <?php echo form_open('park/parkadd',array('class' => 'form-horizontal'));?>


            <div class="box-body">

              <div class="row">
                <div class="col-md-2">
                  <h4>สร้างที่จอดรถ</h4>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i>&nbsp; กลุ่ม</span>
                    <select class="form-control" id="zone" name="zone">
                        <?php for($i=0;$i<count($zone); $i++) { ?>

                          <option value="<?=$zone[$i]["zone"];?>"><?=$zone[$i]["zone"];?></option>

                        <?php } ?>
                    </select>


                  </div>
                </div>

                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-car"></i>&nbsp; จำนวน</span>
                    <input type="number" class="form-control" id="numpark" name="numpark">
                  </div>
                </div>

                <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> สร้างที่จอด</button>
                </div>

                <div class="col-md-2">

                </div>

                <div class="col-md-2">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myNewzone"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> สร้างกลุ่มใหม่</button>
                </div>


              </div>


            </div>
            <?php echo form_close();?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </div>
</div>

<div class="row">
  <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลที่จอด</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatable1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ที่จอด</th>


                  <th class="no-sort">สถานะ</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0; $i<count($park); $i++) { ?>


                <tr>
                  <td><?=$park[$i]["zone"];?><?=$park[$i]["number"];?></td>
                  <td>
                    <select class="form-control" id="selpark<?=$park[$i]["ID"];?>" name="selpark<?=$park[$i]["ID"];?>"  <?php if ($park[$i]["status"] == "2") { echo "disabled"; } ?>
                    onchange="change_state('<?=$park[$i]["ID"];?>',this.value)" >
                        <option value="1" data-icon="glyphicon glyphicon-ok-circle" <?php if ($park[$i]["status"] == "1") { echo "selected"; } ?> > ว่าง</option>
                        <option value="0" data-icon="glyphicon glyphicon-ban-circle" <?php if ($park[$i]["status"] == "0") { echo "selected"; } ?> > ไม่ว่าง</option>
                        <option value="2" data-icon="glyphicon glyphicon-lock" disabled <?php if ($park[$i]["status"] == "2") { echo "selected"; } ?> > จอง</option>
                    </select>
                  </td>
                </tr>

                <?php } ?>

                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  </div>
</div>








<div class="modal" id="myNewzone">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">สร้างผู้ใช้งานใหม่</h4>
        </div>
        <?php echo form_open('park/zoneadd');?>
        <div class="modal-body">
              <div class="col-md-4">
              </div>

              <div class="col-md-4">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Zone" id="txtnewzone" name="txtnewzone" required>
                <span class="glyphicon glyphicon-th-large form-control-feedback"></span>
              </div>
              </div>

              <div>&nbsp;</div>
              <div>&nbsp;</div>


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

















<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#datatable1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
  });




</script>


<script type="text/javascript">
  function change_state(id,state) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //alert("A");
      }
    };
    xhttp.open("GET", "<?=site_url('park/changeState');?>?id="+id+"&state="+state, true);
    xhttp.send();


  }

</script>
