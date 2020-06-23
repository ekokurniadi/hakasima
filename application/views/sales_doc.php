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
        <h2>Sales List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nik</th>
		<th>Nama Lengkap</th>
		<th>Jenis Kelamin</th>
		<th>Nomor Hp</th>
		<th>Password</th>
		<th>Role</th>
		<th>Foto</th>
		
            </tr><?php
            foreach ($sales_data as $sales)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sales->nik ?></td>
		      <td><?php echo $sales->nama_lengkap ?></td>
		      <td><?php echo $sales->jenis_kelamin ?></td>
		      <td><?php echo $sales->nomor_hp ?></td>
		      <td><?php echo $sales->password ?></td>
		      <td><?php echo $sales->role ?></td>
		      <td><?php echo $sales->foto ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>