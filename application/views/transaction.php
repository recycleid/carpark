<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "OFFICER")) {
    header("location: ".base_url()."login");
}
?>

<script>
	function startTime() {
	    var today = new Date();
	    var h = today.getHours();
	    var m = today.getMinutes();
	    var s = today.getSeconds();
	    m = checkTime(m);
	    s = checkTime(s);
	    document.getElementById('timer').innerHTML = h + ":" + m + ":" + s;
	    var t = setTimeout(startTime, 500);
	}

	function checkTime(i) {
	    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
	    return i;
	}
</script>

<div class="row">

	<div class="col-md-4">

		<div class="box box-primary">

			 <div class="box-header with-border">
              		<h3 class="box-title">เข้า-ออก</h3>

              		<div class="box-tools pull-right">
             			<h3 class="box-title" id="timer" name="timer">test</h3>
             		</div>
             </div>

			<div class="box-body">
				<?php echo form_open('transaction/controltransac',array('class' => 'form-horizontal'));?>
	            	<center><video id="video" width="320" height="240" autoplay></video></center>

	            		<div>&nbsp;</div>

	            		<div class="form-group">
            				<label for="#" class="col-sm-3 control-label">
                      <?php
                        if ($state == "IN") {
                          echo "ทะเบียน";
                        } else {
                          echo "เลขที่เข้า";
                        }
                      ?>
                    </label>
            				<div class="col-sm-8">
            					<input type="text" class="form-control" id="txtcarid" placeholder="<?php
                        if ($state == "IN") {
                          echo "ทะเบียน";
                        } else {
                          echo "เลขที่เข้า";
                        }
                      ?>" required>
            				</div>

            			</div>

            			<div class="form-group" style="display: none;">
            				<label for="#" class="col-sm-3 control-label">สมาชิก</label>
            				<div class="col-sm-8">
            					<input type="text" class="form-control" id="txtmemid" placeholder="เลขที่สมากชิก">
            				</div>

            			</div>

                  <?php if ($state == "IN") { ?>
            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label"></label>
            				<div class="col-sm-8">
            					<button type="button" class="btn btn-success btn-lg btn-block" id="btnIN" name="btnIN" onclick="controltransacIN();"
                      <?php if ($parkstate == "True") { echo " disabled"; } ?>>เข้า</button>
            				</div>

            			</div>
                  <?php } ?>

                  <?php if ($state == "OUT") { ?>
            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label"></label>
            				<div class="col-sm-8">
            					<button type="button" class="btn btn-danger btn-lg btn-block" onclick="controltransacOUT('0');">ออก</button>
            				</div>

            			</div>

            			<div class="form-group">
            				<label for="#" class="col-sm-3 control-label"></label>
            				<div class="col-sm-8">
            					<button type="button" class="btn btn-warning btn-lg btn-block" onclick="controltransacOUT('1');">ออก (ไม่คิดค่าบริการ)</button>
            				</div>

            			</div>
                  <?php } ?>

                  <?php
                    if ($parkstate == "True") {
                      echo "<center><H1 style='color:red;'>ที่จอดรถเต็ม</H1></center>";
                      ?>
                      <script>
                        setTimeout("location.reload(true);", 5000);
                      </script>
                      <?php
                    }
                  ?>


	            <?php echo form_close();?>
            </div>

		</div>



	</div>



	<div class="col-md-4">

		<div class="box box-info">

			<div class="box-header with-border">
              		<h3 class="box-title">ค่าบริการ</h3>
             </div>

			<div class="box-body">
				<form class="form-horizontal">
	            	<div class="form-group">
            				<label for="#" class="col-md-12 control-label"><center><h1 id="showprice"></h1></center></label>
            		</div>
	            </form>
            </div>

		</div>


		<div class="box box-info">

			<div class="box-header with-border">
              		<h3 class="box-title">ทะเบียน</h3>
             </div>

			<div class="box-body">
				<form class="form-horizontal">
	            	<div class="form-group">
            				<label for="#" class="col-md-12 control-label"><center><h1 id="showregis"></h1></center></label>
            		</div>
	            </form>
            </div>

		</div>


		<div class="box box-info">

			<div class="box-header with-border">
              		<h3 class="box-title">ที่จอด</h3>
             </div>

			<div class="box-body">
				<form class="form-horizontal">
	            	<div class="form-group">
            				<label for="#" class="col-md-12 control-label"><center><h1 id="showpark"></h1></center></label>
            		</div>
	            </form>
            </div>

		</div>



	</div>


	<div class="col-md-4">

		<div class="box box-success">

			<div class="box-header with-border">
              		<h3 class="box-title">เข้า</h3>

              		<div class="box-tools pull-right">
             			<h3 class="box-title" id="showTimeIN"></h3>
             		</div>
             </div>



			<div class="box-body">
				<center><canvas width="320" height="240" id="imgIN" name="imgIN"></canvas></center>
            </div>

		</div>




	</div>

	<div class="col-md-4">

		<div class="box box-danger">

			<div class="box-header with-border">
              		<h3 class="box-title">ออก</h3>

              		<div class="box-tools pull-right">
             			<h3 class="box-title" id="showTimeOUT"></h3>
             		</div>
             </div>



			<div class="box-body">
				<center><canvas width="320" height="240" id="imgOUT" name="imgOUT"></canvas><canvas width="320" height="240" id="tempimgOUT" name="tempimgOUT" style="display: none;"></canvas></center>
            </div>

		</div>




	</div>

</div>



<script type="text/javascript">
	startTime();
	// Grab elements, create settings, etc.
	var video = document.getElementById('video');

	// Get access to the camera!
	if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	    // Not adding `{ audio: true }` since we only want video now
	    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
	        video.src = window.URL.createObjectURL(stream);
	        video.play();
	    });
	}

</script>


<script type="text/javascript">
	function controltransacIN() {
	    var register;
	    var memberid;

	    register = $("#txtcarid").val();
		memberid = $("#txtmemid").val();

	    if (register != "") {

	    		    var canvas = document.getElementById('imgIN');
					var context = canvas.getContext('2d');
					var video = document.getElementById('video');
					context.drawImage(video, 0, 0, 320, 240);
				    var dataUrl =  canvas.toDataURL('image/png');





				    var formData = {
					    register: register,
					    memberid: memberid,
					    inputdata: dataUrl
					}



				        $.ajax( {
				          url : '<?=site_url('transaction/controltransac');?>', // your ajax file
				          type : 'post',
				          data : formData,
				          success : function( resp ) {
                    //alert(resp);
				          	var transac = jQuery.parseJSON( resp );

				          	$("#txtcarid").val("");
				          	//$("#txtmemid").val("");

                    if (transac.parkstate == true) {
                      $("#btnIN").prop('disabled', true);
                      setTimeout("location.reload(true);", 5000);
                    }

							if (transac.alert != "") {
								clearpic();

								$("#showprice").html("");
				          		$("#showTimeIN").html("");
				          		$("#showTimeOUT").html("");
					        	$("#showregis").html("");
					        	$("#showpark").html("");

								alert(transac.alert);
							} else {
								$("#showprice").html("");
				          		$("#showTimeIN").html(transac.timeIN);
				          		$("#showTimeOUT").html("");
					        	$("#showregis").html(transac.register);
					        	$("#showpark").html(transac.parkPosition);

						        var canvasOUT = document.getElementById('imgOUT');
							    var contextOUT = canvasOUT.getContext('2d');
							    var imageObjOUT = new Image();
							    imageObjOUT.src = "<?=base_url();?>image/transaction/park.jpg";
							    imageObjOUT.onload = function(){
								    contextOUT.drawImage(imageObjOUT, 0, 0);
								}
							}

					        //$("#txtcarid").focus();



				          }
				        });

	    } else {
	    	alert("จำเป็นต้องกรอกทะเบียนทุกครั้ง")
	    }





	}

	function controltransacOUT(p) {
	    var register;
	    var memberid;

	    register = $("#txtcarid").val();
		memberid = $("#txtmemid").val();

	    if (register != "") {

	    		    var canvas = document.getElementById('tempimgOUT');
					var context = canvas.getContext('2d');
					var video = document.getElementById('video');
					context.drawImage(video, 0, 0, 320, 240);
				    var dataUrl =  canvas.toDataURL('image/png');

				    var formData = {
					    register: register,
					    memberid: memberid,
					    inputdata: dataUrl,
					    p : p
					}


				        $.ajax( {
				          url : '<?=site_url('transaction/controltranOUT');?>', // your ajax file
				          type : 'post',
				          data : formData,
				          success : function( resp ) {
                    //alert(resp);
				          	var transac = jQuery.parseJSON( resp );

				          	$("#txtcarid").val("");
				          	$("#txtmemid").val("");



					        $("#txtcarid").focus();

					        if (transac.alert != "") {
								clearpic();

								$("#showprice").html("");
				          		$("#showTimeIN").html("");
				          		$("#showTimeOUT").html("");
					        	$("#showregis").html("");
					        	$("#showpark").html("");

								alert(transac.alert);
							} else {

								$("#showprice").html(transac.price);
					          	$("#showTimeIN").html(transac.timeIN);
					          	$("#showTimeOUT").html(transac.timeOUT);
						        $("#showregis").html(transac.register);
						        $("#showpark").html(transac.parkPosition);

						        var canvasIN = document.getElementById('imgIN');
							    var contextIN = canvasIN.getContext('2d');
							    var imageObjIN = new Image();
							    var inurl = transac.pathin.slice(2);
							    imageObjIN.src = "<?=base_url();?>"+inurl;
							    imageObjIN.onload = function(){
								    contextIN.drawImage(imageObjIN, 0, 0);
								}

							    var canvasOUT = document.getElementById('imgOUT');
							    var contextOUT = canvasOUT.getContext('2d');
							    var imageObjOUT = new Image();
							    var outurl = transac.pathout.slice(2);
							    imageObjOUT.src = "<?=base_url();?>"+outurl;
							    imageObjOUT.onload = function(){
								    contextOUT.drawImage(imageObjOUT, 0, 0);
								}

							}





				          }
				        });

	    } else {
	    	alert("จำเป็นต้องกรอกทะเบียนทุกครั้ง")
	    }





	}

	function clearpic() {
							var canvasOUT = document.getElementById('imgOUT');
						    var contextOUT = canvasOUT.getContext('2d');
						    var imageObjOUT = new Image();
						    imageObjOUT.src = "<?=base_url();?>image/transaction/park.jpg";
						    imageObjOUT.onload = function(){
							    contextOUT.drawImage(imageObjOUT, 0, 0);
							}

							var canvasIN = document.getElementById('imgIN');
						    var contextIN = canvasIN.getContext('2d');
						    var imageObjIN = new Image();
						    imageObjIN.src = "<?=base_url();?>image/transaction/park.jpg";
						    imageObjIN.onload = function(){
							    contextIN.drawImage(imageObjIN, 0, 0);
							}

								$("#showprice").html("");
				          		$("#showTimeIN").html("");
				          		$("#showTimeOUT").html("");
					        	$("#showregis").html("");
					        	$("#showpark").html("");
	}

	clearpic();


</script>
