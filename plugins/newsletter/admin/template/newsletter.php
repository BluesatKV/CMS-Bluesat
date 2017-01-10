<?php include_once APP_PATH . 'admin/template/header.php'; ?>

<?php if ($page1 == "s") { ?>
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
if ($page1 == "e" || $page1 == "ene") { ?>
	<script type="text/javascript">
		// Notification
		setTimeout(function () {
			$.notify({
				// options
				message: '<?php echo ($page1 == "e" ? $tl["errorpage"]["sql"] : $tl["errorpage"]["not"]);?>',
			}, {
				// settings
				type: 'danger',
				delay: 5000,
			});
		}, 1000);
	</script>
<?php } ?>

<?php if (isset($JAK_NEWSLETTER_ALL) && is_array ($JAK_NEWSLETTER_ALL)) { ?>

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="box">
			<div class="box-body no-padding">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="jak_delete_all"/></th>
							<th><?php echo $tlnl["nletter"]["d8"]; ?></th>
							<th><?php echo $tlnl["nletter"]["d4"]; ?></th>
							<th><?php echo $tl["page"]["p2"]; ?></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>
								<button type="submit" name="delete" id="button_delete" class="btn btn-danger btn-xs" data-confirm-del="<?php echo $tlnl["nletter"]["al"]; ?>" disabled="disabled">
									<i class="fa fa-trash-o"></i>
								</button>
							</th>
						</tr>
						</thead>
						<?php foreach ($JAK_NEWSLETTER_ALL as $v) { ?>
							<tr>
								<td><?php echo $v["id"]; ?></td>
								<td>
									<input type="checkbox" name="jak_delete_newsletter[]" class="highlight" value="<?php echo $v["id"]; ?>"/>
								</td>
								<td>
									<a href="index.php?p=newsletter&amp;sp=edit&amp;ssp=<?php echo $v["id"]; ?>"><?php echo $v["title"]; ?></a>
								</td>
								<td><?php if ($v["sent"]) {
										echo $v["senttime"];
									} else {
										echo $tlnl["nletter"]["d5"];
									} ?></td>
								<td><?php echo $v["time"]; ?></td>
								<td><?php if ($v["sent"]) echo '<a href="index.php?p=newsletter&amp;sp=stat&amp;ssp=' . $v["id"] . '" class="btn btn-default btn-xs"><i class="fa fa-bar-chart"></i></a>'; ?></td>
								<td>
									<a href="index.php?p=newsletter&amp;sp=preview&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs nlbox">
										<i class="fa fa-desktop"></i>
									</a>
								</td>
								<td>
									<a href="index.php?p=newsletter&amp;sp=send&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs">
										<i class="fa fa-envelope-o"></i>
									</a>
								</td>
								<td>
									<a href="index.php?p=newsletter&amp;sp=edit&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs">
										<i class="fa fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="index.php?p=newsletter&amp;sp=delete&amp;ssp=<?php echo $v["id"]; ?>" class="btn btn-default btn-xs" data-confirm="<?php echo $tlnl["nletter"]["al"]; ?>">
										<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</form>

<?php } else { ?>

	<div class="col-md-12">
		<div class="alert bg-info text-white">
			<?php echo $tl["errorpage"]["data"]; ?>
		</div>
	</div>

<?php } ?>

	<div class="icon_legend">
		<h3><?php echo $tl["icons"]["i"]; ?></h3>
		<i title="<?php echo $tlnl["nletter"]["d10"]; ?>" class="fa fa-bar-chart"></i>
		<i title="<?php echo $tlnl["nletter"]["d6"]; ?>" class="fa fa-desktop"></i>
		<i title="<?php echo $tlnl["nletter"]["d7"]; ?>" class="fa fa-envelope-o"></i>
		<i title="<?php echo $tl["icons"]["i2"]; ?>" class="fa fa-edit"></i>
		<i title="<?php echo $tl["icons"]["i1"]; ?>" class="fa fa-trash-o"></i>
	</div>

<?php if ($JAK_PAGINATE) {
	echo $JAK_PAGINATE;
} ?>

<?php include_once APP_PATH . 'admin/template/footer.php'; ?>