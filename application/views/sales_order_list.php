
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales_order 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales_order </li>
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
                <?php echo anchor(site_url('sales_order/history'),'<i class="fa fa-history"></i> History Sales Order', 'class="btn bg-maroon"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
               <!-- <form action="<?php echo site_url('sales_order/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('sales_order'); ?>" class="btn btn-default">Reset</a>
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
		<th>Alamat</th>
		<th>Tanggal</th>
		<th>No Ktp</th>
		<th>No Hp</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Jenis Pembelian</th>
		<th>Harga</th>
		<th>Tenor</th>
		<th>Angsuran</th>
		<th>Nik Sales</th>
		<th>Status</th>
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($sales_order_data as $sales_order)
            {
                ?>
                <tbody>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sales_order->id_prospek ?></td>
			<td><?php echo $sales_order->id_customer ?></td>
			<td><?php echo $sales_order->nama ?></td>
			<td><?php echo $sales_order->alamat ?></td>
			<td><?php echo $sales_order->tanggal ?></td>
			<td><?php echo $sales_order->no_ktp ?></td>
			<td><?php echo $sales_order->no_hp ?></td>
			<td><?php echo $sales_order->kode_barang ?></td>
			<td><?php echo $sales_order->nama_barang ?></td>
			<td><?php echo $sales_order->jumlah ?></td>
			<td><?php echo $sales_order->jenis_pembelian ?></td>
			<td><?php echo $sales_order->harga ?></td>
			<td><?php echo $sales_order->tenor ?></td>
			<td><?php echo $sales_order->angsuran ?></td>
      <td><?php echo $sales_order->nik_sales ?></td>
			<td><?php if($sales_order->status=='paid'){?>
          <span class="badge bg-blue"><?php echo $sales_order->status ?></span>
          <td style="text-align:center" width="150px">
              <?php 
              echo anchor(site_url('sales_order/read/'.$sales_order->id),'<i class="fa fa-eye"></i> Detail',array('title'=>'detail','class'=>'btn bg-maroon btn-flat btn-block btn-sm')); 
              echo '  '; 
              // echo anchor(site_url('sales_order/update/'.$sales_order->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
              echo '  '; 
              echo anchor(site_url('sales_order/update/'.$sales_order->id),'<i class="fa fa-download"></i> Konfirmasi','title="confirm" class="btn btn-primary btn-flat btn-block btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
              ?>
            </td>
        <?php }?>
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
                <?php echo anchor(site_url('sales_order/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('sales_order/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('sales_order/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
    </section>
    <!-- /.content -->
