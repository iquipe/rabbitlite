<?php
session_start(); // Start a new session
require_once("./control/control.php");
require_once("./control/functions.php");
require_once("./control/global.php");

if (is_dir($docFolderPath) && count(glob($docFolderPath . "/*")) > 0) {
    // _doc folder exists and is not empty
    include $docFolderPath.$docFile;
} else {
    // _doc folder does not exist or is empty
    include $routeFolderPath;
}

?>