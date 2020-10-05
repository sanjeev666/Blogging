<style>
.card .card-content {
  background-color: #f9f9f9;
}
.card-panel{
  background-color: #f9f9f9 ;
  -webkit-box-shadow:none;
  box-shadow:none;
}
.follow_button{
  font-weight:400;
  border:1px solid black;
  background:white;
  border-radius:6px;
  vertical-align: super;
  border:1px solid rgba(2, 158, 116, 1);
  color:rgba(2, 158, 116, 1);
  text-transform: capitalize;
  margin-left: 8px;
  
}

.follow_button:active,.follow_button:hover,.follow_button:focus{
  background:white;
  border:1px solid rgba(2, 158, 116, 1);
  color:rgba(2, 158, 116, 1);
  text-transform: capitalize;
}


.following_label{
  background:rgba(2, 158, 116, 1) !important;
  border:1px solid black !important;
  color:white !important;
  font-weight:500 !important;

}

.count_follow{
    width: 48%;
    margin: 0 auto;
    font-size: 14px;
    color: black;
    padding-top: 10px;
}

.follower_cout{
  margin-left:10px;
}

   .indicat{
  border-bottom: 2px  solid black !important;
}
.likeBtn
{
    cursor: pointer;
}

.grid {
    width: 100%;
}


#blogImg
{
    width:100%;
    height:auto;
}
.tabs {
    overflow-x: inherit !important;
    overflow-y: inherit !important;
    }

  li.col.md3.activetab {
    background: #e5e5e5;
    border-bottom: 2px solid black;
    height: auto;
}
.userdata{
  font-weight:bold; 
  color:black;
  line-height: 2;
  margin: 0%;
}
.about{
  margin-top: -8%!important;
  max-width:450px;
  word-wrap:break-word;
}
#profilePic{
  display: block;
  width: 125px;
  height: 125px;
  border-radius: 50%;
  border: 2px solid black;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin-left: 50%;
  margin-top: -6%;
}
.profilename{
  font-size: 36px;
  font-weight:bold; 
  margin:0;
  color: black;
}
@media only screen and (max-width: 767px) and (min-width: 321px){
  .z-depth-0{
    background-color: #f9f9f9;
  }
  button, input, optgroup, select, textarea{
    font-size: 86%;
  }
  .count_follow{
    width: 98%;
    font-size: 12px;;
  }
  .row .col.s9 {
    margin-top: 5%;
    width: 100%;
  }
  .about{
    margin-top: -20%!important;
    max-width:200px;
    word-wrap:break-word;
  }
  .profilename{
    font-size:15px !important; 
    font-size: 36px;
    font-weight:bold; 
    margin:0;
    color: black;

  }
  #profilePic{
  display: block;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 2px solid black;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin-left: 73%;
  margin-top: -10%;
}
.card .card-content {
  padding:0%;
}
a{
  font-size: 12px;
}
.card-panel{
    margin-left: 15%;
  }
}
@media only screen and (max-width: 320px) and (min-width: 0px){
  .z-depth-0{
    background-color: #f9f9f9;
  }
  button, input, optgroup, select, textarea{
    font-size: 72%;
  }
  .count_follow{
    width: 98%;
    font-size: 10px;;
  }
  .row .col.s9 {
    margin-top: 5%;
    width: 100%;
  }
  .about{
    margin-top: -24%!important;
    max-width:200px;
    word-wrap:break-word;
    line-height:1.5;
  }
  .profilename{
    font-size:15px !important; 
    font-weight:bold; 
    margin:0;
    color: black;

  }
  #profilePic{
  display: block;
  width: 90px;
  height: 90px;
  border-radius: 50%;
  border: 2px solid black;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin-left: 73%;
  margin-top: -10%;
}
.card .card-content {
  padding:0%;
}
a{
  font-size: 10px;
}
.card-panel{
    margin-left: 15%;
  }
}
</style>


<script>
    
 var addDataAttribute = "<?php if (isset($this->session->userdata['id'])) {echo '';} else {echo 'slide-out-right';}?>";
var user_id = "<?php echo $usersBlogProfile['id']; ?>";
// var category = ";
var default_img = BASE_URL+'assets/upload/default.png';
var default_image ='assets/images/avatar/default-u.jpg';
var folder_For_img    = "assets/images/users/";

// working
var flag = 0;
function getblogs(search=''){
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>blog/scrollerForUserBlog",
        data: {
            'offset':flag,
            'limit':20,
            'search':"",
            'category':search,
            'user_id':user_id 
        },
        beforeSend: function(){
            // loader(); 
                            },
      complete: function(){
            // $.unblockUI(); 
   },
        dataType: "json",
      
        success: function (response) {

            if(response.length <= 0 ){
                
            }
            var html ='';
            $.each( response, function( index, value ){
                var thumbColor = '';
                if(value.count > 0){
                    thumbColor = 'cyan-text';
                }
                image = default_img;
                if(value.url.length > 0){
                    image = BASE_URL +'assets/upload/'+ value.url;
                }
                if(value.profile_img.length > 0 || value.profile_img != '' ){
                    profile_img = BASE_URL + folder_For_img + value.profile_img;
                }
                else
                {
                profile_img = BASE_URL + default_image;

                }

                html +='<div>'+
                            '<div class="grid-item col s12 m6 l12 ">'+
                                '<div class="">'+
                                    '<div class="card-panel border-radius-6 mt-10 ">'+
                                        '<a href="<?php echo base_url(); ?>blog/detail/'+value.id+'">'+
                                            '<img id="blogImg" class="responsive-img border-radius-8  image-n-margin" src="'+ image +'" alt="" >'+
                                        '</a>'+
                                        '<a href='+BASE_URL+'"/blog/detail"></a>'+
                                        '<h6 class="deep-purple-text text-darken-3 mt-5">'+
                                        '<a href='+BASE_URL+'"/blog/detail"></a>'+
                                        '<a href="#">'+value.cat_name+'</a></h6>'+
                                        '<span id="distription">'+
                                            '<p class="truncateTitle">'+value.title+'</p>'+
                                            '<p class="details">'+value.detail+'</p>'+
                                            '<p style="font-size:12px">'+taskDate(Date.parse(value.date))+'</p>'+
                                        '</span>'+
                                        '<div class="row " style="margin-bottom:0px;">'+
                                            '<div class="col s5 mt-1 ">'+
                                                '<a href='+BASE_URL+value.full_name+'><img src="'+profile_img+'" alt="image" style = "width:37.64px; height:37.64px;" class="circle mr-3  vertical-text-middle"></a>'+
                                                '<a href='+BASE_URL+value.full_name+'><span class="pt-2">'+value.name+'</span></a>'+
                                                
                                            '</div>'+
                                            '<div class="col s7 mt-3 right-align social-icon">'+
                                                '<span data-target="'+addDataAttribute+'" class="material-icons sidenav-trigger thumb likeBtn '+thumbColor+'" data-blogid="'+value.id+'">thumb_up</span> <span class="ml-3 vertical-align-top likeCount" data-blogid="'+value.id+'">'+value.likes+'</span>'+
                                                // <?php if ($this->session->id) {?>
                                                // '<span class="material-icons ml-10 commentBtn" data-blogid="'+value.id+'">chat_bubble_outline</span><span class="ml-3 vertical-align-top commentCount" data-blogid="'+value.id+'">'+value.comment_count+'</span>'+
                                                // <?php }?>
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                // $('.grid').append(html);
              
            });
            $('.grid').html(html);
        }
    });
}

        // defoult page containe
    $("#horizontal-nav").show();
        $('.grid').html('');
        getblogs();
</script>
<body>

<div id="main" style="min-height:550px;">
      <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row" style="margin-top:2%;">
              <div class="col s12 m6 l6"  style="margin-left:-1%;">
                <!-- <h5 class="breadcrumbs-title" style="color:black;font-weight:bold;font-size:24px;" >User Profile Page</h5> -->
                
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <input type="hidden" name="follower_id" id="follower_id" value = "<?php echo $usersBlogProfile['id']; ?>">
          <input type="hidden" name="following_id" id="following_id" value = "<?php echo $this->session->id  ?>">
          <div class="container">
          <?php if ($usersBlogProfile['profile_img'] == '') {?>
            <div class="row user-profile">
              <div class="col s3">
                <!-- <input type="hidden" data-userid="<?php $usersBlogProfile['user_id'];?>"></input>
                <img class="responsive-img" style="margin:3% 0% 0% 3%; display:block; width:75%" alt="" src="<?php echo base_url(); ?>/assets/images/avatar/default-u.jpg"> -->
              </div>
              <div class="col s9">
                <span class="profilename"><?php echo ucfirst($usersBlogProfile['first_name']);?> <?php echo ucfirst($usersBlogProfile['last_name']) ;?></span>
                  <?php if($usersBlogProfile['id'] != $this->session->id): ?>
                <button class="likeBtn follow_button <?php echo  (!empty($is_follow))? 'following_label':''; ?>"><?php echo  (!empty($is_follow))? 'Following':'Follow'; ?></button>
              <?php endif; ?>
                <img class="responsive-img" id="profilePic" alt="" src="<?php echo base_url();?>/assets/images/avatar/default-u.jpg">
                <!-- <p class="userdata">First Name: <?php echo ucfirst($usersBlogProfile['first_name']) ;?></p>
                <p class="userdata">Last Name: <?php echo ucfirst($usersBlogProfile['last_name']) ;?></p> -->
                <p class="userdata">Blogging member since <?php echo date("F, Y", strtotime($usersBlogProfile['added_on'])); ?> .</p>
                <a class="link" href="<?php echo base_url().'users/registration?id='.$usersBlogProfile['referralLlink'] ;?>" target="blank">Referral Llink</a>
              </div>
            </div>
            <?php } else {?>
            <div class="row user-profile">
              <div class="col s3">
              <!-- <input type="hidden" data-userid="<?php $usersBlogProfile['user_id'];?>"></input>
              <img class="responsive-img" style="margin:3% 0% 0% 3%; display:block; width:75%" alt="" src="<?php echo base_url().'assets/images/users/'.$usersBlogProfile['profile_img'];?>"> -->
              </div>

              <div class="col s9">
                
              <span class="profilename"><?php echo ucfirst($usersBlogProfile['first_name']);?> <?php echo ucfirst($usersBlogProfile['last_name']) ;?></span>

              <?php if($usersBlogProfile['id'] != $this->session->id): ?>
              <button class="likeBtn follow_button <?php echo  (!empty($is_follow))? 'following_label':''; ?>"><?php echo  (!empty($is_follow))? 'Following':'Follow'; ?></button>
            <?php endif; ?>
              
              <img class="responsive-img" id="profilePic" alt="" src="<?php echo base_url().'assets/images/users/'.$usersBlogProfile['profile_img'];?>">
                <p class="userdata about"><?php echo ucfirst($usersBlogProfile['about_me']) ;?></p>
                <!-- <p class="userdata">Last Name: <?php echo ucfirst($usersBlogProfile['last_name']) ;?></p> -->
                <p class="userdata join">Blogging member since <?php echo date("F, Y", strtotime($usersBlogProfile['added_on'])); ?> .</p>
                <a href="<?php echo base_url().'users/registration?id='.$usersBlogProfile['referralLlink'] ;?>" target="blank">Referral Llink</a>


              </div>

               
            </div>
            <?php }?>
              <?php if(!empty($count)): ?>
            <div class="count_follow"> 
               <span class="following_count">
               <?php echo $count['count_following']; ?>
               </span>  Following
               <span class="follower_cout">
                  <?php echo $count['count_follower']; ?>
               </span>  Followers
            </div>
              <?php endif; ?>
          
            <div class="section" id="user-profile">
              <div class="row" style="margin:auto;display:block;">
                <!-- User Profile Feed -->
                <div class="col s12 m4 l3 user-section-negative-margin">
                  <div class="row">
                    <div class="col s12 center-align">
                      
                      <br>
                    </div>
                  </div>
                </div>
                <!-- User Post Feed -->
                <div class="col s12 m8 l7">
                  <div class="row">
                    <div class="card user-card-negative-margin z-depth-0" id="feed">
                      <div class="card-content card-border-gray" >
                          <!-- <h5 style="font-weight:bold; color:black; text-align:center; "><?php echo ucfirst($usersBlogProfile['username']) ;?></h5> -->
                      <!-- navigation bar -->
                        <div class="nav-content row" style="color:black;font-weight:bold;font-size:18px; margin:0px auto;display:block;">
                           <ul class="tabs5 tabs-transparent5 row">
                           <li class="tab5 col md3 activetab" data-category="0"><span id="0">All</span></li>
                           <li class="tab5 col md3" data-category="1"><span id="1">Technology</span></li>
                           <li class="tab5 col md3" data-category="2"><span id="2">Food</span></li>
                           <li class="tab5 col md3" data-category="3"><span id="3">Entertainment</span></li>
                           <li class="tab5 col md3" data-category="4"><span id="4">Fashion</span></li>
                           <li class="tab5 col md3" data-category="5"><span id="5">Health</span></li>
                           </ul>
                        </div>
                        <div class="row ">
                        <div class="grid row" style="display:block;width:100%; margin-left:-7%;" >
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Today Highlight -->
      </div>
    </div>
   
  
</body>

<script>
$(document).ready(function () {
    $(document).on('click', '.likeBtn', function ()
    {
       var blog_id =$(this).data('blogid');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url(); ?>blog/like',
            data: {blog_id:blog_id},
            dataType: 'json',
            error:function()
            {
                console.log("something wrong");
            },
            success: function (response) {
                if(response.errcode == 0){
                    $('.likeCount').data('myval',20);
                    $(document).find(".likeCount[data-blogid='"+blog_id+"']").html(response.result.count);
                    if(response.result.like == 1)
                    {
                        $(document).find(".likeBtn[data-blogid='"+blog_id+"']").addClass("cyan-text");
                    }
                    else
                    {
                        $(document).find(".likeBtn[data-blogid='"+blog_id+"']").removeClass("cyan-text");
                    }
                }else{
                    console.log('failed');
                }
            }
        });
    });
   
});




$(document).ready(function() {
    $(".tab5").click(function() {
      var category  = $(this).data("category");
      getblogs(category);
      if ( $(this).hasClass('activetab') ) {
        $(this).removeClass('activetab');
    } else {
        $('.tab5').removeClass('activetab');
        $(this).addClass('activetab');  
    }
      
    });
    
});




</script>
 
<script>

function taskDate(dateMilli) {
    var d = (new Date(dateMilli) + '').split(' ');
    d[2] = d[2] + ',';

    return [ d[1], d[2], d[3]].join(' ');
}


</script>

<?php if(isset($this->session->id)): ?>
<script>

$(document).ready(function () {
  $(document).on('click','.follow_button', function () {
       var follower_id = $(document).find('#follower_id').val();
       var following_id = $(document).find('#following_id').val();
      //  alert(follower_id+'  '+ following_id);
       var data ={
        follower_id:follower_id,
        following_id:following_id
       }
       $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>Users/followers",
         data: data,
         dataType: "json",
         success: function (response) {
            console.log(response);
              if(response.error == '0')
              {
                $(document).find('.follow_button').text(response.msg);
                $(document).find('.follower_cout').text(response.result);
                
              }

              if(response.msg == 'following')
              {
                $(document).find('.follow_button').addClass('following_label');
              }
              else
              {
                $(document).find('.follow_button').removeClass('following_label');
              }
         }
       });
      
  });


});

</script>
<?php endif; ?>