<style>
.footer-copyright{
        min-height:50px;
        padding: 10px 0 10px 0;
        color: rgba(255, 255, 255, .8) !important;
    }

    footer{
        /* position:fixed; */
        bottom:0;
        z-index:99999;
    }   
</style>
<!-- BEGIN: Footer-->      
<footer class="footer footer-dark grey darken-4 gradient-shadow navbar-border navbar-shadow">
    <div class="footer-copyright hide-on-small-only">
        <div class="container "><span>&copy; <?php echo date("Y"); ?> Blogging All rights reserved.</span>
        </div>
    </div>

    <div class="footer-copyright show-on-small hide-on-large-only">
    <div class="container  center-align"><span class="center-align">&copy; <?php echo date("Y"); ?> Blogging All rights reserved.</span><br>
        </div>
    </div>
</footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url(); ?>assets/js/vendors.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/scripts/data-tables.js" type="text/javascript"></script> -->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url(); ?>assets/vendors/chartjs/chart.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/chartist-js/chartist.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/chartist-js/chartist-plugin-tooltip.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?php echo base_url(); ?>assets/js/plugins.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom/custom-script.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/vendors/data-tables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/data-tables/js/dataTables.select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/formatter/jquery.formatter.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/dropify/js/dropify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts/advance-ui-modals.js" type="text/javascript"></script>

    <!--
        This JS is downloded.
        NOTE: This JS conflict with other UI LIKE TOOLTIP etx which is used in This materialize theme
    -->
    <!-- <script src="<?php echo base_url(); ?>assets/vendors/jquery-ui.js"></script>  -->



    <script src="<?php echo base_url(); ?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery-validation/additional-methods.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts/form-masks.js" type="text/javascript"></script>


    <!-- <script src="<?php echo base_url(); ?>assets/js/scripts/app-email.js" type="text/javascript"></script> -->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url(); ?>assets/js/scripts/data-tables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts/form-file-uploads.js"></script>

    <?php
if (is_file(FCPATH . 'assets/js/custom/' . $this->router->fetch_class() . '_' . $this->router->fetch_method() . '.js')) {
    echo '<script src="' . base_url() . 'assets/js/custom/' . $this->router->fetch_class() . '_' . $this->router->fetch_method() . '.js"></script>';
}
?>

<script src="<?php echo base_url(); ?>assets/css/jquery.blockUI.js"></script>
<script>
function loader()
      {
        $.blockUI({ css: { 
                border: 'none', 
                padding: '0px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: 0.6, 
                color: '#fff' 
            } }); 
      }


function taskDate(dateMilli) {
    var d = (new Date(dateMilli) + '').split(' ');
    d[2] = d[2] + ',';

    return [ d[1], d[2], d[3]].join(' ');
}

$('#page-length-option33').DataTable({
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: BASE_URL + 'blog/commentReportajax',
            type: 'POST',
            dataSrc: 'data'
        },
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ]
    });

</script>


<?php if(!isset($this->session->id)): ?>
<script>
$(document).ready(function () {
   
    $(document).on('click','.likeBtn', function () {
        // $('.likeBtn').addClass('sidenav-trigger');

        M.toast({
          html: 'Please Login'
         });

    });
    

});



</script>
<?php endif; ?>