<script src="<?php echo base_url(); ?>assets/tinymce/jquery.tinymce.min.js" referrerpolicy="origin"></script>
    <script src="<?php echo base_url(); ?>assets/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
     <script type="text/javascript">
    tinymce.init({
    selector: "div.tinymce",
    plugins: [ 'quickbars','link','media','template','autoresize' ],
    autoresize_width: 500,
    imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
    default_link_target: "_blank",
    quickbars_selection_toolbar: 'bold italic | link h2 h3 blockquote|alignleft|aligncenter|alignjustify||alignright| editimage imageoptions',
    quickbars_insert_toolbar: 'quickimage media '
});
</script>
<style>
.tinymce{
  /* width:80%; */
  margin:0 auto;
  height:500px;
  position:static;
}
.green{
  border:4px solid green;
}
.red{
  border:4px solid red;
}
@media only screen and (max-width: 320px) and (min-width:0px){
  select{
    width:219px !important;
    height:42px !important; 
  }
}
@media only screen and (max-width: 767px) and (min-width:321px){
  select{
    width:219px !important;
    height:42px !important; 
  }
}

</style>
<div class="row margin-table" >
    <div class="col s12 margin-table">
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10">
                <h4 class="card-title">Edit story</h4>
              </div>
              <div class="col s12 m6 l2">
              </div>
            </div>
          </div>
          <div id="view-validations">
          <?php $attributes = array('id' => 'formValidate', 'class' => 'formValidate');
            echo form_open_multipart("users/blogEdit/$id", $attributes);?>
           <div>
            <!-- <input type="hidden" name="user_id" value=1> -->
          </div>
              <div class="row">
                <div class="input-field col s12">
                  <labelfor="title">Title*</label>
                  <input id="title" name="title" type="text"  value="<?php echo $row['title']; ?>">
                  <div class="error"></div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <div class="input-field col s12">
                  <label>Short Description*</label>
                  <input name="detail" type="text" value="<?php echo $row['detail']; ?>">
                  <div class="error"></div>
                </div>
            <!-- this is url  -->
                <div>
                <div class="input-field col s7">
                  <label>URL </label>
                  <input  aria-required="true" type="text" id="curl0"  name="url" value="<?php echo base_url().'assets/upload/'.$row['url']; ?>">
                  <div class="error"></div>
                </div>
                <!-- browse -->
                <div class="input-field col s5">
                  <a class="waves-effect waves-light btn modal-trigger waves-light cyan" href="#modal1" id="browse">browse</a>
                </div>
                    <!-- tiny box -->
                     <div class="input-field col  s12">
                     <label for="">Content</label>
                     </div>
                   <div class="input-field col s12">
                      <div class="tinymce">
                      <?php echo $row['content']; ?>
                      </div>
                   </div>
                <!-- <img src="image" ?>"> -->
                        <div class="input-field col s3">
                            <select class=" browser-default" id="crole" name="crole">
                            <option value="" disabled="" >Choose your category</option>
                              <?php foreach ($categoryDrop as $key => $value) {?>
                                <option value="<?php echo $value['id']; ?>" <?php if ($row['category_id'] == $value['id']) {echo 'selected';} else {echo 'Choose your category';}?> ><?php echo $value['name']; ?></option>
                              <?php }?>
                            </select>
                        </div>
                <div class="input-field col s12 row">
                    <div class=" col s6">
                    <label>
                      <input name="blog_type" type="radio" value="PUBLIC" <?php if ($row['blog_type'] == 'PUBLIC') {echo 'checked';}?>/>
                        <span>Public</span>
                    </label>
                    </div>
                    <div class="col s6">
                    <label>
                      <input name="blog_type" type="radio" value="PRIVATE" <?php if ($row['blog_type'] == 'PRIVATE') {echo 'checked';}?>/>
                     
                        <span>Private</span>
                    </label>
                    </div>
                </div>
                <input class="file-path validate avtar_data" type="hidden" value="">
                <input type="hidden" name="" id="base_url" value="<?php echo base_url(); ?>">
                  <div class="input-field col s12">
                  <button class="btn waves-effect waves-light right submit" id="submit" type="submit">Submit
                    <i class="material-icons right">send</i>
                  </button>
                  <button class="btn waves-effect waves-light submit right mr-2" id="submit" style="background-color: red;" name="is_publish" value="DRAFT" type="submit">Draft
                    <i class="material-icons right">drafts</i>
                  </button>
                </div>
                <!-- modal part -->
                <div id="modal1" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <div class="row">
                      <div class="col s2"><h4>Categories</h4></div>
                      <div class="col right s3">
                        <select class="browser-default selectCategory">
                          <option value="0">All</option>
                          <?php foreach ($categoryDrop as $key => $value) {?>
                          <option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?></option>
                         <?php }?>
                        </select>
                      </div>
                      </div>
                        <div id="main">
                          <div class="row" id="imageGallery">

                          </div>
                       </div>
                    </div>
                  <div class="modal-footer">
                    <div  id="submitImg" class="btn ">Submit</div>
                    <div class="modal-close btn " id="modal_cancel">Cancel</div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
     </div>
  </div>
</div>
</div>
<script>
$(document).ready(function () {
  var SITE = $(document).find('#base_url').val();
   var click = 0;
   var condition = true;
   var toggle    = [];
   var selectedImg = [];

   $(document).on('click','#imgclick', function()
    {
     var cat_id = $(this).data('cat');
     var cat_img = $(this).attr('src');
     
     $(document).on('click','#submitImg', function()
      {
           $("#curl0").val(cat_img);
     });
  });

  $("#submitImg").on('click', function () {
      for(var i = 0; i < selectedImg.length;i++)
      {
        var select =  selectedImg[i];
        var img =$("#"+select).attr("src");
        $("#curl0").val(img);
      }
      $("#submitImg").addClass("modal-close");
  });

  function  category(categoryId)
  {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>users/category",
      data: {category:categoryId},
      dataType: "json",
      success: function (response) {
         $.each(response, function (indexInArray, value) {
           var image = SITE +'assets/upload/'+ value.path;
                       $("#imageGallery").append("<div class='col l4'><img src="+image+" class='responsive-img border-radius-8 z-depth-1 mt-2' data-cat="+value.img_category+" id='imgclick' ></div>");
                     });
      }
    });

  }

  $("#browse").on('click', function () {
    $("#imageGallery").html('')
    category(0);

  });
  $(".selectCategory").on('change', function () {
    categoryId = $(this).val();
    $("#imageGallery").empty();
    $("#imageGallery").html('')
    category(categoryId);

  });

  // validate part
$("#formValidate").validate({
    rules: {
      title: {
        required: true
      },
      detail: {
        required: true
      },
      password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      curl0: {
        required: true,

      },
      crole:"required",
      ccomment: {
        required: true,
        minlength: 15
      },
      cgender:"required",
      cagree:"required",
      },
      //For custom messages
      messages: {
        title:{
        required: "Enter a title",

      },
        detail:{
        required: "Enter a detail",

      },
      curl: "Enter your website",
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