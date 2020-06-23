
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembayaran 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pembayaran</li>
      </ol>
    </section>


<!-- column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id Prospek <?php echo form_error('id_prospek') ?></label>
            <div class="col-sm-6">
               <select name="id_prospek" id="id_prospek" class="form-control">
                <option value="<?=$id_prospek?>" selected>Pilih ID Prospek</option>
                <?php foreach($pros as $pd):?>
                    <option value="<?=$pd->id_prospek?>"><?=$pd->id_prospek?> | <?=$pd->nama?></option>
                <?php endforeach;?>
               </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id Customer <?php echo form_error('id_customer') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_customer" id="id_customer" placeholder="Id Customer" value="<?php echo $id_customer; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nama <?php echo form_error('nama') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" readonly/>
            </div>
        </div>
    </div>
	    
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <div class="col-sm-6">
                <textarea class="ckeditor" rows="3" name="alamat" id="alamat" placeholder="Alamat" readonly></textarea>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">No Ktp <?php echo form_error('no_ktp') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="No Ktp" value="<?php echo $no_ktp; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" readonly />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Jumlah <?php echo form_error('jumlah') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Jenis Pembelian <?php echo form_error('jenis_pembelian') ?></label>
            <div class="col-sm-6">
              <select name="jenis_pembelian" id="jenis_pembelian" class="form-control">
                    <option value="<?=$jenis_pembelian?>"selected><?=$jenis_pembelian?></option>
                    <option value="KREDIT">KREDIT</option>
              </select>
            </div>
        </div>
    </div>
	   
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Tenor <?php echo form_error('tenor') ?></label>
            <div class="col-sm-6">
                <select name="tenor" id="tenor" class="form-control">
                <option value="<?=$tenor?>"selected>Choose Tenor</option>
                <option value="2">2X</option>
                <option value="3">3X</option>
                <option value="6">6X</option>
                <option value="10">10X</option>
                </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Angsuran <?php echo form_error('angsuran') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="angsuran" id="angsuran" placeholder="Angsuran" value="<?php echo $angsuran; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Harga <?php echo form_error('harga') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
            </div>
        </div>
    </div>
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Status <?php echo form_error('status') ?></label>
            <div class="col-sm-6">
                <select name="status" id="status" class="form-control">
                    <option value="<?=$status?>"selected>Select an option</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nik Sales <?php echo form_error('nik_sales') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nik_sales" id="nik_sales" placeholder="Nik Sales" value="<?php echo $nik_sales; ?>" />
            </div>
        </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pembayaran') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>

<!-- fungsi javascript -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

$('#id_prospek').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
var id_prospeknya = $('#id_prospek').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
$.ajax({        // Memulai ajax
    method: "POST",      
    url: "<?php echo base_url('pembayaran/ambil_data')?>", 
    dataType:'json',   // file PHP yang akan merespon ajax
    data: {id_prospek:id_prospeknya}
    // data POST yang akan dikirim
})
    .done(function( hasilajax) {   
    $('#id_customer').val(hasilajax.id_customer); 
    $('#nama').val(hasilajax.nama); 
    CKEDITOR.instances['alamat'].setData(hasilajax.alamat);
    $('#tanggal').val(hasilajax.tanggal); 
    $('#no_ktp').val(hasilajax.no_ktp); 
    $('#no_hp').val(hasilajax.no_hp); 
    $('#kode_barang').val(hasilajax.kode_barang); 
    $('#nama_barang').val(hasilajax.nama_barang); 
    $('#jumlah').val(hasilajax.jumlah); 
    $('#nik_sales').val(hasilajax.nik_sales); 

    });
})
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$('#jenis_pembelian').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
var jenis_pembeliannya = $('#jenis_pembelian').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
var kode_barangnya = $('#kode_barang').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
$.ajax({        // Memulai ajax
    method: "POST",      
    url: "<?php echo base_url('pembayaran/metode_pembayaran')?>", 
    dataType:'json',   // file PHP yang akan merespon ajax
    data:"jenis_pembelian="+jenis_pembeliannya+"&kode_barang="+kode_barangnya,
    // data POST yang akan dikirim
})
    .done(function(mp) {   
    $('#harga').val(mp.harga); 
    $('#tenor').val(mp.tenor); 
    $('#angsuran').val(mp.angsuran); 
    });
})
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$('#tenor').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
var tenornya = $('#tenor').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
var jenis_pembeliannya = $('#jenis_pembelian').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
var kode_barangnya = $('#kode_barang').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
$.ajax({        // Memulai ajax
    method: "POST",      
    url: "<?php echo base_url('pembayaran/tenor')?>", 
    dataType:'json',   // file PHP yang akan merespon ajax
    data:"jenis_pembelian="+jenis_pembeliannya+"&kode_barang="+kode_barangnya+"&tenor="+tenornya,
    // data POST yang akan dikirim
})
    .done(function(tr) {   
    $('#harga').val(tr.harga); 
    $('#angsuran').val(tr.angsuran); 
    });
})
});
</script>


<script>
function sum() {
      var jumlah = $('#jumlah').val();
      var stok = $('#stok').val();
      var nama_barang =$('#nama_barang').val();
    
    //   fungsi pengecekan stok
      if(stok < jumlah)
         {
            alert('Stok tidak mencukupi, stok item : '+ nama_barang +' tersedia : '+stok );
            document.getElementById('jumlah').value=1;
           
        }else if(jumlah<=0)
        {
            alert('Jumlah Pembelian minimal 1, stok item : '+ nama_barang +' tersedia : '+stok );
            document.getElementById('jumlah').value=1;
        }
}
</script>

<!-- akhir fungsi -->