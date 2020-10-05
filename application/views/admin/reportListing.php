<style>
th.sorting_disabled{
  /* width:160px; */
}
tr td {

  white-space:nowrap;
}
#page-length-option3 {
    border: none;
  }
  label
{
    font-size: 15px;

    color: #9e9e9e;
}


@media screen and (min-width: 991px) {
    .big-col {
      width: 60% !important;
    }
    .big-col1 {
      width: 10% !important;
    }
    
   

    tbody tr td:nth-child(2){
      overflow:hidden;
      text-overflow: ellipsis;
      text-align:left;
    }
    table#page-length-option3
    {
      table-layout:fixed;
      width: 100% !important;
    }
}


.subListImg{

    position: relative;
    display: flex;
    justify-content: flex-start;
    align-items: center;
   
}


.imgdiv{
  width: 40px;
  height: 40px;
  
}

.imgdiv img{
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.username{
  text-transform: capitalize;
  color:black;
}
</style>

<div id="main" class="margin-table">

    <div class="row">
        <div class="col s12">
        <!-- Search for small screen-->
          <div class="container ">
            <div style="text-align: center;">
                <?php if ($this->session->flashdata("success")): ?>
                    <div class="alert alert-success">
                      <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("success"); ?>
                    </div>
                  <?php elseif ($this->session->flashdata("error")): ?>
                    <div class="alert alert-danger">
                      <i class="fa fa-remove-sign"></i><?php echo $this->session->flashdata("error"); ?>
                    </div>
                  <?php endif;?>
                  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
            </div>
            <!-- Content Area Starts -->
              <div class="content-area margin-table ">
            <!-- Start Main Content From Here -->
                  <div class="section section-data-tables">
                    <div class="row">
                      <div class="col s12">
                        <div id="button-trigger" class="card card card-default scrollspy">
                          <div class="card-content">
                          <h5 class="card-title">Blog Reports</h5>
                            <div class="row">
                              <div class="col s12"> 
                                <table id="page-length-option3" class="display">
                                <thead>
                                    <tr>
                                      <th class="big-col1">ID</th>
                                      <th class="big-col">Blog Title</th>
                                      <th >Users</th>
                                      <!-- <th>Reported Date</th> -->
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- Content Area Ends -->
          </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
<script type="text/javascript">
var timeout = 1500; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
$(document).ready(function() {
   
    $(document).on('click', '.deletecustBtn', function ()
    {   
        var id=$(this).data('id');
        if ($(this).hasClass("gradient-45deg-green-teal")) {
             $("#mh").html("Remove Blog");
             $("#mp").html("Are you sure you want to remove this blog?");
             $("#action").attr("href",BASE_URL+"blog/block?id="+id);
          
        }
    });


    $(document).on('click','.usersListing', function () {
      var usersListing_blog_id = $(this).data('id');
      var base_url = $(document).find('#base_url').val();
      console.log(usersListing_blog_id+base_url);
      $('#modal2').modal('open');
            $.ajax({
              type: "POST",
              url: base_url+'blog/blogReportListusers',
              data: {
                    blog_id:usersListing_blog_id
              },
              dataType: "json",
              success: function (response) {
                      console.log(response);
                      var html = '';
                      
                      $.each(response, function (index, value) { 
                        var pic = '';
                          if(value.profile_img.length != 0)
                          {
                              pic = base_url+'/assets/images/users/'+value.profile_img;
                          }
                          else
                          {
                              pic = base_url+ 'assets/images/avatar/default-u.jpg';
                          }
                        html += '<div class="subList">'+
                              '<div class="subListImg">'+
                                  '<div class="imgdiv">'+
                                  '<img src="'+pic+'" alt="" srcset="">'+
                                  '</div>'+
                                '<div class="pl-2 username">'+value.username+'</div>'+
                              '</div>'+
                              '<div class="reportdescription">'+
                                '<p>'+value.description+'</p>'+
                              '</div></div>';
                      });

                      $('.mainListUser').html(html);

                      
              }
            });
    });

});

</script>

<!-- modal  -->
<div id="modal1" class="modal border-radius-6 ">
    <div class="modal-content">
      <h5 id="mh"></h5>
      <hr>
      <p id="mp"></p>
    </div>
    <div class="modal-footer">
      <a href="" id="action" class="modal-action modal-close  btn red ">YES</a>
      <a href="javascript:void(0)" class="modal-action modal-close  btn " data-dismiss="modal1">NO</a>
    </div>
</div>
<!-- modal end -->


<!-- modal  -->
<div id="modal2" class="modal border-radius-6 ">
    <div class="modal-content">
      <h5 id="mh">All Users Report</h5>
      <hr>
      <p id="mp"></p>
      <div class="mainListUser">
      </div>
    </div>
    <div class="modal-footer">
      <!-- <a href="" id="action" class="modal-action modal-close  btn red ">YES</a> -->
      <a href="javascript:void(0)" class="modal-action modal-close  btn " data-dismiss="modal2">Cancel</a>
    </div>
</div>
<!-- modal end -->

