<div class="container">
    <div style="height: 30px"></div>
    <div class="row register-container">
        <h3>Lấy lại mật khẩu</h3>
        <hr />
        
        <?php if (isset($step) && $step == 1):?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="panel-login">
                    <h4>Nhập địa chỉ email mà bạn sử dụng để đăng nhập vào hệ thống</h4>
                    <?php if (!empty($error)):?>
                    <label class="error-login" style="display: block;"><?php echo $error;?></label>
                    <?php endif;?>
                    <form method="post" action="" id="fr-forget-pass" autocomplete="off">
                        <fieldset>
                            <div style="height: 15px"></div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <input class="form-control" maxlength="50" name="email" id="email" value="<?php echo $this->input->post('email');?>">
                                        <label class="error-login" for="email"></label>
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
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="step" value="1" />
                            <button type="button" class="btn btn-success" id="btn-forget-pass" style="margin-right: 15px;">Tiếp tục</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div class="clearfix">&nbsp;</div>
        <?php endif;?>
        
        
        
        <?php if (isset($step) && $step == 2):?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="panel-login">
                    <h4>Vui lòng vào email <?php echo $user_info['email'];?> để lấy mã xác thực</h4>
                    <?php if (!empty($error)):?>
                    <label class="error-login" style="display: block;"><?php echo $error;?></label>
                    <?php endif;?>
                    <form method="post" action="" id="fr-forget-update-pass" autocomplete="off">
                        <fieldset>
                            <div style="height: 15px"></div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Mã xác thực</label>
                                        <input class="form-control" maxlength="50" name="mxt" id="mxt" value="<?php echo $this->input->post('mxt');?>">
                                        <label class="error-login" for="mxt"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu mới</label>
                                        <input class="form-control" type="password" maxlength="50" name="password" id="password" value="<?php echo $this->input->post('password');?>" />
                                        <label class="error-login" for="password"></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Xác nhận mật khẩu</label>
                                        <input class="form-control" type="password" maxlength="50" name="re_password" id="re_password" value="<?php echo $this->input->post('re_password');?>" />
                                        <label class="error-login" for="re_password"></label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="step" value="2" />
                            <button type="button" class="btn btn-success" id="btn-forget-update-pass" style="margin-right: 15px;">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif;?>
        
        <?php if (isset($step) && $step == 3):?>
            <?php echo '<p class="text-primary" style="text-align:center">' . $success . '</p>';?>
            <script>
                setTimeout(function(){location.href='<?php echo site_url();?>';}, 5000);
            </script>
        <?php endif;?>
        
    </div>
</div>