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
 

  </style>
</head>
<body>
  <div class="container">
  
  <div class="form-group row ">
       <label for="image category" class="col-sm-2 col-form-label text-right">
       <h4>
       Add Image
       </h4>
       </label>
  </div>
  <div class="form-group row">
       <label for="image category" class="col-sm-2 col-form-label text-right">Image Category :</label>
      <div class="col-sm-10">
        <select class =" form-control col-md-8" name="img_category" id="list" style="width:60%;" required>
                    <option value="0" selected>Please Select Any One</option>
                          <!-- from admin given category -->
                      <?php foreach ($dropList as $key => $value) {?>
                      <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                    <?php }?>
        </select>
      </div>
      <span class="selectError"></span>
  </div>
  <div class="form-group row">
    <label for="select image" class="col-sm-2 col-form-label text-right">Select Image :</label>
    <div class="col-sm-10">
    <input type="file" name="upload_image" id="upload_image" accept= "image/*" data-error=".errorTxt1" required/>
    <input type="hidden" name="" id="baseUrl" value="<?php echo base_url(); ?>">
     <div class="errorTxt1"></div>
    </div>
  </div>
  </div>
</body>

<script>
$(document).ready(function(){
  // categoryId = '';
  var candition = false;
   $('select').on('change', function() {
    var categoryId =  $(this).find(":selected").val();
    if (categoryId != '') {
      $("#cropId").val(categoryId);
      candition = true;

    }

});

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:320,
      height:150,
      type:'square' //circle
    },
    boundary:{
      width:400,
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
    if (candition == true) {
      
      $('#uploadimageModal').modal('show');
      
    }
    else
    {
      $(".selectError").html('<div class="text-danger col-sm-offset-2 text-left">please select category</div>');
    }

  });

  $('.crop_image').click(function(event){
    var cat_val = $("#cropId").val();
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
       $("#file").val(response);
      $.ajax({
        url:'<?php echo site_url('image/createUpload'); ?>',
        type: "POST",
        data:{"image": response,
              "img_category":cat_val
        },
        dataType: "json",
        success:function(data)
        {
          if(data.errors == "0")
          {
          $('#uploadimageModal').modal('hide');
            $("body").children().hide();
            $('body').html('<div class="alert alert-success text-center text-danger text-capitalize">'+data.status+'</div>');
            // window.location.href = $(document).find("#baseUrl").val();
            window.top.location.href = '<?php echo site_url('image/upload'); ?>';
          }
          // alert("file uploaded successfully");
        }
      });
    })
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
          <input type="hidden" name="crop" id="cropId" >
            <div id="image_demo" style="width:350px;margin-top:30px;margin: auto;text-align: center;display: block;"></div>
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

