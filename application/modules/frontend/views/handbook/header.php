<!-- Banner slide -->
        <div class="col-lg-12 banner_slide_handbook">
            <!-- Slide home-->
            <div id="slide-home" class="carousel slide banner-slide" data-ride="carousel" data-interval="3000">
                <!-- Banner slide -->
                <div class="carousel-inner" role="listbox">  
                    <?php $i_banner = 1; foreach($banner_hankbook as $v) :?>
                    <div class="item <?php echo ($i_banner == 1) ? 'active' : 'next';?> left">
                        <img src="<?php echo $this->config->item('pic_url') . 'displays/' . $v->picture; ?>" />
                    </div>
                    <?php $i_banner++; endforeach;?>
                </div>
                <!-- End Banner slide -->
            </div>
            <!-- End slide home-->
        </div>
        <!-- End Banner slide -->
        
        <!-- Menu -->
        <div class="col-lg-12 menu">
            <div class="btn-group" role="group" aria-label="">
                <button onclick="location.href='<?php echo show_link('', 'Cẩm nang du lịch', 'handbook'); ?>'" type="button" class="btn btn-default home"><span class="glyphicon glyphicon-home"></span></button>
                
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle area" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MIỀN BẮC 
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu niceScroll" style="max-height: 200px">
                        <ul>
                            <?php foreach($province as $v) :?>
                            <?php if ($v->area_id == 1) :?>
                            <li><a href="<?php echo show_link('', 'du lịch ' . $v->name, 'handbook') . '/?p=' . $v->id;?>"><?php echo html_escape($v->name);?></a></li>
                            <?php endif;?>
                            <?php endforeach;?>    
                        </ul>
                    </div>
                </div>	

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle area" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MIỀN TRUNG 
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu niceScroll" style="max-height: 200px">
                        <ul>
                            <?php foreach($province as $v) :?>
                            <?php if ($v->area_id == 2) :?>
                            <li><a href="<?php echo show_link('', 'du lịch ' . $v->name, 'handbook') . '/?p=' . $v->id;?>"><?php echo html_escape($v->name);?></a></li>
                            <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle area" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MIỀN NAM 
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu niceScroll" style="max-height: 200px">
                        <ul>
                            <?php foreach($province as $v) :?>
                            <?php if ($v->area_id == 3) :?>
                            <li><a href="<?php echo show_link('', 'du lịch ' . $v->name, 'handbook') . '/?p=' . $v->id;?>"><?php echo html_escape($v->name);?></a></li>
                            <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle area" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        BÃI BIỂN ĐẸP 
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu niceScroll" style="max-height: 200px">
                        <ul>
                            <?php foreach($beach as $v) :?>
                            <li><a href="<?php echo show_link('', 'du lịch ' . $v->name, 'handbook') . '/?b=' . $v->id;?>"><?php echo html_escape($v->name);?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- End Menu -->