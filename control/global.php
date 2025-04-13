<?php
//start load all files
require_once("./control/connection.php");
$modular = $controller->requireAllPhpFiles('./modular');
$functions = $controller->requireAllPhpFiles('./modular/functions');
$template = $controller->getAllPhpFilesTemplate('./template');
$composer = $controller->requireAllAutoloadFiles('./modular/composer');
// Create an instance of control
$docFolderPath = __DIR__ . "/../_doc";
$routeFolderPath = __DIR__ ."/route.php";
$docFile = "/index.php";
// Create an instance of Parsedown
$parsedown = new Parsedown();
// Create an instance of JsonDataManager
$jsql = new JsonDataManager('data/data.json');
// Create an instance of Database
require_once("./config.php");
// --- Dynamic Model Instantiation ---
echo "<!-- Dynamically Instantiating Models -->\n";
// Get PHP files directly from the modular directory (non-recursive)
$modelFiles = glob('./modular/*.php');

if ($modelFiles === false) {
    error_log("Failed to scan modular directory for model files.");
} else {
    foreach ($modelFiles as $filePath) {
        $className = pathinfo($filePath, PATHINFO_FILENAME); // Get filename without extension (e.g., CandidateModel)
        $variableName = strtolower($className); // Convert to lowercase (e.g., candidatemodel)

        // Check if the class exists (it should have been included by requireAllPhpFiles)
        // and ensure it's not an abstract class or interface we shouldn't instantiate
        if (class_exists($className)) {
            try {
                // Use variable variables to create the instance
                ${$variableName} = new $className();
                echo "<!-- Instantiated: \$$variableName = new $className() -->\n";
            } catch (Exception $e) {
                // Catch potential exceptions during instantiation (e.g., DB connection issues in constructor)
                error_log("Failed to instantiate $className: " . $e->getMessage());
                // Optionally set the variable to null or handle the error differently
                ${$variableName} = null;
            }
        } else {
             error_log("Class $className not found, skipping instantiation for $filePath.");
        }
    }
}
echo "<!-- End Dynamic Instantiation -->\n";
//end load all files
//print_r($modular);
//print_r($functions);
//print_r($template);
//print_r($composer);

?>