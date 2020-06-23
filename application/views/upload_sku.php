
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sku 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sku</li>
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
            <form action="<?php echo base_url()?>sku/upload" method="post" class="form-horizontal" enctype="multipart/form-data">
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Upload Sku.xls</label>
            <div class="col-sm-6">
            <input name="file" type="file" class="form-control"/>
            </div>
        </div>
    </div>    
<div class="box-footer">
	    <button type="submit" class="btn btn-success">Upload</button> 
	    <a href="<?php echo site_url('sku') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>
