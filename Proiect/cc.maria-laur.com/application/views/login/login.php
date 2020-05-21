<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header.php'); ?>

    <div class="card w500">
        <div class="card-header bg-white">Autentificare</div>
        <div class="card-body">
            <?php echo form_open('login/p'); ?>
            <div class="form-group">
            	<label for="user">Tel / Mail</label>
            	<?php echo form_input('user',@$user,'class="form-control" id="user"'); ?>
            </div>
            <div class="form-group">
            	<label for="parola">Parola</label>
            	<?php echo form_password('parola','','class="form-control" id="parola"'); ?>
            </div>
            <div class="wrapLogin">
                <?php echo form_submit('login','Intra in cont','class="btn btn-primary loginButon"'); ?>
                <a href="<?php echo $this->googleauth->getAuthUrl(); ?>" class="google"><img src="<?php echo base_url(); ?>public/images/google.svg"> Login google</a>
                <a href="<?php echo $this->microsoftauth->getAuthUrl(); ?>" class="microsoft"><img src="<?php echo base_url(); ?>public/images/microsoft.svg"> Login microsoft</a>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="card-footer">
            <a href="<?php echo site_url('cont-nou'); ?>" class="linkJos fl btn btn-link">Inregistrare</a>
            <a href="<?php echo site_url('recuperare-parola'); ?>" class="linkJos fr btn btn-link">Recuperare Parola</a>
            <div class="c"></div>
        </div>
    </div>
<?php $this->load->view('footer.php'); ?>