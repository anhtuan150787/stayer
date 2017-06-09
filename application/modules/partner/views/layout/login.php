<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/partner/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>public/partner/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/partner/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>public/partner/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <?php echo $content;?>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>public/partner/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>public/partner/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>public/partner/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>public/partner/dist/js/sb-admin-2.js"></script>

    <!-- Validate -->
    <script src="<?php echo base_url(); ?>public/partner/js/jquery-validation/dist/jquery.validate.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/partner/js/jquery-validation/css/style.css">

    <script src="<?php echo base_url(); ?>public/partner/js/scripts.js"></script>

    <!-- Script controller -->
    <?php if (isset($js) && !empty($js)) {
        foreach($js as $v)
        {
            echo '<script src="' . base_url() . 'public/partner/js/controllers/' . $v . '"></script>';
        }
    }?>

    <script>
        var host_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';
        var csrf_test_name = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>



</body>

</html>
