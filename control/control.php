<?php

class control
{

    /**
     * Retrieves all PHP files within a specified directory and its subdirectories.
     *
     * @param string $directory The path to the directory to search.
     * @return array An array of file paths to PHP files, or an error message string.
     */
    public function getAllPhpFiles(string $directory): array|string
    {
        // Check if the directory exists and is readable.
        if (!is_dir($directory)) {
            return "Error: Directory '$directory' does not exist.";
        }

        if (!is_readable($directory)) {
            return "Error: Directory '$directory' is not readable.";
        }

        $phpFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            // Skip directories (e.g., "." and "..").
            if ($file->isDir()) {
                continue;
            }

            // Check if the file has a .php extension.
            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php') {
                $phpFiles[] = $file->getPathname();
            }
        }

        // Check if any PHP files were found.
        if (empty($phpFiles)) {
            return "Error: No PHP files found in directory '$directory'.";
        }

        return $phpFiles;
    }

    /**
     * Retrieves all PHP files within a specified directory and its subdirectories.
     *
     * @param string $directory The path to the directory to search.
     * @return array An array where the file name (without extension) is the key and the file path is the value, or an error message string.
     */
    public function getAllPhpFilesTemplate(string $directory): array|string
    {
        // Check if the directory exists and is readable.
        if (!is_dir($directory)) {
            return "Error: Directory '$directory' does not exist.";
        }

        if (!is_readable($directory)) {
            return "Error: Directory '$directory' is not readable.";
        }

        $phpFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $file) {
            // Skip directories (e.g., "." and "..").
            if ($file->isDir()) {
                continue;
            }

            // Check if the file has a .php extension.
            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php') {
                $fileNameWithoutExtension = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                $phpFiles[$fileNameWithoutExtension] = $file->getPathname();
            }
        }

        // Check if any PHP files were found.
        if (empty($phpFiles)) {
            return "Error: No PHP files found in directory '$directory'.";
        }

        return $phpFiles;
    }

    /**
     * Requires all PHP files within a specified directory and its subdirectories.
     *
     * @param string $directory The path to the directory to search.
     * @return array|string An array of successfully included file paths, or an error message string.
     */
    public function requireAllPhpFiles(string $directory): array|string
    {
        // Check if the directory exists and is readable.
        if (!is_dir($directory)) {
            return "Error: Directory '$directory' does not exist.";
        }

        if (!is_readable($directory)) {
            return "Error: Directory '$directory' is not readable.";
        }

        $phpFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        $successFiles = [];

        foreach ($iterator as $file) {
            // Skip directories (e.g., "." and "..").
            if ($file->isDir()) {
                continue;
            }

            // Check if the file has a .php extension.
            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php') {
                $phpFiles[] = $file->getPathname();
            }
        }

        // Check if any PHP files were found.
        if (empty($phpFiles)) {
            return "Error: No PHP files found in directory '$directory'.";
        }

        foreach ($phpFiles as $phpFile) {
            try {
                require_once $phpFile;
                $successFiles[] = $phpFile;
            } catch (Throwable $e) {
                return "Error: Failed to include file '$phpFile'. Reason: " . $e->getMessage();
            }
        }

        return $successFiles;
    }

    /**
     * Searches for 'autoload.php' files within a directory and its subdirectories and includes them.
     *
     * @param string $directory The path to the directory to search.
     * @return array|string An array of successfully included 'autoload.php' file paths, or an error message string.
     */
    public function requireAllAutoloadFiles(string $directory): array|string
    {
        // Check if the directory exists and is readable.
        if (!is_dir($directory)) {
            return "Error: Directory '$directory' does not exist.";
        }

        if (!is_readable($directory)) {
            return "Error: Directory '$directory' is not readable.";
        }

        $autoloadFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        $successFiles = [];

        foreach ($iterator as $file) {
            // Skip directories (e.g., "." and "..").
            if ($file->isDir()) {
                continue;
            }

            // Check if the file is named 'autoload.php'.
            if (strtolower($file->getFilename()) === 'autoload.php') {
                $autoloadFiles[] = $file->getPathname();
            }
        }

        // Check if any 'autoload.php' files were found.
        if (empty($autoloadFiles)) {
            return "Warning: No 'autoload.php' files found in directory '$directory'.";
        }

        foreach ($autoloadFiles as $autoloadFile) {
            try {
                require_once $autoloadFile;
                $successFiles[] = $autoloadFile;
            } catch (Throwable $e) {
                return "Error: Failed to include file '$autoloadFile'. Reason: " . $e->getMessage();
            }
        }

        return $successFiles;
    }

    
}
// Create an instance of control
$controller = new control();
?>