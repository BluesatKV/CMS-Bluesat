$(document).ready(function () {
  $(".jaktip").tooltip();

  $('.quickedit').on('click', function (e) {
    e.preventDefault();
    frameSrc = $(this).attr("href");
    $('#JAKModalLabel').html(jakWeb.jak_quickedit);
    $('#JAKModal').on('show.bs.modal', function () {
      $('<iframe src="' + frameSrc + '" width="100%" height="450" frameborder="0">').appendTo('.modal-body');
    });
    $('#JAKModal').on('hidden.bs.modal', function () {
      window.location.reload();
    });
    $('#JAKModal').modal({show: true});
  });

  $('.commedit').on('click', function (e) {
    e.preventDefault();
    frameSrc = $(this).attr("href");
    $('#JAKModalLabel').html(jakWeb.jak_quickedit);
    $('#JAKModal').on('show.bs.modal', function () {
      $('<iframe src="' + frameSrc + '" width="100%" height="400" frameborder="0">').appendTo('.modal-body');
    });
    $('#JAKModal').on('hidden.bs.modal', function () {
      window.location.reload();
    });
    $('#JAKModal').modal({show: true});
  });

  $('.lightbox').on('click', function (e) {
    e.preventDefault();
    $(this).jakBox();
  });

});

// Get the like button
var elems = document.getElementsByClassName('jak-like');
var likeBox = likebox_result = likeBoxLink = likebox_div = false;

document.addEventListener('DOMContentLoaded', function () {

  // get all elements on the page
  [].forEach.call(elems, function (el) {

    // Get the button
    likeBoxLink = el.getElementsByClassName("jak-like-link")[0];

    // listen to hover
    likeBoxLink.addEventListener("click", function () {

      // get the button bubble
      likeBox = el.getElementsByClassName("jak-like-btn likeanimated")[0];

      if (likeBox.style.display === '') {
        addLikeCSS(likeBox);
      } else {
        removeLikeCSS(likeBox);
      }

    });

  });

});

// Run the server sent events
function getLikeCounter(aid, locid) {

  var request = new XMLHttpRequest();
  request.open('GET', jakWeb.jak_url + 'include/ajax/like_results.php?aid=' + aid + '&locid=' + locid, true);

  request.onload = function () {
    if (request.status >= 200 && request.status < 400) {
      // Success!
      var data = JSON.parse(request.responseText);
      handleLikeResults(aid, data);
    } else {
      // We reached our target server, but it returned an error

    }
  };

  request.onerror = function () {
    // There was a connection error of some sort
  };

  request.send();

}

// Write the new results
function handleLikeResults(aid, msg) {

  // We have a like
  if (msg.status) {

    // Select the correct container
    likebox_result = document.getElementById("likebutton" + aid);
    likebox_div = likebox_result.querySelector('.jak-like-results');

    // Finally insert the correct result
    likebox_div.innerHTML = msg.content;

  }

}

function updateLikeCounter(aid, locid, feelid) {

  likebox_result = document.getElementById("likebutton" + aid);

  // now let's do call the results
  var likebox_uid = likebox_result.getAttribute("data-userid");
  var likebox_uname = likebox_result.getAttribute("data-username");
  var likebox_email = likebox_result.getAttribute("data-email");

  var request = new XMLHttpRequest();
  request.open('GET', jakWeb.jak_url + 'include/ajax/like_update.php?aid=' + aid + '&locid=' + locid + '&feelid=' + feelid, true);

  request.onload = function () {
    if (request.status >= 200 && request.status < 400) {
      // Success!
      var data = JSON.parse(request.responseText);

      if (data.status == 1) {
        getLikeCounter(aid, locid);

      }

      likebox_div = likebox_result.querySelector('.jak-like-btn');
      removeLikeCSS(likeBox);
    } else {
      // We reached our target server, but it returned an error

    }
  };

  request.onerror = function () {
    // There was a connection error of some sort
  };

  request.send();

}

function addLikeCSS(lb) {
  lb.style.display = 'block';
  // add class
  if (lb.classList) {
    lb.classList.add("fadeInUp");
  } else {
    lb.className = lb.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  }
}

function removeLikeCSS(lb) {
  // remove class
  if (lb.classList) {
    lb.classList.remove("fadeInUp");
  } else {
    lb.className = lb.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  }
  lb.style.display = '';
}

(function () {
  jakWeb = {
    jak_lang: "",
    jak_url: "",
    jak_url_orig: "",
    request_uri: "",
    jak_search_link: "",
    jak_template: "",
    jak_heatmap: "",
    jak_quickedit: "",
    jak_acp_nav: false
  }
})();

/**
 * Browser detection for jQuery 1.9
 */
(function ($) {
  var ua = navigator.userAgent.toLowerCase(),
    match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
      /(webkit)[ \/]([\w.]+)/.exec(ua) ||
      /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
      /(msie) ([\w.]+)/.exec(ua) ||
      ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [],
    browser = match[1] || "",
    version = match[2] || "0";

  jQuery.browser = {};

  if (browser) {
    jQuery.browser[browser] = true;
    jQuery.browser.version = version;
  }

  // Chrome is Webkit, but Webkit is also Safari.
  if (jQuery.browser.chrome) {
    jQuery.browser.webkit = true;
  } else if (jQuery.browser.webkit) {
    jQuery.browser.safari = true;
  }
})(jQuery);

/*

 jQuery Tags Input Plugin 1.3.3

 Copyright (c) 2011 XOXCO, Inc

 Documentation for this plugin lives here:
 http://xoxco.com/clickable/jquery-tags-input

 Licensed under the MIT license:
 http://www.opensource.org/licenses/mit-license.php

 ben@xoxco.com

 */

(function ($) {

  var delimiter = new Array();
  var tags_callbacks = new Array();
  $.fn.doAutosize = function (o) {
    var minWidth = $(this).data('minwidth'),
      maxWidth = $(this).data('maxwidth'),
      val = '',
      input = $(this),
      testSubject = $('#' + $(this).data('tester_id'));

    if (val === (val = input.val())) {
      return;
    }

    // Enter new content into testSubject
    var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    testSubject.html(escaped);
    // Calculate new width + whether to change
    var testerWidth = testSubject.width(),
      newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
      currentWidth = input.width(),
      isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth)
        || (newWidth > minWidth && newWidth < maxWidth);

    // Animate width
    if (isValidWidthChange) {
      input.width(newWidth);
    }


  };
  $.fn.resetAutosize = function (options) {
    // alert(JSON.stringify(options));
    var minWidth = $(this).data('minwidth') || options.minInputWidth || $(this).width(),
      maxWidth = $(this).data('maxwidth') || options.maxInputWidth || ($(this).closest('.tagsinput').width() - options.inputPadding),
      val = '',
      input = $(this),
      testSubject = $('<tester/>').css({
        position: 'absolute',
        top: -9999,
        left: -9999,
        width: 'auto',
        fontSize: input.css('fontSize'),
        fontFamily: input.css('fontFamily'),
        fontWeight: input.css('fontWeight'),
        letterSpacing: input.css('letterSpacing'),
        whiteSpace: 'nowrap'
      }),
      testerId = $(this).attr('id') + '_autosize_tester';
    if (!$('#' + testerId).length > 0) {
      testSubject.attr('id', testerId);
      testSubject.appendTo('body');
    }

    input.data('minwidth', minWidth);
    input.data('maxwidth', maxWidth);
    input.data('tester_id', testerId);
    input.css('width', minWidth);
  };

  $.fn.addTag = function (value, options) {
    options = jQuery.extend({focus: false, callback: true}, options);
    this.each(function () {
      var id = $(this).attr('id');

      var tagslist = $(this).val().split(delimiter[id]);
      if (tagslist[0] == '') {
        tagslist = new Array();
      }

      value = jQuery.trim(value);

      if (options.unique) {
        var skipTag = $(this).tagExist(value);
        if (skipTag == true) {
          //Marks fake input as not_valid to let styling it
          $('#' + id + '_tag').addClass('not_valid');
        }
      } else {
        var skipTag = false;
      }

      if (value != '' && skipTag != true) {
        $('<span>').addClass('tag').append(
          $('<span>').text(value).append('&nbsp;&nbsp;'),
          $('<a>', {
            href: '#',
            title: 'Removing tag',
            text: 'x'
          }).click(function () {
            return $('#' + id).removeTag(escape(value));
          })
        ).insertBefore('#' + id + '_addTag');

        tagslist.push(value);

        $('#' + id + '_tag').val('');
        if (options.focus) {
          $('#' + id + '_tag').focus();
        } else {
          $('#' + id + '_tag').blur();
        }

        $.fn.tagsInput.updateTagsField(this, tagslist);

        if (options.callback && tags_callbacks[id] && tags_callbacks[id]['onAddTag']) {
          var f = tags_callbacks[id]['onAddTag'];
          f.call(this, value);
        }
        if (tags_callbacks[id] && tags_callbacks[id]['onChange']) {
          var i = tagslist.length;
          var f = tags_callbacks[id]['onChange'];
          f.call(this, $(this), tagslist[i - 1]);
        }
      }

    });

    return false;
  };

  $.fn.removeTag = function (value) {
    value = unescape(value);
    this.each(function () {
      var id = $(this).attr('id');

      var old = $(this).val().split(delimiter[id]);

      $('#' + id + '_tagsinput .tag').remove();
      str = '';
      for (i = 0; i < old.length; i++) {
        if (old[i] != value) {
          str = str + delimiter[id] + old[i];
        }
      }

      $.fn.tagsInput.importTags(this, str);

      if (tags_callbacks[id] && tags_callbacks[id]['onRemoveTag']) {
        var f = tags_callbacks[id]['onRemoveTag'];
        f.call(this, value);
      }
    });

    return false;
  };

  $.fn.tagExist = function (val) {
    var id = $(this).attr('id');
    var tagslist = $(this).val().split(delimiter[id]);
    return (jQuery.inArray(val, tagslist) >= 0); //true when tag exists, false when not
  };

  // clear all existing tags and import new ones from a string
  $.fn.importTags = function (str) {
    id = $(this).attr('id');
    $('#' + id + '_tagsinput .tag').remove();
    $.fn.tagsInput.importTags(this, str);
  }

  $.fn.tagsInput = function (options) {
    var settings = jQuery.extend({
      interactive: true,
      defaultText: 'add a tag',
      minChars: 0,
      width: '300px',
      height: '100px',
      autocomplete: {selectFirst: false},
      'hide': true,
      'delimiter': ' ',
      'unique': true,
      removeWithBackspace: true,
      placeholderColor: '#666666',
      autosize: true,
      comfortZone: 20,
      inputPadding: 6 * 2
    }, options);

    this.each(function () {
      if (settings.hide) {
        $(this).hide();
      }
      var id = $(this).attr('id');
      if (!id || delimiter[$(this).attr('id')]) {
        id = $(this).attr('id', 'tags' + new Date().getTime()).attr('id');
      }

      var data = jQuery.extend({
        pid: id,
        real_input: '#' + id,
        holder: '#' + id + '_tagsinput',
        input_wrapper: '#' + id + '_addTag',
        fake_input: '#' + id + '_tag'
      }, settings);

      delimiter[id] = data.delimiter;

      if (settings.onAddTag || settings.onRemoveTag || settings.onChange) {
        tags_callbacks[id] = new Array();
        tags_callbacks[id]['onAddTag'] = settings.onAddTag;
        tags_callbacks[id]['onRemoveTag'] = settings.onRemoveTag;
        tags_callbacks[id]['onChange'] = settings.onChange;
      }

      var markup = '<div id="' + id + '_tagsinput" class="tagsinput"><div id="' + id + '_addTag">';

      if (settings.interactive) {
        markup = markup + '<input id="' + id + '_tag" value="" data-default="' + settings.defaultText + '" />';
      }

      markup = markup + '</div><div class="tags_clear"></div></div>';

      $(markup).insertAfter(this);

      $(data.holder).css('width', settings.width);
      $(data.holder).css('min-height', settings.height);
      $(data.holder).css('height', '100%');

      if ($(data.real_input).val() != '') {
        $.fn.tagsInput.importTags($(data.real_input), $(data.real_input).val());
      }
      if (settings.interactive) {
        $(data.fake_input).val($(data.fake_input).attr('data-default'));
        $(data.fake_input).css('color', settings.placeholderColor);
        $(data.fake_input).resetAutosize(settings);

        $(data.holder).bind('click', data, function (event) {
          $(event.data.fake_input).focus();
        });

        $(data.fake_input).bind('focus', data, function (event) {
          if ($(event.data.fake_input).val() == $(event.data.fake_input).attr('data-default')) {
            $(event.data.fake_input).val('');
          }
          $(event.data.fake_input).css('color', '#000000');
        });

        if (settings.autocomplete_url != undefined) {
          autocomplete_options = {source: settings.autocomplete_url};
          for (attrname in settings.autocomplete) {
            autocomplete_options[attrname] = settings.autocomplete[attrname];
          }

          if (jQuery.Autocompleter !== undefined) {
            $(data.fake_input).autocomplete(settings.autocomplete_url, settings.autocomplete);
            $(data.fake_input).bind('result', data, function (event, data, formatted) {
              if (data) {
                $('#' + id).addTag(data[0] + "", {focus: true, unique: (settings.unique)});
              }
            });
          } else if (jQuery.ui.autocomplete !== undefined) {
            $(data.fake_input).autocomplete(autocomplete_options);
            $(data.fake_input).bind('autocompleteselect', data, function (event, ui) {
              $(event.data.real_input).addTag(ui.item.value, {focus: true, unique: (settings.unique)});
              return false;
            });
          }


        } else {
          // if a user tabs out of the field, create a new tag
          // this is only available if autocomplete is not used.
          $(data.fake_input).bind('blur', data, function (event) {
            var d = $(this).attr('data-default');
            if ($(event.data.fake_input).val() != '' && $(event.data.fake_input).val() != d) {
              if ((event.data.minChars <= $(event.data.fake_input).val().length) && (!event.data.maxChars || (event.data.maxChars >= $(event.data.fake_input).val().length)))
                $(event.data.real_input).addTag($(event.data.fake_input).val(), {
                  focus: true,
                  unique: (settings.unique)
                });
            } else {
              $(event.data.fake_input).val($(event.data.fake_input).attr('data-default'));
              $(event.data.fake_input).css('color', settings.placeholderColor);
            }
            return false;
          });

        }
        // if user types a comma, create a new tag
        $(data.fake_input).bind('keypress', data, function (event) {
          if (event.which == event.data.delimiter.charCodeAt(0) || event.which == 13) {
            event.preventDefault();
            if ((event.data.minChars <= $(event.data.fake_input).val().length) && (!event.data.maxChars || (event.data.maxChars >= $(event.data.fake_input).val().length)))
              $(event.data.real_input).addTag($(event.data.fake_input).val(), {
                focus: true,
                unique: (settings.unique)
              });
            $(event.data.fake_input).resetAutosize(settings);
            return false;
          } else if (event.data.autosize) {
            $(event.data.fake_input).doAutosize(settings);

          }
        });
        //Delete last tag on backspace
        data.removeWithBackspace && $(data.fake_input).bind('keydown', function (event) {
          if (event.keyCode == 8 && $(this).val() == '') {
            event.preventDefault();
            var last_tag = $(this).closest('.tagsinput').find('.tag:last').text();
            var id = $(this).attr('id').replace(/_tag$/, '');
            last_tag = last_tag.replace(/[\s]+x$/, '');
            $('#' + id).removeTag(escape(last_tag));
            $(this).trigger('focus');
          }
        });
        $(data.fake_input).blur();

        //Removes the not_valid class when user changes the value of the fake input
        if (data.unique) {
          $(data.fake_input).keydown(function (event) {
            if (event.keyCode == 8 || String.fromCharCode(event.which).match(/\w+|[áéíóúÁÉÍÓÚñÑ,/]+/)) {
              $(this).removeClass('not_valid');
            }
          });
        }
      } // if settings.interactive
    });

    return this;

  };

  $.fn.tagsInput.updateTagsField = function (obj, tagslist) {
    var id = $(obj).attr('id');
    $(obj).val(tagslist.join(delimiter[id]));
  };

  $.fn.tagsInput.importTags = function (obj, val) {
    $(obj).val('');
    var id = $(obj).attr('id');
    var tags = val.split(delimiter[id]);
    for (i = 0; i < tags.length; i++) {
      $(obj).addTag(tags[i], {focus: false, callback: false});
    }
    if (tags_callbacks[id] && tags_callbacks[id]['onChange']) {
      var f = tags_callbacks[id]['onChange'];
      f.call(obj, obj, tags[i]);
    }
  };

})(jQuery);

(function ($) {

  $.fn.alphanumeric = function (p) {

    p = $.extend({
      ichars: "öäüéàèô£†Ω°¡øπœ∑€®¢æ§¨!@#$%^&*()+=[]\\\';,/{}|:<>?~`. ",
      nchars: "",
      allow: ""
    }, p);

    return this.each
    (
      function () {

        if (p.nocaps) p.nchars += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if (p.allcaps) p.nchars += "abcdefghijklmnopqrstuvwxyz";

        s = p.allow.split('');
        for (i = 0; i < s.length; i++) if (p.ichars.indexOf(s[i]) != -1) s[i] = "\\" + s[i];
        p.allow = s.join('|');

        var reg = new RegExp(p.allow, 'gi');
        var ch = p.ichars + p.nchars;
        ch = ch.replace(reg, '');

        $(this).keypress
        (
          function (e) {

            if (!e.charCode) k = String.fromCharCode(e.which);
            else k = String.fromCharCode(e.charCode);

            if (ch.indexOf(k) != -1) e.preventDefault();
            if (e.ctrlKey && k == 'v') e.preventDefault();

          }
        );

        $(this).bind('contextmenu', function () {
          return false
        });

      }
    );

  };

  $.fn.numeric = function (p) {

    var az = "abcdefghijklmnopqrstuvwxyz";
    az += az.toUpperCase();

    p = $.extend({
      nchars: az
    }, p);

    return this.each(function () {
        $(this).alphanumeric(p);
      }
    );

  };

  $.fn.alpha = function (p) {

    var nm = "1234567890";

    p = $.extend({
      nchars: nm
    }, p);

    return this.each(function () {
        $(this).alphanumeric(p);
      }
    );

  };

})(jQuery);

// Ajax Search
(function ($) {

  $.fn.ajaxSearch = function (settings) {

    var defaultSettings = {
      apiURL: '',
      resultsDiv: $('#ajaxsearchR'),
      seo: '',
      searchid: '',
      msgtypeid: '',
      msg: 'No result were found',
      working: false,
      append: false
    }

    $('#ajaxsearchForm').submit(function () {

      /* Combining the default settings object with the supplied one */
      sett = $.extend(defaultSettings, settings);

      if (sett.working) return false;

      // Input id
      usrinput = $('#Jajaxs').val();

      sett.working = true;
      $('.loadSearchResult').fadeIn();

      // Get the result
      $.get(sett.apiURL, {
        q: usrinput,
        url: jakWeb.jak_url,
        url_detail: jakWeb.jak_search_link,
        seo: sett.seo,
        searchid: sett.searchid,
        msgtypeid: sett.msgtypeid
      }, function (r) {

        sett.working = false;
        $('.loadSearchResult').fadeOut();

        if (r.length) {

          // If results were returned, add them to a pageContainer div,
          // after which append them to the #resultsDiv:

          var pageContainer = $('<div>').addClass('ajaxspageContainer');


          pageContainer.append(r);

          if (!sett.append) {
            // This is executed when running a new search,
            // instead of clicking on the More button:
            sett.resultsDiv.empty();
          }

          pageContainer.append('<div class="clearfix"></div>').hide().appendTo(sett.resultsDiv).fadeIn('slow');

          $('.hideSearchResult').fadeIn();
          $('.hideAdvSearchResult').fadeOut();

        }
        // No result display the nothing found message
        else {

          $('.hideSearchResult').fadeOut();

          // No results were found for this search.

          sett.resultsDiv.empty();
          $('<div>', {html: sett.msg}).addClass('alert bg-danger').hide().appendTo(sett.resultsDiv).fadeIn();
        }
      });

      return false;

    });

    $('.hideSearchResult a').click(function (e) {
      e.preventDefault();
      defaultSettings.resultsDiv.empty();
      $('.hideSearchResult').fadeOut();
      $('.hideAdvSearchResult').fadeIn();
      $('#Jajaxs').val('');
    });
  };

})(jQuery);

/* Password strength indicator */
function passwordStrength(password) {

  var desc = [{'width': '0px'}, {'width': '20%'}, {'width': '40%'}, {'width': '60%'}, {'width': '80%'}, {'width': '100%'}];

  var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];

  var score = 0;

  //if password bigger than 6 give 1 point
  if (password.length > 6) score++;

  //if password has both lower and uppercase characters give 1 point
  if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) score++;

  //if password has at least one number give 1 point
  if (password.match(/\d+/)) score++;

  //if password has at least one special caracther give 1 point
  if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))    score++;

  //if password bigger than 12 give another 1 point
  if (password.length > 10) score++;

  // display indicator
  $("#jak_pstrength").removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
}

/*!
 * Jasny Bootstrap v3.0.1-p7, maintained by @ArnoldDaniels
 * Copyright 2014 Twitter, Inc
 * Licensed under http://www.apache.org/licenses/LICENSE-2.0
 */

if ("undefined" == typeof jQuery)throw new Error("Bootstrap requires jQuery");
+function (a) {
  "use strict";
  var b = function (c, d) {
    this.$element = a(c), this.$canvas = d.canvas ? a(d.canvas) : this.$element, this.options = a.extend({}, b.DEFAULTS, d), this.transitioning = null, this.calcTransform(), this.transform || (this.$canvas = this.$element), "auto" === this.options.placement && (this.options.placement = this.calcPlacement()), this.options.recalc && (this.calcClone(), a(window).on("resize.bs.offcanvas", a.proxy(this.recalc, this))), this.options.autohide && a(document).on("click.bs.offcanvas", a.proxy(this.autohide, this));
    var e = "Microsoft Internet Explorer" == window.navigator.appName;
    if (e && this.$canvas !== this.$element) {
      var f = this.$canvas.find("*").filter(function () {
        return "fixed" === a(this).css("position")
      });
      this.$canvas = this.$canvas.add(f)
    }
    this.options.toggle && this.toggle()
  };
  b.DEFAULTS = {toggle: !0, placement: "auto", autohide: !0, recalc: !0}, b.prototype.calcTransform = function () {
    if (this.transform = !1, a.support.transition || this.$canvas !== this.$element) {
      var b = a('<div style="visibility: hidden"></div>'), c = {
        transform: "transform",
        webkitTransform: "-webkit-transform",
        OTransform: "-o-transform",
        msTransform: "-ms-transform",
        MozTransform: "-moz-transform"
      };
      b.appendTo(a("body"));
      for (var d in c)if (void 0 !== b[0].style[d]) {
        b[0].style[d] = "translate3d(1px,1px,1px)";
        var e = window.getComputedStyle(b[0]).getPropertyValue(c[d]);
        this.transform = c[d], this.translate = e.match(/^matrix3d/) ? "translate3d" : "translate";
        break
      }
      b.remove()
    }
  }, b.prototype.calcPlacement = function () {
    function b(a, b) {
      if ("auto" === e.css(b))return a;
      if ("auto" === e.css(a))return b;
      var c = parseInt(e.css(a), 10), d = parseInt(e.css(b), 10);
      return c > d ? b : a
    }

    var c = a(window).width() / this.$element.width(), d = a(window).height() / this.$element.height(), e = this.$element;
    return c > d ? b("left", "right") : b("top", "bottom")
  }, b.prototype.offset = function () {
    switch (this.options.placement) {
      case"left":
      case"right":
        return this.$element.outerWidth();
      case"top":
      case"bottom":
        return this.$element.outerHeight()
    }
  }, b.prototype.slideTransform = function (b, c) {
    var d = this.options.placement, e = this.transform;
    b *= "right" === d || "bottom" === d ? -1 : 1;
    var f = "left" === d || "right" === d ? "{}px, 0" : "0, {}px";
    return "translate3d" === this.translate && (f += ", 0"), f = this.translate + "(" + f + ")", a.support.transition ? (this.$canvas.css(e, f.replace("{}", b)), this.$element.one(a.support.transition.end, c).emulateTransitionEnd(350), void 0) : this.$canvas.animate({borderSpacing: b}, {
      step: function (b) {
        a(this).css(e, f.replace("{}", b))
      }, complete: c, duration: 350
    })
  }, b.prototype.slidePosition = function (b, c) {
    if (!a.support.transition) {
      var d = {};
      return d[this.options.placement] = b, this.$canvas.animate(d, 350, c)
    }
    this.$canvas.css(this.options.placement, b), this.$element.one(a.support.transition.end, c).emulateTransitionEnd(350)
  }, b.prototype.show = function () {
    if (!this.transitioning && !this.$canvas.hasClass("canvas-slid")) {
      var b = a.Event("show.bs.offcanvas");
      if (this.$element.trigger(b), !b.isDefaultPrevented()) {
        var c = function () {
          this.$canvas.addClass("canvas-slid").removeClass("canvas-sliding"), this.transitioning = 0, this.$element.trigger("shown.bs.offcanvas")
        };
        this.$element.is(":visible") && this.transform || this.$element.css(this.options.placement, -1 * this.offset() + "px"), this.$element.addClass("in"), this.$canvas.addClass("canvas-sliding"), this.$canvas != this.$element && a("body").css("overflow-x", "hidden"), this.transitioning = 1, this.transform ? this.slideTransform(this.offset(), a.proxy(c, this)) : this.slidePosition(0, a.proxy(c, this))
      }
    }
  }, b.prototype.hide = function (b) {
    if (!this.transitioning && this.$canvas.hasClass("canvas-slid")) {
      var c = a.Event("hide.bs.offcanvas");
      if (this.$element.trigger(c), !c.isDefaultPrevented()) {
        var d = function () {
          this.transitioning = 0, this.$element.removeClass("in").css("left", "").css("right", "").css("top", "").css("bottom", ""), this.$canvas.removeClass("canvas-sliding canvas-slid").css("transform", ""), a("body").css("overflow-x", ""), this.$element.trigger("hidden.bs.offcanvas")
        };
        if (b)return d.call(this);
        this.$canvas.removeClass("canvas-slid").addClass("canvas-sliding"), this.transitioning = 1, this.transform ? this.slideTransform(0, a.proxy(d, this)) : this.slidePosition(-1 * this.offset(), a.proxy(d, this))
      }
    }
  }, b.prototype.toggle = function () {
    this[this.$canvas.hasClass("canvas-slid") ? "hide" : "show"]()
  }, b.prototype.calcClone = function () {
    this.$calcClone = this.$element.clone().html("").addClass("offcanvas-clone").removeClass("in").appendTo(a("body"))
  }, b.prototype.recalc = function () {
    "none" !== this.$calcClone.css("display") && this.hide(!0)
  }, b.prototype.autohide = function (b) {
    0 === a(b.target).closest(this.$element).length && this.hide()
  };
  var c = a.fn.offcanvas;
  a.fn.offcanvas = function (c) {
    return this.each(function () {
      var d = a(this), e = d.data("bs.offcanvas"), f = a.extend({}, b.DEFAULTS, d.data(), "object" == typeof c && c);
      e || d.data("bs.offcanvas", e = new b(this, f)), "string" == typeof c && e[c]()
    })
  }, a.fn.offcanvas.Constructor = b, a.fn.offcanvas.noConflict = function () {
    return a.fn.offcanvas = c, this
  }, a(document).on("click.bs.offcanvas.data-api", "[data-toggle=offcanvas]", function (b) {
    var c, d = a(this), e = d.attr("data-target") || b.preventDefault() || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, ""), f = a(e), g = f.data("bs.offcanvas"), h = g ? "toggle" : d.data();
    b.stopPropagation(), g ? g.toggle() : f.offcanvas(h)
  })
}(window.jQuery), +function (a) {
  "use strict";
  var b = function (c, d) {
    this.$element = a(c), this.options = a.extend({}, b.DEFAULTS, d), this.$element.on("click.bs.rowlink", "td:not(.rowlink-skip)", a.proxy(this.click, this))
  };
  b.DEFAULTS = {target: "a"}, b.prototype.click = function (b) {
    var c = a(b.currentTarget).closest("tr").find(this.options.target)[0];
    if (a(b.target)[0] !== c)if (b.preventDefault(), c.click)c.click(); else if (document.createEvent) {
      var d = document.createEvent("MouseEvents");
      d.initMouseEvent("click", !0, !0, window, 0, 0, 0, 0, 0, !1, !1, !1, !1, 0, null), c.dispatchEvent(d)
    }
  }, a.fn.rowlink = function (c) {
    return this.each(function () {
      var d = a(this), e = d.data("rowlink");
      e || d.data("rowlink", e = new b(this, c))
    })
  }, a.fn.rowlink.Constructor = b, a.fn.rowlink.noConflict = function () {
    return a.fn.inputmask = old, this
  }, a(document).on("click.bs.rowlink.data-api", '[data-link="row"]', function (b) {
    var c = a(this);
    c.data("rowlink") || (c.rowlink(c.data()), a(b.target).trigger("click.bs.rowlink"))
  })
}(window.jQuery), +function (a) {
  "use strict";
  var b = void 0 !== window.orientation, c = navigator.userAgent.toLowerCase().indexOf("android") > -1, d = "Microsoft Internet Explorer" == window.navigator.appName, e = function (b, d) {
    c || (this.$element = a(b), this.options = a.extend({}, e.DEFAULS, d), this.mask = String(this.options.mask), this.init(), this.listen(), this.checkVal())
  };
  e.DEFAULS = {
    mask: "",
    placeholder: "_",
    definitions: {9: "[0-9]", a: "[A-Za-z]", "?": "[A-Za-z0-9]", "*": "."}
  }, e.prototype.init = function () {
    var b = this.options.definitions, c = this.mask.length;
    this.tests = [], this.partialPosition = this.mask.length, this.firstNonMaskPos = null, a.each(this.mask.split(""), a.proxy(function (a, d) {
      "?" == d ? (c--, this.partialPosition = a) : b[d] ? (this.tests.push(new RegExp(b[d])), null === this.firstNonMaskPos && (this.firstNonMaskPos = this.tests.length - 1)) : this.tests.push(null)
    }, this)), this.buffer = a.map(this.mask.split(""), a.proxy(function (a) {
      return "?" != a ? b[a] ? this.options.placeholder : a : void 0
    }, this)), this.focusText = this.$element.val(), this.$element.data("rawMaskFn", a.proxy(function () {
      return a.map(this.buffer, function (a, b) {
        return this.tests[b] && a != this.options.placeholder ? a : null
      }).join("")
    }, this))
  }, e.prototype.listen = function () {
    if (!this.$element.attr("readonly")) {
      var b = (d ? "paste" : "input") + ".mask";
      this.$element.on("unmask.bs.inputmask", a.proxy(this.unmask, this)).on("focus.bs.inputmask", a.proxy(this.focusEvent, this)).on("blur.bs.inputmask", a.proxy(this.blurEvent, this)).on("keydown.bs.inputmask", a.proxy(this.keydownEvent, this)).on("keypress.bs.inputmask", a.proxy(this.keypressEvent, this)).on(b, a.proxy(this.pasteEvent, this))
    }
  }, e.prototype.caret = function (a, b) {
    if (0 !== this.$element.length) {
      if ("number" == typeof a)return b = "number" == typeof b ? b : a, this.$element.each(function () {
        if (this.setSelectionRange)this.setSelectionRange(a, b); else if (this.createTextRange) {
          var c = this.createTextRange();
          c.collapse(!0), c.moveEnd("character", b), c.moveStart("character", a), c.select()
        }
      });
      if (this.$element[0].setSelectionRange)a = this.$element[0].selectionStart, b = this.$element[0].selectionEnd; else if (document.selection && document.selection.createRange) {
        var c = document.selection.createRange();
        a = 0 - c.duplicate().moveStart("character", -1e5), b = a + c.text.length
      }
      return {begin: a, end: b}
    }
  }, e.prototype.seekNext = function (a) {
    for (var b = this.mask.length; ++a <= b && !this.tests[a];);
    return a
  }, e.prototype.seekPrev = function (a) {
    for (; --a >= 0 && !this.tests[a];);
    return a
  }, e.prototype.shiftL = function (a, b) {
    var c = this.mask.length;
    if (!(0 > a)) {
      for (var d = a, e = this.seekNext(b); c > d; d++)if (this.tests[d]) {
        if (!(c > e && this.tests[d].test(this.buffer[e])))break;
        this.buffer[d] = this.buffer[e], this.buffer[e] = this.options.placeholder, e = this.seekNext(e)
      }
      this.writeBuffer(), this.caret(Math.max(this.firstNonMaskPos, a))
    }
  }, e.prototype.shiftR = function (a) {
    for (var b = this.mask.length, c = a, d = this.options.placeholder; b > c; c++)if (this.tests[c]) {
      var e = this.seekNext(c), f = this.buffer[c];
      if (this.buffer[c] = d, !(b > e && this.tests[e].test(f)))break;
      d = f
    }
  }, e.prototype.unmask = function () {
    this.$element.unbind(".mask").removeData("inputmask")
  }, e.prototype.focusEvent = function () {
    this.focusText = this.$element.val();
    var a = this.mask.length, b = this.checkVal();
    this.writeBuffer();
    var c = this, d = function () {
      b == a ? c.caret(0, b) : c.caret(b)
    };
    d(), setTimeout(d, 50)
  }, e.prototype.blurEvent = function () {
    this.checkVal(), this.$element.val() !== this.focusText && this.$element.trigger("change")
  }, e.prototype.keydownEvent = function (a) {
    var c = a.which;
    if (8 == c || 46 == c || b && 127 == c) {
      var d = this.caret(), e = d.begin, f = d.end;
      return 0 === f - e && (e = 46 != c ? this.seekPrev(e) : f = this.seekNext(e - 1), f = 46 == c ? this.seekNext(f) : f), this.clearBuffer(e, f), this.shiftL(e, f - 1), !1
    }
    return 27 == c ? (this.$element.val(this.focusText), this.caret(0, this.checkVal()), !1) : void 0
  }, e.prototype.keypressEvent = function (a) {
    var b = this.mask.length, c = a.which, d = this.caret();
    if (a.ctrlKey || a.altKey || a.metaKey || 32 > c)return !0;
    if (c) {
      0 !== d.end - d.begin && (this.clearBuffer(d.begin, d.end), this.shiftL(d.begin, d.end - 1));
      var e = this.seekNext(d.begin - 1);
      if (b > e) {
        var f = String.fromCharCode(c);
        if (this.tests[e].test(f)) {
          this.shiftR(e), this.buffer[e] = f, this.writeBuffer();
          var g = this.seekNext(e);
          this.caret(g)
        }
      }
      return !1
    }
  }, e.prototype.pasteEvent = function () {
    var a = this;
    setTimeout(function () {
      a.caret(a.checkVal(!0))
    }, 0)
  }, e.prototype.clearBuffer = function (a, b) {
    for (var c = this.mask.length, d = a; b > d && c > d; d++)this.tests[d] && (this.buffer[d] = this.options.placeholder)
  }, e.prototype.writeBuffer = function () {
    return this.$element.val(this.buffer.join("")).val()
  }, e.prototype.checkVal = function (a) {
    for (var b = this.mask.length, c = this.$element.val(), d = -1, e = 0, f = 0; b > e; e++)if (this.tests[e]) {
      for (this.buffer[e] = this.options.placeholder; f++ < c.length;) {
        var g = c.charAt(f - 1);
        if (this.tests[e].test(g)) {
          this.buffer[e] = g, d = e;
          break
        }
      }
      if (f > c.length)break
    } else this.buffer[e] == c.charAt(f) && e != this.partialPosition && (f++, d = e);
    return !a && d + 1 < this.partialPosition ? (this.$element.val(""), this.clearBuffer(0, b)) : (a || d + 1 >= this.partialPosition) && (this.writeBuffer(), a || this.$element.val(this.$element.val().substring(0, d + 1))), this.partialPosition ? e : this.firstNonMaskPos
  };
  var f = a.fn.inputmask;
  a.fn.inputmask = function (b) {
    return this.each(function () {
      var c = a(this), d = c.data("inputmask");
      d || c.data("inputmask", d = new e(this, b))
    })
  }, a.fn.inputmask.Constructor = e, a.fn.inputmask.noConflict = function () {
    return a.fn.inputmask = f, this
  }, a(document).on("focus.bs.inputmask.data-api", "[data-mask]", function () {
    var b = a(this);
    b.data("inputmask") || b.inputmask(b.data())
  })
}(window.jQuery), +function (a) {
  "use strict";
  var b = "Microsoft Internet Explorer" == window.navigator.appName, c = function (b, c) {
    if (this.$element = a(b), this.$input = this.$element.find(":file"), 0 !== this.$input.length) {
      this.name = this.$input.attr("name") || c.name, this.$hidden = this.$element.find('input[type=hidden][name="' + this.name + '"]'), 0 === this.$hidden.length && (this.$hidden = a('<input type="hidden" />'), this.$element.prepend(this.$hidden)), this.$preview = this.$element.find(".fileinput-preview");
      var d = this.$preview.css("height");
      "inline" != this.$preview.css("display") && "0px" != d && "none" != d && this.$preview.css("line-height", d), this.original = {
        exists: this.$element.hasClass("fileinput-exists"),
        preview: this.$preview.html(),
        hiddenVal: this.$hidden.val()
      }, this.listen()
    }
  };
  c.prototype.listen = function () {
    this.$input.on("change.bs.fileinput", a.proxy(this.change, this)), a(this.$input[0].form).on("reset.bs.fileinput", a.proxy(this.reset, this)), this.$element.find('[data-trigger="fileinput"]').on("click.bs.fileinput", a.proxy(this.trigger, this)), this.$element.find('[data-dismiss="fileinput"]').on("click.bs.fileinput", a.proxy(this.clear, this))
  }, c.prototype.change = function (b) {
    if (void 0 === b.target.files && (b.target.files = b.target && b.target.value ? [{name: b.target.value.replace(/^.+\\/, "")}] : []), 0 !== b.target.files.length) {
      this.$hidden.val(""), this.$hidden.attr("name", ""), this.$input.attr("name", this.name);
      var c = b.target.files[0];
      if (this.$preview.length > 0 && ("undefined" != typeof c.type ? c.type.match("image.*") : c.name.match(/\.(gif|png|jpe?g)$/i)) && "undefined" != typeof FileReader) {
        var d = new FileReader, e = this.$preview, f = this.$element;
        d.onload = function (d) {
          var g = a("<img>").attr("src", d.target.result);
          b.target.files[0].result = d.target.result, f.find(".fileinput-filename").text(c.name), "none" != e.css("max-height") && g.css("max-height", parseInt(e.css("max-height"), 10) - parseInt(e.css("padding-top"), 10) - parseInt(e.css("padding-bottom"), 10) - parseInt(e.css("border-top"), 10) - parseInt(e.css("border-bottom"), 10)), e.html(g), f.addClass("fileinput-exists").removeClass("fileinput-new"), f.trigger("change.bs.fileinput", b.target.files)
        }, d.readAsDataURL(c)
      } else this.$element.find(".fileinput-filename").text(c.name), this.$preview.text(c.name), this.$element.addClass("fileinput-exists").removeClass("fileinput-new"), this.$element.trigger("change.bs.fileinput")
    }
  }, c.prototype.clear = function (a) {
    if (a && a.preventDefault(), this.$hidden.val(""), this.$hidden.attr("name", this.name), this.$input.attr("name", ""), b) {
      var c = this.$input.clone(!0);
      this.$input.after(c), this.$input.remove(), this.$input = c
    } else this.$input.val("");
    this.$preview.html(""), this.$element.find(".fileinput-filename").text(""), this.$element.addClass("fileinput-new").removeClass("fileinput-exists"), a !== !1 && (this.$input.trigger("change"), this.$element.trigger("clear.bs.fileinput"))
  }, c.prototype.reset = function () {
    this.clear(!1), this.$hidden.val(this.original.hiddenVal), this.$preview.html(this.original.preview), this.$element.find(".fileinput-filename").text(""), this.original.exists ? this.$element.addClass("fileinput-exists").removeClass("fileinput-new") : this.$element.addClass("fileinput-new").removeClass("fileinput-exists"), this.$element.trigger("reset.bs.fileinput")
  }, c.prototype.trigger = function (a) {
    this.$input.trigger("click"), a.preventDefault()
  }, a.fn.fileinput = function (b) {
    return this.each(function () {
      var d = a(this), e = d.data("fileinput");
      e || d.data("fileinput", e = new c(this, b)), "string" == typeof b && e[b]()
    })
  }, a.fn.fileinput.Constructor = c, a(document).on("click.fileinput.data-api", '[data-provides="fileinput"]', function (b) {
    var c = a(this);
    if (!c.data("fileinput")) {
      c.fileinput(c.data());
      var d = a(b.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');
      d.length > 0 && (b.preventDefault(), d.trigger("click.bs.fileinput"))
    }
  })
}(window.jQuery);

// Generated by CoffeeScript 1.6.3
/*
 Lightbox for Bootstrap 3 by @ashleydw
 https://github.com/ashleydw/lightbox

 License: https://github.com/ashleydw/lightbox/blob/master/LICENSE
 */

eval(function (p, a, c, k, e, r) {
  e = function (c) {
    return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
  };
  if (!''.replace(/^/, String)) {
    while (c--)r[e(c)] = k[c] || e(c);
    k = [function (e) {
      return r[e]
    }];
    e = function () {
      return '\\w+'
    };
    c = 1
  }
  ;
  while (c--)if (k[c])p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
  return p
}('(5(){"1F 1G";o d;d=5(a,b){o c,t,O,p;3.8=$.1a({P:Q,t:Q,q:Q,1H:z,1b:5(){},1c:5(){},1d:5(){},1e:5(){7(3.A){$(R).1I(\'1f.D\')}6 3.4.1J()},1g:S},b||{});3.$l=$(a);c=\'\';3.E=3.8.E?3.8.E:\'D-\'+1h.1K((1h.1L()*1M)+1);O=3.8.P?\'<9 r="4-O"><Z 1N="Z" r="1i" j-1O="4" 1P-1j="z">&1Q;</Z><1k r="4-P">\'+3.8.P+\'</1k></9>\':\'\';t=3.8.t?\'<9 r="4-t">\'+3.8.t+\'</9>\':\'\';$(R.12).1R(\'<9 1g="\'+3.E+\'" r="4 1S" 1T="-1"><9 r="4-1l"><9 r="4-1m">\'+O+\'<9 r="4-12"></9>\'+t+\'</9></9></9>\');3.4=$(\'#\'+3.E);3.m=3.4.F(\'.4-12\').13();3.k={G:T(3.m.B(\'k-G\'),10),H:T(3.m.B(\'k-H\'),10),1n:T(3.m.B(\'k-1n\'),10),1o:T(3.m.B(\'k-1o\'),10)};7(!3.8.q){3.14(\'1U q 1V 1W\')}x{7(3.I(3.8.q)){3.J(3.8.q,z)}x 7(p=3.U(3.8.q)){3.V(p)}x 7(3.1p(3.8.q)){1X.1Y(\'1Z\')}3.A=3.$l.j(\'A\');7(3.A){3.y=3.$l.21(\'*:22(.23)\').13().F(\'*[j-1q="1r"][j-A="\'+3.A+\'"]\');3.s=3.y.24(3.$l);$(R).K(\'1f.D\',3.1s.L(3))}}3.4.K(\'1t.W.4\',3.8.1b.L(3)).K(\'25.W.4\',3.8.1c.L(3)).K(\'15.W.4\',3.8.1d.L(3)).K(\'1j.W.4\',3.8.1e.L(3)).4(\'1t\',b);6 3.4};d.26={I:5(a){6 a.16(/(^j:1u\\/.*,)|(\\.(27(e|g|28)|29|2a|2b|2c|2d)((\\?|#).*)?$)/i)},1p:5(a){6 a.16(/\\.(2e)((\\?|#).*)?$/i)},U:5(a){o b;b=a.16(/^.*(2f.2g\\/|v\\/|u\\/\\w\\/|1v\\/|2h\\?v=|\\&v=)([^#\\&\\?]*).*/);7(b&&b[2].17===11){6 b[2]}x{6 S}},1s:5(a){o b,f,p;a=a||1w.2i;7(a.X===1x||a.X===1y){7(a.X===1x&&3.s+1<3.y.17){3.s++;3.$l=$(3.y.18(3.s));f=3.$l.n(\'j-M\')||3.$l.n(\'N\');7(3.I(f)){3.J(f,z)}x 7(p=3.U(f)){3.V(p)}7(3.s+1<3.y.17){b=$(3.y.18(3.s+1),S);f=b.n(\'j-M\')||b.n(\'N\');7(3.I(f)){6 3.J(f,S)}}}x 7(a.X===1y&&3.s>0){3.s--;3.$l=$(3.y.18(3.s));f=3.$l.n(\'j-M\')||3.$l.n(\'N\');7(3.I(f)){6 3.J(f,z)}x 7(p=3.U(f)){6 3.V(p)}}}},2j:5(){6 3.m.Y(\'<9 r="4-2k">2l..</9>\')},V:5(a){3.19(1z,1A);6 3.m.Y(\'<1B h="1z" 1C="1A" f="//2m.p.2n/1v/\'+a+\'?2o=1" 2p="0" 2q></1B>\')},14:5(a){6 3.m.Y(a)},J:5(a,b){o c,C=3;c=1D 2r();7((b==Q)||b===z){c.2s=5(){o i,h;C.1E(c);C.m.Y(c);i=C.m.F(\'2t\').13();h=i&&i.h()>0?i.h():c.h;6 C.19(h,i.1C())};c.2u=5(){6 C.14(\'2v 2w 2x 1u: \'+a)}}6 c.f=a},1i:5(){6 3.4.4(\'15\')},19:5(a,b){a=a+3.k.G+3.k.H;3.4.F(\'.4-1m\').B({\'h\':a});6 3.4.F(\'.4-1l\').B({\'h\':a+20})},1E:5(a){o w;w=$(1w);7((a.h+(3.k.G+3.k.H+20))>w.h()){6 a.h=w.h()-(3.k.G+3.k.H+20)}}};$.2y.D=5(b){6 3.2z(5(){o a;a=$(3);b=$.1a({q:a.n(\'j-M\')||a.n(\'N\')},a.j());1D d(3,b);6 3})};$(R).2A(\'*[j-1q="1r"]\',\'2B\',5(a){o b;a.2C();b=$(3);6 b.D({q:b.n(\'j-M\')||b.n(\'N\')}).2D(\'15\',5(){6 b.2E(\':2F\')&&b.2G()})})}).2H(3);', 62, 168, '|||this|modal|function|return|if|options|div||||||src||width||data|padding|element|modal_body|attr|var|youtube|remote|class|gallery_index|footer||||else|gallery_items|true|gallery|css|_this|jakBox|modal_id|find|left|right|isImage|preloadImage|on|bind|source|href|header|title|null|document|false|parseFloat|getYoutubeId|showYoutubeVideo|bs|keyCode|html|button|||body|first|error|hide|match|length|get|resize|extend|onShow|onShown|onHide|onHidden|keydown|id|Math|close|hidden|h4|dialog|content|bottom|top|isSwf|toggle|lightbox|navigate|show|image|embed|window|39|37|560|315|iframe|height|new|checkImageDimensions|use|strict|keyboard|off|remove|floor|random|1000|type|dismiss|aria|times|append|fade|tabindex|No|target|given|console|log|todo||parents|not|row|index|shown|prototype|jp|eg|gif|png|bmp|webp|svg|swf|youtu|be|watch|event|showLoading|loading|Loading|www|com|autoplay|frameborder|allowfullscreen|Image|onload|img|onerror|Failed|to|load|fn|each|delegate|click|preventDefault|one|is|visible|focus|call'.split('|'), 0, {}));

!function (t) {
  "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof exports ? require("jquery") : jQuery)
}(function (t) {
  function s(s) {
    var e = !1;
    return t('[data-notify="container"]').each(function (i, n) {
      var a = t(n), o = a.find('[data-notify="title"]').text().trim(), r = a.find('[data-notify="message"]').html().trim(), l = o === t("<div>" + s.settings.content.title + "</div>").html().trim(), d = r === t("<div>" + s.settings.content.message + "</div>").html().trim(), g = a.hasClass("bg-" + s.settings.type);
      return l && d && g && (e = !0), !e
    }), e
  }

  function e(e, n, a) {
    var o = {
      content: {
        message: "object" == typeof n ? n.message : n,
        title: n.title ? n.title : "",
        icon: n.icon ? n.icon : "",
        url: n.url ? n.url : "#",
        target: n.target ? n.target : "-"
      }
    };
    a = t.extend(!0, {}, o, a), this.settings = t.extend(!0, {}, i, a), this._defaults = i, "-" === this.settings.content.target && (this.settings.content.target = this.settings.url_target), this.animations = {
      start: "webkitAnimationStart oanimationstart MSAnimationStart animationstart",
      end: "webkitAnimationEnd oanimationend MSAnimationEnd animationend"
    }, "number" == typeof this.settings.offset && (this.settings.offset = {
      x: this.settings.offset,
      y: this.settings.offset
    }), (this.settings.allow_duplicates || !this.settings.allow_duplicates && !s(this)) && this.init()
  }

  var i = {
    element: "body",
    position: null,
    type: "info",
    allow_dismiss: !0,
    allow_duplicates: !0,
    newest_on_top: !1,
    showProgressbar: !1,
    placement: {from: "top", align: "right"},
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5e3,
    timer: 1e3,
    url_target: "_blank",
    mouse_over: null,
    animate: {enter: "animated fadeInDown", exit: "animated fadeOutUp"},
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: "class",
    template: '<div data-notify="container" class="col-xs-11 col-sm-4 alert bg-{0}" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'
  };
  String.format = function () {
    for (var t = arguments[0], s = 1; s < arguments.length; s++)t = t.replace(RegExp("\\{" + (s - 1) + "\\}", "gm"), arguments[s]);
    return t
  }, t.extend(e.prototype, {
    init: function () {
      var t = this;
      this.buildNotify(), this.settings.content.icon && this.setIcon(), "#" != this.settings.content.url && this.styleURL(), this.styleDismiss(), this.placement(), this.bind(), this.notify = {
        $ele: this.$ele,
        update: function (s, e) {
          var i = {};
          "string" == typeof s ? i[s] = e : i = s;
          for (var n in i)switch (n) {
            case"type":
              this.$ele.removeClass("bg-" + t.settings.type), this.$ele.find('[data-notify="progressbar"] > .progress-bar').removeClass("progress-bar-" + t.settings.type), t.settings.type = i[n], this.$ele.addClass("bg-" + i[n]).find('[data-notify="progressbar"] > .progress-bar').addClass("progress-bar-" + i[n]);
              break;
            case"icon":
              var a = this.$ele.find('[data-notify="icon"]');
              "class" === t.settings.icon_type.toLowerCase() ? a.removeClass(t.settings.content.icon).addClass(i[n]) : (a.is("img") || a.find("img"), a.attr("src", i[n]));
              break;
            case"progress":
              var o = t.settings.delay - t.settings.delay * (i[n] / 100);
              this.$ele.data("notify-delay", o), this.$ele.find('[data-notify="progressbar"] > div').attr("aria-valuenow", i[n]).css("width", i[n] + "%");
              break;
            case"url":
              this.$ele.find('[data-notify="url"]').attr("href", i[n]);
              break;
            case"target":
              this.$ele.find('[data-notify="url"]').attr("target", i[n]);
              break;
            default:
              this.$ele.find('[data-notify="' + n + '"]').html(i[n])
          }
          var r = this.$ele.outerHeight() + parseInt(t.settings.spacing) + parseInt(t.settings.offset.y);
          t.reposition(r)
        },
        close: function () {
          t.close()
        }
      }
    }, buildNotify: function () {
      var s = this.settings.content;
      this.$ele = t(String.format(this.settings.template, this.settings.type, s.title, s.message, s.url, s.target)), this.$ele.attr("data-notify-position", this.settings.placement.from + "-" + this.settings.placement.align), this.settings.allow_dismiss || this.$ele.find('[data-notify="dismiss"]').css("display", "none"), (this.settings.delay > 0 || this.settings.showProgressbar) && this.settings.showProgressbar || this.$ele.find('[data-notify="progressbar"]').remove()
    }, setIcon: function () {
      "class" === this.settings.icon_type.toLowerCase() ? this.$ele.find('[data-notify="icon"]').addClass(this.settings.content.icon) : this.$ele.find('[data-notify="icon"]').is("img") ? this.$ele.find('[data-notify="icon"]').attr("src", this.settings.content.icon) : this.$ele.find('[data-notify="icon"]').append('<img src="' + this.settings.content.icon + '" alt="Notify Icon" />')
    }, styleDismiss: function () {
      this.$ele.find('[data-notify="dismiss"]').css({
        position: "absolute",
        right: "10px",
        top: "5px",
        zIndex: this.settings.z_index + 2
      })
    }, styleURL: function () {
      this.$ele.find('[data-notify="url"]').css({
        backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)",
        height: "100%",
        left: 0,
        position: "absolute",
        top: 0,
        width: "100%",
        zIndex: this.settings.z_index + 1
      })
    }, placement: function () {
      var s = this, e = this.settings.offset.y, i = {
        display: "inline-block",
        margin: "0px auto",
        position: this.settings.position ? this.settings.position : "body" === this.settings.element ? "fixed" : "absolute",
        transition: "all .5s ease-in-out",
        zIndex: this.settings.z_index
      }, n = !1, a = this.settings;
      switch (t('[data-notify-position="' + this.settings.placement.from + "-" + this.settings.placement.align + '"]:not([data-closing="true"])').each(function () {
        e = Math.max(e, parseInt(t(this).css(a.placement.from)) + parseInt(t(this).outerHeight()) + parseInt(a.spacing))
      }), this.settings.newest_on_top === !0 && (e = this.settings.offset.y), i[this.settings.placement.from] = e + "px", this.settings.placement.align) {
        case"left":
        case"right":
          i[this.settings.placement.align] = this.settings.offset.x + "px";
          break;
        case"center":
          i.left = 0, i.right = 0
      }
      this.$ele.css(i).addClass(this.settings.animate.enter), t.each(["webkit-", "moz-", "o-", "ms-", ""], function (t, e) {
        s.$ele[0].style[e + "AnimationIterationCount"] = 1
      }), t(this.settings.element).append(this.$ele), this.settings.newest_on_top === !0 && (e = parseInt(e) + parseInt(this.settings.spacing) + this.$ele.outerHeight(), this.reposition(e)), t.isFunction(s.settings.onShow) && s.settings.onShow.call(this.$ele), this.$ele.one(this.animations.start, function () {
        n = !0
      }).one(this.animations.end, function () {
        t.isFunction(s.settings.onShown) && s.settings.onShown.call(this)
      }), setTimeout(function () {
        n || t.isFunction(s.settings.onShown) && s.settings.onShown.call(this)
      }, 600)
    }, bind: function () {
      var s = this;
      if (this.$ele.find('[data-notify="dismiss"]').on("click", function () {
          s.close()
        }), this.$ele.mouseover(function () {
          t(this).data("data-hover", "true")
        }).mouseout(function () {
          t(this).data("data-hover", "false")
        }), this.$ele.data("data-hover", "false"), this.settings.delay > 0) {
        s.$ele.data("notify-delay", s.settings.delay);
        var e = setInterval(function () {
          var t = parseInt(s.$ele.data("notify-delay")) - s.settings.timer;
          if ("false" === s.$ele.data("data-hover") && "pause" === s.settings.mouse_over || "pause" != s.settings.mouse_over) {
            var i = (s.settings.delay - t) / s.settings.delay * 100;
            s.$ele.data("notify-delay", t), s.$ele.find('[data-notify="progressbar"] > div').attr("aria-valuenow", i).css("width", i + "%")
          }
          t > -s.settings.timer || (clearInterval(e), s.close())
        }, s.settings.timer)
      }
    }, close: function () {
      var s = this, e = parseInt(this.$ele.css(this.settings.placement.from)), i = !1;
      this.$ele.data("closing", "true").addClass(this.settings.animate.exit), s.reposition(e), t.isFunction(s.settings.onClose) && s.settings.onClose.call(this.$ele), this.$ele.one(this.animations.start, function () {
        i = !0
      }).one(this.animations.end, function () {
        t(this).remove(), t.isFunction(s.settings.onClosed) && s.settings.onClosed.call(this)
      }), setTimeout(function () {
        i || (s.$ele.remove(), s.settings.onClosed && s.settings.onClosed(s.$ele))
      }, 600)
    }, reposition: function (s) {
      var e = this, i = '[data-notify-position="' + this.settings.placement.from + "-" + this.settings.placement.align + '"]:not([data-closing="true"])', n = this.$ele.nextAll(i);
      this.settings.newest_on_top === !0 && (n = this.$ele.prevAll(i)), n.each(function () {
        t(this).css(e.settings.placement.from, s), s = parseInt(s) + parseInt(e.settings.spacing) + t(this).outerHeight()
      })
    }
  }), t.notify = function (t, s) {
    var i = new e(this, t, s);
    return i.notify
  }, t.notifyDefaults = function (s) {
    return i = t.extend(!0, {}, i, s)
  }, t.notifyClose = function (s) {
    void 0 === s || "all" === s ? t("[data-notify]").find('[data-notify="dismiss"]').trigger("click") : t('[data-notify-position="' + s + '"]').find('[data-notify="dismiss"]').trigger("click")
  }
});

/*
 By Osvaldas Valutis, www.osvaldas.info
 Available for use under the MIT License
 */

;(function (e, t, n, r) {
  "use strict";
  var i = function () {
    var e = n.body || n.documentElement, e = e.style;
    if (e.WebkitTransition == "")return "-webkit-";
    if (e.MozTransition == "")return "-moz-";
    if (e.OTransition == "")return "-o-";
    if (e.transition == "")return "";
    return false
  }, s = i() === false ? false : true, o = function (e, t, n) {
    var r = {}, s = i();
    r[s + "transform"] = "translateX(" + t + ")";
    r[s + "transition"] = s + "transform " + n + "s linear";
    e.css(r)
  }, u = "ontouchstart" in t, a = t.navigator.pointerEnabled || t.navigator.msPointerEnabled, f = function (e) {
    if (u)return true;
    if (!a || typeof e === "undefined" || typeof e.pointerType === "undefined")return false;
    if (typeof e.MSPOINTER_TYPE_MOUSE !== "undefined") {
      if (e.MSPOINTER_TYPE_MOUSE != e.pointerType)return true
    } else if (e.pointerType != "mouse")return true;
    return false
  };
  e.fn.imageLightbox = function (r) {
    var r = e.extend({
      selector: 'id="imagelightbox"',
      allowedTypes: "png|jpg|jpeg|gif",
      animationSpeed: 250,
      preloadNext: true,
      enableKeyboard: true,
      quitOnEnd: false,
      quitOnImgClick: false,
      quitOnDocClick: true,
      onStart: false,
      onEnd: false,
      onLoadStart: false,
      onLoadEnd: false
    }, r), i = e([]), l = e(), c = e(), h = 0, p = 0, d = 0, v = false, m = function (t) {
      return e(t).prop("tagName").toLowerCase() == "a" && (new RegExp(".(" + r.allowedTypes + ")$", "i")).test(e(t).attr("href"))
    }, g = function () {
      if (!c.length)return true;
      var n = e(t).width() * .8, r = e(t).height() * .9, i = new Image;
      i.src = c.attr("src");
      i.onload = function () {
        h = i.width;
        p = i.height;
        if (h > n || p > r) {
          var s = h / p > n / r ? h / n : p / r;
          h /= s;
          p /= s
        }
        c.css({
          width: h + "px",
          height: p + "px",
          top: (e(t).height() - p) / 2 + "px",
          left: (e(t).width() - h) / 2 + "px"
        })
      }
    }, y = function (t) {
      if (v)return false;
      t = typeof t === "undefined" ? false : t == "left" ? 1 : -1;
      if (c.length) {
        if (t !== false && (i.length < 2 || r.quitOnEnd === true && (t === -1 && i.index(l) == 0 || t === 1 && i.index(l) == i.length - 1))) {
          w();
          return false
        }
        var n = {opacity: 0};
        if (s)o(c, 100 * t - d + "px", r.animationSpeed / 1e3); else n.left = parseInt(c.css("left")) + 100 * t + "px";
        c.animate(n, r.animationSpeed, function () {
          b()
        });
        d = 0
      }
      v = true;
      if (r.onLoadStart !== false)r.onLoadStart();
      setTimeout(function () {
        c = e("<img " + r.selector + " />").attr("src", l.attr("href")).load(function () {
          c.appendTo("body");
          g();
          var n = {opacity: 1};
          c.css("opacity", 0);
          if (s) {
            o(c, -100 * t + "px", 0);
            setTimeout(function () {
              o(c, 0 + "px", r.animationSpeed / 1e3)
            }, 50)
          } else {
            var u = parseInt(c.css("left"));
            n.left = u + "px";
            c.css("left", u - 100 * t + "px")
          }
          c.animate(n, r.animationSpeed, function () {
            v = false;
            if (r.onLoadEnd !== false)r.onLoadEnd()
          });
          if (r.preloadNext) {
            var a = i.eq(i.index(l) + 1);
            if (!a.length)a = i.eq(0);
            e("<img />").attr("src", a.attr("href")).load()
          }
        }).error(function () {
          if (r.onLoadEnd !== false)r.onLoadEnd()
        });
        var n = 0, u = 0, p = 0;
        c.on(a ? "pointerup MSPointerUp" : "click", function (e) {
          e.preventDefault();
          if (r.quitOnImgClick) {
            w();
            return false
          }
          if (f(e.originalEvent))return true;
          var t = (e.pageX || e.originalEvent.pageX) - e.target.offsetLeft;
          l = i.eq(i.index(l) - (h / 2 > t ? 1 : -1));
          if (!l.length)l = i.eq(h / 2 > t ? i.length : 0);
          y(h / 2 > t ? "left" : "right")
        }).on("touchstart pointerdown MSPointerDown", function (e) {
          if (!f(e.originalEvent) || r.quitOnImgClick)return true;
          if (s)p = parseInt(c.css("left"));
          n = e.originalEvent.pageX || e.originalEvent.touches[0].pageX
        }).on("touchmove pointermove MSPointerMove", function (e) {
          if (!f(e.originalEvent) || r.quitOnImgClick)return true;
          e.preventDefault();
          u = e.originalEvent.pageX || e.originalEvent.touches[0].pageX;
          d = n - u;
          if (s)o(c, -d + "px", 0); else c.css("left", p - d + "px")
        }).on("touchend touchcancel pointerup pointercancel MSPointerUp MSPointerCancel", function (e) {
          if (!f(e.originalEvent) || r.quitOnImgClick)return true;
          if (Math.abs(d) > 50) {
            l = i.eq(i.index(l) - (d < 0 ? 1 : -1));
            if (!l.length)l = i.eq(d < 0 ? i.length : 0);
            y(d > 0 ? "right" : "left")
          } else {
            if (s)o(c, 0 + "px", r.animationSpeed / 1e3); else c.animate({left: p + "px"}, r.animationSpeed / 2)
          }
        })
      }, r.animationSpeed + 100)
    }, b = function () {
      if (!c.length)return false;
      c.remove();
      c = e()
    }, w = function () {
      if (!c.length)return false;
      c.animate({opacity: 0}, r.animationSpeed, function () {
        b();
        v = false;
        if (r.onEnd !== false)r.onEnd()
      })
    };
    e(t).on("resize", g);
    if (r.quitOnDocClick) {
      e(n).on(u ? "touchend" : "click", function (t) {
        if (c.length && !e(t.target).is(c))w()
      })
    }
    if (r.enableKeyboard) {
      e(n).on("keyup", function (e) {
        if (!c.length)return true;
        e.preventDefault();
        if (e.keyCode == 27)w();
        if (e.keyCode == 37 || e.keyCode == 39) {
          l = i.eq(i.index(l) - (e.keyCode == 37 ? 1 : -1));
          if (!l.length)l = i.eq(e.keyCode == 37 ? i.length : 0);
          y(e.keyCode == 37 ? "left" : "right")
        }
      })
    }
    e(n).on("click", this.selector, function (t) {
      if (!m(this))return true;
      t.preventDefault();
      if (v)return false;
      v = false;
      if (r.onStart !== false)r.onStart();
      l = e(this);
      y()
    });
    this.each(function () {
      if (!m(this))return true;
      i = i.add(e(this))
    });
    this.switchImageLightbox = function (e) {
      var t = i.eq(e);
      if (t.length) {
        var n = i.index(l);
        l = t;
        y(e < n ? "left" : "right")
      }
      return this
    };
    this.quitImageLightbox = function () {
      w();
      return this
    };
    return this
  }
})(jQuery, window, document);

$(function () {
  var activityIndicatorOn = function () {
    $('<div id="imagelightbox-loading"><div></div></div>').appendTo('body')
  }, activityIndicatorOff = function () {
    $('#imagelightbox-loading').remove()
  }, overlayOn = function () {
    $('<div id="imagelightbox-overlay"></div>').appendTo('body')
  }, overlayOff = function () {
    $('#imagelightbox-overlay').remove()
  }, captionOn = function () {
    var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
    if (description.length > 0)$('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body')
  }, captionOff = function () {
    $('#imagelightbox-caption').remove()
  };
  var instanceC = $('a[data-lightbox="c"]').imageLightbox({
    onStart: function () {
      overlayOn()
    }, onEnd: function () {
      overlayOff();
      activityIndicatorOff()
    }, onLoadStart: function () {
      activityIndicatorOn()
    }, onLoadEnd: function () {
      activityIndicatorOff()
    }
  });
  var instanceG = $('a[data-lightbox="g"]').imageLightbox({
    onStart: function () {
      overlayOn()
    }, onEnd: function () {
      captionOff();
      overlayOff();
      activityIndicatorOff()
    }, onLoadStart: function () {
      captionOff();
      activityIndicatorOn()
    }, onLoadEnd: function () {
      captionOff();
      activityIndicatorOff()
    }
  })
});

!function (a, b) {
  function c(a, b, c) {
    return [parseFloat(a[0]) * (n.test(a[0]) ? b / 100 : 1), parseFloat(a[1]) * (n.test(a[1]) ? c / 100 : 1)]
  }

  function d(b, c) {
    return parseInt(a.css(b, c), 10) || 0
  }

  function e(b) {
    var c = b[0];
    return 9 === c.nodeType ? {
      width: b.width(),
      height: b.height(),
      offset: {top: 0, left: 0}
    } : a.isWindow(c) ? {
      width: b.width(),
      height: b.height(),
      offset: {top: b.scrollTop(), left: b.scrollLeft()}
    } : c.preventDefault ? {width: 0, height: 0, offset: {top: c.pageY, left: c.pageX}} : {
      width: b.outerWidth(),
      height: b.outerHeight(),
      offset: b.offset()
    }
  }

  a.ui = a.ui || {};
  var f, g = Math.max, h = Math.abs, i = Math.round, j = /left|center|right/, k = /top|center|bottom/, l = /[\+\-]\d+(\.[\d]+)?%?/, m = /^\w+/, n = /%$/, o = a.fn.pos;
  a.pos = {
    scrollbarWidth: function () {
      if (f !== b)return f;
      var c, d, e = a("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"), g = e.children()[0];
      return a("body").append(e), c = g.offsetWidth, e.css("overflow", "scroll"), d = g.offsetWidth, c === d && (d = e[0].clientWidth), e.remove(), f = c - d
    }, getScrollInfo: function (b) {
      var c = b.isWindow || b.isDocument ? "" : b.element.css("overflow-x"), d = b.isWindow || b.isDocument ? "" : b.element.css("overflow-y"), e = "scroll" === c || "auto" === c && b.width < b.element[0].scrollWidth, f = "scroll" === d || "auto" === d && b.height < b.element[0].scrollHeight;
      return {width: f ? a.pos.scrollbarWidth() : 0, height: e ? a.pos.scrollbarWidth() : 0}
    }, getWithinInfo: function (b) {
      var c = a(b || window), d = a.isWindow(c[0]), e = !!c[0] && 9 === c[0].nodeType;
      return {
        element: c,
        isWindow: d,
        isDocument: e,
        offset: c.offset() || {left: 0, top: 0},
        scrollLeft: c.scrollLeft(),
        scrollTop: c.scrollTop(),
        width: d ? c.width() : c.outerWidth(),
        height: d ? c.height() : c.outerHeight()
      }
    }
  }, a.fn.pos = function (b) {
    if (!b || !b.of)return o.apply(this, arguments);
    b = a.extend({}, b);
    var f, n, p, q, r, s, t = a(b.of), u = a.pos.getWithinInfo(b.within), v = a.pos.getScrollInfo(u), w = (b.collision || "flip").split(" "), x = {};
    return s = e(t), t[0].preventDefault && (b.at = "left top"), n = s.width, p = s.height, q = s.offset, r = a.extend({}, q), a.each(["my", "at"], function () {
      var a, c, d = (b[this] || "").split(" ");
      1 === d.length && (d = j.test(d[0]) ? d.concat(["center"]) : k.test(d[0]) ? ["center"].concat(d) : ["center", "center"]), d[0] = j.test(d[0]) ? d[0] : "center", d[1] = k.test(d[1]) ? d[1] : "center", a = l.exec(d[0]), c = l.exec(d[1]), x[this] = [a ? a[0] : 0, c ? c[0] : 0], b[this] = [m.exec(d[0])[0], m.exec(d[1])[0]]
    }), 1 === w.length && (w[1] = w[0]), "right" === b.at[0] ? r.left += n : "center" === b.at[0] && (r.left += n / 2), "bottom" === b.at[1] ? r.top += p : "center" === b.at[1] && (r.top += p / 2), f = c(x.at, n, p), r.left += f[0], r.top += f[1], this.each(function () {
      var e, j, k = a(this), l = k.outerWidth(), m = k.outerHeight(), o = d(this, "marginLeft"), s = d(this, "marginTop"), y = l + o + d(this, "marginRight") + v.width, z = m + s + d(this, "marginBottom") + v.height, A = a.extend({}, r), B = c(x.my, k.outerWidth(), k.outerHeight());
      "right" === b.my[0] ? A.left -= l : "center" === b.my[0] && (A.left -= l / 2), "bottom" === b.my[1] ? A.top -= m : "center" === b.my[1] && (A.top -= m / 2), A.left += B[0], A.top += B[1], a.support.offsetFractions || (A.left = i(A.left), A.top = i(A.top)), e = {
        marginLeft: o,
        marginTop: s
      }, a.each(["left", "top"], function (c, d) {
        a.ui.pos[w[c]] && a.ui.pos[w[c]][d](A, {
          targetWidth: n,
          targetHeight: p,
          elemWidth: l,
          elemHeight: m,
          collisionPosition: e,
          collisionWidth: y,
          collisionHeight: z,
          offset: [f[0] + B[0], f[1] + B[1]],
          my: b.my,
          at: b.at,
          within: u,
          elem: k
        })
      }), b.using && (j = function (a) {
        var c = q.left - A.left, d = c + n - l, e = q.top - A.top, f = e + p - m, i = {
          target: {
            element: t,
            left: q.left,
            top: q.top,
            width: n,
            height: p
          },
          element: {element: k, left: A.left, top: A.top, width: l, height: m},
          horizontal: 0 > d ? "left" : c > 0 ? "right" : "center",
          vertical: 0 > f ? "top" : e > 0 ? "bottom" : "middle"
        };
        l > n && h(c + d) < n && (i.horizontal = "center"), m > p && h(e + f) < p && (i.vertical = "middle"), i.important = g(h(c), h(d)) > g(h(e), h(f)) ? "horizontal" : "vertical", b.using.call(this, a, i)
      }), k.offset(a.extend(A, {using: j}))
    })
  }, a.ui.pos = {
    _trigger: function (a, b, c, d) {
      b.elem && b.elem.trigger({type: c, position: a, positionData: b, triggered: d})
    }, fit: {
      left: function (b, c) {
        a.ui.pos._trigger(b, c, "posCollide", "fitLeft");
        var d, e = c.within, f = e.isWindow ? e.scrollLeft : e.offset.left, h = e.width, i = b.left - c.collisionPosition.marginLeft, j = f - i, k = i + c.collisionWidth - h - f;
        c.collisionWidth > h ? j > 0 && 0 >= k ? (d = b.left + j + c.collisionWidth - h - f, b.left += j - d) : b.left = k > 0 && 0 >= j ? f : j > k ? f + h - c.collisionWidth : f : j > 0 ? b.left += j : k > 0 ? b.left -= k : b.left = g(b.left - i, b.left), a.ui.pos._trigger(b, c, "posCollided", "fitLeft")
      }, top: function (b, c) {
        a.ui.pos._trigger(b, c, "posCollide", "fitTop");
        var d, e = c.within, f = e.isWindow ? e.scrollTop : e.offset.top, h = c.within.height, i = b.top - c.collisionPosition.marginTop, j = f - i, k = i + c.collisionHeight - h - f;
        c.collisionHeight > h ? j > 0 && 0 >= k ? (d = b.top + j + c.collisionHeight - h - f, b.top += j - d) : b.top = k > 0 && 0 >= j ? f : j > k ? f + h - c.collisionHeight : f : j > 0 ? b.top += j : k > 0 ? b.top -= k : b.top = g(b.top - i, b.top), a.ui.pos._trigger(b, c, "posCollided", "fitTop")
      }
    }, flip: {
      left: function (b, c) {
        a.ui.pos._trigger(b, c, "posCollide", "flipLeft");
        var d, e, f = c.within, g = f.offset.left + f.scrollLeft, i = f.width, j = f.isWindow ? f.scrollLeft : f.offset.left, k = b.left - c.collisionPosition.marginLeft, l = k - j, m = k + c.collisionWidth - i - j, n = "left" === c.my[0] ? -c.elemWidth : "right" === c.my[0] ? c.elemWidth : 0, o = "left" === c.at[0] ? c.targetWidth : "right" === c.at[0] ? -c.targetWidth : 0, p = -2 * c.offset[0];
        0 > l ? (d = b.left + n + o + p + c.collisionWidth - i - g, (0 > d || d < h(l)) && (b.left += n + o + p)) : m > 0 && (e = b.left - c.collisionPosition.marginLeft + n + o + p - j, (e > 0 || h(e) < m) && (b.left += n + o + p)), a.ui.pos._trigger(b, c, "posCollided", "flipLeft")
      }, top: function (b, c) {
        a.ui.pos._trigger(b, c, "posCollide", "flipTop");
        var d, e, f = c.within, g = f.offset.top + f.scrollTop, i = f.height, j = f.isWindow ? f.scrollTop : f.offset.top, k = b.top - c.collisionPosition.marginTop, l = k - j, m = k + c.collisionHeight - i - j, n = "top" === c.my[1], o = n ? -c.elemHeight : "bottom" === c.my[1] ? c.elemHeight : 0, p = "top" === c.at[1] ? c.targetHeight : "bottom" === c.at[1] ? -c.targetHeight : 0, q = -2 * c.offset[1];
        0 > l ? (e = b.top + o + p + q + c.collisionHeight - i - g, b.top + o + p + q > l && (0 > e || e < h(l)) && (b.top += o + p + q)) : m > 0 && (d = b.top - c.collisionPosition.marginTop + o + p + q - j, b.top + o + p + q > m && (d > 0 || h(d) < m) && (b.top += o + p + q)), a.ui.pos._trigger(b, c, "posCollided", "flipTop")
      }
    }, flipfit: {
      left: function () {
        a.ui.pos.flip.left.apply(this, arguments), a.ui.pos.fit.left.apply(this, arguments)
      }, top: function () {
        a.ui.pos.flip.top.apply(this, arguments), a.ui.pos.fit.top.apply(this, arguments)
      }
    }
  }, function () {
    var b, c, d, e, f, g = document.getElementsByTagName("body")[0], h = document.createElement("div");
    b = document.createElement(g ? "div" : "body"), d = {
      visibility: "hidden",
      width: 0,
      height: 0,
      border: 0,
      margin: 0,
      background: "none"
    }, g && a.extend(d, {position: "absolute", left: "-1000px", top: "-1000px"});
    for (f in d)b.style[f] = d[f];
    b.appendChild(h), c = g || document.documentElement, c.insertBefore(b, c.firstChild), h.style.cssText = "position: absolute; left: 10.7432222px;", e = a(h).offset().left, a.support.offsetFractions = e > 10 && 11 > e, b.innerHTML = "", c.removeChild(b)
  }()
}(jQuery), function (a) {
  "use strict";
  "function" == typeof define && define.amd ? define(["jquery"], a) : window.jQuery && !window.jQuery.fn.iconpicker && a(window.jQuery)
}(function (a) {
  "use strict";
  var b = {
    isEmpty: function (a) {
      return a === !1 || "" === a || null === a || void 0 === a
    }, isEmptyObject: function (a) {
      return this.isEmpty(a) === !0 || 0 === a.length
    }, isElement: function (b) {
      return a(b).length > 0
    }, isString: function (a) {
      return "string" == typeof a || a instanceof String
    }, isArray: function (b) {
      return a.isArray(b)
    }, inArray: function (b, c) {
      return -1 !== a.inArray(b, c)
    }, throwError: function (a) {
      throw"Font Awesome Icon Picker Exception: " + a
    }
  }, c = function (d, e) {
    this._id = c._idCounter++, this.element = a(d).addClass("iconpicker-element"), this._trigger("iconpickerCreate"), this.options = a.extend({}, c.defaultOptions, this.element.data(), e), this.options.templates = a.extend({}, c.defaultOptions.templates, this.options.templates), this.options.originalPlacement = this.options.placement, this.container = b.isElement(this.options.container) ? a(this.options.container) : !1, this.container === !1 && (this.container = this.element.is("input") ? this.element.parent() : this.element), this.container.addClass("iconpicker-container").is(".dropdown-menu") && (this.options.placement = "inline"), this.input = this.element.is("input") ? this.element.addClass("iconpicker-input") : !1, this.input === !1 && (this.input = this.container.find(this.options.input)), this.component = this.container.find(this.options.component).addClass("iconpicker-component"), 0 === this.component.length ? this.component = !1 : this.component.find("i").addClass(this.options.iconComponentBaseClass), this._createPopover(), this._createIconpicker(), 0 === this.getAcceptButton().length && (this.options.mustAccept = !1), this.container.is(".input-group") ? this.container.parent().append(this.popover) : this.container.append(this.popover), this._bindElementEvents(), this._bindWindowEvents(), this.update(this.options.selected), this.isInline() && this.show(), this._trigger("iconpickerCreated")
  };
  c._idCounter = 0, c.defaultOptions = {
    title: !1,
    selected: !1,
    defaultValue: !1,
    placement: "bottom",
    collision: "none",
    animation: !0,
    hideOnSelect: !1,
    showFooter: !1,
    searchInFooter: !1,
    mustAccept: !1,
    selectedCustomClass: "bg-primary",
    icons: [],
    iconBaseClass: "fa",
    iconComponentBaseClass: "fa fa-fw",
    iconClassPrefix: "fa-",
    input: "input",
    component: ".input-group-addon",
    container: !1,
    templates: {
      popover: '<div class="iconpicker-popover popover"><div class="arrow"></div><div class="popover-title"></div><div class="popover-content"></div></div>',
      footer: '<div class="popover-footer"></div>',
      buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button> <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
      search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
      iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
      iconpickerItem: '<div class="iconpicker-item"><i></i></div>'
    }
  }, c.batch = function (b, c) {
    var d = Array.prototype.slice.call(arguments, 2);
    return a(b).each(function () {
      var b = a(this).data("iconpicker");
      b && b[c].apply(b, d)
    })
  }, c.prototype = {
    constructor: c, options: {}, _id: 0, _trigger: function (b, c) {
      c = c || {}, this.element.trigger(a.extend({type: b, iconpickerInstance: this}, c))
    }, _createPopover: function () {
      this.popover = a(this.options.templates.popover);
      var c = this.popover.find(".popover-title");
      if (this.options.title && c.append(a('<div class="popover-title-text">' + this.options.title + "</div>")), this.options.searchInFooter || b.isEmpty(this.options.templates.buttons) ? this.options.title || c.remove() : c.append(this.options.templates.search), this.options.showFooter && !b.isEmpty(this.options.templates.footer)) {
        var d = a(this.options.templates.footer);
        !b.isEmpty(this.options.templates.search) && this.options.searchInFooter && d.append(a(this.options.templates.search)), b.isEmpty(this.options.templates.buttons) || d.append(a(this.options.templates.buttons)), this.popover.append(d)
      }
      return this.options.animation === !0 && this.popover.addClass("fade"), this.popover
    }, _createIconpicker: function () {
      var b = this;
      this.iconpicker = a(this.options.templates.iconpicker);
      var c = function () {
        var c = a(this);
        c.is("." + b.options.iconBaseClass) && (c = c.parent()), b._trigger("iconpickerSelect", {
          iconpickerItem: c,
          iconpickerValue: b.iconpickerValue
        }), b.options.mustAccept === !1 ? (b.update(c.data("iconpickerValue")), b._trigger("iconpickerSelected", {
          iconpickerItem: this,
          iconpickerValue: b.iconpickerValue
        })) : b.update(c.data("iconpickerValue"), !0), b.options.hideOnSelect && b.options.mustAccept === !1 && b.hide()
      };
      for (var d in this.options.icons) {
        var e = a(this.options.templates.iconpickerItem);
        e.find("i").addClass(b.options.iconBaseClass + " " + this.options.iconClassPrefix + this.options.icons[d]), e.data("iconpickerValue", this.options.icons[d]).on("click.iconpicker", c), this.iconpicker.find(".iconpicker-items").append(e.attr("title", "." + this.getValue(this.options.icons[d])))
      }
      return this.popover.find(".popover-content").append(this.iconpicker), this.iconpicker
    }, _isEventInsideIconpicker: function (b) {
      var c = a(b.target);
      return c.hasClass("iconpicker-element") && (!c.hasClass("iconpicker-element") || c.is(this.element)) || 0 !== c.parents(".iconpicker-popover").length ? !0 : !1
    }, _bindElementEvents: function () {
      var c = this;
      this.getSearchInput().on("keyup", function () {
        c.filter(a(this).val().toLowerCase())
      }), this.getAcceptButton().on("click.iconpicker", function () {
        var a = c.iconpicker.find(".iconpicker-selected").get(0);
        c.update(c.iconpickerValue), c._trigger("iconpickerSelected", {
          iconpickerItem: a,
          iconpickerValue: c.iconpickerValue
        }), c.isInline() || c.hide()
      }), this.getCancelButton().on("click.iconpicker", function () {
        c.isInline() || c.hide()
      }), this.element.on("focus.iconpicker", function (a) {
        c.show(), a.stopPropagation()
      }), this.hasComponent() && this.component.on("click.iconpicker", function () {
        c.toggle()
      }), this.hasInput() && this.input.on("keyup.iconpicker", function (a) {
        b.inArray(a.keyCode, [38, 40, 37, 39, 16, 17, 18, 9, 8, 91, 93, 20, 46, 186, 190, 46, 78, 188, 44, 86]) ? c._updateFormGroupStatus(c.getValid(this.value) !== !1) : c.update()
      })
    }, _bindWindowEvents: function () {
      var b = a(window.document), c = this, d = ".iconpicker.inst" + this._id;
      return a(window).on("resize.iconpicker" + d + " orientationchange.iconpicker" + d, function () {
        c.popover.hasClass("in") && c.updatePlacement()
      }), c.isInline() || b.on("mouseup" + d, function (a) {
        return c._isEventInsideIconpicker(a) || c.isInline() || c.hide(), a.stopPropagation(), a.preventDefault(), !1
      }), !1
    }, _unbindElementEvents: function () {
      this.popover.off(".iconpicker"), this.element.off(".iconpicker"), this.hasInput() && this.input.off(".iconpicker"), this.hasComponent() && this.component.off(".iconpicker"), this.hasContainer() && this.container.off(".iconpicker")
    }, _unbindWindowEvents: function () {
      a(window).off(".iconpicker.inst" + this._id), a(window.document).off(".iconpicker.inst" + this._id)
    }, updatePlacement: function (b, c) {
      b = b || this.options.placement, this.options.placement = b, c = c || this.options.collision, c = c === !0 ? "flip" : c;
      var d = {
        at: "right bottom",
        my: "right top",
        of: this.hasInput() ? this.input : this.container,
        collision: c === !0 ? "flip" : c,
        within: window
      };
      if (this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner rightTop right rightBottom bottomRight bottomRightCorner bottom bottomLeft bottomLeftCorner leftBottom left leftTop"), "object" == typeof b)return this.popover.pos(a.extend({}, d, b));
      switch (b) {
        case"inline":
          d = !1;
          break;
        case"topLeftCorner":
          d.my = "right bottom", d.at = "left top";
          break;
        case"topLeft":
          d.my = "left bottom", d.at = "left top";
          break;
        case"top":
          d.my = "center bottom", d.at = "center top";
          break;
        case"topRight":
          d.my = "right bottom", d.at = "right top";
          break;
        case"topRightCorner":
          d.my = "left bottom", d.at = "right top";
          break;
        case"rightTop":
          d.my = "left bottom", d.at = "right center";
          break;
        case"right":
          d.my = "left center", d.at = "right center";
          break;
        case"rightBottom":
          d.my = "left top", d.at = "right center";
          break;
        case"bottomRightCorner":
          d.my = "left top", d.at = "right bottom";
          break;
        case"bottomRight":
          d.my = "right top", d.at = "right bottom";
          break;
        case"bottom":
          d.my = "center top", d.at = "center bottom";
          break;
        case"bottomLeft":
          d.my = "left top", d.at = "left bottom";
          break;
        case"bottomLeftCorner":
          d.my = "right top", d.at = "left bottom";
          break;
        case"leftBottom":
          d.my = "right top", d.at = "left center";
          break;
        case"left":
          d.my = "right center", d.at = "left center";
          break;
        case"leftTop":
          d.my = "right bottom", d.at = "left center";
          break;
        default:
          return !1
      }
      return this.popover.css({display: "inline" === this.options.placement ? "" : "block"}), d !== !1 ? this.popover.pos(d).css("maxWidth", a(window).width() - this.container.offset().left - 5) : this.popover.css({
        top: "auto",
        right: "auto",
        bottom: "auto",
        left: "auto",
        maxWidth: "none"
      }), this.popover.addClass(this.options.placement), !0
    }, _updateComponents: function () {
      if (this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected " + this.options.selectedCustomClass), this.iconpicker.find("." + this.options.iconBaseClass + "." + this.options.iconClassPrefix + this.iconpickerValue).parent().addClass("iconpicker-selected " + this.options.selectedCustomClass), this.hasComponent()) {
        var a = this.component.find("i");
        a.length > 0 ? a.attr("class", this.options.iconComponentBaseClass + " " + this.getValue()) : this.component.html(this.getValueHtml())
      }
    }, _updateFormGroupStatus: function (a) {
      return this.hasInput() ? (a !== !1 ? this.input.parents(".form-group:first").removeClass("has-error") : this.input.parents(".form-group:first").addClass("has-error"), !0) : !1
    }, getValid: function (c) {
      b.isString(c) || (c = "");
      var d = "" === c;
      return c = a.trim(c.replace(this.options.iconClassPrefix, "")), b.inArray(c, this.options.icons) || d ? c : !1
    }, setValue: function (a) {
      var b = this.getValid(a);
      return b !== !1 ? (this.iconpickerValue = b, this._trigger("iconpickerSetValue", {iconpickerValue: b}), this.iconpickerValue) : (this._trigger("iconpickerInvalid", {iconpickerValue: a}), !1)
    }, getValue: function (a) {
      return this.options.iconClassPrefix + (a ? a : this.iconpickerValue)
    }, getValueHtml: function () {
      return '<i class="' + this.options.iconBaseClass + " " + this.getValue() + '"></i>'
    }, setSourceValue: function (a) {
      return a = this.setValue(a), a !== !1 && "" !== a && (this.hasInput() ? this.input.val(this.getValue()) : this.element.data("iconpickerValue", this.getValue()), this._trigger("iconpickerSetSourceValue", {iconpickerValue: a})), a
    }, getSourceValue: function (a) {
      a = a || this.options.defaultValue;
      var b = a;
      return b = this.hasInput() ? this.input.val() : this.element.data("iconpickerValue"), (void 0 === b || "" === b || null === b || b === !1) && (b = a), b
    }, hasInput: function () {
      return this.input !== !1
    }, hasComponent: function () {
      return this.component !== !1
    }, hasContainer: function () {
      return this.container !== !1
    }, getAcceptButton: function () {
      return this.popover.find(".iconpicker-btn-accept")
    }, getCancelButton: function () {
      return this.popover.find(".iconpicker-btn-cancel")
    }, getSearchInput: function () {
      return this.popover.find(".iconpicker-search")
    }, filter: function (c) {
      if (b.isEmpty(c))return this.iconpicker.find(".iconpicker-item").show(), a(!1);
      var d = [];
      return this.iconpicker.find(".iconpicker-item").each(function () {
        var b = a(this), e = b.attr("title").toLowerCase(), f = !1;
        try {
          f = new RegExp(c, "g")
        } catch (g) {
          f = !1
        }
        f !== !1 && e.match(f) ? (d.push(b), b.show()) : b.hide()
      }), d
    }, show: function () {
      return this.popover.hasClass("in") ? !1 : (a.iconpicker.batch(a(".iconpicker-popover.in:not(.inline)").not(this.popover), "hide"), this._trigger("iconpickerShow"), this.updatePlacement(), this.popover.addClass("in"), void setTimeout(a.proxy(function () {
        this.popover.css("display", this.isInline() ? "" : "block"), this._trigger("iconpickerShown")
      }, this), this.options.animation ? 300 : 1))
    }, hide: function () {
      return this.popover.hasClass("in") ? (this._trigger("iconpickerHide"), this.popover.removeClass("in"), void setTimeout(a.proxy(function () {
        this.popover.css("display", "none"), this.getSearchInput().val(""), this.filter(""), this._trigger("iconpickerHidden")
      }, this), this.options.animation ? 300 : 1)) : !1
    }, toggle: function () {
      this.popover.is(":visible") ? this.hide() : this.show(!0)
    }, update: function (a, b) {
      return a = a ? a : this.getSourceValue(this.iconpickerValue), this._trigger("iconpickerUpdate"), b === !0 ? a = this.setValue(a) : (a = this.setSourceValue(a), this._updateFormGroupStatus(a !== !1)), a !== !1 && this._updateComponents(), this._trigger("iconpickerUpdated"), a
    }, destroy: function () {
      this._trigger("iconpickerDestroy"), this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element"), this._unbindElementEvents(), this._unbindWindowEvents(), a(this.popover).remove(), this._trigger("iconpickerDestroyed")
    }, disable: function () {
      return this.hasInput() ? (this.input.prop("disabled", !0), !0) : !1
    }, enable: function () {
      return this.hasInput() ? (this.input.prop("disabled", !1), !0) : !1
    }, isDisabled: function () {
      return this.hasInput() ? this.input.prop("disabled") === !0 : !1
    }, isInline: function () {
      return "inline" === this.options.placement || this.popover.hasClass("inline")
    }
  }, a.iconpicker = c, a.fn.iconpicker = function (b) {
    return this.each(function () {
      var d = a(this);
      d.data("iconpicker") || d.data("iconpicker", new c(this, "object" == typeof b ? b : {}))
    })
  }, c.defaultOptions.icons = ["edge", "modx", "product-hunt", "shopping-basket", "bluetooth-b", "fort-awesome", "pause-circle", "reddit-alien", "stop-circle", "codiepie", "hashtag", "pause-circle-o", "scribd", "stop-circle-o", "credit-card-alt", "mixcloud", "percent", "shopping-bag", "usb", "bluetooth", "500px", "amazon", "balance-scale", "battery-0", "battery-1", "battery-2", "battery-3", "battery-4", "battery-empty", "battery-full", "battery-half", "battery-quarter", "battery-three-quarters", "black-tie", "calendar-check-o", "calendar-minus-o", "calendar-plus-o", "calendar-times-o", "cc-diners-club", "cc-jcb", "chrome", "clone", "commenting", "commenting-o", "contao", "creative-commons", "expeditedssl", "firefox", "fonticons", "get-pocket", "gg", "gg-circle", "hand-grab-o", "hand-lizard-o", "hand-paper-o", "hand-peace-o", "hand-pointer-o", "hand-rock-o", "hand-scissors-o", "hand-spock-o", "hand-stop-o", "hourglass", "hourglass-1", "hourglass-2", "hourglass-3", "hourglass-end", "hourglass-half", "hourglass-o", "hourglass-start", "houzz", "i-cursor", "industry", "internet-explorer", "map", "map-o", "map-pin", "map-signs", "mouse-pointer", "object-group", "object-ungroup", "odnoklassniki", "odnoklassniki-square", "opencart", "opera", "optin-monster", "registered", "safari", "sticky-note", "sticky-note-o", "television", "trademark", "tripadvisor", "tv", "vimeo", "wikipedia-w", "y-combinator", "yc", "glass", "music", "search", "envelope-o", "heart", "star", "star-o", "user", "film", "th-large", "th", "th-list", "check", "remove", "close", "times", "search-plus", "search-minus", "power-off", "signal", "gear", "cog", "trash-o", "home", "file-o", "clock-o", "road", "download", "arrow-circle-o-down", "arrow-circle-o-up", "inbox", "play-circle-o", "rotate-right", "repeat", "refresh", "list-alt", "lock", "flag", "headphones", "volume-off", "volume-down", "volume-up", "qrcode", "barcode", "tag", "tags", "book", "bookmark", "print", "camera", "font", "bold", "italic", "text-height", "text-width", "align-left", "align-center", "align-right", "align-justify", "list", "dedent", "outdent", "indent", "video-camera", "photo", "image", "picture-o", "pencil", "map-marker", "adjust", "tint", "edit", "pencil-square-o", "share-square-o", "check-square-o", "arrows", "step-backward", "fast-backward", "backward", "play", "pause", "stop", "forward", "fast-forward", "step-forward", "eject", "chevron-left", "chevron-right", "plus-circle", "minus-circle", "times-circle", "check-circle", "question-circle", "info-circle", "crosshairs", "times-circle-o", "check-circle-o", "ban", "arrow-left", "arrow-right", "arrow-up", "arrow-down", "mail-forward", "share", "expand", "compress", "plus", "minus", "asterisk", "exclamation-circle", "gift", "leaf", "fire", "eye", "eye-slash", "warning", "exclamation-triangle", "plane", "calendar", "random", "comment", "magnet", "chevron-up", "chevron-down", "retweet", "shopping-cart", "folder", "folder-open", "arrows-v", "arrows-h", "bar-chart-o", "bar-chart", "twitter-square", "facebook-square", "camera-retro", "key", "gears", "cogs", "comments", "thumbs-o-up", "thumbs-o-down", "star-half", "heart-o", "sign-out", "linkedin-square", "thumb-tack", "external-link", "sign-in", "trophy", "github-square", "upload", "lemon-o", "phone", "square-o", "bookmark-o", "phone-square", "twitter", "facebook-f", "facebook", "github", "unlock", "credit-card", "rss", "hdd-o", "bullhorn", "bell", "certificate", "hand-o-right", "hand-o-left", "hand-o-up", "hand-o-down", "arrow-circle-left", "arrow-circle-right", "arrow-circle-up", "arrow-circle-down", "globe", "wrench", "tasks", "filter", "briefcase", "arrows-alt", "group", "users", "chain", "link", "cloud", "flask", "cut", "scissors", "copy", "files-o", "paperclip", "save", "floppy-o", "square", "navicon", "reorder", "bars", "list-ul", "list-ol", "strikethrough", "underline", "table", "magic", "truck", "pinterest", "pinterest-square", "google-plus-square", "google-plus", "money", "caret-down", "caret-up", "caret-left", "caret-right", "columns", "unsorted", "sort", "sort-down", "sort-desc", "sort-up", "sort-asc", "envelope", "linkedin", "rotate-left", "undo", "legal", "gavel", "dashboard", "tachometer", "comment-o", "comments-o", "flash", "bolt", "sitemap", "umbrella", "paste", "clipboard", "lightbulb-o", "exchange", "cloud-download", "cloud-upload", "user-md", "stethoscope", "suitcase", "bell-o", "coffee", "cutlery", "file-text-o", "building-o", "hospital-o", "ambulance", "medkit", "fighter-jet", "beer", "h-square", "plus-square", "angle-double-left", "angle-double-right", "angle-double-up", "angle-double-down", "angle-left", "angle-right", "angle-up", "angle-down", "desktop", "laptop", "tablet", "mobile-phone", "mobile", "circle-o", "quote-left", "quote-right", "spinner", "circle", "mail-reply", "reply", "github-alt", "folder-o", "folder-open-o", "smile-o", "frown-o", "meh-o", "gamepad", "keyboard-o", "flag-o", "flag-checkered", "terminal", "code", "mail-reply-all", "reply-all", "star-half-empty", "star-half-full", "star-half-o", "location-arrow", "crop", "code-fork", "unlink", "chain-broken", "question", "info", "exclamation", "superscript", "subscript", "eraser", "puzzle-piece", "microphone", "microphone-slash", "shield", "calendar-o", "fire-extinguisher", "rocket", "maxcdn", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-circle-down", "html5", "css3", "anchor", "unlock-alt", "bullseye", "ellipsis-h", "ellipsis-v", "rss-square", "play-circle", "ticket", "minus-square", "minus-square-o", "level-up", "level-down", "check-square", "pencil-square", "external-link-square", "share-square", "compass", "toggle-down", "caret-square-o-down", "toggle-up", "caret-square-o-up", "toggle-right", "caret-square-o-right", "euro", "eur", "gbp", "dollar", "usd", "rupee", "inr", "cny", "rmb", "yen", "jpy", "ruble", "rouble", "rub", "won", "krw", "bitcoin", "btc", "file", "file-text", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-numeric-asc", "sort-numeric-desc", "thumbs-up", "thumbs-down", "youtube-square", "youtube", "xing", "xing-square", "youtube-play", "dropbox", "stack-overflow", "instagram", "flickr", "adn", "bitbucket", "bitbucket-square", "tumblr", "tumblr-square", "long-arrow-down", "long-arrow-up", "long-arrow-left", "long-arrow-right", "apple", "windows", "android", "linux", "dribbble", "skype", "foursquare", "trello", "female", "male", "gittip", "gratipay", "sun-o", "moon-o", "archive", "bug", "vk", "weibo", "renren", "pagelines", "stack-exchange", "arrow-circle-o-right", "arrow-circle-o-left", "toggle-left", "caret-square-o-left", "dot-circle-o", "wheelchair", "vimeo-square", "turkish-lira", "try", "plus-square-o", "space-shuttle", "slack", "envelope-square", "wordpress", "openid", "institution", "bank", "university", "mortar-board", "graduation-cap", "yahoo", "google", "reddit", "reddit-square", "stumbleupon-circle", "stumbleupon", "delicious", "digg", "pied-piper", "pied-piper-alt", "drupal", "joomla", "language", "fax", "building", "child", "paw", "spoon", "cube", "cubes", "behance", "behance-square", "steam", "steam-square", "recycle", "automobile", "car", "cab", "taxi", "tree", "spotify", "deviantart", "soundcloud", "database", "file-pdf-o", "file-word-o", "file-excel-o", "file-powerpoint-o", "file-photo-o", "file-picture-o", "file-image-o", "file-zip-o", "file-archive-o", "file-sound-o", "file-audio-o", "file-movie-o", "file-video-o", "file-code-o", "vine", "codepen", "jsfiddle", "life-bouy", "life-buoy", "life-saver", "support", "life-ring", "circle-o-notch", "ra", "rebel", "ge", "empire", "git-square", "git", "hacker-news", "tencent-weibo", "qq", "wechat", "weixin", "send", "paper-plane", "send-o", "paper-plane-o", "history", "genderless", "circle-thin", "header", "paragraph", "sliders", "share-alt", "share-alt-square", "bomb", "soccer-ball-o", "futbol-o", "tty", "binoculars", "plug", "slideshare", "twitch", "yelp", "newspaper-o", "wifi", "calculator", "paypal", "google-wallet", "cc-visa", "cc-mastercard", "cc-discover", "cc-amex", "cc-paypal", "cc-stripe", "bell-slash", "bell-slash-o", "trash", "copyright", "at", "eyedropper", "paint-brush", "birthday-cake", "area-chart", "pie-chart", "line-chart", "lastfm", "lastfm-square", "toggle-off", "toggle-on", "bicycle", "bus", "ioxhost", "angellist", "cc", "shekel", "sheqel", "ils", "meanpath", "buysellads", "connectdevelop", "dashcube", "forumbee", "leanpub", "sellsy", "shirtsinbulk", "simplybuilt", "skyatlas", "cart-plus", "cart-arrow-down", "diamond", "ship", "user-secret", "motorcycle", "street-view", "heartbeat", "venus", "mars", "mercury", "transgender", "transgender-alt", "venus-double", "mars-double", "venus-mars", "mars-stroke", "mars-stroke-v", "mars-stroke-h", "neuter", "facebook-official", "pinterest-p", "whatsapp", "server", "user-plus", "user-times", "hotel", "bed", "viacoin", "train", "subway", "medium"]
});

/**
 * jQuery.share - social media sharing plugin
 * ---
 * @author Carol Skelly (http://in1.com)
 * @version 1.0
 * @license MIT license (http://opensource.org/licenses/mit-license.php)
 * ---
 */
(function ($) {
  var document = window.document;
  $.fn.share = function (method) {
    var methods = {
      init: function (options) {
        this.share.settings = $.extend({}, this.share.defaults, options);
        var networks = this.share.settings.networks, orientation = this.share.settings.orientation, affix = this.share.settings.affix, margin = this.share.settings.margin, pageTitle = this.share.settings.title || $(document).attr('title'), pageUrl = this.share.settings.urlToShare || $(location).attr('href');
        return this.each(function () {
          var $element = $(this), id = $element.attr("id"), u = encodeURIComponent(pageUrl), t = encodeURIComponent(pageTitle), href;
          for (var item in networks) {
            item = networks[item];
            href = helpers.networkDefs[item].url;
            href = href.replace('|u|', u).replace('|t|', t).replace('|140|', t.substring(0, 130));
            if (item == "email") {
              $("<a href='" + href + "' title='Share this page on " + item + "' class='share-icon share-icon-" + item + "'></a>").appendTo($element)
            } else {
              $("<a href='" + href + "' title='Share this page on " + item + "' class='pop share-icon share-icon-" + item + "'></a>").appendTo($element)
            }
          }
          $("#" + id + ".share-icon").css('margin', margin);
          $("#" + id + " a.share-icon").css('display', 'inline-block');
          if (typeof affix != "undefined") {
            $element.addClass('share-affix');
            if (affix.indexOf('right') != -1) {
              $element.css('left', 'auto');
              $element.css('right', '0px');
              if (affix.indexOf('center') != -1) {
                $element.css('top', '40%')
              }
            } else if (affix.indexOf('left center') != -1) {
              $element.css('top', '40%')
            }
            if (affix.indexOf('bottom') != -1) {
              $element.css('bottom', '0px');
              $element.css('top', 'auto');
              if (affix.indexOf('center') != -1) {
                $element.css('left', '40%')
              }
            }
          }
          $('.pop').click(function () {
            window.open($(this).attr('href'), 't', 'toolbar=0,resizable=1,status=0,width=640,height=528');
            return false
          })
        })
      }
    };
    var helpers = {
      networkDefs: {
        tumblr: {url: 'http://www.tumblr.com/share?v=3&u=|u|'},
        facebook: {url: 'http://www.facebook.com/share.php?u=|u|'},
        twitter: {url: 'https://twitter.com/share?url=|u|&text=|140|'},
        googleplus: {url: 'https://plusone.google.com/_/+1/confirm?hl=en&url=|u|'},
        pinterest: {url: 'http://pinterest.com/pin/create/button/?url=|u|'},
        email: {url: 'mailto:?subject=|t|&body=|u|'}
      }
    };
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1))
    } else if (typeof method === 'object' || !method) {
      return methods.init.apply(this, arguments)
    } else {
      $.error('Method "' + method + '" does not exist in social plugin')
    }
  };
  $.fn.share.defaults = {
    networks: ['tumblr', 'facebook', 'twitter', 'googleplus', 'pinterest', 'email'],
    autoShow: true,
    margin: '3px'
  };
  $.fn.share.settings = {}
})(jQuery);