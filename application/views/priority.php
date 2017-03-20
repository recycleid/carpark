<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "ADMIN")) {
    header("location: ".base_url()."login");
}

?>

<link rel="stylesheet" href="plugins/jquery-ui-1.12.1/jquery-ui.css">

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 1.5em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>


<script src="plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>

<div class="row">

	<div class="col-md-6">

		<div class="box box-danger">
            
            <!-- /.box-header -->
            <div class="box-body">

            	<div class="btn-group-vertical" style="width: 100%;">
                      <button type="button" class="btn btn-info btn-lg">ผู้บริหาร</button>
                      <button type="button" class="btn btn-info btn-lg">พนักงาน</button>
                      <button type="button" class="btn btn-info btn-lg">ขี้ข้า</button>
                 </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box box-warning">
            
            <!-- /.box-header -->
            <div class="box-body">

                      <button type="button" class="btn btn-success btn-lg" style="width: 100%">บันทึก</button>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

	</div>

	<div class="col-md-6">

		<div class="box box-success">
            
            <!-- /.box-header -->
            <div class="box-body">

            	<ul id="sortable">
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>A</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>B</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>C</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>D</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>E</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>F</li>
				  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>G</li>
				</ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

	</div>


</div>

<script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
</script>