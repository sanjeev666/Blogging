<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="954542077732-ptjpn67qbrleqbk07dmcnkmbma6rc344.apps.googleusercontent.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="" name="description" />
    <meta name="keywords" content="Fashion Makers, Fashion Makers admin">
    <meta name="author" content="ThemeSelect">
    <title>Blogging</title>
   
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/favicon/pn_icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/icon/blogging.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom/custom.css">
    <script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
    <!-- END: Custom CSS-->
    <style>
    .alert-success{
      color:green;
    }
    .alert-danger{
      color:red;
    }
    .parent span {
      vertical-align: top !important;
      background:green;
    }
      
    .margin-center{
      padding-left:19%;
    }
​
    span.label {
      font-family: medium-content-sans-serif-font, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Arial, sans-serif;
      font-weight: normal;
    }
​
    span.icon {
      background: url('<?php echo base_url(); ?>assets/upload/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      margin:0% 0% 0.7% 0%;
      width: 41px;
      height: 26px
    }
​
      span.icon1 {
      background: url('<?php echo base_url(); ?>assets/upload/facebook.ico') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      margin:0% 0% 0.7% 0%;
      width: 41px;
      height: 26px
    }
    </style>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
  
​
    <div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
              <form class="login-form" method="POST" action="<?php echo base_url(); ?>admin/login">
                <div class="row">
                  <div class="input-field col s12">
                    <h5 class="ml-4">Sign in</h5>
                  </div>
                </div>
                <div class="row margin">
                <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i>
              </div>
​
              <?php if ($this->session->flashdata("success")): ?>
                <div class="alert alert-success">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                </div>
              <?php elseif ($this->session->flashdata("error")): ?>
                <div class="alert alert-danger">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                </div>
              <?php endif;?>
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="username" class="form-control" name="username" type="text">
                    <label for="username" class="center-align">Username</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <!-- <input id="password" type="password"> -->
                    <input type="password" class="form-control password" name="password" id="password">
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 m12 l12 ml-2 mt-1">
                    <p>
                      <label>
                        <!-- <input type="checkbox" /> -->
                          <!-- <input type="hidden" name="" id="baseurl" value="<?php echo base_url(); ?>">
                        <input type="checkbox" class="grey remember" id="remember" name="remember">
                        <span>Remember Me</span> -->
                      </label>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12" style="margin-top: 0px">
                      <button type="submit" class="btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12">
                      Sign in
                      </button>
                  </div>
                </div>
               
                <div class="row">
                  <div class="input-field col s6 m6 l6">
                    <!-- <p class="margin right-align medium-small"><a href="<?php echo base_url(); ?>Login/forgotPass">Forgot password ?</a></p> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url(); ?>assets/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?php echo base_url(); ?>assets/js/plugins.js" type="text/javascript"></script>
​
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
​
	<script>
		jQuery(document).ready(function() {
			$(".login-form").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				onkeyup: false,
			    rules: {
					username: {
	                    minlength: 2,
	                    required: true
	                },
          password: {
              minlength: 5,
              required: true
                  }
			         },
			    messages: {
			      username:{
			        required: "Enter a username",
                  },
                  password:{
			        required: "Enter a password",
			      },
			    },
				errorElement : 'div',
				errorPlacement: function(error, element) {
					var placement = $(element).data('error');
					if (placement) {
					  $(placement).append(error)
					} else {
						error.insertAfter(element);
					}
			    }
			});
		});
  </script>
​
  </body>
</html>