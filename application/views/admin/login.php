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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fontawesome/css/all.css">
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

    span.label {
      font-family: medium-content-sans-serif-font, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Arial, sans-serif;
      font-weight: normal;
    }

    
    .login-bg{
      background-size: auto 141%;
    }
    </style>
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">

    <div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
              <form class="login-form" method="POST" action="<?php echo base_url(); ?>Login/login">
                <div class="row">
                  <div class="input-field col s12">
                    <h5 class="ml-4">Sign in</h5>
                  </div>
                </div>
                <div class="row margin">
                  <?php if ($this->session->flashdata("success")): ?>
                    <div class="alert alert-success">
                      <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                    </div>
                  <?php elseif ($this->session->flashdata("error")): ?>
                    <div class="alert alert-danger">
                      <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                    </div>
                  <?php endif;?>
                <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i>
              </div>
                </div>

                <div class="row">
                 <div class="input-field col s12 m12 l12" style="margin-top: 0px">
                      <div id="gSignInWrapper">
                        <div id="customBtn" class="customGPlusSignIn btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12 border-round">
                          <span class="buttonText"><i class="fab fa-google pr-5"></i> 
                          <span>
                          Sign in with Google
                          </span>
                         </span>
                        </div>
                    </div>
                 </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12 m12 l12" style="margin-top: 0px">
                      <div>  
                        <div id="facebook-button" class="btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12 border-round">
                        <i class="fab fa-facebook-f pr-2 pl-2"></i>
                         <span class="pl-3">
                        Sign in with Facebook
                        </span> 
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small"><a href="<?php echo base_url(); ?>users/registration">Register Now!</a></p>
                  </div>
                  <div class="input-field col s6 m6 l6">
                    <p class="margin right-align medium-small"><a href="<?php echo base_url(); ?>Login/forgotPass">Forgot password ?</a></p>
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

    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

	<script>
    var timeout = 1500; // in miliseconds (3*1000)
    $('.alert').delay(timeout).fadeOut(300);
    
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

<script>

// google sign in

    var base_url = $('#baseurl').val();
    var login_page = base_url+'users/registration';
    function SignIn(googleUser) {
        if(googleUser.length == 0 )
        {
          googleUser = 'asdasd750@gmail.com';
        }
         
          $.ajax({
              type: "POST",
              url: "<?php echo base_url('users/checkEmailAjax'); ?>",
              beforeSend: function (){
                loader();
              },
              
              data: {email:googleUser},
              dataType: "json",
              success: function (response) {
                  if(response.err == '400')
                  {
                    window.location.href = response.url;
                  }
              },
              
              complete: function(){
               $.unblockUI();
          },
          });    
  }

 
</script>

<!-- google sign in -->
<script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '954542077732-ptjpn67qbrleqbk07dmcnkmbma6rc344.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
      

    });
  };

  function attachSignin(element) {
    // console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          // document.getElementById('name').innerText = "Signed in: " +
          //     googleUser.getBasicProfile().getName();
              SignIn(googleUser.getBasicProfile().getEmail());
        }, function(error) {
          // alert(JSON.stringify(error, undefined, 2));
        });
  }

  
  </script>
   <script>startApp();</script>
   <script>
      $('#facebook-button').on('click', function() {
        // Initialize with your OAuth.io app public key
        // OAuth.initialize('AQsw2OcovUi64gWg9UxSxjlR91E');
        // OAuth.initialize('Om9TvLOWLiiHQ1W_ewwbdhTLXMY');
        OAuth.initialize('WEJHDpV62x4tbmhswcCF8qL1eqw');
        // Use popup for oauth
        OAuth.popup('facebook').then(facebook => {
          // console.log('facebook:',facebook);
          // Prompts 'welcome' message with User's email on successful login
          // #me() is a convenient method to retrieve user data without requiring you
          // to know which OAuth provider url to call
          facebook.me().then(data => {
            // console.log('me data:', data);
            // alert('Facebook says your email is:' + data.email + ".\nView browser 'Console Log' for more details");
            SignIn(data.email);
          })
          // Retrieves user data from OAuth provider by using #get() and
          // OAuth provider url
          facebook.get('/v2.5/me?fields=name,first_name,last_name,email,gender,location,locale,work,languages,birthday,relationship_status,hometown,picture').then(data => {
            // console.log('self data:', data);
          })
        });
      })
    </script>
    
    <script src="<?php echo base_url(); ?>assets/css/jquery.blockUI.js"></script>
<script>
function loader()
      {
        $.blockUI({ css: { 
                border: 'none', 
                padding: '0px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: 0.6, 
                color: '#fff' 
            } }); 
      }
</script>

  </body>
</html>


