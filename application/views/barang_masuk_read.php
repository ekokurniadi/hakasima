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
        <h2 style="margin-top:0px">Barang_masuk Read</h2>
        <table class="table">
	    <tr><td>Id Barang Masuk</td><td><?php echo $id_barang_masuk; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang_masuk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>