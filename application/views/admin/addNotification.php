
  <div class="row" style="margin-top:50px; min-height:100%;">
    <div class="col s12">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title">Add Broadcast</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="addNotification" enctype="multipart/form-data" action="<?php echo base_url() . 'users/addNotification'; ?>" >
              <div class="row">
                <div class="input-field col s12">
                  <label>Title:</label>
                  <input id="title" name="title" type="text" >
                  <div class="error"></div>
                </div>
                <div class="input-field col s12">
                    <textarea id="description" name="description" class="materialize-textarea"></textarea>
                    <label>Description:</label>
                </div>
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light green darken-1" type="submit" >Submit
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'users/notification'; ?>" class="btn waves-effect waves-light red accent-2">
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
			$("#addNotification").validate({
				onfocusout: function(e) {
					this.element(e);						  
				},
				// onkeyup: true,
			    rules: {
                    title: { 
                      minlength: 3,
                      required: true,
                  },
                  description: { 
                        minlength: 3,
                        required: true,
                    },
                },
			    messages: {
                    title:{
                    required: "Enter a Title.",
                    },
                    description:{
                    required: "Write Some Description.",
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
</body>
</html>
