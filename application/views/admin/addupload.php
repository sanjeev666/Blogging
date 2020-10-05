<style>
label.error{
color:red;
font-family:verdana, Helvetica;
}
iframe{
  border:none;
  width:100%;
  height:500px;
}
</style>
<div class="row margin-table" style="min-height:100%;">
    <div class="col s12 margin-table">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content ">
          <div id="view-validations">
            <!-- <form method="post" id="createUpload" enctype="multipart/form-data" action="<?php echo base_url() . 'image/createUpload'; ?>" > -->
              <div class="row">
                <div class="input-field col s12">
                  <iframe src="<?php echo base_url().'image/cropper';?>" scrolling="no"></iframe>
                </div>
                <div class="input-field col s12">
                  <a href="<?php echo base_url() . 'image/upload'; ?>" class="btn waves-effect waves-light red accent-2">
                        Back
                    <i class="material-icons left">arrow_back</i>
                  </a>
                </div>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>