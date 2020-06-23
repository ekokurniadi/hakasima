
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penerimaan
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penerimaan </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        

          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('penerimaan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('dtl_transaksi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('dtl_transaksi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form> -->
            </div>
        </div>
      
        <table id="example1" class="table table-bordered table-striped table-hover" style="background-color:#605CA8;">
            <thead>
            <tr>
                <th>No</th>
		<th>Kode Penerimaan</th>
		<th>Tanggal Penerimaan</th>
		<th>Jumlah Item</th>
		<th>Total Penerimaan</th>
		<th>Status</th>
		<th>Action</th>
            </tr>
            </thead><?php
            $start=0;
            $const="Rp. ";
            foreach ($dt as $data)
            {
                ?>
                <tbody>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $data->kode_transaksi ?></td>
			<td><?php echo $data->tanggal_transaksi ?></td>
			<td><?php echo $data->jumlah_item ?></td>
			<td width="150px"><?php echo $const.number_format($data->total_transaksi ,2, ',', '.') ?></td>
      <?php if ($data->status=='3') { ?>
		    <td><span class="label bg-red">Selesai</span></td>
            <?php };?>
			<td style="text-align:center" width="200px">
        <?php 
				echo anchor(site_url('penerimaan/detail_transaksi/'.$data->kode_transaksi),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-warning btn-sm')); 
				echo '  '; 
				echo anchor(site_url('penerimaan/cetak_nota/'.$data->kode_transaksi),'<i class="fa fa-print"></i>',array('title'=>'detail','class'=>'btn btn-default btn-sm')); 
				echo '  '; 
				?>
			</td>
		</tr></tbody>
                <?php
            }
            ?>
            <tfoot>
                
                </tfoot>
        </table>
        
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
            <div class="col-md-6">
                <!-- <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a> -->
                <!-- <?php echo anchor(site_url('dtl_transaksi/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?> -->
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
