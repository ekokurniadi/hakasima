<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/morris/morris.css">
  <!-- jvectormap -->

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/chartjs/Chart.js">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style>
.chart-container {
  position: relative;
  margin: auto;
  
}


</style>


  <style>
    table.dataTable thead 
    {
      background-color:#605CA8;
      width:auto;
    }
    table.dataTable th
    {
      color:white;
    }
    /* table thead 
    {
      background-color:#605CA8;
      width:auto;
    }
    table th
    {
      color:white;
    } */
    
  </style>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('dashboard_sales') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url()?>image/logo.png" width="200" alt="" style="filter: drop-shadow(5px 1px 0px #222); "></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()."image/".$_SESSION['foto']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><b>
                  <?php echo strtoupper($_SESSION['nama_lengkap']);?>
                 </b></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()."image/".$_SESSION['foto']?>" class="img-circle" alt="User Image">

                <p><b>
                  <?php echo strtoupper($_SESSION['nama_lengkap']); ?>
                 </b>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="<?php echo base_url('user/update/'.$_SESSION['id']);?>" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url('auth_sales/logout')?>" class="btn btn-default btn-flat">Sign out</a>
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
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()."image/".$_SESSION['foto']?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo strtoupper($_SESSION['nama_lengkap']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <!-- <li class="active treeview">
          <a href="<?php echo base_url() ?>">
            <i class="fa fa-home"></i> <span>Lihat Web</span>
          </a>
        </li> -->
        <li class="treeview">
          <a href="<?php echo base_url('dashboard_sales') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if($this->session->userdata('role')=='Sales'){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Prospek</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('prospek')?>"><i class="fa fa-cart-arrow-down"></i>Prospek</a></li>
            <li><a href="<?php echo base_url('pembayaran')?>"><i class="fa fa-money"></i>Pembayaran</a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="<?php echo base_url()?>">
            <i class="fa fa-bar-chart"></i>
            <span>Barang Masuk</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url()?>">
            <i class="fa fa-bar-chart"></i>
            <span>Sales Order</span>
             <span class="badge bg-red">
                1
            </span>
          </a>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i>
            <span>Master Konten Website</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('about')?>"><i class="fa fa-circle-o"></i>Tentang</a></li>
            <li><a href="<?php echo base_url('slider')?>"><i class="fa fa-circle-o"></i>Slider</a></li>
            <li><a href="<?php echo base_url('galeri')?>"><i class="fa fa-circle-o"></i>Galeri</a></li>
            <li><a href="<?php echo base_url('service')?>"><i class="fa fa-circle-o"></i>Layanan</a></li>
       
          </ul>
        </li> -->
         <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('sku/excel')?>"><i class="fa fa-file-excel-o"></i> Laporan Data SKU</a></li>
            <li><a href="<?php echo base_url('stok_sku/excel')?>"><i class="fa fa-file-excel-o"></i> Laporan Data Stok</a></li>
            <li><a href="<?php echo base_url('user/excel')?>"><i class="fa fa-file-excel-o"></i> Laporan Data User</a></li>
            <li><a href="<?php echo base_url('laporan_pdf/laporan_penjualan_view')?>"><i class="fa fa-file-excel-o"></i> Laporan Penjualan</a></li>
            <li><a href="<?php echo base_url('laporan_pdf/laporan_penerimaan_view')?>"><i class="fa fa-file-excel-o"></i> Laporan Barang Masuk</a></li>
          </ul>
        </li> -->
         <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i><span>Setting Tema</span></a>
          </a>
        </li>
      <?php } elseif($this->session->userdata('role')=='Operator'){?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Prospek</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('prospek')?>"><i class="fa fa-cart-arrow-down"></i>Prospek</a></li>
            <li><a href="<?php echo base_url('stok_sku')?>"><i class="fa fa-circle-o"></i>Skema Kredit</a></li>
          </ul>
        </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i>
                <span>Transaksi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('transaksi')?>"><i class="fa fa-cart-arrow-down"></i>Penjualan</a></li>
                <!-- <li><a href="<?php echo base_url('penerimaan/create')?>"><i class="fa fa-cart-arrow-down"></i>Barang Masuk</a></li> -->
              </ul>
            </li>
     <?php }?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">