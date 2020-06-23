
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="<?=base_url('image/'.$barang['foto'])?>" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

				

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?=$barang['nama_barang']?></h2>
							<div>
								<h3 class="product-price">Rp. <?=number_format($barang['harga'],0,',','.')?>,-</h3>
								<span class="product-available">In Stock</span>
							</div>
							<p><?=$barang['deskripsi_barang']?></p>

							<!-- <div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div> -->

                            <form action="<?=base_url('toko/create_action')?>" method="post">
							<div class="add-to-cart">
								<div class="qty-label">
									Qty Pembelian
									<div class="input-number">
										<input type="number" size="200px;"  name="qty" id="q" oninput="kali();" required>
										<!-- <a class="qty-up" onclick="kali();">+</a>
										<a class="qty-down" onclick="kali();">-</a> -->
									</div>
                                </div>
								<input type="hidden" name="id_prospek" id="id_prospek" value="<?=$kode1;?>">
								<input type="hidden" name="id_customer" id="id_customer" value="<?=$_SESSION['customer_id']?>">
								<input type="hidden" name="nama" id="nama" value="<?=$_SESSION['nama_lengkap']?>">
								<input type="hidden" name="alamat" id="alamat" value="<?=$_SESSION['alamat']?>">
								<input type="hidden" name="no_ktp" id="no_ktp" value="<?=$_SESSION['no_ktp']?>">
								<input type="hidden" name="no_hp" id="no_hp" value="<?=$_SESSION['no_hp']?>">
								<input type="hidden" name="kode_barang" id="kode_barang" value="<?=$kode_barang;?>">
								<input type="hidden" name="nama_barang" id="nama_barang" value="<?=$barang['nama_barang'];?>">
								<input type="hidden" name="harga" id="h" value="<?=$barang['harga'];?>">
								<input type="hidden" name="total" id="tot">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajukan Kredit</button>
                            </div>
                        </form>

							

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<!-- <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
								<!-- <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li> -->
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?=$barang['deskripsi_barang']?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<script>
function kali(){
      var txtFirstNumberValue = $('#h').val();
      var txtSecondNumberValue = $('#q').val();
        var result = parseInt(txtSecondNumberValue) * parseInt(txtFirstNumberValue);
		if(txtFirstNumberValue==""){
			alert("data belum lengkap");
		}
            if (!isNaN(result)) {
                document.getElementById('tot').value = result;
            }else{
                document.getElementById('tot').value=0;     
            }
    }
</script>