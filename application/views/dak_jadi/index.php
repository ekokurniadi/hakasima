
  <!-- ini slider -->
    <div class="slider">
        <ul class="slides">
        <?php foreach ($slider as $s ) :?>    
            <li> 
            <img src="<?=base_url()."image/".$s->foto?>" class="responsive-img" >
                <div class="caption center-align">
                <h3 class="light white-text "><?=$s->tag_line?></h3>
                <h5 class="light white-text "><?=$s->slogan?></h5>
                </div>
            </li>
<?php endforeach; ?>
         </ul>
    </div>

     <!-- ini about -->
     <section id="about" class="about scrollspy">
            <div class="container">
                <div class="row">
                    <h3 class="center light grey-text text-darken-3">About Us</h3>
                   <?php foreach ($about as $a) :?>
                    <div class="col m6 light">
                        <h5><?=$a->profil;?></h5>
                        <p><?=$a->isi?></p>
                    </div>
<?php  endforeach;?>
                    <div class="col m6 s12 light">
                        <p>Team Work</p>
                        <div class="progress">
                            <div class="determinate purple" style="width: 95%"></div>
                        </div>
                        <p>Sense Of Responsibility</p>
                        <div class="progress">
                            <div class="determinate purple" style="width: 85%"></div>
                        </div>
                        <p>Happiness</p>
                        <div class="progress">
                            <div class="determinate purple" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ini Client Paralax -->
        <div class="parallax-container" id="clients">
            <div class="parallax"><img src="<?=base_url()?>image/4.png"></div>
        <div class="container clients">
            <h3 class="center light white-text">Our Product</h3>
            <div class="row">
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner1.png">
                </div>
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner2.png">
                </div>
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner1.png">
                </div>
            </div>
        </div>
        </div>
    <!-- service page -->
    <section id="services" class="services grey lighten-3 scrollspy">
            <div class="container">
                <div class="row">
                        <h3 class="light center grey-text text-darken-3">Our Services</h3>
                        <?php foreach ($service as $key ): ?>
                <div class="col m3 s12"> 
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url().'image/'.$key->foto?>">
                            </div>
                            <div class="card-content center">
                                <span class="card-title activator grey-text text-darken-4"><?=$key->judul?><i class="material-icons right">more_horiz</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4 center"><?=$key->judul?><i class="material-icons right">close</i></span>
                                <p><?=$key->isi?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
     </section>
                 <!-- ini halaman product -->
         <section class="product scrollspy" id="product">        
             <div class="container">
                 <div class="row">
                     <h3 class="light center grey-text text-darken-3">Galery</h3>
                     <?php foreach ($galeri as $g) :?>
                         <div class="col m3 s12">
                             <img class="materialboxed responsive-img" src="<?=base_url().'image/'.$g->foto?>" style="width:100%; height:30%;">
                         </div>
                     <?php endforeach;?>
                 </div>
             </div>
         </section>
     
    <!-- ini Client Paralax -->
    <section id="">
            <div class="parallax-container">
                <div class="parallax"><img src="<?=base_url()?>image/4.png"></div>
            <div class="container clients">
            <h3 class="center light white-text">Our Product</h3>
                <div class="row">
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner1.png">
                </div>
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner2.png">
                </div>
                <div class="col m4 s12 center">
                    <img src="<?=base_url()?>image/partner1.png">
                </div>
                </div>
            </div>
            </div>
        </section>

    

    <section class="contact grey lighten-3 scrollspy" id="contact">
        <div class="container">
            <h3 class="light grey-text text-darken-3 center">Contact Us</h3> 
            <div class="row">
                <div class="col m5 s12">
                <div class="card-panel blue darken-2 white-text center">
                <i class="material-icons">email</i>
                <h5>Contact</h5>
                <p>PT Matahari Department Store Tbk adalah perusahaan ritel yang menyediakan pakaian, aksesoris, perlengkapan kecantikan, dan perlengkapan rumah terlengkap untuk Anda.</p>
                </div>
                <ul class="collection with-header">
                    <li class="collection-item">Jl. Mayor Abd. Karta Wirana No.RT.15, Budiman, Kec. Jambi Tim., Kota Jambi, Jambi 36123</li>
                    <li class="collection-item"> Telp. (0741) 5911589</li>
                    <li class="collection-item">  Email: corporate_comm@lippogroup.co.id</li>
                </ul>
                </div>
                <div class="col m7 s12">
                    <form>
                        <div class="card-panel">
                        <h5>Please Fill out this form</h5>
                        <div class="input-field">
                            <input type="text" name="name" id="name" required class="validate" >
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field">
                            <input type="email" name="email" id="email" required class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="phone" id="phone" required class="validate">
                            <label for="phone">Phone Number</label>
                        </div>
                        <div class="input-field">
                            <textarea name="message" id="message" class="materialize-textarea"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <button type="submit" class="btn blue darken-2">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </section>       
