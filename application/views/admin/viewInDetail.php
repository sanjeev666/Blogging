<style>
.likeBtn
{
    cursor: pointer;
}

.maincontainer {
    width: 99%;
    margin-left:1%;
    /* min-height:100%; */
    justify-content: center;
    align-items: center;
    justify-content: center;
    text-align: justify;
    /* padding: 0px; */
}

#list 
{
    align-items: center;
}

.description {
    width: auto;
    color: rgba(0, 0, 0, 0.54);
    margin-left:0%;
}

.images {
    width: 98%;
    height: auto;
    margin: 0 auto;
}

.images img {
    margin: 10px auto;
    width: 100%;
    object-fit: cover;
}

.follow {
    align-items: center;
}

#follow 
{
    box-sizing: border-box;
    border-style: solid;
    border-width: 1px;
    border-radius: 4px;
    cursor: pointer;
    padding: 0px 8px;
    text-decoration: none;
    background: white;
    color: rgba(0, 0, 0, 0.54);
}

.heading,
.short_description {
    width: auto;
    margin: 0px;
    font-family: "medium-content-title-font, Georgia, Cambria, Times New Roman, Times, serif";
    font-size: 40px;
}

.heading h1 strong {
    width: auto;
    font-size: 40px;
    text-transform: capitalize;
    color: rgba(0, 0, 0, 0.84);
    font-family: "medium-content-title-font, Georgia, Cambria, Times New Roman, Times, serif";
}

.upper {
    width: 98%;
    margin: auto;
    padding-bottom: 3%;
    margin-left: 1%;
}
.lower{
    width: 98%;
    margin: auto;
    margin-left: 1%;
}
.response {
    width: 100%;
    margin: 10px auto;
    justify-content: center;
}

.comment {
    width: 100%;
    margin: 10px auto;
}

.commentReportBtn{
    cursor:pointer;
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
  margin-left: 2%;
  
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
@media only screen and (max-width: 767px) and (min-width: 321px){
    .follow_button{
        margin-left: 15%;
    }
    .title_tiny{
        font-size: 20px!important;
        text-align: justify;
        line-height: normal;
    }

    h1.title_head
    {
        line-height: 0.6;
    }
    .maincontainer {
        width: 96%;
    }
    .heading h1 strong {
        font-size: 20px;
        text-align: justify;
    }
    .upper {
        width: 99%;
        margin: auto;
        padding-bottom: 3%;
        margin-left: 1%;
    }
    .lower{
        width: 99%;
        margin: auto;
        margin-left: 1%;
    }

    .images img {
        margin: 10px auto;
        width: 99%!important;
    }
    .description{
        font-size: 15px;
        text-align: justify;
    }
    h2{
        font-size: 15px;
        text-align: justify;
        margin: 0%;
        margin-left: 30%;
    }
    button, input, optgroup, select, textarea{
        font-size: 60%;
    }
    .lower * span{
        width: 100%!important;
        height: auto !important;
        text-align: justify;
    }
    .lower * img{
        width:100% !important;
        height: auto;
    }
    .lower * h1{
        font-size:15px !important;
        text-align: justify;
    }
    .lower * h2{
        margin-left: 0%;
        text-align: justify;
    }
    .lower * span{
        font-size:12px !important;
        text-align: justify;
    }
}
@media only screen and (max-width: 320px) and (min-width: 0px){
    .follow_button{
        margin-left: 10%;
    }
    .title_tiny{
        font-size: 18px !important;
        text-align: justify;
        line-height: normal;
    }
    .maincontainer {
        width: 97%;
    }
    h1.title_head
    {
        line-height: 0.6;
    }
    .heading h1 strong {
        font-size: 18px;
        text-align: justify;
    }
    .upper {
        width: 99%;
        margin: auto;
        padding-bottom: 3%;
        margin-left: 1%;
    }
    .lower{
        width: 99%;
        margin: auto;
        margin-left: 1%;
    }

    .images img {
        margin: 10px auto;
        width: 99%!important;
    }
    .description{
        font-size: 12px;
        text-align: justify;
    }
    h2{
        font-size: 12px;
        text-align: justify;
        margin: 0%;
        margin-left: 30%;
    }
    button, input, optgroup, select, textarea{
        font-size: 56%;
    }
    .lower * span{
        width: 100%!important;
        height: auto !important;
        text-align: justify;
    }
    .lower * img{
        width:100% !important;
        height: auto;
    }
    .lower * h1{
        font-size:12px !important;
        text-align: justify;
    }
    .lower * h2{
        margin-left: 0%;
        text-align: justify;
    }
    .lower * span{
        font-size:10px !important;
        text-align: justify;
    }
}
</style>
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <section>
          <input type="hidden" name="follower_id" id="follower_id" value = "<?php echo $result['user_id']; ?>">
          <input type="hidden" name="following_id" id="following_id" value = "<?php echo $this->session->id  ?>">
        <div class="maincontainer">
            <div>
                <div class="upper row">
                    <div class="heading ">
                        <h1 class="title_head" style="font-size: 2.5rem!important;">
                            <strong class="collections-title title">
                                <?php echo $result['title']; ?>
                            </strong>
                        </h1>
                    </div>
                    <!-- end heading -->
                    <div class="short_description ">
                        <h2 class="description"><?php echo $result['detail']; ?></h2>
                        <p style="font-size:12px; font-weight:bold;"><?php echo date_format(date_create($result['date']),table_date); ?></p>
                    </div>
                    <div class="title title_tiny col s12" style="padding-left:0%;">
                        <li id="list" class="collection-item  display-flex avatar "
                            data-target="slide-out-chat">

                             <?php if ($result['profile_img'] == '') {?>
                                <span class="avatar-status avatar-online avatar-50">
                                    <a href="<?php echo base_url().$result['full_name']; ?>"> 
                                    <img src="<?php echo base_url(); ?>/assets/images/avatar/default-u.jpg" style = " width:50px; height:50px;"alt="avatar" />
                                </span>
                                <?php } else {?>
                                <span class="avatar-status avatar-online avatar-50">
                                    <a href="<?php echo base_url().$result['full_name']; ?>">
                                    <img  src="<?php echo base_url() .'assets/images/users/'. $result['profile_img']; ?>" style = " width:50px; height:50px;" alt="avatar" />
                                </span>
                                <?php }?>

                                <div class="user-content">
                                    <h2 class="line-height-0"><?php echo ucfirst($result['name']); ?> </h2>
                                </div>
                            </a>
                            <?php if($result['user_id'] != $this->session->id): ?>
                            <button class="likeBtn follow_button <?php echo  (!empty($is_follow))? 'following_label':''; ?>"><?php echo  (!empty($is_follow))? 'Following':'Follow'; ?></button>
                           <?php endif; ?>
                        </li>
                    </div>
                </div>
                <div class="images">
                    <img src="<?php echo base_url().'assets/upload/'.$result['url']; ?>" alt="" style="width: 70%; height:auto">
                    <input type="hidden" name="userId" id="session" value="<?php if (isset($_SESSION['id'])) {echo 1;} else {echo 0;}?>">

                    <input type="hidden" name="viewIndetails" id="viewIndetails" data-blogid="<?php echo $result['blog_id']; ?>" data-userid="<?php echo $result['user_id'];  ?>" 
                    data-totallike="<?php echo $likecount['count']; ?>" data-totalcomment="<?php echo $commentCount['count']; ?>">
                </div>

            </div>
            <!-- main content -->
            <div class="lower">

                <div class="title" style="margin-right:0%;">
                    <div class="description">
                        <?php echo $result['content']; ?>
                    </div>
                </div>

                <!-- end main content -->
            </div>

            <!--   -->
            <div class="response">
                <!-- like and comment section bar -->
                <div class="col s12 mt-6 center-align social-icon">
                    <span data-target="<?php if (isset($this->session->userdata['id'])) {echo '';} else {echo 'slide-out-right';}?>" class="material-icons  thumb likeBtn <?php if ($like['count'] == 1) {echo 'cyan-text';}?>"
                        data-blogid="<?php echo $result['id']; ?>">thumb_up</span>

                    <span class="ml-3 vertical-align-top likeCount "
                        data-blogid="<?php echo $result['id']; ?>"><?php echo $likecount['count'] ?></span>
                <?php if($this->session->id): ?>  
                    <span class="material-icons ml-10 commentBtn"
                        data-blogid="<?php echo $result['id']; ?>">chat_bubble_outline</span>
                    <span class="ml-3 vertical-align-top commentCount" data-blogid="<?php echo $result['id']; ?>">
                        <?php echo $commentCount['count']; ?>
                    </span>
                    <a class="modal-trigger" id="reportsubmit" href="#modal1">
                        <span class="material-icons ml-10  reportBtn <?php if ($report['count'] >= 1) {echo 'red-text';} else {echo '';}
;?> "
                            data-blogid="<?php echo $result['id']; ?>"
                            data-target="<?php if (isset($this->session->userdata['id'])) {echo '';} else {echo 'slide-out-right';}?>"
                            >report</span>

                    </a>
                <?php   endif;     ?>
                </div>
                <!--end  like and comment section bar -->

                <!-- comment  bar -->
                
                <div class="comment" style="padding-bottom:5%; ">
                    <!-- comment button --> 
                    <?php if($this->session->id): ?>
                    <div class="row lower">
                        <input type="text" placeholder="Type comment here.." class="message" id="TypeComment">
                        <div id="commenterror"></div>
                        <button class="btn light-blue waves-effect waves-light send" style="float:left;" id="SubmitComment" data-target="slide-out-right">Comment</button>
                    </div>
                    <?php   endif;     ?>
                    <!-- all comment -->
                    <div id="commentbox" class=" mt-5 ml-1 row collection-item animate fadeUp delay-2">

                    </div>
                    <div class="moreButtonOption " class="center-align " style="margin-top:10px; margin-left:30%;">
                        
                    </div>  
                    <!-- more comment button -->
                </div>

                <!--/ Content Area -->
            </div>
        </div>
        <!-- </div>
        </div> -->

        <!-- modal part -->

        <div id="modal1" class="modal border-radius-6 add-task-modal open">
            <div class="modal-content">
                <h5 class="mt-0">Report Reason</h5>
                <hr>
                <div class="row">

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix"> note </i>
                            <textarea id="notes" class="materialize-textarea validate"></textarea>
                            <label for="notes">Report</label>
                            <span id="reportError"> </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-close waves-effect waves-light mr-2">close</button>
                <button id="submit" class="btn modal-close waves-effect waves-light mr-2">submit</button>
            </div>
        </div>

        <!-- modal end -->
       
        <!-- </div> -->
    </section>


<script>
$(document).ready(function() {
    var blog_id = $(document).find('#viewIndetails').data('blogid');
    var logIn = false;

   var  session =  $(document).find('#session').val();
    //  alert(session);

    //  for report query
    if(session == 0)
    {
        // alert("please login");
        logIn = false;
        $("#reportsubmit").attr("href","");
        $("#SubmitComment").addClass("sidenav-trigger");
    }
    else
    {
        
        logIn = true;
    }


    if(logIn)
    {
        $("#submit").on('click', function() {
             var report = $("#notes").val();
             var report_len = $("#notes").val().trim().length;
          //  console.log(report_len);
          if (report == '' || report_len == 0 ) {
              $("#submit").removeClass("modal-close")
              $("#reportError").html("Please Fill The Reason")
              $("#reportError").addClass("red-text");
          } else {
              $("#submit").addClass("modal-close")
              $("#reportError").html("")
              $("#reportError").removeClass("red-text");
              $.ajax({
                  type: "POST",
                  url: "<?php echo site_url(); ?>blog/report",
                  data: {
                      blog_id: blog_id,
                      detail: report
                  },
                  dataType: "json",
                  success: function(response) {

                      if (response.status == 1) {
                          $(".reportBtn").addClass("red-text");
                          M.toast({
                              html: response.error
                          })
                      }
                  }
              });
          }
      });

    }
    // end report modal


             //  like button
         $(document).on('click','.likeBtn', function() {
               
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>blog/detailLike',
                    data: {
                        blog_id: blog_id
                    },
                    dataType: 'json',
                    error: function() {
                        console.log("something wrong");
                    },
                    success: function(response) {
                        $(document).find(".likeCount").html(response.count);

                        if(response.status == "unlike")
                        {
                            $(document).find(".likeBtn").removeClass('cyan-text');
                        }
                        else
                        {   
                            $(document).find(".likeBtn").addClass('cyan-text');
                        }
                        
                    }
                });
         });

    
});

$(document).on("click",'#SubmitComment', function() {
    addcomment();

});

$('#TypeComment').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        addcomment();
    }
});



//  loading comment

$(document).ready(function() {
    blog_id = $(document).find('#viewIndetails').data('blogid');
   
    var offset = 0;
    $(document).on("click",'#MoreCommentButton', function() {
        moreComment();
       
    });
    moreComment();


    function moreComment() {
        $( ".moreButtonOption").html('');
        var i = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>blog/blogComments",
            data: {
                blog_id: blog_id,
                limit: 5,
                offset: offset
            },
            dataType: "json",
            success: function(response) {
                $.each(response, function(index, value) {

                    var user = value.username;
                    if (value.count > 0) {
                        var user = 'You';

                    }
                    var profile_img = " ";
                    if(value.profile_img != '' )
                    {
                        profile_img =  BASE_URL + 'assets/images/users/'+ value.profile_img;
                    }
                    else
                    {
                        profile_img = "<?php echo base_url(); ?>/assets/images/icon/laptop.png";
                    }

                    var reportsymbol = (value.commentReportbtn)? value.commentReportbtn:'';

                    var comments = '';
                    var comments =
                        '<div class="perCommentDetail list-content collection-item mt-2 animate fadeUp delay-2">' +
                        '<div class="list-title-area">' +
                        '<div class="user-media">' +
                        '<img src="'+profile_img+'" alt="image" style="width:50px;height:50px;" class="circle responsive-img avtar">' +
                        '<div class="list-title">' + user + '</div>' +
                        '</div>' +
                        '<div class="">' +
                        '</div>' +
                        '</div>' +
                        '<div class="list-desc">' + value.detail + '</div>' +
                        '<div class="list-right ">' +
                        '<div class="list-date blue-text"> ' + taskDate(Date.parse(value.date)) + '  </div>' +
                        reportsymbol +
                        '</div>' +
                        '</div>';

                    $('#commentbox').append(comments);

                });
                if(response.length == 5){
                    $( ".moreButtonOption").html('<button id="MoreCommentButton" class="btn"> more comments </button>');
                }

            }

        });
        offset += 5;

    }

});


function addcomment()
{
    var blogId =        $(document).find('#viewIndetails').data('blogid');
    var commentDetail =  $(document).find('#TypeComment').val().trim();
    
    var commentInfo  = {
        blog_id :blogId,
        comment:commentDetail

    }

    if(commentDetail.length != 0)
    {
        $("#commenterror").html("");
        $("#commenterror").removeClass("red-text");
        $(document).find('#TypeComment').val('');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>blog/addComment",
            data: commentInfo,
            dataType: "json",
            success: function (response) {
                    if(response.status == 1)
                    {
                        $(document).find('.commentCount').text(response.count);
                        var singlecomments = '';
                        var profileImage = '';
                        if(response.commentadd.profile_img != '')
                        {
                            profileImage = '<?php echo base_url(); ?>'+'/assets/images/users/'+response.commentadd.profile_img;
                        }
                        else
                        {
                            profileImage = '<?php echo base_url(); ?>/assets/images/icon/laptop.png';
                        }

                        singlecomments ='<div id="singlecomments" class="list-content collection-item mt-2 animate fadeUp delay-2">' +
                            '<div class="list-title-area">' +
                            '<div class="user-media">' +
                            '<img src="'+profileImage+'" alt="image" style="width:50px;height:50px;" class="circle responsive-img avtar">' +
                            '<div class="list-title">' + "You" + '</div>' +
                            '</div>' +
                            '<div class="">' +
                            '</div>' +
                            '</div>' +
                            '<div class="list-desc">' + response.commentadd.detail + '</div>' +
                            '<div class="list-right ">' +
                            '<div class="list-date blue-text"> ' +response.commentadd.date + '  </div>' +
                            '</div>' +
                            '</div>';
                            $(document).find('#commentbox').prepend(singlecomments);
                        
                    }
                
            }
        });
    }
    else
    {
        $(document).find('#commenterror').html("Please Fill The Comment");
        $(document).find('#commenterror').addClass("red-text");
    }
    

}


// comment report add

$(document).ready(function () {
    $(document).on('click','.commentReportBtn', function () {
            $('#submitCommentReport').attr("data-blogid",$(this).data("blogid"));
            $('#submitCommentReport').attr("data-commentid",$(this).data("commentid"));
            $(document).find("#commentreportError").html(''); 
            $('#commentModal').modal('open');
    });

    $(document).on('click','#submitCommentReport', function () {
         var commmentDescription = $(document).find('textarea.commentReportAdd').val();
             if(commmentDescription != '')
             {
                addcommentReport($(this).attr('data-blogid'),$(this).attr('data-commentid'),commmentDescription);
                 
             }
             else
             {
                $(document).find("#commentreportError").addClass("red-text");   
                $(document).find("#commentreportError").html("Please Fill The Reason");  
             }
     });

     function addcommentReport(blogId,commentid,commmentDescription)
     {
               $(document).find("textarea.commentReportAdd").val('');
                $(document).find("#commentreportError").removeClass("red-text");   
                $(document).find("#commentreportError").html(""); 
                $('#commentModal').modal('close');
                 var commentData = {
                     blog_id:blogId,
                     comment_id:commentid,
                     description:commmentDescription
                 }
                 $.ajax({
                     type: "POST",
                     url: "<?php echo site_url(); ?>blog/reportComment",
                     data: commentData,
                     dataType: "json",
                     success: function (response) {
                        M.toast({
                                html: response.message
                                })
                         
                     }
                 });
     }
});

// comment report add end
</script>
 <!-- modal part -->

 <div id="commentModal" class="modal border-radius-6">
            <div class="modal-content">
                <h5 class="mt-0">Report Reason</h5>
                <hr>
                <div class="row">

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix"> note </i>
                            <textarea class="materialize-textarea validate commentReportAdd"></textarea>
                            <label>Report</label>
                            <span id="commentreportError"> </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-close red accent-2  mr-2">close</button>
                <button id="submitCommentReport" class="btn mr-2">submit</button>
            </div>
        </div>

        <!-- modal end -->


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