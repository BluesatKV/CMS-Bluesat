<?php include "header.php"; ?>

<?php if ($page2 == "e") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function() {
      $.notify({
        // options
        message: '<?php echo $tl["errorpage"]["sql"];?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } if ($errors) { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function() {
      $.notify({
        // options
        message: '<?php if (isset($errors["e"])) echo $errors["e"];
          if (isset($errors["e1"])) echo $errors["e1"];
          if (isset($errors["e2"])) echo $errors["e2"];
          if (isset($errors["e3"])) echo $errors["e3"];?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $tl["title"]["t9"]; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped">
              <tr>
                <td><?php echo $tl["user"]["u"]; ?></td>
                <td>
                  <div class="form-group no-margin">
                    <input type="text" name="jak_name" class="form-control"
                           value="<?php if (isset($_REQUEST["jak_name"])) echo $_REQUEST["jak_name"]; ?>"/>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $tl["user"]["u1"]; ?></td>
                <td>
                  <div class="form-group no-margin<?php if (isset($errors["e2"])) echo " has-error"; ?>">
                    <input type="text" name="jak_email" class="form-control"
                           value="<?php if (isset($_REQUEST["jak_email"])) echo $_REQUEST["jak_email"]; ?>"/>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $tl["user"]["u2"]; ?></td>
                <td>
                  <div class="form-group no-margin<?php if (isset($errors["e1"])) echo " has-error"; ?>">
                    <input class="form-control" type="text" name="jak_username"
                           value="<?php if (isset($_REQUEST["jak_username"])) echo $_REQUEST["jak_username"]; ?>"/>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $tl["menu"]["m9"]; ?></td>
                <td><select name="jak_usergroup" class="form-control">
                    <?php if (isset($JAK_USERGROUP_ALL) && is_array($JAK_USERGROUP_ALL)) foreach ($JAK_USERGROUP_ALL as $v) {
                      if ($v["id"] != "1") { ?>
                        <option value="<?php echo $v["id"]; ?>"<?php if (isset($_REQUEST["jak_usergroup"]) && $v["id"] == $_REQUEST["jak_usergroup"]) { ?> selected="selected"<?php } ?>><?php echo $v["name"]; ?></option><?php }
                    } ?>
                  </select></td>
              </tr>
              <tr>
                <td><?php echo $tl["user"]["u3"]; ?></td>
                <td>
                  <div class="radio">
                    <label>
                      <input type="radio" name="jak_access" value="1"
                             checked="checked"/> <?php echo $tl["general"]["g18"]; ?>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="jak_access" value="0"/> <?php echo $tl["general"]["g19"]; ?>
                    </label>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer">
            <button type="submit" name="save"
                    class="btn btn-primary pull-right"><?php echo $tl["general"]["g20"]; ?></button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $tl["title"]["t10"]; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped">
              <tr>
                <td><?php echo $tl["user"]["u4"]; ?></td>
                <td>
                  <div class="form-group no-margin<?php if (isset($errors["e3"])) echo " has-error"; ?>">
                    <input class="form-control" type="text" name="jak_password" id="check_password" value=""/>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $tl["user"]["u5"]; ?></td>
                <td>
                  <div class="form-group no-margin<?php if (isset($errors["e3"])) echo " has-error"; ?>">
                    <input class="form-control" type="text" name="jak_confirm_password" value=""/>
                  </div>
                </td>
              </tr>
              <tr>
                <td><?php echo $tl["user"]["u12"]; ?></td>
                <td>
                  <div class="progress">
                    <div id="jak_pstrength" class="progress-bar progress-bar-striped active" role="progressbar"
                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-footer">
            <button type="submit" name="save" class="btn btn-primary pull-right"><?php echo $tl["general"]["g20"]; ?></button>
          </div>
        </div>
      </div>
    </div>
    <?php if (isset($JAK_HOOK_ADMIN_USER) && is_array($JAK_HOOK_ADMIN_USER)) foreach ($JAK_HOOK_ADMIN_USER as $hsu) {
      include_once APP_PATH . $hsu['phpcode'];
    } ?>
  </form>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#check_password').keyup(function () {
        passwordStrength($(this).val());
      });
    });
  </script>

<?php include "footer.php"; ?>