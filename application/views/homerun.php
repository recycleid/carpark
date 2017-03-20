<?php
if ($this->session->userdata['user']['id'] == "") {
  header("location: ".base_url()."login");
}
?>

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $incomeToday; ?></h3>

              <h4>รายได้วันนี้</h4>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo date("d F Y"); ?></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$parkempty;?></h3>

              <h4>ว่าง</h4>
            </div>
            <div class="icon">
              <i class="fa fa-circle-o" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$parkReserv;?></h3>

              <h4>จอง</h4>
            </div>
            <div class="icon">
              <i class="fa fa-circle-o-notch" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$parkUsed;?></h3>

              <h4>ไม่ว่าง</h4>
            </div>
            <div class="icon">
              <i class="fa fa-circle" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<div class="row">
    <div class="col-md-8">
      
 
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">รายได้ต่อวัน</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
       

 
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">ข้อมูลการเข้าออกล่าสุด</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                    <tr>
                      <th>ทะเบียน</th>
                      <th>เวลา</th>
                      <th>สถานะ</th>
                      <th>ราคา</th>
                    </tr>
                    </thead>
                    <tbody>


                    <?php for ($i=0;$i<count($transacList); $i++) { ?>

                      <tr>
                        <td><a href="#"><?=$transacList[$i]["carRegis"];?></a></td>
                        <td><?=date("H:i", strtotime($transacList[$i]["tranIN"]));?></td>

                        <?php if ($transacList[$i]["IN"] == "IN") {
                          echo "<td><span class='label label-success'>IN</span></td>";
                        } else {
                          echo "<td><span class='label label-danger'>OUT</span></td>";
                        }
                        ?>

                        
                        <td><?=$transacList[$i]["price"];?></td>
                      </tr>

                    <?php } ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->

            </div>
            <!-- /.box -->

    </div>



        <div class="col-md-4">

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">ที่จอด</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div>
              <!-- /.box-body -->
            </div>

            <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">รายการที่จอดรถว่าง</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">

                <?php for ($i=0; $i<count($parkList); $i++) { ?>

                  <li class="item">
                    <center><h4><?=$parkList[$i]["list"];?></h4></center>
                  </li>

                <?php } ?>


              
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
          </div>
          <!-- /.box -->





        </div>


</div>






<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url(); ?>plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>plugins/fastclick/fastclick.js"></script>


<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


    var areaChartData = {
      labels: ["วันนี้", "-1", "-2", "-3", "-4", "-5", "-6"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?=$incomeToday;?>, <?=$incomeTodayD2;?>, <?=$incomeTodayD3;?>, <?=$incomeTodayD4;?>, <?=$incomeTodayD5;?>, <?=$incomeTodayD6;?>, <?=$incomeTodayD7;?>]
        }
      ]
    };

   
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      
      {
        value: <?=$parkempty;?>,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "ว่าง"
      },
      {
        value: <?=$parkUsed;?>,
        color: "#f56954",
        highlight: "#f56954",
        label: "ไม่ว่าง"
      },
      {
        value: <?=$parkReserv;?>,
        color: "#edea31",
        highlight: "#edea31",
        label: "จอง"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#00a65a";
    barChartData.datasets[0].strokeColor = "#00a65a";
    barChartData.datasets[0].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 6,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 35,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>

