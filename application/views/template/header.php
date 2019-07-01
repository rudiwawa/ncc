<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<title>
		<?= TITLE_WEB ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="msapplication-TileColor" content="#234F73">
	<meta name="theme-color" content="#234F73">
	<meta name="description" content="Pariwisata">
	<meta name="keywords" content="">
	<meta name="author" content="SQUAD NCC">

	<!-- CSS -->

	<?php if($style):?>
		<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
	<?php endif; ?>
	<!-- kemarin ada kesalahan disini (page tidak bisa ganti tema), page switcer -->
	<?php if($colorBlue):?>
		<link href="<?=base_url()?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
	<?php endif; ?>

	<?php if($jquery):?>
		<link rel="stylesheet" href="<?=base_url()?>assets/assets/plugins/jquery/jquery.min.js">
	<?php endif; ?>

	<?php if($bootstrap): //load bootstrap?>
		<link rel="stylesheet" href="<?=base_url()?>assets/assets/plugins/bootstrap/css/bootstrap.min.css">
	<?php endif; ?>

	<?php if($morris): //load bootstrap?>
		<link rel="stylesheet" href="<?=base_url()?>assets/assets/plugins/morrisjs/morris.css">
	<?php endif; ?>






	<!-- preloader -->
<!-- 	<script>
		jQuery(document).ready(function($) {  

			// site preloader -- also uncomment the div in the header and the css style for #preloader
			$(window).load(function(){
				$('.preloader').fadeOut('slow',function(){$(this).remove();});
			});

		});
	</script> -->


	<!-- google -->
	<!-- Global site tag (gtag.js) - Google Analytics -->


</head>

<!-- 	<div class="preloader">
		<div class="loading">
			<p>Selamat Datang <b><?php echo $this->session->userdata('name'); ?></b></p>
			<p>Harap Tunggu</p>
		</div>
	</div> -->