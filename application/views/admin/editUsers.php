<div class="row" style="margin-top:50px;">
    <div class="col s12" >
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title"> Update User Details</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="editUser" enctype="multipart/form-data" action="<?php echo base_url() . 'users/editusers' ?>" >
              <div class="row">
			  	        <input id="id" name="id" type="hidden" value="<?php echo $member_details['id']; ?>">

                <div class="input-field col s12">
                  <labelfor="title">Username:</label>
                  <input id="username" name="username" type="text"  value="<?php echo $member_details['username']; ?>">
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <labelfor="title">First Name:</label>
                  <input id="first_name" name="first_name" type="text"  value="<?php echo $member_details['first_name']; ?>">
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <labelfor="title">Last Name:</label>
                  <input id="last_name" name="last_name" type="text"  value="<?php echo $member_details['last_name']; ?>">
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <labelfor="title">Email:</label>
                  <input id="email" name="email" type="text"  value="<?php echo $member_details['email']; ?>">
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <labelfor="title">Phone No.:</label>
                  <input id="phone_no" name="phone_no" type="number"  value="<?php echo $member_details['phone_no']; ?>">
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light cyan" type="submit" >Update
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'users/users'; ?>" class=" btn waves-effect waves-light red accent-2">
                        Back
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
			$("#editUser").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				// onkeyup: true,
			    rules: {
					username: {
			                minlength: 3,
                      required: true,
                      remote : {
                      url: BASE_URL + "users/checkUserEditUsername",
                      type: "POST",
                      dataType: "json",
                      data:{
                            'csrf_test_name' : 'csrf_cookie_name',
                            'id' : function() {
                                return $(document).find('#id').val();
                            }
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
                      url: BASE_URL +"users/checkUserEditEmail",
                      type: "POST",
                      dataType: "json",
                      data:{
                            'csrf_test_name' :'csrf_cookie_name',
                            'id' : function() {
                                return $(document).find('#id').val();
                            }
                        }
                      }
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
			        required: "Enter a first name"
			      },
            last_name:{
			        required: "Enter a last name"
			      },
            email:{
              required: "Enter a email",
              remote:"Email already exists"
			      },
            phone_no:{
			        required: "Enter a mobile number"
			      }
			    },
				errorPlacement: function(error, element) {
					var placement = $(element).data('error');
					if (placement) {
					  $(placement).append(error)
					} else {
						error.insertAfter(element);
					}
			    },
			});
		});
	</script>



