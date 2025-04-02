### Help Documentation for `control.php`

#### Overview
The `control` class provides essential utility functions for managing PHP files and their dependencies within specified directories. These methods enable dynamic file retrieval, inclusion, and error handling, thereby simplifying project setup and file management.

---

### Class Methods

Below is a summary of the methods provided by the `control` class:

| **Method**                        | **Parameters**              | **Return Type**             | **Description**                                                                 |
|-----------------------------------|-----------------------------|-----------------------------|---------------------------------------------------------------------------------|
| `getAllPhpFiles()`                | `$directory` (string)       | `array` or `string`         | Retrieves all `.php` file paths from the specified directory and subdirectories.|
| `getAllPhpFilesTemplate()`        | `$directory` (string)       | `array` or `string`         | Retrieves `.php` file paths as key-value pairs (filename as key, path as value).|
| `requireAllPhpFiles()`            | `$directory` (string)       | `array` or `string`         | Includes all `.php` files from the specified directory.                         |
| `requireAllAutoloadFiles()`       | `$directory` (string)       | `array` or `string`         | Includes all `autoload.php` files from the specified directory.                 |

---

### Detailed Method Descriptions

#### 1. `getAllPhpFiles(string $directory): array|string`
- **Purpose:** Retrieves paths of all `.php` files from the given directory and its subdirectories.
- **Workflow:**
  - Verifies if the directory exists and is readable.
  - Iterates through files using `RecursiveIteratorIterator`.
  - Filters files to include only those with a `.php` extension.
- **Error Handling:** Returns error messages if the directory is invalid or no files are found.
- **Example Usage:**
  ```php
  $phpFiles = $controller->getAllPhpFiles('./models');
  print_r($phpFiles);
  ```

---

#### 2. `getAllPhpFilesTemplate(string $directory): array|string`
- **Purpose:** Retrieves `.php` file paths as an associative array where:
  - **Key:** File name (without extension).
  - **Value:** Full file path.
- **Workflow:**
  - Same as `getAllPhpFiles()`, with additional logic to extract the filename as the array key.
- **Error Handling:** Returns error messages for invalid directories or no files found.
- **Example Usage:**
  ```php
  $templates = $controller->getAllPhpFilesTemplate('./templates');
  print_r($templates);
  ```

---

#### 3. `requireAllPhpFiles(string $directory): array|string`
- **Purpose:** Dynamically includes all `.php` files within the specified directory.
- **Workflow:**
  - Collects paths of all `.php` files.
  - Iteratively calls `require_once` for each file.
- **Error Handling:**
  - Returns error messages if inclusion fails due to file or directory issues.
- **Example Usage:**
  ```php
  $includedFiles = $controller->requireAllPhpFiles('./models');
  print_r($includedFiles);
  ```

---

#### 4. `requireAllAutoloadFiles(string $directory): array|string`
- **Purpose:** Searches for and includes all `autoload.php` files in the given directory.
- **Workflow:**
  - Iterates through files to locate `autoload.php`.
  - Calls `require_once` for each matched file.
- **Error Handling:**
  - Returns warnings if no `autoload.php` files are found.
  - Returns error messages if inclusion fails due to file or directory issues.
- **Example Usage:**
  ```php
  $autoloadFiles = $controller->requireAllAutoloadFiles('./composer');
  print_r($autoloadFiles);
  ```

---

### Example Workflow

```php
$controller = new control();

// Retrieve all PHP files from a directory.
$phpFiles = $controller->getAllPhpFiles('./models');

// Retrieve PHP templates with filenames as keys.
$templates = $controller->getAllPhpFilesTemplate('./templates');

// Include all PHP files.
$includedFiles = $controller->requireAllPhpFiles('./models');

// Include all autoload.php files.
$autoloadFiles = $controller->requireAllAutoloadFiles('./composer');
```

---

### Help Documentation for `controller.php`

1. **Error Handling:**
   - Add checks to ensure required files exist and handle exceptions gracefully.
   - Example:
     ```php
     if (is_array($phpFiles)) {
         foreach ($phpFiles as $file) {
             echo "Found: $file\n";
         }
     } else {
         echo $phpFiles; // Error message.
     }
     ```

2. **Performance Optimization:**
   - Cache results of file retrieval if methods are called frequently.
   - Example:
     ```php
     static $cachedFiles = [];
     if (!empty($cachedFiles)) {
         return $cachedFiles;
     }
     $cachedFiles = $controller->getAllPhpFiles('./models');
     ```

3. **Security:**
   - Sanitize directory paths and ensure only trusted files are included.
   - Example:
     ```php
     $directory = filter_var('./models', FILTER_SANITIZE_STRING);
     ```

This utility class is highly versatile and can streamline file management in your PHP projects. Let me know if you need further guidance or want additional features added!