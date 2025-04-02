### Help Documentation for `global.php`

#### Overview
The `global.php` file acts as a centralized configuration and initialization script for your PHP application. It loads dependencies, initializes core components, and defines global variables to be used across the application. This structure promotes code reusability and maintainability.

---

#### Code Breakdown

1. **Loading All Files**
   ```php
   $models = $controller->requireAllPhpFiles('./models');
   $temp = $controller->getAllPhpFilesTemplate('./templates');
   $functions = $controller->requireAllAutoloadFiles('./modal/composer');
   ```
   - **Purpose:** Loads all required PHP files for models, templates, and Composer dependencies using `$controller` methods.
   - **Methods:**
     - `requireAllPhpFiles`: Includes all PHP files from the specified directory (`./models`).
     - `getAllPhpFilesTemplate`: Retrieves all PHP file templates from the specified directory (`./templates`).
     - `requireAllAutoloadFiles`: Loads Composer autoload dependencies from the specified path (`./modal/composer`).

---

2. **Database Configuration**
   ```php
   Database::$dbType = 'sqlite';
   Database::$dbName = 'lms.db';
   ```
   - **Purpose:** Configures the static properties of the `Database` class.
   - **Database Type:** SQLite
   - **Database File:** `lms.db`
   - **Dependencies:** Ensure the `Database` class is properly included and the SQLite driver is enabled.

---

3. **Initializing Parsedown**
   ```php
   $parsedown = new Parsedown();
   ```
   - **Purpose:** Creates an instance of the `Parsedown` class for Markdown parsing.
   - **Usage:** Enables converting Markdown content to HTML. For example:
     ```php
     $html = $parsedown->text('# Hello World!');
     ```

---

4. **Initializing JsonDataManager**
   ```php
   $jsql = new JsonDataManager('data/data.json');
   ```
   - **Purpose:** Initializes the `JsonDataManager` class with the path to the JSON data file.
   - **Expected Behavior:** Handles CRUD operations on `data/data.json`.

---

5. **Main Page Configuration**
   ```php
   $_MAIN_PAGE_PATH = $temp['login'];
   $_PAGE_ACTION = '';
   ```
   - **Purpose:** Defines global variables for managing the main page.
     - `$_MAIN_PAGE_PATH`: Points to the login page template retrieved from `$temp`.
     - `$_PAGE_ACTION`: Placeholder for actions on the main page.

---

6. **Application Labels**
   ```php
   $lable = [
       "tilte" => "",
       "application" => "",
       "version" => "",
   ];
   ```
   - **Purpose:** Stores metadata labels for the application, including:
     - **Title:** Name or title of the application.
     - **Application:** Description or identifier of the app.
     - **Version:** Current version of the application.
   - **Note:** There’s a typo in the key `"tilte"`. It should be `"title"`.

---

#### Example Usage

1. **Loading Models and Templates**
   - Verify that the directory paths (`./models`, `./templates`) contain the required PHP files.
   - Use `$controller->requireAllPhpFiles` to include models dynamically.

2. **Using Parsedown**
   - Convert Markdown content:
     ```php
     $markdownContent = "# Hello, World!";
     $htmlContent = $parsedown->text($markdownContent);
     echo $htmlContent;
     ```

3. **Interacting with JSON Data**
   - Example CRUD operation using `JsonDataManager`:
     ```php
     $jsonData = $jsql->read();
     print_r($jsonData);
     ```

4. **Accessing the Main Page Path**
   - Example:
     ```php
     include $_MAIN_PAGE_PATH; // Load the login template.
     ```

---

#### Recommendations
- **Error Handling:** Add checks to ensure required files exist before including them.
- **Typos:** Correct `"tilte"` to `"title"` in the `$lable` array.
- **Documentation:** Provide descriptions for `$controller` methods (`requireAllPhpFiles`, etc.) to clarify their behavior.

Let me know if you’d like enhancements or further explanations!