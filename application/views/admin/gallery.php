<div class="row">
  <div class="col s12 m12 l12" style="height:auto; width:80%; margin:4% 0% 0% 10%;">
    <div id="button-trigger" class="card card card-default scrollspy">
      <div class="card-content">
        <h class="card-title">Gallery</h4>
          <div class="col s12">
            <?php $i = 0;foreach ($gallery as $key => $value) {$i++?>
                <img src="<?php echo base_url($value['path']); ?>">
                    <?php }?>
          </div>
      </div>
    </div>
  </div>
</div>

