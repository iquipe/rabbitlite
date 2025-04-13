<?php
session_start(); // Start a new session

// --- Error Reporting (Optional but Recommended for Development) ---
// Uncomment these lines during development to see all errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// --- Define Core File Paths ---
$controlDir = __DIR__ . '/control/'; // Use __DIR__ for reliability
$controlFile = $controlDir . 'control.php';
$functionsFile = $controlDir . 'functions.php';
$globalFile = $controlDir . 'global.php';
$docFolderPath = __DIR__ . '/_doc'; // Path to the _doc folder
$docFile = '/index.php'; // File within _doc
$routeFolderPath = $controlDir . 'route.php'; // Path to the main router

// --- Function to handle fatal errors ---
function handle_fatal_error(string $message, string $file = '', int $line = 0): void {
    // Log the error (replace with your preferred logging mechanism)
    error_log("Fatal Error: $message in $file on line $line");

    // Display a user-friendly message (avoid showing detailed errors in production)
    // In a real application, you might redirect to an error page
    echo "<!DOCTYPE html><html><head><title>Application Error</title></head><body>";
    echo "<h1>Oops! Something went wrong.</h1>";
    echo "<p>We're sorry, but the application encountered an unexpected error. Please try again later.</p>";
    // Optionally, provide a reference code or contact information
    // echo "<p>Error reference: " . uniqid() . "</p>";
    echo "</body></html>";
    exit; // Stop script execution
}

// --- Include Core Files with Error Checking ---
try {
    // Check and require control.php
    if (!file_exists($controlFile) || !is_readable($controlFile)) {
        throw new RuntimeException("Core file '{$controlFile}' not found or is not readable.");
    }
    require_once($controlFile);

    // Check and require functions.php
    if (!file_exists($functionsFile) || !is_readable($functionsFile)) {
        throw new RuntimeException("Core file '{$functionsFile}' not found or is not readable.");
    }
    require_once($functionsFile);

    // Check and require global.php
    if (!file_exists($globalFile) || !is_readable($globalFile)) {
        throw new RuntimeException("Core file '{$globalFile}' not found or is not readable.");
    }
    require_once($globalFile);

} catch (Throwable $e) { // Catch any error or exception during core file inclusion
    handle_fatal_error("Failed to load core application files.", $e->getFile(), $e->getLine());
}


// --- Determine which main file to include ---
$includePath = '';
if (isset($docFolderPath) && is_dir($docFolderPath) && count(glob($docFolderPath . "/*")) > 0) {
    // _doc folder exists and is not empty
    $potentialDocPath = $docFolderPath . $docFile;
    if (file_exists($potentialDocPath) && is_readable($potentialDocPath)) {
        $includePath = $potentialDocPath;
    } else {
        // Log this specific issue, but fall back to router
        error_log("Warning: Documentation file '{$potentialDocPath}' not found or not readable, falling back to main router.");
        if (file_exists($routeFolderPath) && is_readable($routeFolderPath)) {
             $includePath = $routeFolderPath;
        } else {
             handle_fatal_error("Main route file '{$routeFolderPath}' not found or is not readable.");
        }
    }
} else {
    // _doc folder does not exist or is empty, use the main router
    if (file_exists($routeFolderPath) && is_readable($routeFolderPath)) {
        $includePath = $routeFolderPath;
    } else {
        handle_fatal_error("Main route file '{$routeFolderPath}' not found or is not readable.");
    }
}

// --- Include the determined main file ---
if (!empty($includePath)) {
    try {
        include($includePath); // Use include, as require in route.php might already handle its own includes
    } catch (Throwable $e) {
        // Catch errors specifically from the included route/doc file
        handle_fatal_error("Error during application execution.", $e->getFile(), $e->getLine());
    }
} else {
    // This case should ideally not be reached due to previous checks, but added for safety
    handle_fatal_error("Could not determine a valid entry point file to include.");
}

?>
