<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cropper.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/css/datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<style type="text/css">
   .error{
   color: #ff4081;
   font-size: .8rem;
   }
</style>
<div id="main">
   <div class="row">
      <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
      <div class="breadcrumbs-dark pb-0 pt-1" id="breadcrumbs-wrapper">
         <!-- Search for small screen-->
         <div class="container">
            <div class="row">
               <div class="col s10 m6 l6">
                  <h5 class="breadcrumbs-title mt-0 mb-0">Change Password</h5>
                  <ol class="breadcrumbs mb-0">
                     <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Home</a>
                     </li>
                     <li class="breadcrumb-item"><a href="#">Change Password</a>
                     </li>
                     <!-- <li class="breadcrumb-item active">DataTable
                        </li> -->
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="col s12">
         <div class="container">
            <div class="section section-data-tables">
               <!-- Page Length Options -->
               <div class="row">
                  <div class="col s12">
                     <div id="html-validations" class="card card-tabs">
                        <div class="card-content">
                           <div class="card-title">
                              <div class="row">
                                 <div class="col s12 m6 l10">
                                    <h4 class="card-title">Change Password</h4>
                                 </div>
                                 <div class="col s12 m6 l2">
                                 </div>
                              </div>
                           </div>
                           <div id="html-view-validations">
                              <form role="form" class="form-horizontal changePasswordForm" method="post" action="<?php echo base_url(); ?>admin/changePassword">
                                 <div class="col-sm-12 col-md-12">
                                    <div class="form-horizontal">
                                       <div class="form-group margin" style="margin-bottom: 5px;">
                                          <span for="field-1" class="col-sm-3 control-label">
                                          Current Password
                                          <span class="required" aria-required="true"></span></span>
                                          <div class="col-sm-5">
                                             <input type="password" name="current_password" class="form-control" style="padding: 10px;" required>
                                          </div>
                                       </div>
                                       <div class="form-group margin" style="margin-bottom: 5px;">
                                          <span for="field-1" class="col-sm-3 control-label">
                                          New Password
                                          <span class="required" aria-required="true"></span></span>
                                          <div class="col-sm-5">
                                             <input type="password" name="new_password" class="form-control new_password" style="padding: 10px;" required>
                                          </div>
                                       </div>
                                       <div class="form-group margin">
                                          <span for="field-1" class="col-sm-3 control-label">
                                          Confirm Password
                                          <span class="required" aria-required="true"></span></span>
                                          <div class="col-sm-5">
                                             <input type="password" name="confirm_password" class="form-control editname" style="padding: 10px;" required>
                                          </div>
                                       </div>
                                       <div class="col-sm-8">
                                          <div class="form-group margin " style="float: right;padding: 20px;">
                                             <button type="submit" class="btn btn-primary" >
                                             Save Details
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
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
<!-- END: Page Main