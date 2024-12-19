<?php

if (isset($_SESSION['spaMassage']) && !empty($_SESSION['spaMassage'])) {
    // Clear specific session variable
    unset($_SESSION['spaMassage']); // This removes the session variable 'spaMassage'
    
    // Optionally, you can also destroy the entire session
    session_destroy(); // Destroys the session completely
    $return = true;
} else {
    $return = false; // If session is not set or empty
}

$data = array(
    "result" => $return
);

echo json_encode($data);