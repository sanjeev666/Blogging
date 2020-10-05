<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Images</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/croppie.css">
  <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/croppie.js"></script>
  <style>
  .modal-backdrop {
    background-color: white;
  }
  .card .card-content{
    padding: 24px;
    border-radius: 0 0 2px 2px;
  }
 .card-title{
    margin: 1% 1% 1% 1%;
  }
  #createUpload{
    margin:0% 30% 0% 30%;
  }

  </style>
</head>
<body>
  <div class="row"  >
    <div class="col s12">
      <div id="html-validations" class="card card-tabs" style="margin: 5% 2% 2% 2%;">
        <div class="card-content" >
          <div id="view-validations">
            <form method="post" id="createUpload" enctype="multipart/form-data" action="<?php echo base_url() . 'image/pic'; ?>" >
              <div class="row">
                <div class="input-field col s12">
                  <h4>Add Image</h4>
                </div><br>
                <div class="input-field col s12">
                <input type="hidden" name="file" id="file" value="" />
                  <labelfor="title">Image Category:</label>
                    <select class ="form-control" name="img_category" id="list" required>
                      <div class="errorTxt1"></div>
                      <option value="#" selected>Please Select Any One</option>
                      <option value="Technology">Technology</option>
                      <option value="Health">Health</option>
                      <option value="Food">Food</option>
                      <option value="Entertainment">Entertainment</option>
                      <option value="Fashion">Fashion</option>
                    </select>
                  <div class="errorTxt1"></div>
                </div><br>
                <div class="input-field col s12">
                  <labelfor="title">Select Image:</label>
                  <input type="file" name="upload_image" id="upload_image" accept= "image/*" data-error=".errorTxt1" required/>
                  <div class="errorTxt1"></div>
                </div><br>
              </div>
              <div class="input-field col s12">
                  <button class="btn btn-success" type="submit" style="margin-left:-1%;">Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
$(document).ready(function(){
   $("#list").on('click', function () {
        var img = $("#list").val();

   });

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    // $("#upload_image").val('');
    $('#uploadimageModal').modal('show');

  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      console.log(response);
       $("#file").val(response);

      $.ajax({
        url:'<?php echo site_url('image/createUpload'); ?>',
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
          // alert("file uploaded successfully");
        }
      });
    })
  });
});
$(document).ready(function () {
    $('#createupload').validate({ // initialize the plugin
        rules: {
            upload: {
                required: true,
                // message: select valid image
                  }
               }
      });
  });
</script>
</html>

<div id="uploadimageModal" class="modal" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content" style="margin-top:12%;" >
      <div class="modal-body" >
        <div class="row">
          <div class="col-md-12 text-center" >
            <div id="image_demo" style="width:350px ;margin-top:30px;margin: auto;text-align: center;display: block;"></div>
          </div>
        </div>
      </div>
      <div style="margin:0% 0% 2% 6%;">
        <button class="btn btn-success crop_image" style="margin-right:50%;">
              Crop & Upload
              </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

