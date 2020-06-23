  
  
    <!-- footer -->
        <footer class="page-footer blue darken-2">
                <div class="footer-copyright blue ">
                    <div class="container yellow-text center">
                   <a class="yellow-text" href="#"> © <?= date('Y');?>  Matahari Lippo Plaza Jambi. All Right Reserved.</a> 
                    </div>
                </div>
            </footer>


  <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="<?=base_url();?>assetss/js/materialize.min.js"></script>
    
    <script> 
        
        const sideNav   = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sideNav); 
        
        // inisialisasi slider
        const slider    = document.querySelectorAll('.slider');
        M.Slider.init(slider,{
            indicators:false,
            transition:600,
            // interval:3500
        });
       // inisialiasi parallax
        const parallax = document.querySelectorAll('.parallax');
        M.Parallax.init(parallax);

        //inisialisasi materialboxed
        const materialbox=document.querySelectorAll('.materialboxed');
        M.Materialbox.init(materialbox);

        const scroll=document.querySelectorAll('.scrollspy');
        M.ScrollSpy.init(scroll,{
            scrollOffset:50
        });
    </script>
</body>
</html>