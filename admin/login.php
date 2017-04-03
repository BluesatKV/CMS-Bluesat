<?php

// EN: Check if the file is accessed only via index.php if not stop the script from running
// CZ: Kontrola, zdali je soubor přístupný pouze přes index.php - pokud ne ukončí se script
if (!defined('JAK_ADMIN_PREVENT_ACCESS')) die('You cannot access this file directly.');

$ErrLogin = $errorfp = FALSE;

// Login IN
if (!empty($_POST['action']) && $_POST['action'] == 'login') {

  $username = smartsql($_POST['username']);
  $userpass = smartsql($_POST['password']);
  $cookies  = FALSE;
  if (isset($_POST['lcookies'])) $cookies = TRUE;

  // Security fix
  $valid_agent = filter_var($_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRING);
  $valid_ip    = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);

  // Write the log file each time someone tries to login before
  $jakuserlogin->jakWriteloginlog($username, $_SERVER['REQUEST_URI'], $valid_ip, $valid_agent, 0);

  $user_check = $jakuserlogin->jakCheckuserdata($username, $userpass);
  if ($user_check == TRUE) {

    // Now login in the user
    $jakuserlogin->jakLogin($user_check, $userpass, $cookies);

    // Write the log file each time someone login after to show success
    $jakuserlogin->jakWriteloginlog($username, '', $valid_ip, '', 1);

    $_SESSION["loginmsg"] = $tl["log_in"]["login14"];

    if (isset($_SESSION['JAKRedirect'])) {
      // EN: Redirect page
      // CZ: Přesměrování stránky
      jak_redirect($_SESSION['JAKRedirect']);
    } else {
      // EN: Redirect page
      // CZ: Přesměrování stránky
      jak_redirect(BASE_URL);
    }

  } else {
    $ErrLogin = $tl['error']['l'];
  }
}

// Forgot password
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['forgotP'])) {
  $defaults = $_POST;

  if ($defaults['email'] == '' || !filter_var($defaults['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['e'] = $tl['error']['e19'];
  }

  // Transform user email
  $femail = filter_var($defaults['email'], FILTER_SANITIZE_EMAIL);
  $fwhen  = time();

  // Check if this user exist
  $user_check = $jakuserlogin->jakForgotpassword($femail, $fwhen);

  if (!$user_check) {
    $errors['e']          = $tl['error']['e19'];
    $_SESSION["errormsg"] = $tl["log_in"]["login13"];
  }

  if (count($errors) == 0) {

    $body = sprintf($tl['log_in']['login12'], $user_check, '<a href="' . (JAK_USE_APACHE ? substr(BASE_URL_ORIG, 0, -1) : BASE_URL_ORIG) . html_entity_decode(JAK_rewrite::jakParseurl('forgot-password', $fwhen, '', '', '')) . '">' . (JAK_USE_APACHE ? substr(BASE_URL_ORIG, 0, -1) : BASE_URL_ORIG) . html_entity_decode(JAK_rewrite::jakParseurl('forgot-password', $fwhen, '', '', '')) . '</a>', $jkv["title"]);

    $mail = new PHPMailer(); // defaults to using php "mail()"
    $mail->SetFrom($jkv["email"], $jkv["title"]);
    $mail->AddAddress($femail, $user_check);
    $mail->Subject = $jkv["title"] . ' - ' . $tl['login']['l13'];
    $mail->MsgHTML($body);
    $mail->AltBody = strip_tags($body);

    if ($mail->Send()) {
      // EN: Redirect page
      // CZ: Přesměrování stránky/
      $_SESSION["infomsg"] = $tl["log_in"]["login11"];
      jak_redirect(BASE_URL);

    }

  } else {
    $errorfp = $errors;
  }
}

// EN: Load the template
// CZ: Načti template (šablonu)
$template = 'login.php';

?>