<?php include_once APP_PATH . 'admin/template/header.php'; ?>

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
if ($page1 == "e" || $page1 == "ene") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php echo ($page1 == "e" ? $tl["general_error"]["generror1"] : $tl["general_error"]["generror2"]);?>',
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
		<!-- Fixed Button for save form -->
		<div class="savebutton">
			<button type="submit" name="save" class="btn btn-success button">
				<i class="fa fa-save margin-right-5"></i>
				<?php echo $tl["button"]["btn1"]; ?> !!
			</button>
		</div>

		<!-- Form Content -->
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<i class="fa fa-plus-square"></i>
						<h3 class="box-title"><?php echo $tlrf["reg_box_content"]["regbc10"]; ?></h3>
					</div>
					<div class="box-body">
						<ul class="cform_drag">
							<li id="cform_drag" class="ui-state-highlight big-drag">
								<div class="row">
									<div class="col-md-4">
										<?php echo $tlrf["reg_box_content"]["regbc17"]; ?>
										<input type="text" class="form-control jakread" readonly="readonly" name="jak_option[]">
									</div>
									<div class="col-md-2">
										<?php echo $tlrf["reg_box_content"]["regbc18"]; ?>
										<select name="jak_optiontype[]" class="form-control">
											<option value="1"><?php echo $tlrf["reg_box_content"]["regbc19"]; ?></option>
											<option value="2"><?php echo $tlrf["reg_box_content"]["regbc20"]; ?></option>
											<option value="3"><?php echo $tlrf["reg_box_content"]["regbc21"]; ?></option>
											<option value="4"><?php echo $tlrf["reg_box_content"]["regbc22"]; ?></option>
										</select>
									</div>
									<div class="col-md-3">
										<?php echo $tlrf["reg_box_content"]["regbc23"]; ?>
										<input type="text" class="form-control jakread" readonly="readonly" value="female,male" name="jak_options[]">
									</div>
									<div class="col-md-2">
										<?php echo $tlrf["reg_box_content"]["regbc24"]; ?>
										<select name="jak_optionmandatory[]" class="form-control">
											<option value="0"><?php echo $tl["checkbox"]["chk1"]; ?></option>
											<option value="1"><?php echo $tl["checkbox"]["chk"]; ?></option>
											<option value="2"><?php echo $tlrf["reg_box_content"]["regbc25"]; ?></option>
											<option value="3"><?php echo $tlrf["reg_box_content"]["regbc26"]; ?></option>
											<option value="4"><?php echo $tlrf["reg_box_content"]["regbc13"]; ?></option>
											<option value="5"><?php echo $tlrf["reg_box_content"]["regbc14"]; ?></option>
										</select>
										<input type="hidden" name="jak_optionsort[]" class="cforder-orig" value=""/>
									</div>
								</div>
							</li>
						</ul>

						<div class="callout callout-info">
							<i class="fa fa-arrow-up"></i> <?php echo $tlrf["reg_box_content"]["regbc27"]; ?>
							<i class="fa fa-arrow-down"></i>
						</div>

						<ul id="cform_sort">

							<?php if (isset($JAK_REGISTEROPTION_ALL) && is_array ($JAK_REGISTEROPTION_ALL)) foreach ($JAK_REGISTEROPTION_ALL as $o) { ?>

								<li class="jakcform">
									<div class="row">
										<div class="col-md-3">
											<?php echo $tlrf["reg_box_content"]["regbc17"]; ?>
											<input type="text" class="form-control" name="jak_option_old[]" value="<?php echo $o["name"]; ?>">
										</div>
										<div class="col-md-2">
											<?php echo $tlrf["reg_box_content"]["regbc18"]; ?>
											<select name="jak_optiontype_old[]" class="form-control">
												<option value="1"<?php if ($o["typeid"] == 1) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc19"]; ?></option>
												<option value="2"<?php if ($o["typeid"] == 2) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc20"]; ?></option>
												<option value="3"<?php if ($o["typeid"] == 3) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc21"]; ?></option>
												<option value="4"<?php if ($o["typeid"] == 4) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc22"]; ?></option>
											</select>
										</div>
										<div class="col-md-3">
											<?php echo $tlrf["reg_box_content"]["regbc23"]; ?>
											<input type="text" name="jak_options_old[]" class="form-control" value="<?php echo $o["options"]; ?>" placeholder="<?php echo $tlrf["reg_box_content"]["regbc15"]; ?>">
										</div>
										<div class="col-md-2">
											<?php echo $tlrf["reg_box_content"]["regbc24"]; ?>
											<select name="jak_optionmandatory_old[]" class="form-control">
												<option value="0"<?php if ($o["mandatory"] == 0) { ?> selected="selected"<?php } ?>><?php echo $tl["checkbox"]["chk1"]; ?></option>
												<option value="1"<?php if ($o["mandatory"] == 1) { ?> selected="selected"<?php } ?>><?php echo $tl["checkbox"]["chk"]; ?></option>
												<option value="2"<?php if ($o["mandatory"] == 2) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc25"]; ?></option>
												<option value="3"<?php if ($o["mandatory"] == 3) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc26"]; ?></option>
												<option value="4"<?php if ($o["mandatory"] == 4) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc13"]; ?></option>
												<option value="5"<?php if ($o["mandatory"] == 5) { ?> selected="selected"<?php } ?>><?php echo $tlrf["reg_box_content"]["regbc14"]; ?></option>
											</select>
										</div>
										<div class="col-md-1">
											<i class="fa fa-user-plus"></i>
											<select name="jak_showregister[]" class="form-control">
												<option value="0"<?php if ($o["showregister"] == 0) { ?> selected="selected"<?php } ?>><?php echo $tl["checkbox"]["chk1"]; ?></option>
												<option value="1"<?php if ($o["showregister"] == 1) { ?> selected="selected"<?php } ?>><?php echo $tl["checkbox"]["chk"]; ?></option>
											</select>
										</div>
										<div class="col-md-1">
											<?php if ($o["id"] > 3) { ?>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="jak_sod[]" value="<?php echo $o["id"]; ?>">
														<i class="fa fa-trash-o"></i>
													</label>
												</div>
											<?php } ?>
											<input type="hidden" name="jak_option_name_old[]" value="<?php echo $o["name"]; ?>"/>
											<input type="hidden" name="jak_optionsort_old[]" class="cforder" value="<?php echo $o["forder"]; ?>"/>
											<input type="hidden" name="jak_optionid[]" value="<?php echo $o["id"]; ?>"/>
										</div>
									</div>
								</li>

							<?php } ?>

						</ul>

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

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>