<!doctype html>
<html>
    <head>
        <title></title>
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
                font-size:12px;
            }
        </style>
    </head>
    <body>
        <h2>Prospek List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
              
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
		<th>Status</th>
		<th>Nik Sales</th>
		
            </tr>
                <tr>
		     
		      <td><?php echo $prospek_data->id_prospek ?></td>
		      <td><?php echo $prospek_data->id_customer ?></td>
		      <td><?php echo $prospek_data->nama ?></td>
		      <td><?php echo $prospek_data->alamat ?></td>
		      <td><?php echo $prospek_data->tanggal ?></td>
		      <td><?php echo $prospek_data->no_ktp ?></td>
		      <td><?php echo $prospek_data->no_hp ?></td>
		      <td><?php echo $prospek_data->kode_barang ?></td>
		      <td><?php echo $prospek_data->nama_barang ?></td>
		      <td><?php echo $prospek_data->jumlah ?></td>
		      <td><?php echo $prospek_data->status ?></td>
		      <td><?php echo $prospek_data->nik_sales ?></td>	
                </tr>
              
        </table>
    </body>
</html>