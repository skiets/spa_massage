<?php

// Assuming MysqliApp is properly initialized and handles your DB connections.
$db = new MysqliApp();

// Query to count clients with a status other than 'cancelled'
$sql = "SELECT COUNT(id) AS client FROM client_tbl WHERE status != 'cancelled'";
$client = $db->fetchRow($sql);

// Query to sum the price in the invoice_tbl
$sql = "SELECT SUM(CAST(price AS INT)) AS invoice FROM invoice_tbl";
$invoice = $db->fetchRow($sql);

// Query to count active services
$sql = "SELECT COUNT(id) AS service FROM services_tbl WHERE status = 'active'";
$service = $db->fetchRow($sql);

// Check if the queries returned valid results; if not, set to 0
if (!empty($client) && !empty($invoice) && !empty($service)) {
    $client = $client['client'];
    $invoice = $invoice['invoice'];
    $service = $service['service'];
} else {
    $client = 0;
    $invoice = 0;
    $service = 0;
}

// Prepare the data array with the results
$data = array(
    'clients' => $client,
    'invoice' => $invoice,
    'service' => $service
);

// Return the data as JSON
echo json_encode($data);

?>
