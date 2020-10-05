
<div class="row" style="margin-top:50px;">
    <div class="col s12" style="height:550px">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title"> Update Categories</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="createCategory" enctype="multipart/form-data" action="<?php echo base_url() . 'category/editCategories' ?>" >
              <div class="row">
			  	<input id="id" name="id" type="hidden" value="<?php echo $catagory_details['id']; ?>">

                <div class="input-field col s12">
                  <labelfor="title">Category Name:</label>
                  <input id="Categoryname" name="Categoryname" type="text"  value="<?php echo $catagory_details['name']; ?>">
                  <div class="error"></div>
                </div>

                <div class="col s2">
                  <labelfor="title">isPublic:</label>
                </div>
                <div class="col s8">
                  <div class=" col s4">
                    <label>
                      <input name="isPublic" type="radio" value="TRUE" <?php if ($catagory_details['isPublic'] == 'TRUE') {echo 'checked';}?>/>
                        <span>TRUE</span>
                    </label>
                    </div>
                    <div class="col s4">
                    <label>
                      <input name="isPublic" type="radio" value="FALSE" <?php if ($catagory_details['isPublic'] == 'FALSE') {echo 'checked';}?>/>
                        <span>FALSE</span>
                    </label>
                    </div>
                </div>

                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light cyan" type="submit" >Update
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'category/categories'; ?>" class="btn waves-effect waves-light red accent-2">
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
			$("#createCategory").validate({
				onfocusout: function(e) {
					this.element(e);
				},
				// onkeyup: true,
			    rules: {
            Categoryname: {  
			                minlength: 3,
                      required: true,
                      remote : {
                      url: BASE_URL + "category/checkCategoryEditname",
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
                },
			    messages: {
			      Categoryname:{
              required: "Enter a category name.",
              remote:"Category name already exists."
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
