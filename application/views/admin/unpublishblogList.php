<style>
#page-length-option10 {
    border: none;
    padding:0px;
  }
.blogSidebar{
  width:266px;
  height:45px;
}
.sidebar .sidebar-content .sidebar-header {
    top: 30px;
}
.row .col.l12 {
    margin-top: -5%;
}
label
{
    font-size: 15px;

    color: #9e9e9e;
}

.sidenav li > a,
.sidenav li a.collapsible-header
{
    padding:  16px !important;
    padding-top:0px !important;
}

.zIndex{
  z-index:9999;
}

#menubtn
{
  content:'';
  display:block;
  clear:both;
}



@media (max-width: 991px){

  .margin-table
{
  margin-top:10%;
  margin-bottom:18%;
}

.blogicon{
  margin-bottom: 2%;
}

}


@media screen and (min-width: 991px) {
    .big-col {
      width: 25% !important;
    }
    .big-col1 {
      width: 10% !important;
    }
    
   

    tbody tr td:nth-child(2){
      overflow:hidden;
      text-overflow: ellipsis;
      text-align:left;
    }
    table#page-length-option10
    {
      table-layout:fixed;
      width: 100% !important;
    }
}



</style>
<div id="main" >
    <div class="row">
        <div class="col s12">
        <!-- Search for small screen-->
          <div class="container">
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
            <!-- Sidebar Area Starts -->
                <div class="sidebar-left sidebar-fixed">
                    <div class="sidebar">
                      <div class="sidebar-content">
                        <div class="sidebar-header">
                          <div class="sidebar-details">
                            <h5 class="m-0 sidebar-title"><i class="blogicon material-icons dp48 app-header-icon text-top">account_circle</i> User Blogs</h5>
                            <div class="row valign-wrapper mt-10 pt-2 animate fadeLeft">
                              <div class="col s12">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="sidebar-list" class="sidebar-menu list-group position-relative  animate fadeLeft">
                          <div class="sidebar-list-padding app-sidebar sidenav"  id="email-sidenav">
                            <ul class="email-list display-grid">
                              <li ><a href="<?php echo base_url() ?>blog/blogListAdmin" style="width:239px;" >Published Blogs<span class="badge badge pill red " style="padding:0 3px;"><?php echo $count; ?></span></a></li>
                              <li class="active blogSidebar"><a href="" style="width:239px;" >Unpublished Blogs<span class="badge badge pill red"><?php echo $countUnpublish; ?></span></a></li>
                              <li><a href="<?php echo base_url() ?>blog/rejectblogList" style="width:239px;">Rejected Blogs<span class="badge badge pill red"><?php echo $rejectblogListCount; ?></span></a></a></li>
                              <li><a href="<?php echo base_url() ?>blog/blockblogList" style="width:239px;">Blocked Blogs<span class="badge badge pill red"><?php echo $BlockblogListCount; ?></span></a></li>
                            </ul>
                          </div>
                        </div>
                        <a href="#" id="menubtn" data-target="email-sidenav" class="sidenav-trigger hide-on-large-only"><i class="material-icons">menu</i></a>
                      </div>
                    </div>
                  </div>
                  <!-- Sidebar Area Ends -->
            <!-- Content Area Starts -->
              <div class="app-email margin-table">
                <div class="content-area content-right">
                  <div class="app-wrapper">
                  <div class="section section-data-tables">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <div id="button-trigger" class="card card  scrollspy">
                          <div class="card-content">
                            <h4 class="card-title">Unpublished Blogs</h4>
                            <div class="row">
                              <div class="col s12">
                              <table id="page-length-option10" class="display">
                                  <thead>
                                    <tr>
                                      <th class="big-col1">ID</th>
                                      <th class="big-col">Title</th>
                                      <th>Date</th>
                                      <th>Updated Date</th>
                                      <!-- <th>Current Status</th> -->
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
             $("#mh").html("Publish Blog");
             $("#mp").html("Are you sure you want to Publish this blog?");
             $("#action").attr("href",BASE_URL+"blog/publish?id="+id);
          
        }
        else if($(this).hasClass("#d50000 red accent-4"))
        {
             $("#mh").html("Blocked Blog");
             $("#mp").html("Are you sure you want to Blocked this blog?");
             $("#action").attr("href",BASE_URL+"blog/block?id="+id);
        }
        else
        {
          $("#mh").html("Reject Blog");
             $("#mp").html("Are you sure you want to Reject this blog?");
             $("#action").attr("href",BASE_URL+"blog/reject?id="+id);
        }
    });
});

</script>


<!-- modal  -->
<div id="modal1" class="modal border-radius-6 open">
    <div class="modal-content">
      <h5 id="mh"></h5>
      <hr>
      <p id="mp"></p>
    </div>
    <div class="modal-footer">
      <a href="" id="action" class="modal-action modal-close waves-effect waves-red btn red ">YES</a>
      <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-orange btn " data-dismiss="modal1">NO</a>
    </div>
  </div>
  

    <!-- modal end -->


 <!-- modal  -->
 <div id="modal1" class="modal border-radius-6 open">
    <div class="modal-content">
      <h5 id="mh"></h5>
      <hr>
      <p id="mp"></p>
    </div>
    <div class="modal-footer">
      <a href="" id="action" class="modal-action modal-close waves-effect waves-red btn red ">YES</a>
      <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-orange btn " data-dismiss="modal1">NO</a>
    </div>
  </div>
  

<script>

$(document).ready(function () {

  $(document).on('click','#menubtn', function () {
    $('.sidebar .sidebar-content .sidebar-menu#sidebar-list').addClass('zIndex');
    
  });

  $(document).on('click','.sidenav-overlay', function () {
    $('.sidebar .sidebar-content .sidebar-menu#sidebar-list').removeClass('zIndex');
    
  });

  
});
</script>

    <!-- modal end -->
