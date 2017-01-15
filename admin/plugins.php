<?php

// EN: Check if the file is accessed only via index.php if not stop the script from running
// CZ: Kontrola, zdali je soubor přístupný pouze přes index.php - pokud ne ukončí se script
if (!defined ('JAK_ADMIN_PREVENT_ACCESS')) die('You cannot access this file directly.');

// EN: Check if the user has access to this file
// CZ: Kontrola, zdali má uživatel přístup k tomuto souboru
if (!JAK_SUPERADMINACCESS) jak_redirect (BASE_URL_ORIG);

// EN: Settings all the tables we need for our work
// CZ: Nastavení všech tabulek, které potřebujeme pro práci
$jaktable  = DB_PREFIX . 'categories';
$jaktable1 = DB_PREFIX . 'plugins';
$jaktable2 = DB_PREFIX . 'pluginhooks';

// Get all the Hooks
$jakhooks = new JAK_hooks('', '');

// EN: Import important settings for the template from the DB
// CZ: Importuj důležité nastavení pro šablonu z DB
$JAK_SETTING = jak_get_setting ('module');

// Get all the hooks out the class file
$JAK_HOOK_LOCATIONS = JAK_hooks::jakAllhooks ();

// Now start with the plugin use a switch to access all pages
switch ($page1) {

	// Create new blog
	case 'hooks':

		switch ($page2) {
			case 'lock':

				if (jak_row_exist ($page3, $jaktable2)) {
					$jakdb->query ('UPDATE ' . $jaktable2 . ' SET active = IF (active = 1, 0, 1) WHERE id = "' . smartsql ($page3) . '"');
				}

				// EN: Redirect page
				// CZ: Přesměrování stránky
				jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=s');

				break;
			case 'edit':

				if (jak_row_exist ($page3, $jaktable2)) {

					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$defaults = $_POST;

						if (empty($defaults['jak_name'])) {
							$errors['e1'] = $tl['hook_error']['hookerror1'];
						}

						if (empty($defaults['jak_hook'])) {
							$errors['e2'] = $tl['hook_error']['hookerror2'];
						}

						if (!is_numeric ($defaults['jak_exorder'])) {
							$errors['e3'] = $tl['hook_error']['hookerror3'];
						}

						if (count ($errors) == 0) {

							$result = $jakdb->query ('UPDATE ' . $jaktable2 . ' SET
						name = "' . smartsql ($defaults['jak_name']) . '",
						hook_name = "' . smartsql ($defaults['jak_hook']) . '",
						phpcode = "' . smartsql ($defaults['jak_phpcode']) . '",
						exorder = "' . smartsql ($defaults['jak_exorder']) . '",
						pluginid = "' . smartsql ($defaults['jak_plugin']) . '",
						time = NOW() ,
						active = 1
						WHERE id = "' . smartsql ($page3) . '"');


							if (!$result) {
								// EN: Redirect page
								// CZ: Přesměrování stránky
								jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=edit&sssp=' . $page3 . '&ssssp=e');
							} else {
								// EN: Redirect page
								// CZ: Přesměrování stránky
								jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=edit&sssp=' . $page3 . '&ssssp=s');
							}
						} else {

							$errors['e'] = $tl['general_error']['generror'];
							$errors      = $errors;
						}
					}

					// Get the data from thbe hook
					$JAK_FORM_DATA = jak_get_data ($page3, $jaktable2);

					// EN: Title and Description
					// CZ: Titulek a Popis
					$SECTION_TITLE = $tl["hook_sec_title"]["hookt"];
					$SECTION_DESC  = $tl["hook_sec_desc"]["hookd"];

					// EN: Load the template
					// CZ: Načti template (šablonu)
					$template = 'edithook.php';
				}

				break;
			case 'delete':

				if (jak_row_exist ($page3, $jaktable2)) {

					if ($page3 >= 5) {

						$jakdb->query ('DELETE FROM ' . $jaktable2 . ' WHERE id = "' . smartsql ($page3) . '" LIMIT 1');


						// EN: Redirect page
						// CZ: Přesměrování stránky
						jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=s');
					} else {
						// EN: Redirect page
						// CZ: Přesměrování stránky
						jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=edn');
					}
				}

				break;
			default:

				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jak_delete_hook'])) {
					$defaults = $_POST;

					if (isset($defaults['lock'])) {

						$lockuser = $defaults['jak_delete_hook'];

						for ($i = 0; $i < count ($lockuser); $i ++) {
							$locked = $lockuser[ $i ];

							$result = $jakdb->query ('UPDATE ' . $jaktable2 . ' SET active = IF (active = 1, 0, 1) WHERE id = ' . $locked . '');
						}


						if (!$result) {
							// EN: Redirect page
							// CZ: Přesměrování stránky
							jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=e');
						} else {
							// EN: Redirect page
							// CZ: Přesměrování stránky
							jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=s');
						}

					}

					if (isset($defaults['delete'])) {

						$lockuser = $defaults['jak_delete_hook'];

						for ($i = 0; $i < count ($lockuser); $i ++) {
							$locked = $lockuser[ $i ];

							if ($locked >= 5) {

								$result = $jakdb->query ('DELETE FROM ' . $jaktable2 . ' WHERE id = "' . smartsql ($locked) . '"');
							}

						}

						if (!$result) {
							// EN: Redirect page
							// CZ: Přesměrování stránky
							jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=e');
						} else {
							// EN: Redirect page
							// CZ: Přesměrování stránky
							jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=s');
						}

					}

				}

				// Important template Stuff
				$getTotal = jak_get_total ($jaktable2, '', '', '');
				if ($getTotal != 0) {
					// Paginator
					$pages                 = new JAK_Paginator;
					$pages->items_total    = $getTotal;
					$pages->mid_range      = $jkv["adminpagemid"];
					$pages->items_per_page = $jkv["adminpageitem"];
					$pages->jak_get_page   = $page2;
					$pages->jak_where      = 'index.php?p=plugins&sp=hooks';
					$pages->paginate ();
					$JAK_PAGINATE = $pages->display_pages ();
				}

				// SQL Query
				$result = $jakdb->query ('SELECT * FROM ' . DB_PREFIX . 'pluginhooks ORDER BY exorder ASC ' . $pages->limit);
				while ($row = $result->fetch_assoc ()) {
					$plhooks[] = $row;
				}

				// Get all plugins out the databse
				$JAK_HOOKS = $plhooks;

				// EN: Title and Description
				// CZ: Titulek a Popis
				$SECTION_TITLE = $tl["hook_sec_title"]["hookt1"];
				$SECTION_DESC  = $tl["hook_sec_desc"]["hookd1"];

				// EN: Load the template
				// CZ: Načti template (šablonu)
				$template = 'hooks.php';

				break;
		}

		break;
	case 'sorthooks':

		// Important template Stuff
		if (is_numeric ($page2)) {
			$sortwhere = 'pluginid';
		} else {
			$sortwhere = 'hook_name';
		}

		// SQL Query
		$result = $jakdb->query ('SELECT t1.id, t1.hook_name, t1.name, t1.pluginid, t1.active, t2.name AS pluginname FROM ' . DB_PREFIX . 'pluginhooks AS t1 LEFT JOIN ' . DB_PREFIX . 'plugins AS t2 ON(t1.pluginid = t2.id) WHERE ' . $sortwhere . ' = "' . smartsql ($page2) . '" ORDER BY exorder ASC');
		while ($row = $result->fetch_assoc ()) {
			$JAK_HOOKS[] = $row;
		}

		// Get the plugin name
		if (isset($JAK_HOOKS) && is_array ($JAK_HOOKS)) foreach ($JAK_HOOKS as $vpn) {
			if ($vpn['pluginid'] == $page2) $JAK_PLUGIN_NAME = $vpn['pluginname'];
		}

		// EN: Title and Description
		// CZ: Titulek a Popis
		$SECTION_TITLE = $tl["hook_sec_title"]["hookt2"];
		$SECTION_DESC  = (is_numeric ($page2) ? $tl["hook_sec_desc"]["hookd2"] . ': ' . $JAK_PLUGIN_NAME : $tl["hook_sec_desc"]["hookd3"] . ': ' . $page2);

		// EN: Load the template
		// CZ: Načti template (šablonu)
		$template = 'sorthooks.php';

		break;
	case 'newhook':

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$defaults = $_POST;

			if (empty($defaults['jak_name'])) {
				$errors['e1'] = $tl['hook_error']['hookerror1'];
			}

			if (empty($defaults['jak_hook'])) {
				$errors['e2'] = $tl['hook_error']['hookerror2'];
			}

			if (!is_numeric ($defaults['jak_exorder'])) {
				$errors['e3'] = $tl['hook_error']['hookerror3'];
			}

			if (count ($errors) == 0) {

				$result = $jakdb->query ('INSERT INTO ' . $jaktable2 . ' SET
				name = "' . smartsql ($defaults['jak_name']) . '",
				hook_name = "' . smartsql ($defaults['jak_hook']) . '",
				phpcode = "' . smartsql ($defaults['jak_phpcode']) . '",
				exorder = "' . smartsql ($defaults['jak_exorder']) . '",
				pluginid = "' . smartsql ($defaults['jak_plugin']) . '",
				time = NOW(),
				active = 1');

				$rowid = $jakdb->jak_last_id ();

				if (!$result) {
					// EN: Redirect page
					// CZ: Přesměrování stránky
					jak_redirect (BASE_URL . 'index.php?p=plugins&sp=newhook&ssp=e');
				} else {
					// EN: Redirect page
					// CZ: Přesměrování stránky
					jak_redirect (BASE_URL . 'index.php?p=plugins&sp=hooks&ssp=edit&sssp=' . $rowid . '&ssssp=s');
				}
			} else {

				$errors['e'] = $tl['error']['e'];
				$errors      = $errors;
			}
		}

		// EN: Title and Description
		// CZ: Titulek a Popis
		$SECTION_TITLE = $tl["hook_sec_title"]["hookt3"];
		$SECTION_DESC  = $tl["hook_sec_desc"]["hookd4"];

		// EN: Load the template
		// CZ: Načti template (šablonu)
		$template = 'newhook.php';

		break;
	default:

		switch ($page1) {
			case 'lock':

				if (jak_row_exist ($page2, $jaktable1)) {
					$jakdb->query ('UPDATE ' . $jaktable1 . ' SET active = IF (active = 1, 0, 1) WHERE id = "' . smartsql ($page2) . '"');
					$jakdb->query ('UPDATE ' . $jaktable . ' SET activeplugin = IF (activeplugin = 1, 0, 1) WHERE pluginid = "' . smartsql ($page2) . '"');
					$jakdb->query ('UPDATE ' . $jaktable2 . ' SET active = IF (active = 1, 0, 1) WHERE pluginid = "' . smartsql ($page2) . '"');
				}

				// EN: Redirect page
				// CZ: Přesměrování stránky
				jak_redirect (BASE_URL . 'index.php?p=plugins&sp=s');

				break;
			default:

				// Let's go on with the script
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$defaults = $_POST;

					if (isset($defaults['real_id'])) {

						$pluginid   = $defaults['real_id'];
						$realid     = implode (',', $defaults['real_id']);
						$realaccess = $defaults['access'];
						$changea    = array_combine ($pluginid, $realaccess);

						// Then go on with the access rights
						$updatesqla = "";
						foreach ($changea as $keya => $pluga) {
							$updatesqla .= sprintf ("WHEN %d THEN '%s' ", $keya, $pluga);
						}

						// Update in one query
						$result1a = $jakdb->query ('UPDATE ' . $jaktable1 . ' SET access = CASE id
		 			    	' . $updatesqla . '
		 			    	END
		 			    	WHERE id IN (' . $realid . ')');

						if ($result1a) {

							// and finaly update the setting table
							$result1 = $jakdb->query ('UPDATE ' . DB_PREFIX . 'setting SET value = CASE varname
		 							WHEN "accessgeneral" THEN "' . smartsql ($defaults['jak_generala']) . '"
		 						    WHEN "accessmanage" THEN "' . smartsql ($defaults['jak_managea']) . '"
		 						END
		 							WHERE varname IN ("accessgeneral","accessmanage")');

							if (!$result1) {
								// EN: Redirect page
								// CZ: Přesměrování stránky
								jak_redirect (BASE_URL . 'index.php?p=plugins&sp=e');
							} else {
								// EN: Redirect page
								// CZ: Přesměrování stránky
								jak_redirect (BASE_URL . 'index.php?p=plugins&sp=s');
							}
						}

					}

				}

				// Get all styles in the directory
				$site_plugins = jak_get_site_style ('../plugins/');

				// EN: Title and Description
				// CZ: Titulek a Popis
				$SECTION_TITLE = $tl["plug_sec_title"]["plugt"];
				$SECTION_DESC  = $tl["plug_sec_desc"]["plugd"];

				// EN: Load the template
				// CZ: Načti template (šablonu)
				$template = 'plugins.php';
		}
}
?>