<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<script>var fcpath='<?php echo FCPATH; ?>'; </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php if(isset($metad) && $metad!=''){ echo $metad; }else{ echo 'Aplicatia YourStuff'; } ?>">
	<meta name="keywords" content="<?php if(isset($metak) && $metak!=''){ echo $metak; }else{ echo 'YourStuff, INFO, UAIC, CC, aplicatie, proiect'; } ?>">

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootadmin.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/css_helper.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/datatables/datatables.min.css"/>

    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.autogrow.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.charcounter.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.checkbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.masked.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jeditable.time.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootadmin.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/datatables/datatables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/select2/js/i18n/ro.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/js.cookie.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/js_helper.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/functions.js"></script>

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>public/fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>public/fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>public/fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>public/fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>public/fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>public/fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>public/fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>public/fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>public/fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url(); ?>public/fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>public/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>public/fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>public/fav/favicon-16x16.png">

	<link rel="manifest" href="<?php echo base_url(); ?>manifest.json">

	<meta name="msapplication-TileColor" content="#6c9f7f">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>public/fav/ms-icon-144x144.png">
	<meta name="theme-color" content="#6c9f7f">
	
    <title>YourStuff<?php if(isset($metat) && $metat!=''){ echo ' - '.$metat; } ?></title>
</head>
<body class="bg-light">
<script>
	var crsf="<?php echo $this->security->get_csrf_hash();?>"; // sec
</script>