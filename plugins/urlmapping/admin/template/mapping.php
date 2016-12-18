<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php if ($page1 == "s") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function() {
      $.notify({
        // options
        message: '<?php echo $tl["general"]["g7"];?>',
      }, {
        // settings
        type: 'success',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } if ($page1 == "e" || $page1 == "ene") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function() {
      $.notify({
        // options
        message: '<?php echo ($page1 == "e" ? $tl["errorpage"]["sql"] : $tl["errorpage"]["not"]);?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="box">
      <div class="box-body no-padding">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th><input type="checkbox" id="jak_delete_all"/></th>
              <th><?php echo $tlum["um"]["d"]; ?></th>
              <th><?php echo $tlum["um"]["d1"]; ?></th>
              <th><?php echo $tlum["um"]["d3"]; ?></th>
              <th><?php echo $tlum["um"]["d2"]; ?></th>
              <th><?php echo $tl["general_cmd"]["g9"]; ?></th>
              <th>
                <button type="submit" name="lock" id="button_lock" class="btn btn-default btn-xs">
                  <i class="fa fa-check"></i>
                </button>
              </th>
              <th></th>
              <th>
                <button type="submit" name="delete" id="button_delete" class="btn btn-danger btn-xs" onclick="if(!confirm('<?php echo $tlum["um"]["al"]; ?>'))return false;">
                  <i class="fa fa-trash-o"></i>
                </button>
              </th>
            </tr>
            </thead>
            <?php if (isset($JAK_UM_ALL) && is_array($JAK_UM_ALL)) foreach ($JAK_UM_ALL as $v) { ?>
              <tr>
                <td><?php echo $v["id"]; ?></td>
                <td><input type="checkbox" name="jak_delete_urlmapping[]" class="highlight" value="<?php echo $v["id"]; ?>"/></td>
                <td><a href="index.php?p=urlmapping&amp;sp=edit&amp;ssp=<?php echo $v["id"]; ?>"><?php echo $v["urlold"]; ?></a>
                </td>
                <td><a href="index.php?p=urlmapping&amp;sp=edit&amp;ssp=<?php echo $v["id"]; ?>"><?php echo $v["urlnew"]; ?></a>
                </td>
                <td><?php if ($v["redirect"] == '301') { echo $tlum["um"]["d4"]; } else { echo $tlum["um"]["d5"]; }?></td>
                <td><?php echo $v["time"]; ?></td>
                <td>
                  <?php
                  if ($v["active"] == 1) {
                    echo $tl["general_cmd"]["g10"];
                  } else {
                    echo $tl["general_cmd"]["g11"];
                  }
                  ?>
                </td>
                <td>
                  <a href="index.php?p=urlmapping&amp;sp=lock&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php if ($v["active"] == '0') { echo $tl["icons"]["i5"]; } else { echo $tl["icons"]["i6"]; } ?>">
                    <i class="fa fa-<?php if ($v["active"] == 0) { ?>lock<?php } else { ?>check<?php } ?>"></i>
                  </a>
                </td>
                <td>
                  <a href="index.php?p=urlmapping&amp;sp=edit&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tl["icons"]["i2"]; ?>">
                    <i class="fa fa-edit"></i>
                  </a>
                </td>
                <td>
                  <a href="index.php?p=urlmapping&amp;sp=delete&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs" data-confirm="<?php echo $tlum["um"]["del"]; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tl["icons"]["i1"]; ?>">
                    <i class="fa fa-trash-o"></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </form>

  <div class="icon_legend">
    <h3><?php echo $tl["icons"]["i"]; ?></h3>
    <i title="<?php echo $tl["icons"]["i6"]; ?>" class="fa fa-check"></i>
    <i title="<?php echo $tl["icons"]["i5"]; ?>" class="fa fa-lock"></i>
    <i title="<?php echo $tl["icons"]["i2"]; ?>" class="fa fa-edit"></i>
    <i title="<?php echo $tl["icons"]["i1"]; ?>" class="fa fa-trash-o"></i>
  </div>

  <!-- JavaScript for select all -->
  <script type="text/javascript">
    $(document).ready(function () {
      $("#jak_delete_all").click(function () {
        var checked_status = this.checked;
        $(".highlight").each(function () {
          this.checked = checked_status;
        });
      });
    });
  </script>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>