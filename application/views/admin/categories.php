<style>
th.sorting_disabled{
  /* width:160px; */
}

#page-length-option5 {
    border: none;
  }
  label
{
    font-size: 15px;

    color: #9e9e9e;
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
                          <h class="card-title">Categories  <a href="<?php echo base_url() . 'category/addCategories'; ?>" class="btn waves-effect waves-light gradient-45deg-red-pink btn-orders" style="float:right";>Add Categories</a></h4>
                            <div class="row">
                              <div class="col s12"> 
                                <table id="page-length-option5" class="display">
                                <thead>
                                <tr>
                                  <th style="width:5% !important;">Sr. No.</th>
                                  <th>Categories</th>
                                  <th style="align-items: center !important;">Action</th>
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

<!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script type="text/javascript">
var timeout = 1500; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
$(document).ready(function() {
  $('#categoryListing').css('width', '100%');
  $('#categoryListing').DataTable({
        paging:         true,
        "columnDefs": [
      { "width": "10px", "targets": 0 },
      { "width": "40px", "targets": 2 },
        { "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
        },
    ],

    });
    $(document).on('click', '.deletecustBtn', function ()
    {   
        var id=$(this).data('id');
        if ($(this).hasClass("gradient-45deg-red-pink")) {
             $("#mh").html("Delete Category");
             $("#mp").html("Are you sure you want to Delete this Category?");
             $("#action").attr("href",BASE_URL+"category/deletecategories?id="+id);
          
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
