<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php if ($page1 == "s") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php echo $tl["notification"]["n7"];?>'
      }, {
        // settings
        type: 'success',
        delay: 5000
      });
    }, 1000);
  </script>
<?php }
if ($page1 == "e" || $page1 == "ene") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php echo($page1 == "e" ? $tl["general_error"]["generror1"] : $tl["general_error"]["generror2"]);?>'
      }, {
        // settings
        type: 'danger',
        delay: 10000
      });
    }, 1000);
  </script>
<?php } ?>

  <!-- Fixed Button for save form -->
  <div class="savebutton-medium hidden-xs">

    <?php
    // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
    echo $Html->addAnchor('index.php?p=newsletter&sp=new', $tl["button"]["btn42"], '', 'btn btn-info button');
    ?>

  </div>

<?php if (isset($JAK_NEWSLETTER_ALL) && is_array($JAK_NEWSLETTER_ALL)) { ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="box box-success">
      <div class="box-body no-padding">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>
                <div class="checkbox-singel check-success">

                  <?php
                  // Add Html Element -> addCheckbox (Arguments: name, value, checked, id, class, optional assoc. array)
                  // Add Html Element -> addLabel (Arguments: for, label, optional assoc. array)
                  echo $Html->addCheckbox('', '', FALSE, 'jak_delete_all');
                  echo $Html->addLabel('jak_delete_all', '');
                  ?>

                </div>
              </th>
              <th><?php echo $tlnl["newsletter_box_table"]["nltb10"]; ?></th>
              <th><?php echo $tlnl["newsletter_box_table"]["nltb11"]; ?></th>
              <th><?php echo $tlnl["newsletter_box_table"]["nltb12"]; ?></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>

                <?php
                // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
                echo $Html->addButtonSubmit('delete', '<i class="fa fa-trash-o"></i>', 'button_delete', 'btn btn-danger btn-xs', array('disabled' => 'disabled', 'data-confirm-del' => $tlnl["newsletter_notification"]["delalln"]));
                ?>

              </th>
            </tr>
            </thead>
            <?php foreach ($JAK_NEWSLETTER_ALL as $v) { ?>
              <tr>
                <td><?php echo $v["id"]; ?></td>
                <td>
                  <div class="checkbox-singel check-success">

                    <?php
                    // Add Html Element -> addCheckbox (Arguments: name, value, checked, id, class, optional assoc. array)
                    // Add Html Element -> addLabel (Arguments: for, label, optional assoc. array)
                    echo $Html->addCheckbox('jak_delete_newsletter[]', $v["id"], FALSE, 'jak_delete_newsletter' . $v["id"], 'highlight');
                    echo $Html->addLabel('jak_delete_newsletter' . $v["id"], '');
                    ?>

                  </div>
                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html->addAnchor('index.php?p=newsletter&amp;sp=edit&amp;ssp=' . $v["id"], $v["title"]);
                  ?>

                </td>
                <td>

                  <?php if ($v["sent"]) {
                    echo $v["senttime"];
                  } else {
                    echo $tlnl["newsletter_box_content"]["nlbc20"];
                  } ?>

                </td>
                <td><?php echo date("d.m.Y - H:i:s", strtotime($v["time"])); ?></td>
                <td>

                  <?php
                  if ($v["sent"]) {

                    // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                    echo $Html->addAnchor('index.php?p=newsletter&amp;sp=stat&amp;ssp=' . $v["id"], '<i class="fa fa-bar-chart"></i>', '', 'btn btn-default btn-xs nlbox', array('data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i27"]));

                  }
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html->addAnchor('index.php?p=newsletter&amp;sp=preview&amp;ssp=' . $v["id"], '<i class="fa fa-desktop"></i>', '', 'btn btn-default btn-xs nlbox', array('data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i28"]));
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html->addAnchor('index.php?p=newsletter&amp;sp=send&amp;ssp=' . $v["id"], '<i class="fa fa-envelope-o"></i>', '', 'btn btn-default btn-xs', array('data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i29"]));
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html->addAnchor('index.php?p=newsletter&amp;sp=edit&amp;ssp=' . $v["id"], '<i class="fa fa-edit"></i>', '', 'btn btn-default btn-xs', array('data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i2"]));
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html->addAnchor('index.php?p=newsletter&amp;sp=delete&amp;ssp=' . $v["id"], '<i class="fa fa-trash-o"></i>', '', 'btn btn-default btn-xs', array('data-confirm' => sprintf($tlnl["newsletter_notification"]["deln"], $v["title"]), 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i1"]));
                  ?>

                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </form>

  <div class="col-md-12">
    <div class="icon_legend">

      <?php
      // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
      echo $Html->addTag('h3', $tl["icons"]["i"]);
      echo $Html->addTag('i', '', 'fa fa-bar-chart', array('title' => $tl["icons"]["i27"]));
      echo $Html->addTag('i', '', 'fa fa-desktop', array('title' => $tl["icons"]["i28"]));
      echo $Html->addTag('i', '', 'fa fa-envelope-o', array('title' => $tl["icons"]["i29"]));
      echo $Html->addTag('i', '', 'fa fa-edit', array('title' => $tl["icons"]["i2"]));
      echo $Html->addTag('i', '', 'fa fa-trash-o', array('title' => $tl["icons"]["i1"]));
      ?>

    </div>
  </div>

  <?php

  if ($JAK_PAGINATE) echo $JAK_PAGINATE;

} else { ?>

  <div class="col-md-12">

    <?php
    // Add Html Element -> addDiv (Arguments: $value, $id, optional assoc. array)
    echo $Html->addDiv($tl["general_error"]["generror3"], '', array('class' => 'alert bg-info text-white'));
    ?>

  </div>

<?php } ?>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>