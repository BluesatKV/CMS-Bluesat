<?php

// EN: Include the config file ...
// CZ: Vložení konfiguračního souboru ...
if (!file_exists ('../../config.php')) die('[install.php] config.php not found');
require_once '../../config.php';

// Check if the file is accessed only from a admin if not stop the script from running
if (!JAK_USERID) die('You cannot access this file directly.');

// If not logged in and not admin, block access
if (!$jakuser->jakAdminaccess ($jakuser->getVar ("usergroupid"))) die('You cannot access this file directly.');

// Set successfully to zero
$succesfully = 0;

// Set language for plugin
if ($jkv["lang"] != $site_language && file_exists (APP_PATH . 'admin/lang/' . $site_language . '.ini')) {
	$tl = parse_ini_file (APP_PATH . 'admin/lang/' . $site_language . '.ini', true);
} else {
	$tl            = parse_ini_file (APP_PATH . 'admin/lang/' . $jkv["lang"] . '.ini', true);
	$site_language = $jkv["lang"];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $tl["plugin"]["t2"]; ?></title>
	<meta charset="utf-8">
	<!-- BEGIN Vendor CSS-->
	<link href="/admin/assets/plugins/bootstrapv3/css/bootstrap.min.css?=v3.3.4" rel="stylesheet" type="text/css"/>
	<link href="/admin/assets/plugins/font-awesome/css/font-awesome.css?=4.5.0" rel="stylesheet" type="text/css"/>
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

		/* Notification */
		#notificationcontainer {
			position: relative;
			z-index: 1000;
			top: -21px;
		}

		.pgn-wrapper {
			position: absolute;
			z-index: 1000;
		}

		/* Button, input, checkbox ... */
		input[type="text"]:hover {
			background: #fafafa;
			border-color: #c6c6c6;
			color: #384343;
		}

		/* Portlet */
		.portlet-collapse i {
			font-size: 17px;
			font-weight: bold;
		}

		/* Table */
		.table-transparent tbody tr td {
			background: transparent;
		}
	</style>
	<!-- BEGIN VENDOR JS -->
	<script src="/admin/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="/admin/assets/plugins/bootstrapv3/js/bootstrap.min.js?=v3.3.4" type="text/javascript"></script>
	<!-- BEGIN CORE TEMPLATE JS -->
	<script src="/admin/pages/js/pages.js?=v2.2.0"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12 m-t-20">
			<div class="jumbotron bg-master">
				<h3 class="semi-bold text-white"><?php echo $tl["plugin"]["t2"]; ?></h3>
			</div>
			<hr>
			<div id="notificationcontainer"></div>
			<div class="m-b-30">
				<h4 class="semi-bold">Blog Plugin - Info o instalačním procesu</h4>

				<div id="portlet-advance" class="panel panel-transparent">
					<div class="panel-heading separator">
						<div class="panel-title">Rozšířené informace
						</div>
						<div class="panel-controls">
							<ul>
								<li>
									<a href="#" class="portlet-collapse" data-toggle="collapse">
										<i class="portlet-icon portlet-icon-collapse"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="panel-body">
						<h3><span class="semi-bold">Výpis</span> Komponentů</h3>
						<p>Seznam komponent které budou odinstalovány v průběhu instalačního procesu tohoto pluginu</p>
						<br>
						<h5 class="text-uppercase">Prostudovat postup instalace</h5>
					</div>
				</div>
			</div>
			<hr>

			<!-- Check if the plugin is already installed -->
			<?php $jakdb->query ('SELECT id FROM ' . DB_PREFIX . 'plugins WHERE name = "UrlMapping"');
			if ($jakdb->affected_rows > 0) { ?>

				<button id="closeModal" class="btn btn-default btn-block" onclick="window.parent.closeModal();">Zavřít</button>
				<script>
					$(document).ready(function () {
						'use strict';
						// Apply the plugin to the body
						$('#notificationcontainer').pgNotification({
							style: 'bar',
							message: 'Plugin je již nainstalován !!!',
							position: 'top',
							timeout: 0,
							type: 'warning',
						}).show();

						e.preventDefault();
					});
				</script>

				<!-- Plugin is not installed let's display the installation script -->
			<?php } else { ?>

				<!-- INSTALLATION -->
				<?php if (isset($_POST['install'])) {

				$jakdb->query ('INSERT INTO ' . DB_PREFIX . 'plugins (`id`, `name`, `description`, `active`, `access`, `pluginorder`, `pluginpath`, `phpcode`, `phpcodeadmin`, `sidenavhtml`, `usergroup`, `uninstallfile`, `pluginversion`, `time`) VALUES (NULL, "Blog", "Run your own blog.", 1, ' . JAK_USERID . ', 4, "blog", "require_once APP_PATH.\'plugins/blog/blog.php\';", "if ($page == \'blog\') {
        require_once APP_PATH.\'plugins/blog/admin/blog.php\';
           $JAK_PROVED = 1;
           $checkp = 1;
        }", "../plugins/blog/admin/template/blognav.php", "blog", "uninstall.php", "1.1", NOW())');

				// Now get the plugin id for futher use
				$results = $jakdb->query ('SELECT id FROM ' . DB_PREFIX . 'plugins WHERE name = "Blog"');
				$rows    = $results->fetch_assoc ();

			if ($rows['id']) {

				// Insert php code
				$insertphpcode = 'if (isset($defaults[\'jak_blog\'])) {
	$insert .= \'blog = \"\'.$defaults[\'jak_blog\'].\'\", blogpost = \"\'.$defaults[\'jak_blogpost\'].\'\", blogpostapprove = \"\'.$defaults[\'jak_blogpostapprove\'].\'\", blogpostdelete = \"\'.$defaults[\'jak_blogpostdelete\'].\'\", blograte = \"\'.$defaults[\'jak_blograte\'].\'\", blogmoderate = \"\'.$defaults[\'jak_blogmoderate\'].\'\",\'; }';


				$adminlang = 'if (file_exists(APP_PATH.\'plugins/blog/admin/lang/\'.$site_language.\'.ini\')) {
    $tlblog = parse_ini_file(APP_PATH.\'plugins/blog/admin/lang/\'.$site_language.\'.ini\', true);
} else {
    $tlblog = parse_ini_file(APP_PATH.\'plugins/blog/admin/lang/en.ini\', true);
}';

				$sitelang = 'if (file_exists(APP_PATH.\'plugins/blog/lang/\'.$site_language.\'.ini\')) {
    $tlblog = parse_ini_file(APP_PATH.\'plugins/blog/lang/\'.$site_language.\'.ini\', true);
} else {
    $tlblog = parse_ini_file(APP_PATH.\'plugins/blog/lang/en.ini\', true);
}';

				$sitephpsearch = '$blog = new JAK_search($SearchInput);
        	$blog->jakSettable(\'blog\',\"\");
        	$blog->jakAndor(\"OR\");
        	$blog->jakFieldactive(\"active\");
        	$blog->jakFieldtitle(\"title\");
        	$blog->jakFieldcut(\"content\");
        	$blog->jakFieldstosearch(array(\"title\",\"content\"));
        	$blog->jakFieldstoselect(\"id, title, content\");
        	
        	// Load the array into template
        	$JAK_SEARCH_RESULT_BLOG = $blog->set_result(JAK_PLUGIN_VAR_BLOG, \'a\', $jkv[\"blogurl\"]);';

				$sitephprss = 'if ($page1 == JAK_PLUGIN_VAR_BLOG) {
	
	if ($jkv[\"blogrss\"]) {
		$sql = \'SELECT id, title, content, time FROM \'.DB_PREFIX.\'blog WHERE active = 1 ORDER BY time DESC LIMIT \'.$jkv[\"blogrss\"];
		$sURL = JAK_PLUGIN_VAR_BLOG;
		$sURL1 = \'a\';
		$what = 1;
		$seowhat = $jkv[\"blogurl\"];
		
		$JAK_RSS_DESCRIPTION = jak_cut_text($jkv[\"blogdesc\"], $jkv[\"shortmsg\"], \'…\');
		
	} else {
		jak_redirect(BASE_URL);
	}
	
}';

				$sitephptag = 'if ($row[\'pluginid\'] == JAK_PLUGIN_ID_BLOG) {
$blogtagData[] = JAK_tags::jakTagsql(\"blog\", $row[\'itemid\'], \"id, title, content\", \"content\", JAK_PLUGIN_VAR_BLOG, \"a\", $jkv[\"blogurl\"]);
$JAK_TAG_BLOG_DATA = $blogtagData;
}';

				$sitephpsitemap = 'include_once APP_PATH.\'plugins/blog/functions.php\';

$JAK_BLOG_ALL = jak_get_blog(\'\', $jkv[\"blogorder\"], \'\', \'\', $jkv[\"blogurl\"], $tl[\'general\'][\'g56\']);
$PAGE_TITLE = JAK_PLUGIN_NAME_BLOG;';

				// Fulltext search query
				$sqlfull       = '$jakdb->query(\'ALTER TABLE \'.DB_PREFIX.\'blog ADD FULLTEXT(`title`, `content`)\');';
				$sqlfullremove = '$jakdb->query(\'ALTER TABLE \'.DB_PREFIX.\'blog DROP INDEX `title`\');';

				// Connect to pages/news
				$pages = 'if ($pg[\'pluginid\'] == JAK_PLUGIN_BLOG) {

include_once APP_PATH.\'plugins/blog/admin/template/blog_connect.php\';

}';

				$sqlinsert = 'if (!isset($defaults[\'jak_showblog\'])) {
	$bl = 0;
} else if (in_array(0, $defaults[\'jak_showblog\'])) {
	$bl = 0;
} else {
	$bl = join(\',\', $defaults[\'jak_showblog\']);
}

if (empty($bl) && !empty($defaults[\'jak_showblogmany\'])) {
	$insert .= \'showblog = \"\'.$defaults[\'jak_showblogorder\'].\':\'.$defaults[\'jak_showblogmany\'].\'\",\';
} else if (!empty($bl)) {
	$insert .= \'showblog = \"\'.$bl.\'\",\';
} else {
  	$insert .= \'showblog = NULL,\';
}';

				$getblog = '$JAK_GET_BLOG = jak_get_page_info(DB_PREFIX.\'blog\', \'\');

if ($JAK_FORM_DATA) {

$showblogarray = explode(\":\", $JAK_FORM_DATA[\'showblog\']);

if (is_array($showblogarray) && in_array(\"ASC\", $showblogarray) || in_array(\"DESC\", $showblogarray)) {

		$JAK_FORM_DATA[\'showblogorder\'] = $showblogarray[0];
		$JAK_FORM_DATA[\'showblogmany\'] = $showblogarray[1];
	
} }';
				// Eval code for display connect
				$get_blconnect = 'if (JAK_PLUGIN_ACCESS_BLOG && $pg[\'pluginid\'] == JAK_PLUGIN_ID_BLOG && !empty($row[\'showblog\'])) {
include_once APP_PATH.\'plugins/blog/template/\'.$jkv[\"sitestyle\"].\'/pages_news.php\';}';

				$get_blsidebar = 'include_once APP_PATH.\'template/\'.$jkv[\"sitestyle\"].\'/plugintemplate/blog/blogsidebar.php\';';
				$get_blsitemap = 'include_once APP_PATH.\'template/\'.$jkv[\"sitestyle\"].\'/plugintemplate/blog/sitemap.php\';';
				$get_blsearch = 'include_once APP_PATH.\'template/\'.$jkv[\"sitestyle\"].\'/plugintemplate/blog/search.php\';';

				$adminphpdelete = '$jakdb->query(\'UPDATE \'.DB_PREFIX.\'blogcomments SET userid = 0 WHERE userid = \'.$page2.\'\');';

				$adminphprename = '$jakdb->query(\'UPDATE \'.DB_PREFIX.\'blogcomments SET username = \"\'.smartsql($defaults[\'jak_username\']).\'\" WHERE userid = \'.smartsql($page2).\'\');';

				$adminphpmassdel = '$jakdb->query(\'UPDATE \'.DB_PREFIX.\'blogcomments SET userid = 0 WHERE userid = \'.$locked.\'\');';

				$jakdb->query ('INSERT INTO ' . DB_PREFIX . 'pluginhooks (`id`, `hook_name`, `name`, `phpcode`, `product`, `active`, `exorder`, `pluginid`, `time`) VALUES
(NULL, "php_admin_usergroup", "Blog Usergroup", "' . $insertphpcode . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_lang", "Blog Admin Language", "' . $adminlang . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "php_lang", "Blog Site Language", "' . $sitelang . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "php_search", "Blog Search PHP", "' . $sitephpsearch . '", "blog", 1, 8, "' . $rows['id'] . '", NOW()),
(NULL, "php_rss", "Blog RSS PHP", "' . $sitephprss . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_tags", "Blog Tags PHP", "' . $sitephptag . '", "blog", 1, 8, "' . $rows['id'] . '", NOW()),
(NULL, "php_sitemap", "Blog Sitemap PHP", "' . $sitephpsitemap . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_admin_usergroup", "Blog Usergroup New", "plugins/blog/admin/template/usergroup_new.php", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_admin_usergroup_edit", "Blog Usergroup Edit", "plugins/blog/admin/template/usergroup_edit.php", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_tags", "Blog Tags", "plugins/blog/template/tag.php", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_sitemap", "Blog Sitemap", "' . $get_blsitemap . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_sidebar", "Blog Sidebar Categories", "' . $get_blsidebar . '", "blog", 1, 4, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_fulltext_add", "Blog Full Text Search", "' . $sqlfull . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_fulltext_remove", "Blog Remove Full Text Search", "' . $sqlfullremove . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_admin_page_news", "Blog Admin - Page/News", "' . $pages . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_admin_page_news_new", "Blog Admin - Page/News - New", "plugins/blog/admin/template/blog_connect_new.php", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_pages_sql", "Blog Pages SQL", "' . $sqlinsert . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_news_sql", "Blog News SQL", "' . $sqlinsert . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_pages_news_info", "Blog Pages/News Info", "' . $getblog . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_page_news_grid", "Blog Pages/News Display", "' . $get_blconnect . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_search", "Blog Search", "' . $get_blsearch . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_user_delete", "Blog Delete User", "' . $adminphpdelete . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_user_rename", "Blog Rename User", "' . $adminphprename . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "php_admin_user_delete_mass", "Blog Delete User Mass", "' . $adminphpmassdel . '", "blog", 1, 1, "' . $rows['id'] . '", NOW()),
(NULL, "tpl_footer_widgets", "Blog - 3 Latest Files", "plugins/blog/template/footer_widget.php", "blog", 1, 3, "' . $row['id'] . '", NOW()),
(NULL, "tpl_footer_widgets", "Blog - Show Categories", "plugins/blog/template/footer_widget1.php", "blog", 1, 3, "' . $row['id'] . '", NOW())');

				// Insert tables into settings
				$jakdb->query ('INSERT INTO ' . DB_PREFIX . 'setting (`varname`, `groupname`, `value`, `defaultvalue`, `optioncode`, `datatype`, `product`) VALUES
("blogtitle", "blog", "Blog", "Blog", "input", "free", "blog"),
("blogdesc", "blog", "Write something about your Blog", "Write something about your Blog", "textarea", "free", "blog"),
("blogemail", "blog", NULL, NULL, "input", "free", "blog"),
("blogdateformat", "blog", "d.m.Y", "d.m.Y", "input", "free", "blog"),
("blogtimeformat", "blog", ": h:i A", ": h:i A", "input", "free", "blog"),
("blogurl", "blog", 0, 0, "yesno", "boolean", "blog"),
("blogmaxpost", "blog", 2000, 2000, "input", "boolean", "blog"),
("blogpagemid", "blog", 3, 3, "yesno", "number", "blog"),
("blogpageitem", "blog", 4, 4, "yesno", "number", "blog"),
("blogorder", "blog", "id ASC", "", "input", "free", "blog"),
("blogrss", "blog", 5, 5, "number", "select", "blog"),
("bloghlimit", "blog", 5, 5, "number", "select", "blog"),
("blog_css", "blog", "", "", "textarea", "free", "blog"),
("blog_javascript", "blog", "", "", "textarea", "free", "blog")');

				// Insert into usergroup
				$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'usergroup ADD `blog` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `advsearch`, ADD `blogpost` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `blog`, ADD `blogpostdelete` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `blogpost`, ADD `blogpostapprove` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `blogpostdelete`, ADD `blograte` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `blogpostdelete`, ADD `blogmoderate` SMALLINT(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `blograte`');

				// Pages/News alter Table
				$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'pages ADD showblog varchar(100) DEFAULT NULL AFTER showcontact');
				$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'news ADD showblog varchar(100) DEFAULT NULL AFTER showcontact');
				$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'pagesgrid ADD blogid INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER newsid');

				// Backup content from blog
				$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'backup_content ADD blogid INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER pageid');

				// Insert Category
				$jakdb->query ('INSERT INTO ' . DB_PREFIX . 'categories (`id`, `name`, `varname`, `catimg`, `showmenu`, `showfooter`, `catorder`, `catparent`, `pageid`, `activeplugin`, `pluginid`) VALUES
(NULL, "Blog", "blog", NULL, 1, 0, 5, 0, 0, 1, "' . $rows['id'] . '")');

				$jakdb->query ('CREATE TABLE IF NOT EXISTS ' . DB_PREFIX . 'blog (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `blog_css` text,
  `blog_javascript` text,
  `sidebar` smallint(1) UNSIGNED NOT NULL DEFAULT 1,
  `previmg` varchar(255) DEFAULT NULL,
  `showtitle` smallint(1) unsigned NOT NULL DEFAULT 1,
  `active` smallint(1) unsigned NOT NULL DEFAULT 1,
  `showcontact` int(11) unsigned NOT NULL DEFAULT 0,
  `showdate` smallint(1) unsigned NOT NULL DEFAULT 0,
  `comments` smallint(1) unsigned NOT NULL DEFAULT 0,
  `socialbutton` smallint(1) unsigned NOT NULL DEFAULT 0,
  `hits` int(10) unsigned NOT NULL DEFAULT 0,
  `showvote` smallint(1) unsigned NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `startdate` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `enddate` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

				$jakdb->query ('CREATE TABLE IF NOT EXISTS ' . DB_PREFIX . 'blogcategories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `varname` varchar(100) DEFAULT NULL,
  `catimg` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `permission` mediumtext,
  `catorder` int(11) unsigned NOT NULL DEFAULT 1,
  `catparent` int(11) unsigned NOT NULL DEFAULT 0,
  `active` smallint(1) unsigned NOT NULL DEFAULT 1,
  `count` int(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `catorder` (`catorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

				$jakdb->query ('CREATE TABLE IF NOT EXISTS ' . DB_PREFIX . 'blogcomments (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blogid` int(11) unsigned NOT NULL DEFAULT 0,
  `commentid` int(11) unsigned NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL DEFAULT 0,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `message` text,
  `approve` smallint(1) unsigned NOT NULL DEFAULT 0,
  `trash` smallint(1) unsigned NOT NULL DEFAULT 0,
  `votes` int(10) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\',
  `session` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogid` (`blogid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1');

				// Full text search is activated we do so for the blog table as well
				if ($jkv["fulltextsearch"]) {
					$jakdb->query ('ALTER TABLE ' . DB_PREFIX . 'blog ADD FULLTEXT(`title`, `content`)');
				}

				$succesfully = 1;

				?>
				<button id="closeModal" class="btn btn-default btn-block" onclick="window.parent.closeModal();">Zavřít</button>
				<script>
					$(document).ready(function () {
						'use strict';
						// Apply the plugin to the body
						$('#notificationcontainer').pgNotification({
							style: 'bar',
							message: '<?php echo $tl["plugin"]["p13"]; ?>',
							position: 'top',
							timeout: 0,
							type: 'success',
						}).show();

						e.preventDefault();
					});
				</script>
			<?php } else {

			$result = $jakdb->query ('DELETE FROM ' . DB_PREFIX . 'plugins WHERE name = "Blog"');

			?>
				<div class="alert bg-danger"><?php echo $tl["plugin"]["p16"]; ?></div>
				<form name="company" method="post" action="uninstall.php" enctype="multipart/form-data">
					<button type="submit" name="redirect" class="btn btn-danger btn-block"><?php echo $tl["plugin"]["p11"]; ?></button>
				</form>
			<?php }
			} ?>

			<?php if (!$succesfully) { ?>
				<form name="company" method="post" action="install.php" enctype="multipart/form-data">
					<button type="submit" name="install" class="btn btn-complete btn-block"><?php echo $tl["plugin"]["p10"]; ?></button>
				</form>
			<?php }
			} ?>

		</div>
	</div>
</div>

<script type="text/javascript">
	(function ($) {
		'use strict';
		$('#portlet-advance').portlet({
			onRefresh: function () {
				setTimeout(function () {
					// Throw any error you encounter while refreshing
					$('#portlet-advance').portlet({
						error: "Something went terribly wrong. Just keep calm and carry on!"
					});
				}, 2000);
			}
		});
	})(window.jQuery);
</script>

</body>
</html>