<!DOCTYPE html>
<html lang="en">
<head>
<title>Lapor Pertamina</title>
 <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Business Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
	
	<!-- css files -->
	<link href="<?php echo base_url()?>asset_login/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo base_url()?>asset_login/css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
	<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

<div class="signupform">
	<div class="container">
		<!-- main content -->
		<div class="agile_info">
			<div class="w3l_form">
				<div class="left_grid_info">
					<h1>Selamat Datang di Website Kami</h1>
					<p>Portal Pelaporan Resmi SPBU 23.361.03 Paal Merah Lama
					</p>
					<img src="<?php echo base_url()?>asset_login/images/image.jpg" alt="" />
				</div>
			</div>
	
			<div class="w3_info">
				<h2>Registrasi Pengguna</h2>
				<p>Silahkan lengkapi form untuk mendaftar</p>
					<div class="col-md-4 text-center">
						<div style="margin-top: 8px" id="message">
							<?php echo'<div class="w3-container w3-green">';?>
							<?php echo'<h3 href="javascript:history.go(0)">'.$this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; echo "</h3>";?>
							<?php echo "</div>";?>
						</div>
					</div>
				<form action="<?php echo base_url('pelapor/create_action') ?>" method="post" class="form-horizontal">
					<label>Nama Lengkap</label>
					<div class="input-group">
	
						<input type="text" placeholder="Nama Lengkap" name="nama" id="nama" required=""> 
					</div>
					<label>Anonim</label>
					<div class="input-group">
	
						<input type="text" placeholder="Anonim" name="anonim" id="anonim" required=""> 
					</div>
					<label>Alamat Email</label>
					<div class="input-group">
					
						<input type="text" placeholder="Email" name="email" id="email" required=""> 
					</div>
					<label>No Telp</label>
					<div class="input-group">
					
						<input type="text" placeholder="Nomor Telepon" name="no_telp" id="no_telp" required=""> 
					</div>
					<label>Username</label>
					<div class="input-group">
	
						<input type="text" placeholder="Username" name="user_session_id" id="user_session_id" required="">
					</div> 
					<label>Password</label>
					<div class="input-group">
						
						<input type="password" placeholder="Enter Password" name="password" id="myInput" required="">
					</div> 						
						<button class="btn btn-blocked" type="submit">Daftar</button >                
				</form>
				<!-- <p class="account">Dengan klik login, anda menyetujui <a href="#">peraturan dan kebijakan kami</a></p> -->
				<p class="account1">Sudah memiliki akun? <a href="<?php echo base_url('auth')?>">Login disini</a></p>
			</div>
		</div>
		<!-- //main content -->
	</div>
	<!-- footer -->
	<div class="footer">
	<p>&copy; <?php echo date('Y');?> <a href="https://w3layouts.com/" target="blank">SPBU 23.361.03 Paal Merah Lama</a></p>
	</div>
	<!-- footer -->
</div>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> -->
<script>
	
	var mytime;
	function yeah(){
		swal({	
			title:'Pendaftaran member sukses',
			text:"<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>",
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Silahkan Login Ke akun anda',
			showConfirmButton:true,
			type:"info",
		});
		setTimeout(3000);
	}
</script>
</body>
</html>