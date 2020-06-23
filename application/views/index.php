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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $barang->num_rows()?></h3>

              <p>Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <!-- <a href="<?=base_url('user');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $penjualan->num_rows()?></h3>

              <p>Penjualan</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <!-- <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $user->num_rows()?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <!-- <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $konsumen->num_rows()?></h3>

              <p>Konsumen</p>
            </div>
            <div class="icon">
              <i class="fa fa-files-o"></i>
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
                    <h3>Selamat Datang <?php echo $this->session->userdata('nama');?></h3>
                </div>
              </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-6 sm-6">
            <!-- Bar chart -->
            <div class="box box-success">
                <div class="box-header with-border">
                   <h3 class="box-title">Stok Barang</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
              <div class="box-body">
                <div class="chart-container">
                    <div class="chart">
                      <canvas id="barChart2" style="height:300px"></canvas>
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->
        </div>
        </div>
        <div class="col-md-6 sm-6">
            <!-- Bar chart -->
            <div class="box box-success">
                <div class="box-header with-border">
                   <h3 class="box-title">Barang Paling Laku</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
              <div class="box-body">
                <div class="chart-container">
                    <div class="chart">
                      <canvas id="barChart"  style="height:300px"></canvas>
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->
        </div>
        </div>
    </div>
     </section>

