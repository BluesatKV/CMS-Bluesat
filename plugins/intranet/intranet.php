<?php

// EN: Check if the file is accessed only via index.php if not stop the script from running
// CZ: Kontrola, zdali je soubor přístupný pouze přes index.php - pokud ne ukončí se script
if (!defined('ENVO_PREVENT_ACCESS')) die($tl['general_error']['generror40']);

$CHECK_USR_SESSION = session_id();

// -------- DATA FOR ALL FRONTEND PAGES --------
// -------- DATA PRO VŠECHNY FRONTEND STRÁNKY --------

// EN: Show content in template only the user have access (SuperAdmin always has access)
// CZ:
$ENVO_MODULES_ACCESS = $envouser -> envoModuleAccess(ENVO_USERID, '1,2');

// EN: Set base plugin folder - template
// CZ: Nastavení základní složky pluginu - šablony
$BASE_PLUGIN_URL_TEMPLATE  = APP_PATH . 'plugins/intranet/template/';
$SHORT_PLUGIN_URL_TEMPLATE = '/plugins/intranet/template/';

// EN: Import important settings for the template from the DB (only VALUE)
// CZ: Importuj důležité nastavení pro šablonu z DB (HODNOTY)
$ENVO_SETTING_VAL = envo_get_setting_val('intranet');

// EN: Set data for the frontend page - Title, Description, Keywords and other ...
// CZ: Nastavení dat pro frontend stránku - Titulek, Popis, Klíčová slova a další ...
$PAGE_TITLE = $setting["intranettitle"];

// EN: Settings all the tables we need for our work
// CZ: Nastavení všech tabulek, které potřebujeme pro práci
$envotable   = DB_PREFIX . 'int_house';
$envotable1  = DB_PREFIX . 'int_housecontact';
$envotable2  = DB_PREFIX . 'int_houseserv';
$envotable3  = DB_PREFIX . 'int_houseimg';
$envotable4  = DB_PREFIX . 'int_housenotifications';
$envotable5  = DB_PREFIX . 'int_housenotificationug';
$envotable6  = DB_PREFIX . 'int_housedocu';
$envotable7  = DB_PREFIX . 'int_houseent';
$envotable8  = DB_PREFIX . 'int_houseapt';
$envotable9  = DB_PREFIX . 'int_housetasks';
$envotable10 = DB_PREFIX . 'int_housevideo';
$envotable11 = DB_PREFIX . 'int_houseanalytics';
$envotable12 = DB_PREFIX . 'int_houseanalyticsdocu';
$envotable13 = DB_PREFIX . 'int_houseanalyticsimg';
$envotable14 = DB_PREFIX . 'int_settings_city';
$envotable15 = DB_PREFIX . 'int_settings_cityarea';

// Parse links once if needed a lot of time
$backtoplugin = ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '', '', '', '');

// EN: If the user is logged in, get username and usergroup name
// CZ: Pokud je uživatel přihlášen, získej uživatelské jméno a jméno uživatelské skupiny
if (ENVO_USERID) {

  // Get the user name
  $ENVO_USER_NAME = $envouser -> getVar('name');
  // Get the user avatar
  $ENVO_USER_AVATAR = $envouser -> getVar('picture');
  // Get the user group name
  $result          = $envodb -> query('SELECT name FROM ' . DB_PREFIX . 'usergroup WHERE id="' . $envouser -> getVar("usergroupid") . '"');
  $row             = $result -> fetch_assoc();
  $ENVO_USER_GROUP = $row['name'];

}

// EN: Include the functions
// CZ: Vložené funkce
include_once("functions.php");

// EN: Info about notifications
// CZ: Info o notifikacích
$ENVO_NOTIFICATION = envo_get_notification_unread(ENVO_USERGROUPID, FALSE, $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);

// EN: Import important settings for the template from the DB (only VALUE)
// CZ: Importuj důležité nastavení pro šablonu z DB (HODNOTY)
$ENVO_SETTING_VAL = envo_get_setting_val('intranet');

// EN: Get permissions for House Analytics
// CZ: Získání přístupových práv do analýzy bytových domů
$result = $envodb -> query('SELECT intranetanalytics FROM ' . DB_PREFIX . 'usergroup WHERE id = "' . ENVO_USERGROUPID . '" LIMIT 1');
if ($envodb -> affected_rows === 1) {
  $row = $result -> fetch_assoc();
  if ($row['intranetanalytics'] == 1 || ENVO_USERGROUPID == 3) {
    $usergroupanalytics = $ENVO_GROUP_ACCESS_ANALYTICS = TRUE;
  }
} else {
  if ($row['intranetanalytics'] == 0 || ENVO_USERGROUPID == 3) {
    $usergroupanalytics = $ENVO_GROUP_ACCESS_ANALYTICS = TRUE;
  } else {
    $usergroupanalytics = $ENVO_GROUP_ACCESS_ANALYTICS = FALSE;
  }
}

// -------- DATA FOR SELECTED FRONTEND PAGES --------
// -------- DATA PRO VYBRANÉ FRONTEND STRÁNKY --------

// EN: Switching access all pages by page name
// CZ: Přepínání přístupu všech stránek podle názvu stránky
switch ($page1) {
  case '404':
    // CUSTOM ERROR PAGE FOR PLUGIN

    // EN: Load the php template
    // CZ: Načtení php template (šablony)
    $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_404.php';

    break;
  case 'house':
    // HOUSE

    switch ($page2) {
      case 'h':
        // INFO ABOUT HOUSE

        // EN: Default Variable
        // CZ: Hlavní proměnné
        $pageID = $page3;

        if (is_numeric($pageID) && envo_row_exist($pageID, $envotable)) {

          // EN: Check if user has permission to see it - usergroup 'Administrator' have permission to all data automatically
          // Cz: Kontrola jestli má uživatel přístup k datům - Uživatelská skupina 'Administrátor' má přístup ke všem datům automaticky
          if (envo_row_permission($pageID, $envotable, ENVO_USERGROUPID)) {
            // USER HAVE PERMISSION

            // EN: Get the data of house
            // CZ: Získání dat o domu
            $result = $envodb -> query('SELECT t1.*,t2.id, t2.city FROM ' . $envotable . ' t1 LEFT JOIN ' . $envotable14 . ' t2 ON t1.city = t2.id WHERE t1.id = "' . smartsql($pageID) . '" LIMIT 1');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $envohousedetail[]    = $row;
              $envo_house_name      = $row['name'];
              $envo_house_latitude  = $row['latitude'];
              $envo_house_longitude = $row['longitude'];
            }

            // Convert multidimensional array to associated array
            $ENVO_HOUSE_DETAIL = array ();
            foreach ($envohousedetail as $array) {
              foreach ($array as $k => $v) {
                $ENVO_HOUSE_DETAIL[$k] = $v;
              }
            }

            // EN: Get the data of Tasks
            // CZ: Získání dat o Úkolech
            $result = $envodb -> query('SELECT * FROM ' . $envotable9 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id DESC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Change number to string
              // CZ: Změna čísla na text
              switch ($row['priority']) {
                case '0':
                  $priority = '<span class="label">Nedůležitá</span>';
                  break;
                case '1':
                  $priority = '<span class="label">Nízká priorita</span>';
                  break;
                case '2':
                  $priority = '<span class="label label-warning">Střední priorita</span>';
                  break;
                case '3':
                  $priority = '<span class="label label-important">Vysoká priorita</span>';
                  break;
                case '4':
                  $priority = '<span class="label label-important">Nejvyšší priorita</span>';
                  break;
              }

              switch ($row['status']) {
                case '0':
                  $status = 'Žádný status';
                  break;
                case '1':
                  $status = 'Zápis';
                  break;
                case '2':
                  $status = 'V řešení';
                  break;
                case '3':
                  $status = 'Vyřešeno - Uzavřeno';
                  break;
                case '4':
                  $status = 'Stornováno';
                  break;
              }

              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_TASK[] = array (
                'id'          => $row['id'],
                'houseid'     => $row['houseid'],
                'priority'    => $priority,
                'status'      => $status,
                'title'       => $row['title'],
                'description' => $row['description'],
                'reminder'    => date($ENVO_SETTING_VAL['intranetdateformat'], strtotime($row['reminder'])),
                'time'        => date($ENVO_SETTING_VAL['intranetdateformat'], strtotime($row['time'])),
              );

            }

            // EN: Get the data about the antenna system
            // CZ: Získání dat o anténním systému
            $result = $envodb -> query('SELECT antennadescription FROM ' . $envotable . ' WHERE id = "' . smartsql($pageID) . '" ORDER BY id ASC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_TECH = $row['antennadescription'];
            }

            // EN: Get the data of main contacts
            // CZ: Získání dat o hlavních kontaktech
            $result = $envodb -> query('SELECT * FROM ' . $envotable1 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id ASC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_CONT[] = $row;
            }

            // EN: Get the data of entrance
            // CZ: Získání dat o vchodech
            $result = $envodb -> query('SELECT * FROM ' . $envotable7 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id ASC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_ENT[] = $row;
            }

            // EN: Get the data of apartment
            // CZ: Získání dat o bytech
            $result = $envodb -> query('SELECT * FROM ' . $envotable8 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id ASC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_APT[] = $row;
            }

            // EN: Get the data of services
            // CZ: Získání dat o servisech
            $result = $envodb -> query('SELECT * FROM ' . $envotable2 . ' WHERE houseid = "' . smartsql($pageID) . '" AND deleted = 0 ORDER BY id DESC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_SERV[] = $row;
            }

            // EN: Get the data of documentation
            // CZ: Získání dat o dokumentech
            $result = $envodb -> query('SELECT * FROM ' . $envotable6 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id ASC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_DOCU[] = $row;
            }

            // EN: Get the data for Photogallery - isotope photo
            // CZ: Získání dat pro Fotogalerii - isotope photo
            $result = $envodb -> query('SELECT * FROM ' . $envotable3 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id DESC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_IMG_ISO[] = $row;
            }

            // EN: Get all the data for the Photogallery - list photo
            // CZ: Získání všech dat pro Fotogalerii - list photo

            // EN: Setlocale
            $envodb -> query('SET lc_time_names = "' . $setting["locale"] . '"');
            // EN: Get 'timedefault'
            $result = $envodb -> query('SELECT distinct(DATE_FORMAT(timedefault, "%Y - %M")) as d FROM ' . $envotable3 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY timedefault DESC');
            // EN: Get all photo by date for house
            while ($row = $result -> fetch_assoc()) {

              $date       = $row['d'];
              $dateFormat = ucwords(strtolower($date), '\'- ');;

              $ENVO_HOUSE_IMG_LIST[$date]['timedefault'] = $dateFormat;

              //
              $result1 = $envodb -> query('SELECT * FROM ' . $envotable3 . ' WHERE houseid = "' . smartsql($pageID) . '" AND DATE_FORMAT(timedefault,"%Y - %M") = "' . $date . '"');

              while ($row1 = $result1 -> fetch_assoc()) {

                $ENVO_HOUSE_IMG_LIST[$date]['photos'][] = $row1;

              }
            }

            // EN: Get the data of videos
            // CZ: Získání dat o videích
            $result = $envodb -> query('SELECT * FROM ' . $envotable10 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id DESC');
            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_HOUSE_VIDEO[] = $row;
            }

            // EN: Breadcrumbs activation
            // CZ: Aktivace Breadcrumbs
            $BREADCRUMBS = TRUE;

            // EN: Title and Description
            // CZ: Titulek a Popis
            $SECTION_TITLE = 'Domy ve správě';
            $SECTION_DESC  = 'Detail bytového domu ve správě <strong>' . $envo_house_name . '</strong>';

            // EN: Load the php template
            // CZ: Načtení php template (šablony)
            $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_house_detail.php';

          } else {
            // USER HAVE NOT PERMISSION

            envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));

          }

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      case 'searchdvbt2':
        // SEARCH BY PREPARATION ON DVB-T2

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_all'])) {

          // EN: Getting the data about the Houses
          // CZ: Získání dat o bytových domech
          $ENVO_HOUSE_ALL = envo_get_house_info($envotable, $envotable14, FALSE, ENVO_USERGROUPID);

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Button activation
          // CZ: Aktivace tlačítek
          $ACTIVEBUTTON_CLASS1 = 'btn-success';

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Domy ve správě';
          $SECTION_DESC  = 'Zobrazení všech bytových domů';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_house.php';

        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchdvbt2_yes'])) {

          // EN: Getting the data about the Houses
          // CZ: Získání dat o bytových domech
          $ENVO_HOUSE_ALL = envo_get_house_info($envotable, $envotable14, FALSE, ENVO_USERGROUPID, 'preparationdvb = 1');

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Button activation
          // CZ: Aktivace tlačítek
          $ACTIVEBUTTON_CLASS2 = 'btn-success';

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Domy ve správě';
          $SECTION_DESC  = 'Vyhledání bytových domů ve správě <strong>s přípravou DVB-T2</strong>';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_house.php';

        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchdvbt2_no'])) {

          // EN: Getting the data about the Houses
          // CZ: Získání dat o bytových domech
          $ENVO_HOUSE_ALL = envo_get_house_info($envotable, $envotable14, FALSE, ENVO_USERGROUPID, 'preparationdvb = 0');

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Button activation
          // CZ: Aktivace tlačítek
          $ACTIVEBUTTON_CLASS3 = 'btn-success';

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Domy ve správě';
          $SECTION_DESC  = 'Vyhledání bytových domů ve správě <strong>bez přípravy DVB-T2</strong>';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_house.php';

        }

        break;
      default:

        // ----------- ERROR: REDIRECT PAGE ------------
        // -------- CHYBA: PŘESMĚROVÁNÍ STRÁNKY --------

        // EN: If not exist value in 'case', redirect page to 404
        // CZ: Pokud neexistuje 'case', dochází k přesměrování stránek na 404
        if (!empty($page2)) {
          if ($page2 != 'h' || $page2 != 'searchdvbt2') {
            envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));
          }
        }

        // ----------- SUCCESS: CODE FOR MAIN PAGE ------------
        // -------- VŠE V POŘÁDKU: KÓD PRO HLAVNÍ STRÁNKU --------

        // EN: Getting the data about the Houses by usergroupid
        // CZ: Získání dat o bytových domech podle 'id' uživatelské skupiny
        $ENVO_HOUSE_ALL = envo_get_house_info($envotable, $envotable14, FALSE, ENVO_USERGROUPID);

        // EN: Breadcrumbs activation
        // CZ: Aktivace Breadcrumbs
        $BREADCRUMBS = TRUE;

        // EN: Title and Description
        // CZ: Titulek a Popis
        $SECTION_TITLE = 'Domy ve správě';
        $SECTION_DESC  = 'Seznam bytových domů ve správě';

        // EN: Load the php template
        // CZ: Načtení php template (šablony)
        $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_house.php';

    }

    break;
  case 'houseanalytics':
    // HOUSE ANALYTICS

    switch ($page2) {
      case 'h':
        // INFO ABOUT HOUSE

        // EN: Default Variable
        // CZ: Hlavní proměnné
        $pageID = $page3;

        if (is_numeric($pageID) && envo_row_exist($pageID, $envotable11) && $usergroupanalytics) {

          // EN: Get the data of house
          // CZ: Získání dat o domu
          $result = $envodb -> query('SELECT * FROM ' . $envotable11 . ' WHERE id = "' . smartsql($pageID) . '" LIMIT 1');
          while ($row = $result -> fetch_assoc()) {
            // EN: Insert each record into array
            // CZ: Vložení získaných dat do pole
            $envohousedetail[] = $row;
            $envo_house_name       = $row['name'];
            $envo_house_latitude   = $row['latitude'];
            $envo_house_longitude  = $row['longitude'];
          }

          // Convert multidimensional array to associated array
          $ENVO_HOUSEANALYTICS_DETAIL = array ();
          foreach ($envohousedetail as $array) {
            foreach ($array as $k => $v) {
              $ENVO_HOUSEANALYTICS_DETAIL[$k] = $v;
            }
          }

          // EN: Get the data of main contacts
          // CZ: Získání dat o hlavních kontaktech
          $result = $envodb -> query('SELECT contact1, contactphone1, contactmail1, contactdate1, contactaddress1, contact2, contactphone2, contactmail2, contactdate2, contactaddress2, contact3, contactphone3, contactmail3, contactdate3, contactaddress3, contact4, contactphone4, contactmail4, contactdate4, contactaddress4, contact5, contactphone5, contactmail5, contactdate5, contactaddress5, contact6, contactphone6, contactmail6, contactdate6, contactaddress6, contact7, contact8, contact9, contact10, contact11, contact12 FROM ' . $envotable11 . ' WHERE id = "' . smartsql($pageID) . '" ORDER BY id ASC');
          while ($row = $result -> fetch_assoc()) {
            // EN: Insert each record into array
            // CZ: Vložení získaných dat do pole
            $ENVO_HOUSEANALYTICS_CONT = $row;
          }

          // EN: Get the data of documentation
          // CZ: Získání dat o dokumentech
          $result = $envodb -> query('SELECT * FROM ' . $envotable12 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY id ASC');
          while ($row = $result -> fetch_assoc()) {
            // EN: Insert each record into array
            // CZ: Vložení získaných dat do pole
            $ENVO_HOUSEANALYTICS_DOCU[] = $row;
          }

          // EN: Get all the data for the Photogallery - list photo
          // CZ: Získání všech dat pro Fotogalerii - list photo

          // EN: Setlocale
          $envodb -> query('SET lc_time_names = "' . $setting["locale"] . '"');
          // EN: Get 'timedefault'
          $result = $envodb -> query('SELECT distinct(DATE_FORMAT(timedefault, "%Y - %M")) as d FROM ' . $envotable13 . ' WHERE houseid = "' . smartsql($pageID) . '" ORDER BY timedefault DESC');
          // EN: Get all photo by date for house
          while ($row = $result -> fetch_assoc()) {

            $date       = $row['d'];
            $dateFormat = ucwords(strtolower($date), '\'- ');;

            $ENVO_HOUSEANALYTICS_IMG_LIST[$date]['timedefault'] = $dateFormat;

            //
            $result1 = $envodb -> query('SELECT * FROM ' . $envotable13 . ' WHERE houseid = "' . smartsql($pageID) . '" AND DATE_FORMAT(timedefault,"%Y - %M") = "' . $date . '"');

            while ($row1 = $result1 -> fetch_assoc()) {

              $ENVO_HOUSEANALYTICS_IMG_LIST[$date]['photos'][] = $row1;

            }
          }

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Analýza domů - Přehled domů';
          $SECTION_DESC  = 'Detail bytového domu <strong>' . $envo_house_name . '</strong>';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_houseanalytics_detail.php';

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      case 'stats-kv':
        // HOUSE ANALYTICS STATS

        if ($usergroupanalytics) {

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Analýza domů - Statistika Okres Karlovy Vary';
          $SECTION_DESC  = '';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_houseanalytics_stats_kv.php';

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      case 'stats-so':
        // HOUSE ANALYTICS STATS

        if ($usergroupanalytics) {

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Analýza domů - Statistika Okres Sokolov';
          $SECTION_DESC  = '';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_houseanalytics_stats_so.php';

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      case 'stats-ch':
        // HOUSE ANALYTICS STATS

        if ($usergroupanalytics) {

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Analýza domů - Statistika Okres Cheb';
          $SECTION_DESC  = '';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_houseanalytics_stats_ch.php';

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      default:

        // ----------- ERROR: REDIRECT PAGE ------------
        // -------- CHYBA: PŘESMĚROVÁNÍ STRÁNKY --------

        // EN: If not exist value in 'case', redirect page to 404
        // CZ: Pokud neexistuje 'case', dochází k přesměrování stránek na 404
        if (!empty($page2)) {
          if ($page2 != 'h' || $page2 != 'stats-kv' || $page2 != 'stats-so' || $page2 != 'stats-ch') {
            envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));
          }
        }

        // ----------- SUCCESS: CODE FOR MAIN PAGE ------------
        // -------- VŠE V POŘÁDKU: KÓD PRO HLAVNÍ STRÁNKU --------

        if ($usergroupanalytics) {

          // EN: Getting the data about the Houses by usergroupid
          // CZ: Získání dat o bytových domech podle 'id' uživatelské skupiny
          $ENVO_HOUSE_ALL_LIST = envo_get_houseanalytics_info($envotable11, FALSE, ENVO_USERGROUPID);

          // EN: Breadcrumbs activation
          // CZ: Aktivace Breadcrumbs
          $BREADCRUMBS = TRUE;

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = 'Analýza domů - Přehled domů';
          $SECTION_DESC  = 'Seznam bytových domů v Karlovarské kraji (nejsou ve správě)';

          // EN: Load the php template
          // CZ: Načtení php template (šablony)
          $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_houseanalytics.php';

        } else {
          envo_redirect($backtoplugin);
        }

    }

    break;
  case 'notification':
    // NOTIFICATION

    switch ($page2) {
      case 'n':
        // INFO ABOUT NOTIFICATION

        // EN: Default Variable
        // CZ: Hlavní proměnné
        $pageID = $page3;

        if (is_numeric($pageID) && envo_row_exist($pageID, $envotable4)) {

          // EN: Check if user has permission to see it - usergroup 'Administrator' have permission to all data automatically
          // Cz: Kontrola jestli má uživatel přístup k datům - Uživatelská skupina 'Administrátor' má přístup ke všem datům automaticky
          if (envo_row_permission($pageID, $envotable4, ENVO_USERGROUPID)) {
            // USER HAVE PERMISSION

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              // EN: Default Variable
              // CZ: Hlavní proměnné
              $defaults = $_POST;

              if (isset($_POST['btnRead'])) {

                /* EN: Convert value
                   * smartsql - secure method to insert form data into a MySQL DB
                   * url_slug  - friendly URL slug from a string
                   * ------------------
                   * CZ: Převod hodnot
                   * smartsql - secure method to insert form data into a MySQL DB
                   * url_slug  - friendly URL slug from a string
                  */
                $result = $envodb -> query('UPDATE ' . $envotable5 . ' SET
                          unread = "1"
                          WHERE notification_id = "' . smartsql($pageID) . '"
                          AND usergroup_id = "' . ENVO_USERGROUPID . '"');

                if (!$result) {

                } else {
                  // EN: Info about notifications - refresh data
                  // CZ: Info o notifikacích - refresh data
                  $ENVO_NOTIFICATION = envo_get_notification_unread(ENVO_USERGROUPID, FALSE, $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);
                }

              }

            }

            $result = $envodb -> query('
                      SELECT ' . $envotable4 . '.*, ' . $envotable5 . '.unread 
                      FROM ' . $envotable4 . ', ' . $envotable5 . ' 
                      WHERE ' . $envotable4 . '.id = "' . smartsql($pageID) . '"
                      AND ' . $envotable5 . '.notification_id="' . smartsql($pageID) . '"
                      AND ' . $envotable5 . '.usergroup_id="' . ENVO_USERGROUPID . '"
                      LIMIT 1
                      ');

            while ($row = $result -> fetch_assoc()) {
              // EN: Insert each record into array
              // CZ: Vložení získaných dat do pole
              $ENVO_NOTIFICATION_DETAIL[] = array (
                'name'    => $row['name'],
                'type'    => $row['type'],
                'content' => $row['content'],
                'created' => date($ENVO_SETTING_VAL['intranetdateformat'] . $ENVO_SETTING_VAL['intranettimeformat'], strtotime($row['created']))
              );
            }

            // EN: Breadcrumbs activation
            // CZ: Aktivace Breadcrumbs
            $BREADCRUMBS = TRUE;

            // EN: Title and Description
            // CZ: Titulek a Popis
            $SECTION_TITLE = 'Notifikace';
            $SECTION_DESC  = 'Detail notifikace';

            // EN: Load the php template
            // CZ: Načtení php template (šablony)
            $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_notification_detail.php';

          } else {
            // USER HAVE NOT PERMISSION

            envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));

          }

        } else {
          envo_redirect($backtoplugin);
        }

        break;
      default:

        // ----------- ERROR: REDIRECT PAGE ------------
        // -------- CHYBA: PŘESMĚROVÁNÍ STRÁNKY --------

        // EN: If not exist value in 'case', redirect page to 404
        // CZ: Pokud neexistuje 'case', dochází k přesměrování stránek na 404
        if (!empty($page2)) {
          if ($page2 != 'n') {
            envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));
          }
        }

        // ----------- SUCCESS: CODE FOR MAIN PAGE ------------
        // -------- VŠE V POŘÁDKU: KÓD PRO HLAVNÍ STRÁNKU --------

        // EN: Getting the data about the Notifications by usergroupid
        // CZ: Získání dat o Notifikacích podle 'id' uživatelské skupiny
        $ENVO_NOTIFICATION_ALL = envo_get_notification_all(ENVO_USERGROUPID, FALSE, $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);

        // EN: Breadcrumbs activation
        // CZ: Aktivace Breadcrumbs
        $BREADCRUMBS = TRUE;

        // EN: Title and Description
        // CZ: Titulek a Popis
        $SECTION_TITLE = 'Notifikace';
        $SECTION_DESC  = 'Seznam notifikací';

        // EN: Load the php template
        // CZ: Načtení php template (šablony)
        $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_notification.php';

    }
    break;
  default:
    // MAIN PAGE OF PLUGIN - DASHBOARD

    // ----------- ERROR: REDIRECT PAGE ------------
    // -------- CHYBA: PŘESMĚROVÁNÍ STRÁNKY --------

    // EN: If not exist value in 'case', redirect page to 404
    // CZ: Pokud neexistuje 'case', dochází k přesměrování stránek na 404
    if (!empty($page1)) {
      if ($page1 != 'house' || $page1 != 'houseanalytics' || $page1 != 'notification') {
        envo_redirect(ENVO_rewrite ::envoParseurl(ENVO_PLUGIN_VAR_INTRANET, '404', '', '', ''));
      }
    }

    // ----------- SUCCESS: CODE FOR MAIN PAGE ------------
    // -------- VŠE V POŘÁDKU: KÓD PRO HLAVNÍ STRÁNKU --------

    // Get the stats
    if (ENVO_USERGROUPID == 3) {
      // EN: If usergroup is 'Administrator'
      // CZ: Pokud je uživatelská skupiny přihlášeného uživatele 'Administrator'

      /* =====================================================
       *  HOUSE - STATISTIC - STATISTIKA DOMŮ VE SPRÁVĚ
       * ===================================================== */
      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result    = $envodb -> query('SELECT COUNT(*) as houseCtotal FROM ' . $envotable);
      $rowCtotal = $result -> fetch_assoc();

      // Count of all records by usergroup
      $ENVO_COUNTS = $rowCtotal['houseCtotal'];
      // Percentage - records by usergroup / all records
      $ENVO_PERCENT = ($rowCtotal['houseCtotal'] * 100) . '%';

      /* =====================================================
       *  HOUSE - TASKS STATISTIC - STATISTIKA ÚKOLŮ
       * ===================================================== */
      // EN: Get the data about delayed Task
      // CZ: Získání dat o zpožděných Úkolech
      $ENVO_HOUSE_TASK_DELAY = envo_get_task_delayed_info(ENVO_USERGROUPID, TRUE, 'tabs3', $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);

      // Count of all records by usergroup
      $ENVO_TASK_DELAY_COUNTS = $ENVO_HOUSE_TASK_DELAY['count_of_task'];
      // Percentage - records by usergroup / all records
      $ENVO_TASK_DELAY_PERCENT = ($ENVO_HOUSE_TASK_DELAY['count_of_task'] * 100) . '%';

      // EN: Get the data about active Task
      // CZ: Získání dat o aktivních Úkolech
      $ENVO_HOUSE_TASK = envo_get_task_info(ENVO_USERGROUPID, TRUE, 'tabs3', $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);

      // Count of all records by usergroup
      $ENVO_TASK_COUNTS = $ENVO_HOUSE_TASK['count_of_task'];
      // Percentage - records by usergroup / all records
      $ENVO_TASK_PERCENT = ($ENVO_HOUSE_TASK['count_of_task'] * 100) . '%';

    } else {
      // EN: For other usergroup
      // CZ: Ostatní uživatelské skupiny přihlášených uživatelů

      /* =====================================================
       *  HOUSE - STATISTIC - STATISTIKA DOMŮ VE SPRÁVĚ
       * ===================================================== */
      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result    = $envodb -> query('SELECT COUNT(*) as houseCtotal FROM ' . $envotable);
      $rowCtotal = $result -> fetch_assoc();

      if ($rowCtotal['houseCtotal'] > 0) {
        // EN: If '$rowCtotal' have some record
        // CZ: Pokud '$rowCtotal' obsahuje záznam

        // EN: Getting count of records in DB by usergroup
        // CZ: Získání počtu záznamů v DB podle uživatelské skupiny
        // Find in permission column 'usergroupid' or '0'. 0 means availability for all user groups.
        $result = $envodb -> query('SELECT * FROM ' . $envotable . ' WHERE FIND_IN_SET("' . ENVO_USERGROUPID . '", permission) OR  FIND_IN_SET("0", permission)');

        // EN: Determine the number of rows in the result from DB
        // CZ: Určení počtu řádků ve výsledku z DB
        $row_cnt = $result -> num_rows;

        // Count of all records by usergroup
        $ENVO_COUNTS = $row_cnt;
        // Percentage - records by usergroup / all records
        $ENVO_PERCENT = ($row_cnt / $rowCtotal['houseCtotal'] * 100) . '%';

      } else {
        // EN: If '$rowCtotal' have not some record
        // CZ: Pokud '$rowCtotal' neobsahuje záznam

        // Count of all records by usergroup
        $ENVO_COUNTS = 0;
        // Percentage - records by usergroup / all records
        $ENVO_PERCENT = '0%';

      }

      /* =====================================================
       *  HOUSE - TASKS STATISTIC - STATISTIKA ÚKOLŮ
       * ===================================================== */
      // EN: Get the data about delayed Task
      // CZ: Získání dat o zpožděných Úkolech
      $ENVO_HOUSE_TASK_DELAY = envo_get_task_delayed_info(ENVO_USERGROUPID, TRUE, 'tabs3', $ENVO_SETTING_VAL['intranetdateformat'], $ENVO_SETTING_VAL['intranettimeformat']);

      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result     = $envodb -> query('SELECT COUNT(*) as taskCtotal FROM ' . $envotable9 . '  WHERE time < NOW()');
      $taskCtotal = $result -> fetch_assoc();

      // Count of all records by usergroup
      $ENVO_TASK_DELAY_COUNTS = $ENVO_HOUSE_TASK_DELAY['count_of_task'];
      // Percentage - records by usergroup / all records
      $ENVO_TASK_DELAY_PERCENT = ($ENVO_TASK_DELAY_COUNTS / $taskCtotal['taskCtotal'] * 100) . '%';

      // EN: Get the data about active Task
      // CZ: Získání dat o aktivních Úkolech
      $ENVO_HOUSE_TASK = envo_get_task_info(ENVO_USERGROUPID, TRUE, 'tabs3', $ENVO_SETTING_VAL['intranetdateformat']);

      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result     = $envodb -> query('SELECT COUNT(*) as taskCtotal FROM ' . $envotable9);
      $taskCtotal = $result -> fetch_assoc();

      // Count of all records by usergroup
      $ENVO_TASK_COUNTS = $ENVO_HOUSE_TASK['count_of_task'];
      // Percentage - records by usergroup / all records
      $ENVO_TASK_PERCENT = ($ENVO_TASK_COUNTS / $taskCtotal['taskCtotal'] * 100) . '%';

    }

    /* ================================================================
     *  HOUSE ANALYTICS - ANALÝZA SEZNAMU DOMŮ (nejsou ve správě)
     * ================================================================ */

    if ($usergroupanalytics) {

      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result0    = $envodb -> query('SELECT COUNT(*) as houseCtotal FROM ' . $envotable11);
      $rowCtotal = $result0 -> fetch_assoc();

      // Count of all records by usergroup
      $ENVO_COUNTS_ANALYTICS = $rowCtotal['houseCtotal'];
      // Percentage - records by usergroup / all records
      $ENVO_PERCENT_ANALYTICS = ($rowCtotal['houseCtotal'] * 100) . '%';

      // ------------------------
      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result1 = $envodb -> query('SELECT ic, COUNT(*) FROM ' . $envotable11 . ' WHERE ic > 0 GROUP BY ic');
      // EN: Determine the number of rows in the result from DB
      // CZ: Určení počtu řádků ve výsledku z DB
      $rowCnt = $result1 -> num_rows;

      // Count of all records by usergroup
      $ENVO_COUNTS_ANALYTICS1 = $rowCnt;

      // ------------------------
      // EN: Getting count of all records in DB
      // CZ: Získání počtu všech záznamů v DB
      $result2 = $envodb -> query('SELECT COUNT(ic) AS null_ic  FROM ' . $envotable11 . ' WHERE ic = 0');
      $rowCtotal = $result2 -> fetch_assoc();
      $ENVO_COUNTS_ANALYTICS2 = $rowCtotal['null_ic'];


    }

    // ------------------------
    // EN: Breadcrumbs activation
    // CZ: Aktivace Breadcrumbs
    $BREADCRUMBS = FALSE;

    // EN: Load the php template
    // CZ: Načtení php template (šablony)
    $plugin_template = $SHORT_PLUGIN_URL_TEMPLATE . 'int_index.php';

}
?>