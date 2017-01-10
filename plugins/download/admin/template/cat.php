<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php if ($page2 == "s") { ?>
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
if ($page2 == "e" || $page2 == "epc" || $page2 == "ech" || $page2 == "ene") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php if ($page2 == "e") {
					$tl["errorpage"]["sql"];
				} elseif ($page2 == "epc") {
					echo $tl["errorpage"]["pluginc"];
				} elseif ($page2 == "ene") {
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

<?php if ($page3 == "s") { ?>
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

<?php if (isset($JAK_DL_CAT_EXIST)) { ?>

	<div class="box box-default">
		<div class="box-header with-border">
			<i class="fa fa-bars"></i>
			<h3 class="box-title"><?php echo $tl["submenu"]["sm110"]; ?></h3>
		</div>
		<div class="box-body">

			<?php

			// Build menu for categories header and header/footer
			$lang   = $tl["cat"]["del"];
			$title1 = $tl["icons"]["i5"];
			$title2 = $tl["icons"]["i6"];
			$title3 = $tld["dload"]["d32"];
			$title4 = $tl["icons"]["i2"];
			$title5 = $tl["icons"]["i1"];

			echo jak_build_menu_download (0, $mheader, $lang, $title1, $title2, $title3, $title4, $title5, ' class="sortable jak_cat_move"', ' id="mheader"');

			?>

		</div>
		<div class="box-footer">
			<button type="submit" data-menu="mheader" name="save" class="btn btn-primary pull-right save-menu-plugin"><?php echo $tl["general"]["g20"]; ?></button>
		</div>
	</div>

<?php } else { ?>

	<div class="col-md-12">
		<div class="alert bg-info text-white">
			<?php echo $tl["errorpage"]["data"]; ?>
		</div>
	</div>
<?php } ?>

	<div class="icon_legend">
		<h3><?php echo $tl["icons"]["i"]; ?></h3>
		<i title="<?php echo $tl["icons"]["i7"]; ?>" class="fa fa-plus"></i>
		<i title="<?php echo $tl["icons"]["i6"]; ?>" class="fa fa-check"></i>
		<i title="<?php echo $tl["icons"]["i5"]; ?>" class="fa fa-lock"></i>
		<i title="<?php echo $tld["dload"]["d32"]; ?>" class="fa fa-sticky-note-o"></i>
		<i title="<?php echo $tl["icons"]["i2"]; ?>" class="fa fa-edit"></i>
		<i title="<?php echo $tl["icons"]["i1"]; ?>" class="fa fa-trash-o"></i>
	</div>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>