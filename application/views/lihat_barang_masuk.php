
<!-- proses untuk menambah skema -->

<body onload="load_data_temp2()"></body>
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


        function load_data_temp2()
        {
            var id_barang_masuk = $("#id_barang_masuk").val();
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('barang_masuk/load_temp2')?>",
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
        Detail Barang Masuk 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Detail Barang Masuk </li>
      </ol>
    </section>


<!-- column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post" class="form-horizontal">
	
    <div class="box-body"> 
        <div class="form-group">
            <div class="col-sm-12"><button class="btn btn-block btn-flat btn-primary" disabled>Detail Barang Masuk</button></div>
        </div>
    </div>

    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id Barang Masuk <?php echo form_error('id_barang_masuk') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_barang_masuk" id="id_barang_masuk" placeholder="Id Barang Masuk" value="<?php echo $id_barang_masuk;?>" readonly/>
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
        <div class="col-md-12" id="list_ku">
            
        </div>
    </div>
    </div>

    <div class="box-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        <a href="<?php echo base_url('barang_masuk')?>" class="btn btn-flat bg-maroon"><i class="fa fa-history"></i> Kembali</a>
    </div>
</form>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
var kode_barang = document.getElementById("kode_barang");
    kode_barang.addEventListener("change", function(event) {
    var kode_barangnya = $('#kode_barang').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
    $.ajax({        // Memulai ajax
      method: "POST",      
      url: "<?php echo base_url('barang_masuk/ambil_data')?>", 
      dataType:'json',   // file PHP yang akan merespon ajax
      data: { kode_barang: kode_barangnya}
      // data POST yang akan dikirim
    })
      .done(function( hasilajax) {   
          $("#nama_barang").val(hasilajax.nama_barang);
          document.getElementById("nama_barang").disabled = true;
          document.getElementById("jumlah").focus();
          // document.getElementById("qty").style.backgroundColor="#e88787";
      });
  })
});
</script>