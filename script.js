$(document).ready(function () {
  // упр 1
  $("button").click(function () {
    $.ajax({
      url: "index.php",
      type: "POST",
      data: { buttonId: $(this).attr("id") },
      success: function(response) {
        $("#output").html(response);
      }
    });
  });
});
