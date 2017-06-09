<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <title><?php echo $title; ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/bootstrap.min.css">
        <!-- Bootstrap responsive -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/bootstrap-responsive.min.css">
        <!-- jQuery UI -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/jquery-ui/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
        <!-- PageGuide -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/pageguide/pageguide.css">
        <!-- Fullcalendar -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/fullcalendar/fullcalendar.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/fullcalendar/fullcalendar.print.css" media="print">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/style.css">
        <!-- Color CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/themes.css">
        <!-- Datepicker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/plugins/datepicker/datepicker.css">


        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>public/backend/js/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
        <!-- Touch enable for jquery UI -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
        <!-- slimScroll -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>public/backend/js/bootstrap.min.js"></script>
        <!-- vmap -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/vmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/vmap/jquery.vmap.world.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/vmap/jquery.vmap.sampledata.js"></script>
        <!-- Bootbox -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/bootbox/jquery.bootbox.js"></script>
        <!-- Flot -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/flot/jquery.flot.bar.order.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/flot/jquery.flot.resize.min.js"></script>
        <!-- imagesLoaded -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
        <!-- PageGuide -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/pageguide/jquery.pageguide.js"></script>
        <!-- FullCalendar -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <!-- Datepicker -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/datepicker/bootstrap-datepicker.js"></script>

        <!-- Theme framework -->
        <script src="<?php echo base_url(); ?>public/backend/js/eakroko.min.js"></script>
        <!-- Theme scripts -->
        <script src="<?php echo base_url(); ?>public/backend/js/application.min.js"></script>

        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

        <!-- Validate -->
        <script src="<?php echo base_url(); ?>public/backend/js/plugins/jquery-validation/dist/jquery.validate.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/js/plugins/jquery-validation/css/style.css">

        <?php
        $tinyConfig = $this->config->item('tinymce');
        ?>

        <script>
            var host_url = '<?php echo site_url(); ?>';
            var base_url = '<?php echo base_url(); ?>';
            var csrf_test_name = '<?php echo $this->security->get_csrf_hash(); ?>';
            var tinymce_filemanager_path = '<?php echo $tinyConfig['filemanager_path'];?>';
        </script>
        
        <!-- Script All-->
        <script src="<?php echo base_url(); ?>public/backend/js/scripts.js"></script>
        
        <!-- Script controller -->
        <?php if (isset($js) && !empty($js)) {
            foreach($js as $v) 
            {    
              echo '<script src="' . base_url() . 'public/backend/js/controllers/' . $v . '"></script>';
            }
        }?>
                
        
    </head>
    <body>
      
        <div id="navigation">
            <div class="container-fluid">
                <a href="#" id="brand">CMS 1.0</a>
                <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
                <?php if (isset($menu)) : ?>
                <ul class='main-nav'>
                        <?php foreach ($menu as $k => $v) : ?>
                            <li <?php echo (isset($v['item'][$controller])) ? "class='active'" : ""; ?>>
                                <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
                                    <i class="icon-edit"></i>
                                    <span><?php echo $v['name']; ?></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($v['item'] as $kk => $vv) : ?>
                                        <?php if ($vv['menu'] == 1):?>
                                        <li>
                                            <a href="<?php echo site_url() . '/backend/' . $kk; ?>"><?php echo $vv['name']; ?></a>
                                        </li>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                
                <div class="user">
                    <div class="dropdown">

                        <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i> <?php echo $admin['username']; ?>
<!--                                            <img src="<?php echo base_url(); ?>/public/backend/img/demo/user-avatar.jpg" alt="">-->
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/backend/logout">Thoát</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="#" class='toggle-mobile'><i class="icon-reorder"></i></a>
            </div>
        </div>
        <div class="container-fluid" id="content">
            <div id="left">
                <form action="http://www.eakroko.de/flat/search-results.html" method="GET" class='search-form'>
                    <div class="search-pane">
                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
                
                <?php if (isset($menu)) : ?>
                <?php foreach ($menu as $k => $v) : ?>
                <div class="subnav" >
                    <div class="subnav-title">
                        <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span><?php echo $v['name']; ?></span></a>
                    </div>
                    <ul class="subnav-menu" style="<?php echo (isset($v['item'][$controller])) ? "" : "display: none";?>">
                        <?php foreach ($v['item'] as $kk => $vv) : ?>
                        <?php if ($vv['menu'] == 1):?>
                        <li>
                            <a href="<?php echo site_url() . '/backend/' . $kk; ?>"><?php echo $vv['name']; ?></a>
                        </li>
                        <?php endif;?>                        
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
                
            </div>
            <div id="main">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="pull-left">
                            <h1><?php echo $title; ?></h1>
                        </div>
                    </div>
                    <?php echo breadcrumb($breadcrumbs); ?>
                    <?php echo $content; ?>
                </div>
            </div></div>
            
            <div class="load_script"></div>

    </body>

</html>

