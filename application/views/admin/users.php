<style>
#page-length-option1
 {
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
    table#page-length-option1
    {
      table-layout:fixed;
      width: 100% !important;
    }
}
</style>
<div id="main" class="margin-table">
    <div class="row">
        <div class="col s12">
        <!-- Search for small screen-->
          <div class="container">
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
            </div>
            <!-- Content Area Starts -->
              <div class="content-area margin-table">
            <!-- Start Main Content From Here -->
                  <div class="section section-data-tables">
                    <div class="row">
                      <div class="col s12">
                        <div id="button-trigger" class="card card card-default scrollspy">
                          <div class="card-content">
                           <h5 class="card-title">Users</h5>
                            <div class="row">
                              <div class="col s12"> 
                                <table id="page-length-option1" class="display">
                                <thead>
                                    <tr>
                                      <th>Sr.No.</th>
                                      <th>Username</th>
                                      <th>Email</th>
                                      <th>Phone No.</th>
                                      <th> Date</th>
                                      <th>Current Status</th>
                                      <th>Show Referrals</th>
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
        if ($(this).hasClass("gradient-45deg-red-pink")){
            $("#modelTitle").html("Block User");
            $("#modelHeading").html("Are you sure you want to Block this user ?");
            $("#btn_block_active").attr("href",BASE_URL+"users/blockusers?id="+id);
          
        }
        else
        {
          $("#modelTitle").html("Enable User");
          $("#modelHeading").html("Are you sure you want to Enable this user ?");
          $("#btn_block_active").attr("href",BASE_URL+"users/unblockusers?id="+id);
        }
    });
    $(document).on('click', '#btnshow', function ()
    {   
      
        var id=$(this).data('id');
        $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>users/referralList",
          data: {id:id},
          dataType: "json",
          success: function (response) {
            if(response.length > 0){
            $.each(response, function (indexInArray, value) { 
                   indexInArray +=1; 
                   $("#addtable").append('<tr><td>'+indexInArray+'</td><td>'+value.username+'</td><td>'+value.email+'</td><td>'+value.phone_no+'</td></tr>');
                  
            });
               
          }else{
                    $("#addtable").append('<tr><td></td><td></td><td class="red-text">No data found...</td><td></td></tr>');
                }
          }
        });
        $("#modal2").show();
        $("#addtable").empty();
    });
});
</script>
 <!-- modal  -->
 <div id="modal1" class="modal border-radius-6 ">
    <div class="modal-content">
      <h5 id="modelTitle"></h5>
      <hr>
      <p id="modelHeading"></p>
    </div>
    <div class="modal-footer">
      <a href="" id="btn_block_active" class="modal-action modal-close waves-effect waves-red btn red ">YES</a>
      <a href="" class="modal-action modal-close waves-effect waves-orange btn " data-dismiss="modal1">NO</a>
    </div>
  </div>
  
  <!-- modal end -->
<!-- modal  -->
 <div id="modal2" class="modal border-radius-6">
    <div class="modal-content">
      <h5>List Of Referrals</h5>
      <hr>
      <table class="display responsive-table">
        <thead>
          <tr>
            <th>Sr.No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone No.</th>
          </tr>
        </thead>
        <tbody id="addtable">
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-action modal-close  btn " data-dismiss="modal1">Close</a>
    </div>
  </div>
  
    <!-- modal end -->