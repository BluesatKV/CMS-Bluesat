/*
 * CMS ENVO
 * JS for Settings - ADMIN
 * Copyright © 2016 Bluesat.cz
 * -----------------------------------------------------------------------
 * Author: Thomas
 * Email: bluesatkv@gmail.com
 * =======================================================================
 * INDEX:
 *
 * 01. Basic config for plugin's administration
 * 02. AutoGrow text block
 *
 */


/** 01. Basic config for plugin's administration
 ========================================================================*/

/** ACE Editor
 * Initialisation of ACE Editor
 * @required_plugin: ACE Editor Plugin
 *
 * Set variable in php file as array (script.tv-tower.php)
 * @param: 'aceEditor.acetheme' from generated_js.php
 * @param: 'aceEditor.acewraplimit' from generated_js.php
 * @param: 'aceEditor.acetabSize' from generated_js.php
 * @param: 'aceEditor.aceactiveline' from generated_js.php
 * @param: 'aceEditor.aceinvisible' from generated_js.php
 * @param: 'aceEditor.acegutter' from generated_js.php
 *
 * @example: Example add other variable setting to aceEditor object in script.download.php
 *
 * <script>
 *  // Add to aceEditor settings javascript object
 *  aceEditor['otherconfigvariable'] = <?php echo json_encode($othervalue); ?>;
 * </script>
 ========================================= */
if ($('#txteditor').length) {
  var txtACE = ace.edit("txteditor");
  txtACE.setTheme('ace/theme/' + aceEditor.acetheme); // Theme chrome, monokai
  txtACE.session.setUseWrapMode(true);
  txtACE.session.setWrapLimitRange(aceEditor.acewraplimit + ',' + aceEditor.acewraplimit);
  txtACE.setOptions({
    // session options
    mode: "ace/mode/php",
    tabSize: aceEditor.acetabSize,
    useSoftTabs: true,
    highlightActiveLine: aceEditor.aceactiveline,
    // renderer options
    showInvisibles: aceEditor.aceinvisible,
    showGutter: aceEditor.acegutter
  });
  // This is to remove following warning message on console:
  // Automatically scrolling cursor into view after selection change this will be disabled in the next version
  // set editor.$blockScrolling = Infinity to disable this message
  txtACE.$blockScrolling = Infinity;

  textcontent = $("#jak_filecontent").val();
  txtACE.session.setValue(textcontent);
}

if ($('#txteditor1').length) {
  var txtACE1 = ace.edit("txteditor1");
  txtACE1.setTheme('ace/theme/' + aceEditor.acetheme); // Theme chrome, monokai
  txtACE1.session.setUseWrapMode(true);
  txtACE1.session.setWrapLimitRange(aceEditor.acewraplimit + ',' + aceEditor.acewraplimit);
  txtACE1.setOptions({
    // session options
    mode: "ace/mode/php",
    tabSize: aceEditor.acetabSize,
    useSoftTabs: true,
    highlightActiveLine: aceEditor.aceactiveline,
    // renderer options
    showInvisibles: aceEditor.aceinvisible,
    showGutter: aceEditor.acegutter
  });
  txtACE1.$blockScrolling = Infinity;

  textcontent1 = $("#jak_filecontent1").val();
  txtACE1.session.setValue(textcontent1);
}

$(function () {

  /* Submit Form
   ========================================= */
  $('form').submit(function () {
    $("#jak_filecontent").val(txtACE.getValue());
    $("#jak_filecontent1").val(txtACE1.getValue());
  });

});

/** 02. AutoGrow text block
 * @required_plugin: AutoGrow Plugin
 ========================================================================*/

$(function () {

  $(".txtautogrow").autoGrow();

});