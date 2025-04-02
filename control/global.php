<?php
//start load all files
require_once("./control/connection.php");
$modular = $controller->requireAllPhpFiles('./modular');
$functions = $controller->requireAllPhpFiles('./modular/functions');
$template = $controller->getAllPhpFilesTemplate('./template');
$composer = $controller->requireAllAutoloadFiles('./modular/composer');
// Create an instance of Parsedown
Database::$dbType='sqlite';
Database::$dbName='data';
Database::$dbPath='data/';
Database::$dbExtension='.sqlite';

// Create an instance of control
$docFolderPath = __DIR__ . "/../_doc";
$routeFolderPath = __DIR__ ."/route.php";
$docFile = "/index.php";
// Create an instance of Parsedown
$parsedown = new Parsedown();
// Create an instance of JsonDataManager
$jsql = new JsonDataManager('data/data.json');
// Create an your instances below
//end load all files
//print_r($modular);
//print_r($functions);
//print_r($template);
//print_r($composer);

?>