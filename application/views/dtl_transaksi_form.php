
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dtl_transaksi 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dtl_transaksi</li>
      </ol>
    </section>


<!-- column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kode Transaksi <?php echo form_error('kode_transaksi') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo $kode_transaksi; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Sku <?php echo form_error('sku') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sku" id="sku" placeholder="Sku" value="<?php echo $sku; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Description <?php echo form_error('description') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Brand <?php echo form_error('brand') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" value="<?php echo $brand; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="bigint">Price <?php echo form_error('price') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Departement <?php echo form_error('departement') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="departement" id="departement" placeholder="Departement" value="<?php echo $departement; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Class <?php echo form_error('class') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="class" id="class" placeholder="Class" value="<?php echo $class; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="int">Subclass <?php echo form_error('subclass') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="subclass" id="subclass" placeholder="Subclass" value="<?php echo $subclass; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="bigint">Jumlah <?php echo form_error('jumlah') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="bigint">Total <?php echo form_error('total') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Status <?php echo form_error('status') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id User <?php echo form_error('id_user') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Tanggal Transaksi <?php echo form_error('tanggal_transaksi') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_transaksi; ?>" />
            </div>
        </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dtl_transaksi') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
