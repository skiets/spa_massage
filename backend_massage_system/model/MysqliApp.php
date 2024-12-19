<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);

class MysqliApp {

    private $conn;

    function __construct() {
        // Establish connection with error handling
        $this->conn = mysqli_connect("localhost", "u846527182_Admins", "Adminako123", "u846527182_spa_massage_db");

        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Secure query execution (for INSERT, UPDATE, DELETE)
    function query($sql, $params = []) {
        try {
            // Prepare the query to avoid SQL injection
            $stmt = mysqli_prepare($this->conn, $sql);
    
            if ($stmt) {
                // If there are parameters, bind them
                if (!empty($params)) {
                    $types = str_repeat("s", count($params)); // Assuming all params are strings for simplicity
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }
    
                // Execute the prepared query
                if (mysqli_stmt_execute($stmt)) {
                    return $stmt; // Return the statement object for SELECT queries
                } else {
                    return false; // Query failed to execute
                }
            } else {
                throw new Exception("Failed to prepare query: " . mysqli_error($this->conn));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            return false;
        }
    }

    // Fetch all results securely (for SELECT queries)
    function fetchAll($sql, $params = []) {
        // Perform the query execution
        $stmt = $this->query($sql, $params);

        if ($stmt) {
            // If the query was successful, get the result
            $result = mysqli_stmt_get_result($stmt); // Get result from prepared statement
            $results = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            return $results; // Return the results (empty array if no results)
        }
        return []; // Return an empty array if query fails
    }

    // Fetch a single row securely (for SELECT queries)
    function fetchRow($sql, $params = []) {
        // Perform the query execution
        $stmt = $this->query($sql, $params);

        if ($stmt) {
            // If the query was successful, get the result
            $result = mysqli_stmt_get_result($stmt); // Get result from prepared statement
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return $row ? $row : []; // Return the row or an empty array
        }
        return []; // Return an empty array if query fails
    }
}
