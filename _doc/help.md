### RabbitLite Framework v1: Full Help Documentation and Deployment Guide

#### Overview
RabbitLite v1 is a lightweight framework designed to accelerate PHP application development for the web. It provides modular functionality, centralized configuration, and reusable components, enabling developers to build structured, scalable, and maintainable web applications.

This documentation includes:
1. Framework Components
2. Deployment Steps
3. Sample Application Setup
4. Recommendations

---

### 1. Framework Components

#### Core Files and Their Purpose
| **File**             | **Purpose**                                                                                      |
|-----------------------|--------------------------------------------------------------------------------------------------|
| `control.php`         | Manages file retrieval and inclusion, supporting directory scanning and dynamic loading of files. |
| `functions.php`       | Provides global utility functions for tasks like Markdown parsing, URL validation, and email validation. |
| `global.php`          | Configures global variables and initializes core components like the database and routing paths.  |
| `action.php`          | Handles user-triggered actions (e.g., saving, deleting, updating data) based on form submissions. |
| `index.php`           | Serves as the entry point for the application, initializing sessions and including core files.    |
| `route.php`           | Defines routing logic to dynamically load content based on user interactions or requests.         |

---

### 2. Deployment Steps

#### Step 1: Set Up the Project
1. Create a new directory for your RabbitLite project (e.g., `rabbitLiteApp`).
2. Place all framework files (`index.php`, `control.php`, `functions.php`, `global.php`, `action.php`, `route.php`) into appropriate subfolders:
   - `control/`: For core framework logic (`control.php`, `functions.php`, `global.php`).
   - `templates/`: For HTML or PHP templates.
   - `models/`: For data models or business logic classes.
   - `modal/composer/`: For Composer dependencies like `autoload.php`.

#### Step 2: Set Up PHP Environment
1. Install PHP (minimum version 7.4 or higher).
2. Install and configure required PHP extensions for database connections:
   - SQLite (required for RabbitLite database operations).
   - MySQL (optional for MySQL database integration).

#### Step 3: Initialize the Framework
1. Configure `global.php`:
   - Set `Database::$dbType` to the desired database type (`sqlite`, `mysql`, or `access`).
   - Specify `Database::$dbName` and paths for database files (`Database::$dbPath`).
   - Example configuration:
     ```php
     Database::$dbType = 'sqlite';
     Database::$dbName = 'lms.db';
     Database::$dbPath = './data/';
     ```

2. Configure routing logic in `route.php`:
   - Define the conditions to load specific templates or execute actions based on user input.

#### Step 4: Create Sample Templates
1. Create HTML or PHP templates in the `templates/` directory (e.g., `login.php`, `dashboard.php`).
   - Example: `login.php`
     ```php
     <form method="POST" action="action.php">
         <input type="text" name="username" placeholder="Username" required>
         <input type="password" name="password" placeholder="Password" required>
         <button type="submit" name="submit" value="login">Login</button>
     </form>
     ```

#### Step 5: Test File Inclusion
1. Use `control.php` methods to load files dynamically:
   - Example:
     ```php
     $controller = new control();
     $templates = $controller->getAllPhpFilesTemplate('./templates');
     print_r($templates); // Outputs all template file paths.
     ```

#### Step 6: Deploy Application Locally
1. Start a local PHP server:
   - Navigate to your project directory in the terminal.
   - Run: `php -S localhost:8000` to start the server.
2. Access your application in the browser at `http://localhost:8000`.

#### Step 7: Deploy Application to Web Server
1. Choose a web hosting platform (e.g., Apache or Nginx).
2. Upload RabbitLite project files to the server.
3. Configure the server for PHP execution and ensure correct file permissions (e.g., writable directories for database files).

---

### 3. Sample Application Setup

#### Example: Login System
1. **Configuration (`global.php`)**
   ```php
   Database::$dbType = 'sqlite';
   Database::$dbName = 'users.db';
   Database::$dbPath = './data/';
   ```

2. **Routing Logic (`route.php`)**
   ```php
   if ($_REQUEST['submit'] === 'login') {
       require_once('./templates/dashboard.php');
   } else {
       require_once('./templates/login.php');
   }
   ```

3. **Action Logic (`action.php`)**
   ```php
   switch ($_REQUEST['submit']) {
       case 'login':
           echo "Login action triggered.";
           break;
       default:
           echo "Invalid action.";
           break;
   }
   ```

4. **Dynamic File Loading (`control.php`)**
   ```php
   $templates = $controller->getAllPhpFilesTemplate('./templates');
   ```

---

### 4. Recommendations

#### Security
1. Sanitize user inputs (`$_REQUEST`) to prevent injection attacks.
2. Implement HTTPS for secure data transmission.

#### Error Handling
1. Add detailed error messages for missing files and invalid configurations.
2. Log errors to a file for debugging.

#### Scalability
1. Extend `control.php` to include caching mechanisms for file retrieval.
2. Use Composer to manage third-party dependencies.

---

RabbitLite v1 provides a solid foundation for developing PHP web applications. Its modular design enables customization and scalability, making it suitable for projects of various complexities. If you need further assistance or would like to explore additional features, feel free to reach out!