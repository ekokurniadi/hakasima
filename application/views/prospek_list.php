
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prospek 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Prospek </li>
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
                <?php echo anchor(site_url('prospek/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('prospek/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('prospek'); ?>" class="btn btn-default">Reset</a>
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
		<th>Prospek</th>
		<!-- <th>Id Customer</th> -->
		<th>Nama Konsumen</th>
		<!-- <th>Alamat</th> -->
		<th>Tanggal</th>
		<!-- <th>No Ktp</th> -->
		<th>No Hp</th>
		<!-- <th>Kode Barang</th> -->
		<th>Nama Barang</th>
		<th>QTY</th>
		<!-- <th>Pembelian</th> -->
		<th>Status</th>
		<!-- <th>Nik Sales</th> -->
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($prospek_data as $prospek)
            {
                ?>
                <tbody>
                <tr>
			<td ><?php echo ++$start ?></td>
			<td><?php echo $prospek->id_prospek ?></td>
			<!-- <td><?php echo $prospek->id_customer ?></td> -->
			<td width="100px"><?php echo $prospek->nama ?></td>
			<!-- <td><?php echo $prospek->alamat ?></td> -->
			<td><?php echo tgl_indo($prospek->tanggal) ?></td>
			<!-- <td><?php echo $prospek->no_ktp ?></td> -->
			<td><?php echo $prospek->no_hp ?></td>
			<!-- <td><?php echo $prospek->kode_barang ?></td> -->
			<td ><?php echo $prospek->nama_barang ?></td>
			<td ><?php echo $prospek->jumlah ?></td>
			<td>
        <?php if($prospek->status=='DEAL'){?>
          <span class="badge bg-green"><?php echo $prospek->status ?></span>
          <td style="text-align:center" width="150px">
              <?php 
              echo anchor(site_url('prospek/read/'.$prospek->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-default btn-sm')); 
              echo '  '; 
              echo anchor(site_url('prospek/update/'.$prospek->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
              // echo '  '; 
              // echo anchor(site_url('prospek/delete/'.$prospek->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
              ?>
            </td>
        <?php }else if($prospek->status=='paid'){?>
          <span class="badge bg-blue"><?php echo $prospek->status ?></span>
          <td style="text-align:center" width="150px">
              <?php 
              echo anchor(site_url('prospek/read/'.$prospek->id),'<i class="fa fa-eye"></i> Detail',array('title'=>'detail','class'=>'btn bg-maroon btn-flat btn-sm')); 
              echo '  '; 
              // echo anchor(site_url('prospek/update/'.$prospek->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
              // echo '  '; 
              echo anchor(site_url('prospek/cetak/'.$prospek->id),'<i class="fa fa-print"></i> Cetak','title="delete" target="_blank" class="btn btn-primary btn-flat btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
              ?>
            </td>
        <?php }else{?>
          <span class="badge bg-red"><?php echo $prospek->status ?></span>
          <td style="text-align:center" width="150px">
              <?php 
              echo anchor(site_url('prospek/read/'.$prospek->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-default btn-sm')); 
              echo '  '; 
              echo anchor(site_url('prospek/update/'.$prospek->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
              echo '  '; 
              echo anchor(site_url('prospek/delete/'.$prospek->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
              ?>
            </td>
          <?php }?>
      </td>
			<!-- <td><?php echo $prospek->nik_sales ?></td> -->
		
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
                <?php echo anchor(site_url('prospek/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('prospek/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('prospek/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
