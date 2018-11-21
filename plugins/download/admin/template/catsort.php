<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php
// EN: Checking of some page was successful
// CZ: Kontrola některé stránky byla úspěšná
if ($page1 == "s") { ?>
  <script>
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?=$tl["notification"]["n7"]?>'
      }, {
        // settings
        type: 'success',
        delay: 5000
      });
    }, 1000);
  </script>
<?php } ?>

<?php
// EN: Checking of some page was unsuccessful
// CZ: Kontrola některé stránky byla neúspěšná
if ($page1 == "e" || $page1 == "ene") { ?>
  <script>
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

  <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
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
                  echo $Html -> addCheckbox('', '', FALSE, 'envo_delete_all');
                  echo $Html -> addLabel('envo_delete_all', '');
                  ?>

                </div>
              </th>
              <th><?= $tld["downl_box_table"]["downltb"] ?></th>
              <th><?= $tld["downl_box_table"]["downltb1"] ?></th>
              <th><?= $tld["downl_box_table"]["downltb2"] ?></th>
              <th><?= $tld["downl_box_table"]["downltb3"] ?></th>
              <th><?= $tld["downl_box_table"]["downltb6"] ?></th>
              <th>

                <?php
                // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
                echo $Html -> addButtonSubmit('lock', '<i class="fa fa-lock"></i>', 'button_lock', 'btn btn-default btn-xs');
                ?>

              </th>
              <th></th>
              <th>

                <?php
                // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
                echo $Html -> addButtonSubmit('delete', '<i class="fa fa-trash-o"></i>', 'button_delete', 'btn btn-danger btn-xs', array ( 'disabled' => 'disabled', 'data-confirm-del' => $tld["downl_notification"]["delall"], 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'left', 'title' => $tl["icons"]["i30"] ));
                ?>

              </th>
            </tr>
            </thead>
            <?php if (isset($ENVO_DOWNLOAD_SORT) && is_array($ENVO_DOWNLOAD_SORT)) foreach ($ENVO_DOWNLOAD_SORT as $v) { ?>
              <tr>
                <td><?= $v["id"] ?></td>
                <td>
                  <div class="checkbox-singel check-success">

                    <?php
                    // Add Html Element -> addCheckbox (Arguments: name, value, checked, id, class, optional assoc. array)
                    // Add Html Element -> addLabel (Arguments: for, label, optional assoc. array)
                    echo $Html -> addCheckbox('envo_delete_download[]', $v["id"], FALSE, 'envo_delete_download' . $v["id"], 'highlight');
                    echo $Html -> addLabel('envo_delete_download' . $v["id"], '');
                    ?>

                  </div>
                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html -> addAnchor('index.php?p=download&amp;sp=edit&amp;id=' . $v["id"], $v["title"]);

                  if ($v["password"]) {
                    // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
                    echo $Html -> addTag('i', '', 'fa fa-key');
                  }
                  ?>

                </td>
                <td>

                  <?php
                  if ($v["catid"] != '0') {
                    if (isset($ENVO_CAT) && is_array($ENVO_CAT)) foreach ($ENVO_CAT as $z) {
                      if ($v["catid"] == $z["id"]) {
                        // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                        echo $Html -> addAnchor('index.php?p=download&amp;sp=showcat&amp;id=' . $z["id"], $z["name"]);
                      }
                    }
                  } else {
                    echo $tld["downl_box_content"]["downlbc15"];
                  }
                  ?>

                </td>
                <td><?= date("d.m.Y - H:i:s", strtotime($v["time"])) ?></td>
                <td><?= $v["hits"] ?></td>
                <td><?= $v["countdl"] ?></td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html -> addAnchor('index.php?p=download&amp;sp=lock&amp;id=' . $v["id"], '<i class="fa fa-' . (($v["active"] == 0) ? 'lock' : 'check') . '"></i>', '', 'btn btn-default btn-xs', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => ($v["active"] == '0') ? $tl["icons"]["i5"] : $tl["icons"]["i6"] ));
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html -> addAnchor('index.php?p=download&amp;sp=edit&amp;id=' . $v["id"], '<i class="fa fa-edit"></i>', '', 'btn btn-default btn-xs', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i2"] ));
                  ?>

                </td>
                <td>

                  <?php
                  // Add Html Element -> addAnchor (Arguments: href_link, text, id, class, optional assoc. array)
                  echo $Html -> addAnchor('index.php?p=download&amp;sp=delete&amp;id=' . $v["id"], '<i class="fa fa-trash-o"></i>', '', 'btn btn-default btn-xs', array ( 'data-confirm' => sprintf($tld["downl_notification"]["del"], $v["title"]), 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i1"] ));
                  ?>

                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </form>

  <div class="col-sm-12">
    <div class="icon_legend">

      <?php
      // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
      echo $Html -> addTag('h3', $tl["icons"]["i"]);
      echo $Html -> addTag('i', '', 'fa fa-check', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i6"] ));
      echo $Html -> addTag('i', '', 'fa fa-key', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i14"] ));
      echo $Html -> addTag('i', '', 'fa fa-lock', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i5"] ));
      echo $Html -> addTag('i', '', 'fa fa-edit', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i2"] ));
      echo $Html -> addTag('i', '', 'fa fa-trash-o', array ( 'data-toggle' => 'tooltipEnvo', 'data-placement' => 'bottom', 'title' => $tl["icons"]["i1"] ));
      ?>

    </div>
  </div>

<?php if ($ENVO_PAGINATE) echo $ENVO_PAGINATE; ?>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>