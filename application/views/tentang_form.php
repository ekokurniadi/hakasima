
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tentang 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tentang</li>
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
            <label class="col-sm-2 control-label" for="tentang_kami">Tentang Kami <?php echo form_error('tentang_kami') ?></label>
            <div class="col-sm-6">
                <textarea class="ckeditor" rows="3" name="tentang_kami" id="tentang_kami" placeholder="Tentang Kami"><?php echo $tentang_kami; ?></textarea>
            </div>
        </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tentang') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
