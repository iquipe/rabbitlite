<?php
//global functions
// Function to load and parse Markdown content
function loadMarkdownContent($markdownFile) {
    global $parsedown; // Access the Parsedown instance
    if (file_exists($markdownFile)) {
        $markdown = file_get_contents($markdownFile);
        return $parsedown->text($markdown); // Parse Markdown to HTML
    } else {
        return "<p>Error: Markdown file not found.</p>";
    }
}

function getCurrentScriptPath() {
    return htmlspecialchars($_SERVER["PHP_SELF"]);
}
  
function validateUrlRegex($url) {
  // This regex is quite comprehensive but might need adjustments depending on your needs.
  $regex = '/^(?:(?:https?|ftp):\/\/)?(?:www\.)?(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9](?:\/[^ ]*)?$/i';
  return preg_match($regex, $url) === 1;
}

//Example
// $url1 = "https://www.example.com";
// $url2 = "ftp://invalid.url"; //This will fail
// $url3 = "example.com"; //This will fail
// $url4 = "https://www.example.com/path/with/spaces"; //This will fail because of spaces

// echo "$url1: " . (validateUrlRegex($url1) ? 'Valid' : 'Invalid') . "\n";
// echo "$url2: " . (validateUrlRegex($url2) ? 'Valid' : 'Invalid') . "\n";
// echo "$url3: " . (validateUrlRegex($url3) ? 'Valid' : 'Invalid') . "\n";
// echo "$url4: " . (validateUrlRegex($url4) ? 'Valid' : 'Invalid') . "\n";

function validateEmailBasic($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// // Example usage:
// $email1 = "test@example.com";
// $email2 = "invalid-email";
// $email3 = "test@example.co.uk";

// echo "$email1: " . (validateEmailBasic($email1) ? 'Valid' : 'Invalid') . "\n";
// echo "$email2: " . (validateEmailBasic($email2) ? 'Valid' : 'Invalid') . "\n";
// echo "$email3: " . (validateEmailBasic($email3) ? 'Valid' : 'Invalid') . "\n";


/**
 * Conditionally returns the file path of either ./_doc/index.php or ./control/route.php
 * based on the existence and content of the _doc folder.
 *
 * @return string The file path to include.
 */
function getDocOrRoutePath() {
  global $parsedown; // Access the Parsedown instance from global scope
  $docFolderPath = __DIR__ . "/../_doc"; // Construct the path to the _doc folder

  if (is_dir($docFolderPath) && count(glob($docFolderPath . "/*")) > 0) {
      // _doc folder exists and is not empty
      return $docFolderPath . "/index.php";
  } else {
      // _doc folder does not exist or is empty
      return __DIR__ . "/route.php";
  }
}

// Example of how to use the function:
//$filePath = getDocOrRoutePath();
//require_once($filePath);
?>