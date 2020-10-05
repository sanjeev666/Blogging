
<div class="row" style="margin-top:50px;">
    <div class="col s12" style="height:550px">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title"> Update Images</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>

          <div id="view-validations">
            <form method="post" id="editupload" enctype="multipart/form-data" action="<?php echo base_url() . 'admin/editUpload' ?>" >
              <div class="row">
			  	<input id="id" name="id" type="hidden" value="<?php echo $images_details['id']; ?>">

                <div class="input-field col s12">
                  <labelfor="title">Image Path:</label>
                  <input id="title" name="upload" type="text" data-error=".errorTxt1" value="<?php echo $images_details['path']; ?>">
                  <div class="errorTxt1"></div>
                </div>

                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light cyan" type="submit" >Update
                      <i class="material-icons right">send</i>
                  </button>
                  <a href="<?php echo base_url() . 'admin/upload'; ?>" class="btn waves-effect waves-light red accent-2">
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
$(document).ready(function () {
    $('#editupload').validate({ // initialize the plugin
        rules: {
            upload: {
                required: true,

                  },
            Editupload: {
                required: true,

            },
               }
      });
  });
</script>


