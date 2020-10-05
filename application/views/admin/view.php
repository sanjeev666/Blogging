
<style>
.likeBtn
{
    cursor: pointer;
}

.grid {
    width: 95%;
   
}

body,.maincontainer{
    background:#e6e6e6;
}

.maincontainer {
    /* margin-left:5% !important;
    margin-right:5% !important; */
    width: 100%;
    min-height:100%;
    justify-content:center;

}

#blogImg
{
    width:100%;
    height:175px;
}

#categoryId
{
    pointer-events: none;
}

</style>

<script>



$(window).on('load', function () {
    loader();
},function(){
    $.unblockUI();
}); 
    




$(document).ready(function () {
              $.unblockUI();
 var addDataAttribute = "<?php if (isset($this->session->userdata['id'])) {echo '';} else {echo 'slide-out-right';}?>";
  
var category = "<?php echo $category; ?>";
var default_img = BASE_URL+'assets/upload/19-12-20 19:05:15.png';
var default_image ='assets/images/avatar/default-u.jpg';
var folder_For_img    = "assets/images/users/";
var search_title = '';
function se(search='',category='')
{
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>blog/search",
        data: {search:search,category:category},
        
        dataType: "json",
        success: function (response) {
            console.log(response);
            
        }
    });
}
//  search icon click
$(document).on('click','#searchIcon', function() {
    search   =$(document).find('#searchBox').val();
    search_title   = String(search);
    console.log("click icon :"+search_title);
    flag =0;
    $('.grid').html('');
    getblogs(search_title);
  
});
// key press
$('#searchBox').keypress(function(event){
    // alert('hiii');
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        search   =$(document).find('#searchBox').val();
        search_title   = String(search);
        if(search_title.length==0 || search_title.length > 0){
        console.log("enter button :"+search_title);
        flag =0;
        $('.grid').html('');
        getblogs(search_title);
        }

            
    }
});

// working
var flag = 0;
function getblogs(search=''){
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>blog/scroller",
        data: {
            'offset':flag,
            'limit':20,
            'search':search,
            'category':category
        },
        beforeSend: function(){
            loader(); 
                            },
      complete: function(){
            $.unblockUI(); 
   },
        dataType: "json",
        success: function (response) {
            if(response.length <= 0 && search_title.length > 0){
                $('.grid').html("<div><h4 style='text-align: center;margin-top:15%;'>Sorry, we couldn't find any results matching"+'<strong style="color:red; "> "' +search_title+ '"<strong></h4></div>');
       
            }
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
                var html ='';
                html +='<div>'+
                            '<div class="grid-item col s12 m6 l4 ">'+
                                '<div class="">'+
                                    '<div class="card-panel border-radius-6 mt-4 animate fadeUp">'+
                                        '<a href="<?php echo base_url(); ?>blog/detail/'+value.id+'">'+
                                            '<img id="blogImg" class="responsive-img border-radius-8 z-depth-4" src="'+ image +'" alt="" >'+
                                        '</a>'+
                                        '<a href='+BASE_URL+'"/blog/detail"></a>'+
                                        '<h6 class="deep-purple-text text-darken-3 mt-5">'+
                                        '<a href='+BASE_URL+'"/blog/detail"></a>'+
                                        '<a href="#" id="categoryId">'+value.cat_name+'</a></h6>'+
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
                                                '<span data-target="'+addDataAttribute+'" class="material-icons  thumb likeBtn '+thumbColor+'" data-blogid="'+value.id+'">thumb_up</span> <span class="ml-3 vertical-align-top likeCount" data-blogid="'+value.id+'">'+value.likes+'</span>'+
                                                // '<span class="material-icons ml-10 commentBtn" data-blogid="'+value.id+'">chat_bubble_outline</span><span class="ml-3 vertical-align-top commentCount" data-blogid="'+value.id+'">'+value.comment_count+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                $('.grid').append(html);
              
            });
        }
    });
}

        // defoult page containe
    $("#horizontal-nav").show();
    $("#"+category).parent().parent().addClass("active");
        $('.grid').html('');
        getblogs();
       
    // after scroll
    $(window).scroll(function(category)
    {
        if ($(window).scrollTop() >= $(document).height() - $(window).height()) { 
            flag +=20;
            getblogs($(document).find('#searchBox').val());
        }
       
    });
});
</script>
<body>
  <div class="maincontainer">
    <div class="grid row" style="margin-top:5%;  margin-bottom:5% !important;" >
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
</script>

