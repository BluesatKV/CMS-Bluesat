<script type="text/javascript">
  $(document).ready(function () {
    $("#editfile1").click(function (event) {
      event.preventDefault();
      $('#jak_file1, button[name="save1"]').removeAttr("disabled");
      $('button[name="reset1"]').removeClass("hidden");
      $(this).addClass("hidden");

      var txt = $("#jak_file1");
      var time = new Date();

      if (txt.val().indexOf('CMS Robots File' && 'Last change') != -1) { // Value in txt = true
        var lines = $('#jak_file1').val().split(/\n/);
        lines[1] = "#Last change - " + time;
        $("#jak_file1").html(lines.join("\n"));

      } else {

        txt.val("#CMS Robots File\n#Last change - " + time + "\n\n" + txt.val());
      }
    });
  });
</script>