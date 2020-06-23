 <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?=base_url();?>assetss/css/materialize.min.css"  media="screen,projection"/>
      <!-- memanggil style.css -->
      <link type="text/css" rel="stylesheet" href="<?=base_url();?>assetss/css/style.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Matahari Departement Store</title>
    </head>


    <body id="home" class="scrollspy">
 
    <!-- ini navbar -->  
    <div class="navbar-fixed" >
        <nav class="blue lighten-2">
        <div class="container">
            <div class="nav-wrapper">
             <img class="responsive-img" src="<?=base_url()?>image/logo_matahari.png" width="200" style="padding-top:10px;">
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down" >
                <li ><a href="#home" style=" text-shadow :3px 3px 5px rgba(0,0,0,0.5);">Home</a></li>
                <li><a href="#about" style=" text-shadow :3px 3px 5px rgba(0,0,0,0.5);">About</a></li>
                <li ><a href="#services" style=" text-shadow :3px 3px 5px rgba(0,0,0,0.5);">Services</a></li>
                <li><a href="#product" style=" text-shadow :3px 3px 5px rgba(0,0,0,0.5);">Galery</a></li>
                <li><a href="#contact" style=" text-shadow :3px 3px 5px rgba(0,0,0,0.5);">Contact</a></li>
                <li><a href="<?=base_url('auth')?>" style=" text-shadow :2px 2px 5px rgba(0,0,0,0.5);">Login</a></li>
                </ul>
            </div>
        </div>
        </nav>
    </div>


<!-- ini sidenav -->
    <ul class="sidenav" id="mobile-nav">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#product">Galery</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="<?=base_url('auth_teknisi')?>">Login</a></li>
    </ul>
    