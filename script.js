$(document).ready(function () {
  // упр 1, 2
  $("#ex1, #ex2").click(function () {
    $.ajax({
      url: "index.php",
      type: "GET",
      data: { buttonId: $(this).attr("id") },
      success: function (response) {
        $("#output").html(response);
      },
    });
  });

  // упр 3
  $("#ex3").click(function () {
    let search = prompt("Введите строку для поиска:");
    if (search) {
      search = search.trim();
      if (search) {
        $.ajax({
          url: "index.php",
          type: "GET",
          data: { buttonId: $(this).attr("id"), userSearch: search },
          success: function (response) {
            $("#output").html(response);
          },
        });
      }
    }
  });
});
