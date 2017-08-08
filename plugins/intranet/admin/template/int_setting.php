<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php
// EN: The data was successfully stored in DB
// CZ: Data byla úspěšně uložena do DB
if ($page2 == "s") { ?>
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
<?php } ?>

<?php
// EN: An error occurred while saving to DB
// CZ: Při ukládání do DB došlo k chybě
if ($page2 == "e") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php echo $tl["general_error"]["generror1"];?>'
      }, {
        // settings
        type: 'success',
        delay: 5000
      });
    }, 1000);
  </script>
<?php } ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <!-- Fixed Button for save form -->
    <div class="savebutton-small hidden-xs">

      <?php
      // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
      echo $Html->addButtonSubmit('btnSave', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"] . ' !! ', '', 'btn btn-success button', array('data-loading-text' => $tl["button"]["btn41"]));
      ?>

    </div>

    <!-- Form Content -->
    <ul class="nav nav-tabs nav-tabs-responsive nav-tabs-fillup" role="tablist">
      <li role="presentation" class="active">
        <a href="#cmsPage1" id="cmsPage1-tab" role="tab" data-toggle="tab" aria-controls="cmsPage1" aria-expanded="true">
          <span class="text"><?php echo $tlint["int_section_tab"]["inttab"]; ?></span>
        </a>
      </li>
      <li role="presentation" class="next">
        <a href="#cmsPage2" role="tab" id="cmsPage2-tab" data-toggle="tab" aria-controls="cmsPage2">
          <span class="text"><?php echo $tlint["int_section_tab"]["inttab1"]; ?></span>
        </a>
      </li>
      <li role="presentation">
        <a href="#cmsPage3" role="tab" id="cmsPage3-tab" data-toggle="tab" aria-controls="cmsPage3">
          <span class="text"><?php echo $tlint["int_section_tab"]["inttab2"]; ?></span>
        </a>
      </li>
      <li role="presentation">
        <a href="#cmsPage4" role="tab" id="cmsPage4-tab" data-toggle="tab" aria-controls="cmsPage4">
          <span class="text"><?php echo $tlint["int_section_tab"]["inttab3"]; ?></span>
        </a>
      </li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="cmsPage1" aria-labelledby="cmsPage1-tab">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">

                <?php
                // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
                echo $Html->addTag('h3', $tlint["int_box_title"]["intbt"], 'box-title');
                ?>

              </div>
              <div class="box-body">
                <div class="block">
                  <div class="block-content">
                    <div class="row-form">
                      <div class="col-md-5">

                        <?php
                        // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
                        echo $Html->addTag('strong', $tlint["int_box_content"]["intbc"]);
                        ?>

                      </div>
                      <div class="col-md-7">
                        <div class="form-group no-margin">

                          <?php
                          // Add Html Element -> addInput (Arguments: type, name, value, id, class, optional assoc. array)
                          echo $Html->addInput('text', 'envo_title', $JAK_SETTING_VAL["intranettitle"], '', 'form-control');
                          ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">

                <?php
                // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
                echo $Html->addButtonSubmit('btnSave', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"], '', 'btn btn-success pull-right', array('data-loading-text' => $tl["button"]["btn41"]));
                ?>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">

                <?php
                // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
                echo $Html->addTag('h3', $tlint["int_box_title"]["intbt1"], 'box-title');
                ?>

              </div>
              <div class="box-body">
                <div class="block">
                  <div class="block-content">
                    <div class="row-form">
                      <div class="col-md-5">

                        <?php
                        // Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
                        echo $Html->addTag('strong', $tlint["int_box_content"]["intbc1"]);
                        ?>

                      </div>
                      <div class="col-md-7">
                        <select name="envo_skin" class="form-control selectpicker">

                          <?php
                          // Add Html Element -> addOption (Arguments: value, text, selected, id, class, optional assoc. array)
                          echo $Html->addOption('', 'Default', ($JAK_SETTING_VAL["intranetskin"] == "") ? TRUE : FALSE);
                          echo $Html->addOption('header-dark', '<div class="header-brand color-brand bg-primary"></div> Dark', ($JAK_SETTING_VAL["intranetskin"] == "header-dark") ? TRUE : FALSE);
                          echo $Html->addOption('header-red', 'Red', ($JAK_SETTING_VAL["intranetskin"] == "header-red") ? TRUE : FALSE);
                          echo $Html->addOption('header-pink', 'Pink', ($JAK_SETTING_VAL["intranetskin"] == "header-pink") ? TRUE : FALSE);
                          echo $Html->addOption('header-purple', 'Purple', ($JAK_SETTING_VAL["intranetskin"] == "header-purple") ? TRUE : FALSE);
                          echo $Html->addOption('header-deeppurple', 'Deeppurple', ($JAK_SETTING_VAL["intranetskin"] == "header-deeppurple") ? TRUE : FALSE);
                          echo $Html->addOption('header-indigo', 'Indigo', ($JAK_SETTING_VAL["intranetskin"] == "header-indigo") ? TRUE : FALSE);
                          echo $Html->addOption('header-blue', 'Blue', ($JAK_SETTING_VAL["intranetskin"] == "header-blue") ? TRUE : FALSE);
                          echo $Html->addOption('header-lightblue', 'Lightblue', ($JAK_SETTING_VAL["intranetskin"] == "header-lightblue") ? TRUE : FALSE);
                          echo $Html->addOption('header-cyan', 'Cyan', ($JAK_SETTING_VAL["intranetskin"] == "header-cyan") ? TRUE : FALSE);
                          echo $Html->addOption('header-teal', 'Teal', ($JAK_SETTING_VAL["intranetskin"] == "header-teal") ? TRUE : FALSE);
                          echo $Html->addOption('header-green', 'Green', ($JAK_SETTING_VAL["intranetskin"] == "header-green") ? TRUE : FALSE);
                          echo $Html->addOption('header-lightgreen', 'Lightgreen', ($JAK_SETTING_VAL["intranetskin"] == "header-lightgreen") ? TRUE : FALSE);
                          echo $Html->addOption('header-lime', 'Lime', ($JAK_SETTING_VAL["intranetskin"] == "header-lime") ? TRUE : FALSE);
                          echo $Html->addOption('header-yellow', 'Yellow', ($JAK_SETTING_VAL["intranetskin"] == "header-yellow") ? TRUE : FALSE);
                          echo $Html->addOption('header-amber', 'Amber', ($JAK_SETTING_VAL["intranetskin"] == "header-amber") ? TRUE : FALSE);
                          echo $Html->addOption('header-orange', 'Orange', ($JAK_SETTING_VAL["intranetskin"] == "header-orange") ? TRUE : FALSE);
                          echo $Html->addOption('header-deeporange', 'Deeporange', ($JAK_SETTING_VAL["intranetskin"] == "header-deeporange") ? TRUE : FALSE);
                          echo $Html->addOption('header-brown', 'Brown', ($JAK_SETTING_VAL["intranetskin"] == "header-brown") ? TRUE : FALSE);
                          echo $Html->addOption('header-grey', 'Grey', ($JAK_SETTING_VAL["intranetskin"] == "header-grey") ? TRUE : FALSE);
                          echo $Html->addOption('header-bluegrey', 'Bluegrey', ($JAK_SETTING_VAL["intranetskin"] == "header-bluegrey") ? TRUE : FALSE);
                          ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">

                <?php
                // Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
                echo $Html->addButtonSubmit('btnSave', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"], '', 'btn btn-success pull-right', array('data-loading-text' => $tl["button"]["btn41"]));
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="cmsPage2" aria-labelledby="cmsPage2-tab">
        <div class="row">

        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="cmsPage3" aria-labelledby="cmsPage3-tab">
        <div class="row">

        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="cmsPage4" aria-labelledby="cmsPage4-tab">
        <div class="row">

        </div>
      </div>
    </div>
  </form>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>