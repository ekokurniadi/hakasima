<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Dtl_transaksi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Transaksi</th>
		<th>Sku</th>
		<th>Brand</th>
		<th>Price</th>
		<th>Departement</th>
		<th>Class</th>
		<th>Subclass</th>
		<th>Jumlah</th>
		<th>Total</th>
		<th>Status</th>
		<th>Id User</th>
		<th>Tanggal Transaksi</th>
		
            </tr><?php
            foreach ($dtl_transaksi_data as $dtl_transaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $dtl_transaksi->kode_transaksi ?></td>
		      <td><?php echo $dtl_transaksi->sku ?></td>
		      <td><?php echo $dtl_transaksi->brand ?></td>
		      <td><?php echo $dtl_transaksi->price ?></td>
		      <td><?php echo $dtl_transaksi->departement ?></td>
		      <td><?php echo $dtl_transaksi->class ?></td>
		      <td><?php echo $dtl_transaksi->subclass ?></td>
		      <td><?php echo $dtl_transaksi->jumlah ?></td>
		      <td><?php echo $dtl_transaksi->total ?></td>
		      <td><?php echo $dtl_transaksi->status ?></td>
		      <td><?php echo $dtl_transaksi->id_user ?></td>
		      <td><?php echo $dtl_transaksi->tanggal_transaksi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>