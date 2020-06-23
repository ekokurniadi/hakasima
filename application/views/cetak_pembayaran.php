<!DOCTYPE html>
<html>
<!-- <html lang="ar"> for arabic only -->
	<?php 
		function mata_uang($a){
		if(preg_match("/^[0-9,]+$/", $a)) $a = str_replace(',', '', $a);
		if(preg_match("/^[0-9,]+$/", $a)) $a = str_replace(',', '', $a);
			return number_format($a, 0, ',', '.');
		} ?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Cetak</title>
	<style>
		@media print {
			@page {
				sheet-size: 210mm 297mm;
				margin-left: 1cm;
				margin-right: 1cm;
				margin-bottom: 1cm;
				margin-top: 1cm;
			}
			.text-center{text-align: center;}
			.table {
					width: 100%;
					max-width: 100%;
					border-collapse: collapse;
				   /*border-collapse: separate;*/
				}
			.table-bordered tr td {
					border: 0px solid black;
					padding-left: 6px;
					padding-right: 6px;
				}
			body{
				font-family: "Arial";
				font-size: 11pt;
			}
		}
	</style>
</head>

<body>

<style>
		@media print {
				@page {
					sheet-size: 210mm 297mm;
					margin-left: 1cm;
					margin-right: 1cm;
					margin-bottom: 1cm;
					margin-top: 1cm;
				}
		}
	</style>
	<table class="table">
		<tr>
			<td colspan="2" align="left" style="font-size: 15pt"><b>NOTA PEMBAYARAN KONSUMEN</b></td>
		</tr>
		<tr>
			<td align="center">Nomor : <?php echo $sales_order_data->id_prospek ?></td></tr>
         <tr>   		
			<td align="center">Tanggal : <?php echo tgl_indo($sales_order_data->tanggal); ?></td>
		</tr>
	</table><br>	
	
	<table width="100%" border="0">
		<tr>
			<td style='border: 1px solid black;background-color:yellow' align="center" colspan="7"><b>DATA KONSUMEN</b></td>
		</tr>
		<tr>
			<td width="20%"><br>ID Customer</td><td width="1%"><br>:</td>
			<td width="30%"><br><?php echo $sales_order_data->id_customer ?></td><td width="2%"></td>
			<td width="20%"><br>Nama Lengkap</td><td width="1%"><br>:</td>
			<td width="30%"><br><?php echo $sales_order_data->nama ?></td>
		</tr>
		<tr>
			<td>Alamat Konsumen</td><td>:</td>
			<td><?php echo $sales_order_data->alamat ?></td><td></td>
			<td>No KTP</td><td>:</td>
			<td><?php echo $sales_order_data->no_ktp ?></td>
		</tr>
		<tr>
			<td>No HP</td><td>:</td>
			<td><?php echo $sales_order_data->no_hp ?></td><td></td>
			
		</tr>
		<tr>
			<td style='border: 1px solid black;background-color:yellow' align="center" colspan="7"><b>DATA BARANG PESANAN</b></td>
		</tr>
			<tr>
				<td width="20%"><br>Kode Barang</td><td width="1%"><br>:</td>
				<td width="30%"><br><?php echo $sales_order_data->kode_barang ?></td><td width="2%"></td>
				<td width="20%"><br>Nama Barang</td><td width="1%"><br>:</td>
				<td width="30%"><br><?php echo $sales_order_data->nama_barang?></td>
			</tr>
			<tr>
				<td width="20%">Jumlah Barang</td><td width="1%">:</td>
				<td width="30%"><?php echo $sales_order_data->jumlah?></td><td width="2%"></td>
				
			</tr>
		<tr>
			<td style='border: 1px solid black;background-color:yellow' align="center" colspan="7"><b>SISTEM PEMBELIAN</b></td>
		</tr>
            <tr>
                <td width="20%">Jenis Pembelian</td><td width="1%">:</td>
				<td width="30%"><?php echo $sales_order_data->jenis_pembelian?></td>
            </tr>
			<tr>
				<td width="20%">Harga</td><td width="1%">:</td>
				<td width="30%">Rp. <?php echo number_format($sales_order_data->harga) ?></td><td width="2%"></td>
				<td width="20%">Tenor</td><td width="1%">:</td>
				<td width="30%"><?php echo $sales_order_data->tenor ?> x</td>
			</tr>
			<tr>
				<td width="20%">Angsuran</td><td width="1%">:</td>
				<td width="30%">Rp. <?php echo number_format($sales_order_data->angsuran) ?></td><td width="2%"></td>

				
		<tr>
			<td style='border: 1px solid black;background-color:yellow' align="center" colspan="7"><b>SYARAT DAN KETENTUAN</b></td>
		</tr>
		<tr>
			<td colspan="7"><br>1. Harga yang tercantum dalam nota pembayaran ini tidak mengikat dan nota pembayaran ini merupakan bukti pembayaran</td>
		</tr>
		<tr>
			<td colspan="7">2. Nota Pembayaran ini dianggap SAH apabila ditandatangani oleh Pemesan dan  Sales Person.</td>
		</tr>
		<!-- <tr>
			<td colspan="7">3. Pembayaran dengan Cek/ Bilyet Giro/ Transfer dianggap sah apabila telah diterima di rekening:</td>
		</tr>		 -->
		<!-- <tr>
			<td colspan="7">4. Pembayaran Tunai dianggap <b>sah</b> apabila telah diterbitkan kwitansi oleh <b> Kepala Cabang</b></td>
		</tr> -->
		<tr>
			<td align="center" colspan="2"><br><br>PEMESAN</td>
			<td colspan="2" align="center"><br><br>SALES PERSON</td>
			
		</tr>
		<tr>
			<td><br><br><br></td>
		</tr>
        <?php $ku=$_SESSION['username'];?>
		<tr>
            
			<td style="padding-left:30px;"align="center"><br><br>(<?php echo $sales_order_data->nama ?>)</td>
			<td style="padding-left:30px;" colspan="2" align="center"><br><br>(<?php echo $ku ?>)</td>
						
		</tr>

	</table>


</body>
</html>
