<!DOCTYPE html>
<html>
<head>
 
 
<script src="<?php echo base_url();?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/fontawesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins_user.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  #hdr-color{
	  background-color:#171010;
  }
 .skin-blue .main-header .logo{
	  background-color:#171010;
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url();?>dashboard/admin_dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" id="logo-hdr"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">KMS</span>
      <p>system</p>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" id="hdr-color">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <label style="margin:12px 0px 0px 20px; color:#FFF;font-size:large"><img src="<?php echo base_url();?>asset/images/logo_thc.gif" height="35" width="85"> &nbsp; Knowledge Management System</label>
      <!-- Navbar Right Menu -->
      

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="height:80px">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>asset/images/karyawan/<?php echo $this->session->userdata('imgkarya');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('namekarya');?></p>
          <a href="#"><i class="fa fa-user text-success"></i> <?php echo $this->session->userdata('emailkarya');?></a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
<li class="header">MAIN MENU</li>
 
         <li>
          <a href="<?php echo base_url();?>Home_karyawan/view_message">
            <i class="fa fa-envelope"></i> <span> Message</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
            </span>
          </a>
        </li>    
               
        <li>
          <a href="<?php echo base_url();?>Home_karyawan/karyawan">
            <i class="fa fa-users"></i> <span>Karyawan</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
            </span>
          </a>
        </li>
    <li><a href="<?php echo base_url();?>Home_karyawan/materi"><i class="fa fa-clone"></i> Materi</a></li>
     <li><a href="<?php echo base_url();?>Home_karyawan/discuss"><i class="fa fa-comments"></i> Discuss</a></li>

<li class="header">ADMINISTRATOR MANAGE</li>
 <li><a href="<?php echo base_url();?>home_karyawan/form_setting"><i class="fa fa-cog"></i> &nbsp;   Setting profile</a></li>
        </li>
  <li><a href="<?php echo base_url()?>karyawan_login/logout"><i class="fa fa-circle-o-notch"></i> Logout </a> </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo isset($title)?$title:'';?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo isset($crumb)?'<a href="'.base_url().$crumb.'">'.$crumb.'</a>':'';?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        
        <!-- /.col -->
    
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">     
            
            <!-- /.box-header -->
            
<?php echo $this->load->view($view);;?>
            <!-- ./box-body -->
            
            <div class="box-footer">
              <div class="row">
     
      <!-- below is content  -->         
                <div class="col-sm-12 col-xs-6">
                

        
                
                </div>

<!-- TABLES -->


<!- END OF TABLES   -->
                
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<!-- BOX FOR CONTENT --->

<!-- END OF BOX CONTENT  -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
         
       
          <!-- /.box -->
          <div class="row">
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <!-- USERS LIST -->
              
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->

        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    
    <strong>Copyright &copy; 2016-2017 <a href="http://facebook.com" target="new">Farid</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>asset/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>asset/dist/js/app.min.js"></script>
	
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>

</body>
</html>
