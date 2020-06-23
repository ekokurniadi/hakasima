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
                var id_skema         = $("#id_skema").val();
                var kode_barang      = $("#kode_barang").val();
                var harga            = $("#harga").val();
                var tenor            = $("#tenor").val();
                var angsuran         = $("#angsuran").val();
                var jenis_pembelian   = $("#jenis_pembelian").val();
                var komisi           = $("#komisi").val();
                var kontes           = $("#kontes").val();
            if(id_skema==''){
                alert('Data Belum Lengkap');
                die;
            }
            else
            {
            $.ajax({
                 type:"GET",
                    url:"checkout",
                    data:"id_skema="+id_skema+"&kode_barang="+kode_barang+"&harga="+harga+"&tenor="+tenor+"&komisi="+komisi+"&kontes="+kontes+"&angsuran="+angsuran+"&jenis_pembelian="+jenis_pembelian,
                    success:function(html){
                       var ms=window.confirm('Simpan Data Berhasil');
                        if(ms){
                            load_data_temp();
                             window.location="<?php echo base_url('skema_kredit/create'); ?>";
                             }
                        }
                      
                });
        }
      
    }


        function load_data_temp()
        {
            var id_skema = $("#id_skema").val();
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('skema_kredit/load_temp')?>",
                data:"id_skema="+id_skema,
                success:function(html){
                    $('#list_ku').html(html);
                    document.getElementById("harga").focus();

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
                var id_skema         = $("#id_skema").val();
                var kode_barang      = $("#kode_barang").val();
                var harga            = $("#harga").val();
                var tenor            = $("#tenor").val();
                var angsuran         = $("#angsuran").val();
                var jenis_pembelian   = $("#jenis_pembelian").val();
                var komisi           = $("#komisi").val();
                var kontes           = $("#kontes").val();
              if(id_skema==''|| kode_barang=='' || harga=='' || tenor=='' || angsuran==''){
                alert('Data Belum lengkap');
                die;
            }
            else
            {
             $.ajax({
                type:"GET",
                url:"input_ajax",
                data:"id_skema="+id_skema+"&kode_barang="+kode_barang+"&harga="+harga+"&tenor="+tenor+"&komisi="+komisi+"&kontes="+kontes+"&angsuran="+angsuran+"&jenis_pembelian="+jenis_pembelian,
                success:function(html){
                   load_data_temp();
                    $("#harga").val('');
                    $("#tenor").val('');
                    $("#komisi").val('');
                    $("#kontes").val('');
                    $("#jenis_pembelian").val('');
                    document.getElementById("harga").focus();  
                }
             });
        }
}
    </script>



<!-- akhir proses -->



<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Skema_kredit 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Skema_kredit</li>
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
            <label class="col-sm-2 control-label" for="varchar">Id Skema <?php echo form_error('id_skema') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_skema" id="id_skema" placeholder="Id Skema" value="<?php echo $kode; ?>" readonly />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <div class="col-sm-6">
              <select name="kode_barang" id="kode_barang" class="form-control">
                <option value="<?php echo $kode_barang?>" selected><?php echo $kode_barang?></option>
                <?php foreach($brg as $b):?>
                <option value="<?php echo $b->kode_barang?>"><?php echo $b->kode_barang?> | <?php echo $b->nama_barang?></option>
                <?php endforeach;?>
              </select>
            </div>
        </div>
    </div>
    <div class="box-body"> 
        <div class="form-group">
            <div class="col-sm-2">
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $kode_barang; ?>" />
            </div>
            <div class="col-sm-1">
                <input type="number" class="form-control" name="tenor" id="tenor" placeholder="Tenor" value="<?php echo $kode_barang; ?>" />
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="angsuran" id="angsuran" placeholder="Angsuran" value="<?php echo $kode_barang; ?>" />
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="komisi" id="komisi" placeholder="Komisi" value="<?php echo $kode_barang; ?>" />
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="kontes" id="kontes" placeholder="Kontes" value="<?php echo $kode_barang; ?>" />
            </div>
            <div class="col-sm-2">
               <select name="jenis_pembelian" id="jenis_pembelian" class="form-control">
                    <option value="CASH">CASH</option>
                    <option value="KREDIT">KREDIT</option>
               </select>
            </div>
            <div class="col-sm-1">
               <a href="#" class="btn btn-primary btn-flat btn-sm" onclick="add_barang()"><i class="fa fa-plus">Add</i></a>
            </div>
        </div>
    </div>
   
    <div class="box-body"> 
    <div id="list_ku" class="table-responsive" style="margin:auto;">        
    </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
    <a href="#" class="btn bg-maroon" onclick="selesai()"><i class="fa fa-floppy-o"></i> Save All</a>
	    <a href="<?php echo site_url('skema_kredit') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
