<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header.php'); ?>

    <div class="card w500">
        <div class="card-header bg-white">Recuperare parola</div>
        <div class="card-body">
            <?php echo form_open('login/p'); ?>
            <div class="form-group">
            	<label for="user">Tel / Mail</label>
            	<?php echo form_input('user',@$user,'class="form-control" id="user"'); ?>
            </div>
            <?php echo form_submit('recuperare','Trimite','class="btn btn-primary"'); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="card-footer">
            <a href="<?php echo site_url('login'); ?>" class="linkJos fl btn btn-link">Autentificare</a>
            <a href="<?php echo site_url('cont-nou'); ?>" class="linkJos fr btn btn-link">Cont nou</a>
            <div class="c"></div>
        </div>
    </div>
<?php $this->load->view('footer.php'); ?>