<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="" name="description" />
    <meta name="keywords" content="Fashion Makers, Fashion Makers admin">
    <meta name="author" content="ThemeSelect">
    <title>Blogging</title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon/infiny_icon.png"> -->
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/favicon/pn_icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/icon/blogging.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/forgot.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
    <style>
    .login-bg{
      background-size: auto 141%;
    }
    </style>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column forgot-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container"><div id="forgot-password" class="row">
  <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
    <form class="forgotPassForm" method="POST" action="<?php echo base_url(); ?>Login/forgotPass">
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Forgot Password</h5>
          <p class="ml-4">Enter either your username or email</p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input type="text" class="form-control passRecUsername" name="username">
          <label for="email" class="center-align">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">email</i>
          <!-- <input id="email" type="email"> -->
          <input type="email" class="form-control passRecEmail" name="email">
          <label for="email" class="center-align">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
			<button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">
				Submit
			</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"><a href="<?php echo base_url(); ?>login">Sign in</a></p>
        </div>
        <div class="input-field col s6 m6 l6">
          <!-- <p class="margin right-align medium-small"><a href="<?php echo base_url(); ?>">Register</a></p> -->
        </div>
      </div>
    </form>
  </div>
</div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?php echo base_url(); ?>assets/js/plugins.js" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url(); ?>assets/js/scripts/form-validation.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	<!-- <script>
		jQuery(document).ready(function() {

    $('.forgotPassForm').validate({
        onfocusout: function(e) {
          this.element(e);
        },
        onkeyup: false,
          rules : {
                 username: {
                required: function(element) {

                  return (!$(".passRecEmail").hasClass('valid'));
                }
            },
            email: {
                required: function(element) {
                  return (!$(".passRecUsername").hasClass('valid'));
                }
            }
        }
      });
		});
	</script> -->

<script>
   var BASE_URL = "<?php echo base_url(); ?>";
		jQuery(document).ready(function() {
			$(".forgotPassForm").validate({
				onfocusout: function(e) {
					this.element(e);						  
				},
				// onkeyup: true,
			    rules: {
					username: { 
                      minlength: 3,
                      required: function(element) {

                        return (!$(".passRecEmail").hasClass('valid'));
                        }
                     
                  },
	        email: {
                  email:true,
                  required: function(element) {
                  return (!$(".passRecUsername").hasClass('valid'));
                }
	              },
              },
			    messages: {
			      username:{
              required: "Enter a username"
            },
            email:{
              required: "Enter a email"
			      }
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
  </body>
</html>