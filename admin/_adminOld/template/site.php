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
if ($page1 == "e") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php echo $tl["errorpage"]["sql"]; ?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php }
if ($errors) { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php if (isset($errors["e"])) echo $errors["e"];
          if (isset($errors["e1"])) echo $errors["e1"];
          if (isset($errors["e2"])) echo $errors["e2"]; ?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <!-- Fixed Button for save form -->
    <div class="savebutton">
      <button type="submit" name="save" class="btn btn-primary button">
        <i class="fa fa-save margin-right-5"></i>
        <?php echo $tl["button"]["btn1"]; ?> !!
      </button>
    </div>

    <!-- Form Content -->
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $tl["site_box_title"]["sitebt"]; ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="block">
              <div class="block-content">
                <div class="row-form">
                  <div class="col-md-5 col-xs-6"><strong><?php echo $tl["site_box_content"]["sitebc"]; ?></strong></div>
                  <div class="col-md-7 col-xs-6">
                    <div class="radio">
                      <label class="checkbox-inline">
                        <input type="radio" name="jak_online" value="1"<?php if ($jkv["offline"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["checkbox"]["chk"]; ?>
                      </label>
                      <label class="checkbox-inline">
                        <input type="radio" name="jak_online" value="0"<?php if ($jkv["offline"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["checkbox"]["chk1"]; ?>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc1"]; ?></strong></div>
                  <div class="col-md-7">
                    <select name="jak_offpage" class="form-control selectpicker" data-live-search="true" data-size="5">
                      <option value="0"<?php if ($jkv["offline_page"] == 0) { ?> selected="selected"<?php } ?>><?php echo $tl["selection"]["sel"]; ?></option>
                      <?php if (isset($JAK_CAT) && is_array($JAK_CAT)) foreach ($JAK_CAT as $c) {
                        if ($c["pluginid"] == '0' && $c["pageid"] > '0') { ?>
                          <option value="<?php echo $c["id"]; ?>"<?php if ($jkv["offline_page"] == $c["id"]) { ?> selected="selected"<?php } ?>><?php echo $c["name"]; ?></option><?php }
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc2"]; ?></strong></div>
                  <div class="col-md-7">
                    <select name="jak_pagenotfound" class="form-control selectpicker" data-live-search="true" data-size="5">
                      <option value="0"<?php if ($jkv["notfound_page"] == 0) { ?> selected="selected"<?php } ?>><?php echo $tl["selection"]["sel"]; ?></option>
                      <?php if (isset($JAK_CAT) && is_array($JAK_CAT)) foreach ($JAK_CAT as $nf) {
                        if ($nf["pluginid"] == '0' && $nf["pageid"] > '0') { ?>
                          <option value="<?php echo $nf["id"]; ?>"<?php if ($jkv["notfound_page"] == $nf["id"]) { ?> selected="selected"<?php } ?>><?php echo $nf["name"]; ?></option><?php }
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="save" class="btn btn-primary pull-right">
              <i class="fa fa-save margin-right-5"></i>
              <?php echo $tl["button"]["btn1"]; ?>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $tl["site_box_title"]["sitebt"]; ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="block">
              <div class="block-content">
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc3"]; ?></strong></div>
                  <div class="col-md-7">
                    <div class="form-group no-margin <?php if (isset($errors["e2"])) echo "has-error"; ?>">
                      <input type="text" name="jak_title" id="sitetitle" class="form-control" value="<?php echo $jkv["title"]; ?>"/>
                    </div>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc4"]; ?></strong></div>
                  <div class="col-md-7">
                    <input type="text" name="jak_description" id="metadesc" class="form-control" value="<?php echo $jkv["metadesc"]; ?>"/>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-12">
                    <label for=""><strong><?php echo $tl["site_box_content"]["sitebc5"]; ?></strong></label>
                    <input type="text" name="jak_keywords" id="metakey" class="form-control" value="<?php echo $jkv["metakey"]; ?>"/>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc6"]; ?></strong></div>
                  <div class="col-md-7">
                    <input type="text" name="jak_author" id="metaauthor" class="form-control" value="<?php echo $jkv["metaauthor"]; ?>"/>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc7"]; ?></strong></div>
                  <div class="col-md-7">
                    <div class="radio">
                      <label class="checkbox-inline">
                        <input type="radio" name="jak_robots" value="1"<?php if ($jkv["robots"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["checkbox"]["chk"]; ?>
                      </label>
                      <label class="checkbox-inline">
                        <input type="radio" name="jak_robots" value="0"<?php if ($jkv["robots"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["checkbox"]["chk1"]; ?>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row-form">
                  <div class="col-md-5"><strong><?php echo $tl["site_box_content"]["sitebc8"]; ?></strong></div>
                  <div class="col-md-7">
                    <textarea name="jak_copy" id="copyright" class="form-control" rows="1"><?php echo $jkv["copyright"]; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="save" class="btn btn-primary pull-right">
              <i class="fa fa-save margin-right-5"></i>
              <?php echo $tl["button"]["btn1"]; ?>
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="row-fluid" style="margin-top: 20px;">
      <div class="container-fluid">
        <h5><strong><?php echo $tl["site_box_content"]["sitebc"]; ?></strong></h5>
        <p>Přepnutí sítě do režimu Offline. Využíváme pro update webové sítě. Pro aktivaci, musíme vybrat stránku pro zobrazení v režimu offline. Pokud tak neučiníme, tak síť nepřejde do režimu offline. </p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc1"]; ?></strong></h5>
        <p>Výběr offline stránky. Offline stránka se zobrazí při aktivaci sítě do režimu offline. Můžeme tak vytvořit stránku např. "Comming Soon".</p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc2"]; ?></strong></h5>
        <p>Výběr chybové stránky. Pokud uživatel zadá chybný název stránky, CMS zobrazí chybovou stránku. V seznamu můžeme vybrat námi definovanou stránku. Pokud není nic vybráno, tak základní chybová hláška je 404.php v daném template.</p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc3"]; ?></strong></h5>
        <p>Základní jméno webové sítě. Zobrazí se v tagu <span class="text-primary-400">'title'</span> v každé stránce sítě.</p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc4"]; ?></strong></h5>
        <p><span class="text-danger-400">???</span></p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc5"]; ?></strong></h5>
        <p>Nastavení globálních klíčových slov. Slova jsou automaticky oddělena po stisknutí kláves:</p>
        <ul>
          <li>Mezerník</li>
          <li>Enter</li>
          <li>Znak ' , '</li>
        </ul>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc6"]; ?></strong></h5>
        <p>Meta tag se zobrazí v každé stránce webové sítě.</p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc7"]; ?></strong></h5>
        <p><span class="text-danger-400">???</span></p>

        <h5><strong><?php echo $tl["site_box_content"]["sitebc8"]; ?></strong></h5>
        <p>Text se zobrazí v zápatí stránek webové sítě. Lze používat i html kód.</p>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<?php include "footer.php"; ?>