<?php include "header.php"; ?>

<?php if ($page2 == "e") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php echo $tl["general_error"]["generror1"];?>',
			}, {
				// settings
				type: 'danger',
				delay: 10000,
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
					if (isset($errors["e2"])) echo $errors["e2"];
					if (isset($errors["e3"])) echo $errors["e3"];?>',
			}, {
				// settings
				type: 'danger',
				delay: 10000,
			});
		}, 1000);
	</script>
<?php } ?>

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<!-- Fixed Button for save form -->
		<div class="savebutton hidden-xs">

			<?php
			// Add Html Element -> addButtonSubmit (Arguments: name, id, class, value, optional assoc. array)
			echo $htmlE->addButtonSubmit('save', '', 'btn btn-success button', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"] . ' !! ');
			?>

		</div>

		<!-- Form Content -->
		<div class="row tab-content-singel">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $tl["hook_box_title"]["hookbt1"]; ?></h3>
					</div>
					<div class="box-body">
						<div class="block">
							<div class="block-content">
								<div class="row-form">
									<div class="col-md-5">

										<?php
										// Add Html Element -> startTag (Arguments: tag, optional assoc. array)
										// Add Html Element -> endTag (Arguments: tag)
										echo $htmlE->startTag('strong') . $tl["hook_box_content"]["hookbc"] . $htmlE->endTag('strong');
										echo $htmlE->startTag('span', array ('class' => 'star-item text-danger-800 m-l-10')) . '*' . $htmlE->endTag('span');
										?>

									</div>
									<div class="col-md-7">
										<div class="form-group no-margin<?php if (isset($errors["e1"])) echo " has-error"; ?>">

											<?php
											// Add Html Element -> Input (Arguments: type, name, id, class, value, checked-only for radio input)
											echo $htmlE->addInput ('text', 'jak_name', '', 'form-control', $_REQUEST["jak_name"], '');
											?>

										</div>
									</div>
								</div>
								<div class="row-form">
									<div class="col-md-5">

										<?php
										// Add Html Element -> startTag (Arguments: tag, optional assoc. array)
										// Add Html Element -> endTag (Arguments: tag)
										echo $htmlE->startTag('strong') . $tl["hook_box_content"]["hookbc1"] . $htmlE->endTag('strong');
										echo $htmlE->startTag('span', array ('class' => 'star-item text-danger-800 m-l-10')) . '*' . $htmlE->endTag('span');
										?>

									</div>
									<div class="col-md-7">
										<div class="form-group no-margin<?php if (isset($errors["e2"])) echo " has-error"; ?>">
											<select name="jak_hook" class="form-control selectpicker" data-live-search="true" data-size="5">
												<option value="0" selected="selected"><?php echo $tl["selection"]["sel7"]; ?></option>
												<?php if (isset($JAK_HOOK_LOCATIONS) && is_array ($JAK_HOOK_LOCATIONS)) foreach ($JAK_HOOK_LOCATIONS as $h) { ?>
													<option value="<?php echo $h; ?>"><?php echo $h; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row-form">
									<div class="col-md-5">

										<?php
										// Add Html Element -> startTag (Arguments: tag, optional assoc. array)
										// Add Html Element -> endTag (Arguments: tag)
										echo $htmlE->startTag('strong') . $tl["hook_box_content"]["hookbc2"] . $htmlE->endTag('strong');
										?>

									</div>
									<div class="col-md-7">
										<select name="jak_plugin" class="form-control selectpicker" data-live-search="true" data-size="5">
											<option value="0" selected="selected"><?php echo $tl["cform"]["c18"]; ?></option>
											<?php if (isset($JAK_PLUGINS) && is_array ($JAK_PLUGINS)) foreach ($JAK_PLUGINS as $p) { ?>
												<option value="<?php echo $p["id"]; ?>"><?php echo $p["name"]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="row-form">
									<div class="col-md-5">

										<?php
										// Add Html Element -> startTag (Arguments: tag, optional assoc. array)
										// Add Html Element -> endTag (Arguments: tag)
										echo $htmlE->startTag('strong') . $tl["hook_box_content"]["hookbc3"] . $htmlE->endTag('strong');
										echo $htmlE->startTag('span', array ('class' => 'star-item text-danger-800 m-l-10')) . '*' . $htmlE->endTag('span');
										?>

									</div>
									<div class="col-md-7">
										<div class="form-group no-margin<?php if (isset($errors["e3"])) echo " has-error"; ?>">

											<?php
											// Add Html Element -> Input (Arguments: type, name, id, class, value, checked-only for radio input)
											(isset($_REQUEST["jak_exorder"]) && (!empty($_REQUEST["jak_exorder"]))) ? $value = $_REQUEST["jak_exorder"] : $value = '4';
											echo $htmlE->addInput ('text', 'jak_exorder', '', 'form-control', $value, '', array ('maxlength' => '5'));
											?>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">

						<?php
						// Add Html Element -> addButtonSubmit (Arguments: name, id, class, value, optional assoc. array)
						echo $htmlE->addButtonSubmit('save', '', 'btn btn-success pull-right', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"]);
						?>

					</div>
				</div>
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $tl["hook_box_title"]["hookbt2"]; ?></h3>
					</div>
					<div class="box-body">

						<?php
						// Add Html Element -> addSimpleDiv (Arguments: id, value, optional assoc. array)
						echo $htmlE->addSimpleDiv ('htmleditor', '');
						// Add Html Element -> Textarea (Arguments: name, rows, cols, value, optional assoc. array)
						echo $htmlE->addTextArea ('jak_phpcode', '', '', $_REQUEST["jak_phpcode"], array ('id' => 'jak_phpcode', 'class' => 'form-control hidden'));
						?>

					</div>
					<div class="box-footer">

						<?php
						// Add Html Element -> addButtonSubmit (Arguments: name, id, class, value, optional assoc. array)
						echo $htmlE->addButtonSubmit('save', '', 'btn btn-success pull-right', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"]);
						?>

					</div>
				</div>
			</div>
		</div>
	</form>

<?php include "footer.php"; ?>