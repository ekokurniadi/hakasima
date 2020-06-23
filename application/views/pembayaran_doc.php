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
        <h2>Pembayaran List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		<th>Status</th>
		<th>Nik Sales</th>
		
            </tr><?php
            foreach ($pembayaran_data as $pembayaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pembayaran->id_prospek ?></td>
		      <td><?php echo $pembayaran->id_customer ?></td>
		      <td><?php echo $pembayaran->nama ?></td>
		      <td><?php echo $pembayaran->alamat ?></td>
		      <td><?php echo $pembayaran->tanggal ?></td>
		      <td><?php echo $pembayaran->no_ktp ?></td>
		      <td><?php echo $pembayaran->no_hp ?></td>
		      <td><?php echo $pembayaran->kode_barang ?></td>
		      <td><?php echo $pembayaran->nama_barang ?></td>
		      <td><?php echo $pembayaran->jumlah ?></td>
		      <td><?php echo $pembayaran->jenis_pembelian ?></td>
		      <td><?php echo $pembayaran->harga ?></td>
		      <td><?php echo $pembayaran->tenor ?></td>
		      <td><?php echo $pembayaran->angsuran ?></td>
		      <td><?php echo $pembayaran->status ?></td>
		      <td><?php echo $pembayaran->nik_sales ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>