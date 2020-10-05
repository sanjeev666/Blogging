<style>
#page-length-option6
 {
    border: none;
  }
  
  label
{
    font-size: 15px;
    color: #9e9e9e;
}

/* thead tr th:nth-child(2) {
  background:green !important:
  width:10% !important;
} */

@media screen and (min-width: 991px) {

    .big-col {
      width: 40% !important;
    }

    tbody tr td:nth-child(2){
      overflow:hidden;
      text-overflow: ellipsis;
      text-align:left;
    }

    table#page-length-option6
    {
      table-layout:fixed;
    }


}



</style>
<div id="main" style="margin-bottom:7%;">
    <div class="row">
        <div class="col s12">
        <!-- Search for small screen-->
          <div class="container margin-table">
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
              <div class="content-area " >
            <!-- Start Main Content From Here -->
                  <div class="section section-data-tables" >
                    <div class="row">
                      <div class="col s12">
                        <div id="button-trigger" class="card card card-default scrollspy">
                          <div class="card-content" >
                           <h5 class="card-title">Broadcast <a href="<?php echo base_url() . 'users/addNotification'; ?>" class="btn waves-effect waves-light gradient-45deg-red-pink btn-orders" style="float:right";>Add Broadcast</a></h5>
                            <div class="row">
                              <div class="col s12">
                                <table id="page-length-option6" class="display">
                                <thead>
                                    <tr>
                                      <th>Sr.No</th>
                                      <th class="big-col">Title</th>
                                      <th>Created Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
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
<div id="showm" class="modal border-radius-6 open">
    <div class="modal-content">
      <h5 id="mh">
       Delete
      </h5>
      <hr>
      <p id="mp">
      Are you sure you want to Delete this Notification ?
      </p>
    </div>
    <div class="modal-footer">
      <a href="" id="action" class="modal-action modal-close waves-effect waves-red btn red ">YES</a>
      <a href="javascript:void(0)" class="modal-action modal-close  btn " data-dismiss="modal1">NO</a>
    </div>
  </div>

  <script>
  $(document).ready(function () {
    $(document).on("click",'.deleteBtn', function(){
      var notificationId =$(this).data("notification-id");
      $("#showm").modal('open');
      $(document).on("click",'#action', function(){
        $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/deleteNotification",
                  data: {id:notificationId},
                  dataType: "json",
                  success: function (response) {
                      console.log(response);
                  }
                });
        });

});







// width of title


  });

  </script>