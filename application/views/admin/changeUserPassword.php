<div class="row" style="margin-top:0px;min-height:100%;">
    <div class="col s12" >
      <div id="html-validations" class="card card-tabs" style="padding-bottom:1%;">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title"> Change Password</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="changeUserPassword"  action="<?php echo base_url() . 'users/changeUserPassword' ?>" >
              <div class="row">
                <div class="input-field col s12">
                  <labelfor="title">New Password:</label>
                  <input id="new_password" type="password" name="new_password" type="text"  >
                  <div class="error"></div>
                </div>

                <div class="input-field col s12">
                  <labelfor="title">Confirm Password:</label>
                  <input id="confirm_password" type="password" name="confirm_password" type="text" >
                  <div class="error"></div>
                </div>
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light cyan" type="submit" >Update
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'users/blogList'; ?>" class=" btn waves-effect waves-light red accent-2">
                  Back
                    <i class="material-icons left">arrow_back</i>
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
			$("#changeUserPassword").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				onkeyup: true,
			    rules: {
                            new_password: {
                                        minlength: 5,
                                        required: true,
                                    },

                            confirm_password: {
                                            minlength: 5,
                                            required: true,
                                        equalTo : "#new_password"
                                        },
                      },
			    messages: {

                            new_password:{
                                    required: "Enter a new password"
                                },
                            confirm_password:{
                                    required: "Enter a confirm password"
                                },
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

