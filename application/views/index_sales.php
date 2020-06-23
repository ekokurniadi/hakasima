 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$prospek->num_rows()?></h3>

              <p>Prospek</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <!-- <a href="<?=base_url('user');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$penjualan->num_rows()?></h3>

              <p>Penjualan</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <!-- <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>
  
        <div class="row text-center">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                    <h3>Selamat Datang <?php echo $this->session->userdata('nama_lengkap');?></h3>
                </div>
              </div>
            </div>
        </div>

     </section>

