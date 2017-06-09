<?php echo $this->load->view('layout/header.php');?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><?php echo $partner['hotel_name'];?></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">


            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    -->
                    <li><a href="<?php echo base_url() . 'partner/logout';?>"><i class="fa fa-sign-out fa-fw"></i> Thoát</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <!--
                    <li>
                        <a href="<?php echo site_url() . '/partner/index';?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    -->
                    <?php if (isset($menu)) : ?>
                    <?php foreach ($menu as $k => $v) : ?>
                    <li <?php echo (isset($v['item'][$controller])) ? "class='active'" : ""; ?>>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> <?php echo $v['name']; ?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php foreach ($v['item'] as $kk => $vv) : ?>
                                <?php if ($vv['menu'] == 1):?>
                                <li>
                                    <a href="<?php echo site_url() . '/partner/' . $kk; ?>"><?php echo $vv['name']; ?></a>
                                </li>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php echo $content;?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php echo $this->load->view('layout/footer.php');?>