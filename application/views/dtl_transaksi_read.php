<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Dtl_transaksi Read</h2>
        <table class="table">
	    <tr><td>Kode Transaksi</td><td><?php echo $kode_transaksi; ?></td></tr>
	    <tr><td>Sku</td><td><?php echo $sku; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Brand</td><td><?php echo $brand; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
	    <tr><td>Departement</td><td><?php echo $departement; ?></td></tr>
	    <tr><td>Class</td><td><?php echo $class; ?></td></tr>
	    <tr><td>Subclass</td><td><?php echo $subclass; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Id User</td><td><?php echo $id_user; ?></td></tr>
	    <tr><td>Tanggal Transaksi</td><td><?php echo $tanggal_transaksi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('dtl_transaksi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>