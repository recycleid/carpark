<?php
if ($this->session->userdata['user']['id'] == "") {
  header("location: ".base_url()."login");
}

$userRole = $this->session->userdata['user']['role'];
?>




<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Carpark</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url();?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?=base_url();?>plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="<?=base_url();?>plugins/bootstrap-select-1.12.2/dist/css/bootstrap-select.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url();?>bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>dist/js/app.min.js"></script>

<script src="<?=base_url();?>plugins/bootstrap-select-1.12.2/dist/js/bootstrap-select.js"></script>

<style type="text/css">
  .no-sort::after { display: none!important; }
  .no-sort { pointer-events: none!important; cursor: default!important; }
</style>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>PK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Car</b>PARK</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">


          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?=base_url();?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->session->userdata['user']['name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?=base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata['user']['name']; ?>
                  <small><?php echo $this->session->userdata['user']['email']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#"><?php echo $this->session->userdata['user']['role']; ?></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url().'login'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>



  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata['user']['name']; ?></p>
          <!-- Status -->
          <a href="#"> <?php echo $this->session->userdata['user']['role']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
      	<li class="header">Main</li>
        <li><a href="index"><i class="fa fa-home"></i> <span>หน้าแรก</span></a></li>
        <?php if ($userRole == "SUPERADMIN") { ?>
          <li><a href="admin"><i class="fa fa-star"></i> <span>จัดการผู้ใช้งานระบบ</span></a></li>
        <?php } ?>

        <?php if (($userRole == "ADMIN") || ($userRole == "SUPERADMIN")) { ?>
          <li class="header">ADMIN</li>

          <!-- Optionally, you can add icons to the links -->
          <li><a href="park"><i class="fa fa-car"></i> <span>ที่จอดรถ</span></a></li>
          <li><a href="memberType"><i class="fa fa-address-card-o"></i> <span>ประเภทสมาชิก</span></a></li>
          <li><a href="member"><i class="fa fa-address-card-o"></i> <span>สมาชิก</span></a></li>
          <!--<li><a href="priority"><i class="fa fa-toggle-up"></i> <span>ลำดับความสำคัญ</span></a></li> -->
        <?php } ?>



        <?php if (($userRole == "OFFICER") || ($userRole == "SUPERADMIN")) { ?>
          <li class="header">เจ้าหน้าที่</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href="IN"><i class="fa fa-exchange"></i> <span>คีย์ เข้า</span></a></li>
          <li><a href="OUT"><i class="fa fa-exchange"></i> <span>คีย์ ออก</span></a></li>
        <?php } ?>



      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$header;?>
        <small><?=$headerDes;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-folder-open-o"></i> <?=$fBredcum;?></a></li>
        <li class="active"><?=$lBredcum;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
