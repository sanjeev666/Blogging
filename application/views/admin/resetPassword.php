<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
      <title>Blogging</title>
      <!-- start: META -->
      <meta charset="utf-8" />
      <!--[if IE]>
      <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" />
      <![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="black">
      <meta content="" name="description" />
      <meta content="" name="author" />
      <!-- end: META -->
      <!-- start: MAIN CSS -->
      <style>
            .error{
               color:red;
            }
            .main-container{
               height:465px;
               width:auto;
            }
      </style>
   <body>
      <!-- end: HEAD -->
      <div class="main-container"  style="margin-top:60px;">
         <section class="wrapper padding50">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h3 class="">Welcome back, <?php echo $userdata['username']; ?>.</h3>
                     <h5 class="center">Reset your password here!</h5>
                     <div style="width: 60%; margin: 40px auto;">
                        <form  id="contactForm" method="POST" action="<?php echo base_url('login/resetPassword/'.$token); ?>">
                           <input type="hidden" name="token" value="<?php echo $token; ?>">
                           <input type="hidden" name="name" value="<?php echo $userdata['username']; ?>">
                           <input type="hidden" name="email" value="<?php echo $userdata['email']; ?>">
                           <div class="row">
                              <div class="form-group">
                                 <div class="col-xs-12">
                                    <div class="form-group">
                                       <span class="input-group">New Password</span>
                                       <input type="password" name="new_password" id="new_password" class="form-control newPassword" style="padding: 10px;" required>
                                    </div>
                                    <label for="new_password" class="error" style="float: right; margin-top: 5px; font-weight: normal; color: #E5691C;"></label>
                                 </div>
                              </div>
                           </div>
                           <div class="row" style="margin-top: 3px;">
                              <div class="form-group">
                                 <div class="col-xs-12">
                                    <div class="form-group">
                                       <span class="input-group">Confirm Password</span>
                                       <input type="password" name="confirm_password" class="form-control" style="padding: 10px;" required>
                                    </div>
                                    <label for="confirm_password" class="error" style="float: right; margin-top: 5px; font-weight: normal; color: #E5691C;"></label>
                                 </div>
                              </div>
                           </div>
                           <div class="row" style="margin-top: 3px;">
                              <div class="col-md-12 center">
                                 <input type="submit" class="btn btn-main-color" value="Reset Password" style="background-color: #D7E3EC; border-color: #D7E3EC; color: #404D57;">
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <script>
		jQuery(document).ready(function() {
			$("#contactForm").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				onkeyup: false,
			    rules: {
            new_password: {
	                    minlength: 5,
	                    required: true
	                },
            confirm_password: {
	                    minlength: 5,
	                    required: true,
                      equalTo : "#new_password"
	                   }
                },
			    messages: {
            new_password:{
			        required: "Enter a password",
			      },
               confirm_password:{
			        required: "Enter a password again",
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
   <script src="<?php echo base_url(); ?>assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
   <!--<![endif]-->
   <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/blockUI/jquery.blockUI.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/less/less-1.5.0.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/login.js"></script>