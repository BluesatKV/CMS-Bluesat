<?php

// EN: Include the config file ...
// CZ: Vložení konfiguračního souboru ...
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/admin/config.php')) die('[' . __DIR__ . '/uninstall.php] => "config.php" not found');
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config.php';

// Check if the file is accessed only from a admin if not stop the script from running
$php_errormsg  = 'To edit the file, you must be logged in as an ADMINISTRATOR !!! You cannot access this file directly.';
$php_errormsg1 = 'Only ADMINISTRATOR privileges allow you to edit the file !!! You cannot access this file directly.';
if (!ENVO_USERID) die($php_errormsg);

if (!$envouser -> envoAdminAccess($envouser -> getVar("usergroupid"))) die($php_errormsg1);

// Set successfully to zero
$succesfully = 0;

// PLUGIN CONFIG
// New plugin version and name
$pluginversion = '2.0';
$plugins  = 'Intranet2';
$pluginname  = 'intranet2';

// EN: Load the language file for plugin
// CZ: Načtení jazykového souboru pro plugin
if (file_exists(APP_PATH . 'plugins/' . $pluginname . '/admin/lang/' . $site_language . '.ini')) {
	$tlint2 = parse_ini_file(APP_PATH . 'plugins/' . $pluginname . '/admin/lang/' . $site_language . '.ini', TRUE);
} else {
	$tlint2 = parse_ini_file(APP_PATH . 'plugins/' . $pluginname . '/admin/lang/en.ini', TRUE);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $tlint2["int2_uninstall"]["int2uninst"] ?></title>
	<meta charset="utf-8">
	<!-- BEGIN Vendor CSS-->
	<?php
	// Add Html Element -> addStylesheet (Arguments: href, media, optional assoc. array)
	echo $Html -> addStylesheet('/assets/plugins/bootstrap/bootstrapv4/4.0.0/css/bootstrap.min.css');
	echo $Html -> addStylesheet('/assets/plugins/font-awesome/4.7.0/css/font-awesome.css');
	?>
	<!-- BEGIN Pages CSS-->
	<?php
	// Add Html Element -> addStylesheet (Arguments: href, media, optional assoc. array)
	echo $Html -> addStylesheet('/admin/pages/css/pages-icons.css?=v3.0.0');
	echo $Html -> addStylesheet('/admin/pages/css/pages.min.css?=v3.0.2', '', array ('class' => 'main-stylesheet'));
	?>
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

		/* Card */
		.card-collapse i {
			font-size: 17px;
			font-weight: bold;
		}

		/* Table */
		.table-transparent tbody tr td {
			background: transparent;
		}
	</style>
	<!-- BEGIN VENDOR JS -->
	<?php
	// Add Html Element -> addScript (Arguments: src, optional assoc. array)
	echo $Html -> addScript('/assets/plugins/jquery/jquery-1.11.1.min.js');
	echo $Html -> addScript('/admin/assets/plugins/modernizr.custom.js?=v2.8.3');
	echo $Html -> addScript('/assets/plugins/popper/1.14.1/popper.min.js');
	echo $Html -> addScript('/assets/plugins/bootstrap/bootstrapv4/4.0.0/js/bootstrap.min.js');
	?>
	<!-- BEGIN CORE TEMPLATE JS -->
	<?php
	// Add Html Element -> addScript (Arguments: src, optional assoc. array)
	echo $Html -> addScript('/admin/pages/js/pages.min.js');
	?>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-12 m-t-20">
			<div class="jumbotron bg-master pt-1 pl-3 pb-1 pr-3">
				<h3 class="semi-bold text-white"><?= $tlint2["int2_uninstall"]["int2uninst"] ?></h3>
			</div>
			<hr>
			<div id="notificationcontainer"></div>
			<div class="m-b-30">

				<h4 class="semi-bold"><?= $tlint2["int2_uninstall"]["int2uninst1"] ?></h4>

				<div data-pages="card" class="card card-transparent" id="card-basic">
					<div class="card-header separator">
						<div class="card-title"><?= $tlint2["int2_uninstall"]["int2uninst2"] ?></div>
						<div class="card-controls">
							<ul>
								<li>
									<a data-toggle="collapse" class="card-collapse" href="#">
										<i class="card-icon card-icon-collapse"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="card-block">
						<h3><span class="semi-bold">Výpis</span> Komponentů</h3>
						<p>Seznam komponent které budou odinstalovány v průběhu odinstalačního procesu tohoto pluginu</p>
						<br>
						<h5 class="text-uppercase">Prostudovat postup odinstalace</h5>
					</div>
				</div>

			</div>
			<hr>

			<!-- UNINSTALLATION -->
			<?php if (isset($_POST['uninstall'])) {
				// VALIDATE

				// EN: Start a PHP Session
				// CZ: Start PHP Session
				session_start();

				if (isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["code"] == $_POST["captcha"]) {

					// Now get the plugin id for futher use
					$results = $envodb -> query('SELECT id FROM ' . DB_PREFIX . 'plugins WHERE name = "' . $plugins . '"');
					$rows    = $results -> fetch_assoc();

					if ($rows) {

						$envodb -> query('DELETE FROM ' . DB_PREFIX . 'plugins WHERE name = "' . $plugins . '"');
						$envodb -> query('DELETE FROM ' . DB_PREFIX . 'pluginhooks WHERE product = "' . $pluginname . '"');
						$envodb -> query('DELETE FROM ' . DB_PREFIX . 'setting WHERE product = "' . $pluginname . '"');
						$envodb -> query('ALTER TABLE ' . DB_PREFIX . 'usergroup DROP `' . $pluginname . '`');
						$envodb -> query('DELETE FROM ' . DB_PREFIX . 'categories WHERE pluginid = "' . smartsql($rows['id']) . '"');

						/* Remove tables with data */
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_settings_region');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_settings_district');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_settings_city');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_settings_ku');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_settings_estatemanagement');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_house');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_houseent');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_housetasks');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_houseserv');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_housedocu');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int2_houseimg');
						$envodb->query('DROP TABLE IF EXISTS ' . DB_PREFIX . 'int_housevideo');

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
                message: '<?=$tlint2["int2_uninstall"]["int2uninst3"]?>',
                position: 'top',
                timeout: 0,
                type: 'success'
              }).show();

              e.preventDefault();
            });
					</script>
				<?php } else { ?>
					<div>
						<h5 class="text-danger bold"><?= $tlint2["int2_uninstall"]["int2uninst4"] ?></h5>
					</div>
					<script>
            $(document).ready(function () {
              'use strict';
              // Apply the plugin to the body
              $('#notificationcontainer').pgNotification({
                style: 'bar',
                message: '<?=$tlint2["int2_uninstall"]["int2uninst4"]?>',
                position: 'top',
                timeout: 0,
                type: 'danger'
              }).show();

              e.preventDefault();
            });
					</script>
				<?php }
			}
			if (!$succesfully) { ?>
				<form name="company" action="uninstall.php" method="post" enctype="multipart/form-data">
					<div class="form-group form-inline">
						<label for="text"><?= $tlint2["int2_uninstall"]["int2uninst5"] ?></label>
						<input type="text" name="captcha" class="form-control m-l-10" id="text">
						<img src="../../assets/plugins/captcha/simple/captcha.php" class="m-l-10"/>
					</div>
					<button type="submit" name="uninstall" class="btn btn-complete btn-block">
						<?= $tlint2["int2_uninstall"]["int2uninst6"] ?>
					</button>
				</form>
			<?php } ?>

		</div>
	</div>
</div>

</body>
</html>