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
    <!-- <link rel="apple-touch-icon" href="<?php echo base_url() ;?>assets/images/favicon/pn_icon.png"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/icon/blogging.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
    <style>
    body{
      margin:10% 0% 10% 0%;
      height: 100%;
      
    }
    .login-bg{
     
      background-size: auto 160%;
      /* background-size: cover; */
    }
    .alert-success{
      color:green;
    }
    .alert-danger{
      color:red;
    }
    </style>



  </head>
  <!-- END: Head-->
  
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container">
          <div id="login-page" class="row">
            <div class="col s12 m6 l5 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
              <form class="login-form" method="POST" action="<?php echo base_url(); ?>users/registration">
                <div class="row">
                  <div class="input-field col s12">
                    <h5 class="ml-4">Register</h5>
                    <p class="ml-4">Join to our community now !</p>
                  </div>
                </div>
                <input id="id" name="referral_link" type="hidden" value="<?php echo uniqid();?>">
                <input id="id" name="referral_id" type="hidden" value='<?php if(isset($_GET['id'])){ echo 'users/registration?id='.$_GET['id'];}?>'>
                <div class="row margin">
                  <div class="errorHandler alert alert-danger no-display">
                  <i class="fa fa-remove-sign"></i>
                  </div>
                </div>
              <?php if($this->session->flashdata("success")): ?>
                <div class="alert alert-success">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                </div>
              <?php elseif($this->session->flashdata("error")): ?>
                <div class="alert alert-danger">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                </div>
              <?php endif; ?>
              <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="username" class="form-control" name="username" type="text" >
                    <label for="username" class="center-align">Username</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="first_name" class="form-control" name="first_name" type="text" >
                    <label for="first_name" class="center-align">First Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="last_name" type="text" name="last_name" >
                    <label for="last_name">Last Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">mail_outline</i>
                    <input id="email" type="email" name="email" >
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input id="password-again" type="password" name="passwordAgain">
                    <label for="password-again">Password again</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <i class="material-icons prefix pt-1">phone_outline</i>
                    <input id="phone_no" type="number" name="phone_no">
                    <label for="phone_no">Phone No.</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                      Register
                    </button>
                </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <p class="margin medium-small"><a href="<?php echo base_url(); ?>login">Already have an account? Login</a></p>
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url() ;?>assets/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?php echo base_url() ;?>assets/js/plugins.js" type="text/javascript"></script>
    
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

	<script>
   var BASE_URL = "<?php echo base_url(); ?>";
		jQuery(document).ready(function() {
			$(".login-form").validate({
				onfocusout: function(e) {
					this.element(e);						  
				},
				// onkeyup: true,
			    rules: {
					username: { 
                      minlength: 3,
                      required: true,
                      remote : {
                      url: BASE_URL + "users/checkUserUsername",
                      type: "POST",
                      dataType: "json",
                      data:{
                            'csrf_test_name' : 'csrf_cookie_name'
                        }
                      }
                  },
         first_name: {
                      minlength: 3,
                      required: true
                  },
          last_name: {
	                    minlength: 3,
	                    required: true
	                },
	        email: {
	                    required: true,
                      email:true,
                      remote : {
                      url: BASE_URL +"users/checkUserEmail",
                      type: "POST",
                      dataType: "json",
                      data:{
                            'csrf_test_name' :'csrf_cookie_name'
                        }
                      }
	                },
          password: {
	                    minlength: 5,
	                    required: true
	                },
          passwordAgain: {
	                    minlength: 5,
	                    required: true,
                      equalTo : "#password"
	                   },
          phone_no: {
	                    minlength: 9,
                      maxlength: 10,
	                    required: true              
	                },
                },
			    messages: {
			      username:{
              required: "Enter a username",
              remote:"Username already exists "
            },
            first_name:{
			        required: "Enter a first name",
			      },
            last_name:{
			        required: "Enter a last name",
			      },
            email:{
              required: "Enter a email",
              remote:"Email already exists "
			      },
            password:{
			        required: "Enter a password",
			      },
            passwordAgain:{
			        required: "Enter a password again",
			      },
            phone_no:{
			        required: "Enter a mobile number",
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