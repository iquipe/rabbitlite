<?php

/**
 * JSON Data Manager (OOP for CRUD operations with JSON data)
 *
 * This class provides a simple way to manage data stored in a JSON file.
 * It supports Create, Read, Update, and Delete (CRUD) operations.
 */
class JsonDataManager {

    private $filePath;
    private $data;

    /**
     * Constructor
     *
     * @param string $filePath The path to the JSON file.
     * @throws Exception If the file cannot be read or decoded.
     */
    public function __construct(string $filePath) {
        $this->filePath = $filePath;
        $this->loadData();
    }

    /**
     * Loads data from the JSON file.
     *
     * @throws Exception If the file cannot be read or decoded.
     */
    private function loadData() {
        if (!file_exists($this->filePath)) {
            $this->data = [];
            $this->saveData();
        } else {
            $jsonData = file_get_contents($this->filePath);
            if ($jsonData === false) {
                throw new Exception("Failed to read JSON file: {$this->filePath}");
            }

            $decodedData = json_decode($jsonData, true);
            if ($decodedData === null) {
                throw new Exception("Failed to decode JSON data in: {$this->filePath}");
            }

            $this->data = $decodedData;
        }
    }

    /**
     * Saves data to the JSON file.
     *
     * @throws Exception If the file cannot be written to.
     */
    private function saveData() {
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        if ($jsonData === false) {
            throw new Exception("Failed to encode data to JSON.");
        }

        $result = file_put_contents($this->filePath, $jsonData);
        if ($result === false) {
            throw new Exception("Failed to write to JSON file: {$this->filePath}");
        }
    }

    /**
     * Creates a new record within a specific entity.
     *
     * @param string $entity The name of the entity (e.g., "users", "products").
     * @param array $record The data for the new record.
     * @return int|null The ID of the new record, or null if creation failed.
     * @throws Exception If there is an error saving the data.
     */
    public function create(string $entity, array $record): ?int {
        if (!isset($this->data[$entity])) {
            $this->data[$entity] = [];
        }
        $nextId = $this->getNextId($entity);
        $record['id'] = $nextId;
        $this->data[$entity][] = $record;
        $this->saveData();
        return $nextId;
    }

    /**
     * Reads all records from a specific entity.
     *
     * @param string $entity The name of the entity.
     * @return array An array of all records in the entity, or an empty array if the entity doesn't exist.
     */
    public function readAll(string $entity): array {
        return $this->data[$entity] ?? [];
    }

    /**
     * Reads a single record by ID from a specific entity.
     *
     * @param string $entity The name of the entity.
     * @param int $id The ID of the record to read.
     * @return array|null The record data, or null if not found.
     */
    public function read(string $entity, int $id): ?array {
        if (isset($this->data[$entity])) {
            foreach ($this->data[$entity] as $record) {
                if ($record['id'] === $id) {
                    return $record;
                }
            }
        }
        return null;
    }

    /**
     * Updates a record by ID within a specific entity.
     *
     * @param string $entity The name of the entity.
     * @param int $id The ID of the record to update.
     * @param array $newData The new data for the record.
     * @return bool True if the record was updated, false otherwise.
     * @throws Exception If there is an error saving the data.
     */
    public function update(string $entity, int $id, array $newData): bool {
        if (isset($this->data[$entity])) {
            foreach ($this->data[$entity] as $key => $record) {
                if ($record['id'] === $id) {
                    $this->data[$entity][$key] = array_merge($record, $newData);
                    $this->saveData();
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Deletes a record by ID from a specific entity.
     *
     * @param string $entity The name of the entity.
     * @param int $id The ID of the record to delete.
     * @return bool True if the record was deleted, false otherwise.
     * @throws Exception If there is an error saving the data.
     */
    public function delete(string $entity, int $id): bool {
        if (isset($this->data[$entity])) {
            foreach ($this->data[$entity] as $key => $record) {
                if ($record['id'] === $id) {
                    unset($this->data[$entity][$key]);
                    $this->data[$entity] = array_values($this->data[$entity]); // Re-index the array
                    $this->saveData();
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Gets the next available ID for a specific entity.
     *
     * @param string $entity The name of the entity.
     * @return int The next available ID.
     */
    private function getNextId(string $entity): int {
        $maxId = 0;
        if (isset($this->data[$entity])) {
            foreach ($this->data[$entity] as $record) {
                if (isset($record['id']) && $record['id'] > $maxId) {
                    $maxId = $record['id'];
                }
            }
        }
        return $maxId + 1;
    }

    /**
     * Searches for records within a specific entity based on a search term.
     *
     * @param string $entity The name of the entity to search within.
     * @param string $searchTerm The term to search for.
     * @param array $fields The fields to search in. If empty, all fields are searched.
     * @return array An array of matching records.
     */
    public function search(string $entity, string $searchTerm, array $fields = []): array {
        $results = [];
        if (isset($this->data[$entity])) {
            foreach ($this->data[$entity] as $record) {
                $found = false;
                if (empty($fields)) {
                    // Search in all fields
                    foreach ($record as $value) {
                        if (stripos(strval($value), $searchTerm) !== false) {
                            $found = true;
                            break;
                        }
                    }
                } else {
                    // Search in specific fields
                    foreach ($fields as $field) {
                        if (isset($record[$field]) && stripos(strval($record[$field]), $searchTerm) !== false) {
                            $found = true;
                            break;
                        }
                    }
                }
                if ($found) {
                    $results[] = $record;
                }
            }
        }
        return $results;
    }
}

// // Example usage (you can put this in a separate file or at the end of this one)
// try {
//     $filePath = 'data.json'; // Replace with your desired file path
//     $userManager = new JsonDataManager($filePath);

//     // Create
//     $newUserId = $userManager->create('users', ['name' => 'John Doe', 'email' => 'john.doe@example.com']);
//     $userManager->create('users', ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com']);
//     $userManager->create('users', ['name' => 'Peter Jones', 'email' => 'peter.jones@example.com']);
//     $userManager->create('products', ['name' => 'Laptop', 'price' => 1200]);
//     $userManager->create('products', ['name' => 'Mouse', 'price' => 25]);
//     $userManager->create('products', ['name' => 'Keyboard', 'price' => 75]);

//     // Search
//     echo "\nSearch for 'John' in users (all fields):\n";
//     $searchResults = $userManager->search('users', 'John');
//     print_r($searchResults);

//     echo "\nSearch for 'Smith' in users (name field):\n";
//     $searchResults = $userManager->search('users', 'Smith', ['name']);
//     print_r($searchResults);

//     echo "\nSearch for 'peter' in users (email field):\n";
//     $searchResults = $userManager->search('users', 'peter', ['email']);
//     print_r($searchResults);

//     echo "\nSearch for '2' in products (all fields):\n";
//     $searchResults = $userManager->search('products', '2');
//     print_r($searchResults);

//     echo "\nSearch for 'mouse' in products (name field):\n";
//     $searchResults = $userManager->search('products', 'mouse', ['name']);
//     print_r($searchResults);

// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage() . "\n";
// }

?>
