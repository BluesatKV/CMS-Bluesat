/*
 * CMS ENVO
 * JS for Tiny Editor - ADMIN
 * Copyright © 2016 Bluesat.cz
 * -----------------------------------------------------------------------
 * Author: Thomas
 * Email: bluesatkv@gmail.com
 * =======================================================================
 * INDEX:
 *
 */

/** 01. Tiny Editor config
 ========================================================================*/

$(function () {

  tinymce.init({
    selector: "textarea.jakEditorLight, textarea.jakEditorLight2, textarea.jakEditorLight3",
    theme: "modern",
    width: "100%",
    height: 200,
    language: envoWeb.envo_lang,
    plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste responsivefilemanager"
    ],
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | clientcode",
    content_css: "<?php echo $customCSS;?>",
    statusbar: false,
    menubar: false,
    relative_urls: false,
    remove_script_host: true,
    document_base_url: "/",
    valid_elements: "*[*]",
    external_filemanager_path: "../assets/plugins/tinymce/plugins/filemanager/",
    filemanager_title: "Filemanager",
    external_plugins: {"filemanager": "plugins/filemanager/plugin.min.js"}
  });

});

/** 02.  Tiny Editor config
 ========================================================================*/

$(function () {

  tinymce.init({
    selector: "textarea.jakEditor, textarea.jakEditor2, textarea.jakEditor3",
    theme: "modern",
    width: "100%",
    height: 500,
    language: envoWeb.envo_lang,
    plugins: [
      "advlist autolink link image lists charmap preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons paste textcolor responsivefilemanager clientcode bootstrap3"
    ],
    content_css: "<?php echo $customCSS;?>",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | preview media fullpage | forecolor backcolor emoticons | clientcode bootstrap3",
    statusbar: false,
    image_advtab: true,
    relative_urls: false,
    remove_script_host: true,
    document_base_url: "/",
    valid_elements: "*[*]",
    external_filemanager_path: "../assets/plugins/tinymce/plugins/filemanager/",
    filemanager_title: "Filemanager",
    external_plugins: {"filemanager": "plugins/filemanager/plugin.min.js"}
  });

});

/** 03.  Tiny Editor config
 ========================================================================*/

$(function () {

  tinymce.init({
    selector: "textarea.jakEditorF, textarea.jakEditorF2, textarea.jakEditorF3",
    theme: "modern",
    width: "100%",
    height: 500,
    language: envoWeb.envo_lang,
    plugins: [
      "advlist autolink link image lists charmap preview hr anchor pagebreak fullpage",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons paste textcolor responsivefilemanager clientcode bootstrap3"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | preview media fullpage | forecolor backcolor emoticons | clientcode fullpage bootstrap3",
    statusbar: false,
    image_advtab: true,
    relative_urls: false,
    convert_urls: false,
    remove_script_host: true,
    document_base_url: "/",
    valid_elements: "*[*]",
    external_filemanager_path: "../assets/plugins/tinymce/plugins/filemanager/",
    filemanager_title: "Filemanager",
    external_plugins: {"filemanager": "plugins/filemanager/plugin.min.js"}
  });

});