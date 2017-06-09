<div class="container">
    <div style="height: 30px"></div>
    <div class="row register-container">
        <h3>Tạo tài khoản</h3>
        <hr />
        
        <?php if (!isset($success)):?>
        <h5>Lý do nên chọn Azy</h5>
        <div style="height: 15px"></div>
        <div class="container">
            <div class="row">           
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        	<label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-usd fa-fw"></i></button>
                            </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        	<label class="row">
                            <span>Giá rẻ hơn đặt tại khách sạn</span>
                            <p class="title-detail">Rẻ hơn từ 20% - 30% khi đặt qua Azy</p>
                            </label>
                        </label>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-search fa-fw"></i></button>
                        </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <label class="row">
                            <span>Dễ dàng tìm kiếm </span>
                            <p class="title-detail">Tìm kiếm linh hoạt, dễ dàng theo nhu cầu của bạn</p>
                        </label>
                        </label>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-cutlery fa-fw"></i></button>
                        </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <label class="row">
                            <span>Dịch vụ tiện lợi</span>
                            <p class="title-detail">Sử dụng dịch vụ không cần đăng nhập thành viên</p>
                        </label>
                        </label>
                    </section>
                </div>
            </div>
            <div class="row">
            	
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-cc-visa fa-fw"></i></button>
                            </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <label class="row">
                            <span>Thanh toán linh hoạt</span>
                            <p class="title-detail">Thanh toán bằng thẻ ATM hoặc VISA/MASTER</p>
                            </label>
                        </label>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-money fa-fw"></i></button>
                        </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <label class="row">
                            <span>Thu tiền tận </span>
                            <p class="title-detail">Thu tiền tận nhà của bạn nhanh chóng, tiện lợi</p>
                            </label>
                        </label>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <section class="row">                       
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="row">
                            <button class="btn btn-title" style="margin-right: 15px;font-size:20px"><i class="fa fa-gift fa-fw"></i></button>
                        </label>
                        </label>
                        <label class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <label class="row">
                            <span>Luôn có ưu đãi đặt biệt</span>
                            <p class="title-detail">Chương trình khuyến mãi, deal cập nhật thường xuyên</p>
                        </label>
                        </label>
                    </section>
                </div>
            </div>
            
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <button class="login-facebook" id="login_face">Đăng nhập bằng Facebook</button>

                <button class="login-google" id="customBtn">Đăng nhập bằng Google</button>

                <div>
                    <p><i class="fa fa-key"></i>&nbsp;&nbsp;Chúng tôi sẽ giữ bí mật thông tin này</p>
                    <p><i class="fa fa-shield"></i>&nbsp;&nbsp;Chỉ chia sẻ khi có sự đồng </p>
                    <p><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Đăng nhập nhanh - không mật khẩu</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="panel-login">
                    <h4>Hoặc tạo tài khoản bằng email của quý vị</h4>
                    <?php if (!empty($error)):?>
                    <label class="error-login" style="display: block;"><?php echo $error;?></label>
                    <?php endif;?>
                    <form method="post" action="" id="fr-registration" autocomplete="off">
                        <fieldset>
                            <div style="height: 15px"></div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Họ tên</label>
                                        <input class="form-control" maxlength="50" name="name" id="name" value="<?php echo $this->input->post('name');?>" />
                                        <label class="error-login" for="name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <input class="form-control" maxlength="50" name="email" id="email" value="<?php echo $this->input->post('email');?>">
                                        <label class="error-login" for="email"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input class="form-control" type="password" maxlength="50" name="password" id="password" value="<?php echo $this->input->post('password');?>" />
                                        <label class="error-login" for="password"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Xác nhận mật khẩu</label>
                                        <input class="form-control" type="password" maxlength="50" name="re_password" id="re_password" value="<?php echo $this->input->post('re_password');?>" />
                                        <label class="error-login" for="re_password"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row clearfix">
                                            <div class="col-md-6">
                                                <label>Mã xác thực</label>
                                                <input class="form-control" type="text" maxlength="4" name="captcha" id="captcha" value="" />
                                                <label class="error-login" for="captcha"></label>
                                            </div>
                                            <div class="col-md-6" style="padding-top: 25px; padding-left: 5px;">
                                                <span class="load_captcha">
                                                    <?php echo $captcha['image']; ?>
                                                </span> 
                                                <span class="glyphicon glyphicon-refresh reload_captcha" style="cursor: pointer;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input id="confirm" type="checkbox" value="1" <?php if ($this->input->post()){ echo 'checked="checked"';} ?>">Tôi đã đọc và đồng ý <a target="_blank" href="<?php echo show_link(10, 'Điều kiện & điều khoản', 'page');?>">Điều khoản sử dụng</a> và <a target="_blank" href="<?php echo show_link(12, 'Chính sách bảo mật', 'page');?>">chính sách bảo mật</a>
                                            </label>
                                            <label class="error-login" for="confirm"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <button type="button" class="btn btn-success" id="btn-registration" style="margin-right: 15px;">ĐĂNG KÝ</button>
                            <a href="<?php echo show_link('', 'Đăng nhập', 'login');?>">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div class="clearfix">&nbsp;</div>
        <?php else:?>
        <?php echo '<p class="text-primary" style="text-align:center">' . $success . '</p>';?>
        <script>
            setTimeout(function(){location.href='<?php echo site_url();?>';}, 3000);
        </script>
        <?php endif;?>
    </div>
</div>