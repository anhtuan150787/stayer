<div class="container handbook">
    <div class="row">
        <?php echo $this->load->view('handbook/header.php');?>
    
        <!-- Left col -->
        <div class="col-lg-3 left" style="margin-top: 30px">
            <?php echo $this->load->view('handbook/left.php');?>
        </div>
        <!-- End Left col -->

        <!-- Right col -->
        <div class="col-lg-9 right" style="margin-top: 30px;">
            
            <?php foreach($records as $v):?>
            <!-- List handbox right -->
            <div class="col-lg-12 list-hand-book">
                <div class="col-lg-7 description">
                    <p class="title">
                        <a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><?php echo $v->name;?></a>
                    </p>
                    <p class="quote">
                        <?php echo $v->description;?>
                    </p>
                </div>
                <div class="date"><?php echo show_date($v->update_time);?> &nbsp;&nbsp;/&nbsp;&nbsp; <?php echo $v->view;?> VIEWS </div>
                <div class="col-lg-5 picture">
                    <a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><img class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 327, 210, 'handbook'); ?>" /></a>
                </div>
            </div>
            <!-- End List handbox right -->
            <?php endforeach; ?>

                <!-- Paging -->
                <?php if ($this->pagination->create_links() != '') : ?>
                    <div class="col-lg-12 page">
                    <?php echo $this->pagination->create_links(); ?>
                    </div>
                <?php endif; ?>
                <!-- End Paging -->

        </div>
        <!-- End Right col -->

    </div>
</div>