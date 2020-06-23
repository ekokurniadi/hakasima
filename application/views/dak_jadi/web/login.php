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
				<h2>Masuk ke akun anda</h2>
				<p>Masukan Username dan Password anda</p>
				<form action="" method="post">
				<form accept-charset="UTF-8" role="form" class="form-signin">
					<label>Username</label>
					<div class="input-group">
						<span class="fa fa-user" aria-hidden="true"></span>
						<input type="text" placeholder="Enter Your Username" name="user_session_id" id="user_session_id"  required=""> 
					</div>
					<label>Password</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input type="Password" placeholder="Enter Password" id="myInput" name="password" id="password" required="">
					</div> 
					<div class="login-check">
					<label class="checkbox"><input type="checkbox"  id="chk" onclick="myFunction()" ><i></i>Lihat Password</label>
					</div>						
						<button class="btn btn-danger btn-block" type="submit">Login</button >                
				<div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
				</form>
				<!-- <p class="account">By clicking login, you agree to our <a href="#">Terms & Conditions!</a></p> -->
				<p class="account1">Belum memiliki akun? <a href="<?php echo base_url('auth/register')?>">Daftar disini</a></p>
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
</body>
</html>