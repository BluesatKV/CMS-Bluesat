/*
 * CMS ENVO
 * JS for Categories - Admin
 * Copyright © 2016 Bluesat.cz
 * -----------------------------------------------------------------------
 * Author: Thomas
 * Email: bluesatkv@gmail.com
 * =======================================================================
 * INDEX:
 *
 * 01. Bootstrap Icon Picker
 * 02. Slug
 * 03. Copy description
 *
 */

/** 01. Bootstrap Icon Picker
 * @required_plugin: Icon Picker Plugin
 ========================================================================*/

$(function () {

  $('.iconpicker').iconpicker({
    arrowClass: 'btn-info',
    icon: iconPicker.icon,
    iconset: 'fontawesome',
    searchText: iconPicker.searchText,
    labelFooter: iconPicker.labelFooter,
    arrowPrevIconClass: 'fa fa-chevron-left',
    arrowNextIconClass: 'fa fa-chevron-right',
    selectedClass: 'btn-success',
    unselectedClass: '',
    rows: 5,
    cols: 8
  });

  $('.iconpicker').on('change', function (e) {
    $("#jak_img").val('fa ' + e.icon);
  });

  $('.iconpicker1').iconpicker({
    arrowClass: 'btn-info',
    icon: iconPicker.icon,
    iconset: 'glyphicons',
    searchText: iconPicker.searchText,
    labelFooter: iconPicker.labelFooter,
    arrowPrevIconClass: 'fa fa-chevron-left',
    arrowNextIconClass: 'fa fa-chevron-right',
    selectedClass: 'btn-success',
    unselectedClass: '',
    rows: 5,
    cols: 8
  });

  $('.iconpicker1').on('change', function (e) {
    $("#jak_img").val('glyphicons ' + e.icon);
  });

});

/** 02. Slug
 ========================================================================*/

$(function () {

  $("#jak_name").keyup(function () {
    // Checked, copy values
    $("#jak_varname").val(jakSlug($("#jak_name").val()));
  });

});

/** 03. Copy description
 ========================================================================*/

$(function () {

  $("#copy1").click(function () {
    $("#jak_editor_light_meta_desc").val($("#content").val());
  });

});