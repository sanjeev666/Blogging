  <div class="row" >
    <div class="col s12" >
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title">Add Users</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="createUser" enctype="multipart/form-data" action="<?php echo base_url() . 'users/createusers'; ?>" >
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="username" class="form-control" name="username" type="text">
                    <label for="username" class="center-align">Username</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="first_name" class="form-control" name="first_name" type="text">
                    <label for="first_name" class="center-align">First Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="last_name" type="text" name="last_name">
                    <label for="last_name">Last Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="email" type="email" name="email">
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="confirm_password" type="password" name="confirm_password">
                    <label for="confirm_password">Confirm Password</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <input id="phone_no" type="number" name="phone_no">
                    <label for="phone_no">Phone No.</label>
                  </div>
                </div>
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light green darken-1" type="submit" >Submit
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'users/users'; ?>" class="btn waves-effect waves-light red accent-2">
                        Cancel
                      <i class="material-icons right">send</i>
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
   var BASE_URL = "<?php echo base_url(); ?>";
		jQuery(document).ready(function() {
			$("#createUser").validate({
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
          confirm_password: {
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
            confirm_password:{
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


