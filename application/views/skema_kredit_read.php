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
        <h2 style="margin-top:0px">Skema_kredit Read</h2>
        <table class="table">
	    <tr><td>Id Skema</td><td><?php echo $id_skema; ?></td></tr>
	    <tr><td>Kode Barang</td><td><?php echo $kode_barang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('skema_kredit') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>