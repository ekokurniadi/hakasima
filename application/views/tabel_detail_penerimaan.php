
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail transaksi 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Transaksi </li>
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
        <?php echo anchor(site_url('penerimaan'),'<i class="fa fa-eye"></i> View Data', 'class="btn bg-maroon"');?>
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
        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
		    <th>Sku</th>
		    <th>Description</th>
		    <th>Brand</th>
		    <th>Departement</th>
		    <th>Class</th>
		    <th>Subclass</th>
		    <th>Quantity</th>
		    <th>Price</th>
		    <!-- <th>Action</th> -->
                </tr>
            </thead>
	    <tbody>
            <?php
            $const="Rp ";
            $start = 0;
            foreach ($dt as $data)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $data->sku ?></a></td>
		    <td width="200px"><?php echo $data->dsc?></td>
		    <td><?php echo $data->brand ?></td>
		    <td width="100px"><?php echo $data->dept ?></td>
		    <td><?php echo $data->class ?></td>
            <?php 
            if ($data->subclass=='1')
            {
                ?>
		    <td><span class="label bg-red">Make Up</span></td>
            <?php }
           else if($data->subclass=='2')
           {?>
		    <td><span class="label bg-yellow">Skin Care</span></td>
            <?php } 
            else if($data->subclass==3)
            {
                ?>
            <td><span class="label bg-green">Tester</span></td>
            <?php };?>
            <td><?php echo $data->qty?></td>
                <td width="150px"><?php echo $const.number_format($data->subtotal ,2, ',', '.') ?></td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
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
