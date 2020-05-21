<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header.php'); ?>

    <div class="card w500">
        <div class="card-header bg-white">Cont Nou</div>
        <div class="card-body">
            <?php echo form_open('login/p'); ?>
            <div class="form-group">
            	<label for="user">Nume</label>
            	<?php echo form_input('nume',@$nume,'class="form-control" id="nume"'); ?>
            </div> 
            <div class="form-group">
            	<label for="user">Mail</label>
            	<?php echo form_input('mail',@$mail,'class="form-control" id="mail"'); ?>
            </div> 
            <div class="form-group">
            	<label for="user">Telefon</label>
            	<?php echo form_input('tel',@$tel,'class="form-control" id="tel"'); ?>
            </div>
            <div class="form-group">
            	<label for="parola">Parola</label>
            	<?php echo form_password('parola','','class="form-control" id="parola"'); ?>
            </div> 
            <div class="form-group">
            	<label for="parola">Repeta parola</label>
            	<?php echo form_password('reParola','','class="form-control" id="reParola"'); ?>
            </div>
            <?php echo form_submit('inregistrare','Inregistrare','class="btn btn-primary"'); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="card-footer">
            <a href="<?php echo site_url('recuperare-parola'); ?>" class="linkJos fl btn btn-link">Recuperare parola</a>
            <a href="<?php echo site_url('login'); ?>" class="linkJos fr btn btn-link">Autentificare</a>
            <div class="c"></div>
        </div>
    </div>
<?php $this->load->view('footer.php'); ?>