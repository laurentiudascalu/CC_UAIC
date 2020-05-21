<nav class="navbar navbar-expand navbar-dark bg-primary backgroundSus">
    <a class="navbar-brand fontSize30" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/images/logo.png">  <span class="scrisLogo"> YourStuff </span></a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?php echo site_url('contul-tau'); ?>" class="nav-link"><i class="fa fa-user"></i> <?php echo $this->user->nume; ?></a></li>
            <?php if($this->user->admin==1){ ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('categorii'); ?>"><i class="fas fa-boxes"></i> Categorii</a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> Delogare</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>
            <li class="nav-item"><a href="#" class="nav-link <?php if($this->input->cookie('minifizare')=='da'){ echo 'minDa'; } ?>" id="minifizare"  onclick="smallSite();"><i class="fas fa-<?php if($this->input->cookie('minifizare')=='da'){ echo 'expand'; }else{ echo 'compress'; } ?>"></i></a></li>
        </ul>
    </div>
</nav>
<div class="d-flex">
<div class="content p-4 <?php if($this->input->cookie('minifizare')=='da'){ echo 'minifizare'; } ?>">