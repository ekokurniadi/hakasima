<!doctype html>
<html>
    <head>
        <title>SKU</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <!-- <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/> -->
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="../plugins/select2/dist/css/select2.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
        <!-- <style>
            body{
                padding: 15px;
            }
        </style> -->
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-3" style="padding-left:30px;">
                <h2 style="margin-top:0px">Sku List</h2>
              <?php echo anchor(site_url('transaksi/create'), 'Tambah Transaksi', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
		<th>Kode Transaksi</th>
		<th>Tanggal Transaksi</th>
		<th>Status</th>
		<th>Action</th>
            </tr>
            </thead><?php
            foreach ($slider_data as $slider)
            {
                ?>
                <tbody>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><img src="<?php echo base_url().'image/'.$slider->foto ?>" width="300" height="100"></td>
			<td><?php echo $slider->tag_line ?></td>
			<td><?php echo $slider->slogan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('slider/read/'.$slider->id),'<i class="fa fa-eye"></i>',array('title'=>'detail','class'=>'btn btn-default btn-sm')); 
				echo '  '; 
				// echo anchor(site_url('slider/update/'.$slider->id),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-warning btn-sm')); 
				// echo '  '; 
				// echo anchor(site_url('slider/delete/'.$slider->id),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr></tbody>
                <?php
            }
            ?>
            <tfoot>
                
                </tfoot>
        </table>
        <div class="row">
            <div class="col-md-6" style="padding-left:30px;">
                <!-- <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a> -->
                <!-- <?php echo anchor(site_url('sku/exportcsv'),'<i class="fa fa-file-excel-o"></i> Csv', 'class="btn btn-success btn-sm"'); ?> -->
		<?php echo anchor(site_url('sku/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('sku/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-info btn-sm"'); ?>
	    </div>
            <div class="col-md-6 text-right">
               <!-- <?php echo $pagination ?> -->
            </div>
        </div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
                
            });
        </script>
    </body>
</html>