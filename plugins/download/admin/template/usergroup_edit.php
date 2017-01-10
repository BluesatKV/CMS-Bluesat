<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $tld["dload"]["d"]; ?></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="block">
			<div class="block-content">
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d1"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_download" value="1"<?php if ($JAK_FORM_DATA["download"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_download" value="0"<?php if ($JAK_FORM_DATA["download"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d29"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_candownload" value="1"<?php if ($JAK_FORM_DATA["downloadcan"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_candownload" value="0"<?php if ($JAK_FORM_DATA["downloadcan"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d2"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpost" value="1"<?php if ($JAK_FORM_DATA["downloadpost"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpost" value="0"<?php if ($JAK_FORM_DATA["downloadpost"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d3"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpostapprove" value="0"<?php if ($JAK_FORM_DATA["downloadpostapprove"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpostapprove" value="1"<?php if ($JAK_FORM_DATA["downloadpostapprove"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d4"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpostdelete" value="1"<?php if ($JAK_FORM_DATA["downloadpostdelete"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadpostdelete" value="0"<?php if ($JAK_FORM_DATA["downloadpostdelete"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d5"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadrate" value="1"<?php if ($JAK_FORM_DATA["downloadrate"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadrate" value="0"<?php if ($JAK_FORM_DATA["downloadrate"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
					</div>
				</div>
				<div class="row-form">
					<div class="col-md-5"><strong><?php echo $tld["dload"]["d6"]; ?></strong></div>
					<div class="col-md-7">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadmoderate" value="1"<?php if ($JAK_FORM_DATA["downloadmoderate"] == '1') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g18"]; ?>
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="jak_downloadmoderate" value="0"<?php if ($JAK_FORM_DATA["downloadmoderate"] == '0') { ?> checked="checked"<?php } ?> /> <?php echo $tl["general"]["g19"]; ?>
							</label>
						</div>
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