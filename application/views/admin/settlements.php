<style>
#table_orders {
    border: none;
  }
.status_pending{
  width:266px;
  height:45px;
}
.status_success{
  width:266px;
  height:45px;
}

.sidebar .sidebar-content .sidebar-header {
    top: 30px;
}
.row .col.l12 {
    margin-top: -5%;
}
a{
  text-align: justify;
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
  margin-bottom: 10%;
}

}


@media screen and (min-width: 991px) {
    .big-col {
      width: 25% !important;
    }
    .big-col1 {
      width: 10% !important;
    }
    
   

   
    table#table_orders
    {
      table-layout:fixed;
      width: 100% !important;
    }
}


</style>
<div id="main">
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
            <!-- Sidebar Area Starts -->
                <div class="sidebar-left sidebar-fixed">
                    <div class="sidebar">
                      <div class="sidebar-content">
                        <div class="sidebar-header" >
                          <div class="sidebar-details">
                            <h5 class="m-0 sidebar-title "><i class="blogicon fa fa-rupee" style="font-size:28px;"></i>  Settlements</h5>
                            <div class="row valign-wrapper mt-10 pt-2 animate fadeLeft">
                            </div>
                          </div>
                        </div>
                        <div id="sidebar-list" class="sidebar-menu list-group position-relative  animate fadeLeft">
                          <div class="sidebar-list-padding app-sidebar sidenav" id="email-sidenav">
                            <ul class="email-list display-grid">
                              <li  class="status_pending" ><a href="<?php echo base_url() . 'settlement/settlements' ?>" > Pending</a></li>
                              <li  class="status_success" ><a href="<?php echo base_url() . 'settlement/settlementsSuccess' ?>" > Settled</a></li>
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
            <!-- Start Main Content From Here -->
            <div class="section section-data-tables">
              <input type="hidden" name="status" id="status" data-status ="<?php echo $status; ?>">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <div id="button-trigger" class="card card card-default scrollspy">
                          <div class="card-content">
                            <div class="row">
                              <div class="col s12 row">
                                <div>
                                  <div class="col m12 s12"  >

                                      <div class="col m3" style="padding-left:0px;">
                                        <span class="card-title" id ="heading" style="padding:0px;"></span>
                                      </div>
                                      <div class="col m4 row"  >
                                            <h6 class="col m4" style="text-align:right; color:#6b6f82; font-size:15px;">Month</h6>
                                            <select class="browser-default month col m6" style="color:#6b6f82; padding:0px; margin-right:0px; margin-top:-6px; border-bottom:none; ">
                                            <option value="" disabled="" selected="">Select Month</option>
                                            <?php
                                              for ($i = 01; $i <= 12; $i++) {
                                                  echo "<option value='" . $i . "'>" . date('F', mktime(0, 0, 0, $i)) . "</option>";
                                              }

                                              ?>
                                            </select>

                                      </div>
                                          <div class="col m4 row">
                                          <h6 class="col m4" style="text-align:right;color:#6b6f82; font-size:15px;">Year</h6>
                                            <select class="browser-default year col m6" style="color:#6b6f82;padding:0px; margin-right:0px; margin-top:-6px; border-bottom:none;">
                                            <option value="" disabled="" selected="">Select Year</option>
                                                <?php
                                                    for ($i = 2024; $i >= 2016; $i--) {
                                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                                    }

                                                    ?>
                                            </select>


                                          </div>
                                  </div>
                                <table id="table_orders" class="display">
                                <thead>
                                    <tr>
                                      <th class="big-col1">ID</th>
                                      <th class="big-col">Username</th>
                                      <th class="big-col">Amount</th>
                                      <th class="big-col">Settled Date</th>
                                      <?php if($status == 'PENDING'){  ?>
                                      <th class="big-col">Action</th>
                                      <?php } ?>
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
              </div>
            </div>
              <!-- Content Area Ends -->
          </div>
        </div>
    </div>
</div>
</div>

<div id="modal1" class="modal border-radius-6">
    <div class="modal-content">
      <h5>Settle Amount</h5>
      <hr>
      <p>Are you sure you want to Settle this Amount   <span id="settleAmount"> </span>?</p>
    </div>
    <div class="modal-footer">
      <a href="" id="action" class="modal-action modal-close  btn red ">YES</a>
      <a href="javascript:void(0)" class="modal-action modal-close  btn " data-dismiss="modal1">NO</a>
    </div>
  </div>

<!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
<script>
$(document).ready(function () {
   var a=$("input[type ='hidden']").data('status');
   if (a == "SUCCESS") {
     $(".status_success").addClass("active");
     $("#heading").html("Settled Settlements");
   }
   else
   {
    $(".status_pending").addClass("active");
    $("#heading").html("Pending Settlements");
   }
});
$(document).ready(function() {
  var BASE = "<?php echo base_url(); ?>"
  var table = $('#table_orders').DataTable({
      serverSide: true,
      bProcessing: true,
      "responsive":true,
       order: [[0, "desc"]],
      ajax: {
          url: BASE + 'settlement/settlementajax/',
          type: 'POST',
          data:{status:$(document).find('#status').attr('data-status')},
          dataSrc: 'data'
      },
      "columnDefs": [
          {
            "targets": [ -1 ], //last column
            "orderable": ($(document).find('#status').attr('data-status') == 'SUCCESS')?true:false, //set not orderable
          },
      ]
      });

        // settled modal
        $(document).on('click','.settleBtn', function () {
              var settleId = $(this).data('id');
              var settleAmount = $(this).data('amount');
              $(document).find("#action").attr('href',BASE+'settlement/settleAmount/'+ settleId);
              $(document).find("#settleAmount").html('<b>&#8377</b>'+ settleAmount)
              $(document).find("#settleAmount").css('padding','4px');

        });












      $(document).on( 'change','.browser-default', function () {
        var searchDrop  = '';
        var selected = $(this).addClass("selected");
        var month = $(document).find('.month').val();
        var year = $(document).find('.year').val();
        if(month == null)
         {
           console.log("value is null");
           month = '';
           searchDrop    = year;
         }
        else if(month.length <= 1 && month != null )
        {
          month = 0+month;
        }

        if(year == null)
         {
           console.log("value is null");
           year = '';
           searchDrop    = month;

         }
         if(year != null &&  month != null )
         {
          searchDrop    = year +'-'+ month;
         }
        table.search(searchDrop).draw();
        console.log(searchDrop);



        } );



});
</script>
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