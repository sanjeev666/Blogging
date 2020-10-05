<table id="gallery" >
              <thead>
                <tr>
                  <th >Sr. No.</th>
                  <th>Picture</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0;foreach ($gallery as $key => $value) {$i++?>
                  <tr>
                    <td><?php echo $i; ?></td>
                      <td><img src="<?php echo base_url($value['path']); ?>"></td>
                  </tr>
                <?php }?>
              </tbody>
            </table>