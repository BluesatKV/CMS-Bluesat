<?php include "header.php"; ?>

<?php if ($page1 == "s") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
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
<?php }
if ($page1 == "e" || $page1 == "epc" || $page1 == "ech" || $page1 == "ene") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php if ($page1 == "e") {
          $tl["errorpage"]["sql"];
        } elseif ($page1 == "epc") {
          echo $tl["errorpage"]["pluginc"];
        } elseif ($page1 == "ene") {
          echo $tl["errorpage"]["not"];
        } else {
          echo $tl["errorpage"]["cat"];
        } ?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } ?>

<?php if ($page2 == "s") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        icon: 'fa fa-info-circle',
        message: '<?php echo $tl["notification"]["n2"]; ?>',
      }, {
        // settings
        type: 'info',
        delay: 5000,
        timer: 3000,
      });
    }, 2000);
  </script>
<?php } ?>


<?php if (isset($JAK_CAT1_EXIST) || isset($JAK_CAT2_EXIST) || isset($JAK_CAT3_EXIST)) { ?>

  <div class="row">
    <div class="col-md-6">
      <!-- Header or Header/Footer -->
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-bars"></i>
          <h3 class="box-title"><?php echo $tl["cat_box_title"]["catbt"]; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <?php if ($JAK_CAT1_EXIST) {

          // Build menu for categories header and header/footer
          $lang = $tl["cat_notification"]["del"]; // Notification
          $title1 = $tl["icons"]["i11"];  // Add page
          $title2 = $tl["icons"]["i10"];  //
          $title3 = $tl["icons"]["i8"];   //
          $title4 = $tl["icons"]["i2"];   // Edit
          $title5 = $tl["icons"]["i1"];   // Trash

          echo jak_build_menu_admin(0, $mheader, $lang, $title1, $title2, $title3, $title4, $title5, ' class="sortable jak_cat_move"', ' id="mheader"');

          } else { ?>

            <div class="alert bg-slate-300">
              <?php echo $tl["errorpage"]["data"]; ?>
            </div>

          <?php } ?>

        </div>
        <div class="box-footer">
          <button type="submit" data-menu="mheader" name="save" class="btn btn-primary pull-right save-menu"><?php echo $tl["general"]["g20"]; ?></button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <!-- Footer Only -->
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-clone"></i>
          <h3 class="box-title"><?php echo $tl["cat_box_title"]["catbt1"]; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <?php if ($JAK_CAT2_EXIST) {

          // Build menu for categories
          $lang = $tl["cat_notification"]["del"]; // Notification
          $title1 = $tl["icons"]["i11"];  // Add page
          $title2 = $tl["icons"]["i10"];  //
          $title3 = $tl["icons"]["i8"];   //
          $title4 = $tl["icons"]["i2"];   // Edit
          $title5 = $tl["icons"]["i1"];   // Trash

          echo jak_build_menu_admin(0, $mfooter, $lang, $title1, $title2, $title3, $title4, $title5, ' class="sortable jak_cat_move"', ' id="mfooter"');

          } else { ?>

            <div class="alert bg-slate-300">
              <?php echo $tl["errorpage"]["data"]; ?>
            </div>

          <?php } ?>

        </div>
        <div class="box-footer">
          <button type="submit" data-menu="mfooter" name="save" class="btn btn-primary pull-right save-menu"><?php echo $tl["general"]["g20"]; ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- Not Visible -->
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-clone"></i>
          <h3 class="box-title"><?php echo $tl["cat_box_title"]["catbt2"]; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php if ($JAK_CAT3_EXIST) {

            echo '<ul class="list-group">' . $ucatblank . '</ul>';

          } else { ?>

            <div class="alert bg-slate-300">
              <?php echo $tl["errorpage"]["data"]; ?>
            </div>

          <?php } ?>
        </div>
      </div>
    </div>
  </div>

<?php } else { ?>

  <div class="alert bg-info">
    <?php echo $tl["errorpage"]["data"]; ?>
  </div>

<?php } ?>

  <div class="icon_legend">
    <h3><?php echo $tl["icons"]["i"]; ?></h3>
    <i title="<?php echo $tl["icons"]["i7"]; ?>" class="fa fa-plus"></i>
    <i title="<?php echo $tl["icons"]["i9"]; ?>" class="fa fa-link"></i>
    <i title="<?php echo $tl["icons"]["i8"]; ?>" class="fa fa-eyedropper"></i>
    <i title="<?php echo $tl["icons"]["i10"]; ?>" class="fa fa-pencil"></i>
    <i title="<?php echo $tl["icons"]["i11"]; ?>" class="fa fa-sticky-note-o"></i>
    <i title="<?php echo $tl["icons"]["i2"]; ?>" class="fa fa-edit"></i>
    <i title="<?php echo $tl["icons"]["i1"]; ?>" class="fa fa-trash-o"></i>
  </div>

  <script src="js/catorder.js" type="text/javascript"></script>

<?php include "footer.php"; ?>