<!-- START RIGHT SIDEBAR NAV -->
<style>
div#slide-out-right
{  
   z-index:9999999999;
}
</style>

<?php if($this->session->user_type == 'ADMIN') {?>
<aside id="right-sidebar-nav">
   <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
      <div class="row">
         <div class="slide-out-right-title">
            <div class="col s12 border-bottom-1 pb-0 pt-1">
               <div class="row">
                  <div class="col s2 pr-0 center">
                     <i class="material-icons vertical-text-middle"><a href="javascript:void(0)" class="sidenav-close" style="color:red;">clear</a></i>
                  </div>

               </div>
            </div>
         </div>
         

         <div class="slide-out-right-body">

            <div id="settings" class="col s12">
               <ul class="collection border-none">
                  <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"
                           >
                           <?php if(empty($this->session->userdata['profile_img'])){?>
                           <img src="<?php echo base_url();?>assets/images/avatar/default-u.jpg" class="circle" alt="avatar" />
                           <?php } else{?>
                              <img src="<?php echo base_url().'assets/images/users/'.$this->session->userdata['profile_img']; ?>" class="circle" alt="avatar" />
                           <?php }?>
                        </span>
                        <div class="user-content">
                           <h2 class="line-height-0"> <?php echo $this->session->userdata['username']; ?> </h2>
                        </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>admin/dashboard"><span>Dashboard</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                        <a href="<?php echo base_url(); ?>users/notification"><span>Broadcast</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>users/draftList"><span>Blogs</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>users/edituserprofile"><span>Edit Profile</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>category/categories"><span>Category</span></a>
                     </div>
                  </li>

                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>blog/unpublishblogList"><span>User Blogs</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>blog/blogReportListAdmin"><span>Reported Blogs</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>blog/commentReportTable"><span>Reported Comments</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>image/upload"><span>Images</span></a>
                     </div>
                  </li>

                  <li class=" border-none mt-3">
                     <div class="m-0">
                        <a href="<?php echo base_url(); ?>users/users"><span>Users</span></a>
                     </div>
                  </li>

                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>admin/logout"><span style="color:red">Logout</span></a>
                     </div>
                  </li>
               </ul>

            </div>

         </div>
      </div>
   </div>

</aside>
<!-- END RIGHT SIDEBAR NAV -->

<?php } elseif($this->session->user_type == 'USER'){ ?>


<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
   <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
      <div class="row">
         <div class="slide-out-right-title">
            <div class="col s12 border-bottom-1 pb-0 pt-1">
               <div class="row">
                  <div class="col s2 pr-0 center">
                     <i class="material-icons vertical-text-middle"><a href="javascript:void(0)" class="sidenav-close">clear</a></i>
                  </div>

               </div>
            </div>
         </div>
         <div class="slide-out-right-body" >

            <div id="settings" class="col s12" style= "font-size:15px;" >
               <ul class="collection border-none">
                  <li class="collection-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                        <span class="avatar-status avatar-online avatar-50"> 
                           <?php if(empty($this->session->userdata['profile_img'])){?>
                           <img src="<?php echo base_url();?>assets/images/avatar/default-u.jpg" class="circle" alt="avatar" />
                           <?php } else{?>
                              <img src="<?php echo base_url().'assets/images/users/'.$this->session->userdata['profile_img']; ?>" class="circle" alt="avatar" />
                           <?php }?>
                        </span>
                        <div class="user-content">
                           <h2 class="line-height-0"><?php echo $this->session->userdata['username']; ?></h2>
                        </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>users/draftList"><span>Blogs</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>image/upload"><span>Images</span></a>
                     </div>
                  </li>
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>users/edituserprofile"><span>Edit Profile</span></a>
                     </div>
                  </li>
                  
                  <li class=" border-none mt-3">
                     <div class="m-0">
                     <a href="<?php echo base_url(); ?>login/logout" ><span style="color:red" >Logout</span></a>
                     </div>
                  </li>
               </ul>

            </div>

         </div>
      </div>
   </div>

</aside>
<!-- END RIGHT SIDEBAR NAV -->


<?php } else{?>


<!-- START RIGHT SIDEBAR NAV -->
<style>

</style>


<?php }?>
