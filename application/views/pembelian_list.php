
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pembelian </li>
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
                <?php echo anchor(site_url('pembelian/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('pembelian/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pembelian'); ?>" class="btn btn-default">Reset</a>
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
		<th>Kode Pembelian</th>
		<th>Tanggal</th>
		<th>Customer Id</th>
		<th>Alamat</th>
		<th>Provinsi</th>
		<th>Kecamatan</th>
		<th>Kabupaten</th>
		<th>Ekspedisi</th>
		<th>Layanan</th>
		<th>Status</th>
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($pembelian_data as $pembelian)
            {
                ?>
                <tbody>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pembelian->kode_pembelian ?></td>
			<td><?php echo $pembelian->tanggal ?></td>
			<td><?php echo $pembelian->customer_id ?></td>
			<td><?php echo $pembelian->alamat ?></td>
			<td><?php echo $pembelian->provinsi ?></td>
			<td><?php echo $pembelian->kecamatan ?></td>
			<td><?php echo $pembelian->kabupaten ?></td>
			<td><?php echo $pembelian->ekspedisi ?></td>
			<td><?php echo $pembelian->layanan ?></td>
			<td><?php echo $pembelian->status ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pembelian/read/'.$pembelian->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-default btn-sm')); 
				echo '  '; 
				echo anchor(site_url('pembelian/update/'.$pembelian->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
				echo '  '; 
				echo anchor(site_url('pembelian/delete/'.$pembelian->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                <?php echo anchor(site_url('pembelian/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
