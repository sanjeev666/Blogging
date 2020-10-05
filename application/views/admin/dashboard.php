<body >
  <div id="main" style="min-height:100%;">
    <div class="row">
      <div class="col s12">
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

            <!-- card stats start -->
                      <div id="card-stats">
                        <div class="col s12 m6 l3">
                          <div class="card animate fadeLeft">
                              <div class="card-content red accent-2 white-text">
                                <p class="card-stats-title"><i class="material-icons"></i>Total Users</p>
                                <h4 class="card-stats-number white-text"><?php echo $total; ?></h4>
                                <p class="card-stats-compare">
                                    <i class="material-icons">keyboard_arrow_up</i> 70% <span class="red-text text-lighten-5">last month</span>
                                </p>
                              </div>
                              <div class="card-action card-content red accent-2">
                                <div id="sales-compositebar" class="center-align"></div>
                              </div>
                          </div>
                        </div>
                        <div class="col s12 m6 l3">
                          <div class="card animate fadeRight">
                              <div class="card-content orange lighten-1 white-text">
                                <p class="card-stats-title"><i class="material-icons">trending_up</i> Total Visitors</p>
                                <h4 class="card-stats-number white-text"><?php echo $total_visitor; ?></h4>
                                <p class="card-stats-compare">
                                    <i class="material-icons">keyboard_arrow_up</i> 80%
                                    <span class="orange-text text-lighten-5">from yesterday</span>
                                </p>
                              </div>
                              <div class="card-action card-content orange lighten-1">
                                <div id="profit-tristate" class="center-align"></div>
                              </div>
                          </div>
                        </div>
                        <div class="col s12 m6 l3">
                          <div class="card animate fadeRight">
                              <div class="card-content cyan white-text">
                                <p class="card-stats-title"><i class="material-icons">content_copy</i>Total Content</p>
                                <h4 class="card-stats-number white-text"><?php echo $totalContent; ?></h4>
                                <p class="card-stats-compare">
                                    <i class="material-icons">keyboard_arrow_down</i> 3%
                                    <span class="green-text text-lighten-5">from last month</span>
                                </p>
                              </div>
                              <div class="card-action card-content cyan">
                                <div id="invoice-line" class="center-align"></div>
                              </div>
                          </div>
                        </div>
                  </div>
                </div>
                <!--card stats end-->

                <!--work collections start-->
                <div id="work-collections">
                  <div class="row" style="margin-bottom: 20%;">

                  </div>
                </div>
                <!--work collections end-->
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">

var timeout = 1500; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);

</script>
