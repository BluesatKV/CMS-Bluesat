/*
 *
 * CMS ENVO
 * JS for Plugin Intranet
 * Copyright © 2016 Bluesat.cz
 * -----------------------------------------------------------------------
 * Author: Thomas
 * Email: bluesatkv@gmail.com
 * =======================================================================
 * INDEX:
 *
 *
 */

/* 00. JQUERY CODE SNIPPET TO GET THE DYNAMIC VARIABLE
 ======================================================================== */
/* jQuery code snippet to get the dynamic variables stored in the url as parameters and
 * store them as JavaScript variables ready for use with your scripts.
 *
 * EXAMPLE
 * --------
 * 1) url: example.com?param1=name&param2=&id=6
 *
 * $.urlParam('param1');  => name
 * $.urlParam('id');      => 6
 * $.urlParam('param2');  => null
 *
 * 2) url: http://www.jquery4u.com?city=Gold Coast
 *
 * $.urlParam('city');                     => Gold%20Coast
 * decodeURIComponent($.urlParam('city'))  => Gold Coast
 */

$.urlParam = function (name) {
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  if (results == null) {
    return null;
  }
  else {
    return decodeURI(results[1]) || 0;
  }
};

/**
 * Setting variable from url for other uses
 */
var pageID = $.urlParam('id');

/**
 * Jquery Function - Edit Description
 * Remove attribute 'disabled' from textarea and hide Edit button, show Save-Close button
 * Example:
 * -----------------
 * <textarea id="desc" disabled>' . $text . '</textarea>
 * <button id="editdesc" type="button">Edit Description</button>
 * <button id="savedesc" style="display:none;" data-id="' . $id . '" type="button">Save</button>
 * <button id="closedesc" style="display:none;" type="button">Close</button>
 */
function editDesc(event) {
  // Stop, the default action of the event will not be triggered
  event.preventDefault();

  // Remove attribute from textarea
  $('#desc').removeAttr('disabled');
  // Hide click (this) element
  $(this).hide();
  // Show Save and Close button
  $('#savedesc').show();
  $('#closedesc').show();

  return false;
}

/**
 * Jquery Function - Save Description
 * Save description over Ajax
 * Example:
 * -----------------
 * <textarea id="desc">' . $text . '</textarea>
 * <button id="savedesc"  data-id="' . $id . '" type="button">Save</button>
 * <button id="closedesc" type="button">Close</button>
 */
function saveDesc(event) {
  // Stop, the default action of the event will not be triggered
  event.preventDefault();

  // Get ID of image
  var imageID = $(this).attr('data-id');
  // Get Description
  var descImage = $('#desc').val();

  // Ajax
  $.ajax({
    url: "/plugins/intranet/admin/ajax/int_table_update_img.php",
    type: "POST",
    datatype: 'json',
    data: {
      imageID: imageID,
      descImage: descImage
    },
    success: function (data) {

      if (data.status == 'update_success') {
        // IF DATA SUCCESS

        // Edit Time
        $('#timeedit').html(data.data[0].timeedit);

        // Debug to console
        // console.log(data.data[0].timeedit);

        // Add attribute to textarea
        $('#desc').attr("disabled", "disabled");
        // Hide Save and Close button
        $('#savedesc').hide();
        $('#closedesc').hide();
        // Show Edit button
        $('#editdesc').show();

        // Apply the plugin to the container
        $('#notificationcontainer').pgNotification({
          style: 'bar',
          message: data.status_msg,
          position: 'top',
          timeout: 2000,
          type: 'success',
          showClose: false
        }).show();
      }
    },
    error: function () {

    }
  });

  return false;
}

/**
 * Jquery Function - Save Description
 * Close editing description
 * Example:
 * -----------------
 * <textarea id="desc">' . $text . '</textarea>
 * <button id="editdesc" type="button" style="display:none;">Edit Description</button>
 * <button id="savedesc" type="button"  data-id="' . $id . '">Save</button>
 * <button id="closedesc" type="button">Close</button>
 */
function closeDesc(event) {
  // Stop, the default action of the event will not be triggered
  event.preventDefault();

  // Add attribute to textarea
  $('#desc').attr("disabled", "disabled");
  // Hide click (this) element and hide Save button
  $(this).hide();
  // Show Edit button
  $('#savedesc').hide();
  $('#editdesc').show();

  return false;
}

/**
 * Jquery Function - DialogFX Open
 * Close editing description
 * Example:
 * Attribute 'data-dialog' in button => ID of dialog 'div' block
 * -----------------
 * <button class="dialog-open" type="button" data-dialog="itemDetails"></button>
 *
 *  <div id="itemDetails" class="dialog item-details">
 *    <div class="dialog__overlay"></div>
 *    <div class="dialog__content">
 *      <div class="container-fluid">
 *        <div class="row dialog__overview">
 *          <!-- Data over AJAX  -->
 *        </div>
 *      </div>
 *      <button class="close action top-right" type="button" data-dialog-close>
 *        <i class="pg-close fs-14"></i>
 *      </button>
 *    </div>
 *  </div>
 */
function openDialog(event) {
  // Stop, the default action of the event will not be triggered
  event.preventDefault();

  // Get Data-Dialog
  thisDataDialog = $(this).attr('data-dialog');
  // Get ID of image
  var imageID = $(this).parents(":eq(4)").attr('id');

  // Ajax
  $.ajax({
    url: "/plugins/intranet/admin/ajax/int_table_dialog_img.php",
    type: "POST",
    datatype: 'html',
    data: {
      imageID: imageID
    },
    beforeSend: function () {
      // Show progress circle
      $('#itemDetails .dialog__overview').html('<div class="progress-circle-indeterminate" style="display:block;position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);"></div>');
    },
    success: function (data) {
      setTimeout(function () {
        // Add html data to 'div'
        $('#itemDetails .dialog__overview').hide().html(data).fadeIn('slow');

        // Call function for edit description - textarea
        $('#editdesc').click(editDesc);
        $('#closedesc').click(closeDesc);
        $('#savedesc').click(saveDesc);

      }, 1000);
    },
    error: function () {

    }
  });


  // Open DialogFX
  dialogEl = document.getElementById(thisDataDialog);
  dlg = new DialogFx(dialogEl);
  dlg.toggle(dlg);

  return false;
}

/* 00. UPLOAD FILE TO SERVER
 ========================================================================*/
$(function () {

  'use strict';

  $("#uploadBtnDocu").on('click', (function (event) {
    // Stop, the default action of the event will not be triggered
    event.preventDefault();

    // Hide output
    $('#docuoutput').hide();
    // Show progress info
    $('#docuprogress').show();
    // Reset
    $("#docupercent").html('0%');

    // Get Data - properties of file from file field
    var file_data = $('#fileinput_doc').prop('files')[0];
    // Get Data - value of folder from file field
    var folder_path = $('input[name="folderpath"]').val();
    // Creating object of FormData class
    var form_data = new FormData();
    // Appending parameter named file with properties of file_field to form_data
    form_data.append('file', file_data);
    // Adding extra parameters to form_data
    form_data.append('folderpath', folder_path);
    form_data.append('houseID', pageID);

    // Ajax
    $.ajax({
      url: "/plugins/intranet/admin/ajax/int_table_upload_docu.php",
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {

      },
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        //Upload progress bar
        xhr.upload.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
            var percent = (evt.loaded / evt.total) * 100;
            var percentComplete = percent.toFixed(2) + '%';
            $('#docupercent').html(percentComplete);
          }
        }, false);

        return xhr;
      },
      success: function (data) {

        if (data.status == 'upload_success') {
          // IF DATA SUCCESS

          $('#docuoutput').html('<div class="alert alert-success" role="alert">' +
            '<button class="close" data-dismiss="alert"></button>' +
            '<strong>Success: </strong>' + data.status_msg +
            '</div>');

          var str = JSON.stringify(data);
          var result = JSON.parse(str);

          var tabledata = '';

          $.each(result, function (key, data) {
            //console.log('Key: ' + key + ' => ' + 'Value: ' + data);

            if (key === 'data') {

              $.each(data, function (index, data) {
                // console.log('ID: ', data['id']);
                // console.log('File Icon: ', data['fileicon']);
                // console.log('Description: ', data['description']);
                // console.log('Filepath: ', data['fullpath']);

                tabledata += '<tr>' +
                  '<td>' + data["id"] + '</td>' +
                  '<td>' + data["fileicon"] + '</td>' +
                  '<td>' + data["description"] + '</td>' +
                  '<td><a href="' + data["fullpath"] + '" target="_blank">Zobrazit</a> | <a href="' + data["fullpath"] + '" download>Stáhnout</a></td>' +
                  '</tr>';

              })

            }

          });

          // Put data to table
          $('#tableadocu tbody').html(tabledata);

          // Update Jquery Tabledit Plugin
          $('#tableadocu').Tabledit('update');

          // Notification
          setTimeout(function () {
            $.notify({
              // options
              message: data.status_msg
            }, {
              // settings
              type: 'success',
              delay: 2000
            });
          }, 1000);

        } else if (data.status.indexOf('upload_error') != -1) {
          // IF DATA ERROR

          $('#docuoutput').html('<div class="alert alert-danger" role="alert">' +
            '<button class="close" data-dismiss="alert"></button>' +
            '<strong>Error: </strong>' + data.status + ' => ' + data.status_msg +
            '</div>');

          // Notification
          setTimeout(function () {
            $.notify({
              // options
              message: data.status_msg
            }, {
              // settings
              type: 'danger',
              delay: 2000
            });
          }, 1000);

        }

      },
      error: function () {

      },
      complete: function () {
        $("#docuprogress").hide();
        $("#docuoutput").show();
      }
    });
  }));

  $("#uploadBtnImg").on('click', (function (event) {
    // Stop, the default action of the event will not be triggered
    event.preventDefault();

    // Hide output
    $('#imgoutput').hide();
    // Show progress info
    $('#imgprogress').show();
    // Reset
    $("#imgpercent").html('0%');

    // Get Data - properties of file from file field
    var file_data = $('#fileinput_img').prop('files')[0];
    // Get Data - value of folder from file field
    var folder_path = $('input[name="folderpath"]').val();
    // Creating object of FormData class
    var form_data = new FormData();
    // Appending parameter named file with properties of file_field to form_data
    form_data.append('file', file_data);
    // Adding extra parameters to form_data
    form_data.append('folderpath', folder_path);
    form_data.append('houseID', pageID);

    // Ajax
    $.ajax({
      url: "/plugins/intranet/admin/ajax/int_table_upload_img.php",
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {

      },
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        //Upload progress bar
        xhr.upload.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
            var percent = (evt.loaded / evt.total) * 100;
            var percentComplete = percent.toFixed(2) + '%';
            $('#imgpercent').html(percentComplete);
          }
        }, false);

        return xhr;
      },
      success: function (data) {

        if (data.status == 'upload_success') {
          // IF DATA SUCCESS

          $('#imgoutput').html('<div class="alert alert-success" role="alert">' +
            '<button class="close" data-dismiss="alert"></button>' +
            '<strong>Success: </strong>' + data.status_msg +
            '</div>');

          var str = JSON.stringify(data);
          var result = JSON.parse(str);

          var divdata = '';

          $.each(result, function (key, data) {
            // console.log('Key: ' + key + ' => ' + 'Value: ' + data);

            if (key === 'data') {

              $.each(data, function (index, data) {
                // console.log('ID: ', data['id']);
                // console.log('Description: ', data['description']);
                // console.log('Filethumbpath: ', data['filethumbpath']);

                divdata += '<div id="' + data["id"] + '" class="gallery-item-' + data["id"] + '" data-width="1" data-height="1">' +
                  '<img src="' + data["filethumbpath"] + '" alt="" class="image-responsive-height">' +
                  '<div class="overlays full-width">' +
                  '<div class="col-sm-12 full-height">' +
                  '<div class="col-xs-5 full-height">' +
                  '<div class="text">' +
                  '<div class="text font-montserrat">' + data["filenamethumb"].substring(data["filenamethumb"].lastIndexOf('.') + 1).toUpperCase() + '</div>' +
                  '</div>' +
                  '</div>' +
                  '<div class="col-xs-7 full-height">' +
                  '<div class="text">' +
                  '<a data-fancybox="gallery" href="' + data["filethumbpath"] + '" alt="">' +
                  '<button class="btn btn-info btn-xs btn-mini m-r-5 fs-14" type="button"><i class="pg-image"></i></button>' +
                  '</a>' +
                  '<button class="btn btn-info btn-xs btn-mini fs-14 dialog-open" type="button" data-dialog="itemDetails"><i class="fa fa-edit"></i></button>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>';

              })

            }

          });

          // Put data to table
          $('#gallery_envo').prepend(divdata);

          // Call dialogFX function
          $('.dialog-open').click(openDialog);

          // Isotope for photo gallery
          $('#gallery_envo').isotope('destroy');
          $('#gallery_envo').isotope({
            itemSelector: 'div[class^="gallery-item-"]',
            masonry: {
              columnWidth: 280,
              gutter: 10,
              isFitWidth: true
            }
          });

          // Notification
          setTimeout(function () {
            $.notify({
              // options
              message: data.status_msg
            }, {
              // settings
              type: 'success',
              delay: 2000
            });
          }, 1000);

        } else if (data.status.indexOf('upload_error') != -1) {
          // IF DATA ERROR

          $('#imgoutput').html('<div class="alert alert-danger" role="alert">' +
            '<button class="close" data-dismiss="alert"></button>' +
            '<strong>Error: </strong>' + data.status + ' => ' + data.status_msg +
            '</div>');

          // Notification
          setTimeout(function () {
            $.notify({
              // options
              message: data.status_msg
            }, {
              // settings
              type: 'danger',
              delay: 2000
            });
          }, 1000);

        }

      },
      error: function () {

      },
      complete: function () {
        $("#imgprogress").hide();
        $("#imgoutput").show();
      }
    });
  }));

});

/* 00. SELECT FILE FOR UPLOAD TO SERVER
 ========================================================================*/

$(function () {

  // Clear button
  $('.file-clear').click(function () {
    var parent = $(this).parents(":eq(1)").attr('id');

    $('#' + parent + ' .file-filename').val('');
    $('#' + parent + ' .file-clear').hide();
    $('#' + parent + ' .file-input input:file').val('');
    $('#' + parent + ' .file-input-title').text('Vybrat Soubor');
  });

  // Change button
  $('.file-input input:file').change(function () {
    var parent = $(this).parents(":eq(2)").attr('id');
    var file = this.files[0];

    $('#' + parent + ' .file-input-title').text('Změnit');
    $('#' + parent + ' .file-clear').show();
    $('#' + parent + ' .file-filename').val(file.name);
  });

});

/* 00. DATATABLE CONFIG
 ========================================================================*/

$(function () {

  $('#int_table').dataTable({
    // Language
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Czech.json"
    },

    "order": [],
    "columnDefs": [{
      "targets": 'no-sort',
      "orderable": false
    }],
    // Page lenght
    "pageLength": 15,
    // Show entries
    //"lengthMenu": [ [10,20, -1], [10,20, "All"] ],
    // Design Table items
    "dom": "<'row'<'col-sm-6'<'pull-left m-b-20'f>><'col-sm-6'<'pull-right m-r-20 hidden-xs'B>>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-7'i><'col-sm-5'p>>",
    // Export table
    buttons: [
      {
        extend: 'excel',
        exportOptions: {
          columns: [0, 2, 3, 4, 5]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [0, 2, 3, 4, 5]
        },
        customize: function (doc) {
          doc.content[1].table.widths =
            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }

      },
      {
        extend: 'print',
        exportOptions: {
          columns: [0, 2, 3, 4, 5]
        }
      }
    ],
  });

});


/* 00. TABLEDIT CONFIG
 ========================================================================*/

$(function () {

  /* Tabledit init and config
   ========================================= */
  // If exist 'table' -> init Plugin Jquery-Tabledit
  if ($('#tableentrance').length > 0) {
    // Tabledit init config
    $('#tableentrance').Tabledit({
      url: '/plugins/intranet/admin/ajax/int_table_update.php',
      inputClass: 'form-control',
      restoreButton: false,
      lang: 'cz',
      mutedClass: 'text-muted warning',
      columns: {
        identifier: [0, 'id'],
        editable: [
          [1, 'entrance', 'input'],
          [2, 'countapartment', 'input'],
          [3, 'countetage', 'input'],
          [4, 'elevator', 'select', '{"0": "Není známo", "1": "Ano", "2": "Ne"}']
        ]
      }
    });
  }

  // If exist 'table' -> init Plugin Jquery-Tabledit
  if ($('#tablecontacts').length > 0) {
    // Tabledit init config
    $('#tablecontacts').Tabledit({
      url: '/plugins/intranet/admin/ajax/int_table_update_cont.php',
      inputClass: 'form-control',
      restoreButton: false,
      lang: 'cz',
      mutedClass: 'text-muted warning',
      columns: {
        identifier: [0, 'id'],
        editable: [
          [1, 'name', 'input'],
          [2, 'address', 'input'],
          [3, 'phone', 'input'],
          [4, 'email', 'input'],
          [5, 'commission', 'select', '{"0": "Není ve Výboru", "1": "Předseda", "2": "Člen Výboru", "3": "Pověřený vlastník"}']
        ]
      }
    });
  }

  // If exist 'table' -> init Plugin Jquery-Tabledit
  if ($('table[id^="tableapartment_"]').length > 0) {
    // Tabledit init config
    $('table[id^="tableapartment_"]').Tabledit({
      url: '/plugins/intranet/admin/ajax/int_table_update_apt.php',
      inputClass: 'form-control',
      restoreButton: false,
      lang: 'cz',
      mutedClass: 'text-muted warning',
      columns: {
        identifier: [0, 'id'],
        editable: [
          [1, 'number', 'input'],
          [2, 'etage', 'input'],
          [3, 'name', 'input'],
          [4, 'phone', 'input'],
          [5, 'commission', 'select', '{"0": "Není ve Výboru", "1": "Předseda", "2": "Člen Výboru", "3": "Pověřený vlastník"}']
        ]
      }
    });
  }

  // If exist 'table' -> init Plugin Jquery-Tabledit
  if ($('#tableadocu').length > 0) {
    // Tabledit init config
    $('#tableadocu').Tabledit({
      url: '/plugins/intranet/admin/ajax/int_table_update_docu.php',
      inputClass: 'form-control',
      restoreButton: false,
      lang: 'cz',
      mutedClass: 'text-muted warning',
      columns: {
        identifier: [0, 'id'],
        editable: [
          [2, 'description', 'input']
        ]
      }
    });
  }

  /* Tabledit add new row to table
   ========================================= */
  $("#addRowCont").on('click', function () {
    // Get value
    var houseID = pageID;
    var contact = $('input[name="addRowCont"]');
    var contactval = contact.val();

    if (contactval.length > 0) {
      // Ajax
      $.ajax({
        type: "POST",
        url: "/plugins/intranet/admin/ajax/int_table_addnew_cont.php",
        datatype: 'json',
        data: {
          houseID: houseID,
          contact: contactval
        },
        success: function (data) {

          if (data.status == 'success') {
            // IF DATA SUCCESS

            var str = JSON.stringify(data);
            var result = JSON.parse(str);

            var tabledata = '';

            $.each(result, function (key, data) {
              //console.log('Key: ' + key + ' => ' + 'Value: ' + data);

              if (key === 'data') {

                $.each(data, function (index, data) {
                  // console.log('ID: ', data['id']);
                  // console.log('Name: ', data['name']);
                  // console.log('Address: ', data['address']);
                  // console.log('Phone: ', data['phone']);
                  // console.log('Email: ', data['email']);
                  // console.log('Commission: ', data['commission']);

                  tabledata += '<tr>' +
                    '<td>' + data["id"] + '</td>' +
                    '<td>' + data["name"] + '</td>' +
                    '<td>' + data["address"] + '</td>' +
                    '<td>' + data["phone"] + '</td>' +
                    '<td>' + data["email"] + '</td>' +
                    '<td>' + data["commission"] + '</td>' +
                    '</tr>';

                })

              }

            });

            // Put data to table
            $('#tablecontacts tbody').html(tabledata);

            // Update Jquery Tabledit Plugin
            $('#tablecontacts').Tabledit('update');

            // Notification
            setTimeout(function () {
              $.notify({
                // options
                message: data.status_msg
              }, {
                // settings
                type: 'success',
                delay: 2000
              });
            }, 1000);

          } else {
            // IF DATA ERROR

            // Notification
            setTimeout(function () {
              $.notify({
                // options
                message: data.status_msg
              }, {
                // settings
                type: 'danger',
                delay: 5000
              });
            }, 1000);

          }

        },
        error: function () {

        }
      });

      // Set border for input - error
      contact.parent().removeClass('has-error');

    } else {
      // Notification
      setTimeout(function () {
        $.notify({
          // options
          message: 'Před vložením nového kontaktu zadejte celé jméno'
        }, {
          // settings
          type: 'danger',
          delay: 5000
        });
      }, 1000);

      // Set border for input - error
      contact.parent().addClass('has-error');
    }

  });

  $("#addRowEdit").on('click', function () {
    // Get value
    var houseID = pageID;
    var entrance = $('input[name="addRowEnt"]');
    var entranceval = entrance.val();

    if (entranceval.length > 0) {
      // Ajax
      $.ajax({
        type: "POST",
        url: "/plugins/intranet/admin/ajax/int_table_addnew.php",
        datatype: 'json',
        data: {
          houseID: houseID,
          entrance: entranceval
        },
        success: function (data) {

          if (data.status == 'success') {
            // IF DATA SUCCESS

            var str = JSON.stringify(data);
            var result = JSON.parse(str);

            var tabledata = '';

            $.each(result, function (key, data) {
              //console.log('Key: ' + key + ' => ' + 'Value: ' + data);

              if (key === 'data') {

                $.each(data, function (index, data) {
                  // console.log('ID: ', data['id']);
                  // console.log('Entrance: ', data['entrance']);
                  // console.log('Appartement: ', data['countapartment']);
                  // console.log('Etage: ', data['countetage']);
                  // console.log('Elevator: ', data['elevator']);

                  tabledata += '<tr>' +
                    '<td>' + data["id"] + '</td>' +
                    '<td>' + data["entrance"] + '</td>' +
                    '<td>' + data["countapartment"] + '</td>' +
                    '<td>' + data["countetage"] + '</td>' +
                    '<td>' + data["elevator"] + '</td>' +
                    '</tr>';

                })

              }

            });

            // Put data to table
            $('#tableentrance tbody').html(tabledata);

            // Update Jquery Tabledit Plugin
            $('#tableentrance').Tabledit('update');

            // Notification
            setTimeout(function () {
              $.notify({
                // options
                message: data.status_msg + ', stránka bude obnovena'
              }, {
                // settings
                type: 'success',
                delay: 2000
              });
            }, 1000);

            setInterval(function () {
              location.reload(true);
            }, 5000);

          } else {
            // IF DATA ERROR

            // Notification
            setTimeout(function () {
              $.notify({
                // options
                message: data.status_msg
              }, {
                // settings
                type: 'danger',
                delay: 5000
              });
            }, 1000);

          }

        },
        error: function () {

        }
      });

      // Set border for input - error
      entrance.parent().removeClass('has-error');
    } else {
      // Notification
      setTimeout(function () {
        $.notify({
          // options
          message: 'Před vložením nového řádku zadejte číslo vchodu'
        }, {
          // settings
          type: 'danger',
          delay: 5000
        });
      }, 1000);

      // Set border for input - error
      entrance.parent().addClass('has-error');
    }

  });

  $(".addRowEditApt").on('click', function () {
    // Get value
    var houseID = pageID;
    var entrance = $(this).attr("data-entrance");

    $.ajax({
      type: "POST",
      url: "/plugins/intranet/admin/ajax/int_table_addnew_apt.php",
      datatype: 'html',
      data: {
        houseID: houseID,
        entrance: entrance
      },
      success: function (data) {
        $('#tableapartment_' + entrance + ' tbody').html(data);

        $('#tableapartment_' + entrance).Tabledit('update');

      },
      error: function () {

      }
    })
  });

});