<div class="box box-success">
	<div class="box-header with-border">

		<?php
		// Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
		echo $Html->addTag('h3', $tl["global_text"]["globaltxt1"], 'box-title');
		?>

	</div>
	<div class="box-body">
		<table class="table table-striped">
			<thead>
			<?php if (isset($JAK_PAGE_BACKUP) && is_array ($JAK_PAGE_BACKUP)) { ?>
				<tr>
					<th>
						<div class="form-group">
							<label><?php echo $tl["global_text"]["globaltxt2"]; ?></label>
							<select name="restorcontent" id="restorcontent" class="form-control selectpicker" data-size="5">

								<?php
								// Add Html Element -> addOption (Arguments: value, text, selected, id, class, optional assoc. array)
								echo $Html->addOption('0', $tl["global_text"]["globaltxt3"]);

								foreach ($JAK_PAGE_BACKUP as $pb) {

									// Add Html Element -> addOption (Arguments: value, text, selected, id, class, optional assoc. array)
									echo $Html->addOption($pb["id"], $pb["time"]);

								}
								?>

							</select>

							<?php
							// Add Html Element -> addTag (Arguments: tag, text, class, optional assoc. array)
							echo $Html->addTag('span', '<i class="fa fa-spinner fa-pulse"></i>', 'loader');
							?>
						</div>
					</th>
				</tr>
			<?php } ?>
			</thead>
			<tr>
				<td>
					<?php if ($jkv["adv_editor"]) { ?>
						<div id="cover">
							<div class="cover-header">
								<a href="../assets/plugins/tinymce/plugins/filemanager/dialog.php?ty e=0&editor=mce_0&lang=eng&fldr=&field_id=htmleditor" class="btn btn-primary btn-xs ifManager" title="Show Filemanager">
									<i class="fa fa-files-o"></i>
								</a>
								<a href="#" id="resizeContainer" class="btn btn-primary btn-xs" title="<?php echo $tl["global_text"]["globaltxt4"]; ?>"><?php echo $tl["global_text"]["globaltxt4"]; ?></a>
								<a href="#" id="resizeContainerAndEditor" class="btn btn-primary btn-xs" title="<?php echo $tl["global_text"]["globaltxt5"]; ?>"><?php echo $tl["global_text"]["globaltxt5"]; ?></a>
								<a href="/admin/template/editor_help.php" class="btn btn-primary btn-xs pull-right contentHelp">Nápověda</a>
							</div>
							<div id="editorContainer">

								<?php
								// Add Html Element -> addDiv (Arguments: $value, $id, optional assoc. array)
								echo $Html->addDiv('', 'htmleditor');
								?>

							</div>
						</div>

						<?php

						// Add Html Element -> addTextarea (Arguments: name, value, rows, cols, optional assoc. array)
						echo $Html->addTextarea('jak_content', jak_edit_safe_userpost (htmlspecialchars ($JAK_FORM_DATA["content"])), '', '', array('id' => 'jak_editor', 'class' => 'form-control hidden'));

						} else {

						// Add Html Element -> addTextarea (Arguments: name, value, rows, cols, optional assoc. array)
						echo $Html->addTextarea('jak_content', jak_edit_safe_userpost ($JAK_FORM_DATA["content"]), '40', '', array('id' => 'jakEditor', 'class' => 'form-control jakEditor'));

						} ?>

				</td>
			</tr>
		</table>
	</div>
	<div class="box-footer">

		<?php
		// Add Html Element -> addButtonSubmit (Arguments: name, value, id, class, optional assoc. array)
		echo $Html->addButtonSubmit('save', '<i class="fa fa-save m-r-5"></i>' . $tl["button"]["btn1"], '', 'btn btn-success pull-right');
		?>

	</div>
</div>
<style type="text/css">
	#editorContainer {
		height: 500px;
		position: relative;
	}

	#htmleditor {
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
	}

	#cover.active {
		position: fixed;
		top: 0;
		left: 0;
		background: #f4f4f4;
		z-index: 1050;
		width: 100%;
		height: 100%;
		padding: 40px;
	}

	.cover-header {
		background: #ddd;
		padding: 10px;
		margin-bottom: 10px;
	}
</style>
<script type="text/javascript">
	var clicked = false;
	var resizeFirstEditor = function (resizeEditor) {
		var MeContainer = document.getElementById('cover');
		var feContainer = document.getElementById('editorContainer');

		MeContainer.classList.toggle("active");
		clicked = !clicked;
		if (resizeEditor) {
			editor.resize();
		}
	};

	var btn = document.getElementById('resizeContainer');
	btn.addEventListener('click', function () {
		resizeFirstEditor();
	});
	var btn = document.getElementById('resizeContainerAndEditor');
	btn.addEventListener('click', function () {
		resizeFirstEditor(true);
	});
</script>