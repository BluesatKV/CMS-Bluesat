<?php include "quickheader.php"; ?>

<?php if ($page3 == "s") { ?>
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
if ($page3 == "e") { ?>
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
				<th colspan="2"><?php echo $tl["global_text"]["globaltxt15"]; ?></th>
			</tr>
			</thead>
			<tr>
				<td><?php echo $tl["global_text"]["globaltxt16"]; ?></td>
				<td>
					<div class="form-group no-margin<?php if (isset($errors["e1"])) echo " has-error"; ?>">
						<input type="text" name="jak_title" class="form-control" value="<?php echo $JAK_FORM_DATA["title"]; ?>"/>
					</div>
				</td>
			</tr>
		</table>

		<?php include_once "editorlight_edit.php"; ?>

		<hr>

		<button type="submit" name="save" class="btn btn-success pull-right">
			<i class="fa fa-save margin-right-5"></i>
			<?php echo $tl["button"]["btn1"]; ?>
		</button>

	</form>

<?php include "quickfooter.php"; ?>