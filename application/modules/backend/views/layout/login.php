<!doctype html>
<html>
    <head>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <title><?php echo $title;?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url();?>/public/backend/css/bootstrap.min.css">
        <!-- Bootstrap responsive -->
        <link rel="stylesheet" href="<?php echo base_url();?>/public/backend/css/bootstrap-responsive.min.css">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>/public/backend/css/style.css">
        <!-- Color CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>/public/backend/css/themes.css">


        <!-- jQuery -->
        <script src="<?php echo base_url();?>/public/backend/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>/public/backend/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>/public/backend/js/eakroko.js"></script>
		
		<!-- Validate -->
	
		<script src="<?php echo base_url();?>/public/backend/js/plugins/jquery-validation/dist/jquery.validate.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>/public/backend/js/plugins/jquery-validation/css/style.css">
		
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>/public/backend/img/favicon.ico" />
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>/public/backend/img/apple-touch-icon-precomposed.png" />


        <!-- Script controller -->
        <?php if (isset($js) && !empty($js)) {
            foreach($js as $v) 
            {    
              echo '<script src="' . base_url() . 'public/backend/js/controllers/' . $v . '"></script>';
            }
        }?>
        
        <script>
            var host_url = '<?php echo site_url(); ?>';
            var base_url = '<?php echo base_url(); ?>';
            var csrf_test_name = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        
    </head>

    <body class='login'>
        <?php echo $content; ?> 

    </body>

</html>
