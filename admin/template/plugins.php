<?php include "header.php"; ?>

<?php if ($page1 == "s") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php echo $tl["notification"]["n7"];?>',
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
				message: '<?php echo $tl["general_error"]["generror1"];?>',
			}, {
				// settings
				type: 'danger',
				delay: 5000,
			});
		}, 1000);
	</script>
<?php } ?>

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="row tab-content-singel">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<i class="fa fa-plug"></i>
						<h3 class="box-title"><?php echo $tl["plug_box_title"]["plugbt"]; ?></h3>
					</div>
					<div class="box-body">
						<ul class="jak_plugins_move">
							<?php if (isset($JAK_PLUGINS) && is_array ($JAK_PLUGINS)) foreach ($JAK_PLUGINS as $v) { ?>

								<li id="plugin-<?php echo $v["id"]; ?>" class="jakplugins">
									<div class="row sm-no-margin">
										<div class="col-md-1 col-xs-3 text">
											<span># </span>
											<a href="index.php?p=plugins&amp;sp=sorthooks&amp;ssp=<?php echo $v["id"]; ?>"><?php echo $v["id"]; ?></a>
										</div>
										<div class="col-md-2 col-xs-5 text plugins-name">
											<span title="<?php echo $v["description"]; ?>">
												<?php
												$name = $v["name"];
												echo "<strong>" . str_replace ('_', ' ', $name) . "</strong>";
												?>
											</span>
										</div>
										<div class="col-md-2 col-xs-4 text">
											<?php if ($v['pluginversion']) {
												echo '(' . sprintf ($tl["plug_box_content"]["plugbc6"], $v["pluginversion"]) . ')';
											} ?>
											<input type="hidden" name="real_id[]" value="<?php echo $v["id"]; ?>"/>
										</div>
										<div class="col-md-1 hidden-xs text text-center">
											<?php
											$filename = '../plugins/' . strtolower ($v["name"]) . '/help.php';

											if (file_exists ($filename)) {
												echo "<a class=\"plugHelp\" href=\"" . $filename . "\">" . $tl["plug_box_content"]["plugbc2"] . "</a>";
											} else {
												echo "-";
											}
											?>
										</div>
										<div class="col-md-4 hidden-xs show">
											<div class="form-group form-inline">
												<label><?php echo $tl["plug_box_content"]["plugbc"]; ?></label>
												<input type="text" class="form-control" name="access[]" value="<?php echo $v["access"]; ?>"/>
											</div>
										</div>
										<div class="col-md-2 hidden-xs actions">

											<?php if (isset($site_plugins) && is_array ($site_plugins)) foreach ($site_plugins as $p) {
												if (strtolower ($v["pluginpath"]) == strtolower ($p)) {

													$filename = '../plugins/' . $p . '/update.php';

													if (file_exists ($filename) && (strtotime ($v["time"]) < filemtime ($filename))) {
														echo '<a class="plugInst btn btn-success btn-xs" href="../plugins/' . $p . '/update.php" data-toggle="tooltip" data-placement="bottom" title="' . $tl["icons"]["i12"] . '"><i class="fa fa-clock-o"></i></a>';
													}

												}
											} ?>

											<a class="btn btn-default btn-xs" href="index.php?p=plugins&amp;sp=sorthooks&amp;ssp=<?php echo $v["id"]; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tl["icons"]["i13"]; ?>">
												<i class="fa fa-flag"></i>
											</a>
											<a class="btn btn-default btn-xs" href="index.php?p=plugins&amp;sp=lock&amp;ssp=<?php echo $v["id"]; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php if ($v["active"] == '0') {
												echo $tl["icons"]["i5"];
											} else {
												echo $tl["icons"]["i6"];
											} ?>">
												<i class="fa fa-<?php if ($v["active"] == '0') { ?>lock<?php } else { ?>check<?php } ?>"></i>
											</a>
											<?php if ($v["uninstallfile"]) { ?>
												<a class="plugInst btn btn-danger btn-xs" href="../plugins/<?php echo $v["pluginpath"] . '/' . $v["uninstallfile"]; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tl["icons"]["i1"]; ?>">
													<i class="fa fa-trash-o"></i>
												</a>
											<?php } ?>

										</div>
									</div>
								</li>

								<?php
								// Get the installed plugin in a array
								$installedp[] = strtolower ($v["pluginpath"]);
							} ?>
						</ul>
					</div>
				</div>
				<?php if (isset($site_plugins) && is_array ($site_plugins) && isset($installedp) && is_array ($installedp)) foreach ($site_plugins as $p) {
					if (!in_array (strtolower ($p), $installedp)) { ?>

						<div class="box box-default box-solid">
							<div class="box-header with-border">
								<i class="fa fa-plug"></i>
								<h3 class="box-title">
									<?php echo str_replace ('_', ' ', ucfirst ($p)); ?>
								</h3>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-3 col-sm-6">
												<?php echo $tl["plug_box_content"]["plugbc1"]; ?>:
												<a class="plugInst" href="../plugins/<?php echo $p; ?>/install.php"><?php echo str_replace ('_', ' ', ucfirst ($p)); ?></a>
											</div>
											<div class="col-md-9 col-sm-6">
												<?php echo $tl["plug_box_content"]["plugbc2"]; ?>:

												<?php
												$filename = '../plugins/' . $p . '/help.php';

												if (file_exists ($filename)) {
													echo "<a class=\"plugHelp\" href=\"" . $filename . "\">" . str_replace ('_', ' ', ucfirst ($p)) . "</a>";
												} else {
													echo $tl["plug_box_content"]["plugbc3"];
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php }
				} ?>

				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $tl["plug_box_title"]["plugbt1"]; ?></h3>
					</div>
					<div class="box-body">
						<div class="block">
							<div class="block-content">
								<div class="row-form">
									<div class="col-md-5"><strong><?php echo $tl["plug_box_content"]["plugbc4"]; ?></strong></div>
									<div class="col-md-7">
										<input type="text" name="jak_generala" class="form-control" value="<?php echo $jkv["accessgeneral"]; ?>"/>
									</div>
								</div>
								<div class="row-form">
									<div class="col-md-5"><strong><?php echo $tl["plug_box_content"]["plugbc5"]; ?></strong></div>
									<div class="col-md-7">
										<input type="text" name="jak_managea" class="form-control" value="<?php echo $jkv["accessmanage"]; ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" name="save" class="btn btn-success pull-right">
							<i class="fa fa-save margin-right-5"></i>
							<?php echo $tl["button"]["btn1"]; ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div class="col-md-12 m-b-30">
		<div class="icon_legend">
			<h3><?php echo $tl["icons"]["i"]; ?></h3>
			<i title="<?php echo $tl["icons"]["i12"]; ?>" class="fa fa-clock-o"></i>
			<i title="<?php echo $tl["icons"]["i13"]; ?>" class="fa fa-flag"></i>
			<i title="<?php echo $tl["icons"]["i6"]; ?>" class="fa fa-check"></i>
			<i title="<?php echo $tl["icons"]["i5"]; ?>" class="fa fa-lock"></i>
			<i title="<?php echo $tl["icons"]["i1"]; ?>" class="fa fa-trash-o"></i>
		</div>
	</div>

<?php include "footer.php"; ?>