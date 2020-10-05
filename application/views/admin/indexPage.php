
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
    min-height:600px;
    justify-content:center;

}

#blogImg
{
    width:100%;
    height:auto;
}

#categoryId
{
    pointer-events: none;
}
h6{
    font-size: 0.9rem;
}
.truncateTitle{
    font-size: 19px;
    line-height: 1.2em;
    height: 3.5em;
}
.truncateTitle1{
    font-size: 19px;
    line-height: 1.2em;
    height: 2.5em;
    color: black;
}
#ecommerce-products{
    margin-top:2%!important;
}
</style>


<div class="maincontainer">
  <div class="grid row" style="margin-top:2%;  margin-bottom:5% !important;" >
  
<?php
    $bigCar = 3;
    shuffle($result);
foreach ($result as $key => $value) {
    $bigCar = $bigCar + 1;
    $checkCard = ($bigCar % 4 == 0)? true:false;
        $thumbColor = ($value['count'] > 0) ? 'cyan-text':'';
        $image = base_url().'assets/upload/default.png';
                if(!empty($value['url'])){
                    $image = base_url().'assets/upload/'.$value['url'];
                }
                $profile_img = (!empty($value['profile_img']))? base_url().'assets/images/users/'.$value['profile_img']:base_url().'assets/images/avatar/default-u.jpg';
          $addDataAttribute = (isset($this->session->userdata['id']))? '':'slide-out-right';
          $readMore = '';
          if(!($value['isPublic'] != 'FALSE'))
          {
            $link = !empty($value['redirect_url'])? $value['redirect_url']:'';
            $readMore = 'Read more';
          }
          
    
    ?>
   
               <?php  if($checkCard) { ?>
                  <div id="main">
                                <div class="row">
                                    <div class="section">
                                        <div class="row" id="ecommerce-products">
                                            <div class="col 12 m12 l12">
                                                <div class="card animate fadeUp border-radius-8">
                                                    <div class="card-content">
                                                        <div class="row" id="product-four">
                                                            <div class="col m6">
                                                                <a href="<?php echo base_url().'blog/detail/'.$value['id']; ?>">
                                                                <img src="<?php echo $image; ?>" id="#blogImg" class="responsive-img border-radius-8 z-depth-4" style="width:100%;" alt="blog_image">
                                                                </a>
                                                            </div>
                                                            <div class="col m6">
                                                                <a href="#" id="categoryId"><?php echo $value['cat_name']; ?></a>
                                                                <p class="mb-2"></p>
                                                                <span id="distription">
                                                                <p class="truncateTitle1 mb-2"><?php echo $value['title']; ?></p>
                                                                <p class="details mb-2"><?php echo $value['detail']; ?></p>
                                                                <p class="mb-4 ReadMore">
                                                                <a href="<?php
                                                                echo $link;
                                                                ?>" target="_blank"><?php echo $readMore; ?></a>
                                                                </p>
                                                                <p class="mb-4" style="font-size:12px"><?php
                                                                echo date_format(date_create($value['date']), table_date);
                                                                ?></p>
                                                                </span>
                                                                <div class="row ">
                                                                <div class="col s10 mt-1 ">
                                                                    <p style="margin-bottom: 2%;"></p>
                                                                    <a href="<?php echo base_url().$value['full_name']; ?>">
                                                                    <img src="<?php echo  $profile_img ; ?>" alt="image" style = "width:37.64px; height:37.64px;" class="circle mr-3  vertical-text-middle">
                                                                    </a>
                                                                    <a href="<?php echo base_url().$value['full_name']; ?>"><span class="pt-2"> <?php echo $value['name']; ?></span>
                                                                    </a>
                                                                </div>
                                                                <div class="col s2 mt-3 right-align social-icon">
                                                                    <span data-target="<?php echo $addDataAttribute; ?>" class="material-icons  thumb likeBtn <?php echo $thumbColor; ?>" data-blogid="<?php echo $value['id']; ?>">thumb_up</span>
                                                                    <span class="ml-3 vertical-align-top likeCount" data-blogid="<?php echo $value['id']; ?>"><?php echo $value['likes']; ?></span>
                                                                    
                                                                   
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
                            </div>
               <?php }else{ ?>



                        <div>
                            <div class="grid-item col s12 m6 l4 ">
                                <div class="">
                                    <div class="card-panel border-radius-6 mt-4 animate fadeUp">
                                        <a href="<?php echo base_url().'blog/detail/'.$value['id']; ?>">
                                            <img id="blogImg" class="responsive-img border-radius-8 z-depth-4" src="<?php echo $image; ?>" alt="" >
                                        </a>
                                        <!-- <a href='+BASE_URL+'"/blog/detail"></a> -->
                                        <h6 class="deep-purple-text text-darken-3 mt-5">
                                        <!-- <a href='+BASE_URL+'"/blog/detail"></a> -->
                                        <a href="#" id="categoryId"><?php echo $value['cat_name']; ?></a></h6>
                                        <span id="distription">
                                            <p class="truncateTitle"><?php echo $value['title']; ?></p>
                                            <p class="details"> <?php echo $value['detail']; ?></p>
                                            <p class="details ReadMore">
                                            <a href="<?php echo $link;?>" target="_blank"><?php echo $readMore; ?></a>
                                            </p>
                                            <p style="font-size:12px">
                                            <?php echo date_format(date_create($value['date']), table_date);
                                                                ?>
                                            </p>
                                        </span>
                                        <div class="row " style="margin-bottom:0px;">
                                            <div class="col s9 mt-1 ">
                                                <a href="<?php echo base_url().$value['full_name']; ?>"><img src="
                                                <?php echo $profile_img; ?>" alt="image" style = "width:37.64px; height:37.64px;" class="circle mr-3  vertical-text-middle"></a>
                                                <a href="<?php echo base_url().$value['full_name']; ?>"><span class="pt-2"> <?php echo $value['name']; ?></span></a>
                                                
                                            </div>
                                            <div class="col s3 mt-3 right-align social-icon">
                                                <span data-target="<?php echo $addDataAttribute; ?>" class="material-icons  thumb likeBtn  <?php echo  $thumbColor; ?>" data-blogid="<?php echo $value['id']; ?>">thumb_up</span> <span class="ml-3 vertical-align-top likeCount" data-blogid="<?php echo $value['id']; ?>"><?php echo $value['likes'];  ?></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }} ?>
                       
                        </div>
                        </div>





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
var default_img = BASE_URL+'assets/upload/default.png';
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
function getblogs(search='')
{
    loader(); 
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>blog/scrollerRedirect",
        data: {
            'offset':0,
            'limit':24,
            'search':search,
            'category':category
        },
      complete: function(){
            $.unblockUI(); 
   },
        dataType: "json",
        success: function (response) {
            $.unblockUI(); 
            if(response.length <= 0 && search_title.length > 0){
                $('.grid').html("<div><h4 style='text-align: center;margin-top:15%;'>Sorry, we couldn't find any results matching"+'<strong style="color:red; "> "' +search_title+ '"<strong></h4></div>');
       
            }
            // var clickId = [];
            $.each( response, function( index, value ){
                //    var n = false;
                   
                //    if(clickId.indexOf(value.category_id) === -1){
                //          clickId.push(value.category_id);
                //          n = true;
                //      }
                     
                //     console.log(clickId);
                    
                var thumbColor = '';
                if(value.count > 0){
                    thumbColor = 'cyan-text';
                }

                var readMore;
                if(value.isPublic != true)
                {
                    if(value.redirect_url)
                    {
                         var anchor,link,mydiv;
                         mydiv = document.getElementsByClassName("ReadMore");
                         anchor = document.createElement('a');
                        //  link = document.createTextNode("Read more..");
                         anchor.setAttribute('href',value.redirect_url);
                         anchor.innerText = "Read more..";
                        // anchor.appendChild(link);
                        // anchor.title = "Read more..";
                        // anchor.href = value.redirect_url;
                        $('.ReadMore').html(anchor);
                        // readMore = anchor;
                        // alert(readMore);
                        // readMore = "<a '+anchor+'>Read more..<a>";
                    }
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
                var multiple = [0,4,8,12,16,20,24,28,32,36,40];
                var n = multiple.includes(index);
                // var n = true;
                if(search !='')
                {
                    n = false;
                }
                var html ='';
                if(n){ 
                    html +='<div id="main">'+
                                '<div class="row">'+
                                    '<div class="section">'+
                                        '<div class="row" id="ecommerce-products">'+
                                            '<div class="col 12 m12 l12">'+
                                                '<div class="card animate fadeUp border-radius-8">'+
                                                    '<div class="card-content">'+
                                                        '<div class="row" id="product-four">'+
                                                            '<div class="col m6">'+
                                                                '<a href="<?php echo base_url(); ?>blog/detail/'+value.id+'">'+
                                                                '<img src="'+ image +'" id="#blogImg" class="responsive-img border-radius-8 z-depth-4" style="width:100%;" alt="">'+
                                                                '</a>'+
                                                            '</div>'+
                                                            '<div class="col m6">'+
                                                                '<a href="#" id="categoryId">'+value.cat_name+'</a>'+
                                                                '<p class="mb-2"></p>'+
                                                                '<span id="distription">'+
                                                                '<p class="truncateTitle1 mb-2">'+value.title+'</p>'+
                                                                '<p class="details mb-2">'+value.detail+'</p>'+
                                                                '<p class="mb-4 ReadMore"></p>'+
                                                                '<p class="mb-4" style="font-size:12px">'+taskDate(Date.parse(value.date))+'</p>'+
                                                                '</span>'+
                                                                '<div class="row ">'+
                                                                '<div class="col s5 mt-1 ">'+
                                                                    '<p style="margin-bottom: 2%;"></p>'+
                                                                    '<a href='+BASE_URL+value.full_name+'>'+
                                                                    '<img src="'+profile_img+'" alt="image" style = "width:37.64px; height:37.64px;" class="circle mr-3  vertical-text-middle">'+
                                                                    '</a>'+
                                                                    '<a href='+BASE_URL+value.full_name+'><span class="pt-2">'+value.name+'</span>'+
                                                                    '</a> '+
                                                                '</div>'+
                                                                '<div class="col s7 mt-3 right-align social-icon">'+
                                                                    '<span data-target="'+addDataAttribute+'" class="material-icons  thumb likeBtn '+thumbColor+'" data-blogid="'+value.id+'">thumb_up</span>'+
                                                                    '<span class="ml-3 vertical-align-top likeCount" data-blogid="'+value.id+'">'+value.likes+'</span>'+
                                                                    '<span class="material-icons ml-10 commentBtn" data-blogid="'+value.id+'">chat_bubble_outline</span>'+
                                                                '</div>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    }else{
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
                                            '<p class="details ReadMore"></p>'+
                                            '<p style="font-size:12px">'+taskDate(Date.parse(value.date))+'</p>'+
                                        '</span>'+
                                        '<div class="row " style="margin-bottom:0px;">'+
                                            '<div class="col s5 mt-1 ">'+
                                                '<a href='+BASE_URL+value.full_name+'><img src="'+profile_img+'" alt="image" style = "width:37.64px; height:37.64px;" class="circle mr-3  vertical-text-middle"></a>'+
                                                '<a href='+BASE_URL+value.full_name+'><span class="pt-2">'+value.name+'</span></a>'+
                                                
                                            '</div>'+
                                            '<div class="col s7 mt-3 right-align social-icon">'+
                                                '<span data-target="'+addDataAttribute+'" class="material-icons  thumb likeBtn '+thumbColor+'" data-blogid="'+value.id+'">thumb_up</span> <span class="ml-3 vertical-align-top likeCount" data-blogid="'+value.id+'">'+value.likes+'</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                    }

                

                $('.grid').append(html);
                $.unblockUI(); 
            });
        }
    });
}
});

</script>


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

