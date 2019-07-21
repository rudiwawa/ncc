<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>





<?php if($jquery):?>
    <script src='<?=base_url()?>assets/assets/plugins/jquery/jquery.min.js'></script>
<?php endif; ?>


<?php if($bootstrapjs): ?>
   <script src="<?=base_url()?>assets/assets/plugins/bootstrap/js/popper.min.js"></script>
   <script src="<?=base_url()?>assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<?php endif; ?>

<?php if($slimscroll): ?>
   <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>
<?php endif; ?>

<?php if($wave): ?>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
<?php endif; ?>

<?php if($sidebarmenu): ?>
    <script src="<?=base_url()?>assets/js/sidebarmenu.js"></script>
<?php endif; ?>

<?php if($stickykit): ?>
    <script src="<?=base_url()?>assets/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<?php endif; ?>

<?php if($customJS): ?>
    <script src="<?=base_url()?>assets/js/custom.min.js"></script>
<?php endif; ?>

<?php if($sparkline): ?>
    <script src="<?=base_url()?>assets/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<?php endif; ?>

<?php if($morris): ?>
    <script src="<?=base_url()?>assets/assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?=base_url()?>assets/assets/plugins/morrisjs/morris.min.js"></script>
<?php endif; ?>

<?php if($chart): ?>
    <script src="<?=base_url()?>assets/js/dashboard1.js"></script>
<?php endif; ?>

<?php if($switcher): ?>
    <script src="<?=base_url()?>assets/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<?php endif; ?>


    <script src="<?=base_url()?>assets/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/myjs/compress.js"></script>
    <?php if($app): ?>
    <script src="<?=base_url()?>assets/myjs/app.js"></script>
<?php endif; ?>
<script src="<?=base_url()?>assets/myjs/tableStyle.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url()?>assets/assets/plugins/dropify/dist/js/dropify.min.js"></script>
<!-- <script src="<?=base_url()?>assets/js/dropzone.js"></script> -->
<!-- <script src="<?=base_url()?>assets/myjs/cropper.js"></script> -->




</body>
</html>