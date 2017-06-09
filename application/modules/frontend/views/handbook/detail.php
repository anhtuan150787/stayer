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

            <!-- Hand book content -->
            <div class="handbook-detail">
                <div class="title">
                    <?php echo html_escape($record->name);?>
                </div>
                <div class="date" style="margin-bottom: 10px;"><?php echo show_date($record->update_time);?></div>

                <?php echo show_button_like_face(array(
                    'url' => show_link($record->id, html_escape($record->name), 'handbook_detail'),
                    'title' => html_escape($record->name),
                    'description' => html_escape($record->description),
                    'picture' => show_picture(html_escape($record->picture), '', '', 'handbook'),
                ));?>

                <div class="quote">
                    <?php echo html_escape($record->description);?>
                </div>
                <div class="content">
                    <?php echo $record->content;?>
                </div>
            </div>     
            <!-- End Hand book content -->

            <!-- Other hand book -->
            <div class="col-lg-12 handbook-other">
                <div class="title">TIN KHÁC</div>
                <ul class="list-other">
                    <?php foreach($other as $v):?>
                    <li><a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><?php echo html_escape($v->name);?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <!-- End Other hand book -->

        </div>
        <!-- End Right col -->

    </div>
</div>

<script type="text/javascript">
    

</script>