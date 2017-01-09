<script>
	$('body').scrollspy({ target: '.sidebar-detached' });

	$(function() {
		/* Resize sidebar on scroll
		 ========================================= */
		// Resize detached sidebar vertically when bottom reached
		function resizeDetached() {
			$(window).on('load scroll', function() {
				if ($(window).scrollTop() > $(document).height() - $(window).height() - 40) {
					$('.sidebar-detached').addClass('fixed-sidebar-space');
				}
				else {
					$('.sidebar-detached').removeClass('fixed-sidebar-space');
				}
			});
		}

		/* Affix detached sidebar
		 ========================================= */
		// Init nicescroll when sidebar affixed
		$('.sidebar-detached').on('affix.bs.affix', function() {
			resizeDetached();
		});
		// Attach BS affix component to the sidebar
		$('.sidebar-detached').affix({
			offset: {
				top: $('.sidebar-detached').offset().top - 60 // top offset - computed line height
			}
		});
		// Remove affix and scrollbar on mobile
		$(window).on('resize', function() {
			setTimeout(function() {
				if($(window).width() <= 768) {
					// Remove affix on mobile
					$(window).off('.affix')
					$('.sidebar-detached').removeData('affix').removeClass('affix affix-top affix-bottom');
				}
			}, 100);
		}).resize();

	});
</script>