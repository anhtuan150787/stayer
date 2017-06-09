<form action="<?php echo show_link('','tìm kiếm cẩm nang', 'handbook');?>" method="get" autocomplete="off">
                <!-- Form search -->
                <div class='col-lg-12 search-form'>
                    <div class='subject-title'>TÌM BÀI VIẾT</div>
                    <div class='subject-content'>
                        <div class='col-lg-12 item'>
                            <input type='text' value="<?php echo html_escape($this->input->get('k', ''));?>" placeholder="Từ khóa" name="k" />
                        </div>
                        
                        <div class="col-lg-12 btn-search">
                            <button class="btn btn-default" type="submit">TÌM KIẾM</button>
                        </div>
                    </div>
                </div>
                <!-- End Form search -->
            </form>

            <!-- Block box item -->
            <div class="col-lg-12 box read-hot">
                <div class="subject-title">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu1">ĐỌC NHIỀU NHẤT</a></li>
                        <li><a data-toggle="tab" href="#menu2">BÀI MỚI NHẤT</a></li>
                    </ul>
                </div>
                <div class='subject-content'>     
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">

                            <?php foreach($handbook_viewmost as $v):?>
                            <!-- List handbox read item-->
                            <div class="col-lg-12 list-handbox-item">
                                <div class="col-lg-4 picture">
                                    <a href="">
                                        <img class="img-responsive" src='<?php echo show_picture(html_escape($v->picture), 73, 56, 'handbook'); ?>' />
                                    </a>
                                </div>
                                <div class="col-lg-8 description">
                                    <p class="name"><a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><?php echo html_escape($v->name);?></a></p>
                                    <p class="date"><?php echo show_date($v->update_time);?></p>
                                </div>
                            </div>
                            <!-- End List handbox read item-->
                            <?php endforeach;?>
                            
                        </div>
                        <div id="menu2" class="tab-pane fade">
                          
                          <?php foreach($handbook_new as $v):?>
                            <!-- List handbox read item-->
                            <div class="col-lg-12 list-handbox-item">
                                <div class="col-lg-4 picture">
                                    <a href="">
                                        <img class="img-responsive" src='<?php echo show_picture(html_escape($v->picture), 73, 56, 'handbook'); ?>' />
                                    </a>
                                </div>
                                <div class="col-lg-8 description">
                                    <p class="name"><a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><?php echo html_escape($v->name);?></a></p>
                                    <p class="date"><?php echo show_date($v->update_time);?></p>
                                </div>
                            </div>
                            <!-- End List handbox read item-->
                            <?php endforeach;?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <div class="col-lg-12 box cam_nang_du_lich">
                <div class="subject-title">CẨM NANG DU LỊCH</div>
                <div class='subject-content'>
                <?php foreach($handbook_cn as $v):?>
                    <p><a href="<?php echo show_link($v->id, $v->name, 'handbook_detail');?>"><?php echo html_escape($v->name);?></a></p>
                <?php endforeach;?>    
                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">KHÁCH SẠN NỔI BẬT</div>
                <div class='subject-content'>
                    <?php foreach ($hotel_other as $v): ?>
                        <!-- List hotel same item-->
                        <div class="col-lg-12 list-hotel-same">
                            <div class="col-lg-5 picture">
                                <a href="<?php echo $v->url; ?>">
                                    <img class="img-responsive" src='<?php echo $v->picture; ?>' />
                                    <div class="evaluation"><?php echo $v->point; ?></div>
                                </a>
                            </div>
                            <div class="col-lg-7 description">
                                <p class="title"><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>
                                <ul class="star">
                                    <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                        <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                    <?php endfor; ?>
                                </ul>
                                <p class="price">Giá 1 đêm từ <label><?php echo $v->price; ?></label></p>
                            </div>
                        </div>
                        <!-- End List hotel same item-->
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">BẠN QUAN TÂM CHỦ ĐỀ GÌ</div>
                <div class='subject-content'>
                    <?php foreach($handbook_tag as $v):?>
                    <!-- Item subject -->
                    <div class="item-subject <?php echo ($this->input->get('tag') == $v->id) ? 'active' : '';?>"><a href="<?php echo show_link('', html_escape($v->name), 'handbook');?>/?tag=<?php echo $v->id;?>"><?php echo html_escape($v->name);?></a></div>
                    <!-- End Item subject -->
                    <?php endforeach;?>
                </div>
            </div>
            <!-- End Block box item -->