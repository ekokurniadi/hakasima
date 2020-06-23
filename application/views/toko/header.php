<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Hakasima Online Store</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		
		<link href="<?php echo base_url()?>sources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('')?>electro/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('')?>electro/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('')?>electro/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('')?>electro/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="<?php echo base_url('')?>electro/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('')?>electro/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
test
	
	<body style="transform-origin: 0 0;">
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#lihat_profil" id="1"  data-toggle="modal"><i class="fa fa-user-plus"></i> Profil Saya</a></li>
						<li><a href="#quickview1" id="1"  data-toggle="modal"><i class="fa fa-lock"></i> Logout</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
								
									<input class="input" placeholder="Ingin mencari sesuatu ?" style="width:300px;">
									<button class="search-btn"><span class="fa fa-search"></span> Cari</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<!-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> -->
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<?php
										$id=$_SESSION['customer_id'];
										$total_belanja=$this->db->query("SELECT count(*) as jml FROM detail_pembelian where customer_id='$id' and status='baru'")->row_array();?>
										<div class="qty"><?=$total_belanja['jml']?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
										<!-- daftar belanja -->
										<?php 
										$id=$_SESSION['customer_id'];
										$data_belanjaan=$this->db->query("SELECT * FROM detail_pembelian where customer_id='$id' and status='baru'")->result();
										$total=$this->db->query("select sum(total) as total from detail_pembelian where customer_id='$id' and status='baru'")->row_array();
										if($data_belanjaan!=null){?>
									
										<?php foreach($data_belanjaan as $belanja):?>
											<?php $barang=$this->db->query("select * from barang where kode_barang='$belanja->kode_barang'")->row_array();?>
											<div class="product-widget">
												<div class="product-img">
													<img src="<?php echo base_url('image/'.$barang['foto'])?>" alt="" width="100px" height="100px;">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#"><?=$belanja->nama_barang?></a></h3>
													<h4 class="product-price"><span class="qty"><?=$belanja->qty?></span>Rp.<?= number_format($belanja->harga * $belanja->qty,0,',','.')?></h4>
												</div>
												<div class="product-body">
													<input type="checkbox" name="ck[]" id="ck[]" value="<?php echo $belanja->kode_barang?>" required checked>
												</div>
												<a href="<?php echo base_url('toko/hapus_keranjang/'.$belanja->id)?>" class="delete" onclick="javasciprt: return confirm('Hapus barang ini dari keranjang belanja anda ?')"><i class="fa fa-trash"></i></a>
											</div>
										<?php endforeach;?>
										<!-- akhir daftar belanja -->
										</div>
										<div class="cart-summary">
											<!-- <small>3 Item(s) selected</small> -->
											<h5>SUBTOTAL: Rp. <?php echo number_format($total['total'],0,',','.')?></h5>
										</div>
										<div class="cart-btns">
											<a href="<?php echo base_url('toko/lihat_keranjang/'.$belanja->customer_id)?>">Lihat Keranjang</a>
											<a href="<?php echo base_url('toko/check_out/'.$belanja->kode_pembelian)?>">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>



									<?php } else { ?>
										<p>Keranjang belanja masih kosong</p>
										
										<?php } ?>
										
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->

					 <!-- ============ MODAL EDIT =============== -->
		 
		<div class="modal fade" id="quickview1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp; Logout</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              </div>
              <div class="modal-body" id="IsiModal">
			  	<p>Keluar dari akun anda ?</p>
				<a href="<?=base_url('auth_sales/logout')?>" class="btn btn-danger btn-flat">Logout</a>
              </div>
              <!-- <div class="modal-footer">
                <a href="<?=base_url('web/spek/'.$glr->fk)?>" class="btn btn-danger btn-md btn-flat">Lihat spesifikasi</a>
                </div>
            </div> -->
          </div>
        </div>
	</div>
				<!-- container -->
		<div class="modal fade" id="lihat_profil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
			  <?php 
			  	$id=$_SESSION['id'];
				 $data_konsumen=$this->db->query("SELECT * FROM konsumen where id='$id'")->row_array();
			  ?>
                <h4 class="modal-title" id="myModalLabel">&nbsp; Profil Saya</h4>
				<p><img src="<?php echo base_url('image/'.$data_konsumen['foto']);?>" alt="" width="100px" height="100px;"></p>
		        <p><h5>Hi, <?=$data_konsumen['nama_lengkap']?></h5></p>
              </div>
              <div class="modal-body" id="IsiModal">
			 	<form action="<?php echo base_url('konsumen/update_action2')?>" method="post" enctype="multipart/form-data">
			  <table class="table">
			  	<thead>
					<tr>
					<td>Nama</td>
					<td>:</td>
					<td><input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?=$data_konsumen['nama_lengkap']?>"></td>
					</tr>  
					<tr>
					<td>No. KTP</td>
					<td>:</td>
					<td><input type="text" name="no_ktp" id="no_ktp" class="form-control" value="<?=$data_konsumen['no_ktp']?>"></td>
					</tr>  
					<tr>
					<td>No. HP</td>
					<td>:</td>
					<td><input type="text" name="no_hp" id="no_hp" class="form-control" value="<?=$data_konsumen['no_hp']?>"></td>
					</tr>  
					<tr>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td>
					<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
						<option value="<?=$data_konsumen['jenis_kelamin']?>" selected><?=$data_konsumen['jenis_kelamin']?></option>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
					</td>
					</tr>  
					<tr>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td>
						<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?=$data_konsumen['tanggal_lahir']?>">
					</td>
					</tr>  
					<tr >
					<td>Alamat</td>
					<td>:</td>
					<td>
						<input type="text" name="alamat" id="alamat" class="form-control" value="<?=$data_konsumen['alamat']?>">
						<!-- <textarea name="alamat" id="alamat" cols="60" rows="2"><?=$data_konsumen['alamat']?></textarea> -->
					</td>
					</tr>  
					<tr>
					<td>Email</td>
					<td>:</td>
					<td>
						<input type="text" name="email" id="email" class="form-control" value="<?=$data_konsumen['email']?>" readonly>
					</td>
					</tr>  
					<tr>
					<td>Password</td>
					<td>:</td>
					<td>
						<input type="password" name="password" id="password" class="form-control" value="<?=$data_konsumen['password']?>">
					</td>
					</tr>  
					<tr>
					<td>Foto</td>
					<td>:</td>
					<td>
						<input type="file" name="foto" id="foto" class="form-control" value="<?=$data_konsumen['foto']?>">
						<input type="hidden" name="role" id="role" class="form-control" value="<?=$data_konsumen['role']?>">
					</td>
					</tr>
					<tr>
						<td width="300px">
						<input type="hidden" name="id" id="id" class="form-control" value="<?=$data_konsumen['id']?>">
						<input type="hidden" name="customer_id" id="customer_id" class="form-control" value="<?=$data_konsumen['customer_id']?>">
						<button class="btn btn-primary btn-sm btn-flat"><span class="fa fa-check"></span> Simpan</button> <br>
						<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><span aria-hidden="true">&times;</span> Batal</button>
						</td>
					</tr>  
				</thead>
			  </table>
			  </form>
              </div>
          </div>
        </div>
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="<?php echo base_url('toko')?>">Home</a></li>
						<!-- <li><a href="<?php echo base_url('toko/cara_pembelian')?>">Cara Pembelian</a></li> -->
						<li><a href="<?php echo base_url('toko/simulasi')?>">Simulasi Kredit</a></li>
						<!-- <li><a href="<?php echo base_url('toko/keranjang_belanja')?>">Keranjang Belanja</a></li> -->
						<li><a href="<?php echo base_url('toko/tentang_kami')?>">Tentang Kami</a></li>
						<li><a href="<?php echo base_url('toko/kontak_kami')?>">Kontak Kami</a></li>
							<?php $id_cus=$_SESSION['customer_id']; 
							$not=$this->db->query("SELECT count(*) as notif from prospek where status='reject' or status='deal' and id_customer='$id_cus'")->row_array()?>
						<li><a href="<?php echo base_url('toko/pengajuan_kredit')?>"><span class="badge bg-red"><?=$not['notif']?></span> Pengajuan Kredit</a></li>
						<li><a href="<?php echo base_url('toko/bayar')?>">Pembayaran Angsuran</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<div class="col-md-12">
             <div class="card-body">
              <?php                       
                if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {                    
                  ?>                  
                <div class="alert alert-<?php echo $_SESSION['tipe'] ?> alert-dismissable">
                    <strong><?php echo $_SESSION['pesan'] ?></strong>
                    <button class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>  
                    </button>
                </div>
                <?php
                }
                $_SESSION['pesan'] = '';        
                ?>
                </div>