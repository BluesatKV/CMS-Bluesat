<?php

// EN: Include the config file ...
// CZ: Vložení konfiguračního souboru ...
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/config.php')) die('[' . __DIR__ . '/uninstall.php] => "config.php" not found');
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Check if the file is accessed only from a admin if not stop the script from running
$php_errormsg = 'To edit the file, you must be logged in as an ADMINISTRATOR !!! You cannot access this file directly.';
$php_errormsg1 = 'Only ADMINISTRATOR privileges allow you to edit the file !!! You cannot access this file directly.';
if (!ENVO_USERID) die($php_errormsg);

if (!$envouser->envoAdminAccess($envouser->getVar("usergroupid"))) die($php_errormsg1);

// Set successfully to zero
$succesfully = 0;

// EN: Load the language file for plugin
// CZ: Načtení jazykového souboru pro plugin
if (file_exists(APP_PATH . 'plugins/intranet/admin/lang/' . $site_language . '.ini')) {
  $tlint = parse_ini_file(APP_PATH . 'plugins/intranet/admin/lang/' . $site_language . '.ini', TRUE);
} else {
  $tlint = parse_ini_file(APP_PATH . 'plugins/intranet/admin/lang/en.ini', TRUE);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $tlint["int_uninstall"]["intuninst"]; ?></title>
  <meta charset="utf-8">
  <!-- BEGIN Vendor CSS-->
  <link href="/admin/assets/plugins/bootstrapv3/css/bootstrap.min.css?=v3.3.4" rel="stylesheet" type="text/css"/>
  <link href="/assets/plugins/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css"/>
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
  <script src="/assets/plugins/jquery/jquery-2.2.4.min.js" type="text/javascript"></script>
  <script src="/admin/assets/plugins/bootstrapv3/js/bootstrap.min.js?=v3.3.4" type="text/javascript"></script>
  <!-- BEGIN CORE TEMPLATE JS -->
  <script src="/admin/pages/js/pages.js?=v2.2.0"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12 m-t-20">
      <div class="jumbotron bg-master">
        <h3 class="semi-bold text-white"><?php echo $tlint["int_uninstall"]["intuninst"]; ?></h3>
      </div>
      <hr>
      <div id="notificationcontainer"></div>
      <div class="m-b-30">
        <h4 class="semi-bold"><?php echo $tlint["int_uninstall"]["intuninst1"]; ?></h4>

        <div id="portlet-advance" class="panel panel-transparent">
          <div class="panel-heading separator">
            <div class="panel-title"><?php echo $tlint["int_uninstall"]["intuninst2"]; ?></div>
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
          $results = $envodb->query('SELECT id FROM ' . DB_PREFIX . 'plugins WHERE name = "Intranet"');
          $rows    = $results->fetch_assoc();

          if ($rows) {

            $envodb->query('DELETE FROM ' . DB_PREFIX . 'plugins WHERE name = "Intranet"');
            $envodb->query('DELETE FROM ' . DB_PREFIX . 'pluginhooks WHERE product = "intranet"');
            $envodb->query('DELETE FROM ' . DB_PREFIX . 'setting WHERE product = "intranet"');
            $envodb->query('ALTER TABLE ' . DB_PREFIX . 'usergroup DROP `intranet`');
            $envodb->query('DELETE FROM ' . DB_PREFIX . 'categories WHERE pluginid = "' . smartsql($rows['id']) . '"');

            /* Remove tables with data */
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethouse');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousetasks');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethouseent');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethouseapt');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousecontact');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousedocu');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethouseimg');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethouseserv');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousenotifications');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousenotificationug');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousetower');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousechannel');
            // $envodb->query('DROP TABLE ' . DB_PREFIX . 'intranethousechanneltower');
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
                message: '<?php echo $tlint["int_uninstall"]["intuninst3"]; ?>',
                position: 'top',
                timeout: 0,
                type: 'success'
              }).show();

              e.preventDefault();
            });
          </script>
        <?php } else { ?>
          <div>
            <h5 class="text-danger bold"><?php echo $tlint["int_uninstall"]["intuninst4"]; ?></h5>
          </div>
          <script>
            $(document).ready(function () {
              'use strict';
              // Apply the plugin to the body
              $('#notificationcontainer').pgNotification({
                style: 'bar',
                message: '<?php echo $tlint["int_uninstall"]["intuninst4"]; ?>',
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
            <label for="text"><?php echo $tlint["int_uninstall"]["intuninst5"]; ?></label>
            <input type="text" name="captcha" class="form-control" id="text">
            <img src="../../assets/plugins/captcha/simple/captcha.php" class="m-l-10"/>
          </div>
          <button type="submit" name="uninstall" class="btn btn-complete btn-block"><?php echo $tlint["int_uninstall"]["intuninst6"]; ?></button>
        </form>
      <?php } ?>

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