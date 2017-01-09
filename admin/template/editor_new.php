<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $tl["global_text"]["globaltxt1"]; ?></h3>
  </div>
  <div class="box-body">
    <table class="table table-striped">
      <tr>
        <td>
          <?php if ($jkv["adv_editor"]) { ?>
            <div id="cover">
              <div class="cover-header">
                <a href="../js/editor/plugins/filemanager/dialog.php?ty e=0&editor=mce_0&lang=eng&fldr=&field_id=htmleditor" class="btn btn-primary btn-xs ifManager" title="Show Filemanager">
                  <i class="fa fa-files-o"></i>
                </a>
                <a href="#" id="resizeContainer" class="btn btn-primary btn-xs" title="<?php echo $tl["global_text"]["globaltxt4"]; ?>"><?php echo $tl["global_text"]["globaltxt4"]; ?></a>
                <a href="#" id="resizeContainerAndEditor" class="btn btn-primary btn-xs" title="<?php echo $tl["global_text"]["globaltxt5"]; ?>"><?php echo $tl["global_text"]["globaltxt5"]; ?></a>
              </div>
              <div id="editorContainer">
                <div id="htmleditor"></div>
              </div>
            </div>

            <textarea name="jak_content" class="form-control hidden" id="jak_editor"><?php if (isset($_REQUEST["jak_content"])) echo jak_edit_safe_userpost(htmlspecialchars($_REQUEST["jak_content"])); ?></textarea>
          <?php } else { ?>
            <textarea name="jak_content" class="form-control jakEditor" id="jakEditor" rows="40"><?php if (isset($_REQUEST["jak_content"])) echo jak_edit_safe_userpost($_REQUEST["jak_content"]); ?></textarea>
          <?php } ?>
        </td>
      </tr>
    </table>
  </div>
  <div class="box-footer">
    <button type="submit" name="save" class="btn btn-success pull-right">
      <i class="fa fa-save margin-right-5"></i>
      <?php echo $tl["button"]["btn1"]; ?>
    </button>
  </div>
</div>
<style type="text/css">
  #editorContainer {
    height: 500px;
    position: relative;
  }
  #htmleditor {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
  }
  #cover.active {
    position:fixed;
    top:0;
    left:0;
    background:#f4f4f4;
    z-index:1050;
    width:100%;
    height:100%;
    padding: 40px;
  }
  .cover-header {
    background:#ddd;
    padding: 10px;
    margin-bottom: 10px;
  }
</style>
<script type="text/javascript">
  var clicked = false;
  var resizeFirstEditor = function (resizeEditor) {
    var MeContainer = document.getElementById('cover');
    var feContainer = document.getElementById('editorContainer');

    MeContainer.classList.toggle("active");
    clicked = !clicked;
    if(resizeEditor) {
      editor.resize();
    }
  };

  var btn = document.getElementById('resizeContainer');
  btn.addEventListener('click', function () {
    resizeFirstEditor();
  });
  var btn = document.getElementById('resizeContainerAndEditor');
  btn.addEventListener('click', function () {
    resizeFirstEditor(true);
  });
</script>