
    <section>
        <div class="container-fluid" style="padding-top: 20px;">
          <div class="row">
            <div class="col-md-12">
              <a
                href="#"
                class="btn btn-block btn-danger"
                style="background-color: blueviolet;"
                >Produk List</a
              >
            </div>
            <?php $data_produk=$this->db->query("SELECT * FROM barang")->result();?>
            <?php foreach($data_produk as $dp):?>
            <div class="col-md-2" style="padding-top: 20px;">
              <div class="card" style="box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.2),0px 4px 5px 0px rgba(0, 0, 0, 0.14),0px 1px 10px 0px rgba(0, 0, 0, 0.12);">
                <img class="card-img-top img-fluid" src="<?php echo base_url('image/'.$dp->foto)?>" alt="Card image cap" style="background-size:fill;height:200px;"/>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $dp->nama_barang?></h5>
                  <p class="card-text"> Rp.<?php echo number_format($dp->harga,0,',','.')?></p>
                  <p class="card-text">
                    <a href="<?=base_url('toko/add_to_cart/'.$dp->kode_barang)?>" class="btn btn-danger btn-sm">Beli</a>
                    <button class="btn btn-success btn-sm">
                      Tambah Keranjang
                    </button>
                  </p>
                </div>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
      </section>
  