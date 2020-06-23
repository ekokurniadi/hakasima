<html>
<head>
    <title>Nota Transaksi</title>
</head>
<body>
<table>
<tr><img src="image/logo_matahari.png" width="200"></tr>
</table>
<h1 style="text-align: center;">Nota Transaksi</h1>
<?php echo "Tanggal : ".date('d-m-Y'); ?><br><br>
<hr>

<table>
<?php
if( ! empty($nota)){
    $no = 1;
    foreach($nota as $data){?>
        <tr>
        <td style='text-align:left'>Kode Transaksi   : <td><?=$data->kode_transaksi?></td></td>
        </tr>
        <tr>
        <td style='text-align:left'>Kode User        : <td><?=$data->user_id?></td></td>
        </tr>
        <tr>
        <td style='text-align:left'>Tanggal Transaksi    : <td><?=$data->tanggal_transaksi?></td>
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
    <th>SKU</th>
    <th style='text-align:left'>Nama Barang</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
</tr>
<?php
$no=1;
if( ! empty($nota)){
    $period_array = array();
    foreach($nota as $data){
        $period_array[] = intval($data->subtotal);
        ?>
        <tr>
        <td style='text-align:center'><?php echo $no?></td>
        <td style='text-align:center'><?=$data->sku?></td>
        <td style='text-align:left'><?=$data->dsc?></td>
        <td style='text-align:center'><?=number_format($data->price)?></td>
        <td style='text-align:center'><?=$data->qty?></td>
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
        <td style='text-align:center'><?php echo number_format($total=array_sum($period_array))?></td>
       </tr>
        </tfoot>
  <?php
   }

  ?> 

</table>
</body>
</html>