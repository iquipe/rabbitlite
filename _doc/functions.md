### Help Documentation for `functions.php`

#### Overview
The `functions.php` file provides a collection of global utility functions that serve various purposes, including Markdown parsing, URL validation, email validation, and retrieving the current script's path. These functions are modular, reusable, and designed to streamline development workflows.

---

### Functions Breakdown

#### 1. `loadMarkdownContent($markdownFile)`
- **Purpose:** Converts Markdown content into HTML using the global `Parsedown` instance.
- **Parameters:**
  - `$markdownFile` (string): The file path to the Markdown file.
- **Return Value:**
  - Returns the parsed HTML if the file exists.
  - Returns an error message if the file is not found.
- **Dependencies:**
  - Requires the global `Parsedown` instance to be initialized.
- **Example Usage:**
  ```php
  $htmlContent = loadMarkdownContent('README.md');
  echo $htmlContent;
  ```
- **Error Handling:** Ensures the Markdown file exists before attempting to load it.

---

#### 2. `getCurrentScriptPath()`
- **Purpose:** Retrieves the path of the currently executing PHP script.
- **Return Value:**
  - Returns the sanitized script path using `htmlspecialchars`.
- **Example Usage:**
  ```php
  $scriptPath = getCurrentScriptPath();
  echo "Current script path: " . $scriptPath;
  ```

---

#### 3. `validateUrlRegex($url)`
- **Purpose:** Validates a URL using a regular expression.
- **Parameters:**
  - `$url` (string): The URL string to validate.
- **Return Value:**
  - Returns `true` if the URL matches the regex pattern.
  - Returns `false` otherwise.
- **Example Usage:**
  ```php
  $url = "https://www.example.com";
  echo validateUrlRegex($url) ? "Valid URL" : "Invalid URL";
  ```
- **Notes:**
  - The regex used is comprehensive but may require adjustments for specific use cases.
  - Certain URLs (e.g., those containing spaces) may fail validation.

---

#### 4. `validateEmailBasic($email)`
- **Purpose:** Validates an email address using PHP's built-in filter.
- **Parameters:**
  - `$email` (string): The email address to validate.
- **Return Value:**
  - Returns `true` if the email is valid.
  - Returns `false` otherwise.
- **Example Usage:**
  ```php
  $email = "test@example.com";
  echo validateEmailBasic($email) ? "Valid Email" : "Invalid Email";
  ```

---

### Example Workflow

```php
// Parse Markdown content.
$htmlContent = loadMarkdownContent('README.md');
echo $htmlContent;

// Get current script path.
$currentPath = getCurrentScriptPath();
echo "Script path: " . $currentPath;

// Validate a URL.
$url = "https://www.example.com";
echo validateUrlRegex($url) ? "Valid URL" : "Invalid URL";

// Validate an email address.
$email = "test@example.com";
echo validateEmailBasic($email) ? "Valid Email" : "Invalid Email";
```

---

### Recommendations

1. **Error Handling:**
   - Add more descriptive error messages for edge cases. For example:
     ```php
     if (!file_exists($markdownFile)) {
         return "<p>Error: Markdown file '$markdownFile' not found.</p>";
     }
     ```

2. **Input Sanitization:**
   - Ensure inputs like `$markdownFile`, `$url`, and `$email` are sanitized to avoid potential vulnerabilities.
   - Example:
     ```php
     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
     ```

3. **Regex Improvement:**
   - The URL regex can be tailored for different types of URLs, including handling protocols or edge cases with spaces.

4. **Documentation:**
   - Provide detailed comments for each function, outlining potential edge cases and expected usage.

These functions offer robust utility features that can be expanded upon as needed. Let me know if you need help refining the functionality further!