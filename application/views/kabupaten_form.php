
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kabupaten 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kabupaten</li>
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
            <label class="col-sm-2 control-label" for="varchar">Provinsi <?php echo form_error('kode_provinsi') ?></label>
            <div class="col-sm-6">
               <select name="kode_provinsi" id="kode_provinsi" class="form-control">
                <option value="<?=$kode_provinsi?>" selected>Select an option</option>
                <?php $prov=$this->db->query("SELECT * FROM provinsi")->result();?>
                <?php foreach($prov as $pr):?>
                <option value="<?=$pr->id?>"><?=$pr->provinsi?></option>
                <?php endforeach;?>
               </select>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kode Kabupaten <?php echo form_error('kode_kabupaten') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="kode_kabupaten" id="kode_kabupaten" placeholder="Kode Kabupaten" value="<?php echo $kode; ?>" readonly/>
            </div>
        </div>
    </div>
	   
    <div class="box-body"> 
        <div class="form-group">
            <label class="col-sm-2 control-label" for="varchar">Kabupaten <?php echo form_error('kabupaten') ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="kabupaten" id="kabupaten" placeholder="Kabupaten" value="<?php echo $kabupaten; ?>" />
            </div>
        </div>
    </div>
	    
<div class="box-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-success"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kabupaten') ?>" class="btn btn-default">Cancel</a>
	
</div>
</form>
</div>
</div>
</div>


