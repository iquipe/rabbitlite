### Help Documentation for `connection.php`

#### Overview
The `Database` class provides a structured approach for establishing and managing database connections in PHP. It supports three database types:
- **SQLite**
- **MySQL**
- **Microsoft Access**

This class simplifies the connection process by encapsulating the logic into reusable methods while offering flexibility through customizable class properties.

---

#### Class Properties
Below is a summary of the class's properties:

| **Property**      | **Type**    | **Default Value**  | **Description**                                  |
|--------------------|-------------|--------------------|--------------------------------------------------|
| `private static $pdo` | `PDO` or `null` | `null`          | Stores the static database connection.          |
| `public static $dbName` | `string` or `null` | `null`         | Name of the database.                           |
| `public static $dbPath` | `string`  | `'data/'`         | Directory path for SQLite/Access database files.|
| `public static $dbHost` | `string` or `null` | `null`         | Hostname for MySQL connections.                 |
| `public static $dbUser` | `string` or `null` | `null`         | Username for MySQL connections.                 |
| `public static $dbPass` | `string` or `null` | `null`         | Password for MySQL connections.                 |
| `public static $dbType` | `string` or `null` | `null`         | Database type (e.g., `sqlite`, `mysql`, `access`).|
| `public static $dbPort` | `int` or `null`    | `null`         | Database port number (currently unused).        |
| `public static $dbCharset` | `string`  | `'utf8'`        | Character set for MySQL.                        |
| `public static $dbCollation` | `string` | `'utf8_general_ci'` | Collation for MySQL.                        |
| `public static $dbExtension` | `string` | `'.db'`        | File extension for SQLite databases.            |

---

#### Key Methods
1. **`connect()`**
   - Description: Establishes a database connection based on the specified database type.
   - Returns: A `PDO` instance on success or a string error message on failure.

2. **`connectToSQLite()` (Private)**
   - Description: Handles SQLite connections. Ensures the database directory exists before creating the connection.
   - Returns: A `PDO` instance or an error message.

3. **`connectToMySQL()` (Private)**
   - Description: Handles MySQL connections using the provided host, username, and password.
   - Returns: A `PDO` instance or an error message.

4. **`connectToMsAccess()` (Private)**
   - Description: Handles Microsoft Access database connections.
   - Returns: A `PDO` instance or an error message.

5. **`closeConnection()`**
   - Description: Explicitly closes the database connection by setting `$pdo` to `null`. Optional, as PHP automatically closes connections at the end of script execution.

---

#### Example Usage

1. **SQLite Database**
   ```php
   Database::$dbType = 'sqlite';
   Database::$dbName = 'grades';
   $pdo = Database::connect();
   if ($pdo instanceof PDO) {
       echo "Connection to SQLite was successful!";
       Database::closeConnection();
   } else {
       echo $pdo; // Error message.
   }
   ```

2. **MySQL Database**
   ```php
   Database::$dbType = 'mysql';
   Database::$dbHost = 'localhost';
   Database::$dbName = 'example_db';
   Database::$dbUser = 'root';
   Database::$dbPass = 'password';
   $pdo = Database::connect();
   if ($pdo instanceof PDO) {
       echo "Connection to MySQL was successful!";
       Database::closeConnection();
   } else {
       echo $pdo; // Error message.
   }
   ```

3. **Microsoft Access Database**
   ```php
   Database::$dbType = 'access';
   Database::$dbName = 'example_access_db';
   $pdo = Database::connect();
   if ($pdo instanceof PDO) {
       echo "Connection to MS Access was successful!";
       Database::closeConnection();
   } else {
       echo $pdo; // Error message.
   }
   ```

---

#### Notes
- Ensure the appropriate database drivers are installed (e.g., SQLite, MySQL, or ODBC for Access).
- Use `connect()` sparingly, as multiple calls may override existing connections unless explicitly closed using `closeConnection()`.

Feel free to expand upon this guide with project-specific requirements! Let me know if you need clarifications or improvements.