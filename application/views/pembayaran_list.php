
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembayaran 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pembayaran </li>
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
            <div class="col-md-8">
                <?php echo anchor(site_url('pembayaran/create'),'Create', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('pembayaran/history'),'<i class="fa fa-history"></i> History Pembayaran', 'class="btn bg-maroon btn-flat"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('pembayaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pembayaran'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<!-- <th>Alamat</th> -->
		<th>Tanggal</th>
		<!-- <th>No Ktp</th>
		<th>No Hp</th> -->
		<!-- <th>Kode Barang</th> -->
		<th>Nama Barang</th>
		<!-- <th>Jumlah</th> -->
		<th>Jenis Pembelian</th>
		<th>Harga</th>
		<th>Tenor</th>
		<th>Angsuran</th>
		<!-- <th>Status</th> -->
		<!-- <th>Nik Sales</th> -->
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($pembayaran_data as $pembayaran)
            {
                ?>
                <tbody>
                <tr>
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $pembayaran->id_prospek ?></td>
			<td><?php echo $pembayaran->id_customer ?></td>
			<td><?php echo $pembayaran->nama ?></td>
			<!-- <td><?php echo $pembayaran->alamat ?></td> -->
			<td><?php echo tgl_indo($pembayaran->tanggal) ?></td>
			<!-- <td><?php echo $pembayaran->no_ktp ?></td>
			<td><?php echo $pembayaran->no_hp ?></td> -->
			<!-- <td><?php echo $pembayaran->kode_barang ?></td> -->
			<td><?php echo $pembayaran->nama_barang ?></td>
			<!-- <td><?php echo $pembayaran->jumlah ?></td> -->
			<td><?php echo $pembayaran->jenis_pembelian ?></td>
			<td><?php echo $pembayaran->harga ?></td>
			<td><?php echo $pembayaran->tenor ?></td>
			<td><?php echo $pembayaran->angsuran ?></td>
			<!-- <td><?php echo $pembayaran->status ?></td> -->
			<!-- <td><?php echo $pembayaran->nik_sales ?></td> -->
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('pembayaran/read/'.$pembayaran->id),'<i class="fa fa-eye"></i> View',array('title'=>'detail','class'=>'btn btn-primary btn-block btn-flat btn-sm')); 
				echo '  '; 
				echo anchor(site_url('pembayaran/cetak/'.$pembayaran->id),'<i class="fa fa-print"></i> Cetak Nota',array('title'=>'edit','class'=>'btn bg-maroon btn-block btn-flat btn-sm','target'=>'_blank')); 
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
                <?php echo anchor(site_url('pembayaran/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('pembayaran/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('pembayaran/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
