## Core Files:

* `c:\xamppserv\htdocs\school_fees\index.php`
    * Role: The main entry point of the application. It's the file that's executed when a user visits the website. It's responsible for including other necessary files and setting up the application's environment.
* `c:\xamppserv\htdocs\school_fees\control\global.php`
    * Role: The global configuration file. It initializes important variables, loads necessary classes and files, and sets up the database connection. It's included early in the application's execution.
* `c:\xamppserv\htdocs\school_fees\control\functions.php`
    * Role: Contains global helper functions, such as `loadMarkdownContent()`, `validateUrlRegex()`, `validateEmailBasic()`, and `getDocOrRoutePath()`. It also includes either `_doc/index.php` or `control/route.php` based on the existence of the `_doc` folder.
* `c:\xamppserv\htdocs\school_fees\control\navgation.php`
    * Role: The router/dispatcher. It determines which part of the application's logic should be executed based on the incoming HTTP request parameters (`submit`, `page`, `main`).
* `c:\xamppserv\htdocs\school_fees\control\connection.php`
    * Role: Handles database connections (SQLite, MySQL, MS Access) using PDO. It provides a unified way to connect to different database types.
* `c:\xamppserv\htdocs\school_fees\control\control.php`
    * Role: Contains the control class, which provides utility functions for file management (finding, including, etc.).

## Route Files:

* `c:\xamppserv\htdocs\school_fees\control\route.php`
    * Role: Handles requests when the `_doc` folder is not present or empty. It's included by `functions.php` in that case.
* `c:\xamppserv\htdocs\school_fees\control\route\main.php`
    * Role: Handles requests for specific "main" sections of the application. It's included by `navgation.php` when the `main` parameter is set.
* `c:\xamppserv\htdocs\school_fees\control\route\page.php`
    * Role: Handles requests for specific pages within the application. It's included by `navgation.php` when the `page` parameter is set.
* `c:\xamppserv\htdocs\school_fees\control\route\action.php`
    * Role: Handles form submissions or other actions. It's included by `navgation.php` when the `submit` parameter is set.

## Documentation Files:

* `c:\xamppserv\htdocs\school_fees\_doc\index.php`
    * Role: The main documentation page. It's included by `functions.php` when the `_doc` folder exists and is not empty. It displays the help documentation using Markdown files.
* `c:\xamppserv\htdocs\school_fees\_doc\help.md`
    * Role: Markdown file containing the "Getting Started" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\index.md`
    * Role: Markdown file containing the "index" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\global.md`
    * Role: Markdown file containing the "global" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\controller.md`
    * Role: Markdown file containing the "controller" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\database.md`
    * Role: Markdown file containing the "database" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\functions.md`
    * Role: Markdown file containing the "functions" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\navgation.md`
    * Role: Markdown file containing the "navgation" section of the documentation.
* `c:\xamppserv\htdocs\school_fees\_doc\action.md`
    * Role: Markdown file containing the "action" section of the documentation.

## Template Files:

* `c:\xamppserv\htdocs\school_fees\templates\login.php`
    * Role: The login template file. It is the default page of the application.

## Assets Files:

* `c:\xamppserv\htdocs\school_fees\assets\css\bootstrap.min.css`
    * Role: Bootstrap CSS file.
* `c:\xamppserv\htdocs\school_fees\assets\font\bootstrap-icons.css`
    * Role: Bootstrap Icons CSS file.
* `c:\xamppserv\htdocs\school_fees\assets\js\bootstrap.bundle.min.js`
    * Role: Bootstrap JS file.

## Models Files:

* `c:\xamppserv\htdocs\school_fees\models\*`
    * Role: This folder contains all the models files.

## Summary:

This list covers all the files that are part of the application's core structure, routing, documentation, and configuration. It also includes the assets files.