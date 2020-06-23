
<!-- proses untuk menambah skema -->

<body onload="load_data_temp()"></body>
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#list_ku * { visibility: visible; }
#list_ku { position: absolute; top: 40px; left: 30px; }
}
</style>
<!-- Content Header (Page header) -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>

    <script type="text/javascript">

       function selesai()
       {
                var id_barang_masuk   = $("#id_barang_masuk").val();
                var tanggal           = $("#tanggal").val();
                var kode_barang       = $("#kode_barang").val();
                var nama_barang       = $("#nama_barang").val();
                var jumlah            = $("#jumlah").val();
            if(id_barang_masuk==''){
                alert('Data Belum Lengkap');
                die;
            }
            else
            {
            $.ajax({
                 type:"GET",
                    url:"checkout",
                    data:"id_barang_masuk="+id_barang_masuk+"&tanggal="+tanggal+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&jumlah="+jumlah,
                    success:function(html){
                       var ms=window.confirm('Simpan Data Berhasil');
                        if(ms){
                            load_data_temp();
                             window.location="<?php echo base_url('barang_masuk/create'); ?>";
                             }
                        }
                      
                });
        }
      
    }


        function load_data_temp()
        {
            var id_barang_masuk = $("#id_barang_masuk").val();
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('barang_masuk/load_temp')?>",
                data:"id_barang_masuk="+id_barang_masuk,
                success:function(html){
                    $('#list_ku').html(html);
                    document.getElementById("kode_barang").focus();

                }
            });
            
        }


         function hapus(id)
        {
            $.ajax({
                type:"GET",
                url:"hapus_temp",
                data:"id="+id,
                success:function(html){
                  $("#dataku"+id).hide(500);
                  load_data_temp();
                }
            });
        }

        function add_barang()
        {
                var id_barang_masuk   = $("#id_barang_masuk").val();
                var tanggal           = $("#tanggal").val();
                var kode_barang       = $("#kode_barang").val();
                var nama_barang       = $("#nama_barang").val();
                var jumlah            = $("#jumlah").val();
              if(id_barang_masuk==''|| tanggal=='' || kode_barang=='' || nama_barang=='' || jumlah==''){
                alert('Data Belum lengkap');
                die;
            }
            else
            {
             $.ajax({
                type:"GET",
                url:"input_ajax",
                data:"id_barang_masuk="+id_barang_masuk+"&tanggal="+tanggal+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&jumlah="+jumlah,
                success:function(html){
                   load_data_temp();
                    $("#kode_barang").val('');
                    $("#nama_barang").val('');
                    $("#jumlah").val('');
                    document.getElementById("kode_barang").focus();  
                }
             });
        }
}
    </script>



<!-- akhir proses -->

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang_masuk 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang_masuk</li>
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
            <label class="col-sm-2 control-label" for="varchar">Id Barang Masuk <?php echo form_error('id_barang_masuk') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_barang_masuk" id="id_barang_masuk" placeholder="Id Barang Masuk" value="<?php echo $kode;?>" readonly/>
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
            <div class="col-sm-12"><button class="btn btn-block btn-flat btn-primary" disabled>Data Barang</button></div>
        </div>
    </div>

    <div class="box-body"> 
        <div class="form-group">
            <div class="col-sm-10">
               <div class="col-md-4">
                <p>Kode Barang</p> 
                  <select name="kode_barang" id="kode_barang" class="form-control">
                  <option value="<?=$kode_barang?>" selected>Pilih Kode Barang</option>
                  <?php foreach($barang as $b):?>
                    <option value="<?=$b->kode_barang?>"><?=$b->kode_barang?> | <?=$b->nama_barang?></option>
                  <?php endforeach;?>
                  </select>
               </div>
               <div class="col-md-4">
                <p>Nama Barang</p> 
                    <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control">
               </div>
               <div class="col-md-2">
                <p>Jumlah Barang</p> 
                    <input type="number" name="jumlah" id="jumlah" placeholder="Jumlah" class="form-control">
               </div>
               <div class="col-md-2">
                <p></p> 
                <br>
                    <a href="#"  onclick="add_barang()" class="btn btn-bloc bg-maroon"><i class="fa fa-plus"></i></a>
               </div>
            </div>
        </div>
    </div>
	    
    <div class="box-body"> 
        <div class="form-group">
            <div class="col-sm-12"><button class="btn btn-block btn-flat btn-danger" disabled>Detail Barang Masuk</button></div>
        </div>
    </div>

    <div class="box-body"> 
     <div class="form-group"> 
            <div class="col-md-12" id="list_ku">
             
            </div>
    </div>



<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    
	    <a href="#" onclick="selesai()" class="btn btn-success"><i class="fa fa-floppy-o"> </i> Save All</a>
	    <a href="<?php echo site_url('barang_masuk') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>

<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){

$('#kode_barang').change(function(){    
var kode_barangnya = $('#kode_barang').val(); 

$.ajax({      
    method: "POST",      
    url: "<?php echo base_url('barang_masuk/ambil_data')?>", 
    dataType:'json',  
    data: { 'kode_barang': kode_barangnya}
  
  })
    .done(function( hasilajax) {   
      $("#nama_barang").val(hasilajax.nama_barang);
    });
})
});
    </script>
