<body onload="load_data_temp()"></body>
<!-- Content Header (Page header) -->
    <script type="text/javascript" src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>

    <script type="text/javascript">

       function selesai()
       {
                var kode_transaksi   = $("#kode_transaksi").val();
                var user_id          = $("#user_id").val();
                var sku              = $("#sku").val();
                var description      = $("#description").val();
                var brand            = $("#brand").val();
                var price            = $("#price").val();
                var dept             = $("#dept").val();
                var classes          = $("#classes").val();
                var subclass         = $("#subclass").val();
                var qty              = $("#qty").val();
                var subtotal         = $("#subtotal").val();
                var tanggal         = $("#tanggal").val();
            if(kode_transaksi==''){
                alert('Data Belum Lengkap');
                die;
            }
            else
            {
            $.ajax({
                 type:"GET",
                    url:"checkout",
                    data:"kode_transaksi="+kode_transaksi+"&user_id="+user_id+"&sku="+sku+"&description="+description+"&brand="+brand+"&price="+price+"&dept="+dept+"&classes="+classes+"&subclass="+subclass+"&qty="+qty+"&subtotal="+subtotal+"&tanggal="+tanggal,
                    success:function(html){
                       alert('Transaksi Berhasil');
                        load_data_temp();
                        // $("#sku").val('');
                        // $("#description").val('');
                        // $("#brand").val('');
                        // $("#price").val('');
                        // $("#dept").val('');
                        // $("#classes").val('');
                        // $("#subclass").val('');
                        // $("#qty").val('');
                        // $("#subtotal").val('');
                        // $("#tanggal").val('');
                        window.location="<?php echo base_url('penerimaan/create'); ?>";
                    }
                });
        }
      
    }


        function load_data_temp()
        {
            var kode_transaksi   = $("#kode_transaksi").val();
            $.ajax({
                type:"GET",
                url:"<?php echo base_url('penerimaan/load_temp')?>",
                data:"kode_transaksi="+kode_transaksi,
                success:function(html){
                    $('#list_ku').html(html);
                    document.getElementById("sku").focus();

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
                var kode_transaksi   = $("#kode_transaksi").val();
                var user_id          = $("#user_id").val();
                var sku              = $("#sku").val();
                var description      = $("#description").val();
                var brand            = $("#brand").val();
                var price            = $("#price").val();
                var dept             = $("#dept").val();
                var classes          = $("#classes").val();
                var subclass         = $("#subclass").val();
                var qty              = $("#qty").val();
                var subtotal         = $("#subtotal").val();
                var tanggal         = $("#tanggal").val();
              if(sku==''|| qty=='' || dept=='' || brand=='' || description==''){
                alert('Data Belum lengkap');
                die;
            }
            else
            {
             $.ajax({
                type:"GET",
                url:"input_ajax",
                data:"kode_transaksi="+kode_transaksi+"&user_id="+user_id+"&sku="+sku+"&description="+description+"&brand="+brand+"&price="+price+"&dept="+dept+"&classes="+classes+"&subclass="+subclass+"&qty="+qty+"&subtotal="+subtotal+"&tanggal="+tanggal,
                success:function(html){
                   load_data_temp();
                    $("#sku").val('');
                    $("#description").val('');
                    $("#brand").val('');
                    $("#price").val('');
                    $("#dept").val('');
                    $("#classes").val('');
                    $("#subclass").val('');
                    $("#qty").val('');
                    $("#subtotal").val('');
                    document.getElementById("sku").focus();
                    
                }
             });
        }
}
    </script>
    

    <section class="content-header">
      <h1>
        Penerimaan SKU
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Penerimaan SKU</li>
      </ol>
    </section>


<!-- column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border"></div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal">

            <table class="table table-bordered">
                
            <tr><td width="200px" >Kode Penerimaan</td><td>
                    
                    <div class="col-sm-6">
                        <input type="text" class="form-control " name="kode_transaksi" id="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo $kode; ?>" readonly="true" />
                    </div>
                    <div class="col-sm-6">
                       <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value="<?php echo $user_id=$this->session->userdata['username']; ?>" readonly="true"/>
                    </div>
                      <div class="col-sm-3">
                        <input type="hidden" class="form-control text-right" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo date("Y-m-d")?>" autocomplete="off" />
                    </div>
            </td></tr>

             <tr><td>Detail Penerimaan</td>
             <td>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right" placeholder="SKU" name="sku" id="sku">
                </div>
                <div class="col-sm-5">
                     <input type="text" class="form-control text-right" placeholder="Description" name="description" id="description" readonly>
                 </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control text-right" name="brand" id="brand" placeholder="Brand" readonly />
                </div>
            </td></tr>
            <tr>
                <td></td>
                <td>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right" name="price" id="price" placeholder="Price" value="<?php echo $jumlah; ?>" readonly/>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right" name="dept" id="dept" placeholder="Dept" value="<?php echo $jumlah; ?>" readonly/>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right" name="class" id="classes" placeholder="Class" value="<?php echo $jumlah; ?>"readonly />
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right" name="subclass" id="subclass" placeholder="Subclass" value="<?php echo $jumlah; ?>" readonly/>
                </div>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="qty" id="qty" required oninput="sum()" placeholder="Qty" value="<?php echo $jumlah; ?>" />
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-right " name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo $jumlah; ?>" readonly/>
                </div>
                </td>
            </tr>  
            <tr>
            <td></td><td><div class="col-sm-1">
               <a class="btn btn-info btn-md" onclick="add_barang()"><i class="fa fa-plus" ></i> Add Items</a></div></td>
            </tr>          
            </table>
            <div id="list_ku" class="table-responsive">
            </div>
                <table class="table table bordered table-responsive">
                <!-- <tbody>
                <tr>
                <td><label for="label" class="label label-info" >Tekan F2 untuk simpan transaksi</label></td>
                </tr>
                
                </tbody> -->
               
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                        <input type="hidden" class="form-control " name="kode_transaksi" id="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo $kode; ?>" readonly="true" />
                            <button type="button" onclick="selesai()" class="btn bg-maroon"><i class="fa fa-floppy-o"></i> Simpan Penerimaan</button> 
                            <a href="<?php echo site_url('penerimaan') ?>" class="btn btn-default">Kembali</a>
                    </td>
                </tr>
              
                </table>
        </form>
     </div>
    </div>

    <script>
function sum() {
      var txtFirstNumberValue = $('#price').val();
      var txtSecondNumberValue = $('#qty').val();
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('subtotal').value = result;
      }else{
          document.getElementById('subtotal').value=0;
      }
}
</script>

<script type="text/javascript">
$(document).ready(function(){
var skunya = document.getElementById("sku");
skunya.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {

  var skunya = $('#sku').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
  $.ajax({        // Memulai ajax
    method: "POST",      
    url: "<?php echo base_url('penerimaan/ambil_data')?>", 
    dataType:'json',   // file PHP yang akan merespon ajax
    data: { sku: skunya}
    // data POST yang akan dikirim
  })
    .done(function( hasilajax) {   
        // $("#sku").val(hasilajax.sku);
        $("#description").val(hasilajax.description);
        $("#brand").val(hasilajax.brand);
        $("#price").val(hasilajax.price);
        $("#dept").val(hasilajax.departement);
        $("#classes").val(hasilajax.classes);
        $("#subclass").val(hasilajax.subclass);
        document.getElementById("qty").focus();
        
    });
    }
 })
});
</script>