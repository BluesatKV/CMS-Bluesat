<?php if (!isset($faq_exist)) { ?>

  <li class="jakcontent">
    <div class="form-group">
      <label class="control-label"><?php echo $tlf["faq"]["d27"]; ?></label>
      <div class="row">
        <div class="col-md-6">
          <select name="jak_showfaqorder" class="form-control selectpicker">
            <option value="ASC"<?php if (isset($_REQUEST["jak_showfaqorder"]) && $_REQUEST["jak_showfaqorder"] == "ASC") { ?> selected="selected"<?php } else { ?> selected="selected"<?php } ?>><?php echo $tl["general"]["g90"]; ?></option>
            <option value="DESC"<?php if (isset($_REQUEST["jak_showfaqorder"]) && $_REQUEST["jak_showfaqorder"] == "DESC") { ?> selected="selected"<?php } ?>><?php echo $tl["general"]["g91"]; ?></option>
          </select>
        </div>
        <div class="col-md-6">
          <select name="jak_showfaqmany" class="form-control selectpicker" data-size="5">
            <?php for ($i = 0; $i <= 10; $i++) { ?>
              <option value="<?php echo $i ?>"<?php if (isset($_REQUEST["jak_showfaqmany"]) && $_REQUEST["jak_showfaqmany"] == $i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label"><?php echo $tl["general"]["g68"]; ?></label>
      <select name="jak_showfaq[]" multiple="multiple" class="form-control">
        <option value="0"<?php if (isset($_REQUEST["jak_showfaq"]) && $_REQUEST["jak_showfaq"] && in_array(0, $_REQUEST["jak_showfaq"])) { ?> selected="selected"<?php } else { ?> selected="selected"<?php } ?>><?php echo $tl["cform"]["c18"]; ?></option>
        <?php if (isset($JAK_GET_FAQ) && is_array($JAK_GET_FAQ)) foreach ($JAK_GET_FAQ as $fq) { ?>
          <option value="<?php echo $fq["id"]; ?>"<?php if (isset($_REQUEST["jak_showfaq"]) && $_REQUEST["jak_showfaq"] && in_array($fq["id"], $_REQUEST["jak_showfaq"])) { ?> selected="selected"<?php } ?>><?php echo $fq["title"]; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="actions">

      <input type="hidden" name="corder_new[]" class="corder" value="3"/>
      <input type="hidden" name="real_plugin_id[]" value="<?php echo JAK_PLUGIN_FAQ; ?>"/>

    </div>
  </li>

<?php } ?>