<?php
//global functions
function env(){
    $env = parse_ini_file(__DIR__ . '/../.env');
    return $env;
  }
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

/**
 * Verifies if an MD5 hash corresponds to the MD5 hash of a number between 1 and 9999.
 *
 * @param string $inputHash The MD5 hash string to check.
 * @return int|false The matching number (1-9999) if found, otherwise false.
 */
function findNumberFromMd5(string $inputHash): int|false
{
    // Optional: Basic validation to ensure the input looks like an MD5 hash
    if (!preg_match('/^[a-f0-9]{32}$/i', $inputHash)) {
        // You might want to handle this error differently, e.g., throw an exception
        // For now, we'll return false if the format is incorrect.
        error_log("Invalid MD5 hash format provided: " . $inputHash);
        return false;
    }

    // Loop through numbers from 1 to 9999
    for ($number = 1; $number <= 9999999999; $number++) {
        // Calculate the MD5 hash of the current number (cast to string)
        $calculatedHash = md5((string)$number);

        // Compare the calculated hash with the input hash
        if ($calculatedHash === $inputHash) {
            // If a match is found, return the number
            return $number;
        }
    }

    // If the loop completes without finding a match, return false
    return false;
}

/**
 * Handles uploading a file from a temporary location to a specified destination.
 *
 * @param string $source The temporary file path (usually from $_FILES['input_name']['tmp_name']).
 * @param string $destination The full path including the desired filename for the uploaded file.
 * @return bool True if the upload was successful, false otherwise.
 */
function uploadDoc(string $source, string $destination): bool
{
    // 1. Check if the source file is actually an uploaded file
    //    This is a crucial security measure!
    if (!is_uploaded_file($source)) {
        error_log("uploadDoc Error: Source path '{$source}' is not a valid uploaded file.");
        return false;
    }

    // 2. Ensure the destination directory exists (optional, but good practice)
    $destinationDirectory = dirname($destination);
    if (!is_dir($destinationDirectory)) {
        // Attempt to create the directory recursively
        if (!mkdir($destinationDirectory, 0775, true)) { // Use appropriate permissions
            error_log("uploadDoc Error: Failed to create destination directory '{$destinationDirectory}'.");
            return false;
        }
    }

    // 3. Attempt to move the uploaded file
    if (move_uploaded_file($source, $destination)) {
        // Optional: Set permissions on the uploaded file if needed
        // chmod($destination, 0644);
        return true; // Success!
    } else {
        error_log("uploadDoc Error: Failed to move uploaded file from '{$source}' to '{$destination}'. Check permissions and paths.");
        return false; // Failed to move the file
    }
}

// --- Example Usage (typically within your action.php or similar handler) ---
/*
if (isset($_FILES['myFile']) && $_FILES['myFile']['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $_FILES['myFile']['tmp_name'];
    $originalFileName = basename($_FILES['myFile']['name']); // Get original filename securely

    // --- IMPORTANT: Sanitize or generate a safe filename ---
    // Avoid using the original filename directly to prevent security issues.
    // Option 1: Generate a unique name
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $safeFileName = uniqid('doc_', true) . '.' . strtolower($fileExtension);

    // Option 2: Sanitize the original name (more complex to get right)
    // $safeFileName = preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $originalFileName);
    // $safeFileName = time() . '_' . $safeFileName; // Add timestamp for uniqueness

    // --- Define the destination path ---
    // Adjust the base path as needed for your project structure
    $uploadDirectory = __DIR__ . '/../uploads/'; // Example: uploads folder one level up
    $destinationPath = $uploadDirectory . $safeFileName;

    // --- Call the upload function ---
    if (uploadDoc($tempFilePath, $destinationPath)) {
        echo "File uploaded successfully to: " . htmlspecialchars($destinationPath);
        // Store $destinationPath or $safeFileName in the database if needed
    } else {
        echo "File upload failed.";
    }
} elseif (isset($_FILES['myFile'])) {
    // Handle specific upload errors
    $errorCode = $_FILES['myFile']['error'];
    echo "File upload error code: " . $errorCode;
    // You can add more specific messages based on $errorCode constants (UPLOAD_ERR_INI_SIZE, etc.)
}
*/

// Function to read the contents of a file and return it as an array
function readTextToArray($filePath) {
    // Path to the file
    // Check if the file exists
    if (!file_exists($filePath)) {
        return "Error: File not found.";
    }
  
    // Read the file into an array, each line as an element
    $programmes = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
    // Check if reading the file was successful
    if ($programmes === false) {
        return "Error: Could not read the file.";
    }
  
    // Trim whitespace from each line
    $programmes = array_map('trim', $programmes);
  
    return $programmes;
  }
// ... (rest of your functions.php file) ...

?>
