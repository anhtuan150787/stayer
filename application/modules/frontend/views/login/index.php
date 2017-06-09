<div class="container">
        <div class="row">
        	<h3>Đăng nhập hoặc chọn một tuỳ chọn</h3>
        </div>
        <div class="row login-container">
        	<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="padding-left: 100px">
        		<button class="login-facebook" id="login_face">Đăng nhập bằng Facebook</button>
        		
        		<button class="login-google" id="customBtn">Đăng nhập bằng Google</button>
        		
        		<div>
        			<p><i class="fa fa-key"></i> Chúng tôi sẽ giữ bí mật thông tin này</p>
        			<p><i class="fa fa-shield"></i> Chỉ chia sẻ khi có sự đồng ý của bạn</p>
        			<p><i class="fa fa-clock-o"></i> Đăng nhập nhanh - không mật khẩu</p>
        		</div>
        	</div>
        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        		<div class="panel-login">
        			<h4>Hoặc đăng nhập bằng email của quý vị</h4>
                    <?php if (!empty($error)):?>
                    <label class="error-login" style="display: block;"><?php echo $error;?></label>
                    <?php endif;?>
        			<form action="" method="post" id="fr-login" autocomplete="off">		
						<fieldset>
							<div style="height:15px"></div>
							<div class="form-group">
								<label>Địa chỉ email</label>
								<input maxlength="50" class="form-control" name="u_n" id="u_n" value="" />
                                <label class="error-login" for="u_n"></label>
							</div>
							<div class="form-group">
								<label>Mật khẩu</label>
								<input maxlength="50" class="form-control" name="p_w" id="p_w" type="password" value="">
                                <label class="error-login" for="p_w"></label>
							</div>
							<div class="form-group">
								<a href="<?php echo show_link('', 'Quên mật khẩu', 'forget_pass');?>">Quên mật khẩu?</a>
							</div>
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember_user" value="1" />Giữ tôi luôn đăng nhập
									</label>
								</div>
							</div>
						</fieldset>
						<div class="form-actions">
                            <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
							<button id="btn-login" class="btn btn-success" style="margin-right:15px">ĐĂNG NHẬP</button>
							<a href="<?php echo show_link('', 'Đăng ký', 'registration');?>">Đăng ký tài khoản</a>
						</div>
					</form>
        			</div>
        	</div>
        </div>
     </div>