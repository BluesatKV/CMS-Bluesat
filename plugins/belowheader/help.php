<!DOCTYPE html>
<html>
<head>
	<title>Help - BelowHeader Plugin</title>
	<meta charset="utf-8">
	<!-- BEGIN Vendor CSS-->
	<link href="/admin/assets/plugins/bootstrapv3/css/bootstrap.min.css?=v3.3.4" rel="stylesheet" type="text/css"/>
	<link href="/admin/assets/plugins/font-awesome/css/font-awesome.css?=4.5.0" rel="stylesheet" type="text/css"/>
	<link href="docs/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="docs/assets/css/style.css" rel="stylesheet" type="text/css" />
	<!-- BEGIN Pages CSS-->
	<link href="/admin/pages/css/pages-icons.css?=v2.2.0" rel="stylesheet" type="text/css">
	<link class="main-stylesheet" href="/admin/pages/css/pages.css?=v2.2.0" rel="stylesheet" type="text/css"/>
	<!-- BEGIN CUSTOM MODIFICATION -->
	<style type="text/css">
		/* Fix 'jumping scrollbar' issue */
		@media screen and (min-width: 960px) {
			html {
				margin-left: calc(100vw - 100%);
				margin-right: 0;
			}
		}

		/* Main body */
		body {
			background: transparent;
		}
	</style>
	<!-- BEGIN VENDOR JS -->
	<script src="/admin/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="/admin/assets/plugins/bootstrapv3/js/bootstrap.min.js?=v3.3.4" type="text/javascript"></script>
	<script src="docs/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="/admin/pages/js/pages.js?=v2.2.0"></script>
</head>
<body class="index" data-spy="scroll" data-target=".sidebar">
<header>
	<div class="container">
		<a class="logo" href="#">
			<img src="assets/img/pages_logo_white.png" width="78" height="22">
		</a>
	</div>
</header>
<div class="container p-t-70">
	<div class="container-inner">
		<nav class="sidebar ">
			<div class="pg_scrollable">
				<ul class="nav">
					<li >
						<h6>Introduction</h6>
						<ul class="nav" style="overflow: hidden; display: block;">
							<li >
								<a href="index.html">Getting Started</a>
							</li>
							<li >
								<a href="partials/less.html">LESS</a>
							</li>
							<li >
								<a href="partials/sass.html">SASS</a>
							</li>
							<li >
								<a href="partials/grunt.html">Grunt</a>
							</li>
							<li >
								<a href="partials/gulp.html">Gulp</a>
							</li>
							<li >
								<a href="partials/browser_support.html">Browser Support</a>
							</li>
							<li >
								<a href="partials/angular_js.html">AngularJS support</a>
							</li>
							<li >
								<a href="partials/meteor_js.html">MeteorJS support</a>
							</li>
						</ul>
					</li>
					<li>
						<h6>Boilerplates</h6>
						<ul class="nav">
							<li > <a href="partials/express_js.html"> Express Js </a>
							</li>
							<li > <a href="partials/sails_js.html"> Sails Js </a>
							</li>
							<li > <a href="partials/rails.html">Rails</a>
							</li>
						</ul>
					</li>
					<li >
						<a href="partials/api.html">API Reference</a>
					</li>
					<li >
						<a href="partials/widget_market.html">Widgets Market</a>
					</li>
					<li>
						<h6>Apps</h6>
						<ul class="nav">
							<li > <a href="partials/calendar.html"> Calendar </a></li>
							<li > <a href="partials/social.html"> Social </a></li>
							<li > <a href="partials/email.html"> Email </a></li>
						</ul>
					</li>
					<li >
						<a href="partials/layouts.html">Layouts</a>
					</li>
					<li >
						<a href="partials/content.html">Content</a>
					</li>
					<li >
						<a href="partials/themes.html">Themes</a>
					</li>
					<li >
						<a href="partials/grid.html">Grid</a>
					</li>
					<li >
						<a href="partials/views.html">Views</a>
					</li>
					<li >
						<a href="partials/helpers.html">Helpers</a>
					</li>
					<li >
						<a href="partials/portlets.html">Portlets</a>
					</li>
					<li>
						<h6>UI Elements</h6>
						<ul class="nav">
							<li > <a href="partials/color.html"> Color </a>
							</li>
							<li > <a href="partials/typo.html"> Typography </a>
							</li>
							<li > <a href="partials/icons.html">Icons</a>
							</li>
							<li > <a href="partials/buttons.html">Buttons</a>
							</li>
							<li > <a href="partials/notification.html"> Notifications </a>
							</li>
							<li > <a href="partials/modals.html"> Modals </a>
							</li>
							<li > <a href="partials/progress.html"> Progress &amp; Activity </a>
							</li>
							<li > <a href="partials/accordians.html">Accordians </a> </li>
							<li > <a href="partials/tabs.html"> Tabs </a>
							</li>
							<li > <a href="partials/sliders.html">Sliders</a>
							</li>
							<li > <a href="partials/treeview.html">Tree View</a>
							</li>
							<li > <a href="partials/nestable.html">Nestable </a>
							</li>
						</ul>
					</li>
					<li>
						<h6>Forms</h6>
						<ul class="nav">
							<li >
								<a href="partials/form_elements.html">Form Elements</a>
							</li>
							<li >
								<a href="partials/form_layouts.html">Form Layouts</a>
							</li>
							<li >
								<a href="partials/form_validation.html">Form Validation</a>
							</li>
							<li >
								<a href="partials/form_wizard.html">Form Wizard</a>
							</li>
						</ul>
					</li>
					<li >
						<a href="partials/charts.html">Charts</a>
					</li>
					<li>
						<h6>Maps</h6>
						<ul class="nav">
							<li >
								<a href="partials/google_maps.html">Google Maps</a>
							</li>
							<li >
								<a href="partials/vector_maps.html">Vector Maps</a>
							</li>
						</ul>
					</li>
					<li >
						<a href="partials/tables.html">Tables</a>
					</li>
					<li>
						<h6>Extras</h6>
						<ul class="nav">
							<li >
								<a href="partials/timeline.html">Timeline</a>
							</li>
						</ul>
					</li>
					<li >
						<a href="partials/troubleshooting.html">Troubleshooting</a>
					</li>
					<li >
						<a href="partials/changelog.html">Changelog</a>
					</li>
					<li >
						<a href="partials/support.html">Support</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="row">
			<div class="col-md-9 col-sm-8 col-md-offset-3 col-sm-offset-4">
				<div class="content">



					<section id="introduction" style="padding-top:30px">
						<h2 class="text-center">Pages Documentation</h2>
						<h5 class="text-center">Beautifully Hand Crafted, Light Weight, Hardware Accelerated UI Framework  </h5>
						<hr>
						<h3>Introduction</h3>
						<p>Pages is carefully well thought UI frame work that is built on top of Bootstrap 3, Its hand crafted components look great on all devices and works super fast even on mobile</p>
						<p>This documentation guide for all Pages users who can even be a beginner to Web development
						</p>
						<br>
						<h3>Light Weight & Ready to Go</h3>
						<p> The entire set of modules clocks in at 38KB* minified and gzipped. Crafted with mobile devices in mind, it was important to us to keep our file sizes small, and every line of CSS was carefully considered. If you decide to only use a subset of these modules, you'll save even more bytes.</p>
						<br>
						<p>Production level usage using minfied and gzipped files</p>
						<table style="width:100%">
							<tbody>
							<tr>
								<td style="width:50%;height:30px" class="bg-danger text-white text-center fs-14 p-t-5 p-b-5">
									CSS
									<div class="fs-12">38Kb</div>
								</td>
								<td style="width:10%;height:30px" class="bg-primary text-white text-center fs-14 p-t-5 p-b-5">JS
									<div class="fs-12">1.8Kb</div>
								</td>
								<td style="width:30%;height:30px" class="bg-complete text-white text-center fs-14 p-t-5 p-b-5">Icons
									<div class="fs-12">12Kb</div>
								</td>
								<td style="width:30%;height:30px" class="bg-warning text-white text-center fs-14 p-t-5 p-b-5">Other
									<div class="fs-12">120Kb</div>
								</td>
							</tr>
							</tbody>
						</table>
					</section>



					<section id="getting_started" style="padding-top:100px">
						<h3 class="page-title">
							Getting Started
						</h3>
						<hr>
						<h5>
							This part of the doc will help you to quick start your project and will you a basic idea about how pages work. For you to get start visit the "Get Started" folder in your download package
						</h5>
						<br>
						<h4>What's Included</h4>
						<p>Pages comes in two forms, within which you'll find the following directories and files, logically grouping common resources and providing both compiled and minified variations</p>
						<p>Once you have download the package you will see the following folder structure</p>
						<div class="m-b-20" id="default-tree">
							<ul id="treeData" style="display: none;">
								<li class="folder">boilerplates
								</li>
								<li class="folder">demo
								</li>
								<li class="folder">getting_started
								</li>
								<li class="folder">grunt
								</li>
								<li class="folder">gulp
								</li>
								<li id="id2">documentation.html
								</li>
							</ul>
						</div>
						<br>
						<h4>Whats Inside getting_started</h4>
						<p>This folder is a boilerplate template to help you start your project from. You will find both AngularJS and jQuery versions inside this. </p>
						<div class="m-b-20" id="g-tree">
							<ul id="gdata" style="display: none;">
								<li class="folder expanded">getting_started
									<ul>
										<li class="folder expanded">angular
											<ul>
												<li class="folder">assets
													<ul>
														<li class="folder">css
														</li>
														<li class="folder">js
														</li>
														<li class="folder">img
														</li>
													</ul>
												</li>
												<li class="folder">pages
													<ul>
														<li class="folder expanded">css
															<ul>
																<li>pages.css</li>
																<li>pages.min.css</li>
															</ul>
														</li>
														<li class="folder expanded">js
															<ul>
																<li>pages.js</li>
																<li>pages.min.js</li>
															</ul>
														</li>
														<li class="folder">img
														</li>
													</ul>
												</li>
												<li class="folder">tpl
													<ul>
														<li class="folder">blocks
														</li>
														<li>app.html</li>
														<li>home.html</li>
													</ul>
												</li>
												<li>index.html
												</li>
												<li>index.haml
												</li>
											</ul>
										</li>
										<li class="folder expanded">html
											<ul>
												<li class="folder">assets
													<ul>
														<li class="folder">css
														</li>
														<li class="folder">js
														</li>
														<li class="folder">img
														</li>
													</ul>
												</li>
												<li class="folder">pages
													<ul>
														<li class="folder expanded">css
															<ul>
																<li>pages.css</li>
																<li>pages.min.css</li>
															</ul>
														</li>
														<li class="folder expanded">js
															<ul>
																<li>pages.js</li>
																<li>pages.min.js</li>
															</ul>
														</li>
														<li class="folder">img
														</li>
													</ul>
												</li>
												<li>index.html
												</li>
												<li>index.haml
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<br>
						<p>In the getting_started folder you will find both jQuery and AngularJS implementations of Pages. Pages was originally written in jQuery. To make it work on AngularJS environments, several directives and controllers were written in v2.0. </p>
						<p>Folder structure inside these two folders are almost the same except for the <code>assets</code> folder. In AngularJS this will contain directives and controllers which are mandatory for Pages to work, whereas in jQuery version you can have your own files.</p>
						<h5 class="">Folder : assets</h5>
						<p>If you are using jQuery, this folder is entirely dedicated for you and you can add your own images, custom css and js files, its grouped into resource folders for best practice</p>
						<p>If you are an AngularJS user you will find Pages core directive and controllers.</p>
						<br>
						<h5 class="">Folder : pages</h5>
						<p>This where the magic happens and contains pre-complied version of Pages, we do recommend updating any contents of the folder as all future updates are affected directly to this</p>
						<p>AngularJS direcitves found in <code>angular/assets/js/directives</code> folder will be calling Pages modules found in this folder to make them work on AngularJS environments</p>
						<br>
						<h5 class="">Folder : tpl (Only available for AngularJS)</h5>
						<p>Contains template HTML files that are lazy loaded and rendered for each state</p>
						<br>
						<h4>Whats Inside demo</h4>
						<p>This folder contains all the demo files that we have shown in the live version for reference, you may wish to import code to your project from that. This is only used for reference and we do no recommend to start your project from demo files. Contains files for both AngularJS and jQuery users</p>
						<br>
						<h4>Whats Inside grunt and gulp</h4>
						<p>Pages support two popular build systems called Grunt and Gulp.</p>
						<div class="m-b-20" id="b-tree">
							<ul id="gdata" style="display: none;">
								<li class="folder expanded" id="id5">grunt
									<ul>
										<li id="id2">package.json
										</li>
										<li id="id2">gruntfile.js
										</li>
									</ul>
								</li>
								<li class="folder expanded" id="id5">gulp
									<ul>
										<li id="id2">package.json
										</li>
										<li id="id2">gulpfile.js
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<br>
						<br>
						<br>
						<p>Other Useful resources that you may find:</p>
						<ul class="other-ref">
							<li><a href="partials/less.html">Working with LESS</a></li>
							<li><a href="partials/grunt.html">Working with Grunt</a></li>
							<li><a href="partials/gulp.html">Working with Gulp</a></li>
						</ul>
					</section>

				</div>
			</div>
		</div>
	</div>
</div>
<footer>
	Copyright Reserved Revox 2014 - 2016
</footer>
<script src="assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/bootstrapv3/js/bootstrap.min.js"></script>
<script src="assets/plugins/highlight/highlight.pack.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-actual/jquery.actual.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-select2/select2.min.js"></script>
<script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="pages/js/pages.min.js" type="text/javascript"></script>
<script src="assets/js/sidebar.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-dynatree/jquery.dynatree.min.js" type="text/javascript"></script>

<script src="assets/js/portlets.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$.fn.scrollbar && $('.pg_scrollable').scrollbar({
			ignoreOverlay: false
		});
		//Initialize Pages core
		hljs.initHighlightingOnLoad();
		$("#default-tree").dynatree();
		$("#angular-tree").dynatree();
		$("#g-tree").dynatree();
		$("#b-tree").dynatree();
	});
</script>
</body>
</html>
