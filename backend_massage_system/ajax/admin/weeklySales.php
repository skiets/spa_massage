<?php

$db = new MysqliApp();

$sql = "SELECT 
            price,
            added_on
        FROM
            invoice_tbl
        ORDER BY id DESC";

$query = $db->fetchAll($sql);

$categories = [];
$series = [];

if (!empty($query)) {
    // Loop through the query result and build categories and series arrays
    foreach ($query as $querykey => $queryvalue) {
        // Format date for categories (added_on) (e.g., YYYY-MM-DD or any specific format)
        $categories[] = date('M d, Y', strtotime($queryvalue['added_on'])); // Using 'added_on' for categories

        // Add price to series
        $series[] = (float)$queryvalue['price']; // Cast price to float (in case it's in string format)
    }
} else {
    $categories = [];
    $series = [];
}

// Prepare the data to return as JSON
$data = array(
    "categories" => $categories,
    "series" => $series
);

// Output the data in JSON format
echo json_encode($data);
?>
