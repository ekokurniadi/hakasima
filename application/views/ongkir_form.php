

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

        function load_data_temp()
        {
            var kode_ongkir = $("#kode_ongkir").val();
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('ongkir/load_temp')?>",
                data:"kode_ongkir="+kode_ongkir,
                success:function(html){
                    $('#list_ku').html(html);
                }
            });
            
        }


         function hapus(id)
        {
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('ongkir/hapus_temp')?>",
                data:"id="+id,
                success:function(html){
                  $("#dataku"+id).hide(500);
                  load_data_temp();
                }
            });
        }

        function add_barang()
        {
                var kode_ongkir   = $("#kode_ongkir").val();
                var ekspedisi     = $("#ekspedisi").val();
                var id_provinsi   = $("#kode_provinsi").val();
                var kabupaten     = $("#kabupaten").val();
                var layanan       = $("#layanan").val();
                var ongkir        = $("#ong").val();
                var lama          = $("#lama").val();
               
              if(kode_ongkir==''|| ekspedisi=='' || ongkir=='' ){
                alert('Data Belum lengkap');
                die;
            }
            else
            {
             $.ajax({
                type:"GET",
                url:"<?php echo base_url('ongkir/input_ajax')?>",
                data:"kode_ongkir="+kode_ongkir+"&ekspedisi="+ekspedisi+"&id_provinsi="+id_provinsi+"&kabupaten="+kabupaten+"&layanan="+layanan+"&ongkir="+ongkir+"&lama="+lama,
                success:function(html){
                   load_data_temp();
                    $("#id_provinsi").val('');
                    $("#kabupaten").val('');
                    $("#layanan").val('');
                    $("#ong").val('');
                    $("#lama").val('');
                }
             });
        }
}
    </script>



<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ongkir 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ongkir</li>
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
            <label class="col-sm-2 control-label" for="varchar">Kode Ongkir <?php echo form_error('kode_ongkir') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="kode_ongkir" id="kode_ongkir" placeholder="Kode Ongkir" value="<?php echo $kode; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Ekspedisi <?php echo form_error('ekspedisi') ?></label>
            <div class="col-sm-6">
               <?php $data_eks =$this->db->query("SELECT * FROM ekspedisi")->result();?>
               <select name="ekspedisi" id="ekspedisi" class="form-control">
               <option value="">Select an Option</option>
               <?php foreach($data_eks as $eks):?>
               <option value="<?=$eks->id?>"><?=$eks->ekspedisi?></option>
               <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
    <div class="box-body"> 
        <div class="form-group">
        <div class="col-md-12">
           <a class="btn btn-danger btn-flat btn-block" disabled>Detail</a>
           </div>
        </div>
    </div>
    <div class="box-body"> 
        <div class="form-group">
        <div class="col-md-12">
         <div class="table-responsive">
          <table>
            <tr>
            <td width="400px">
                        Provinsi
                        <select name="kode_provinsi" id="kode_provinsi" class="form-control">
                                <option value="">--Please-select---</option>
                                <?php
                                    foreach($kode_provinsi as $data){ // Lakukan looping pada variabel siswa dari controller
                                        echo "<option value='".$data->id."'>".$data->provinsi.""."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td width="300px" >
                       Kabupaten
                            <select name="kabupaten" id="kabupaten" class="form-control">
                                <option value=""></option>
                            </select>
                           
                        </td>
              <td>
              Layanan
                  <select name="layanan" id="layanan" class="form-control">
                  <option value="">Select an option</option>
                  <?php $layanan=$this->db->query("select * from layanan")->result();?>
                  <?php foreach($layanan as $lay):?>
                  <option value="<?=$lay->layanan?>"><?=$lay->layanan?></option>
                  <?php endforeach;?>
                   </select>
              </td>
              <td width="200px" >
              Lama Pengiriman
              <input type="number" name="lama" id="lama" class="form-control" placeholder="1">
              </td>
              <td>
              Ongkos Kirim
              <input type="text" name="ong" id="ong" class="form-control" placeholder="Rp.0">
              </td>
              <td><br><a class="btn btn-primary btn-md" onclick="add_barang();"><i class="fa fa-plus"></i></a></td>
            </tr>
          </table>
         </div>
           </div>
        </div>
    </div>

    <div class="box-body"> 
     <div class="form-group"> 
            <div class="col-md-12" id="list_ku">
            </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ongkir') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
<script src="<?php echo base_url()?>jquery.min/jquery.min.js"></script>
<script>
        $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
            $("#kode_provinsi").change(function(){ // Ketika user mengganti atau memilih data provinsi
                
              
                $.ajax({
                    type: "POST", // Method pengiriman data bisa dengan GET atau POST
                    url: "<?php echo base_url("ongkir/list_kab"); ?>", // Isi dengan url/path file php yang dituju
                    data: {kode_provinsi : $("#kode_provinsi").val()}, // data yang akan dikirim ke file yang dituju
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){ // Ketika proses pengiriman berhasil
                        $("#kabupaten").html(response.list_kab).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                });
            });
        });
</script>