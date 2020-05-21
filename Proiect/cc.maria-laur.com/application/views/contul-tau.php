<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php $this->load->view('sus'); ?>
<div class="row mb-4">
  <div class="col-lg-6 col-sm-12">
    <div class="card  mb-4">
        <?php echo form_open('update'); ?>
        <div class="card-header bg-white">Modifica profil</div>
          <div class="card-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php echo form_inputa('nume', $this->user->nume,'class="form-control"','Nume'); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php echo form_inputa('mail',$this->user->mail,'class="form-control"','Mail'); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php echo form_inputa('tel',$this->user->tel,'class="form-control"','Telefon'); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php echo form_inputa('user',$this->user->user,'class="form-control"','Username'); ?>
                </div>
              </div>
         </div>
         <div class="card-footer">
            <?php if(isset($this->user->id) && $this->user->id>0){ ?>
              <?php echo form_hidden('id',@$this->user->id); ?>
            <?php } ?>
            <?php echo form_hidden('tabel','useri'); ?>
            <?php echo form_hidden('link','contul-tau'); ?>
            <?php echo form_submit('insertupdate','Modifica profil','id="modifica_profil" class="btn btn-success"'); ?>
         </div>
         <?php echo form_close(); ?>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
    <div class="card  mb-4">
          <?php echo form_open('update'); ?>
          <div class="card-header bg-white">Schimba parola</div>
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo form_passworda('pass','','class="form-control"','Parola'); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo form_passworda('repass','','class="form-control"','Repeta parola'); ?>
                  </div>
                </div>
           </div>
           <div class="card-footer">
            <?php if(isset($this->user->id) && $this->user->id>0){ ?>
              <?php echo form_hidden('id',@$this->user->id); ?>
            <?php } ?>
            <?php echo form_hidden('tabel','useri'); ?>
            <?php echo form_hidden('link','contul-tau'); ?>
              <?php echo form_submit('insertupdate','Schimba parola','id="schimba_parola" class="btn btn-success"'); ?>
           </div>
           <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="row mb-4">
  <div class="col-lg-12">
    <div class="card">
          <?php echo form_open('update'); ?>
          <div class="card-header bg-white">Categoriile tale de interes</div>
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('imagini[]',@$imaginiCat,json_decode(@$this->user->imagini),'class="form-control multi" multiple="multiple"','Imagini'); ?>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('video[]',@$videoCat,json_decode(@$this->user->video),'class="form-control multi" multiple="multiple"','Video'); ?>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('stiri[]',@$stiriCat,json_decode(@$this->user->stiri),'class="form-control multi" multiple="multiple"','Stiri'); ?>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('retete[]',@$reteteCat,json_decode(@$this->user->retete),'class="form-control multi" multiple="multiple"','Retete'); ?>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('carti',@$cartiCat,@$this->user->carti,'class="form-control"','Carti'); ?>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <?php echo form_dropdowna('informatii[]',@$informatiiCat,json_decode(@$this->user->informatii),'class="form-control multi" multiple="multiple"','Informatii'); ?>
                  </div>
                </div>
           </div>
           <div class="card-footer">
            <?php if(isset($this->user->id) && $this->user->id>0){ ?>
              <?php echo form_hidden('id',@$this->user->id); ?>
            <?php } ?>
            <?php echo form_hidden('exceptie','categoriiUser'); ?>
            <?php echo form_hidden('tabel','useri'); ?>
            <?php echo form_hidden('link','contul-tau'); ?>
              <?php echo form_submit('insertupdate','Modifica preferintele','id="modifica_preferinte" class="btn btn-success"'); ?>
           </div>
           <?php echo form_close(); ?>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.multi').select2({
    placeholder: "Alege categoriile",
    allowClear: true
});
  });
</script>
<?php $this->load->view('footer'); ?>