<!-- jQuery -->
<script src="<?php echo base_url(); ?>public/partner/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>public/partner/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>public/partner/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Jquery UI -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/partner/js/jquery-ui.js"></script>


<!-- Morris Charts JavaScript -->
<!--
<script src="<?php echo base_url(); ?>public/partner/bower_components/raphael/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>public/partner/bower_components/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url(); ?>public/partner/js/morris-data.js"></script>
-->
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>public/partner/dist/js/sb-admin-2.js"></script>

<script>
    $(function() {
        $( ".datepick" ).datepicker();
    });
</script>

<!-- Script controller -->
<?php if (isset($js) && !empty($js)) {
    foreach($js as $v)
    {
        echo '<script src="' . base_url() . 'public/partner/js/controllers/' . $v . '"></script>';
    }
}?>

</body>

</html>
