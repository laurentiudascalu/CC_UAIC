<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php $this->load->view('sus'); ?>
    <div class="card mb-4">
    	<div class="card-header bg-white">Cauta</div>
        <div class="card-body">
        	<?php echo form_open('p'); ?>
        	<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <?php echo form_inputa('cautat', @$cautat,'class="form-control"','Cauta'); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                	<?php $options = array(
                		'imagini'=>'Imagini',
                		'video'=>'Videoclipuri', 
                		'stiri'=>'Stiri', 
                		'retete'=>'Retete', 
                		'carti'=>'Carti', 
                		'informatii'=>'Informatii'
                	); ?>
                	<?php echo form_dropdowna('tip', $options, @$tip, 'class="form-control"','Alege tip'); ?>
                </div>
            </div>
       	</div>
       	<div class="card-footer">
            <?php if(isset($this->user->id) && $this->user->id>0){ ?>
              <?php echo form_hidden('id',@$this->user->id); ?>
            <?php } ?>
            <?php echo form_hidden('tabel','useri'); ?>
            <?php echo form_hidden('link','contul-tau'); ?>
            <?php echo form_submit('cauta','Cauta','id="cauta" class="btn btn-success"'); ?>
       	</div>
       	<?php echo form_close(); ?>
    </div>
    
   	<?php if(isset($carti) && !empty($carti)){
   		print_r($carti);
   	}elseif(isset($stiri) && !empty($stiri)){
   		print_r($stiri);
   	}elseif(isset($video) && !empty($video)){
   		print_r($video);
   	}elseif(isset($imagini) && !empty($imagini)){ ?>
   		<h2 class="mb-4">Rezultatele cautarii tale</h2>
   		<?php foreach ($imagini->hits as $imagine) {?>
   			<div class="row">
	   			<div class="card mb-4 col-lg-6">
	   			<div class="card-header bg-white"><?php echo $imagine->tags; ?></div>
	   			<div class="card-body">
	   				<?php echo '<img src = '.$imagine->webformatURL.'>'; ?>
	   			</div>
	   			</div>
   			</div>
   		<?php }
   	}elseif(isset($retete) && !empty($retete)){
   		print_r($retete);
   	}elseif(isset($informatii) && !empty($informatii)){
   		print_r($informatii);
   	}  ?>

<?php $this->load->view('footer'); ?>