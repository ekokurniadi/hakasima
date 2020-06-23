
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekap Laporan Penjualan Bulanan 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rekap Laporan Penjualan Bulanan</li>
      </ol>
    </section>


<!-- column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo base_url('laporan_pdf/laporan_penjualan_action')?>" method="post" class="form-horizontal">
	   
    <div class="box-body"> 
        <div class="form-group">
            <label for="Varchar" class="col-md-2">Pilih Brand</label>
            <div class="col-sm-4">
                <select name="brand" id="brand" class="form-control">
                <option value="<?php echo $brand?>" selected>Choose Items</option>
                <option value="ALL" selected>Semua Brand</option>
            <?php foreach($brand_data as $data):?>
                <option value="<?php echo $data->brand?>"><?php echo $data->brand?></option>
            <?php endforeach;?>
                </select>
            </div>
            <div class="col-sm-2">
              <select name="bulan" id="bulan" class="form-control">
              <option value="<?=$bulan?>">Choose Month</option>
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">Maret</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select name="tahun" id="tahun" class="form-control">
              <?php 
              $t=date('Y')-50;
              for($i;$i<$t+100;$i++){
                $sel =$i ==date('Y')?'selected="selected"':'';
                echo '<option value ="'.$i.'"'.$sel.'>'.$i.'</option>';  
              }
              ?>
              </select>
            </div>
        </div>
    </div>    
<div class="box-footer">
	    <button type="submit" class="btn btn-success">Tampilkan</button> 
	    <a href="<?php echo site_url('dashboard') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
