<?php include_once APP_PATH . 'template/canvas/header.php'; ?>

<?php if ($PAGE_ACTIVE) { ?>
  <div class="alert bg-danger">
    <?php echo $tl["errorpage"]["ep"]; ?>
  </div>

<?php }
echo $PAGE_CONTENT; ?>

<?php include_once APP_PATH . 'template/canvas/footer.php'; ?>