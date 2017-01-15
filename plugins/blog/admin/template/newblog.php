<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php if ($page2 == "e") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php echo $tl["general_error"]["generror1"]; ?>',
			}, {
				// settings
				type: 'danger',
				delay: 5000,
			});
		}, 1000);
	</script>
<?php } ?>

<?php if ($errors) { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php if (isset($errors["e"])) echo $errors["e"];
					if (isset($errors["e1"])) echo $errors["e1"];
					if (isset($errors["e2"])) echo $errors["e2"];
					if (isset($errors["e3"])) echo $errors["e3"]; ?>',
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
		<div class="savebutton hidden-xs">
			<button type="submit" name="save" class="btn btn-success button">
				<i class="fa fa-save margin-right-5"></i>
				<?php echo $tl["button"]["btn1"]; ?> !!
			</button>
		</div>

		<!-- Form Content -->
		<ul id="cmsTabNewBL" class="nav nav-tabs nav-tabs-responsive nav-tabs-fillup" role="tablist">
			<li role="presentation" class="active">
				<a href="#cmsPage1" id="cmsPage1-tab" role="tab" data-toggle="tab" aria-controls="cmsPage1" aria-expanded="true">
					<span class="text"><?php echo $tlblog["blog_section_tab"]["blogtab"]; ?></span>
				</a>
			</li>
			<li role="presentation" class="next">
				<a href="#cmsPage2" role="tab" id="cmsPage2-tab" data-toggle="tab" aria-controls="cmsPage2">
					<span class="text"><?php echo $tlblog["blog_section_tab"]["blogtab4"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage3" role="tab" id="cmsPage3-tab" data-toggle="tab" aria-controls="cmsPage3">
					<span class="text"><?php echo $tlblog["blog_section_tab"]["blogtab1"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage4" role="tab" id="cmsPage4-tab" data-toggle="tab" aria-controls="cmsPage4">
					<span class="text"><?php echo $tlblog["blog_section_tab"]["blogtab2"]; ?></span>
				</a>
			</li>
			<li role="presentation">
				<a href="#cmsPage5" role="tab" id="cmsPage5-tab" data-toggle="tab" aria-controls="cmsPage5">
					<span class="text"><?php echo $tlblog["blog_section_tab"]["blogtab3"]; ?></span>
				</a>
			</li>
		</ul>

		<div id="cmsTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="cmsPage1" aria-labelledby="cmsPage1-tab">
				<div class="row">
					<div class="col-md-7">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt7"]; ?></h3>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-5">
												<strong><?php echo $tlblog["blog_box_content"]["blogbc"]; ?></strong>
												<span class="star-item text-danger-800 m-l-10">*</span>
											</div>
											<div class="col-md-7">
												<?php include_once APP_PATH . "admin/template/title_new.php"; ?>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc25"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" id="jak_showtitle1" name="jak_showtitle" value="1" />
													<label for="jak_showtitle1"><?php echo $tl["checkbox"]["chk"]; ?></label>

													<input type="radio" id="jak_showtitle2" name="jak_showtitle" value="0" checked="checked" />
													<label for="jak_showtitle2"><?php echo $tl["checkbox"]["chk1"]; ?></label>

												</div>
											</div>
										</div>
										<?php if (isset($JAK_CONTACT_FORMS) && is_array ($JAK_CONTACT_FORMS)) { ?>
											<div class="row-form">
												<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc26"]; ?></strong>
												</div>
												<div class="col-md-7"><select name="jak_showcontact" class="form-control selectpicker">
														<option value="0"selected="selected"><?php echo $tlblog["blog_box_content"]["blogbc27"]; ?></option>
														<?php foreach ($JAK_CONTACT_FORMS as $cf) { ?>
															<option value="<?php echo $cf["id"]; ?>"><?php echo $cf["title"]; ?></option><?php } ?>
													</select>
												</div>
											</div>
										<?php } ?>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc28"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" id="jak_showdate1" name="jak_showdate" value="1" />
													<label for="jak_showdate1"><?php echo $tl["checkbox"]["chk"]; ?></label>

													<input type="radio" id="jak_showdate2" name="jak_showdate" value="0" checked="checked" />
													<label for="jak_showdate2"><?php echo $tl["checkbox"]["chk1"]; ?></label>

												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc29"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" id="jak_comment1" name="jak_comment" value="1" />
													<label for="jak_comment1"><?php echo $tl["checkbox"]["chk"]; ?></label>

													<input type="radio" id="jak_comment2" name="jak_comment" value="0" checked="checked" />
													<label for="jak_comment2"><?php echo $tl["checkbox"]["chk1"]; ?></label>

												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc30"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" id="jak_vote1" name="jak_vote" value="1" />
													<label for="jak_vote"><?php echo $tl["checkbox"]["chk"]; ?></label>

													<input type="radio" id="jak_vote2" name="jak_vote" value="0" checked="checked" />
													<label for="jak_vote2"><?php echo $tl["checkbox"]["chk1"]; ?></label>

												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc31"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" id="jak_social1" name="jak_social" value="1" />
													<label for="jak_social1"><?php echo $tl["checkbox"]["chk"]; ?></label>

													<input type="radio" id="jak_social2" name="jak_social" value="0" checked="checked" />
													<label for="jak_social2"><?php echo $tl["checkbox"]["chk1"]; ?></label>

												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc32"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="radio radio-success">

													<input type="radio" name="jak_sidebar" value="1" checked="checked" />
													<label for="yes"><?php echo $tl["checkbox"]["chk2"]; ?></label>

													<input type="radio" name="jak_sidebar" value="0" />
													<label for="no"><?php echo $tl["checkbox"]["chk3"]; ?></label>

												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc33"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="input-group">
													<input type="text" name="jak_img" id="jak_img" class="form-control" value=""/>
                        <span class="input-group-btn">
                          <a class="btn btn-info ifManager" type="button"
														href="../js/editor/plugins/filemanager/dialog.php?type=1&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=jak_img"><?php echo $tl["global_text"]["globaltxt8"]; ?></a>
                        </span>
												</div>
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
					<div class="col-md-5">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt8"]; ?>
									<a class="cms-help" data-content="<?php echo $tl["help"]["h"]; ?>" href="javascript:void(0)" data-original-title="<?php echo $tl["title"]["t21"]; ?>">
										<i class="fa fa-question-circle"></i>
									</a>
								</h3>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-12">
												<select name="jak_catid[]" multiple="multiple" class="form-control">
													<option value="0" selected="selected"><?php echo $tlblog["blog_box_content"]["blogbc37"]; ?></option>

													<?php if (isset($JAK_CAT) && is_array ($JAK_CAT)) foreach ($JAK_CAT as $v) { ?>
														<option value="<?php echo $v["id"]; ?>"><?php echo $v["name"]; ?></option>
													<?php } ?>
												</select>
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
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt9"]; ?></h3>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-12">
												<div class="form-group no-margin">
													<input type="text" name="jak_datetime" id="datepickerTime" class="form-control" value="<?php if ($JAK_FORM_DATA["time"]) echo $JAK_FORM_DATA["time"]; ?>" readonly/>
												</div>
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
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt10"]; ?></h3>
							</div>
							<div class="box-body">
								<div class="block">
									<div class="block-content">
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc38"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="form-group no-margin<?php if (isset($errors["e2"])) echo " has-error"; ?>">
													<input type="text" name="jak_datefrom" id="datepickerFrom" class="form-control" value="" readonly/>
												</div>
											</div>
										</div>
										<div class="row-form">
											<div class="col-md-5"><strong><?php echo $tlblog["blog_box_content"]["blogbc39"]; ?></strong>
											</div>
											<div class="col-md-7">
												<div class="form-group no-margin<?php if (isset($errors["e2"])) echo " has-error"; ?>">
													<input type="text" name="jak_dateto" id="datepickerTo" class="form-control" value="" readonly/>
												</div>
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
						<?php if (JAK_TAGS) { ?>
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt11"]; ?></h3>
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
													<input type="text" name="jak_tags" id="jak_tags" class="tags form-control" value="" data-role="tagsinput"/>
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
						<?php } ?>

					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage2" aria-labelledby="cmsPage2-tab">
				<div class="row">
					<div class="col-md-12">
						<?php include_once APP_PATH . "admin/template/editor_new.php"; ?>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage3" aria-labelledby="cmsPage3-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt2"]; ?></h3>
							</div>
							<div class="box-body">
								<a href="../js/editor/plugins/filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=csseditor" class="ifManager"><?php echo $tl["global_text"]["globaltxt8"]; ?></a>
								<a href="javascript:;" id="addCssBlock"><?php echo $tl["global_text"]["globaltxt6"]; ?></a><br/>
								<div id="csseditor"></div>
								<textarea name="jak_css" id="jak_css" class="hidden"></textarea>
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
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage4" aria-labelledby="cmsPage4-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt3"]; ?></h3>
							</div>
							<div class="box-body">
								<a href="../js/editor/plugins/filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=javaeditor" class="ifManager"><?php echo $tl["global_text"]["globaltxt8"]; ?></a>
								<a href="javascript:;" id="addJavascriptBlock"><?php echo $tl["global_text"]["globaltxt7"]; ?></a><br/>
								<div id="javaeditor"></div>
								<textarea name="jak_javascript" id="jak_javascript" class="hidden"></textarea>
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
			</div>
			<div role="tabpanel" class="tab-pane fade" id="cmsPage5" aria-labelledby="cmsPage5-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $tlblog["blog_box_title"]["blogbt4"]; ?></h3>
							</div>
							<div class="box-body">
								<?php include APP_PATH . 'admin/template/sidebar_widget_new.php'; ?>
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
			</div>
		</div>
	</form>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>