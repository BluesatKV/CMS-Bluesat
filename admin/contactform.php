<?php

// EN: Check if the file is accessed only via index.php if not stop the script from running
// CZ: Kontrola, zdali je soubor přístupný pouze přes index.php - pokud ne ukončí se script
if (!defined('JAK_ADMIN_PREVENT_ACCESS')) die($tl['general_error']['generror40']);

// EN: Check if the user has access to this file
// CZ: Kontrola, zdali má uživatel přístup k tomuto souboru
if (!JAK_USERID || !$JAK_MODULEM) envo_redirect(BASE_URL);

// EN: Settings all the tables we need for our work
// CZ: Nastavení všech tabulek, které potřebujeme pro práci
$envotable  = DB_PREFIX . 'contactform';
$envotable1 = DB_PREFIX . 'contactoptions';

// Now start with the plugin use a switch to access all pages
switch ($page1) {
  case 'newcontact':

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // EN: Default Variable
      // CZ: Hlavní proměnné
      $defaults = $_POST;

      if (empty($defaults['jak_title'])) {
        $errors['e1'] = $tl['cf_error']['cferror'] . '<br>';
      }

      if (empty($defaults['jak_lcontent'])) {
        $errors['e2'] = $tl['cf_error']['cferror1'] . '<br>';
      }

      if (count($errors) == 0) {

        /* EN: Convert value
         * smartsql - secure method to insert form data into a MySQL DB
         * ------------------
         * CZ: Převod hodnot
         * smartsql - secure method to insert form data into a MySQL DB
        */
        $result = $jakdb->query('INSERT INTO ' . $envotable . ' SET
                  title = "' . smartsql($defaults['jak_title']) . '",
                  content = "' . smartsql($defaults['jak_lcontent']) . '",
                  email = "' . smartsql($defaults['jak_email']) . '",
                  showtitle = "' . smartsql($defaults['jak_showtitle']) . '",
                  time = NOW()');

        $rowid = $jakdb->jak_last_id();

        $countoption = $defaults['jak_option'];

        for ($i = 0; $i < count($countoption); $i++) {
          $name = $countoption[$i];

          if (!empty($name)) {

            if ($defaults['jak_optiontype'][$i] >= 3 && $defaults['jak_optionmandatory'][$i] > 0) {
              $sqlmand = 1;
            } else {
              $sqlmand = $defaults['jak_optionmandatory'][$i];
            }

            $jakdb->query('INSERT INTO ' . $envotable1 . ' SET
														formid = "' . smartsql($rowid) . '",
														name = "' . smartsql($name) . '",
														typeid = "' . smartsql($defaults['jak_optiontype'][$i]) . '",
														options = "' . smartsql(trim($defaults['jak_options'][$i])) . '",
														mandatory = "' . smartsql($sqlmand) . '",
														forder = "' . smartsql($defaults['jak_optionsort'][$i]) . '"');

          }
        }

        if (!$result) {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&sp=newcontact&status=e');
        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&sp=edit&ssp=' . $rowid . '&status=s');
        }
      } else {

        $errors['e'] = $tl['general_error']['generror'] . '<br>';
        $errors      = $errors;
      }
    }

    // EN: Title and Description
    // CZ: Titulek a Popis
    $SECTION_TITLE = $tl["cf_sec_title"]["cft1"];
    $SECTION_DESC  = $tl["cf_sec_desc"]["cfd1"];

    // EN: Load the template
    // CZ: Načti template (šablonu)
    $template = 'newcontactform.php';

    break;
  default:

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($page1)) {
      // EN: Default Variable
      // CZ: Hlavní proměnné
      $defaults = $_POST;

      if (isset($defaults['lock'])) {

        $lockuser = $defaults['jak_delete_contact'];

        for ($i = 0; $i < count($lockuser); $i++) {
          $locked = $lockuser[$i];
          $result = $jakdb->query('UPDATE ' . $envotable . ' SET active = IF (active = 1, 0, 1) WHERE id = "' . smartsql($locked) . '"');
        }

        if (!$result) {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=e');
        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=s');
        }

      }

      if (isset($defaults['delete'])) {

        $lockuser = $defaults['jak_delete_contact'];

        for ($i = 0; $i < count($lockuser); $i++) {
          $locked = $lockuser[$i];
          $result = $jakdb->query('DELETE FROM ' . $envotable . ' WHERE id = "' . smartsql($locked) . '"');
          $jakdb->query('DELETE FROM ' . $envotable1 . ' WHERE formid = "' . smartsql($locked) . '"');

        }

        if (!$result) {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=e');
        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=s');
        }

      }

    }

    switch ($page1) {
      case 'lock':

        $result = $jakdb->query('UPDATE ' . $envotable . ' SET active = IF (active = 1, 0, 1) WHERE id = "' . smartsql($page2) . '"');

        if (!$result) {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=e');
        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=s');
        }

        break;
      case 'delete':
        if (is_numeric($page2) && envo_row_exist($page2, $envotable)) {

          $result = $jakdb->query('DELETE FROM ' . $envotable . ' WHERE id = "' . smartsql($page2) . '"');

          $jakdb->query('DELETE FROM ' . $envotable1 . ' WHERE formid = "' . smartsql($page2) . '"');

          if (!$result) {
            // EN: Redirect page
            // CZ: Přesměrování stránky
            envo_redirect(BASE_URL . 'index.php?p=contactform&status=w');
          } else {
            // EN: Redirect page
            // CZ: Přesměrování stránky
            envo_redirect(BASE_URL . 'index.php?p=contactform&status=s');
          }

        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=ene');
        }
        break;
      case 'edit':

        if (is_numeric($page2) && envo_row_exist($page2, $envotable)) {

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // EN: Default Variable
            // CZ: Hlavní proměnné
            $defaults = $_POST;

            // Delete the options
            if (!empty($defaults['jak_sod'])) {
              $odel = $defaults['jak_sod'];

              for ($i = 0; $i < count($odel); $i++) {
                $optiondel = $odel[$i];

                $jakdb->query('DELETE FROM ' . $envotable1 . ' WHERE id = "' . $optiondel . '"');
              }
            }

            // Check the form
            if (empty($defaults['jak_title'])) {
              $errors['e1'] = $tl['cf_error']['cferror'] . '<br>';
            }

            if (empty($defaults['jak_lcontent'])) {
              $errors['e2'] = $tl['cf_error']['cferror1'] . '<br>';
            }

            // No errors keep going with the sql queries
            if (count($errors) == 0) {

              /* EN: Convert value
               * smartsql - secure method to insert form data into a MySQL DB
               * ------------------
               * CZ: Převod hodnot
               * smartsql - secure method to insert form data into a MySQL DB
              */
              $result = $jakdb->query('UPDATE ' . $envotable . ' SET
                        title = "' . smartsql($defaults['jak_title']) . '",
                        content = "' . smartsql($defaults['jak_lcontent']) . '",
                        email = "' . smartsql($defaults['jak_email']) . '",
                        showtitle = "' . smartsql($defaults['jak_showtitle']) . '",
                        time = "' . time() . '" WHERE id = "' . smartsql($page2) . '"');

              // Edit options
              $countoption_old = $defaults['jak_option_old'];

              for ($i = 0; $i < count($countoption_old); $i++) {
                $name_old = $countoption_old[$i];

                if ($defaults['jak_optiontype_old'][$i] >= 3 && $defaults['jak_optionmandatory_old'][$i] > 0) {
                  $sqlmand = 1;
                } else {
                  $sqlmand = $defaults['jak_optionmandatory_old'][$i];
                }

                $jakdb->query('UPDATE ' . $envotable1 . ' SET
																name = "' . smartsql($name_old) . '",
																typeid = "' . smartsql($defaults['jak_optiontype_old'][$i]) . '",
																options = "' . smartsql(trim($defaults['jak_options_old'][$i])) . '",
																mandatory = "' . smartsql($sqlmand) . '",
																forder = "' . smartsql($defaults['jak_optionsort_old'][$i]) . '"
																WHERE formid = "' . smartsql($page2) . '" AND id = "' . $defaults['jak_optionid'][$i] . '"');
              }

              /* Write new options */
              $countoption = $defaults['jak_option'];

              for ($i = 0; $i < count($countoption); $i++) {
                $name = $countoption[$i];

                if (!empty($name)) {

                  if (!empty($defaults['jak_options'][$i]) && $defaults['jak_optiontype'][$i] >= 3) {
                    $sqloptions = smartsql(trim($defaults['jak_options'][$i]));
                  } else {
                    $sqloptions = '';
                  }

                  if ($defaults['jak_optiontype'][$i] >= 3 && $defaults['jak_optionmandatory'][$i] > 0) {
                    $sqlmand = 1;
                  } else {
                    $sqlmand = $defaults['jak_optionmandatory'][$i];
                  }

                  $jakdb->query('INSERT INTO ' . $envotable1 . ' SET
																	formid = ' . smartsql($page2) . ',
																	name = "' . smartsql($name) . '",
																	typeid = "' . smartsql($defaults['jak_optiontype'][$i]) . '",
																	options = "' . smartsql($sqloptions) . '",
																	mandatory = "' . smartsql($sqlmand) . '",
																	forder = "' . smartsql($defaults['jak_optionsort'][$i]) . '"');
                }
              }

              if (!$result) {
                // EN: Redirect page
                // CZ: Přesměrování stránky
                envo_redirect(BASE_URL . 'index.php?p=contactform&sp=edit&ssp=' . $page2 . '&status=e');
              } else {
                // EN: Redirect page
                // CZ: Přesměrování stránky
                envo_redirect(BASE_URL . 'index.php?p=contactform&sp=edit&ssp=' . $page2 . '&status=s');
              }

            } else {
              $errors['e'] = $tl['general_error']['generror'] . '<br>';
              $errors      = $errors;
            }
          }

          $JAK_FORM_DATA         = envo_get_data($page2, $envotable);
          $JAK_CONTACTOPTION_ALL = envo_get_contact_options($envotable1, $page2);

          // EN: Title and Description
          // CZ: Titulek a Popis
          $SECTION_TITLE = $tl["cf_sec_title"]["cft2"];
          $SECTION_DESC  = $tl["cf_sec_desc"]["cfd2"];

          // EN: Load the template
          // CZ: Načti template (šablonu)
          $template = 'editcontactform.php';

        } else {
          // EN: Redirect page
          // CZ: Přesměrování stránky
          envo_redirect(BASE_URL . 'index.php?p=contactform&status=ene');
        }
        break;
      default:

        $getTotal = envo_get_total($envotable, '', '', '');
        if ($getTotal != 0) {
          // Paginator
          $pages                 = new JAK_Paginator;
          $pages->items_total    = $getTotal;
          $pages->mid_range      = $jkv["adminpagemid"];
          $pages->items_per_page = $jkv["adminpageitem"];
          $pages->jak_get_page   = $pajs - live - chat - boardge1;
          $pages->jak_where      = 'index.php?p=page';
          $pages->paginate();
          $JAK_PAGINATE = $pages->display_pages();
        }

        // Get all contact forms
        $JAK_CONTACT_ALL = envo_get_page_info($envotable, $pages->limit);

        // EN: Title and Description
        // CZ: Titulek a Popis
        $SECTION_TITLE = $tl["cf_sec_title"]["cft"];
        $SECTION_DESC  = $tl["cf_sec_desc"]["cfd"];

        // EN: Load the template
        // CZ: Načti template (šablonu)
        $template = 'contactform.php';

    }
}
?>