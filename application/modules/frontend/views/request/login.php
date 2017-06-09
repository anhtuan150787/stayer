<!-- Bootstrap css -->
<link href="<?php echo base_url(); ?>/public/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>/public/frontend/css/style.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="row login-container" style="margin-top: 0; background: none; border: none; padding-top: 10px">
    	<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="padding-left: 50px">
    		<button class="login-facebook" id="login_face" style="padding: 10px 25px 10px 25px">Đăng nhập bằng Facebook</button>
    		
    		<button class="login-google" id="customBtn" style="padding: 10px 25px 10px 25px">Đăng nhập bằng Google</button>
    		
    	</div>
    	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    		<div class="panel-login">
    			<h4>Hoặc đăng nhập bằng email của bạn</h4>
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
							<a href="javascript: void(0)" onclick="window.parent.location.href='<?php echo show_link('', 'Quên mật khẩu', 'forget_pass');?>'">Quên mật khẩu?</a>
						</div>
                        
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember_user" value="1" />Giữ tôi luôn đăng nhập
								</label>
							</div>
						</div>
					</fieldset>
					<div class="form-actions" style="text-align: right;">
                        <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
						<button id="btn-login" class="btn btn-success" style="margin-right:15px">ĐĂNG NHẬP</button>
						<a href="javascript: void(0)" onclick="window.parent.location.href='<?php echo show_link('', 'Đăng ký', 'registration');?>'">Đăng ký tài khoản</a>
					</div>
				</form>
    			</div>
    	</div>
    </div>
 </div>
 
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>/public/frontend/js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>/public/frontend/js/bootstrap.min.js"></script>

<!-- Script on page -->
<script src="<?php echo base_url(); ?>/public/frontend/js/script.js"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '411391592393250',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function callBackLoginFacebook() {
    FB.api('/me?fields=name,email,picture', function(response) {
        $.ajax({
            url: '<?php echo base_url(); ?>request/check_login_outsite',
            data: {type: 'facebook', email: response.email, user_app_id: response.id, name: response.name ,csrf_test_name: '<?php echo $this->security->get_csrf_hash(); ?>'},
            type: 'post',
            success: function (result) {
                if (result == true)
                    window.parent.location.href="<?php echo $url_current;?>";
            },
            async: false
        });
      //document.getElementById('status').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;          
    });
  }

  $(function(){
        $("#login_face").click(function(){
            FB.login(function(response) {
                if (response.authResponse) {                                                                    
                  callBackLoginFacebook();                                            
                }
            }, {scope: 'email,public_profile', return_scopes: true});
        })
    });

</script>

<!-- Google login -->
<meta name="google-signin-client_id" content="972401465642-v2a3evc5pfmb1b4vvluagee1g35nttrm.apps.googleusercontent.com">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<script src="https://apis.google.com/js/api:client.js"></script>
<script>
    var googleUser = {};
    var startApp = function () {
        gapi.load('auth2', function () {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: '972401465642-v2a3evc5pfmb1b4vvluagee1g35nttrm.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('customBtn'));
        });
    };

    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function (googleUser) {
                $.ajax({
                    url: '<?php echo base_url(); ?>request/check_login_outsite',
                    data: {
                        type: 'google',
                        email: googleUser.getBasicProfile().getEmail(),
                        user_app_id: googleUser.getBasicProfile().getId(),
                        name: googleUser.getBasicProfile().getName(),
                        csrf_test_name: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    type: 'post',
                    success: function (result) {
                        if (result == true)
                            window.parent.location.href="<?php echo $url_current;?>";
                    },
                    async: false
                });
            }, function (error) {
                alert(JSON.stringify(error, undefined, 2));
            });
    }
</script>


<script>startApp();</script>
<!-- End Google login -->
 