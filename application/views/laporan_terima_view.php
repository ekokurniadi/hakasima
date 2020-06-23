<html>
<head>
    <title>Laporan Penerimaan Barang Bulanan Per Brand</title>
</head>
<body>
<table>
<tr><img src="image/logo_matahari.png" width="200"></tr>
</table>
<h1 style="text-align: center;">Laporan Penerimaan Bulanan Per Brand</h1>
<?php echo "Tanggal Cetak : ".date('d-m-Y'); ?><br><br>
<hr>

<table>
<?php
if( ! empty($jual_data)){
    $no = 1;
    foreach($jual_data as $data){?>
        <!-- <tr>
        <td style='text-align:left'>Kode Transaksi   : <td><?=$data->kode_transaksi?></td></td>
        </tr>
        <tr>
        <td style='text-align:left'>Kode User        : <td><?=$data->user_id?></td></td>
        </tr> -->
        <tr>
        <td style='text-align:left'>Tanggal Penerimaan    : <td><?=$data->tanggal?></td>
        </tr>
  <?php
  break;
   $no++;
    }
}
  ?>
  </table> 
  <hr>
<table width="100%">
<tr>
    <th>No</th>
    <th>Brand</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Subtotal</th>
    <th>Grandtotal</th>
</tr>
<?php
$no=1;
if( ! empty($jual_data)){
    $period_array = array();
    foreach($jual_data as $data){
        $period_array[] = intval($data->subtotal);
        ?>
        <tr>
        <td style='text-align:center'><?php echo $no?></td>
        <td style='text-align:center'><?=$data->brand?></td>
        <td style='text-align:center'><?=$data->qty?></td>
        <td style='text-align:center'><?=number_format($data->price)?></td>
        <td style='text-align:center'><?=number_format($data->subtotal)?></td>
        </tr>
        <?php
        $no++;
     }
    
    ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>----------------------------</td>
        </tr>
        <tfoot>
        
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'>Grand Total :</td>
        <td style='text-align:center'><?php echo number_format(array_sum($period_array))?></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
       
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
      
      
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'>Mengetahui</td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'></td>
        <td style='text-align:center'></td>
       </tr>
       <tr>
        <td></td>
        <td></td>
       
        <td></td>
        <td></td>
        <td></td>
        <td style='text-align:center'>(-------------------------)</td>
        <td style='text-align:center'></td>
       </tr>
        </tfoot>

      
  <?php
   }

  ?> 

</table>
</body>
</html>