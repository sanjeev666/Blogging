<div class="row" style="min-height:100%; margin-bottom:7%;">
    <div class="col s12 margin-table" >
      <div id="html-validations" class="card card-tabs" style="padding-bottom:1%;">
        <div class="card-content">
        <?php if ($this->session->flashdata("success")): ?>
                <div class="alert alert-success center-align">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                </div>
              <?php elseif ($this->session->flashdata("error")): ?>
                <div class="alert alert-danger center-align">
                  <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                </div>
              <?php endif;?>
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title pl-1">Edit Bank Details</h4></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="createUser"  action="<?php echo base_url() . 'users/EditAcDetails'; ?>" >
                <div class="row margin">
                <input id="id" name="id" type="hidden" value="<?php echo $this->session->userdata['id']; ?>">
                  <div class="input-field col s12">
                    <!-- <i class="material-icons prefix pt-2">person_outline</i> -->
                    <input id="holdername" class="form-control" name="holdername" type="text" value="<?php echo $ac_details['ac_holder_name']; ?>">
                    <label for="holdername" class="center-align">Account Holder Name</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <!-- <i class="material-icons prefix pt-2">mail_outline</i> -->
                    <input id="acnumber" type="text" name="acnumber" value="<?php echo $ac_details['ac_no']; ?>">
                    <label for="acnumber">Account Number</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <!-- <i class="material-icons prefix pt-2">mail_outline</i> -->
                    <input id="acnumberAgain" type="text" name="acnumberAgain" value="<?php echo $ac_details['ac_no']; ?>">
                    <label for="acnumberAgain">Re-Enter Account Number</label>
                  </div>
                </div>
                <div class="row margin">
                  <div class="input-field col s12">
                    <!-- <i class="material-icons prefix pt-2">lock_outline</i> -->
                    <input id="ifsc" type="text" name="ifsc" value="<?php echo $ac_details['ifsc_code']; ?>">
                    <label for="ifsc">IFSC Code</label>
                  </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                      <button class="btn waves-effect waves-light cyan" type="submit">Update
                          <i class="material-icons right">send</i>
                      </button>
                      <a href="<?php echo base_url() . 'users/blogList'; ?>" class=" btn waves-effect waves-light red accent-2">
                      Back
                        <i class="material-icons left">arrow_back</i>
                      </a>
                    </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  

<script>
    jQuery(document).ready(function() {
			$("#createUser").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				onkeyup: false,
			    rules: {
            holdername: {
	                    minlength: 2,
	                    required: true
	                },
                  acnumber: {
              minlength: 5,
              number: true,
              required: true
                  },

                  acnumberAgain: {
                    equalTo: "#acnumber"
                  },

                  ifsc: {
                  required: true
                  }
			         },
			    messages: {
			      username:{
			        holdername: "Enter a holdername",
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


