<?php

$db = new MysqliApp();

// SQL query to count each status
$sql = "SELECT status, COUNT(id) AS count
        FROM client_tbl
        WHERE status IN ('cancelled', 'completed', 'active')
        GROUP BY status";

// Execute the query
$query = $db->fetchAll($sql);

$cancelled = 0;
$completed = 0;
$pending = 0;

// If there are results, process the counts
if (!empty($query)) {
    foreach ($query as $row) {
        switch ($row['status']) {
            case 'cancelled':
                $cancelled = $row['count'];
                break;
            case 'completed':
                $completed = $row['count'];
                break;
            case 'active':
                $pending = $row['count'];
                break;
        }
    }
}

// Prepare the data to return as JSON
$data = array(
    "cancelled" => $cancelled,
    "completed" => $completed,
    "pending" => $pending,
);

// Output the data in JSON format
echo json_encode($data);
?>
