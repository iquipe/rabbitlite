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
        // ... (rest of the method remains the same) ...
        // Check if the directory exists and is readable.
        if (!is_dir($directory)) {
            return "Error: Directory '$directory' does not exist.";
        }

        if (!is_readable($directory)) {
            return "Error: Directory '$directory' is not readable.";
        }

        $phpFiles = [];
        // Use SPL classes directly as they are global
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

    // ... (rest of your getAllPhpFilesTemplate method) ...
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


    // ... (rest of your requireAllPhpFiles method) ...
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
            } catch (Throwable $e) { // Use Throwable which catches Errors and Exceptions
                // Consider logging the error instead of returning immediately
                error_log("Error: Failed to include file '$phpFile'. Reason: " . $e->getMessage());
                // Depending on requirements, you might want to collect errors and return them all,
                // or throw an exception, or continue trying to include other files.
                // Returning immediately might hide subsequent inclusion failures.
                return "Error: Failed to include file '$phpFile'. Reason: " . $e->getMessage();
            }
        }

        return $successFiles;
    }


    // ... (rest of your requireAllAutoloadFiles method) ...
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
            // Changed to log a warning instead of returning it as a string,
            // as this might not be a critical error.
            error_log("Warning: No 'autoload.php' files found in directory '$directory'.");
            return []; // Return empty array indicating none were found/included
        }

        foreach ($autoloadFiles as $autoloadFile) {
            try {
                require_once $autoloadFile;
                $successFiles[] = $autoloadFile;
            } catch (Throwable $e) { // Use Throwable
                 // Consider logging the error instead of returning immediately
                error_log("Error: Failed to include file '$autoloadFile'. Reason: " . $e->getMessage());
                // See comment in requireAllPhpFiles about error handling strategy.
                return "Error: Failed to include file '$autoloadFile'. Reason: " . $e->getMessage();
            }
        }

        return $successFiles;
    }


    /**
     * Creates a SoapClient instance if the server location is accessible.
     *
     * @param string $location The SOAP server location URL. Defaults to 'http://localhost/server/server.php'.
     * @param string $uri The SOAP server URI. Defaults to 'http://localhost/server'.
     * @param int $timeout Connection timeout in seconds. Defaults to 5.
     * @return SoapClient|false A SoapClient instance on success, false otherwise.
     */
    public function serviceFx(
        string $location = 'https://rabbitlite.iquipedigital.com/servfx/server.php',
        string $uri = 'https://rabbitlite.iquipedigital.com/servfx/',
        int $timeout = 5
    ): \SoapClient|false { // Use \SoapClient in type hint for clarity

        // 1. Check if the server location is accessible
        $context = stream_context_create(['http' => ['timeout' => $timeout]]);
        $headers = @get_headers($location, false, $context);

        if ($headers === false || strpos($headers[0], '200 OK') === false) {
            $status = $headers === false ? 'unreachable' : $headers[0];
            error_log("servFx Error: SOAP server location '{$location}' is not accessible or did not return a 200 OK status. Status: {$status}");
            return false;
        }

        // 2. If accessible, try to initialize the SOAP client
        try {
            // Use \SoapClient directly here
            $client = new \SoapClient(
                null,
                [
                    'location' => $location,
                    'uri'      => $uri,
                    'trace'    => 1,
                    'connection_timeout' => $timeout,
                    'exceptions' => true
                ]
            );
            return $client;
        } catch (\SoapFault $e) { // Use \SoapFault directly here
            error_log("servFx SOAP Error: Failed to create SoapClient for URI '{$uri}' at location '{$location}'. Message: " . $e->getMessage());
            return false;
        } catch (\Exception $e) { // Use \Exception directly here
            error_log("servFx General Error: Failed to create SoapClient for URI '{$uri}' at location '{$location}'. Message: " . $e->getMessage());
            return false;
        }
    }

} // End of class control

// Create an instance of control
$controller = new control();
?>
