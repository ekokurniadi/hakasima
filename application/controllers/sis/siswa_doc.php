<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 50%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Siswa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nis</th>
		<th>Nama</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Agama</th>
		<th>Jenis Kelamin</th>
		<th>Alamat</th>
		<th>Kelas</th>
		<th>Status</th>
		<th>Nama Ayah</th>
		<th>Nama Ibu</th>
		<th>Pekerjaan Ayah</th>
		<th>Pekerjaan Ibu</th>
		<th>Foto</th>
		
            </tr><?php
            foreach ($siswa_data as $siswa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $siswa->nis ?></td>
		      <td><?php echo $siswa->nama ?></td>
		      <td><?php echo $siswa->tempat_lahir ?></td>
		      <td><?php echo $siswa->tanggal_lahir ?></td>
		      <td><?php echo $siswa->agama ?></td>
		      <td><?php echo $siswa->jenis_kelamin ?></td>
		      <td><?php echo $siswa->alamat ?></td>
		      <td><?php echo $siswa->kelas ?></td>
		      <td><?php echo $siswa->status ?></td>
		      <td><?php echo $siswa->nama_ayah ?></td>
		      <td><?php echo $siswa->nama_ibu ?></td>
		      <td><?php echo $siswa->pekerjaan_ayah ?></td>
		      <td><?php echo $siswa->pekerjaan_ibu ?></td>
		      <td><?php echo $siswa->foto ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>