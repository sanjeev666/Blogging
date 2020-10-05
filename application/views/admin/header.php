<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/logo/apple-touch-icon-152x152.png"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/icon/blogging.jpg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/animate-css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/chartist-js/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/chartist-js/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/noUiSlider/nouislider.min.css" type="text/css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/layouts/style-horizontal.css">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/dashboard-modern.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/intro.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/flag-icon/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/data-tables/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/dropify/css/dropify.min.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/eCommerce-products-page.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/data-tables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css.map">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-sidebar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-email.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/ionRangeSlider/css/ion.rangeSlider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/ionRangeSlider/css/ion.rangeSlider.skinFlat.css">
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script> -->

    <script>



      var BASE_URL = "<?php echo base_url(); ?>";

      var flashdata ='';
      <?php if ($this->session->flashdata('success')): ?>
        var flashdata = "<?php echo $this->session->flashdata('success'); ?>";
      <?php elseif ($this->session->flashdata('error')): ?>
        var flashdata = "<?php echo $this->session->flashdata('error'); ?>";
      <?php endif;?>

    </script>

    <script type="text/javascript">
    var timeout = 1500; // in miliseconds (3*1000)
    $('.alert').delay(timeout).fadeOut(300);
    </script>

    <style>
    .collection .collection-item.avatar {
      background-color: #f9f9f9;
    }
    .sidebar .sidebar-content .sidebar-menu ul {
      background-color: #f9f9f9;
    }
    .sidenav {
      background-color: #f9f9f9;
    }
    .error{
      color:red;
    }
    .card .card-content .card-title i {
    margin-top: 4px;
    line-height: 32px;
    }
    .select-wrapper{
    width:90px;
    }
    table.dataTable thead th {
    border-bottom: 0;
    }
    .alert-success{
        color:green;
    }
    .alert-danger{
        color:red;
    }

  footer{
  width: 100%;
  height:51px;
  /* position:sticky; */
  background-color:#212121 !important;
  padding-top: 1px;
  display: block;
  font-size: 15px;
  font-family: 'Muli', sans-serif !important;
  font-weight: normal;
  line-height: 1.5;
  bottom:0px;
}

.btn-floating,.btn,.tox-editor-header{
  position: static !important;
}
.dataTables_wrapper .dataTables_filter input {
    width: 60%;
    margin-left: 0.5em;
    height: 2rem;
}

#main .section-data-tables .dataTables_wrapper .dataTables_info
{
    margin-top: 18px;

    color: #616161;
}
.sidebar .sidebar-content .sidebar-header {
    height: 10%;
}
span.badge.pill {
    font-size: .8rem;
    line-height: 20px;
    min-width: 1rem;
    height: 20px;
    border-radius: 50%;
    margin-top: 12px;
    margin-left: -5px;
    background-color: black !important;
    font-weight:bold;
}

.bold_font{
  color:black;
  font-weight:bold !important;
}
@media only screen and (min-width: 1450px)
{
  .row .col.l4 {
      right: auto;
      left: auto;
      width: 25%;
      margin-left: auto;
    }

  footer{
    /* position:fixed; */
    display: block;
    margin-bottom:0px;
  }

}

/* rj */
@media(max-width: 600px)
{
  .headerButtonlog{
    width:40px !important;
  }
  .headerButtonsign{
    width:82px !important;
  }


}




@media only screen and (max-width: 320px) and (min-width:0px){
  .row .col.s12 {
    width: 100%;
    margin-top: 12%;
  }
  #notifications-dropdown{
    margin-right:0%;
  }
  #imgprofile
  {
      margin-left: 22% !important;
    }
  .btn{
    width:100px;
    height:30px;
    line-height: 25px;
    display: inline-block;
    height: 25px;
    padding: 0 1rem;
    vertical-align: middle;
    text-transform: uppercase;
    border: none;
    border-radius: 4px;
    -webkit-tap-highlight-color: transparent;
    font-size:12px;
  }
  #slide-out-right.sidenav {
    top: 0;
    width: 300px;
    padding-bottom: 0;
  }
  footer{
    /* position:fixed; */
    display: block;
    margin-bottom:0px;
    font-size: 9px;
  }

  #logoBlogging
  {
    padding-left: 0px !important;
    padding-top: 0px !important;
    font-size: 15px !important;
}
header .brand-logo{
  padding: 13px 5px !important;
}
.notification-button i {
    font-size: 15px !important;
    position: relative;
    margin-top: 10px  !important;
    margin-left: 0px  !important;
}
nav ul a {
    display: block;
    padding: 0 5px;
}
.material-icons {
    font-size: 15px !important;
}
p{
 font-size: 10px !important;
}

}

@media only screen and (max-width: 1024px) and (min-width:768px){

  #notifications-dropdown{
    margin-right:10%;
  }
  #imgprofile{
    margin-left: 40% !important;
  }
  .btn{
  width:100px;
  height:30px;
  line-height: 25px;
  display: inline-block;
  height: 25px;
  padding: 0 1rem;
  vertical-align: middle;
  text-transform: uppercase;
  border: none;
  border-radius: 4px;
  -webkit-tap-highlight-color: transparent;
  font-size:12px;
  }
  footer{
    /* position:fixed; */
    display: block;
    margin-bottom:0px;
    font-size: 10px;
  }
  #logoBlogging {
    padding-left: 0px !important;
    padding-top: 0px !important;
    font-size: 20px !important;
}
header .brand-logo{
  padding: 18px 5px !important;
}

.row .col.s12{
  margin-top:2% !important;
}

}
@media only screen and (max-width: 767px) and (min-width:321px){
.row .col.s12 {
  width: 100%;
  margin-top: 10%;
}
p{
 font-size: 12px !important;
}
#imgprofile{
    margin-left: 27% !important;
}
.btn{
  width:100px;
  height:32px;
  line-height: 25px;
  display: inline-block;
  height: 25px;
  padding: 0 1rem;
  vertical-align: middle;
  text-transform: uppercase;
  border: none;
  border-radius: 4px;
  -webkit-tap-highlight-color: transparent;
  font-size:12px;
  }
  footer{
    /* position:fixed; */
    display: block;
    margin-bottom:0px;
    font-size: 10px;
  }
  #logoBlogging {
    padding-left: 0px !important;
    padding-top: 0px !important;
    font-size: 20px !important;
}
header .brand-logo{
  padding: 18px 5px !important;
}
.notification-button i {
    font-size: 20px !important;
    position: relative;
    margin-top: 7px  !important;
    margin-left: 0px  !important;
}
nav ul a {
    display: block;
    padding: 0 5px;
}
.material-icons {
    font-size: 20px !important;
}
}

.truncateTitle{
color:black;
font-weight:bold;
font-size:18px;
height:47.5px;
height:60px;
line-height: 1.5em;
height: 3em;
overflow: hidden;
}
.details{
color:black;
text-align:justify;
width:100%;
font-size:14px;
height:60px;
line-height: 1.5em;
height: 3em;
overflow: hidden;
}

/* .card-panel{
  height:480px;
} */

#logoBlogging {
    font-family: 'Ubuntu', sans-serif;
    font-size: 30px;
    font-size: 30px;
    visibility: visible;
    padding-left: 8px;
    padding-top: 8px;
    -webkit-transition: opacity .2s linear;
    -moz-transition: opacity .2s linear;
    -o-transition: opacity .2s linear;
    transition: opacity .2s linear;
    opacity: 1;
}
header .brand-logo {
    font-size: 2.1rem;
    line-height: 0;
    position: absolute;
    top: 0;
    display: inline-block;
    margin: 9px 0;
    font-family: 'Ubuntu', sans-serif;
    font-size: 30px;
    font-size: 30px;
  }
.blockUI h1{
  font-size: 2.2rem !important;
}
.tabs .tab a {
    font-weight: bold !important;
    color:black !important;
}
.nav-extended {
    line-height: 56px;
    width: 100%;
    height: 56px;
    color: black;
    background-color: #fff;

}
@media (max-width: 991px){

.margin-table
{
  margin-top:15%;
  margin-bottom:10%;
}

}
.indicat{
  border-bottom: 2px  solid black !important;
}
.tabs.tabs-transparent .indicator {
    background-color: none !important;
    background: none !important;
}
#notifications-dropdown{
  margin-right:22%;
}

li#clearNotification
{
  text-align:right;
  font-size:14px;
  /* margin-top: 25%; */
}

li#clearNotification a
{
  font-size:14px;
}
@media only screen and (min-width: 991px) {
      .titleWidth
    {
      width:40%;
      height:400px;
      /* overflow-y:scroll; */

    }
    .titleWidth li{
      width:94%;

    } 
}

</style>



  </head>
  <!-- END: Head-->
  <body class="horizontal-layout page-header-light horizontal-menu 2-columns" data-open="click" data-menu="horizontal-menu" data-col="2-columns">
<?php if ($this->session->id):
    $id = $this->session->id;
    $this->load->database();
    $this->db->select('count(notification_status.id) AS count');
    $this->db->from('notification_status');
    $this->db->join('notification', 'notification_status.notification_id = notification.id');
    $where = array('notification_status.user_id' => $id, 'notification_status.status' => 0 );
    $result = $this->db->where($where)->get()->row_array();
    // echo $this->db->last_query();
    // pr($result);exit;

    $this->db->select('notification.*,notification_status.status AS status');
    $this->db->from('notification');
    $this->db->join('notification_status', 'notification_status.notification_id = notification.id','right');
    $where = ($this->session->user_type == 'ADMIN') ? array("$id") : array("ALL", "$id");
    $wherestatus = array('notification_status.status' => 0 ,'notification_status.user_id' => $this->session->id);
    $query = $this->db->where_in('notification.user_id', $where)->where($wherestatus)->order_by('notification.id', 'desc')->limit(4)->get()->result_array();
    // echo $this->db->last_query();
    // echo '<br>'.count($query);
    // echo pr($result);
    // exit;

endif;
?>
    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed">
        <nav class="grey darken-4" style="z-index:999">
          <div class="nav-wrapper">
            <ul class="left">
              <li>
                <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="<?php echo base_url(); ?>"><span class="logo-text"id="logoBlogging" >Blogging</span></a></h1>
              </li>
            </ul>
            <?php if ($this->router->fetch_method() != 'userBlogProfile' && $this->router->fetch_method() != 'detail'){?>
              <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons" id="searchIcon">search</i>
                <input class="header-search-input z-depth-2" type="text" id="searchBox" name="Search" placeholder="Search">
              </div>
            <?php } ?>
           
            <ul class="navbar-list right">
            <?php if ($this->session->id) {?>
              <li><a class="waves-effect waves-block waves-light  <?php echo (!empty($query))? 'notification-button':''; ?> countNotify" href="javascript:void(0);" data-target="notifications-dropdown">
              <i class="material-icons">notifications_none <small id="countNotify" class="<?php if ($result['count'] > 0) {echo "notification-badge orange accent-3";}?>">
              <?php if ($result['count'] > 0) {echo $result['count'];}?>
              </small></i></a></li>
              <?php }?>
              <?php if (!$this->session->id) {?>
               <!--  <li><a class=" headerButtonlog" href="<?php echo base_url(); ?>login" ><i class="material-icons" style="font-size:20pt;margin-left:-25%;">present_to_all</i></a></li> -->
              <li><a class=" headerButtonlog" href="<?php echo base_url(); ?>login">Sign in</a></li> 
              <!-- <li><a class=" btn  cyan headerButtonsign" style=" text-transform: none;" href="<?php echo base_url(); ?>users/registration">Sign up </a></li> -->
              <?php }?>
              <?php if ($this->session->id) {?>
              <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li>
              <?php }?>
            </ul>
          </div>
        </nav>
<?php if ((($this->router->fetch_class() == 'blog' && ($this->router->fetch_method() == 'index'))) || ($this->router->fetch_method() == 'landingPage') ): ?>
   <!-- BEGIN: Horizontal nav start-->
  <nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="" class="brand-logo">Logo</a>
      <a href="" data-target="mobile-demo" class="right sidenav-trigger"><i class=" material-icons">menu</i></a>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab headertabAll <?php if ($this->uri->segment(3) == '0' || $this->uri->segment(3) == '') {echo 'indicat';}?>" data-category="0"><a href="<?php echo base_url(); ?>"><span id="0">All</span></a></li>
        <li class="tab headertab <?php if ($this->uri->segment(3) == '1') {echo 'indicat';}?>" data-category="1"><a href="<?php echo base_url(); ?>blog/index/1"><span id="1">Technology</span></a></li>
        <li class="tab headertab <?php if ($this->uri->segment(3) == '2') {echo 'indicat';}?>" data-category="2"><a href="<?php echo base_url(); ?>blog/index/2"><span id="2">Food</span></a></li>
        <li class="tab headertab <?php if ($this->uri->segment(3) == '3') {echo 'indicat';}?>" data-category="3"><a href="<?php echo base_url(); ?>blog/index/3"><span id="3">Entertainment</span></a></li>
        <li class="tab headertab <?php if ($this->uri->segment(3) == '4') {echo 'indicat';}?>" data-category="4"><a href="<?php echo base_url(); ?>blog/index/4"><span id="4">Fashion</span></a></li>
        <li class="tab headertab <?php if ($this->uri->segment(3) == '5') {echo 'indicat';}?>" data-category="5"><a href="<?php echo base_url(); ?>blog/index/5"><span id="5">Health</span></a></li>
      </ul>
    </div>
  </nav>
  <script>
$(document).ready(function() {
  
  $(".headertabAll").click(function() {
      window.location.href = BASE_URL;
    });
    $(".headertab").click(function() {
      window.location.href = BASE_URL+"blog/index/"+$(this).data("category");
    });
});

</script>
  <?php endif;?>
      <!--
        END: Horizontal nav start-->

        <!-- notifications-dropdown-->
        <ul class="dropdown-content titleWidth" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge secondNotificationcount"><?php echo ($result['count'] > 0) ?  $result['count'].' ':''; ?> </span></h6>
              </li>
              <li class="divider"></li>
              <?php
foreach ($query as $key => $value) {
    ?>
                        <li class="mainList" data-notificationsid="<?php echo $value['id']; ?>">
                        <a href="<?php echo base_url().$value['url']; ?>"  rel="noopener noreferrer">
                                <div class="grey-text text-darken-2 valign-wrapper">
                                <span class="material-icons icon-bg-circle cyan small ">message</span>
                                <span class="pl-2 ">
                              <?php echo $value['title']; ?>
                      </span>
                    </div>
                      <time class="media-meta" datetime="2015-06-12T20:50:48+08:00"><?php echo date_format(date_create($value['added_on']), table_date); ?>
                     </time>  
                     </a>           
                    </li>
              <?php
}
?>
            <?php if(count($query) > $result['count']) {?>
              <li class="center-align waves-effect btn-flat" id="moreNotification">
                More Notification
              </li>  
            <?php }?>
              <li class="right-align waves-effect btn-flat" id="clearNotification">
                <a href="<?php echo base_url(); ?>users/clearNotification">
                  Clear Notification
                </a> 

              </li>  
          </ul>

      </div>
    </header>
    <!-- END: Header-->

<script>
  $(document).ready(function () {
      $(document).on("click",'#moreNotification', function () {
        var lastNotifiactionId = '';
              $('#moreNotification').html("Loading...");
             var lastNotifiactionId =  $('ul#notifications-dropdown li:nth-last-child(2)').attr('data-notificationsid');

              $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/allNotification",
                data: {
                    id:lastNotifiactionId
                },
                dataType: "json",
                success: function (data) {
                  console.log(data);
                  
                  if(data != '')  
                     {  
                          $('li#moreNotification').remove();
                          $('ul#notifications-dropdown').append(data.msg);  
                         
                     }  
                     else  
                     {  
                          $('#moreNotification').text(" ");  
                     } 
                      
                }
              }); 
      });
  });
</script>

<script type="text/javascript">
var timeout = 1500; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);

</script>

