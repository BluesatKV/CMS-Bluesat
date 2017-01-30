</main>
<!-- / content -->

<?php if ($JAK_SHOW_FOOTER) { ?>

<!-- footer -->
<footer id="main-footer">
	<div class="container">
		<div class="row">

			<div class="col-sm-6">
				<div class="footer-widget">
					<img src="images/neko-logo.png" alt="latest Little Neko news" id="footerLogo" class="mb-small">
					<p><a href="http://www.little-neko.com" title="Little Neko, website template creation">Little Neko</a> is a web design and development studio. We build responsive HTML5 and CSS3 templates, integrating best web design practises and up-to-date web technologies to create great user experiences. We love what we do and we hope you too ! </p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="footer-widget">

					<h3>Little NEKO</h3>
					<address>
						<p>
							<i class="icon-location"></i>1600 Pennsylvania Avenue NW<br>
							Washington, DC 20500 <br>
							<i class="icon-phone"></i>256.478.3252 <br>
							<i class="icon-mail-alt"></i>&nbsp;<a href="mailto:contact@template.com">contact@template.com</a>
						</p>
					</address>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="footer-widget">
					<h3>Follow us, we are social</h3>

					<ul class="social-icons dark-main-color circle medium">
						<li>
							<a href="#" class="rss " title="rss"><i class="icon-rss"></i></a>
						</li>
						<li>
							<a href="#" class="facebook" title="facebook"><i class="icon-facebook"></i></a>
						</li>
						<li>
							<a href="#" class="twitter" title="twitter"><i class="icon-twitter"></i></a>
						</li>
						<li>
							<a href="#" class="gplus" title="gplus"><i class="icon-gplus"></i></a>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>

	<div id="footer-rights">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Copyright © 2012 <a href="http://www.little-neko.com" target="blank">Little NEKO</a> / All rights reserved.</p>
				</div>

			</div>
		</div>
	</div>
</footer>
<!-- / footer -->

<?php } ?>
</div>
<!-- global wrapper -->

<!-- End Document  ================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/template/<?php echo $jkv["sitestyle"];?>/js-plugins/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/template/<?php echo $jkv["sitestyle"];?>/js-plugins/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>

<!-- External framework plugins -->
<script type="application/javascript" src="/template/<?php echo $jkv["sitestyle"];?>/js-plugins/external-plugins.min.js"></script>
<script type="text/javascript" src="/assets/plugins/bootstap-notify/bootstrap-notify.min.js"></script>

<!-- Neko framework script -->
<script type="text/javascript" src="/template/<?php echo $jkv["sitestyle"];?>/js/neko-framework.js"></script>

<?php if ($jkv["offline"] == 1 && JAK_ASACCESS) { ?>
<!-- Offline Website -->
<script type="text/javascript">
	$.notify({
		// Options
		icon: 'icon-flash',
		message: '<?php echo $tl["title"]["t10"];?>',
	}, {
		// Settings
		type: 'offline',
		timer: 0,
		template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="color: #fff;opacity: 0.8;">×</button>' +
		'<span data-notify="icon"></span> ' +
		'<span data-notify="title" style="display: block;font-weight: bold;">{1}</span> ' +
		'<span data-notify="message">{2}</span>' +
		'</div>' +
		'</div>'
	});
</script>
<?php } ?>

</body>
</html>