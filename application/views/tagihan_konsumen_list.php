
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tagihan Konsumen 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tagihan Konsumen </li>
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
                <?php echo anchor(site_url('tagihan_konsumen'),'Kembali', 'class="btn bg-maroon"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('tagihan_konsumen/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tagihan_konsumen'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form> -->
            </div>
        </div>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
		<th>Id Prospek</th>
		<th>Id Customer</th>
		<th>Nama Konsumen</th>
		<th>Nominal</th>
		<th>Tanggal Pembayaran</th>
		<th>Keterangan</th>
		<th>Status</th>
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($tagihan_konsumen_data as $tagihan_konsumen)
            {
                ?>
                <tbody>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tagihan_konsumen->id_prospek ?></td>
			<td><?php echo $tagihan_konsumen->id_customer ?></td>
			<td><?php echo $tagihan_konsumen->nama_konsumen ?></td>
			<td><?php echo $tagihan_konsumen->nominal ?></td>
			<td><?php echo $tagihan_konsumen->tanggal_pembayaran ?></td>
			<td><?php echo $tagihan_konsumen->keterangan ?></td>
			<td><?php echo $tagihan_konsumen->status ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tagihan_konsumen/listnya/'.$tagihan_konsumen->id_prospek),'<i class="fa fa-eye"></i> Detail',array('title'=>'detail','class'=>'btn btn-info btn-sm')); 
				echo '  '; 
				echo anchor(site_url('tagihan_konsumen/update/'.$tagihan_konsumen->id),'<i class="fa fa-pencil-square-o"></i> Bayar',array('title'=>'bayar tagihan','class'=>'btn bg-red btn-sm')); 
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
                <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
                <?php echo anchor(site_url('tagihan_konsumen/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
