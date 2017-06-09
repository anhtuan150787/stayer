<div class="wrapper">
    <h1 style="text-align: center;"><img src="<?php echo base_url(); ?>/public/backend/img/azy-tron002.png" alt="" class='retina-ready' width="100" height="90"></h1>
    <div class="login-body">
        <h2>QUÊN MẬT KHẨU</h2>
        <div class="login-msg-error"><?php echo (isset($error)) ? $error : ''; ?></div>
        <div class="login-msg-info"><?php echo (isset($info)) ? $info : ''; ?></div>
        <?php echo form_open(site_url('backend/login/forget'), array('class' => 'validate', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frmLogin')); ?>    
        <div>
            <input maxlength="50" type="text" name='username' placeholder="Tài khoản" class='input-block-level'>
        </div>
        
        <div>
            <input maxlength="4" type="text" name="captcha" placeholder="Mã xác thực" class='input-block-level' style="width: 220px;">
            <span class="load_captcha">
                <?php echo $captcha['image']; ?>
            </span> 
            <span class="icon-refresh reload_captcha" style="cursor: pointer;"></span>           
        </div> 

        <div class="submit" style="padding-bottom: 10px">
            <span><a href="<?php echo site_url('backend/login');?>">Đăng nhập</a></span>
            <input type="submit" value="Lấy lại mật khẩu" class='btn btn-primary'>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>