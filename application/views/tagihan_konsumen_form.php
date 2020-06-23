
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tagihan_konsumen 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tagihan_konsumen</li>
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
            <label class="col-sm-2 control-label" for="varchar">Id Prospek <?php echo form_error('id_prospek') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_prospek" id="id_prospek" placeholder="Id Prospek" value="<?php echo $id_prospek; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Id Customer <?php echo form_error('id_customer') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id_customer" id="id_customer" placeholder="Id Customer" value="<?php echo $id_customer; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Nama Konsumen <?php echo form_error('nama_konsumen') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nama_konsumen" id="nama_konsumen" placeholder="Nama Konsumen" value="<?php echo $nama_konsumen; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="double">Nominal <?php echo form_error('nominal') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo $nominal; ?>" />
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Tanggal Pembayaran <?php echo form_error('tanggal_pembayaran') ?></label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran" placeholder="Tanggal Pembayaran" value="<?php echo $tanggal_pembayaran; ?>" />
            </div>
        </div>
    </div>
	    
    <div class="box-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <div class="col-sm-6">
                <textarea class="ckeditor" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
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
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tagihan_konsumen') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
