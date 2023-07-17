<?php

// AjaxController.php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AjaxController
{
    private $twig;

    public function __construct()
    {
        // Initialize Twig environment with the appropriate template path
        $loader = new FilesystemLoader('/path/to/your/templates');
        $this->twig = new Environment($loader);
    }

    public function loadView(Request $request, Response $response, $args)
    {
        // Retrieve the view name from the URL parameter
        $viewName = $args['view'];

        // Determine if we want the whole page or just a content fragment
        $requestType = $request->getQueryParams()['type'] ?? 'page';

        if ($requestType === 'page') {
            // Load the entire page and return it as a response
            $html = $this->renderPage($viewName);
        } else {
            // Load the specific content fragment and return it as a JSON response
            $html = $this->renderView($viewName);
        }

        if ($requestType === 'page') {
            // Return the entire page as HTML response
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html');
        } else {
            // Return the specific content fragment as JSON response
            $response->getBody()->write(json_encode(['html' => $html]));
            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    private function renderPage($viewName)
    {
        // Implement your page rendering logic using Twig
        // Load and render the main template (e.g., layout.twig)
        // Pass necessary data to the template as needed

        // For example, you might do something like this:
        $html = $this->twig->render('layout.twig', ['content' => $this->renderView($viewName)]);
        return $html;
    }

    private function renderView($viewName)
    {
        // Implement your view rendering logic using Twig
        // Load and render the specific view template
        // Pass necessary data to the template as needed

        // For example, you might do something like this:
        $html = $this->twig->render('views/' . $viewName . '.twig', ['someVariable' => 'Some value']);
        return $html;
    }
}

?>

<script>
  $(document).ready(function() {
    // Select all <a> tags and add a click event listener
    $('a').on('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior

      var url = $(this).attr('href'); // Get the href attribute of the clicked link

      // Determine if we want the whole page or just a content fragment
      var requestType = ($(this).data('request-type') === 'page') ? 'page' : 'fragment';

      // Perform the AJAX request
      $.ajax({
        url: "/ajax/load-view/" + encodeURIComponent(url) + "?type=" + requestType,
        method: 'GET',
        success: function(response) {
          if (requestType === 'page') {
            // Replace the entire page content with the response HTML
            document.open();
            document.write(response);
            document.close();
          } else {
            // Update the content of a specific element with the rendered view HTML
            $("#content").html(response.html);
          }
        },
        error: function(xhr, status, error) {
          console.error("AJAX request error:", error);
        }
      });
    });
  });
</script>
