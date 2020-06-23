
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prospek 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Prospek</li>
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
                <input type="text" class="form-control" name="id_prospek" id="id_prospek" placeholder="Id Prospek" value="<?php echo $kode; ?>" readonly />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id Customer <?php echo form_error('id_customer') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_customer" id="id_customer" placeholder="Id Customer" value="<?php echo $kode1; ?>" readonly />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nama <?php echo form_error('nama') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
            </div>
        </div>
    </div>
	    
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <div class="col-sm-6">
                <textarea class="ckeditor" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">No Ktp <?php echo form_error('no_ktp') ?></label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="No Ktp" value="<?php echo $no_ktp; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <div class="col-sm-6">
              <select name="kode_barang" id="kode_barang" class="form-control">
              <option value="<?=$kode_barang?>"selected><?=$kode_barang?></option>
              <?php foreach($kobar as $brg):?>
                 <option value="<?=$brg->kode_barang?>"><?=$brg->kode_barang?> | <?=$brg->nama_barang?></option>
              <?php endforeach;?>
              </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>"  readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Jumlah <?php echo form_error('jumlah') ?></label>
            <div class="col-sm-6">
                <input type="number" oninput="sum()" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
                <input type="hidden" class="form-control" name="stok" id="stok" placeholder="Jumlah" />
            </div>
        </div>
    </div>
	   
    <!-- <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Jenis Pembelian <?php echo form_error('jenis_pembelian') ?></label>
            <div class="col-sm-6">
               <select name="jenis_pembelian" id="jenis_pembelian" class="form-control">
                <option value="<?=$jenis_pembelian?>" selected>Pilih Jenis Pembelian</option>
                <option value="CASH" >CASH</option>
                <option value="KREDIT" >KREDIT</option>
               </select>
            </div>
        </div>
    </div> -->
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Status <?php echo form_error('status') ?></label>
            <div class="col-sm-6">
            <select name="status" id="status" class="form-control">
                <option value="<?=$status?>" selected>Pilih status</option>
                <option value="DEAL">DEAL</option>
                <option value="NOT DEAL">NOT DEAL</option>
               </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nik Sales <?php echo form_error('nik_sales') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nik_sales" id="nik_sales" placeholder="Nik Sales" value="<?php echo $_SESSION['username'] ?>" />
            </div>
        </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('prospek') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

$('#kode_barang').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
var kode_barangnya = $('#kode_barang').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
$.ajax({        // Memulai ajax
    method: "POST",      
    url: "<?php echo base_url('prospek/ambil_data')?>", 
    dataType:'json',   // file PHP yang akan merespon ajax
    data: {kode_barang:kode_barangnya}
    // data POST yang akan dikirim
})
    .done(function( hasilajax) {   
    $('#nama_barang').val(hasilajax.nama_barang); // Isikan hasil dari ajak ke field 'nama' // KETIKA PROSES Ajax Request Selesai
    $('#stok').val(hasilajax.stok); // Isikan hasil dari ajak ke field 'nama' // KETIKA PROSES Ajax Request Selesai

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