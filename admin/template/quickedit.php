<?php include "quickheader.php"; ?>

<?php if ($page3 == "s") { ?>
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
if ($page3 == "e") { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
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
<?php }
if ($errors) { ?>
  <script type="text/javascript">
    // Notification
    setTimeout(function () {
      $.notify({
        // options
        message: '<?php if (isset($errors["e"])) echo $errors["e"];
          if (isset($errors["e1"])) echo $errors["e1"];
          if (isset($errors["e2"])) echo $errors["e2"];?>',
      }, {
        // settings
        type: 'danger',
        delay: 5000,
      });
    }, 1000);
  </script>
<?php } ?>

  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <table class="table table-striped">
      <thead>
      <tr>
        <th colspan="2"><?php echo $tl["title"]["t13"]; ?></th>
      </tr>
      </thead>
      <tr>
        <td><?php echo $tl["page"]["p"]; ?></td>
        <td>
          <?php include_once "title_edit.php"; ?>
        </td>
      </tr>
    </table>

    <?php include_once "editorlight_edit.php"; ?>

    <hr>

    <button type="submit" name="save" class="btn btn-primary"><?php echo $tl["general"]["g20"]; ?></button>

  </form>

<?php include "quickfooter.php"; ?>