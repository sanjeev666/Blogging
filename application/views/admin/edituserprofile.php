<style>
#imgprofile{
  width:150px;
  height:150px;
  margin-left:45%;
}
#profilePic{
  display: inline-block;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}

</style>
<div class="row margin-table" style="margin-top:0px;">
    <div class="col s12 margin-table" >
      <div id="html-validations" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10"><h4 class="card-title"> Profile</h4></div>
              <div class="col s12 m6 l2"></div>
            </div>
          </div>
          <div id="view-validations">
            <form method="post" id="createUser" enctype="multipart/form-data" action="<?php echo base_url() . 'users/edituserprofile' ?>" >
              <div class="row">
                        <input id="id" name="id" type="hidden" value="<?php echo $member_details['id']; ?>">
                <div id="imgprofile">
                <input  name="unlinkprofile_image" type="hidden" value="<?php echo $member_details['profile_img']; ?>"/>
                <input id="image" name="image" type="hidden" />
                  <input id="profile" name="imgprofile" type="file" style = "display:none; " value="<?php echo base_url().'assets/images/users/'.$member_details['profile_img']; ?>">
                  <?php if(!empty($member_details['profile_img']) && file_exists('assets/images/users/'.$member_details['profile_img'])) {?> 
                    <img class="tooltipped" src="<?php echo base_url().'assets/images/users/'.$member_details['profile_img']; ?>" id="profilePic" alt="something went wrong" data-tooltip="click on image to change image">
                  <?php } else{?>
                    <img class="tooltipped" src="<?php echo base_url().'assets/images/avatar/default-u.jpg' ?>" id="profilePic" alt="something  wrong" data-tooltip="click on image to change image">
                  <?php }?>
                    <div class="error"></div>
                </div>
                <div class="input-field col s12">
                  <div style="text-align: center; font-weight:bold;">
                    <?php if ($this->session->flashdata("success")): ?>
                        <div class="alert alert-success">
                          <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                        </div>
                      <?php elseif ($this->session->flashdata("error")): ?>
                        <div class="alert alert-danger">
                          <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                        </div>
                      <?php endif;?>
                  </div>
                  <labelfor="title">About Me:</label>
                  <input id="about_me" name="about_me" type="text" value="<?php echo $member_details['about_me']; ?>">
                  <div class="error"></div>
                </div>
                <div class="input-field col s12">
                  <labelfor="title">Username:</label>
                  <input id="username" name="username" type="text"  value="<?php echo $member_details['username']; ?>">
                  <div class="error"></div>
                </div>
                <div class="input-field col s12">
                  <labelfor="title">Name:</label>
                  <input id="first_name" name="first_name" type="text" value="<?php echo $member_details['first_name']; ?>">
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
                  <input id="phone_no" name="phone_no" type="text"  value="<?php echo $member_details['phone_no']; ?>">
                  <div class="error"></div>
                </div>
                <div class="input-field col s12">
                  <labelfor="title">Referral Llink:</label>
                  <input  style="width:50%;" id="myLink" name="" type="text"  value="<?php echo base_url().'users/registration?id='.$member_details['referralLlink']; ?>"> 
                  <p class="btn waves-effect waves-light red accent-2" onclick="copyLink()">Copy Link</p>
                </div>
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light cyan" type="submit" >Update
                      <i class="material-icons right">send</i>
                  </button>
                  <?php if($this->session->user_type == 'USER'){?>
                  <a href="<?php echo base_url() . 'users/blogList'; ?>" class=" btn waves-effect waves-light red accent-2">
                  Back
                    <i class="material-icons right">send</i>
                  </a>
                  <?php }else{?>
                    <a href="<?php echo base_url() . 'admin/dashboard'; ?>" class=" btn waves-effect waves-light red accent-2" style="margin-left:5%">
                    Back
                    <i class="material-icons left">arrow_back</i>
                  </a>
                  <?php }?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var timeout = 1500; // in miliseconds (3*1000)
    $('.alert').delay(timeout).fadeOut(300);
   var BASE_URL = "<?php echo base_url(); ?>";
        jQuery(document).ready(function() {
            $("#createUser").validate({
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
          about_me: {
                      required: true
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
                about_me: {
                    required: "Enter about you"
                },
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
    $(document).ready(function(){
          $("#profilePic").click(function(){
            // $('#profile')
            $('#profile').trigger('click');
           
          });
        });
  function showImage(profile,profilePic) {
  var fr=new FileReader();
  // when image is loaded, set the src of the image where you want to display it
  fr.onload = function(e) { profilePic.src = this.result;
    img.value = this.result;
   };
  
  
  src.addEventListener("change",function() {
    // fill fr with image data    
    fr.readAsDataURL(src.files[0]);
  //  console.log(src.files[0]);
    
  });
 
}
// console.log(a);
var src = document.getElementById("profile");
var img = document.getElementById("image");
var target = document.getElementById("profilePic");
showImage(profile,profilePic);

</script>

<script>
function copyLink() {
  var copyText = document.getElementById("myLink");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");

}
</script>