<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php $this->load->view('sus'); ?>
<h2 class="mb-4 borderBottomNone mT10"><a href="<?php echo site_url('categorie/0'); ?>" class="link-new btn btn-success">+ Adauga categorie noua</a></h2>
<div class="row mb-4">
  <div class="col-lg-12">
    <div class="card">
        <?php echo form_open('update'); ?>
        <div class="card-header bg-white"><?php echo $title; ?></div>
          <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <?php echo form_inputa('tip', @$categorie->tip,'class="form-control"','Tip'); ?>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <?php echo form_inputa('tip_key',@$categorie->tip_key,'class="form-control"','Tip key'); ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                  <?php echo form_inputa('categorie',@$categorie->categorie,'class="form-control"','Categorie'); ?>
                </div>
              </div>
         </div>
         <div class="card-footer">
            <?php if(isset($categorie->id) && $categorie->id>0){ ?>
              <?php echo form_hidden('id',@$categorie->id); ?>
            <?php } ?>
            <?php echo form_hidden('tabel','categorii'); ?>
            <?php echo form_hidden('link','categorie'); ?>
            <?php echo form_submit('insertupdate','Salveaza categorie','id="modifica_categorie" class="btn btn-primary"'); ?>
         </div>
         <?php echo form_close(); ?>
    </div>
  </div>
</div>
<?php $this->load->view('footer'); ?>