$(document).ready(function () {
  // Select all <a> tags and add a click event listener
  $("a").on("click", function (event) {
    event.preventDefault(); // Prevent the default link behavior

    var url = $(this).attr("href"); // Get the href attribute of the clicked link

    // Determine if we want the whole page or just a content fragment
    var requestType = ($(this).data('request-type') === 'page') ? 'page' : 'fragment';
    // Perform the AJAX request and handle the response
    ajaxRequest(url, requestType, function (response) {
      // Handle the response here (e.g., update the page content)
      if (requestType === 'page') {
        // Replace the entire page content with the response HTML
        document.open();
        document.write(response);
        document.close();
      } else {
        // Update the content of a specific element with the rendered view HTML
        $("#content").html(response.html);
      }
    });
  });

  // GET AjaxRequest
  function ajaxRequest(url, requestType, callback) {
    $.ajax({
      url: url + "?type=" + requestType,
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
