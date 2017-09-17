/*
 * CMS ENVO
 * JS for Template - ADMIN
 * Copyright © 2016 Bluesat.cz
 * -----------------------------------------------------------------------
 * Author: Thomas
 * Email: bluesatkv@gmail.com
 * =======================================================================
 * INDEX:
 *
 * 01. Basic config for plugin's administration
 * 02. AutoGrow text block
 * 03. Show iFrame in modal
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
if ($('#htmleditor').length) {
  var htmlefACE = ace.edit('htmleditor');
  htmlefACE.setTheme('ace/theme/' + aceEditor.acetheme); // Theme chrome, monokai
  htmlefACE.session.setUseWrapMode(true);
  htmlefACE.session.setWrapLimitRange(aceEditor.acewraplimit +  ',' + aceEditor.acewraplimit);
  htmlefACE.setOptions({
    // session options
    mode: "ace/mode/html",
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
  htmlefACE.$blockScrolling = Infinity;

  var texthtmlef = $("#jak_filecontent").val();
  htmlefACE.session.setValue(texthtmlef);
}

$(function () {

  /* Submit Form
   ========================================= */
  $('form').submit(function () {
    $("#jak_filecontent").val(htmlefACE.getValue());
  });

});

/** 02. AutoGrow text block
 * @required_plugin: AutoGrow Plugin
 ========================================================================*/

$(function () {

  $(".txtautogrow").autoGrow();

});

/** 03. Show iFrame in modal
 ========================================================================*/

$(function () {

// Close modal dialog from iFrame - call this by onclick="window.parent.closeModal(); from iFrame"
  window.closeModal = function () {
    $('#ENVOModal').modal('hide');
  };

  $('.tempSett').on('click', function (e) {
    e.preventDefault();
    frameSrc = $(this).attr("href");
    $('#ENVOModalLabel').html("<?php echo ucwords($page);?>");

    $('#ENVOModal').one('shown.bs.modal', function (e) {
      $('#ENVOModal .modal-dialog').addClass('modal-w-70p');
      $('.body-content').html('<iframe src="' + frameSrc + '" width="100%" frameborder="0" style="flex-grow: 1;">');
    }).one('hidden.bs.modal', function (e) {
      $(".body-content").html('');
      window.location.reload();
    }).modal('show');

  });

  // Show iFrame in modal - install and uninstall
  $('.tempInst').on('click', function (e) {
    e.preventDefault();
    frameSrc = $(this).attr("href");
    $('#ENVOModalLabel').html("<?php echo ucwords($page);?>");

    $('#ENVOModal').one('shown.bs.modal', function (e) {
      $('#ENVOModal .modal-dialog').addClass('modal-w-70p');
      $('.body-content').html('<iframe src="' + frameSrc + '" width="100%" frameborder="0" style="flex-grow: 1;">');
    }).one('hidden.bs.modal', function (e) {
      $(".body-content").html('');
      window.location.reload();
    }).modal('show');

  });

  // Show iFrame in modal - help
  $('.tempHelp').on('click', function (e) {
    e.preventDefault();
    frameSrc = $(this).attr("href");
    $('#ENVOModalLabel').html("<?php echo ucwords($page);?>");

    $('#ENVOModal').one('shown.bs.modal', function (e) {
      $('#ENVOModal .modal-dialog').addClass('modal-w-90p');
      $('.body-content').html('<iframe src="' + frameSrc + '" width="100%" frameborder="0" style="flex-grow: 1;">');
    }).one('hidden.bs.modal', function (e) {
      $(".body-content").html('');
    }).modal('show');

  });

  $('.disabled').click(function (e) {
    e.preventDefault();
  })

});