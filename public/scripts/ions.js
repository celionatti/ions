$(document).ready(function () {
  // Select all <a> tags and add a click event listener
  $("a").on("click", function (event) {
    if ($(this).data("link") !== undefined) {
      event.preventDefault(); // Prevent the default link behavior

      var url = $(this).attr("href"); // Get the href attribute of the clicked link
      
      if ($(this).data("link") === "page") {
        ajaxRequest(url, function (response) {
          // Handle the response here (e.g., update the page content)
          // Replace the entire page content with the response HTML
          document.open();
          document.write(response);
          document.close();
        });
      } else {
        var linkId = $(this).data("link");
        alert(linkId)
        ajaxRequest(url, function (response) {
          // Update the content of the specified element with the rendered view HTML
          $("#ions-content-" + linkId).html(response.html);
        });
      }
    }
  });

  // GET AjaxRequest
  function ajaxRequest(url, callback) {
    $.ajax({
      url: url,
      method: "GET", // Change to POST or other method if needed
      success: function (response) {
        callback(response);
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
      },
    });
  }
});
