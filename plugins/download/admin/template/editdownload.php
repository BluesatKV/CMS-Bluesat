<?php include_once APP_PATH . 'admin/template/header.php'; ?>

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
		<!-- Fixed Button for save form -->
		<div class="savebutton">
			<button type="submit" name="save" class="btn btn-primary button">
				<i class="fa fa-save margin-right-5"></i>
				<?php echo $tl["general"]["g20"]; ?> !!
			</button>
		</div>

		<!-- Form Content -->
		<ul id="cmsTab" class="nav nav-tabs nav-tabs-responsive nav-tabs-fillup" role="tablist">
			<li role="presentation" class="active">
				<a href="#cmsPage1" id="cmsPage1-tab" role="tab" data-toggle="tab" aria-controls="cmsPage1" aria-expanded="true">
					<span class="text"><?php echo $tl["page"]["p4"]; ?></span>
				</a>
			</li>
			<li role="presentation" class="next">
				<a href="#cmsPage2" role="tab" id="cmsPage2-tab" data-toggle="tab" aria-controls="cmsPage2">
					<span class="text"><?php echo $tl["title"]["t14"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage3" role="tab" id="cmsPage3-tab" data-toggle="tab" aria-controls="cmsPage3">
					<span class="text"><?php echo $tl["general"]["g53"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage4" role="tab" id="cmsPage4-tab" data-toggle="tab" aria-controls="cmsPage4">
					<span class="text"><?php echo $tl["general"]["g100"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage5" role="tab" id="cmsPage5-tab" data-toggle="tab" aria-controls="cmsPage5">
					<span class="text"><?php echo $tl["general"]["g89"]; ?></span>
				</a>
			</li>
		</ul>

		<div id="cmsTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="cmsPage1" aria-labelledby="cmsPage1-tab">
				<div class="row">
					<div class="col-md-7">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["title"]["t13"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tld["dload"]["d8"]; ?></strong></div>
											<div class="col-md-7">
												<?php include_once APP_PATH . "admin/template/title_edit.php"; ?>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["page"]["p3"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_showtitle" value="1"<?php if ($JAK_FORM_DATA["showtitle"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_showtitle" value="0"<?php if ($JAK_FORM_DATA["showtitle"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<?php if ($JAK_CONTACT_FORM) { ?>
											<div class="row-form">
												<div class="col-md-5"><strong><?php echo $tl["page"]["p7"]; ?></strong></div>
												<div class="col-md-7">
													<select name="jak_showcontact" class="form-control selectpicker">
														<option value="0"<?php if ($JAK_FORM_DATA["showcontact"] == '0') { ?> selected="selected"<?php } ?>><?php echo $tl["cform"]["c18"]; ?></option>
														<?php if (isset($JAK_CONTACT_FORMS) && is_array ($JAK_CONTACT_FORMS)) foreach ($JAK_CONTACT_FORMS as $cf) { ?>
															<option value="<?php echo $cf["id"]; ?>"<?php if ($cf["id"] == $JAK_FORM_DATA["showcontact"]) { ?> selected="selected"<?php } ?>><?php echo $cf["title"]; ?></option><?php } ?>
													</select>
												</div>
											</div>
										<?php } ?>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["page"]["p8"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_showdate" value="1"<?php if ($JAK_FORM_DATA["showdate"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_showdate" value="0"<?php if ($JAK_FORM_DATA["showdate"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tld["dload"]["d19"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_comment" value="1"<?php if ($JAK_FORM_DATA["comments"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_comment" value="0"<?php if ($JAK_FORM_DATA["comments"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5">
												<strong><?php echo $tld["dload"]["d17"]; ?></strong>
												<a class="cms-help" data-content="<?php echo $tld["dload"]["h1"]; ?>" href="javascript:void(0)" data-original-title="<?php echo $tl["title"]["t21"]; ?>">
													<i class="fa fa-question-circle"></i>
												</a>
											</div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_ftshare" value="1"<?php if ($JAK_FORM_DATA["ftshare"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_ftshare" value="0"<?php if ($JAK_FORM_DATA["ftshare"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["page"]["p9"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_social" value="1"<?php if ($JAK_FORM_DATA["socialbutton"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_social" value="0"<?php if ($JAK_FORM_DATA["socialbutton"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["general"]["g85"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_vote" value="1"<?php if ($JAK_FORM_DATA["showvote"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_vote" value="0"<?php if ($JAK_FORM_DATA["showvote"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["general"]["g124"]; ?></strong></div>
											<div class="col-md-7">
												<div class="radio">
													<label class="checkbox-inline">
														<input type="radio" name="jak_sidebar" value="1"<?php if ($JAK_FORM_DATA["sidebar"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g125"]; ?>
													</label>
													<label class="checkbox-inline">
														<input type="radio" name="jak_sidebar" value="0"<?php if ($JAK_FORM_DATA["sidebar"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g126"]; ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["general"]["g87"]; ?></strong></div>
											<div class="col-md-7">
												<div class="input-group">
													<input type="text" name="jak_img" id="jak_img" class="form-control" value="<?php echo $JAK_FORM_DATA["previmg"]; ?>"/>
                        <span class="input-group-btn">
                          <a class="btn btn-info ifManager" type="button" href="../js/editor/plugins/filemanager/dialog.php?type=1&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=jak_img"><?php echo $tl["general"]["g69"]; ?></a>
                        </span>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["page"]["p11"]; ?></strong></div>
											<div class="col-md-7">
												<input type="text" name="jak_password" class="form-control" value=""/>
											</div>
										</div>
										<?php if ($JAK_FORM_DATA["password"]) { ?>
											<div class="row-form">
												<div class="col-md-5"><strong><?php echo $tl["page"]["p12"]; ?></strong></div>
												<div class="col-md-7"><input type="checkbox" name="jak_delete_password"/></div>
											</div>
										<?php } ?>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["general"]["g86"]; ?></strong></div>
											<div class="col-md-7">
												<input type="checkbox" name="jak_delete_rate"/>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tld["dload"]["d26"]; ?></strong></div>
											<div class="col-md-7">
												<input type="checkbox" name="jak_delete_comment"/>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5">
												<strong><?php echo $tl["general"]["g73"] . ' ' . $tl["general"]["g56"]; ?></strong></div>
											<div class="col-md-7">
												<input type="checkbox" name="jak_delete_hits"/>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tl["general"]["g42"]; ?></strong></div>
											<div class="col-md-7">
												<input type="checkbox" name="jak_update_time"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["title"]["t12"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-12">
												<select name="jak_catid" class="form-control selectpicker">
													<option
														value="0"<?php if ($JAK_FORM_DATA["catid"] == '0') { ?> selected="selected"<?php } ?>><?php echo $tl["general"]["g24"]; ?></option>
													<?php if (isset($JAK_CAT) && is_array ($JAK_CAT)) foreach ($JAK_CAT as $z) { ?>
														<option
														value="<?php echo $z["id"]; ?>" <?php if ($z["id"] == $JAK_FORM_DATA["catid"]) { ?>selected="selected"<?php } ?>><?php echo $z["name"]; ?></option><?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["general"]["g88"]; ?>
									<a class="cms-help" data-content="<?php echo $tl["help"]["h"]; ?>" href="javascript:void(0)" data-original-title="<?php echo $tl["title"]["t21"]; ?>">
										<i class="fa fa-question-circle"></i>
									</a>
								</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-12">
												<select name="jak_permission[]" multiple="multiple" class="form-control">
													<option value="0"<?php if ($JAK_FORM_DATA["candownload"] == '0') { ?> selected="selected"<?php } ?>><?php echo $tld["dload"]["d31"]; ?></option>
													<?php if (isset($JAK_USERGROUP) && is_array ($JAK_USERGROUP)) foreach ($JAK_USERGROUP as $v) { ?>
														<option value="<?php echo $v["id"]; ?>"<?php if (in_array ($v["id"], explode (',', $JAK_FORM_DATA["candownload"]))) { ?> selected="selected"<?php } ?>><?php echo $v["name"]; ?></option><?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<table class="table table-striped">
									<tr>
										<td>

										</td>
									</tr>
								</table>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tld["dload"]["d13"]; ?>
									<a class="cms-help" data-content="<?php echo $tld["dload"]["h"]; ?>" href="javascript:void(0)" data-original-title="<?php echo $tl["title"]["t21"]; ?>">
										<i class="fa fa-question-circle"></i>
									</a>
								</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<table class="table table-striped">
									<tr>
										<td><?php echo $tld["dload"]["d10"]; ?></td>
										<td>
											<select name="jak_file" class="form-control selectpicker">
												<option value="0"><?php echo $tld["dload"]["d12"]; ?></option><?php if (isset($site_dload_files) && is_array ($site_dload_files)) foreach ($site_dload_files as $l) { ?>
													<option value="<?php echo $l; ?>"<?php if ($JAK_FORM_DATA["file"] == $l) { ?> selected="selected"<?php } ?>><?php echo $l; ?></option><?php } ?>
											</select>
										</td>
									</tr>
									<tr>
										<td><?php echo $tld["dload"]["d11"]; ?></td>
										<td>
											<div class="input-group">
												<input type="text" name="jak_extfile" id="ext_file" class="form-control" value="<?php echo $JAK_FORM_DATA["extfile"]; ?>"/>
                      <span class="input-group-btn">
                        <a class="btn btn-info ifManager" type="button"
													href="../js/editor/plugins/filemanager/dialog.php?type=2&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=ext_file"><?php echo $tl["general"]["g69"]; ?></a>
                      </span>
											</div><!-- /input-group -->
										</td>
									</tr>
								</table>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
						<?php if (JAK_TAGS) { ?>
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo $tl["title"]["t31"]; ?></h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
										</button>
									</div>
								</div>
								<div class="box-body">
									<div class="block">
										<div class="block-content">
											<div class="row-form">
												<div class="col-md-5"><strong>Choose tags from predefined list</strong></div>
												<div class="col-md-7">
													<select name="" id="selecttags1" class="form-control selectpicker" title="Choose tags ..." data-size="7" data-live-search="true">
														<optgroup label="Poskytovatelé TV">
															<option value="skylink">Skylink</option>
															<option value="freesat">freeSAT</option>
															<option value="digi-tv">Digi TV</option>
														</optgroup>
														<optgroup label="Vysílací technologie">
															<option value="dvb-t/t2">DVB-T/T2</option>
															<option value="dvb-s/s2">DVB-S/S2</option>
															<option value="dvb-c">DVB-C</option>
															<option value="dvb-h">DVB-H</option>
														</optgroup>
													</select>
												</div>
											</div>
											<div class="row-form">
												<div class="col-md-5"><strong>Choose tags from list</strong></div>
												<div class="col-md-7">
													<?php $JAK_TAG_ALL = jak_tag_name_admin ();
													if ($JAK_TAG_ALL) { ?>
														<select name="" id="selecttags2" class="form-control selectpicker" title="Choose tags ..." data-size="7" data-live-search="true">
															<?php foreach ($JAK_TAG_ALL as $v) { ?>
																<option value="<?php echo $v["tag"]; ?>"><?php echo $v["tag"]; ?></option>
															<?php } ?>
														</select>
													<?php } else { ?>
														<div>Tags cloud is empty!</div>
													<?php } ?>
												</div>
											</div>
											<div class="row-form">
												<div class="col-md-12">
													<input type="text" name="jak_tags" class="form-control tags" value="" data-role="tagsinput"/>
												</div>
											</div>
											<?php if ($JAK_TAGLIST) { ?>
												<div class="row-form">
													<div class="col-md-12">
														<div class="form-group">
															<label for="tags"><?php echo $tl["general"]["g27"]; ?></label>
															<div class="controls">
																<?php echo $JAK_TAGLIST; ?>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" name="save" class="btn btn-primary pull-right">
										<i class="fa fa-save margin-right-5"></i>
										<?php echo $tl["general"]["g20"]; ?>
									</button>
								</div>
							</div>
						<?php } ?>
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tld["dload"]["d25"]; ?> / <?php echo $tld["dload"]["d9"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tld["dload"]["d25"]; ?></strong></div>
											<div class="col-md-7">
												<input type="text" name="jak_hitstotal" class="form-control" value="<?php echo $JAK_FORM_DATA["hits"]; ?>"/>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tld["dload"]["d9"]; ?></strong></div>
											<div class="col-md-7">
												<input type="text" name="jak_dltotal" class="form-control" value="<?php echo $JAK_FORM_DATA["countdl"]; ?>"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage2" aria-labelledby="cmsPage2-tab">
				<div class="row">
					<div class="col-md-12">
						<?php include_once APP_PATH . "admin/template/editor_edit.php"; ?>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage3" aria-labelledby="cmsPage3-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["general"]["g53"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<a href="../js/editor/plugins/filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=csseditor" class="ifManager"><?php echo $tl["general"]["g69"]; ?></a>
								<a href="javascript:;" id="addCssBlock"><?php echo $tl["general"]["g101"]; ?></a><br/>
								<div id="csseditor"></div>
								<textarea name="jak_css" id="jak_css" class="hidden"><?php echo $JAK_FORM_DATA["dl_css"]; ?></textarea>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage4" aria-labelledby="cmsPage4-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["general"]["g100"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<a href="../js/editor/plugins/filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=javaeditor" class="ifManager"><?php echo $tl["general"]["g69"]; ?></a>
								<a href="javascript:;" id="addJavascriptBlock"><?php echo $tl["general"]["g102"]; ?></a><br/>
								<div id="javaeditor"></div>
								<textarea name="jak_javascript" id="jak_javascript" class="hidden"><?php echo $JAK_FORM_DATA["dl_javascript"]; ?></textarea>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage5" aria-labelledby="cmsPage5-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tl["general"]["g89"]; ?></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<div class="box-body">
								<?php include APP_PATH . "admin/template/sidebar_widget.php"; ?>
							</div>
							<div class="box-footer">
								<button type="submit" name="save" class="btn btn-primary pull-right">
									<i class="fa fa-save margin-right-5"></i>
									<?php echo $tl["general"]["g20"]; ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="jak_oldcatid" value="<?php echo $JAK_FORM_DATA["catid"]; ?>"/>

	</form>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>