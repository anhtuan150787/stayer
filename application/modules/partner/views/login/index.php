<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Đối tác</h3>
            </div>
            <div class="panel-body">
                <div class="login-msg-error"><?php echo (isset($error)) ? $error : ''; ?></div>
                <?php echo form_open(site_url('partner/login'), array('autocomplete' => 'off', 'method' => 'post', 'id' => 'frmLogin')); ?>
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Tài khoản" name="u_n" id="u_n" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Mật khẩu" name="p_w" id="p_w" type="password" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" maxlength="4" type="text" name="captcha" placeholder="Mã xác thực" style="width: 200px; float: left">
                                <span class="load_captcha" style="padding-left: 10px">
                                    <?php echo $captcha['image']; ?>
                                </span>
                        <span class="glyphicon glyphicon-refresh reload_captcha" style="cursor: pointer;"></span>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <button type="submit" id="login_partner" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>