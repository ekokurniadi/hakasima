<body onload="cek_pembelian();">
    
</body>
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                <form action="<?=base_url('toko/proses')?>">
					<!-- Order Details -->
					<div class="col-md-12 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							
							<div class="order-products">
                                
                          
						<div class="payment-method">
                            <p>Metode Pembelian</p>
							<select name="cara_pembelian" id="cara_pembelian" class="form-control">
                                <option value=""selected>Pilih metode pembelian</option>
                                <option value="Kas">Kas/Transfer</option>
                                <option value="Kredit">Kredit</option>
                            </select>
                            <br>
                            <p id="label_tenor">Tenor</p>
							<select name="tenor" id="tenor" class="form-control">
                                <option value="0"selected>Pilih tenor</option>
                                <option value="3">3X</option>
                                <option value="6">6X</option>
                                <option value="9">9X</option>
                                <option value="12">12X</option>
                            </select>
						</div>
                        <div class="order-col">
								<div>Provinsi <select name="kode_provinsi" id="kode_provinsi" class="form-control">
                                <option value="">--Please-select---</option>
                                <?php
                                    foreach($kode_provinsi as $data){ // Lakukan looping pada variabel siswa dari controller
                                        echo "<option value='".$data->id."'>".$data->provinsi.""."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                            
                            <div>
                             Kabupaten
                            <select name="kabupaten" id="kabupaten" class="form-control">
                                <option value=""></option>
                            </select>
                            
                            </div>

								<div>
                                
                                Kurir <select name="kurir" id="kurir" class="form-control">
                                <option value=""></option>
                            </select>
                            Layanan
                            <select name="layanan" id="layanan" class="form-control">
                                <option value=""></option>
                            </select>
                                <br> Biaya Pengiriman<input type="text" class="form-control" readonly placeholder="Rp.0" id="ongkir"></div>
							</div>
							
						
						</div>
                        <div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL (KAS)</strong></div>
							</div>
                            <div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col" id="bng">
									<div><p id="bunga">Bunga Kredit</p></div>
									<div><p id="besar_bunga">0</p></div>
                                </div>
                                <div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
							</div>
							
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
                        <!-- <a href="#" class="primary-btn order-submit">Order</a> -->
                        <button class="primary-btn order-submit" type="submit">Order</button>
                        <br>
						<a href="<?php echo base_url('toko/index')?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Lanjutkan Belanja</a>
					</div>
                    </form>               
                    <!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
<script>
function kembali(){
    window.history.back(-3);
}
function cek_pembelian(){
    var car = $('#cara_pembelian').val();
if(car=="Kas"){
  $('#label_tenor').hide();
  $('#tenor').hide();
  $('#bng').hide();
}else if(car=="Kredit"){
    $('#label_tenor').show();
    $('#tenor').show();
    $('#bng').show();
}else {
    $('#label_tenor').show();
    $('#tenor').show();
    $('#bng').show();
}
}

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script type="text/javascript">
// ambil nama karyawan,jabatan dan juga gaji pokok
$(document).ready(function(){

$('#cara_pembelian').change(function(){  
  
var car = $('#cara_pembelian').val();
if(car=="Kas"){
  $('#label_tenor').hide();
  $('#tenor').hide();
  $('#bng').hide();
}else if(car=="Kredit"){
    $('#label_tenor').show();
    $('#tenor').show();
    $('#bng').show();
}else {
    $('#label_tenor').show();
    $('#tenor').show();
    $('#bng').show();
}
 
 });
});
</script>

<script src="<?php echo base_url()?>jquery.min/jquery.min.js"></script>
<script>
        $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
            $("#kode_provinsi").change(function(){ // Ketika user mengganti atau memilih data provinsi
                
              
                $.ajax({
                    type: "POST", // Method pengiriman data bisa dengan GET atau POST
                    url: "<?php echo base_url("toko/list_kab"); ?>", // Isi dengan url/path file php yang dituju
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
<script>
        $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
            $("#kode_provinsi").change(function(){ // Ketika user mengganti atau memilih data provinsi
                
              
                $.ajax({
                    type: "POST", // Method pengiriman data bisa dengan GET atau POST
                    url: "<?php echo base_url("toko/list_kurir"); ?>", // Isi dengan url/path file php yang dituju
                    data: {kode_provinsi : $("#kode_provinsi").val()}, // data yang akan dikirim ke file yang dituju
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){ // Ketika proses pengiriman berhasil
                        $("#kurir").html(response.list_kurir).show();
                      
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                });
            });
        });
</script>
<script>
        $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
            $("#kurir").change(function(){ // Ketika user mengganti atau memilih data provinsi
                
              
                $.ajax({
                    type: "POST", // Method pengiriman data bisa dengan GET atau POST
                    url: "<?php echo base_url("toko/list_layanan"); ?>", // Isi dengan url/path file php yang dituju
                    data: {kurir : $("#kurir").val()}, // data yang akan dikirim ke file yang dituju
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){ // Ketika proses pengiriman berhasil
                        $("#layanan").html(response.list_layanan).show();
                      
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                });
            });
        });
</script>

<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){

$('#layanan').change(function(){    
var kode_provinsi = $('#kode_provinsi').val(); 
var kabupaten = $('#kabupaten').val(); 
var kurir = $('#kurir').val(); 
var layanan = $('#layanan').val(); 

$.ajax({      
    method: "GET",      
    url: "<?php echo base_url('toko/ambil_data')?>", 
    dataType:'json',  
    data:"kode_provinsi="+kode_provinsi+"&kabupaten="+kabupaten+"&kurir="+kurir+"&layanan="+layanan,
  
  })
    .done(function( hasilajax) {   
      $("#ongkir").val(hasilajax.ongkir);
    });
})
});
    </script>