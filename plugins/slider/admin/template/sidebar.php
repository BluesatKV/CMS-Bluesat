<select name="whatid_<?php echo $v["pluginid"]; ?>" class="form-control">
  <option
    value="0"<?php if (isset($pgh["whatid"]) && $pgh["whatid"] == 0 || isset($_REQUEST["whatid_" . $v["pluginid"]]) && $_REQUEST["whatid_" . $v["pluginid"]] == 0) { ?> selected="selected"<?php } ?>><?php echo $tl["cform"]["c18"]; ?></option>
  <?php if (isset($JAK_GET_SLIDER) && is_array($JAK_GET_SLIDER)) foreach ($JAK_GET_SLIDER as $las) { ?>
    <option value="<?php echo $las["id"]; ?>"<?php if (isset($pgh["whatid"]) && $las["id"] == $pgh["whatid"] || isset($_REQUEST["whatid_" . $v["pluginid"]]) && $_REQUEST["whatid_" . $v["pluginid"]] == $las["id"]) echo ' selected="selected"'; ?>><?php echo $las["title"]; ?></option><?php } ?>
</select>