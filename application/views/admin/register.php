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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fontawesome/css/all.css">
    <script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
    <!-- END: Custom CSS-->
    <style>
    /* body{
      margin:10% 0% 10% 0%;
      height: 100%;
      
    }
    .login-bg{
     
      background-size: auto 141%;
      background-size: cover;
    } */
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
            <input type="hidden" name="" id="base_url" value="<?php echo base_url(); ?>">
              <form class="login-form" method="POST" action="<?php echo base_url(); ?>users/registration">
                <div class="row">
                  <div class="input-field col s12" style="margin-top: 0px">
                    <h5 class="ml-4">Register</h5>
                    <p class="ml-4">Join to our community now !</p>
                  </div>
                </div>
                <input id="b" name="referral_link" type="hidden" value="<?php echo uniqid();?>">
                <input id="a" name="referral_id" type="hidden" value='<?php if(isset($_GET['id'])){ echo 'users/registration?id='.$_GET['id'];}?>'>
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
                <div class="row">
                 <div class="input-field col s12 m12 l12" style="margin-top: 0px">
                      <div id="gSignInWrapper">
                        <div id="customBtn" class="customGPlusSignIn btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12 border-round">
                          <span class="buttonText"><i class="fab fa-google pr-2"></i> Sign up with Google</span>
                        </div>
                    </div>
                 </div>
                </div>
                <div class="row">
                  <div class="input-field col s12" style="margin-top: 0px">
                   
                  </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12" style="margin-top: 0px">
                      <div>  
                        <div id="facebook-button" class="btn waves-effect waves-light gradient-45deg-purple-deep-orange col s12 border-round">
                        <i class="fab fa-facebook-f pl-1"></i> 
                        <span class="pl-3">
                        Sign up with Facebook
                        </span>
                       
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s12" style="margin-top: 0px">
                    <p class="margin medium-small"><a href="<?php echo base_url(); ?>login">Already have an account? Sign in</a></p>
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
	                    minlength: 10,
                      maxlength: 10,
                      digits: true,
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
            console.log();
            // console.log(googleUser.getBasicProfile().getGivenName());
            // console.log(googleUser.getBasicProfile().getEmail());
            
            var userFullName = googleUser.getBasicProfile().getName();
            var userName = googleUser.getBasicProfile().getGivenName();
            var lastName = userFullName.split(" ").pop();
            var userEmail = googleUser.getBasicProfile().getEmail();
            // signUp(googleUser.getBasicProfile());
            // console.log("user name: "+userName);
            // console.log("user name: "+userName);
            // console.log("your last name: "+lastName+' '+userFullName);
            // console.log("Email"+userEmail);
            signUpWithGoogle(userName,lastName,userEmail)
                
          googleUser.getBasicProfile().getName();
              // SignIn(googleUser.getBasicProfile().getEmail());
        }, function(error) {
          // alert(JSON.stringify(error, undefined, 2));
        });
  }

  function  signUpWithGoogle(userName,lastName,userEmail)
  {
    var base_url = $(document).find("#base_url").val();
   var   data = {
      username:userName,
      last_name:lastName,
      email:userEmail
    };
    $.ajax({
      type: "POST",
      url: base_url+"users/signUpWithGoogle",
      data:data,
      dataType: "json",
      success: function (response) {
        window.location.href = response.url;
      },
      error: function (request, status, error) {
        // alert(request.responseText);
    }
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
            // SignIn(data.email);
            // console.log('self data data.firstname:', data.firstname);
            // console.log('self data data.lastname :', data.lastname);
            // console.log('self data data.email :', data.email);
            signUpWithFacebook(data);
          })
          // Retrieves user data from OAuth provider by using #get() and
          // OAuth provider url
          facebook.get('/v2.5/me?fields=name,first_name,last_name,email,gender,location,locale,work,languages,birthday,relationship_status,hometown,picture').then(data => {
            
          })
        });
      })


      function signUpWithFacebook(data)
      {
        var firstname = data.firstname;
        var lastname = data.lastname;
        var email = data.email;
        var base_url = $(document).find("#base_url").val();
        var data = {
            username:firstname,
            last_name:lastname,
            email:email
          };
          
          $.ajax({
            type: "POST",
            url: base_url+"users/signUpWithFacebook",
            data:data,
            dataType: "json",
            success: function (response) {
              window.location.href = response.url;
            },
            error: function (request, status, error) {
              // alert(request.responseText);
          }
          });
    

      }
    </script>
</body>
</html>